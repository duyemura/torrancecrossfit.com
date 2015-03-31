<?php

// Recent Posts
// ----------------------------------------------------
class ThemeWidgetRecentPosts extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetRecentPosts() {
		$widget_opts = array(
			'classname' => 'theme-widget-recent-posts', // class of the <li> holder
			'description' => __( 'Displays recent posts in a custom style.','gymboom' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-recent-posts', __('[GYMBOOM] Recent Posts','gymboom'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Recent Posts','gymboom')
			),
			array(
				'name'=>'desc',
				'type'=>'text',
				'title'=>'Description', 
				'default'=>__('This is a short description.','gymboom')
			),
			array(
				'name'=>'categories',
				'type'=>'multiCategories',
				'title'=>__('Select Categories','gymboom'),
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
			),
			array(
				'name'=>'hide_thumbs',
				'type'=>'set',
				'title'=>'Hide thumbnails?', 
				'default'=>'',
				'options'=>array(true=>'Yes')
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		extract($args);
		
		$limit = intval($instance['load']);
		$title = $instance['title'];
		$desc = $instance['desc'];
		$hide_thumbs = $instance['hide_thumbs'];
		$categories = $instance['categories'];
		if ($categories) { $categories = implode(",",$categories); }
		
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
		
		query_posts(array('posts_per_page'=>$limit, 'cat'=>$categories));
		if ( have_posts() ) : ?>
		
			<div class="recent-widget" rel="<?php echo intval($instance['show']); ?>">
				<?php echo $before_title.$title.$after_title; ?>

				<span class="prev"></span>
				<span class="next"></span>

				<ul>
				
				<?php $temp_counter = 0;
				while ( have_posts() ) : the_post(); global $post; $temp_counter++; ?>
				
					<li>
						<div class="item"<?php if ($hide_thumbs || !has_post_thumbnail($post->ID)){ ?> style="padding-left:0; width:100%;"<?php } ?>>
							<?php if (!$hide_thumbs && has_post_thumbnail($post->ID)){ ?>
								<a href="<?php the_permalink() ?>"><?php
								$featured_caption = get_the_title($post->ID);
								$featured_image = get_the_post_thumbnail($post->ID);
								echo $featured_image;
								?></a>
							<?php } ?>
							
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<h6><?php _e('Posted by','gymboom'); ?> <strong><?php the_author(); ?></strong> <?php _e('on','gymboom'); ?> <strong><?php the_time('F j, Y'); ?></strong></h6>
							<?php the_excerpt(); ?>
						</div>
					</li>
					
				<?php endwhile
				?></ul></div><?php
						
		endif; wp_reset_query();
		
	}
}

?>