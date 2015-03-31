<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
	
	<?php global $template_dir;
	$template_dir = get_template_directory_uri(); ?>

	<title><?php wp_title('&mdash;', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php $responsive_disabled = ot_get_option('js_responsive_disabled',false);
	$responsive_disabled = $responsive_disabled[0];
	$responsive_disabled = ($responsive_disabled ? true : false);
	
	if (!$responsive_disabled): ?>
	
	<!-- Apple iOS Settings -->
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
	
	<?php endif; ?>
	
	<!--[if gte IE 9]>
  	<style type="text/css">
  	  .button, .button:hover, .button.grey, .button.grey:hover {
  	     filter: none;
  	  }
  	</style>
  	<![endif]-->
	
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

	<section id="wrap">
		<header<?php if ( is_admin_bar_showing() ) { echo ' style="top:32px;"'; } ?>>
			<section class="shell">
				<h1 id="logo"><a href="<?php echo home_url(); ?>" class="notext"><?php bloginfo('name'); ?></a></h1>
				
				<nav>
					<?php // Display Main Menu
					$gymboomWalker = new GymboomCustomNavigation();
					wp_nav_menu(array('container' => false, 'theme_location' => 'main-menu', 'fallback_cb' => 'main_menu_message', 'walker' => $gymboomWalker));
					?>
				</nav>
				
				<div id="mobile-nav">
					<?php  // Display Mobile Menu
					wp_nav_menu(array('container' => false, 'theme_location' => 'main-menu', 'fallback_cb' => 'main_menu_message', 'walker' => $gymboomWalker));
					?>
					
					<a class="mobile-nav-toggle">+</a>
				</div>
				
			</section>
		</header>		