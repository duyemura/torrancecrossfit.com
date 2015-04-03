<?php

get_header(); global $template_dir,$page_id;

$page_id = $post->ID;
	
if (have_posts()) : while(have_posts()) : the_post();

	get_template_part('inc/slider-or-image');
	
	// Sidebar Settings
	$sidebar_layout = get_post_meta($page_id, '_sidebar_layout', true);
	$sidebar_layout = $sidebar_layout ? $sidebar_layout[0] : 'no-sidebar';
	$sidebar_choice = get_post_meta($page_id, '_sidebar_choice', true);
	
	$other_options = get_post_meta($page_id, '_page_options',true);
	
	$content = get_the_content($page_id);
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
					<?php if (!is_array($other_options) || is_array($other_options) && !in_array('hide_breadcrumbs',$other_options)): js_breadcrumbs($page_id); endif; ?>
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
	
	get_template_part('inc/below-content'); ?>

</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>