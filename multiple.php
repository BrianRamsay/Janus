<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
<?php 
		foreach($posts as $post) { 
				$theme->assign('post', $post);
				$theme->display( 'single_post' );
		}

		$theme->show_pager($theme, $posts);
?>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
