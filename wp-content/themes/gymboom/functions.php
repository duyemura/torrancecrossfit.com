<?php

// Localization Functionality
add_action('after_setup_theme', 'theme_load_textdomain');

function theme_load_textdomain(){
	$path = get_template_directory() . '/languages';
	$loaded = load_theme_textdomain('gymboom',  $path);
}

// Option Tree Settings
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_options_ui', '__return_true' );
add_filter( 'ot_show_settings_import', '__return_true' );
add_filter( 'ot_show_settings_export', '__return_true' );

// Load the styles and assets if on the OT pane
global $pagenow;
if (isset($_GET['page']) && $_GET['page'] != 'ot-theme-options' || !isset($_GET['page'])) {
    function ot_admin_styles() { /* Block the styles from loading anywhere but the admin page */ }
}

load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );
load_template( trailingslashit( get_template_directory() ) . '_theme_settings/theme-options.php' );

// Slider Revolution Theme Mode
if(function_exists( 'set_revslider_as_theme' )){
	add_action( 'init', 'boxy_revsliderSetAsTheme' );
	function boxy_revsliderSetAsTheme() {
		set_revslider_as_theme();
	}
}

// Check to make sure the Event Calendar is installed
add_action('admin_notices', 'gymboom_events_admin_notice');
function gymboom_events_admin_notice() {
		
	$gymboom_event_plugin_notice_cleared = get_option('gymboom_event_plugin_notice_cleared');
	
	if (!$gymboom_event_plugin_notice_cleared):
	
	    ?>
	    <div class="update-nag">
	    	<p style="font-size:17px; padding:0 10px; margin:10px 0 5px;"><strong><?php _e( 'Important Update from GymBoom:','cooked'); ?></strong></p>
	        <?php echo '<p style="padding:0 10px; margin-top:0;">All of the Events have been moved into a new plugin called "Boxy Event Calendar". You must install this plugin from the Appearance > Install Plugins page to reactivate your events functionality.</p><p style="padding:0 10px"><a class="button button-primary" href="'.get_admin_url().'/themes.php?page=install-required-plugins">Install Boxy Event Calendar</a>&nbsp;&nbsp;<a href="'.get_admin_url().'/?gymboom_event_plugin_notice_clear=true" class="button">Clear This Message.</a></p>'; ?>
	    </div>
	    <?php

	endif;
	
}

// Clear the Events notice if requested
add_action('admin_init', 'gymboom_admin_init');
function gymboom_admin_init() {
			
	if (isset($_GET['gymboom_event_plugin_notice_clear'])):	
		update_option('gymboom_event_plugin_notice_cleared',true);
	endif;

}

// BoxyBase
require('base/base.php');

// Initial Load
require('_framework/init.php');

// Add theme support for post thumbnails & post formats
require('_theme_settings/add-theme-support.php');

// Register Post Types
require('_theme_settings/post-types/init.php');

// Register Sidebars
require('_theme_settings/register-sidebars.php');

// Theme related functions
require('_theme_settings/theme-functions.php');

// Set up custom meta fields
require('_theme_settings/custom-fields/init.php');

// Shortcodes
require('_theme_settings/theme-shortcodes.php');

// Page part functions
require('_theme_settings/page-parts.php');

// Widgets
add_action( 'after_setup_theme', 'boxy_widgets' );
function boxy_widgets() {
	require('_theme_settings/widgets/init.php');
}

add_action('admin_init', 'gb_add_custom_editor_caps');
function gb_add_custom_editor_caps() {
	$role = get_role('editor');
	$role->add_cap('aec_add_events');
	$role->add_cap('aec_manage_events');
	$role->add_cap('aec_manage_calendar');
}

/* REQUIRED PLUGINS */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'gymboom_register_required_plugins' );

function gymboom_register_required_plugins() {

    $plugins = array(
	    
	    array(
            'name'                  => 'Boxy Event Calendar',
            'slug'                  => 'boxy-event-calendar',
            'source'                => 'http://boxystudio.com/_plugin_cdn/boxy-event-calendar.zip',
            'required'              => false
        ),
 
        array(
            'name'                  => 'Slider Revolution',
            'slug'                  => 'revslider',
            'source'                => 'http://boxystudio.com/_plugin_cdn/revslider.zip',
            'required'              => false
        ),
        
        array(
            'name'                  => 'Visual Composer',
            'slug'                  => 'js_composer',
            'source'                => 'http://boxystudio.com/_plugin_cdn/js_composer.zip',
            'required'              => false
        ),
 
    );
 
    $theme_text_domain = 'gymboom';
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}

?>