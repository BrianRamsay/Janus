<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html">
	<title><?=$theme->the_title(true);?></title>
	<meta name="generator" content="Habari">

<?php
		$feed_tag = '';
		if($matched_rule->entire_match == 'development' || $matched_rule->entire_match == 'life') {
			$feed_tag = $matched_rule->entire_match;
  	}

		if($feed_tag) { // I don't really know the difference between the two atom links
?>
				<link rel="alternate" type="application/atom+xml" title="Atom" href="<?php $theme->feed_alternate(); ?>">
<?php	
		} 
?>

	<link rel="edit" type="application/atom+xml" title="Atom Publishing Protocol" href="<?php URL::out( 'atompub_servicedocument' ); ?>">
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php URL::out( 'rsd' ); ?>">
	<link rel="stylesheet" type="text/css"  media="print" href="<?php Site::out_url( 'vendor'); ?>/blueprint/print.css">
	<link rel="stylesheet" type="text/css" media ="screen" href="<?php Site::out_url( 'vendor'); ?>/blueprint/screen.css">
	<link rel="Shortcut Icon" href="<?php Site::out_url( 'theme' ); ?>/favicon.ico">
	<?php $theme->header(); ?>

	<!-- Google Analytics init -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
		_gaq.push(
		['_setAccount', 'UA-9377034-1'],
		['_setDomain', '.foont.net'],
		['_trackPageview']
		);
	</script>
</head>
<body class="<?php $theme->body_class(); ?>">
		<div id="background_container">

		<!--masthead-->
		<div id="header">
		<a id='admin_link' href="/admin">Admin</a>

<?php if($feed_tag) { ?>
				<div class="feedlink"><a class='feed_link' href="<?php URL::out( 'atom_feed_tag', array( 'tag' => $feed_tag ) ); ?>">&nbsp;</a></div>
<?php } ?>

		<?php $theme->display('banner') ?>
		</div>
		<!--end masthead-->

		<div id='content_container' class="hyphenate">
