<?php



// Page Layout
$page_layout = ECF_Field::factory('imageradio', 'page_layout', __('Page Layout','gymboom') );
$page_layout->add_options(array(
		'testimonials_featured_widgets'=>get_template_directory_uri().'/_theme_settings/images/page_layout_01.png',
		'featured_testimonials_widgets'=>get_template_directory_uri().'/_theme_settings/images/page_layout_02.png',
		'featured_widgets_testimonials'=>get_template_directory_uri().'/_theme_settings/images/page_layout_03.png',
		'widgets_featured_testimonials'=>get_template_directory_uri().'/_theme_settings/images/page_layout_04.png',
		'testimonials_widgets_featured'=>get_template_directory_uri().'/_theme_settings/images/page_layout_05.png',
		'widgets_testimonials_featured'=>get_template_directory_uri().'/_theme_settings/images/page_layout_06.png',
	))->help_text(__('Individual blocks can be hidden using the other options on this page.','gymboom'));
	
$page_options = ECF_Field::factory('set', 'page_options', __('Other Options','gymboom') );
$page_options->add_options(array('hide_breadcrumbs' => __('Hide the breadcrumbs above the title.','gymboom'), 'hide_title' => __('Hide the page title.','gymboom')));

$page_settings_panel = new ECF_Panel('page_settings_panel', __('Page Settings','gymboom'), 'page', 'normal', 'high');
$page_settings_panel->add_fields(array($page_layout,$page_options));




// Slider Setting
$slider_items = post_array('custom-slider');

// Is the "Slider Revolution plugin installed?
if (class_exists('RevSlider')):

	// Get any "Slider Revolution" sliders that are built out, if any.
	$temp_count = 0;				
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	if (!empty($arrSliders)):
		foreach($arrSliders as $slider):
				
			$title = $slider->getTitle();
			$alias = $slider->getAlias();
			$revSliders['REVSLIDER---'.$alias] = 'REVOLUTION: '.$title;
			$temp_count++;
				
		endforeach;
	endif;
	
endif;

// Add Revolution sliders to the array, if any
if (!empty($revSliders)):
	$slider_items = array_merge($slider_items,$revSliders);
endif;

$slider_choice = ECF_Field::factory('select', 'slider_choice', __('Slider to display:','gymboom'));
$slider_choice->add_options($slider_items);
$slider_choice->help_text('<a href="post-new.php?post_type=custom-slider">'.__('Create a new slider','gymboom').'</a>');

$slider_settings_panel = new ECF_Panel('slider_settings_panel', __('Slider Settings','gymboom'), 'page', 'normal', 'high');
$slider_settings_panel->add_fields(array($slider_choice));




// Testimonials Settings
$display_testimonials = ECF_Field::factory('set', 'display_testimonials', __('Testimonial Display','gymboom') );
$display_testimonials->add_options(array(true => __('Show the testimonials block.','gymboom')));
$display_testimonials->set_default_value(false);

$testimonial_categories = get_categories(array('type' => 'testimonial-items','taxonomy' => 'testimonials'));
$category_array[''] = 'All Categories';
foreach($testimonial_categories as $cat){
	$category_array[$cat->cat_ID] = $cat->name;
}
$testimonial_category = ECF_Field::factory('select', 'testimonial_category', __('Testimonial Category to Display:','gymboom'));
$testimonial_category->add_options($category_array);

$testimonial_sort_by = ECF_Field::factory('select', 'testimonial_sort_by', __('Sort by:','gymboom'));
$testimonial_sort_by->add_options(array('rand' => 'Random','date' => 'Date','menu_order' => 'Menu Order'));

$testimonial_sort_order = ECF_Field::factory('select', 'testimonial_sort_order', __('Sort order:','gymboom'));
$testimonial_sort_order->add_options(array('desc' => 'Descending','asc' => 'Ascending'));

$testimonials_settings_panel = new ECF_Panel('testimonials_settings_panel', __('Testimonials Settings','gymboom'), 'page', 'normal', 'high');
$testimonials_settings_panel->add_fields(array($display_testimonials,$testimonial_category,$testimonial_sort_by,$testimonial_sort_order));




// Sidebar Settings
$sidebar_layout = ECF_Field::factory('imageradio', 'sidebar_layout', __('Sidebar Layout','gymboom') );
$sidebar_layout->add_options(array(
		'no-sidebar'=>get_template_directory_uri().'/_theme_settings/images/sidebar_none.png',
		'left'=>get_template_directory_uri().'/_theme_settings/images/sidebar_left.png',
		'right'=>get_template_directory_uri().'/_theme_settings/images/sidebar_right.png',
	));

global $wp_registered_sidebars;
$sidebar_dropdown_elements = array();
foreach($wp_registered_sidebars as $sidebar_id => $sidebar){
	$sidebar_dropdown_elements[$sidebar['id']] = $sidebar['name'];	
}

// Sidebar Choice
$sidebar_choice = ECF_Field::factory('select', 'sidebar_choice', __('Choose a sidebar:','gymboom'));
$sidebar_choice->add_options($sidebar_dropdown_elements);
	
$sidebar_settings_panel = new ECF_Panel('sidebar_settings_panel', __('Sidebar Settings','gymboom'), 'page', 'normal', 'high');
$sidebar_settings_panel->add_fields(array($sidebar_layout,$sidebar_choice));




