<div class="post">
	<div class="post_header">
		<a class="post_title" href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a>
		<?php if ( $loggedin ) { ?>
		<a class="post_edit" href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
		<?php } ?>
	</div>

	<?=$post->content_out?>

	<table></tr>
			<td><span class='post_date'>Posted <?php echo $post->pubdate_out; ?></span></td>

	<?php if ( count($post->tags) ) { ?>
			<td><div class="tags"><?=_e('Tagged:')?> <?=$post->tags_out; ?></div></td>
	<?php } ?>

	<td><div class="comment_count"><?=$theme->comments_link($post,'%d Comments','%d Comment','%d Comments')?></div></td>

	</tr></table>

<?php 
	// include the comment form if we're on the actual post page itself
	if($post->permalink == 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
			include('commentform.php');		
	}
?>
</div>
