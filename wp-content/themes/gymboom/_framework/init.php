<?php

if ( ! isset( $content_width ) ) $content_width = 940;

// Widget Framework
require('widget_framework.php');

// Enhanced Custom Fields Framework
require('custom_fields/cf_framework.php');

// Twitter
include_once('twitter/versions-proxy.php');

// Facebook
require('facebook/facebook.php');

function my_myme_types($mime_types){
    $mime_types['ico'] = 'image/vnd.microsoft.icon'; //Adding ico extension for favicon
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

// Timezone Settings
if ( !function_exists('getTimezoneByOffset') ) {
	function getTimezoneByOffset($offset){
	
	 	$offset *= 3600; // convert hour offset to seconds
        $abbrarray = timezone_abbreviations_list();
        foreach ($abbrarray as $abbr){
			foreach ($abbr as $city){
               	if ($city['offset'] == $offset){
                  	return $city['timezone_id'];
                }
         	}
        }

        return false;
	
	}

	$timezone_setting = get_option('timezone_string');
	$offset_setting = get_option('gmt_offset');
	if (!$timezone_setting) { $timezone_setting = getTimezoneByOffset($offset_setting); }
	
	date_default_timezone_set($timezone_setting);

}
// END Timezone Settings

// Add allowed <script> tag for Google Analytics code
add_action('init', 'my_html_tags_code', 10);
function my_html_tags_code() {
  	global $allowedposttags;
  	$allowedposttags = array(
  		'script' => array(),
  		'b' => array(),
  		'i' => array(),
  		'p' => array(),
  		'h1' => array(),
  		'h2' => array(),
  		'h3' => array(),
  		'h4' => array(),
  		'h5' => array(),
  		'h6' => array(),
      	'ul' => array(),
      	'ol' => array(),
      	'li' => array(),
      	'strong' => array(),
      	'em' => array(),
      	'pre' => array(),
      	'code' => array(),
      	'a' => array(
      	'href' => array (),
      	'title' => array ()),
      	'span' => array ()
    );
}

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');

require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_555( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()));
?>