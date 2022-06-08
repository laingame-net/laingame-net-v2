<?php

use Ad044\LaingameNetV2\Models\Level;
use Ad044\LaingameNetV2\Models\Node;
use \Done\Subtitles\Subtitles;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

function get_site_data($site)
{
    $file = file_get_contents("static/json/site_$site.json");
    return json_decode($file, true);
}

function get_lang($available_languages, $request)
{
    $selected_language = $request->paramsGet()->get('lang', null) ?? $request->cookies()->get('lang', null);

    if (!is_null($selected_language) && array_key_exists($selected_language, $available_languages)) {
        return $selected_language;
    }

    return 'en';
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
    if ($request->site !== 'a' && $request->site !== 'b') {
        $response->redirect("/error", 404);
        return;
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
    $service->render('../src/views/feedback.php');
});

$klein->respond('POST', '/feedback', function ($request, $response, $service) {
    $body = $request->param('body', null);
    $email = $request->param('email', null);

    // TODO proper handlers here
    if (is_null($body) || is_null($email)) {
        return;
    }

    if (strlen($body) < 1 || strlen($email) < 1) {
        return;
    }

    // TODO send mail, log errors, send response, etc.
});

$klein->respond('GET', '/tag/[:site]/[:tag]', function ($request, $response, $service) {
    if ($request->site !== 'a' && $request->site !== 'b') {
        $response->redirect("/error", 404);
        return;
    }

    $tag = $request->tag;
    $site_data = get_site_data($request->site);

    $tagged_nodes = array();
    foreach ($site_data as $level => $nodes) {
        foreach ($nodes as $node) {
            if (in_array($tag, $node["words"])) {
                array_push($tagged_nodes, new Node($node));
            };
        }
    };

    $service->view_data = array('tag' => $tag, 'nodes' => $tagged_nodes, 'site' => strtolower($request->site));
    $service->render('../src/views/tag.php');
});

$klein->respond('GET', '/node/[:site]/[:id]', function ($request, $response, $service) {
    if ($request->site !== 'a' && $request->site !== 'b') {
        $response->redirect("/error", 404);
        return;
    }
    $site_data = get_site_data($request->site);

    $level = substr($request->id, 0, 2);
    $level_data = $site_data[$level];
    if (is_null($level_data)) {
        $response->redirect("/error", 404);
        return;
    }
    $node_data = $level_data[$request->id];
    if (is_null($node_data)) {
        $response->redirect("/error", 404);
        return;
    }

    $node = new Node($node_data);

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
    $selected_language = get_lang($available_languages, $request);
    $response->cookie('lang', $selected_language);

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

$klein->onHttpError(function ($code, $router) {
    if ($code == 404) {
        $router->response()->sendHeaders(true, true);
        $service = $router->service();
        $service->view_data = array('message' => 'Not found.');
        $service->render('../src/views/error.php');
    }
});

$klein->dispatch();
