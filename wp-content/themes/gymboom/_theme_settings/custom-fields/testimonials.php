<?php

// Panel for Testimonials
$testimonial_person = ECF_Field::factory('text', 'person', 'Person\'s Name');
$testimonial_company = ECF_Field::factory('text', 'company', 'Company Name (optional)');

$testimonial_content = ECF_Field::factory('textarea', 'content', 'Testimonial');
$testimonial_settings_panel = new ECF_Panel('testimonial_settings_panel', __('Testimonial Settings','gymboom'), 'testimonial-items', 'normal', 'high');
$testimonial_settings_panel->add_fields(array( $testimonial_person,$testimonial_company,$testimonial_content ));

?>