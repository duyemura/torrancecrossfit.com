<?php



// Load the CSS for the custom shortcode forms
function js_shortcode_admin_head() {
	
	$template_dir = get_template_directory_uri(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $template_dir; ?>/_theme_settings/shortcodes/admin-styles.css"><?php
	
	// Get all post categories
	$post_categories = get_categories(array('type' => 'post'));
	
	// Get all gallery categories
	$gallery_categories = get_terms('galleries', array('orderby' => 'name', 'order' => 'ASC'));
	
	// Get all audio categories
	$video_categories = get_terms('videos', array('orderby' => 'name', 'order' => 'ASC'));
	
	if (class_exists('ajax_event_calendar')) {
		// Load event list
		global $aec;
		$event_array = events_dropdown_data($aec);
	}

	?><script type="text/javascript">
		var postCategories = {
		
			<?php foreach ($post_categories as $category){
				?>"<?php echo $category->term_id; ?>" : '<?php echo $category->name; ?>',<?php
			} ?>
		
		};
		var galleryCategories = {
		
			<?php foreach ($gallery_categories as $category){
				?>"<?php echo $category->term_id; ?>" : '<?php echo $category->name; ?>',<?php
			} ?>
		
		};
		var videoCategories = {
		
			<?php foreach ($video_categories as $category){
				?>"<?php echo $category->term_id; ?>" : '<?php echo $category->name; ?>',<?php
			} ?>
		
		};
		<?php if (class_exists('ajax_event_calendar')) { ?>
			var eventList = {
			
				<?php foreach ($event_array as $event_id => $event){
					if ($event_id != 'next'){
						?>"<?php echo $event_id; ?>" : '<?php echo $event; ?>',<?php
					}
				} ?>
			
			};
		<?php } ?>
 	</script><?php

}

add_action('admin_head', 'js_shortcode_admin_head');


// Load the Shortcodes
include('shortcodes/columns/columns.php');
include('shortcodes/highlight/highlight.php');
include('shortcodes/galleries/galleries.php');

include('shortcodes/posts/posts.php');
include('shortcodes/gallery-posts/gallery-posts.php');
include('shortcodes/video-posts/video-posts.php');

if (class_exists('ajax_event_calendar')) {

	// Disable the events when the module is not enabled in the administration
	global $aec;
	$event_array = events_dropdown_data($aec);
	
	if (!empty($event_array)):
		include('shortcodes/calendar/calendar.php');
		include('shortcodes/upcoming/upcoming.php');
		include('shortcodes/event/event.php');
	endif;
	
}

?>