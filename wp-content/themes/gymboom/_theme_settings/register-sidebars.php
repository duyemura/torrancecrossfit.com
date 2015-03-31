<?php
if (function_exists('register_sidebar')) {

	// Default
	register_sidebar(array(
		'name' => __('Default Sidebar','gymboom'),
		'id'   => 'default-sidebar',
		'description'   => __('The default sidebar for pages.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Page Block 1
	register_sidebar(array(
		'name' => __('Page Widget Block A','gymboom'),
		'id'   => 'page-block-1',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #1.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Page Block 2
	register_sidebar(array(
		'name' => __('Page Widget Block B','gymboom'),
		'id'   => 'page-block-2',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #2.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Page Block 3
	register_sidebar(array(
		'name' => __('Page Widget Block C','gymboom'),
		'id'   => 'page-block-3',
		'description'   => __('These widgets show up on pages that have widgets active. This is block #3.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Footer Left
	register_sidebar(array(
		'name' => __('Bottom Widget Block A','gymboom'),
		'id'   => 'bottom-footer-1',
		'description'   => __('These widgets show up in the bottom footer (left side).','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Footer Middle
	register_sidebar(array(
		'name' => __('Bottom Widget Block B','gymboom'),
		'id'   => 'bottom-footer-2',
		'description'   => __('These widgets show up in the bottom footer (middle).','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Footer Right
	register_sidebar(array(
		'name' => __('Bottom Widget Block C','gymboom'),
		'id'   => 'bottom-footer-3',
		'description'   => __('These widgets show up in the bottom footer (right side).','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Pages
	register_sidebar(array(
		'name' => __('Page Sidebar','gymboom'),
		'id'   => 'page-sidebar',
		'description'   => __('These widgets will show up on pages only.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Posts
	register_sidebar(array(
		'name' => __('Post Sidebar','gymboom'),
		'id'   => 'post-sidebar',
		'description'   => __('These widgets will show up on posts only.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
	// Video
	register_sidebar(array(
		'name' => __('Video Category Sidebar','gymboom'),
		'id'   => 'videos-sidebar',
		'description'   => __('These widgets will show up on Video listings only.','gymboom'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><ul class="widgets">',
		'after_widget'  => '</ul></div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));
	
}
?>