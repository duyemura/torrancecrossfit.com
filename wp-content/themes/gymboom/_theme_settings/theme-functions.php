<?php

function get_absolute_file_url( $url ) {
	if( is_multisite() ) {
		global $blog_id;
		$upload_dir = wp_upload_dir();

		if( strpos( $upload_dir['basedir'], 'blogs.dir' ) !== false ) {
			$parts = explode( '/files/', $url );
			$url = network_home_url() . '/wp-content/blogs.dir/' . $blog_id . '/files/' . $parts[ 1 ];
		}
	}

	return $url;
}

// ------------------------------------------------------------
// Load Stylesheets, Scripts & Customizations
function gymboom_theme_styles()  
{
	$highlight_color = ot_get_option('js_highlight_color','#EA6148');
	$highlight_color = explode('#',$highlight_color);
	$highlight_color = $highlight_color[1];
	
	$footer_bg = ot_get_option('js_footer_bg','#333333');
	$footer_bg = explode('#',$footer_bg);
	$footer_bg = $footer_bg[1];

	$bottom_bg = ot_get_option('js_bottom_bg','#000000');
	$bottom_bg = explode('#',$bottom_bg);
	$bottom_bg = $bottom_bg[1];
	
	$font_array = array();
	$temp_count = 0;
	$font_array[] = ot_get_option('js_custom_font_main','Lato');
	if (!in_array(ot_get_option('js_custom_font_headings','Roboto+Condensed'),$font_array)){
		$font_array[] = $custom_font_headings = ot_get_option('js_custom_font_headings','Roboto+Condensed');
	}
	if (!in_array(ot_get_option('js_custom_font_buttons','Roboto+Condensed'),$font_array)){
		$font_array[] = $custom_font_headings = ot_get_option('js_custom_font_headings','Roboto+Condensed');
	}

	foreach($font_array as $font){
		$temp_count++;
		wp_enqueue_style( 'custom-google-fonts-'.$temp_count, 'http://fonts.googleapis.com/css?family='.$font.':100,200,300,400,500,600,700,800&subset=latin,cyrillic-ext,cyrillic,greek-ext,vietnamese,latin-ext', array(), '1.0', 'all');
	}
	
	$responsive_disabled = ot_get_option('js_responsive_disabled',false);
	$responsive_disabled = $responsive_disabled[0];
	$responsive_disabled = ($responsive_disabled ? true : false);

  	wp_register_style( 'custom-flexslider', get_template_directory_uri() . '/_theme_styles/flexslider.css', array(), '2.0', 'all' );
  	wp_register_style( 'custom-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', array(), '2.0.6', 'all' );
  	wp_register_style( 'custom-reset', get_template_directory_uri() . '/_theme_styles/reset.css', array(), '1.0', 'all' );
  	wp_register_style( 'custom-stylesheet', get_bloginfo('stylesheet_url'), array(), '1.0', 'all' );
  	if (!$responsive_disabled){ wp_register_style( 'custom-responsive', get_template_directory_uri() . '/_theme_styles/responsive.css', array(), '2.0', 'all' ); }
 
  	$font_array = array();
  	$font_array['main'] = ot_get_option('js_custom_font_main','Lato');
	$font_array['headings'] = ot_get_option('js_custom_font_headings','Roboto+Condensed');
	$font_array['buttons'] = ot_get_option('js_custom_font_buttons','Roboto+Condensed');
 
  	wp_register_style( 'customized-styles', get_template_directory_uri() . '/_theme_styles/custom.php?footer_bg='.$footer_bg.'&bottom_bg='.$bottom_bg.'&color='.$highlight_color.'&font_main='.$font_array['main'].'&font_headings='.$font_array['headings'].'&font_buttons='.$font_array['buttons'], array(), '1.0', 'all');
  
  	wp_enqueue_style( 'custom-flexslider' );
  	wp_enqueue_style( 'custom-fancybox' );
  	wp_enqueue_style( 'custom-reset' );
  	wp_enqueue_style( 'custom-stylesheet' );
  	wp_enqueue_style( 'custom-responsive' );
  	wp_enqueue_style( 'customized-styles' );
  
  	if ( !is_admin() ) { wp_enqueue_script('jquery'); }
}

