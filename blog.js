
function blog_init() {
		add_events();
		setTextMeasure(document.getElementById('content_container'));
		Hyphenator.run();

		$(window).fireEvent('resize');
}

function add_events() {
		// we want to line up the stripey background
		/*
		$(window).addEvent('resize', function() {
				var window_size = $(window).getSize();
				var body_size = $('background_container').getSize();

				var left_padding = Math.floor((window_size.x - body_size.x) / 2);
				var partial_bar = left_padding % 6; // figure out how much of the bar is showing
				partial_bar += 2;
				$('content').setStyle('background-position', (-1 * partial_bar) + 'px 0px');
		});
		*/

		// hide the comment box and let the comment count link reveal it
		// but only if they aren't on a comment anchor already
		if($('comments') && !location.href.test(/#comment/)) {
				$('comments').setStyle('display', 'none');
				$('comments').set('reveal');
				$('comments').dissolve();

				$$('.comment_count a').each(function(link) {
						link.addEvent('click', function(e) {
								$('comments').reveal();
								e.stop();
								return false;
						});
				});
		}
}
