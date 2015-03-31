<?php

# Use a class as a namespace to prevent conflicts
class GymBoomSlider extends BoxyBase {
	/*
		Default settings - may be changed when creating an instance of the class.
		See the class constructor.
	*/
	var $defaults = array(
		'post_type_name'     => 'custom-slider',
		'post_type_settings' => array(),
		'strings'            => array(
			'no-title' => 'Slide Title Goes Here'
		),
		'animations'         => array('random', 'fadeIn', 'fadeInUp', 'fadeInDown', 'fadeInLeft', 'fadeInRight', 'fadeInRight', 'bounceIn', 'bounceInDown', 'bounceInUp', 'bounceInLeft', 'bounceInRight', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'fadeInLeftBig', 'fadeInRightBig', 'fadeInUpBig', 'fadeInDownBig', 'flipInX', 'flipInY', 'lightSpeedIn')
	);

	/*
		These fields will be saved when a post is saved
	*/
	var $fields = array( 'slider_type', 'slides', 'obo_slides' );

	/*
		Registers the slider post type.

		If you need to change the post type's settings, pass the changes as an item of the $args array on initialization
	*/
	function register_post_type() {
		$args = array(
			'labels' => array(
				'name'               => __('Sliders','flip'),
				'singular_name'      => __('Slider','flip'),
				'add_new'            => __('Add New','flip'),
				'add_new_item'       => __('Add new Slider','flip'),
				'view_item'          => __('View Slider','flip'),
				'edit_item'          => __('Edit Slider','flip'),
				'new_item'           => __('New Slider','flip'),
				'view_item'          => __('View Slider','flip'),
				'search_items'       => __('Search Sliders','flip'),
				'not_found'          => __('No Sliders found','flip'),
				'not_found_in_trash' => __('No Sliders found in Trash','flip'),
			),
			'public'        => false,
			'show_ui'       => true,
			'hierarchical'  => true,
			'supports'      => array('title'),
			'menu_position'	=> 35,
			'menu_icon'     => 'dashicons-image-flip-horizontal'
		);

		$args += $this->settings['post_type_settings'];

		register_post_type(
			$this->settings['post_type_name'],
			$args
		);		
	}

	/*
		Attach the meta boxes to the post type
	*/
	function attach_metaboxes() {
	
		add_meta_box(
			$this->settings['post_type_name'] . '-default-box',
			'Add Slides',
			array($this, 'display_default_box'),
			$this->settings['post_type_name'],
			'normal',
			'high'
		);
		
	}

	/*
		Displays the default slides box
	*/
	function display_default_box($post) {
		add_action('admin_footer', array($this, 'init_js'), 100);

		$this->post_id = $_REQUEST['post_id'] = $post->ID;

		$prototype = array(
			'title'        => '',
			'image_id'     => '',
			'content'     => '',
			'button_text' => '',
			'button_link' => '',
			'prototype'   => true
		);

		$items = get_post_meta($post->ID, '_slides', true);

		if(!$items || !is_array($items)) {
			$first_item = $prototype;
			unset($first_item['prototype']);

			$items = array($first_item);
		}

		$items['prototype'] = $prototype;

		include('template.php');
	}
}

global $custom_slider;
$custom_slider = new GymBoomSlider();