<?php



// ----------------------------------------------------------------------------------------------------
// Shortcode Button/Form

class Custom_Shortcodes_Upcoming
{
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit upcoming and pages
		if ( current_user_can( 'edit_upcoming' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons_3', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		array_push( $buttons, '', 'js_upcoming_button' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		// this plugin file will work the magic of our button
		$plugins['js_upcoming'] = get_template_directory_uri() . '/_theme_settings/shortcodes/upcoming/script.js';
		return $plugins;
	}
}

$upcoming = new Custom_Shortcodes_Upcoming();



// ----------------------------------------------------------------------------------------------------
// Shortcode Display

function js_display_upcoming( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'count' => 5
	), $atts ) );
			
	$count = intval($count);
	$event_list = get_upcoming_events($count);
	
	ob_start();
	
	if (!empty($event_list)):
		
		echo '<div class="event-shortcode">';
			
		foreach($event_list as $event):
	
			$start_date = strtotime($event['start']);
			$end_date = strtotime($event['end']);
			$title = $event['title'];
			$venue = $event['venue'];
			$allday = $event['allday'];
			
			$start_date_compare = date('Ymd',$start_date);
			$today = strftime('%Y%m%d',strtotime('now'));
			
			if (!$allday && $start_date_compare == $today){
				$start_time = date('Gi',$start_date);
				$end_time = date('Gi',$end_date);
				$current_time = strftime('%H%M');
				if ($start_time < $current_time){
					continue;
				}
			}

			$start_day = date('F j', $start_date);
			$end_day = date('F j', $end_date);
			
			if ($start_day == $end_day): $same_day = true; else: $same_day = false; endif;
				
			$date_format = get_option('date_format').', '.get_option('time_format');
			$date_format_b = get_option('time_format'); ?>
		
			<a href="#" class="event-link" onclick="jQuery.aecDialog({'id':<?php echo $event['id']; ?>,'start':'<?php echo $event['start']; ?>','end':'<?php echo $event['end']; ?>'}); return false;"><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/_theme_styles/images/clock.png" alt="" /></span> <span class="right">
				<?php if ($allday): ?>
					<?php _e('All day','gymboom'); ?>
				<?php else : ?>
					<?php echo date_i18n($date_format,$start_date); if ($same_day): echo ' - '.date_i18n($date_format_b,$end_date); endif; ?>
				<?php endif; ?>
			</span> <strong><?php echo $title; ?></strong></a>
			
		<?php endforeach;
		
		echo '</div>';
		
	endif;
	
	return ob_get_clean();
	
}
add_shortcode( 'upcoming-events', 'js_display_upcoming' );

?>