function gymboom_load_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('custom-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.0', false);
	wp_enqueue_script('custom-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.3', true);
	wp_enqueue_script('custom-carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.1.0-packed.js', array(), '6.1.0', true);
	wp_enqueue_script('custom-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array(), '2.0', true);
	wp_enqueue_script('custom-tweet', get_template_directory_uri() . '/js/jquery.tweet.js', array(), '1.0', false);
	wp_enqueue_script('custom-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array(), '2.0.6', true);
	wp_enqueue_script('custom-functinos', get_template_directory_uri() . '/js/jquery.func.js', array(), '1.0', true);
}   

function gymboom_custom_styles(){
	
	global $template_dir;
	
	// Is there a custom logo?
	$custom_logo = ot_get_option('js_logo');
	
	$logo_height = ot_get_option('js_logo_height');
	if (!$logo_height){ $logo_height = 109; }

	$logo_width = ot_get_option('js_logo_width');
	if (!$logo_width){ $logo_width = 174; }
	
	$footer_text_style = ot_get_option('js_footer_text_style');
	$footer_bg_color = (ot_get_option('js_footer_background_color') ? ot_get_option('js_footer_background_color') : '#333333');
	$footer_bg_image = (ot_get_option('js_footer_background_image') ? ot_get_option('js_footer_background_image') : '');
	$footer_bg_align = (ot_get_option('js_footer_background_image_alignment') ? ot_get_option('js_footer_background_image_alignment') : 'top center');
	$footer_bg_repeat = (ot_get_option('js_footer_background_image_repeat') ? ot_get_option('js_footer_background_image_repeat') : 'repeat');
	$footer_bg_disabled = (ot_get_option('js_footer_bg_disabled') ? true : false);
	
	if ($custom_logo || $footer_bg_image || $footer_bg_color){ echo '<style type="text/css">'; }
	if ($custom_logo){ echo '#logo a { background: url(\''.$custom_logo.'\') left center no-repeat; }'; }
	
	if ($logo_width){ echo '#logo, #logo a { width:'.$logo_width.'px; }'; }
	if ($logo_height){ echo '#logo, #logo a { height:'.$logo_height.'px; }'; }
	
	if ($footer_bg_color || $footer_bg_image){
		if ($footer_bg_color && !$footer_bg_image || $footer_bg_color && $footer_bg_disabled){
			echo 'footer { background-color: '.$footer_bg_color.'; }';
		} else if ($footer_bg_image && !$footer_bg_color && !$footer_bg_disabled){
			echo 'footer { background-image: url(\''.$footer_bg_image.'\')'.($footer_bg_align ? ' '.$footer_bg_align : '').($footer_bg_repeat ? ' '.$footer_bg_repeat : '').'; }';
		} else {
			echo 'footer { background: '.$footer_bg_color.' url(\''.$footer_bg_image.'\')'.($footer_bg_align ? ' '.$footer_bg_align : '').($footer_bg_repeat ? ' '.$footer_bg_repeat : '').'; }';
		}
		
		if ($footer_bg_disabled){
			echo 'footer { background-image:none; }';
		}
	}
	
	if ($custom_logo || $footer_bg_image || $footer_bg_color){ echo '</style>'; }
	
	if (ot_get_option('js_favicon')){ ?>
		<!-- The Favicon, change this to whatever you'd like -->
		<link rel="shortcut icon" href="<?php echo ot_get_option('js_favicon'); ?>" />
	<?php }
	
	// Comments
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	// Google Analytics
	$google_analytics = ot_get_option('js_google_analytics');
	if ($google_analytics) {
		echo $google_analytics;
	}
	
	// Custom CSS
	$custom_css = ot_get_option('js_custom_css');
	if ($custom_css) {
		echo '<style type="text/css">'.$custom_css.'</style>';
	}
	
} 
 
add_action('wp_enqueue_scripts', 'gymboom_theme_styles');
add_action('wp_enqueue_scripts', 'gymboom_load_scripts');
add_action('wp_head', 'gymboom_custom_styles');


// ------------------------------------------------------------
// Gymboom Slider

	function gymboom_slider($slider_choice){
	
		global $template_dir;
	
		if ($slider_choice):
		
			$alias_split = explode('---',$slider_choice);
			$alias_type = $alias_split[0];
			$alias_name = $alias_split[1];
			
			// Revolution Slider?
			if ($alias_type == 'REVSLIDER'):
			
				putRevSlider($alias_name);
				
			// Gymboom Slider?
			else:
		
				$items = get_post_meta($alias_name, '_slides', true); ?>
				<section id="slider">
					<section class="image-slider">
						<ul class="slides">
						
							<?php // GET IMAGE SLIDES FIRST
							foreach($items as $i) {
								if($i['image_id']) {
									$src = wp_get_attachment_image_src($i['image_id'], 'slide-image');
									$src = $src[0];
									echo '<li><img src="' . esc_attr($src) . '" alt="" width="2000" height="553" /></li>';
								}
							} ?>
							
						</ul>
					</section>
					<section class="text-slider">
						<ul>
						
							<?php // GET TEXT SLIDES NOW
							foreach($items as $i) {
								
								if($i['button_text'] && $i['button_link']) {
									$button = '<a href="' . esc_attr($i['button_link']) . '" class="gb-button">' . $i['button_text'] . '</a>';
								} else {
									$button = '';
								}
			
								if($i['content']) {
									$content = '<p>'.$i['content'].'</p>';
								} else {
									$content = '';
								}
								
								if($i['title']) {
									$title = '<h2>'.$i['title'].'</h2>';
								} else {
									$title = '';
								}
								
								echo '<li>';
								echo $title;
								echo $content;
								echo $button;
								echo '</li>';
								
							} ?>
							
						</ul>
					</section>
					<section class="elements">
						<span class="white-box"></span>
						<span class="top-corner"></span>
						<span class="bottom-corner"></span>
					</section>
				</section><?php
				
			endif;
		
		endif;
	
	}

// End Gymboom Slider
// ------------------------------------------------------------



// ------------------------------------------------------------
// Add Thumbnails to Page/Post management screen

	if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
	
	    function AddThumbColumn($cols) {
	        $cols['thumbnail'] = __('Featured Image','gymboom');
	        return $cols;
	    }
	    function AddThumbValue($column_name, $post_id) {
	        if ( 'thumbnail' == $column_name ) {
	        
	        	if (has_post_thumbnail( $post_id )) :
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'gallery-small' );
					if (is_array($image_url)) { $image_url = $image_url[0]; }
				endif;
	        
	            if ( isset($image_url) && $image_url ) {
	                echo '<img style="border-radius:3px; margin:5px 0;" src="'.$image_url.'" width="100" />';
	            } else {
	                echo __('None','gymboom');
	            }
	            
	        }
	    }
	    
	    // for posts
	    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
	    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
	    
	    // for pages
	    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
	    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
	    
	}

