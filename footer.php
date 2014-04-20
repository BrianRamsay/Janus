	</div>
	<!-- end content_container -->

<div id="footer-wrapper">
	<div id="footer">

		<!-- Yeah, I'm using a table.  so sue me. -->
		<table><tr>
				<td>Thanks to <a href="http://habariproject.org">Habari</a>
						<br />
						Hosted by <a href='http://www.dreamhost.com/r.cgi?458883'>Dreamhost</a>
				</td>
				<td id="center">
						<?=$theme->get_pithy_statement()?>
				</td>
				<td class='valid_links'>
						<br />
						<span class='date_span'><?=date('l, F jS', strtotime('-3 hours'))?></span>
						<br />
						<span> Created by <a href="/admin">Brian Ramsay</a></span>
				</td>
		</tr></table>
	</div>
</div>

</div> <!-- end background container -->

<?php echo $theme->footer(); ?>
<script type='text/javascript'>
		$(window).addEvent('domready', function() {
				blog_init();
		});

		// Fire off google analytics
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
</script>
</body>
</html>
