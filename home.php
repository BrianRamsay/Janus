<?php $theme->display ( 'header' ); ?>

<div id='content' class='column'>
		<div class='post'>
				<h3 style='margin-bottom:5px'>Who am I?</h3>
					<p class='bio'>My name is Brian Ramsay.  I graduated from <a href='http://www.cse.taylor.edu'>Taylor University</a> in 2005, and have lived in South Florida ever since.  I am employed by <a href='http://www.sentryds.com'>Sentry Data Systems</a>, where I work with talented developers to build cutting-edge web-based healthcare applications. I am married and my wife is probably feeling left out of this paragraph, so go <a href="about">here</a> to read about our family.
					</p>
				<h3>What's happening?</h3>
				<?=$life_post->content_excerpt?>

				<h3>What am I working on?</h3>
				<?=$dev_post->content_excerpt?>
		</div>
</div>

<?php $theme->display ( 'sidebar' ); ?>

<?php $theme->display ( 'footer' ); ?>
