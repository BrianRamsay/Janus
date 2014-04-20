<?php


/**
 * Janus is a custom Theme class
 *
 * @package Habari
 */
class Janus extends Theme
{

		public function action_init_theme()
		{
				// Creates an excerpt option. echo $post->content_excerpt;
				Format::apply( 'autop', 'post_content_excerpt' );
				Format::apply( 'tag_and_list', 'post_tags_out' );
	 			//Format::apply_with_hook_params( 'more', 'post_content_excerpt', 'more',60, 1 );

				// Format the calendar like date for home, entry.single and entry.multiple templates
				Format::apply( 'format_date', 'post_pubdate_out','{F} {j}, {Y}' );
		}

		public function action_template_header() 
		{
				Stack::add('template_stylesheet', array($this->get_url() . '/style.css', 'screen'));
				Stack::add('template_stylesheet', array($this->get_url() . '/kernest_fonts.css', 'screen'));
		}

		public function action_template_footer() 
		{
				Stack::add('template_footer_javascript', 
						"https://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools-yui-compressed.js", 'mootools');
				Stack::add('template_footer_javascript', 
						$this->get_url() . "/mootools-more.js", 'mootools-more', array('mootools'));
				Stack::add('template_footer_javascript', 
						$this->get_url() . "/blog.js", 'blog', array('mootools', 'mootools-more'));
				Stack::add('template_footer_javascript', $this->get_url() . "/text_messing.js", 'text');
		}
	/**
	 * Add additional template variables to the template output.
	 *
	 *  You can assign additional output values in the template here, instead of
	 *  having the PHP execute directly in the template.  The advantage is that
	 *  you would easily be able to switch between template types (RawPHP/Smarty)
	 *  without having to port code from one to the other.
	 *
	 *  You could use this area to provide "recent comments" data to the template,
	 *  for instance.
	 *
	 *  Note that the variables added here should possibly *always* be added,
	 *  especially 'user'.
	 *
	 *  Also, this function gets executed *after* regular data is assigned to the
	 *  template.  So the values here, unless checked, will overwrite any existing
	 *  values.
	 */
	public function add_template_vars()
	{
		if( !$this->template_engine->assigned( 'pages' ) ) {
			$this->assign('pages', Posts::get( array( 'content_type' => 'page', 'status' => Post::status('published') ) ) );
		}

		parent::add_template_vars();

		//visiting page/2, /3 will offset to the next page of posts in the sidebar
		$page =Controller::get_var( 'page' );
		$items_per_page = isset( $this->posts->get_param_cache['limit'] ) ?  $this->posts->get_param_cache['limit'] : Options::get( 'pagination' );
		if ( $page == '' ) { 
				$page = 1; 
		}

		$this->assign( 'more_posts', Posts::get(array ( 'status' => 'published','content_type' => 'entry', 'offset' => ($items_per_page)*($page), 'limit' => $items_per_page,  ) ) );

		$posts = Posts::get( array( 'vocabulary'=> array('tags:term' => 'life'), 
																'limit'=>$items_per_page, 
																'status' => 'published',
																'content_type' => 'entry', 
																'offset' => ($items_per_page)*($page - 1)) );
		$this->assign( 'life_post', count($posts) ? $posts[0] : null);
		$this->assign( 'life_posts', $posts );

		$posts = Posts::get( array( 'vocabulary'=> array('tags:term' => 'development'), 
																'limit'=>$items_per_page, 
																'status' => 'published',
																'content_type' => 'entry', 
																'offset' => ($items_per_page)*($page - 1)) );
		$this->assign( 'dev_post', count($posts) ? $posts[0] : null);
		$this->assign( 'dev_posts', $posts );

	}

		public function theme_feed_alternate($theme)
		{
				$matched_rule = URL::get_matched_rule();
				$match = $matched_rule->entire_match;
				if($match == 'development' || $match == 'life') {
						return URL::get( 'atom_feed_tag', array( 'vocabulary' => array( 'tags:term' => $match) ) );
				} else {
						return parent::theme_feed_alternate($theme);
				}
		}

		public function get_nav_pages( $pages, $matched_rule )
		{
				// TODO definitely can do this better with ::get
				$nav_pages = array();
				foreach ( $pages as $page ) {
						if($page->tags && $page->tags->has('nav')) {
								$selected = '';
								if ( $matched_rule->entire_match == strtolower($page->title) ) {
										$selected = 'selected';
								}
								$page->nav_class = $selected;
								$nav_pages[] = $page;
						}
				}
				return array_reverse($nav_pages);
		}

		public function filter_post_content_excerpt($content, $post)
		{
				// find the first period after 300 characters
				for($i=300; $i < strlen($content); $i++) {
						if(in_array($content[$i], array(".", "!", "?"))) {
								break;
						}
				}

				// drop html before the first <p>
				$content = preg_replace("/^<h3>.*\\n/",'', $content);

				// pull out the first image and move it to the beginning (so floating works as expected)
				$exists = preg_match("(<a href.*>\s*<img .*>\s*<\/a>)", $content, $matches);
				if($exists) {
						$content = $matches[0] . preg_replace("/<a href.*>\s*<img .*>\s*<\/a>/",'', $content);
				}

				$excerpt = substr($content, 0, $i + 2);
				if($i < strlen($content)) {
						$excerpt .= '...<br /><a class="post_link" href="' . $post->permalink . '" title="' . $post->title . '">More from ' . $post->title_out . '</a>';
				} else {
						if(substr(trim($excerpt),-4) !== '<br>') {
								$excerpt = trim($excerpt) . "<br>";
						}
						$excerpt .= '<a class="post_link" href="' . $post->permalink . '" title="' . $post->title . '">View ' . $post->title_out . '</a>';
				}

				return "<div class='excerpt'>$excerpt</div>";
		}