// End Thumbnails
// ------------------------------------------------------------



// ------------------------------------------------------------
// Convert Youtube/Vimeo Links to iFrames

	function video_link_to_iframe($video_link = '',$w = 940,$h = 529,$full_iframe = true){
		$vimeo = strpos($video_link,'vimeo');
		$youtube_normal = strpos($video_link,'youtube');
		$youtube_short = strpos($video_link,'youtu.be');
										
		if ($youtube_normal != false){
			$video_link = str_replace(array('www.','http://youtube.com/watch?v=','https://youtube.com/watch?v='),'',$video_link);
			$video_link = explode('&',$video_link);
			$video_link = $video_link[0];
			if ($full_iframe){
				$video_string = '<iframe class="vid-frame" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'.$video_link.'?rel=0&amp;wmode=transparent" frameborder="0"></iframe>';
			} else {
				$video_string = 'http://www.youtube.com/embed/'.$video_link.'?rel=0&amp;wmode=transparent&amp;autoplay=1';
			}
		} else if ($youtube_short != false){
			$video_link = str_replace(array('www.','http://youtu.be/','https://youtu.be/'),'',$video_link);
			$video_link = explode('&',$video_link);
			$video_link = $video_link[0];
			if ($full_iframe){
				$video_string = '<iframe class="vid-frame" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'.$video_link.'?rel=0&amp;wmode=transparent" frameborder="0"></iframe>';
			} else {
				$video_string = 'http://www.youtube.com/embed/'.$video_link.'?rel=0&amp;wmode=transparent&amp;autoplay=1';
			}	
		} else if ($vimeo != false){
			$video_link = str_replace(array('www.','http://vimeo.com/','https://vimeo.com/'),'',$video_link);
			if ($full_iframe){
				$video_string = '<iframe class="vid-frame" src="http://player.vimeo.com/video/'.$video_link.'?portrait=0" width="'.$w.'" height="'.$h.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
			} else {
				$video_string = 'http://player.vimeo.com/video/'.$video_link.'?portrait=0&amp;autoplay=1';
			}
		} else {
			$video_string = '';
		}
		return $video_string;
	}

