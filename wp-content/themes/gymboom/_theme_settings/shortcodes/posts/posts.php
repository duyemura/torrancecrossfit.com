<?php



// ----------------------------------------------------------------------------------------------------
// Shortcode Button/Form

class Custom_Shortcodes_Posts
{
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons_3', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		array_push( $buttons, '|', 'js_posts_button' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		// this plugin file will work the magic of our button
		$plugins['js_posts'] = get_template_directory_uri() . '/_theme_settings/shortcodes/posts/script.js';
		return $plugins;
	}
}

$posts = new Custom_Shortcodes_Posts();



// ----------------------------------------------------------------------------------------------------
// Shortcode Display

function js_display_posts( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'category' => '',
		'count' => 5
	), $atts ) );
			
	global $post;
	
	$args = array( 'post_type' => 'post', 'posts_per_page' => $count, 'category' => $category);
	$sc_posts = new WP_Query($args);
	if ($sc_posts->have_posts()) {
	
		ob_start();
		
		?><div class="posts-block"><?php
		
		while ( $sc_posts->have_posts() ) {
			
			$sc_posts->the_post();
		
			?><div class="single-post">
						
				<div class="item"<?php if (!has_post_thumbnail($post->ID)){ ?> style="padding-left:0; width:100%;"<?php } ?>>
					<?php if (has_post_thumbnail($post->ID)){ ?>
						<a href="<?php the_permalink() ?>"><?php
						$featured_caption = get_the_title($post->ID);
						$featured_image = get_the_post_thumbnail($post->ID);
						echo $featured_image;
						?></a>
					<?php } ?>
					
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h6><?php _e('Posted by','gymboom'); ?> <strong><?php the_author(); ?></strong> <?php _e('on','gymboom'); ?> <strong><?php the_time('F j, Y'); ?></strong></h6>
					<?php echo wpautop(get_the_excerpt()); ?>
				</div>
			
			</div><?php

		}
		
		?></div><?php
			
		wp_reset_query();
		
		return ob_get_clean();
		
	}
	
}
add_shortcode( 'display-posts', 'js_display_posts' );

?>