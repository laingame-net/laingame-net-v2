<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Expires" content="0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="SHORTCUT ICON" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="/static/css/site.css" />
	<title>lain game :: site <?= strtoupper($this->site) ?></title>
</head>

<body>
	<section class="main-container">

		<header class="site-header">
			<div class="site-sections">
				<a href="/" class="header-link">index</a>
				<a href="/site/<?= $this->site == 'a' ? 'b' : 'a' ?>">change site</a>
				<a href="/about" class="header-link">about</a>
				<a href="/feedback" class="header-link">feedback</a>
			</div>
		</header>

		<?php foreach ($this->view_data['levels'] as $level) :  ?>
			<div class="level-head">
				<div class="line-top"></div>
				<div class="level-label">
					<div class="level-label-site">
						<span>Site <span class="level-label-site-letter">A</span></span>
						<div class="level-label-cube-vb-1"></div>
					</div>
					<div class="level-label-level">
						<div class="level-label-cube-vb-2"></div><span>level.</span>
					</div>
				</div>
				<div class="level-label-number">
					<span><?= $level->number; ?></span>
					<div class="level-label-cube-vb-3"></div>
				</div>
				<div class="line-top"></div>
			</div>

			<div class="level-files">
				<?php
				$row = $level->get_first_row();
				include 'row.php';
				$row = $level->get_second_row();
				include 'row.php';
				$row = $level->get_third_row();
				include 'row.php';
				?>
			</div>
		<?php endforeach; ?>
	</section>
</body>

</html>