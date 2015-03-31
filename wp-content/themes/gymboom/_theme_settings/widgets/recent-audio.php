<?php

// Recent Media Items
// ----------------------------------------------------
class ThemeWidgetAudioItems extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetAudioItems() {
	
		$widget_opts = array(
			'classname' => 'theme-widget-audio-items', // class of the <li> holder
			'description' => __( 'Display one or more recent audio items.','gymboom'));
			
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		
		$args = array('type' => 'audio-item','taxonomy' => 'audio');
		$audio_categories = get_categories($args);
		
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-widget-audio-items', __('[GYMBOOM] Recent Audio Items','gymboom'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','gymboom'), 
				'default'=>__('Recent Sermons','gymboom')
			),
			array(
				'name'=>'categories',
				'type'=>'customCategories',
				'options'=>array(
					'post_type'=>'audio-item',
					'taxonomy'=>'audio'
				),
				'title'=>__('Audio Categories','gymboom'),
				'default'=>''
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
	
		extract($args);
		
		$limit = intval($instance['load']);
		$title = $instance['title'];
		$categories = $instance['categories'];
		$category_array = array();
		$category_list = array();
		
		if (!$categories) {
			$category_list = array();
			$audio_cats = get_categories(array('type' => 'audio-items','hide_empty'=>0,'taxonomy'=>'audio'));
			foreach($audio_cats as $audio_cat){
				$category_array[] = $audio_cat->slug;
			}
		} else {
			foreach($categories as $id){
				$term = get_term($id,'audio');
				$category_array[] = $term->slug;
			}
		}
			
		$all_posts = array(
			'post_type' => 'audio-items',
		    'posts_per_page' => $limit,
		    'audio' => implode(',',$category_array),
		    'orderby' => 'id',
		    'order' => 'DESC'
		);
		query_posts($all_posts);
		
		if ( have_posts() ) :
		
			?><div class="sermons-widget" rel="<?php echo intval($instance['show']); ?>"><?php
				
				echo $before_title.$title.$after_title;

				?><span class="prev"></span>
				<span class="next"></span>

				<ul id="audio-<?php echo $widget_id; ?>"><?php
				
					$temp_counter = 0;
					while ( have_posts() ) : the_post(); global $post; $temp_counter++;
					
						if (get_post_meta($post->ID, '_file_mp3', true)){
							$audio_file = home_url() . '/wp-content/uploads/'.get_post_meta($post->ID, '_file_mp3', true);
						} else if (get_post_meta($post->ID, '_file_external_mp3', true)){
							$audio_file = get_post_meta($post->ID, '_file_external_mp3', true);
						} else {
							$audio_file = '';	
						} ?>
						
						<li>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							<h6>Posted by <?php the_author(); ?> on <?php the_time('F j, Y'); ?></h6>
							<a href="#" class="button-small white play" data-src="<?php echo $audio_file; ?>"><?php _e('Play Audio','gymboom'); ?></a>
						</li><?php

					endwhile;
			
			?></ul></div><?php
						
		endif; wp_reset_query();
		
	}
}

?>