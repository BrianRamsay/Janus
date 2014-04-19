<div id='sidebar' class='column'>
		<ul class='vertrina-bold'>
				<li class="<?=($matched_rule->entire_match == '' ? 'selected' : '')?>"><a href="<?php Site::out_url( 'habari' ); ?>"><?php _e('Home'); ?></a></li>
				<?php
				foreach ( $theme->get_nav_pages($pages, $matched_rule) as $page ) {
						echo '<li class="' . $page->nav_class . '">' . $page->permalink_html . '</li>' . "\n";
				}
				?>
		</ul>
</div>
