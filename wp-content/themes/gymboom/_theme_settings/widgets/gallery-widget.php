<?php

// Recent Media Items
// ----------------------------------------------------
class ThemeWidgetGalleryItems extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetGalleryItems() {
	
		$widget_opts = array(
			'classname' => 'theme-widget-gallery-items', // class of the <li> holder
			'description' => __( 'Display one or more recent gallery items.','gymboom'));
			
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		
		$args = array('type' => 'gallery-item','taxonomy' => 'gallery');
		$gallery_categories = get_categories($args);
		
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-galleries', __('[GYMBOOM] Gallery Widget','gymboom'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','gymboom'), 
				'default'=>__('Galleries','gymboom')
			),
			array(
				'name'=>'categories',
				'type'=>'customCategories',
				'options'=>array(
					'post_type'=>'gallery-items',
					'taxonomy'=>'galleries'
				),
				'title'=>__('Gallery Categories','gymboom'),
				'default'=>''
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many thumbnails to show?','gymboom'), 
				'default'=>'10'
			),
			array(
				'name'=>'sort_by',
				'type'=>'select',
				'title'=>'Sort by', 
				'default'=>'',
				'options'=>array(
					'rand'=>'Random',
					'name'=>'Title',
					'date'=>'Date Added',
					'menu_order'=>'Menu Order'
				)
			),
			array(
				'name'=>'order',
				'type'=>'select',
				'title'=>'Order', 
				'default'=>'',
				'options'=>array(
					'desc'=>'Descending',
					'asc'=>'Ascending'
				)
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>'Button Text (optional)', 
				'default'=>''
			),
			array(
				'name'=>'button_url',
				'type'=>'text',
				'title'=>'Button URL (optional)', 
				'default'=>''
			),
			array(
				'name'=>'new_window',
				'type'=>'set',
				'title'=>'Open button URL in a new window?', 
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
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$category_array = array();
		$category_list = array();
		
		$limit = intval($instance['load']);
		$sort_by = $instance['sort_by'];
		$order = $instance['order'];
		
		$button_text = $instance['button_text'];
		$button_url = $instance['button_url'];
		$new_window = $instance['new_window'];
		
		if (!$categories) {
			$category_list = array();
			$gallery_cats = get_categories(array('type' => 'gallery-items','hide_empty'=>0,'taxonomy'=>'galleries'));
			foreach($gallery_cats as $gallery_cat){
				$category_array[] = $gallery_cat->slug;
			}
		} else {
			foreach($categories as $id){
				$term = get_term($id,'galleries');
				$category_array[] = $term->slug;
			}
		}
			
		$all_posts = array(
			'post_type' => 'gallery-items',
		    'posts_per_page' => $limit,
		    'gallery' => implode(',',$category_array),
		    'orderby' => $sort_by,
		    'order' => $order
		);
		query_posts($all_posts);
		
		if ( have_posts() ) :
		
			?><div class="gallery-widget gallery" rel="<?php echo intval($show); ?>"><?php
				
				echo $before_title.$title.$after_title; ?>

				<?php if ($button_url || $button_text) {
					?><a href="<?php echo $button_url; ?>"<?php if ($new_window){ ?>target="_blank"<?php } ?> class="widget-button"><?php echo $button_text; ?></a><?php
				} ?>

				<ul id="gallery-<?php echo $widget_id; ?>"><?php
				
					while ( have_posts() ) : the_post(); global $post;
					
						$photo_count_override = get_post_meta($post->ID, '_photo_count', true);
						if ($photo_count_override):
							$total_attachments = $photo_count_override;
						else :
							$attachments = get_children( array( 'post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) );
							$total_attachments = count( $attachments );
						endif;
						
						?>
						
						<div class="gallery-thumb">
							
							<?php echo '<a href="'.get_permalink($post->ID).'">';
								if (has_post_thumbnail($post->ID)){
									echo get_the_post_thumbnail($post->ID,'gallery-medium');
								} else {
									echo '<img width="220" height="148" src="'.get_template_directory_uri().'/_theme_styles/images/default_medium_thumb.jpg" />';
								} ?>
								
								<span class="caption"><?php the_title(); ?></span>
								<span class="gallery-icon"><?php echo $total_attachments; ?></span>
								
							<?php echo '</a>'; ?>

						</div><?php

					endwhile;
			
			?></ul></div><div class="cl"></div><?php
						
		endif; wp_reset_query();
		
	}
}

?>