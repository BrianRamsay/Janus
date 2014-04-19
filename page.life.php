<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
<div id='content_header'>
		Welcome to the life of Brian and Michelle Ramsay.  <?=$theme->get_recent_posts_text('life')?>
</div>

<?php 
		foreach($life_posts as $post) { 
				$theme->assign('post', $post);
				$theme->display( 'single_post' );
		}

		$theme->show_pager($theme, $life_posts);
?>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