		public function filter_post_permalink_html($permalink, $post)
		{
				return '<a href="' . $permalink . '" title="' . $post->title . '">' . $post->title_out . '</a>';
		}

		public function show_pager($theme, $posts, $no_box = false)
		{
				$shown = count($posts);
				$total = $posts->count_all();
				$theme->posts = $posts;

				if($shown < $total) {
?>
				<div class='<?=($no_box ? '' : 'post')?> pager'>
				<?php $theme->prev_page_link('&laquo; ' . _t('Newer Posts')); ?> 
				<?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> 
				<?php $theme->next_page_link('&raquo; ' . _t('Older Posts')); ?>
				</div>
<?php
				}
		}

		public function get_pithy_statement()
		{
?>
			<div class='zen'>
					<dt>less <span>consumption</span></dt><dd>more <span>creation</span></dd>
					<dt>less <span>sitting</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dt><dd>more <span>exercise</span></dd>
			</div>
			<div class='zen'>
					<dt>less <span>distraction</span></dt><dd>more <span>growth</span></dd>
					<dt>less <span>commitment</span></dt><dd>more <span>time</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</dd>
			</div>
<?php
		}

		public function need_navigation($tag)
		{
				return (5 < count(Posts::count_by_tag($tag, 'published')));
		}

		public function get_recent_posts_text($tag)
		{
				$posts = Posts::get( array( 'vocabulary'=> array('tags:term' => $tag), 
																		'status' => 'published',
																		'content_type' => 'entry', 
																		'where' => array(array('after' => strtotime('-1 month'))),
																		));
				$post_count = count($posts);

				$pluralize = "have been $post_count posts";
				if($post_count == 1) {
						$pluralize = "has been only 1 post";
				}
				$text = "There $pluralize this month";

				if($tag == 'life') {
						if($post_count < 3) {
								$text .= ". <span class='nobreak'>:-(</span> &nbsp; We must have very boring lives&hellip; or maybe we have so much going on there's no time to post anything!";
						} else if($post_count > 7) {
								$text .= "! We must have very exciting lives&hellip; or maybe we just have too much time on our hands.";
						} else {
								$text .= ". Not bad!";
						}
				}

				if($tag == 'development') {
						if($post_count < 3) {
								$text .= ". <span class='nobreak'>:-(</span> &nbsp; I must be pretty lazy these days&hellip; or maybe I'm working feverishly on so many projects that there's no time to post anything!";
						} else if($post_count > 7) {
								$text .= "! I must be super productive these days&hellip; or maybe I'm spending all my time talking and haven't actually done anything.";
						} else {
								$text .= ". Not bad!";
						}
				}

				return $text;
		}

		public function get_random_quote()
		{
				$sources = array('math','osp_rules', 'prog_style', 'literature', 'futurama', 'oscar_wilde');
				if(!rand(0,2)) {
						$sources[] = 'discworld'; // discworld shows up too much
				}
				$url = 'http://www.iheartquotes.com/api/v1/random?show_permalink=false&max_lines=5&show_source=0&source=' . implode('+',$sources);
				$quote = file_get_contents($url);
				return $quote;
		}

		/**
		* Return the title for the page
		* @return String the title.
		*/
		public function the_title( $head = false )
		{
			$title = '';
			//Copy Pasta from Andrew Rickman's ported theme, Dilectio 
						//http://www.habari-fun.co.uk/converting-wordpress-themes-to-habari-file-names
			//check against the matched rule
			switch( $this->matched_rule->name ){
				case 'display_404':
					$title = 'Error 404';
				break;
				case 'display_entry':
					$title .= $this->post->title;
				break;
				case 'display_page':
					$title .= $this->post->title;
				break;
				case 'display_search':
					$title .= 'Search for ' . ucfirst( $this->criteria );
				break;
				case 'display_entries_by_tag':
					$title .= ucfirst( $this->tag ) . ' Tag';
				break;
				case 'display_entries_by_date':
					$title .= 'Archive for ';
					$archive_date = new HabariDateTime();
					if ( empty($date_array['day']) ){
						if ( empty($date_array['month']) ){
							//Year only
							$archive_date->set_date( $this->year , 1 , 1 );
							$title .= $archive_date->format( 'Y' );
							break;
						}
						//year and month only
						$archive_date->set_date( $this->year , $this->month , 1 );
						$title .= $archive_date->format( 'F Y' );
						break;
					}
					$archive_date->set_date( $this->year , $this->month , $this->day );
					$title .= $archive_date->format( 'F jS, Y' );
				break;
			}
				
			if ( $head ){
				return ( empty($title)) ? Options::get( 'title' ) : $title . ' - ' . Options::get( 'title' );
			}
							
			return $title;
	}

}

?>
