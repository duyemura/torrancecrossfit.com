<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<?php
			
	$video_link = get_post_meta($post->ID, '_video_link', true);
	if ($video_link) { $video_string = video_link_to_iframe($video_link); } else { $video_string = ''; }

	?>

	<section id="bottom">
		<section class="shell">
			<article id="content">
					
				<?php js_breadcrumbs($post->ID); ?>
				<h1><?php the_title(); ?></h1>
				
				<?php if ($video_string){ echo '<div class="video-block">'.$video_string.'</div>'; } ?>
				
				<?php the_content(); ?>
				<?php comments_template(); ?>
						
			</article>
		</section>
	</section>
</section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>