// "Feature" Block Layout
$features_layout = ECF_Field::factory('imageradio', 'feature_block_layout', __('"Features" Block Layout','gymboom') );
$features_layout->add_options(array(
	'no-features'=>get_template_directory_uri().'/_theme_settings/images/feature_columns_none.png',
	'one-feature'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_one.png',
	'two-features'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_two.png'
));

$feature_1_title = ECF_Field::factory('text', 'feature_1_title', 'Feature One - Title');
$feature_1_title->custom_class('one_half wrap-this-one');
$feature_1_subtitle = ECF_Field::factory('text', 'feature_1_subtitle', 'Feature One - Subtitle');
$feature_1_subtitle->custom_class('one_half last wrap-this-one');
$feature_1_content = ECF_Field::factory('textarea', 'feature_1_content', 'Feature One - Content');
$feature_1_content->custom_class('wrap-this-one');
$feature_1_button_1_text = ECF_Field::factory('text', 'feature_1_button_1_text', 'Feature One - Button One Text');
$feature_1_button_1_text->custom_class('one_fourth wrap-this-one');
$feature_1_button_1_link = ECF_Field::factory('text', 'feature_1_button_1_link', 'Feature One - Button One URL');
$feature_1_button_1_link->custom_class('one_fourth wrap-this-one');
$feature_1_button_2_text = ECF_Field::factory('text', 'feature_1_button_2_text', 'Feature One - Button Two Text');
$feature_1_button_2_text->custom_class('one_fourth wrap-this-one');
$feature_1_button_2_link = ECF_Field::factory('text', 'feature_1_button_2_link', 'Feature One - Button Two URL');
$feature_1_button_2_link->custom_class('one_fourth last wrap-this-one');

$feature_2_title = ECF_Field::factory('text', 'feature_2_title', 'Feature Two - Title');
$feature_2_title->custom_class('one_half wrap-this-two');
$feature_2_subtitle = ECF_Field::factory('text', 'feature_2_subtitle', 'Feature Two - Subtitle');
$feature_2_subtitle->custom_class('one_half last wrap-this-two');
$feature_2_content = ECF_Field::factory('textarea', 'feature_2_content', 'Feature Two - Content');
$feature_2_content->custom_class('wrap-this-two');
$feature_2_button_1_text = ECF_Field::factory('text', 'feature_2_button_1_text', 'Feature Two - Button One Text');
$feature_2_button_1_text->custom_class('one_fourth wrap-this-two');
$feature_2_button_1_link = ECF_Field::factory('text', 'feature_2_button_1_link', 'Feature Two - Button One URL');
$feature_2_button_1_link->custom_class('one_fourth wrap-this-two');
$feature_2_button_2_text = ECF_Field::factory('text', 'feature_2_button_2_text', 'Feature Two - Button Two Text');
$feature_2_button_2_text->custom_class('one_fourth wrap-this-two');
$feature_2_button_2_link = ECF_Field::factory('text', 'feature_2_button_2_link', 'Feature Two - Button Two URL');
$feature_2_button_2_link->custom_class('one_fourth last wrap-this-two');

$features_settings_panel = new ECF_Panel('features_settings_panel', __('"Features" Block Settings','gymboom'), 'page', 'normal', 'high');
$features_settings_panel->add_fields(array(
							$features_layout,
							$feature_1_title,
							$feature_1_subtitle,
							$feature_1_content,
							$feature_1_button_1_text,
							$feature_1_button_1_link,
							$feature_1_button_2_text,
							$feature_1_button_2_link,
							$feature_2_title,
							$feature_2_subtitle,
							$feature_2_content,
							$feature_2_button_1_text,
							$feature_2_button_1_link,
							$feature_2_button_2_text,
							$feature_2_button_2_link));




// Widget Layout
$widget_layout = ECF_Field::factory('imageradio', 'widget_layout', __('Page Widget Layout','gymboom') );
$widget_layout->add_options(array(
	'no-widgets'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_none.png',
	'one'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_one.png',
	'two'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_two.png',
	'three'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_three.png',
	'onethird_twothird'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_onethird_twothird.png',
	'twothird_onethird'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_twothird_onethird.png',
));
	
// Widget Block 1
$widget_block_1 = ECF_Field::factory('select', 'widget_block_1', __('Widget Block for ZONE 1:','gymboom'));
$widget_block_1->add_options(array(false=>'Default (Page Widget Block A)',2=>'Page Widget Block B',3=>'Page Widget Block C'));

// Widget Block 2
$widget_block_2 = ECF_Field::factory('select', 'widget_block_2', __('Widget Block for ZONE 2:','gymboom'));
$widget_block_2->add_options(array(false=>'Default (Page Widget Block B)',1=>'Page Widget Block A',3=>'Page Widget Block C'));

// Widget Block 3
$widget_block_3 = ECF_Field::factory('select', 'widget_block_3', __('Widget Block for ZONE 3:','gymboom'));
$widget_block_3->add_options(array(false=>'Default (Page Widget Block C)',1=>'Page Widget Block A',2=>'Page Widget Block B'));

$widget_settings_panel = new ECF_Panel('widget_settings_panel', __('Page Widget Settings','gymboom'), 'page', 'normal', 'high');
$widget_settings_panel->add_fields(array($widget_layout,$widget_block_1,$widget_block_2,$widget_block_3));

?>