<?php

// Text Widget with Icon
// ----------------------------------------------------
class ThemeWidgetSocialIconsWidget extends ThemeWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetSocialIconsWidget() {
		$widget_opts = array(
			'classname' => 'theme-widget-social-icons-widget', // class of the <li> holder
			'description' => __( 'Displays a list of social icons.','gymboom') );
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-social-icons-widget', __('[GYMBOOM] Social Icons','gymboom'), $widget_opts, $control_ops);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args); ?>
		
		<div class="socials">		
			<?php js_social_icons(); ?>
		</div>
			
	<?php }
}

?>