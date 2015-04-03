<?php

global $aec;

include('page-children.php');
include('recent-posts.php');

// Twitter
include('twitter/versions-proxy.php');
include('twitter/recent-tweets.php');

include('facebook-feed.php');
include('gallery-widget.php');
include('video-widget.php');
include('text.php');
include('map.php');
include('column-text.php');
include('social-icons.php');

if (is_object($aec)) { include('upcoming-events.php'); }

/* Register the widgets */
function load_widgets() {

	global $aec;
	register_widget('ThemeWidgetRecentPosts');
	register_widget('ThemeWidgetRecentTweets');
	register_widget('ThemeWidgetFacebookFeed');
	register_widget('ThemeWidgetGalleryItems');
	register_widget('ThemeWidgetVideoItems');
	register_widget('ThemeWidgetPageChildren');
	register_widget('ThemeWidgetTextWidget');
	register_widget('ThemeWidgetSocialIconsWidget');
	register_widget('ThemeWidgetColumnTextWidget');
	register_widget('ThemeWidgetMapWidget');
	
	if (is_object($aec)) { register_widget('ThemeWidgetUpcomingEvents'); }
	
}
add_action('widgets_init', 'load_widgets');

?>