<?php if ( Session::has_messages() ) {
		Session::messages_out();
	}
?>

<div id="comments">

	<h4 class="commentheading">
				<a class="feed_link"  title="Subscribe to these comments" style='float:right;width:40px;padding:0px;margin-top:-5px' href="<?php echo $post->comment_feed_link; ?>">&nbsp;</a>
	</h4>
<?php if ( $post->comments->moderated->count ) { ?>
	<ul id="commentlist">
		<?php
				$comment_number=0;
				foreach ( $post->comments->comments->moderated as $comment ) {
						$comment_number++;
						$class = 'class="comment';
						if ( $comment->status == Comment::STATUS_UNAPPROVED ) {
							$class.= '-unapproved';
						}
						$class.= '"';
		?>
						<li id="comment-<?=$comment->id?>" <?=$class?>>
								<div class="comment-content">
										<a href="#comment-<?=$comment->id?>" class="counter" title="<?php _e('Permanent Link to this Comment'); ?>"><?=$comment_number;?></a><?=trim($comment->content_out)?>
								</div>
								<div class="comment-meta">
										<span class="commentauthor"><?php _e('Comment by'); ?> <?php $theme->comment_author_link($comment); ?></span>
										<span class="commentdate"> <?php _e('on'); ?> <?php $comment->date->out('M j, Y h:ia'); ?></span>
<?php if ( $comment->status == Comment::STATUS_UNAPPROVED ) : ?>
										<h5><em><?php _e('In moderation'); ?></em></h5>
<?php endif; ?>
								</div>
						</li>
<?php		}		?>
	</ul>
<?php	} else {
					_e('No one has commented yet. Be the first!');
			}
	?>
	<div class="comments">
		<br>
<?php $post->comment_form()->out(); ?>
	</div>


</div>
