<!DOCTYPE html>
<html>

<?php
$data = $this->view_data["node_data"];
$media_type = $this->view_data["media_type"];
$available_languages = $this->view_data["available_languages"];
$transcription = $this->view_data["transcription"];
$reveals = $this->view_data["reveals"];
$depends_on = $this->view_data["depends_on"];
$selected_language = $this->view_data["selected_language"];
$site = strtolower($data->site);
?>

<head>
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<LINK rel="stylesheet" type="text/css" href="/static/css/media.css">
	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<title>lain game :: <?= $data->name ?></title>
</head>

<body>
	<center>

		<a href="/">index</a>
		<a href="/about">about</a>
		<a href="/feedback">feedback</a>
		<br>
		<br>

		<table class=ta4>
			<tr>
				<td class=ta4d01>
					<table class=ta4i>
						<tr>
							<td class=ta4d1>ID:</td>
							<td class=ta4d2>
								<?= $data->name ?>
							</td>
						</tr>
						<tr>
							<td class=ta4d1>Location:</td>
							<td class=ta4d2>
								// TODO
								<a href="/index.php?site=0#l11">
									<?= "site $data->site, "; ?>
									<?= "level " . $data->get_level() . ","; ?>
									<?= " #" . $data->get_number(); ?>
								</a>
							</td>
						</tr>
						<tr>
							<td class=ta4d1>Misc:</td>
							<td class=ta4d2>
								<?= "upgrade: $data->upgrade_requirement"; ?>
								<?= "rfvvc: $data->required_final_video_viewcount"; ?>
								<?= "type: $data->type"; ?>
							</td>
						</tr>
						<tr>
							<td class=ta4d1>Depends on:</td>
							<td class=ta4d2>
								<?php if (!is_null($depends_on)) : ?>
									<a class="visited-highlight" href="/node/<?= $site ?>/<?= $depends_on->id ?>">
										<?= $depends_on->name ?>
									</a><br />
								<?php else : ?>
									(nothing)
								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td class=ta4d1>Reveals:</td>
							<td class=ta4d2>
								<?php if (empty($reveals)) : ?>
									(nothing)
								<?php else : ?>
									<?php foreach ($reveals as $node) : ?>
										<a class="visited-highlight" href="/node/<?= $site ?>/<?= $node->id ?>"><?= $node->name ?></a><br />
									<?php endforeach; ?>
								<?php endif; ?>
							</td>
						</tr>
					</table>
				</td>
				<td class=ta4d02>
					<table class=ta4i>
						<tr>
							<td class=ta4d11>Info:</td>
							<td class=ta4d2>
								<?php foreach ($data->protocol_lines as $protocol_line) : ?>
									<span><?= $protocol_line; ?></span><br />
								<?php endforeach; ?>
							</td>
						</tr>
						<tr>
							<td class=ta4d11>Tags:</td>
							<td class=ta4d2>
								<?php foreach ($data->words as $word) : ?>
									<a href="/tag/<?= $word ?>"><?= $word ?></a><br />
								<?php endforeach; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class=ta4d3 colspan=2>
					<div id='mediaspace'>
						<video id="media" playsinline controls width="640px" height="<?= $media_type == 'audio' ? 200 : 480 ?>px">
							<source src="/static/<?= $media_type ?>/<?= $data->media_file ?>.mp4" type='video/mp4'>
							<?php foreach ($available_languages as $lang => $lang_full_name) : ?>
								<track kind="captions" srclang=<?= $lang ?> src="/static/webvtt/<?= $lang ?>/<?= $data->name ?>.vtt" label=<?= $lang_full_name ?> <?= $selected_language == $lang ? "default" : "" ?>>
							<?php endforeach; ?>
							Sorry, your browser doesn't support embedded videos.
						</video>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan=2 class=ta4d3>
					<table class=ta5>
						<tr>
							<?php foreach ($data->image_table_indices as $image_id) : ?>
								<?php if ($image_id != "-1") : ?>
									<td><img src="/static/images/<?= strtolower($data->site) ?>/<?= $image_id ?>.png"></td>
								<?php endif; ?>
							<?php endforeach; ?>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class=ta4d3 colspan=2>
					<form method='GET' name='language' action='/node/<?= $site ?>/<?= $data->id ?>'>
						<select name="lang" onchange="this.form.submit()">
							<?php foreach ($available_languages as $lang => $lang_full_name) : ?>
								<option value="<?= $lang ?>" <?= $selected_language == $lang ? "selected" : "" ?>><?= $lang_full_name ?></option>
							<?php endforeach; ?>
						</select>
					</form>
					<div class='translation' style='margin: 0 auto; max-width: 650px; text-align:left;'>
						<table>
							<colgroup>
								<col width="100%" />
							</colgroup>
							<tbody>
								<?php
								$index = 0;
								foreach ($transcription as $block) : ?>
									<?php foreach ($block['lines'] as $line) :
										$index++; ?>
										<tr class=<?= $index % 2 == 0 ? "even" : "odd" ?>>
											<td>
												<p><?= $line ?></p>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<br>
					<a href="/site/<?= strtolower($data->site) ?>">back</a>
				</td>
			</tr>
		</table>
	</center>
</body>

</html>