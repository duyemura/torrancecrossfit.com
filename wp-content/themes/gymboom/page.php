<?php

get_header(); global $template_dir;
	
if (have_posts()) : while(have_posts()) : the_post();

	// Page Layout
	$page_layout = get_post_meta($post->ID, '_page_layout', true);
	$page_layout = $page_layout ? $page_layout[0] : 'testimonials_featured_widgets';
	$page_layout_order = explode('_',$page_layout);
	$page_content = get_the_content($post->ID);

	$other_options = get_post_meta($post->ID, '_page_options', true);
	
	// Page Widget Settings
	$widget_layout = get_post_meta($post->ID, '_widget_layout', true);
	$widget_layout = $widget_layout ? $widget_layout[0] : 'no-widgets';
	
	// Page Widget Settings
	$feature_block_layout = get_post_meta($post->ID, '_feature_block_layout', true);
	$feature_block_layout = $feature_block_layout ? $feature_block_layout[0] : 'no-features';
	
	// Sidebar Settings
	$sidebar_layout = get_post_meta($post->ID, '_sidebar_layout', true);
	$sidebar_layout = $sidebar_layout ? $sidebar_layout[0] : 'no-sidebar';
	$sidebar_choice = get_post_meta($post->ID, '_sidebar_choice', true);
	
	$featured_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-banner' );
	$featured_thumbnail_src = $featured_thumbnail_src[0];
	
	if ($featured_thumbnail_src) { ?>
		<section class="top-image" style="background:url('<?php echo $featured_thumbnail_src; ?>') no-repeat top center;"></section>
	<?php }
	
	gymboom_slider($post);
	
	$content = get_the_content($post->ID);
	if ($content):
		
		if ($sidebar_layout == 'no-sidebar'){
			$content_post_class = '';
		} else if ($sidebar_layout == 'left'){
			$content_post_class = 'right';
			$sidebar_post_class = 'left';
		} else if ($sidebar_layout == 'right'){
			$content_post_class = 'left';
			$sidebar_post_class = 'right';
		}
		
		if (!isset($other_options)){
			$other_options = false;
		}
	
		?>
		
		<section id="bottom">
			<section class="shell">
			
				<article id="content" <?php post_class($content_post_class); ?>>
					<?php if (!is_array($other_options) || is_array($other_options) && !in_array('hide_breadcrumbs',$other_options)): js_breadcrumbs($post->ID); endif; ?>
					<?php if (!is_array($other_options) || is_array($other_options) && !in_array('hide_title',$other_options)): ?><h1><?php the_title(); ?></h1><?php endif; ?>
					
					<?php the_content(); ?>
					<?php comments_template(); ?>
				</article>
				
				<?php if ($sidebar_layout != 'no-sidebar'){ ?>
					<aside id="sidebar" class="<?php echo $sidebar_post_class; ?>">
						<?php dynamic_sidebar($sidebar_choice); ?>				
					</aside>
					<div class="cl"></div>
				<?php } ?>
				
			</section>
		</section>
		<?php
	
	endif;
	
	// Loop through page layout pieces
	foreach ($page_layout_order as $layout_type){
		
		// Add double lines where they look good
		if (isset($previous_layout_type) && $layout_type == 'page' && $previous_layout_type == 'widgets' || isset($previous_layout_type) && $layout_type == 'widgets' && $previous_layout_type == 'page' && $page_content ){
			$include_hr = true;
		} else {
			$include_hr = false;
		}
		
		// Load the page piece
		call_user_func_array('page_part_'.$layout_type,array($post->ID,$include_hr));
		$previous_layout_type = $layout_type;
		
	}
	?>

</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>