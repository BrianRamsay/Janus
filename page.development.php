<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
<div id='content_header'>
		<p>Welcome to my development notes and thoughts.  <?=$theme->get_recent_posts_text('development')?></p>
		<dt>Current Project: </dt> 
		<dd>This website</dd>
		<br />
		<dt>Current Book: </dt>
		<dd>
		<a href="http://www.amazon.com/gp/product/0961392142?ie=UTF8&tag=foontnet-20&linkCode=as2&camp=1789&creative=9325&creativeASIN=0961392142">The Visual Display of Quantitative Information</a><img src="http://www.assoc-amazon.com/e/ir?t=foontnet-20&l=as2&o=1&a=0961392142" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />, by Edward Tufte

		</dd>
</div>

<?php 
		foreach($dev_posts as $post) { 
				$theme->assign('post', $post);
				$theme->display( 'single_post' );
		}

		$theme->show_pager($theme, $dev_posts);
?>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