// End Convert Youtube/Vimeo Links
// ------------------------------------------------------------



// ------------------------------------------------------------
// Gallery Functions

	function js_display_gallery_item($post_thumbnail = '',$image_title = '',$post_link = '',$echo = true,$right = false,$post_id = ''){
	
		$attachments = get_children(array('post_parent'=>$post_id));
		$nbImg = count($attachments);
	
		$gallery_content = '';
		$gallery_content .= '<a';
		if ($right == true) { $gallery_content .= ' class="right"'; }
		$gallery_content .= ' title="'.$image_title.'" href="'.$post_link.'">';
		$gallery_content .= '<img alt="'.$image_title.'" src="'.$post_thumbnail.'" />';
		$gallery_content .= '<span class="img-title">'.$image_title.'<span class="cap"></span></span>';
		$gallery_content .= '<span class="img-cap"></span>';
		$gallery_content .= '<span class="count">'.$nbImg.'</span>';
		$gallery_content .= '</a>';
		
		if ($echo) { echo $gallery_content; } else { return $gallery_content; }
	}
	
	function js_display_gallery_photo($full_image_src = '',$image_caption = '',$post_thumbnail = '',$size = 'medium', $echo = true, $right = false, $last = false){
	
		$gallery_content = '';
		
		$gallery_content .= '<figure class="image '.$size.($last ? ' last' : '').'">';
			$gallery_content .= '<a rel="gallery" title="'.$image_caption.'" href="'.$full_image_src.'" class="fancybox"><img src="'.$post_thumbnail.'" alt="" /><span class="plus"></span></a>';
			$gallery_content .= '<figcaption>'.$image_caption.'</figcaption>';
		$gallery_content .= '</figure>';
		
		if ($echo) { echo $gallery_content; } else { return $gallery_content; }
	}

// End Gallery Functions
// ------------------------------------------------------------



// ------------------------------------------------------------
// Pagination

	function js_get_pagination($args = null) {
		global $wp_query;
		
		$total_pages = $wp_query->max_num_pages;
		$big = 999999999; // need an unlikely integer
		
		if ($total_pages > 1){
		
			echo '<div id="pagination">';
				echo paginate_links( array(
					'base' => @add_query_arg('paged','%#%'),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'type' => 'list',
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				));
			echo '</div>';
		
		}
		
	}

// End Pagination
// ------------------------------------------------------------



