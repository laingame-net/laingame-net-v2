<html>

<?php

$tag = $this->view_data["tag"];
$nodes = $this->view_data["nodes"];
$site = $this->view_data["site"];

?>

<head>
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="SHORTCUT ICON" href="/static/favicon.ico" />
	<LINK rel="stylesheet" type="text/css" href="/static/css/tag.css">
	<title>lain game :: site <?= $site ?> :: <?= $tag ?></title>
</head>

<body>
	<center>
		<a href="/">index</a>
		<a href="/about">about</a>
		<a href="/feedback">feedback</a>
		<br>
		<br>

		<h1><?= $tag ?></h1>

		<table class=ta6>
			<?php foreach ($nodes as $node) : ?>
				<tr>
					<td>
						<a class="ae" href="/node/<?= $site ?>/<?= $node->id ?>">
							<div class="af"><?= $node->name ?></div>
						</a>&nbsp;&nbsp;
					</td>
				</tr>
			<?php endforeach; ?>
		</table>


		<br>
		<a href="javascript:history.go(-1)">back</a>
</body>

</html>