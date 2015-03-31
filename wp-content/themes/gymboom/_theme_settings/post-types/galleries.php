<?php

function register_galleries_post_type() {

	// Galleries
	$labels = array(
		'name' => __('Galleries','gymboom'),
		'singular_name' => __('Gallery','gymboom'),
		'add_new' => __('Add New Gallery','gymboom'),
		'add_new_item' => __('Add New Gallery','gymboom'),
		'edit_item' => __('Edit Gallery','gymboom'),
		'new_item' => __('New Gallery','gymboom'),
		'view_item' => __('View Gallery','gymboom'),
		'search_items' => __('Search Galleries','gymboom'),
		'not_found' => __('No Galleries Found','gymboom'),
		'not_found_in_trash' => __('No Galleries Found In Trash','gymboom'),
		'parent_item_colon' => __('Parent Gallery:','gymboom')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'gallery',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 32,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title','editor', 'page-attributes','thumbnail','comments','author','excerpt'),
		'has_archive' => 'galleries'
	); 
	register_post_type('gallery-items', $args);
	
	$labels = array(
	    'name' => _x( 'Gallery Categories', 'taxonomy general name','gymboom' ),
	    'singular_name' => _x( 'Gallery Category', 'taxonomy singular name','gymboom' ),
	    'search_items' =>  __( 'Search Gallery Categories','gymboom' ),
	    'popular_items' => __( 'Popular Gallery Categories','gymboom' ),
	    'all_items' => __( 'All Gallery Categories','gymboom' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Gallery Category','gymboom' ), 
	    'update_item' => __( 'Update Gallery Category','gymboom' ),
	    'add_new_item' => __( 'Add New Gallery Category','gymboom' ),
	    'new_item_name' => __( 'New Gallery Category Name','gymboom' ),
	    'separate_items_with_commas' => __( 'Separate Gallery Categories with commas','gymboom' ),
	    'add_or_remove_items' => __( 'Add or remove Gallery Categories','gymboom' ),
	    'choose_from_most_used' => __( 'Choose from the most used Gallery Categories','gymboom' )
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
	register_taxonomy('galleries', 'gallery-items', $args);

} ?>