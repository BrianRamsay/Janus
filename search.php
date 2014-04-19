<?php $theme->display ( 'header' ); ?>

<?php
		$total = $posts->count_all();
		$shown = count($posts);
		$result_text = "Found $shown results";
		if($shown < $total) {
				$items_per_page = isset( $posts->get_param_cache['limit'] ) ?  $posts->get_param_cache['limit'] : Options::get( 'pagination' );
				$start = ($page -1) *  $items_per_page + 1;
				$end = $start + $shown - 1;
				$result_text = "Showing results $start - $end out of " . $total;
		}

		if(count($posts) == 0) {
				$result_text = "No results found";
		}

		$result_text .= " for '" .htmlspecialchars($criteria) ."'";

?>
<div id='content' class='column'>
<div id='content_header' style='text-align:center'> <?=$result_text?> </div>
<?php 
		foreach($posts as $post) { 
				$title = $post->title;
				$excerpt = $post->content_excerpt;
				// TODO highlight search terms
?>
<div class="post">
		<h3>
				<a href="<?php echo $post->permalink; ?>" title="<?php echo $title; ?>"><?php echo $post->title_out; ?></a>
				<span class='post_date' style='float:right;font-size:.8em'><?php echo $post->pubdate_out; ?></span>
		</h3>
		<?=$excerpt?>
</div>
<?php
		}

		$theme->show_pager($theme, $posts);
?>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
