<?php

// Gallery Settings
$gallery_settings = new ECF_Panel('gallery_settings_panel', __('General Settings','gymboom'), 'gallery-items', 'normal', 'high');

$gallery_big_image = ECF_Field::factory('set', 'show_big_image', __('Show the large, full-width featured image at the top of the page?','gymboom'));
$gallery_big_image->add_options(array(true => __('Yes, display the large featured image at the top.','gymboom')));

$gallery_photo_count = ECF_Field::factory('text', '_photo_count', 'Override the Photo Count');
$gallery_photo_count->help_text(__('This theme counts the number of photos uploaded to the post. Sometimes this number doesn\'t line up with how many photos are actually in your gallery, so you can override that number here.','gymboom'));

$gallery_settings->add_fields(array(
	$gallery_big_image,$gallery_photo_count
));

?>