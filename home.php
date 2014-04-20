<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
		<div class='post'>
				<h3>What's happening?</h3>
				<?=$life_post->content_excerpt?>

				<h3>What am I working on?</h3>
				<?=$dev_post->content_excerpt?>
		</div>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
