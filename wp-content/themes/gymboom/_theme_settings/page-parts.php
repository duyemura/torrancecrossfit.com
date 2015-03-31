<?php

// Tetsimonials
function page_part_testimonials($post_id,$include_hr = false, $bottom = false){

	global $template_dir;
	
	$show_testimonials = get_post_meta($post_id, '_display_testimonials', true);
	
	if ($show_testimonials):
	
		$show_testimonials = $show_testimonials[0];
	
		?><section id="testimonials">
		<ul class="slides"><?php
		
		$category = get_post_meta($post_id, '_testimonial_category', true);
		$orderby = get_post_meta($post_id, '_testimonial_sort_by', true);
		$order = get_post_meta($post_id, '_testimonial_sort_order', true);
	
		$args = array( 'post_type' => 'testimonial-items', 'numberposts' => -1, 'orderby' => $orderby, 'order' => $order);
		if ($category){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'testimonials',
					'field' => 'id',
					'terms' => $category
					)
				);
		}
		
		$posts = get_posts($args);
		if ($posts) {
			
			foreach ( $posts as $post ) {
	
				?><li>
					<section class="shell<?php if (!has_post_thumbnail($post->ID)){ echo ' no-thumb'; } ?>">
						<?php if (has_post_thumbnail($post->ID)){
							echo get_the_post_thumbnail($post->ID,'testimonial-thumb');
						} ?>
						<h3>&ldquo;<?php echo get_post_meta($post->ID, '_content', true); ?>&rdquo;</h3>
						<p><strong>&mdash; <?php echo get_post_meta($post->ID, '_person', true); ?></strong><?php if (get_post_meta($post->ID, '_company', true)){ ?>, <em><?php echo get_post_meta($post->ID, '_company', true); ?></em><?php } ?></p>
					</section>
				</li><?php
				
			}
			
		}
			
		?></ul></section><?php
	
	endif;

}

// Page Content
function page_part_featured($post_id,$include_hr = false, $bottom = false){

	global $feature_block_layout;

	if ($feature_block_layout != 'no-features'){
	
		?><section id="features"><section class="shell"><?php
	
		$temp_count = 1;
		if ($feature_block_layout == 'one-feature'){ $total_features = 1; } else { $total_features = 2; }
		
		do {

			$title = get_post_meta($post_id, '_feature_'.$temp_count.'_title', true);
			$subtitle = get_post_meta($post_id, '_feature_'.$temp_count.'_subtitle', true);
			$content = get_post_meta($post_id, '_feature_'.$temp_count.'_content', true);
			$button_1_text = get_post_meta($post_id, '_feature_'.$temp_count.'_button_1_text', true);
			$button_1_link = get_post_meta($post_id, '_feature_'.$temp_count.'_button_1_link', true);
			$button_2_text = get_post_meta($post_id, '_feature_'.$temp_count.'_button_2_text', true);
			$button_2_link = get_post_meta($post_id, '_feature_'.$temp_count.'_button_2_link', true);

			if ($total_features == 2){ echo '<section class="one_half'.($temp_count == 2 ? ' last' : '').'">'; } else { echo '<section class="one_whole">'; } ?>
				<h2><?php echo $title; ?></h2>
				<h3><?php echo $subtitle; ?></h3>

				<?php echo wpautop($content); ?>

				<?php if ($button_1_link && $button_1_text){ ?><a href="<?php echo $button_1_link; ?>" class="gb-button"><?php echo $button_1_text; ?></a><?php } ?>
				<?php if ($button_2_link && $button_2_text){ ?><a href="<?php echo $button_2_link; ?>" class="gb-button grey"><?php echo $button_2_text; ?></a><?php } ?>
			</section>

			<?php
			
			$temp_count++;
		
		} while ($temp_count <= $total_features);
		
		?></section></section><?php
	
	}

}

// Page Widgets
function page_part_widgets($post_id,$include_hr = false, $bottom = false){

	global $widget_layout;
	
	if ($widget_layout != 'no-widgets'){
	
		$zone_1_widget = (get_post_meta($post_id, '_widget_block_1',true) ? get_post_meta($post_id, '_widget_block_1',true) : 1);
		$zone_2_widget = (get_post_meta($post_id, '_widget_block_2',true) ? get_post_meta($post_id, '_widget_block_2',true) : 2);
		$zone_3_widget = (get_post_meta($post_id, '_widget_block_3',true) ? get_post_meta($post_id, '_widget_block_3',true) : 3);
		
		if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget) || is_active_sidebar('page-block-'.$zone_3_widget)){ ?>
	
		<section id="bottom"><div class="shell"><?php
				
			if ($include_hr){ echo '<hr class="doubleline" />'; }
		
			switch ($widget_layout) {
			
				case 'one' :
				
					if (is_active_sidebar('page-block-'.$zone_1_widget)){
						
						dynamic_sidebar('page-block-'.$zone_1_widget);
						
					}
				
				break;
				
				case 'two' :
				
					if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
						
						echo '<div class="one_half">';
							dynamic_sidebar('page-block-'.$zone_1_widget);
						echo '</div>';
						
						echo '<div class="one_half last">';
							dynamic_sidebar('page-block-'.$zone_2_widget);
						echo '</div>';
						
					}
				
				break;
				
				case 'three' :
				
					if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget) || is_active_sidebar('page-block-'.$zone_3_widget)){
						
						echo '<div class="one_third">';
							dynamic_sidebar('page-block-'.$zone_1_widget);
						echo '</div>';
						
						echo '<div class="one_third">';
							dynamic_sidebar('page-block-'.$zone_2_widget);
						echo '</div>';
						
						echo '<div class="one_third last">';
							dynamic_sidebar('page-block-'.$zone_3_widget);
						echo '</div>';
						
					}
				
				break;
				
				case 'onethird_twothird' :
				
					if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
						
						echo '<div class="one_third">';
							dynamic_sidebar('page-block-'.$zone_1_widget);
						echo '</div>';
						
						echo '<div class="two_third last">';
							dynamic_sidebar('page-block-'.$zone_2_widget);
						echo '</div>';
						
					}
				
				break;
				
				case 'twothird_onethird' :
				
					if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
						
						echo '<div class="two_third">';
							dynamic_sidebar('page-block-'.$zone_1_widget);
						echo '</div>';
						
						echo '<div class="one_third last">';
							dynamic_sidebar('page-block-'.$zone_2_widget);
						echo '</div>';
						
					}
				
				break;
				
			}
			
		?></div></section><?php }
		
	}
	
}

?>