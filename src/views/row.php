<div class="row">
	<?php foreach ($row as $node) :  ?>
		<div class="cell">
			<?php if (!is_null($node)) : ?>
				<a class="file-link" href="/node/<?= strtolower($node->site) . "/" . $node->id ?>">
					<img src="https://laingame.net/media/_icon5.png" alt="" />
					<div class="file-title">
						<span class="first-letter"><?= $node->get_first_letter(); ?></span><?= $node->get_letters_after_first(); ?>
					</div>
				</a>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>