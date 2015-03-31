<?php get_header(); ?>

<section id="bottom">
	<section class="shell">
		<article id="content" <?php post_class('news-feed two_third'); ?>>
					
			<?php js_breadcrumbs($post->ID); ?>
			<h1>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<?php single_cat_title(); ?>
		
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<?php _e('Tagged','gymboom'); ?>: &ldquo;<?php single_tag_title(); ?>&rdquo;
		
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<?php _e('Archive for','gymboom'); echo ' '; the_time('F jS, Y'); ?>
		
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<?php _e('Archive for','gymboom'); echo ' '; the_time('F, Y'); ?>
		
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<?php _e('Archive for','gymboom'); echo ' '; the_time('Y'); ?>
		
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<?php _e('Author Archive','gymboom'); ?>
					
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<?php _e('Archives','gymboom'); ?>
				<?php } ?>
			</h1>
			
			<?php if ( have_posts() ) : ?>
			
				<?php while (have_posts()) : the_post(); ?>
				
					<?php if (has_post_thumbnail($post->ID)){ ?>
						<div class="one_fourth postlist-thumbnail">
						<a href="<?php the_permalink() ?>"><?php
						$featured_caption = get_the_title($post->ID);
						$featured_image = get_the_post_thumbnail($post->ID,'post-thumb', array('title'=>$featured_caption));
						echo $featured_image;
						?></a></div>
					<?php } ?>
					
					<?php if (has_post_thumbnail($post->ID)){ ?>
						<div class="three_fourth last"><?php
					} ?>
						<h4 class="title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						
						<?php if (ot_get_option('js_hide_metainfo') == 0){ ?>
						<div class="post-meta">
							<?php _e('Posted on','gymboom'); ?> <strong><?php the_time('F j, Y') ?></strong> <?php _e('by','gymboom'); ?> <strong><?php the_author_posts_link(); ?></strong> <?php _e('in','gymboom'); ?>
							<strong><?php the_category(', '); ?></strong><br /><?php comments_number('', '<a href="'.get_permalink().'#comments">'.__('1 Comment','gymboom').'</a>', '<a href="'.get_permalink().'#comments">% '.__('Comments','gymboom').'</a>' ); ?></a>
						</div>
						<?php } else { ?>
							<br />
						<?php } ?>
						
						<?php the_excerpt(); ?>
						
						<p><a href="<?php the_permalink() ?>" class="continue"><?php _e('Continue Reading','gymboom'); ?></a></p>
						
					<?php if (has_post_thumbnail($post->ID)){ ?>
						</div><?php
					} ?>
					
					<div class="cl"></div>
		
				<?php endwhile; ?>
				
			<?php endif; ?>
			
			<?php js_get_pagination(); wp_reset_query(); ?>
							
		</article>
				
		<aside class="one_third last">
			<?php get_sidebar(); ?>	
		</aside>
	
	</section>
</section>
	
<?php get_footer(); ?>