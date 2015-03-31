<?php

function register_videos_post_type() {

	// Videos
	$labels = array(
		'name' => __('Videos','gymboom'),
		'singular_name' => __('Video','gymboom'),
		'add_new' => __('Add New Video','gymboom'),
		'add_new_item' => __('Add New Video','gymboom'),
		'edit_item' => __('Edit Video','gymboom'),
		'new_item' => __('New Video','gymboom'),
		'view_item' => __('View Video','gymboom'),
		'search_items' => __('Search Videos','gymboom'),
		'not_found' => __('No Videos Found','gymboom'),
		'not_found_in_trash' => __('No Videos Found In Trash','gymboom'),
		'parent_item_colon' => __('Parent Video:','gymboom')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'video',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 32,
		'menu_icon' => 'dashicons-format-video',
		'supports' => array('title','editor', 'page-attributes','thumbnail','comments','author','excerpt'),
		'has_archive' => 'videos'
	); 
	register_post_type('video-items', $args);
	
	$labels = array(
	    'name' => _x( 'Video Categories', 'taxonomy general name','gymboom' ),
	    'singular_name' => _x( 'Video Category', 'taxonomy singular name','gymboom' ),
	    'search_items' =>  __( 'Search Video Categories','gymboom' ),
	    'popular_items' => __( 'Popular Video Categories','gymboom' ),
	    'all_items' => __( 'All Video Categories','gymboom' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Video Category','gymboom' ), 
	    'update_item' => __( 'Update Video Category','gymboom' ),
	    'add_new_item' => __( 'Add New Video Category','gymboom' ),
	    'new_item_name' => __( 'New Video Category Name','gymboom' ),
	    'separate_items_with_commas' => __( 'Separate Video Categories with commas','gymboom' ),
	    'add_or_remove_items' => __( 'Add or remove Video Categories','gymboom' ),
	    'choose_from_most_used' => __( 'Choose from the most used Video Categories','gymboom' )
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			"with_front" => true,
		),
	);
	register_taxonomy('videos', 'video-items', $args);
	
} ?>