// ------------------------------------------------------------
// Top/Bottom Bar Content
	
	function display_bottom_left_content(){
		echo '<p>'.(ot_get_option('js_bottom_left_text') ? str_replace('[year]',date('Y'),ot_get_option('js_bottom_left_text')) : '').'</p>';
	}

// End Top/Bottom Bar Content
// ------------------------------------------------------------



// ------------------------------------------------------------
// Social Icons

	function js_social_icons(){
	
		echo (ot_get_option('js_social_icon_facebook') ? '<div class="facebook"><a target="_blank" href="'.ot_get_option('js_social_icon_facebook').'">Facebook</a></div>' : '');
		echo (ot_get_option('js_social_icon_twitter') ? '<div class="twitter"><a target="_blank" href="'.ot_get_option('js_social_icon_twitter').'">Twitter</a></div>' : '');
		echo (ot_get_option('js_social_icon_linkedin') ? '<div class="linkedin"><a target="_blank" href="'.ot_get_option('js_social_icon_linkedin').'">LinkedIn</a></div>' : '');
		echo (ot_get_option('js_social_icon_vimeo') ? '<div class="vimeo"><a target="_blank" href="'.ot_get_option('js_social_icon_vimeo').'">Vimeo</a></div>' : '');
		echo (ot_get_option('js_social_icon_youtube') ? '<div class="youtube"><a target="_blank" href="'.ot_get_option('js_social_icon_youtube').'">YouTube</a></div>' : '');
		echo (ot_get_option('js_social_icon_googleplus') ? '<div class="google-plus"><a target="_blank" href="'.ot_get_option('js_social_icon_googleplus').'">Google+</a></div>' : '');
		echo (ot_get_option('js_social_icon_pinterest') ? '<div class="pinterest"><a target="_blank" href="'.ot_get_option('js_social_icon_pinterest').'">Pinterest</a></div>' : '');
		echo (ot_get_option('js_social_icon_instagram') ? '<div class="instagram"><a target="_blank" href="'.ot_get_option('js_social_icon_instagram').'">Instagram</a></div>' : '');
		echo (ot_get_option('js_social_icon_rss') ? '<div class="rss"><a target="_blank" href="'.ot_get_option('js_social_icon_rss').'">Feed</a></div>' : '');
	
	}
	
	function js_social_buttons(){
	
		$hide_facebook = ot_get_option('js_hide_facebook_like');
		$hide_twitter = ot_get_option('js_hide_twitter_tweet');
		$hide_google = ot_get_option('js_hide_google_plus');
	
		if (!$hide_google || !$hide_twitter || !$hide_facebook) {
	
		?><div class="social-buttons">
								
			<?php if (!$hide_google){ ?>
			<!-- Google +1 -->
			<div class="google-plusone"><div class="g-plusone" data-size="medium"></div></div>
			<script src="<?php echo get_template_directory_uri(); ?>/js/google_plusone_script.js" type="text/javascript"></script>
			<?php } ?>
			
			<?php if (!$hide_twitter){ ?>
			<!-- Twitter Tweet -->
			<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			<?php } ?>
			
			<?php if (!$hide_facebook){ ?>
			<!-- Facebook Like -->
			<div id="fb-root"></div><script src="<?php echo get_template_directory_uri(); ?>/js/fb_like_script.js" type="text/javascript"></script>
			<div class="fb-like" data-send="false" data-width="380" data-show-faces="false"></div>
			<?php } ?>
			
			<div class="clearboth"></div>
			
		</div><?php
		
		}
	
	}

// End Social Icons
// ------------------------------------------------------------



