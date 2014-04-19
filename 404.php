<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
		<p>
		<img id='img404' src="<?=Site::out_url( 'theme' )?>/images/kitteh_404.jpg" alt="404 - Page Not Found" title="404 - Page Not Found" />
		<br />
		<br />
		<br />
		<h3>404 Error: File Not Found</h3>
		<br />
		The page '<?=$matched_rule->entire_match?>' has moved or doesn't exist.  
		<br />
		<br />
		<a href="<?=URL::out('display_search');?>/<?=urlencode($matched_rule->entire_match)?>">Search the site for your request</a>
		</p>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
