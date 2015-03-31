<?php

// Text Widget with Icon
// ----------------------------------------------------
class ThemeWidgetColumnTextWidget extends ThemeWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetColumnTextWidget() {
		$widget_opts = array(
			'classname' => 'theme-widget-column-text-widget', // class of the <li> holder
			'description' => __( 'Displays a text widget with two columns.','gymboom') );
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-column-text-widget', __('[GYMBOOM] Column Text Widget','gymboom'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','gymboom'), 
				'default'=>__('Widget Title','gymboom')
			),
			array(
				'name'=>'text_left',
				'type'=>'textarea',
				'title'=>__('Left Column Text (left aligned)','gymboom'), 
				'default'=>''
			),
			array(
				'name'=>'text_right',
				'type'=>'textarea',
				'title'=>__('Right Column Text (right aligned)','gymboom'), 
				'default'=>''
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args);
		
		$title = $instance['title'];
		$left_text = $instance['text_left'];
		$right_text = $instance['text_right']; ?>
		
		<div class="text-widget">
			<?php echo $before_title . $title . $after_title; ?>
			<div class="column-left"><p><?php echo nl2br($left_text); ?></p></div>
			<div class="column-right"><p><?php echo nl2br($right_text); ?></p></div>
			<div class="cl"></div>
		</div>
			
	<?php }
}

?>