// ------------------------------------------------------------
// Event Functions

	function get_upcoming_events($amount = 1,$categories = false){
		
		global $aec;
	
		$excluded = false;
		$limit = false;
		$whitelabel = false;
		$start = date('Y-m-d',strtotime('now'));
		$end = date('Y-m-d', strtotime('+20 year'));
		
		$event = $aec->db_query_events($start, $end, $categories, $excluded, $limit);
		$event = $aec->process_events($event, $start, $end, true);
		
		if (!empty($event)){
			usort($event, array($aec, 'array_compare_order'));
			$rows = $aec->convert_array_to_object($event);
		} else {
			return false;
		}
		
		if ($amount == 1):
			foreach($rows as $item):
				
				$start_date_compare = date('Ymd',strtotime($item->start));
				$today = strftime('%Y%m%d',strtotime('now'));
				
				if ($start_date_compare == $today){
					$start_time = date('Gi',strtotime($item->start));
					$current_time = strftime('%H%M');
					if ($start_time > $current_time){
						return $item;
					}
				} else {
					
					return $item;
				
				}
				
			endforeach;
		else :
			$events = array();
			$temp_count = 0;
			foreach($rows as $item):
			
				$event = $aec->db_query_event($item->id);
			
				if ($temp_count == $amount): break; endif;
				$temp_count++;
				$events[$temp_count]['id'] = $event->id;
				$events[$temp_count]['title'] = $event->title;
				if (isset($item->allDay)) $events[$temp_count]['allday'] = $item->allDay;
				$events[$temp_count]['start'] = $item->start;
				$events[$temp_count]['end'] = $item->end;
				$events[$temp_count]['venue'] = $event->venue;
				
			endforeach;
			return $events;
		endif;
	}
	
	function featured_event($featured_event){
		
		global $aec;
	
		$categories	= false;
		$excluded = false;
		$limit = false;
		$whitelabel = false;
		$start = date('Y-m-d');
		$end = date('Y-m-d', strtotime('January 4,2100'));
		
		$events	= $aec->db_query_events($start, $end, $categories, $excluded, $limit);
		$events = $aec->process_events($events, $start, $end, true);
		
		foreach($events as $event){
		
			if ($event['id'] == $featured_event){
				return $event;
			}
			
		}
		
		return false;
		
	}
	
	function single_event_display($event){
		$start_date = (isset($event['start']) ? strtotime($event['start']) : '');
		$end_date = (isset($event['end']) ? strtotime($event['end']) : '');
		$title = (isset($event['title']) ? $event['title'] : '');
		$venue = (isset($event['venue']) ? $event['venue'] : '');
		$allday = (isset($event['allday']) ? $event['allday'] : '');
		
		$start_date_compare = date('Ymd',$start_date);
		$today = strftime('%Y%m%d',strtotime('now'));
		
		if (!$allday && $start_date_compare == $today){
			$start_time = date('Gi',$start_date);
			$end_time = date('Gi',$end_date);
			$current_time = strftime('%H%M');
		}

		$start_day = date('F j', $start_date);
		$end_day = date('F j', $end_date);
		
		if ($start_day == $end_day): $same_day = true; else: $same_day = false; endif;
			
		$date_format = get_option('date_format').', '.get_option('time_format');
		$date_format_b = get_option('time_format'); ?>
	
		<a href="#" class="event-link" onclick="jQuery.aecDialog({'id':<?php echo $event['id']; ?>,'start':'<?php echo $event['start']; ?>','end':'<?php echo $event['end']; ?>'}); return false;"><span class="icon"><img src="<?php echo get_template_directory_uri(); ?>/_theme_styles/images/clock.png" alt="" /></span> <span class="right">
			<?php if ($allday): ?>
				<?php _e('All day','gymboom'); ?>
			<?php else : ?>
				<?php echo date_i18n($date_format,$start_date); if ($same_day): echo ' - '.date_i18n($date_format_b,$end_date); endif; ?>
			<?php endif; ?>
		</span> <strong><?php echo $title; ?></strong></a><?php
	}
	
	function events_dropdown_data($aec){
	
		$categories	= false;
		$excluded = false;
		$limit = false;
		$whitelabel = true;
		$start = date('Y-m-d');
		$end = date('Y-m-d', strtotime(date("Y-m-d", strtotime($start)) . "+1 year"));
		
		$events	= $aec->db_query_events($start, $end, $categories, $excluded, $limit);
		$events = $aec->process_events($events, $start, $end, true);
		if (!$events) {
			return array();
		}
		$temp_count = 0;
		$ids_added = array();
		
		$select_data[0] = 'No event countdown';
		$select_data['next'] = '[Show the next upcoming event]';
		
		foreach($events as $event){
		
			if (!in_array($event['id'], $ids_added)):
				$ids_added[] = $event['id'];
				$select_data[$event['id']] = $event['title'];
			endif;
			
		}
		
		return $select_data;
		
	}
	
	function js_countdown_block(){
		
		$current_date = date(current_time('mysql'));
		$current_timestamp = strtotime($current_date) * 1000;
				
		$all_posts = array(
			'post_type' => 'event-items',
		    'posts_per_page' => 1,
		    'orderby' => 'meta_value',
		    'meta_key' => '_start_date',
		    'order' => 'ASC',
		);
		
		query_events(false,$all_posts);
			
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		
			global $post;
		
			$start_date = strtotime(get_post_meta($post->ID,'_start_date_visual',true)); ?>
			
			<section id="countdown">
				<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo substr(get_the_title($post->ID),0,45); if (strlen(get_the_title($post->ID)) > 45){ echo '...'; } ?></a></h2>
				<h3><?php echo date('F j, Y G i Z',$start_date); ?></h3>
			</section>
		
		<?php endwhile; endif; wp_reset_query();
		
	}

