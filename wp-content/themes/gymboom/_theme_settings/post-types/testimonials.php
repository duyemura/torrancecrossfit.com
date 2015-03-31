<?php

function register_testimonials_post_type() {

	// Testimonials
	$labels = array(
		'name' => __('Testimonials','gymboom'),
		'singular_name' => __('Testimonial','gymboom'),
		'add_new' => __('Add New Testimonial','gymboom'),
		'add_new_item' => __('Add New Testimonial','gymboom'),
		'edit_item' => __('Edit Testimonial','gymboom'),
		'new_item' => __('New Testimonial','gymboom'),
		'view_item' => __('View Testimonial','gymboom'),
		'search_items' => __('Search Testimonials','gymboom'),
		'not_found' => __('No Testimonials Found','gymboom'),
		'not_found_in_trash' => __('No Testimonials Found In Trash','gymboom'),
		'parent_item_colon' => __('Parent Testimonial:','gymboom')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'testimonial',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 32,
		'menu_icon' => 'dashicons-testimonial',
		'supports' => array('title', 'page-attributes','thumbnail'),
		'has_archive' => 'testimonials'
	); 
	register_post_type('testimonial-items', $args);
	
	$labels = array(
	    'name' => _x( 'Categories', 'taxonomy general name','gymboom' ),
	    'singular_name' => _x( 'Testimonial Category', 'taxonomy singular name','gymboom' ),
	    'search_items' =>  __( 'Search Testimonial Categories','gymboom' ),
	    'popular_items' => __( 'Popular Testimonial Categories','gymboom' ),
	    'all_items' => __( 'All Testimonial Categories','gymboom' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Testimonial Category','gymboom' ), 
	    'update_item' => __( 'Update Testimonial Category','gymboom' ),
	    'add_new_item' => __( 'Add New Testimonial Category','gymboom' ),
	    'new_item_name' => __( 'New Testimonial Category Name','gymboom' ),
	    'separate_items_with_commas' => __( 'Separate Testimonial Categories with commas','gymboom' ),
	    'add_or_remove_items' => __( 'Add or remove Testimonial Categories','gymboom' ),
	    'choose_from_most_used' => __( 'Choose from the most used Testimonial Categories','gymboom' )
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
	register_taxonomy('testimonials', 'testimonial-items', $args);
	
} ?>