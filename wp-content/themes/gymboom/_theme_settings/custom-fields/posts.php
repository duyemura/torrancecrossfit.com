<?php

// Featured Image Option
$featured_image_option = ECF_Field::factory('set', 'display_featured_image', __('Display the large, full-width featured image at the top of the page?','gymboom'));
$featured_image_option->add_options(array(true => 'Yes, display the featured image at the top.'));
	
$post_option_panel = new ECF_Panel('post_option_panel', __('Post Settings','gymboom'), 'post', 'normal', 'high');
$post_option_panel->add_fields(array($featured_image_option));

?>