// End Event Functions
// ------------------------------------------------------------



// ------------------------------------------------------------
// Breadcrumb Display

	function js_breadcrumbs($post_id = ''){
	
		$hide_breadcrumbs = ot_get_option('js_disable_breadcrumbs');
		if ($hide_breadcrumbs != 1){
	
			$breadcrumbs = '<p id="breadcrumbs"><a href="'.home_url().'">Home</a>';
			
			if (is_page()){
			
				$ancestors = get_post_ancestors($post_id);
				$ancestors = array_reverse($ancestors);
				if (!empty($ancestors)){
					foreach($ancestors as $page_id){
						$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_permalink($page_id).'">'.get_the_title($page_id).'</a>';
					}
				}
			
			} else if (is_search()){
			
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Search Results';
			
			} else if ('gallery-items' == get_post_type()){
			
				if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Galleries</a>'; } else
				if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Galleries'; } else {
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Galleries</a>'; }
			
			} else if ('video-items' == get_post_type()){
			
				if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Videos</a>'; } else
				if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Videos'; } else {
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Videos</a>'; }
			
			} else if ('audio-items' == get_post_type()){
			
				if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Audio</a>'; } else
				if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Audio'; } else {
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Audio</a>'; }
			
			} else if ('event-items' == get_post_type()){
			
				if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Events</a>'; } else
				if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;Events'; } else {
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.get_post_type_archive_link(get_post_type()).'">Events</a>'; }
			
			} else if (is_single()){
				
				$categories = get_the_category();
				$cat_name = $categories[0]->cat_name;
				$cat_link = get_category_link($categories[0]->cat_ID);
		
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;<a href="'.$cat_link.'">'.$cat_name.'</a>';
				
			}
			
			if (!is_tax() && !is_archive()){
			
				$original_title = get_the_title($post_id);
				$shortened_title = substr(get_the_title($post_id), 0, 75);
				
				$orig_length = strlen($original_title);
				$new_length = strlen($shortened_title);
				
				$dots = ''; if ($new_length < $orig_length) { $dots = '...'; }
				
				$breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;'.$shortened_title.$dots.'</p>';
				
			} else if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;&rsaquo;&nbsp;&nbsp;'.single_cat_title('',false).'</p>'; }
			
			echo $breadcrumbs;
			
		} else {
		
			echo '<p id="breadcrumbs">&nbsp;</p>';
		
		}
		
	}

