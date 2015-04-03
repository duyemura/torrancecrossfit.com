<?php

// Upcoming Events
// ----------------------------------------------------
class ThemeWidgetUpcomingEvents extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetUpcomingEvents() {
	
		global $aec;
		$aec_categories = $aec->db_query_categories();
		
		foreach($aec_categories as $category){
			$aec_category_array[$category->id] = $category->category;
		}
	
		$widget_opts = array(
			'classname' => 'theme-widget-upcoming-events', // class of the <li> holder
			'description' => __( 'Display one or more upcoming events.','gymboom'));
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-widget-upcoming-events', __('[GYMBOOM] Upcoming Events','gymboom'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','gymboom'), 
				'default'=>__('Upcoming Events','gymboom')
			),
			array(
				'name'=>'event_categories',
				'type'=>'set',
				'options'=>$aec_category_array,
				'title'=>__('Event Categories','gymboom'), 
				'default'=>false
			),
			array(
				'name'=>'time_date',
				'type'=>'select',
				'options'=>array(
					'time' => 'Time',
					'date' => 'Date'
				),
				'title'=>__('Show time or date?','gymboom'), 
				'default'=>'time'
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many total items?','gymboom'), 
				'default'=>'10'
			),
			array(
				'name'=>'show',
				'type'=>'integer',
				'title'=>__('How many visible items?','gymboom'), 
				'default'=>'3'
			)
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
	
		extract($args);
		
		$limit = intval($instance['load']);
		$title = $instance['title'];
		$categories = $instance['event_categories'];
		if (is_array($categories)){ $categories = implode(',',$instance['event_categories']); } else { $categories = false; }
		
		$event_list = get_upcoming_events($limit,$categories);
		
		global $template_dir;
		
		if (!empty($event_list)):
		
			?><li class="upcoming-widget" rel="<?php echo intval($instance['show']); ?>">
			<?php echo $before_title.$title.$after_title; ?>
			<section class="container">
				<ul class="slides"><?php
				
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
	
					$start_day = date_i18n('F j', $start_date);
					$end_day = date_i18n('F j', $end_date);
					
					if ($start_day == $end_day): $same_day = true; else: $same_day = false; endif;
						
					$time_format = get_option('time_format'); ?>
				
					<li><a href="#" class="event-link" onclick="jQuery.aecDialog({'cat':7,'id':<?php echo $event['id']; ?>,'start':'<?php echo $event['start']; ?>','end':'<?php echo $event['end']; ?>'}); return false;"><span class="icon"><img src="<?php echo $template_dir; ?>/_theme_styles/images/clock.png" alt="" /></span> <span class="right">
						<?php if (isset($instance['time_date']) && $instance['time_date'] == 'date'){
							echo $start_day;
						} else {
							if ($allday):
								_e('All day','gymboom');
							else :
								echo date_i18n($time_format,$start_date); if ($same_day): echo ' - '.date_i18n($time_format,$end_date); endif;
							endif;
						} ?>
					</span> <strong><?php echo $title; ?></strong></a></li>
					
				<?php endforeach;
					
				echo '</ul></section>';
	
			?></li><?php
			
		endif;
				
	}
}

?>