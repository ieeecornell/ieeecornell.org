<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo (get_the_title() ? get_the_title() . " | " : ""); ?>IEEE Cornell</title>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
</head>
<body>
	<header>
		<div class="inside">
			<h1><a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/cornell-logo.gif" alt"Cornell logo" height="50" width="50"><span>IEEE Cornell</span></a></h1>
			<?php
				wp_nav_menu(array(
					"theme_location" => "header_menu"
				));
			?>
		</div>
	</header>
	<div class="content">