// End Breadcrumb Display
// ------------------------------------------------------------



// ------------------------------------------------------------
// Misc Functions

	function main_menu_message(){ echo '<span style="top:5px; display:block; position:relative; text-align:right; font-size:15px; color:#aaa;">Please <a href="'.home_url().'/wp-admin/nav-menus.php">create and set a menu</a> for the main navigation.</span>'; }
	
	// Fix <p>'s and <br>'s from showing up around shortcodes.
	add_filter('the_content', 'js_empty_paragraph_fix');
	function js_empty_paragraph_fix($content)
	{   
	    $array = array ( '<p>[' => '[', ']</p>' => ']', ']<br />' => ']' );
	    $content = strtr($content, $array);
	    return $content;
	}
	
	function custom_excerpt($text) {
		$text = str_replace('[...]', '...', $text);
		return $text;
	}
	add_filter('get_the_excerpt', 'custom_excerpt');
	
	function js_char_shortalize($text, $length = 180, $append = '...') {
		$new_text = substr($text, 0, $length);
		if (strlen($text) > $length) {
			$new_text .= '...';
		}
		return $new_text;
	}
	
	function getRelativeTime($ts)
	{
	    if(!ctype_digit($ts))
	        $ts = strtotime($ts);
	
	    $diff = time() - $ts;
	    if($diff == 0)
	        return __('now','espresso');
	    elseif($diff > 0)
	    {
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0)
	        {
	            if($diff < 60) return  __('just now','espresso');
	            if($diff < 120) return __('1 minute ago','espresso');
	            if($diff < 3600) return floor($diff / 60).' '.__('minutes ago','espresso');
	            if($diff < 7200) return '1 hour ago';
	            if($diff < 86400) return floor($diff / 3600).' '.__('hours ago','espresso');
	        }
	        if($day_diff == 1) return __('Yesterday','espresso');
	        if($day_diff < 7) return $day_diff.' '.__('days ago','espresso');
	        if($day_diff < 31) return ceil($day_diff / 7).' '.__('weeks ago','espresso');
	        if($day_diff < 60) return __('last month','espresso');
	        return date_i18n(get_option('date_format'), $ts);
	    }
	    else
	    {
	        $diff = abs($diff);
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0)
	        {
	            if($diff < 120) return __('in a minute','espresso');
	            if($diff < 3600) return __('in','espresso').' '.floor($diff / 60).' '.__('minutes','espresso');
	            if($diff < 7200) return __('in an hour','espresso');
	            if($diff < 86400) return __('in','espresso').' '.floor($diff / 3600).' '.__('hours','espresso');
	        }
	        if($day_diff == 1) return __('Tomorrow','espresso');
	        if($day_diff < 4) return date('l', $ts);
	        if($day_diff < 7 + (7 - date('w'))) return __('next week','espresso');
	        if(ceil($day_diff / 7) < 4) return __('in','espresso').' '.ceil($day_diff / 7).' '.__('weeks','espresso');
	        if(date('n', $ts) == date('n') + 1) return __('next month','espresso');
	        return date_i18n(get_option('date_format'), $ts);
	    }
	}
	
	function makeClickableLinks($text) {

		$text = preg_replace(
		    '/(^|[^"])(((f|ht){1}tp:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i',
		    '\\1<a href="\\2" target="_blank">\\2</a>', 
		    $text
		);
		
		return $text;
		
	}
	
	function plural($num) {
		if ($num != 1)
			return "s";
	}
	
	class GymboomCustomNavigation extends Walker_Nav_Menu {
		
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<section class=\"dropdown\"><ul>\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></section>\n";
		}
	
	}
	
	function get_page_ancestor($page_id) {
	    $page_obj = get_page($page_id);
	    while($page_obj->post_parent!=0) {
	        $page_obj = get_page($page_obj->post_parent);
	    }
	    return get_page($page_obj->ID);
	}

// End Misc Functions
// ------------------------------------------------------------