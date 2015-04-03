<?php get_header(); ?>

<?php $page_for_posts = get_option('page_for_posts'); if ($page_for_posts):
	
	global $page_id;
	$page_id = $page_for_posts;
	
	get_template_part('inc/slider-or-image');
	
	// Sidebar Settings
	$sidebar_layout = get_post_meta($page_for_posts, '_sidebar_layout', true);
	$sidebar_layout = $sidebar_layout ? $sidebar_layout[0] : 'no-sidebar';
	$sidebar_choice = get_post_meta($page_for_posts, '_sidebar_choice', true);
	
	$other_options = get_post_meta($page_id, '_page_options',true);
	
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
				<?php if (!is_array($other_options) || is_array($other_options) && !in_array('hide_breadcrumbs',$other_options)): js_breadcrumbs($page_for_posts); endif; ?>
				<?php if (!is_array($other_options) || is_array($other_options) && !in_array('hide_title',$other_options)): ?><h1><?php echo get_the_title($page_for_posts); ?></h1><?php endif; ?>
				<?php get_template_part('loop','posts'); ?>
				<?php js_get_pagination(); wp_reset_query(); ?>
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
	
	get_template_part('inc/below-content'); 

else:

	?><section id="bottom">
		<section class="shell">
			<article id="content" <?php post_class('news-feed two_third'); ?>><?php
		
				get_template_part('loop','posts');
				
			?></article>
	
			<aside class="one_third last">
				<?php get_sidebar(); ?>	
			</aside>
			<?php js_get_pagination(); wp_reset_query(); ?>
		</section>
	</section><?php

endif; ?>
			
<?php get_footer(); ?>