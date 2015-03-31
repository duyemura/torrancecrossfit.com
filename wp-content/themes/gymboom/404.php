<?php get_header(); ?>
	
<div id="main">
	<div class="shell">
		<article id="content" <?php post_class('full'); ?>>
					
			<h1><?php _e('Page Not Found','gymboom'); ?></h1>
					
			<?php echo (ot_get_option('js_404_content') ? ot_get_option('js_404_content') : '<p>'.__('Sorry, this page cannot be found.','gymboom').'</p>'); ?>
								
		</article>
	</div>
</div>

<?php get_footer(); ?>