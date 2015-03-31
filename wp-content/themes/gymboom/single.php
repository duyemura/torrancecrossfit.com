<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();

	$show_big_image = get_post_meta($post->ID, '_display_featured_image', true);
	$featured_thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-banner' );
	$featured_thumbnail_src = $featured_thumbnail_src[0];
	
	if ($featured_thumbnail_src && $show_big_image) { ?>
		<section class="top-image" style="background:url('<?php echo $featured_thumbnail_src; ?>') no-repeat top center;"></section>
	<?php } ?>
	
	<section id="bottom">
		<section class="shell">
			<article id="content" class="left">
					
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>
				
				<?php the_tags('<small><strong>Tags:</strong> ', ', ', '</small>'); ?>
				
				<?php comments_template(); ?>
				
			</article>
				
			<aside id="sidebar" class="right">
				<?php get_sidebar(); ?>				
			</aside>
			
			<div class="cl"></div>
			
		</section>
	</section>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>