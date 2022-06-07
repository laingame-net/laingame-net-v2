<?php

use Ad044\LaingameNetV2\Models\Level;
use Ad044\LaingameNetV2\Models\Node;
use \Done\Subtitles\Subtitles;

require '../vendor/autoload.php';

function get_site_data($site)
{
    $file = file_get_contents("static/json/site_$site.json");
    return json_decode($file, true);
}

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function ($request, $response, $service) {
    $service->render('../src/views/home.php');
});

$klein->respond('GET', '/about', function ($request, $response, $service) {
    $service->render('../src/views/about.php');
});

$klein->respond('GET', '/bootleg', function ($request, $response, $service) {
    $service->render('../src/views/bootleg.php');
});

$klein->respond('GET', '/site/[:site]', function ($request, $response, $service) {
    if ($request->site != 'a' || $request->site != 'b') {
        // TODO proper 404
    }
    $service->site = $request->site;

    $site_data = get_site_data($request->site);
    $service->view_data =
        array('levels' => array_reverse(array_map(function ($number, $nodes) {
            return new Level($number, $nodes);
        }, array_keys($site_data), $site_data)));


    $service->render('../src/views/site.php');
});

$klein->respond('GET', '/feedback', function ($request, $response, $service) {
    echo 'TODO';
});

$klein->respond('GET', '/tag/[:tag]', function ($request, $response, $service) {
    echo 'TODO';
});

$klein->respond('GET', '/node/[:site]/[:id]', function ($request, $response, $service) {
    if ($request->site != 'a' || $request->site != 'b') {
        // TODO proper 404
    }
    // TODO validity check on the id
    // TODO save language in cookie

    $level = substr($request->id, 0, 2);

    $site_data = get_site_data($request->site);

    $node = new Node($site_data[$level][$request->id]);

    $reveals = array();
    foreach ($site_data as $level => $nodes) {
        foreach ($nodes as $other_node) {
            if ($other_node["unlocked_by"] == $node->id) {
                array_push($reveals, new Node($other_node));
            };
        }
    };

    $available_languages = array(
        'en' => "English",
        'fr' => "French",
        'ko' => "Korean"
    );
    $selected_language = $request->param('lang', 'en');
    // in case weird string was passed in as lang, we set it back to en
    if (!array_key_exists($selected_language, $available_languages)) {
        $selected_language = 'en';
    }

    $transcription = array();
    $vtt_file = "../public_html/static/webvtt/$selected_language/$node->name.vtt";
    if (file_exists($vtt_file)) {
        $transcription = Subtitles::load($vtt_file)->getInternalFormat();
    }

    $service->view_data = array(
        'node_data' => $node,
        'available_languages' => $available_languages,
        'selected_language' => $selected_language,
        'reveals' => $reveals,
        'depends_on' => $node->unlocked_by != "" ? new Node($site_data[$node->get_level()][$node->unlocked_by]) : null,
        'transcription' => $transcription,
        'media_type' => str_contains($node->media_file, 'XA') ? 'audio' : 'movie'
    );

    $service->render('../src/views/media.php');
});

$klein->dispatch();
