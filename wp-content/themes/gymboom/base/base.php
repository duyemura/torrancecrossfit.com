<?php

# Use a class as a namespace to prevent conflicts
class BoxyBase {
	var $settings,
		$url,
		$post_id;

	static $registed_post_types = array();

	/*
		Init the accordion functionality

		The $args array lets you change certain settings.
		Look at the $default_settings array before to see the keys.
	*/
	function __construct($args = null) {
		# Replace the additional settings if provided
		if(is_array($args)) {
			$this->settings = $this->defaults + $args;
		} else {
			$this->settings = $this->defaults;
		}

		if(isset(self::$registed_post_types[$this->settings['post_type_name']])) {
			wp_die('Trying to register a post type twice!');
		} else {
			array_push(self::$registed_post_types, $this->settings['post_type_name']);
		}

		# Add actions that will be performed later
		add_action('init',               array($this, 'register_post_type'));
		add_action('add_meta_boxes',     array($this, 'attach_metaboxes'));
		add_action('save_post',          array($this, 'save'));
		add_action('init',               array($this, 'enqueue_scripts_styles'));

		# Prepare the location of the menu's folder to enable movement accross folders
		$path = dirname(__FILE__);
		$path = str_replace('\\', '/', $path);
		$path = str_replace(str_replace('\\', '/', ABSPATH), '', $path);
		$path = trailingslashit(site_url()) . $path;
		$path = trailingslashit($path);

		$this->url = $path;
	}

	/*
		Sorts an array of items by given order
	*/
	function order_items($items, $order) {
		$ordered = array();
		$order = explode(',', $order);

		foreach($order as $o) {
			if(strpos($o, 'prototype') !== false || $o == '%d%' || $o == '%e%') {
				continue;
			}

			if(isset($items[$o])) {
				if(isset($items[$o]['items_order'])) {
					$item = $items[$o];
					$item['items'] = $this->order_items($item['items'], $item['items_order']);
					$ordered[] = $item;
				} else {
					$ordered[] = $items[$o];					
				}
			}
		}

		return $ordered;
	}

	/*
		Adds slashes recursively
	*/
	function add_slashes($item) {
		if(is_array($item)) {
			$done = array();
			foreach($item as $key => $val) {
				$done[$key] = $this->add_slashes($val);
			}
			return $done;
		} elseif(is_string($item)) {
			return addslashes($item);
		} else {
			return $item;
		}
	}

	/*
		Saves the values if there are ones given
	*/
	function save($post_id) {
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if(get_post_type($post_id) != $this->settings['post_type_name']) {
			return;
		}

		$fields = $this->fields;

		foreach($fields as $field) {
		
			if(isset($_POST[$field])) {
			
				$value = $_POST[$field];

				if(isset($_POST[$field . '_order'])) {
					$value = $this->order_items($value, $_POST[$field . '_order']);
				}

				update_post_meta($post_id, '_' . $field, $value);
			}
		}
	}

	/*
		Renders a <select>
	*/
	function render_selectbox($name, array $options, $current = null) {
		$inner_HTML = '';

		foreach($options as $value => $label) {
			$selected = $value == $current ? ' selected="selected"' : '';

			$inner_HTML .= sprintf(
				'<option value="%s"%s>%s</option>',
				esc_attr($value),
				$selected,
				esc_html($label)
			);
		}

		return sprintf(
			'<select name="%s" id="%s">%s</select>',
			esc_attr($name),
			esc_attr(sanitize_title($name)),
			$inner_HTML
		);
	}

	/*
		Renders a text <input>
	*/
	function render_field($name, $value, $placeholder=null, $class=null) {
		return sprintf(
			'<input type="text" name="%s" id="%s" value="%s" placeholder="%s" class="%s" />',
			esc_attr($name),
			esc_attr(sanitize_title($name)),
			esc_attr($value),
			esc_attr($placeholder),
			esc_attr($class)
		);
	}
	
	/*
		Renders a checkbox <input>
	*/
	function render_checkbox($name, $value, $label) {
		if (isset($value) && $value && in_array(strtolower($label),$value)){
			$selected = ' checked="checked"'; } else { $selected = '';
		}
		
		return sprintf(
			'<span class="es-checkbox"><input type="checkbox" name="%s[]" id="%s" value="%s"'.$selected.' /> %s</span>',
			esc_attr($name),
			esc_attr(sanitize_title($name)),
			esc_attr(strtolower($label)),
			esc_attr($label)
		);
	}
	
	/*
		Renders a colored checkbox <input>
	*/
	function render_colored_checkbox($name, $value, $label, $color) {
		if (isset($value) && $value && in_array(strtolower($label),$value)){
			$selected = ' checked="checked"'; } else { $selected = '';
		}
		
		return sprintf(
			'<span class="es-checkbox colored" style="background:'.$color.'"><input type="checkbox" name="%s[]" id="%s" value="%s"'.$selected.' /> %s</span>',
			esc_attr($name),
			esc_attr(sanitize_title($name)),
			esc_attr(strtolower($label)),
			esc_attr($label)
		);
	}

	/*
		Links neccessary scripts
	*/
	function enqueue_scripts_styles() {
		wp_enqueue_script('jquery');

		if(is_admin()) {
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('custom-menu-settings', $this->url . 'js/main.js');
			wp_enqueue_style('custom-menu-style', $this->url . 'style.css');
		}
	}

	/*
		Inits the scripts for the current boxes
	*/
	function init_js() { ?>
		<script type="text/javascript">
		jQuery(function() {
			init_accrodion_settings('<?php echo $this->settings["post_type_name"] ?>', '<?php echo $this->url ?>');
		});
		</script>
	<?php }
	
}