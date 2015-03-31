(function($) {

	$.fn.upload_button = function() {
		return this.each(function(){
			var $btn     = $('.plupload-browse-button', this);
			var $input   = $('.image-id', this);
			var $preview = $input.closest('li').find('.image-preview');

			/* Media Library */
			if (typeof(crb_media_types) == 'undefined') {
				var crb_media_types = {};
			}

			// Runs when the image button is clicked.
			$btn.click(function (e) {
				// return;
				e.preventDefault();
				
				var row = $(this).closest('.carbon-field'),
					input_field = $input,
					button_label = 'Select Image',
					window_label = 'Images',
					value_type = 'url',
					file_type = 'image'; // audio, video, image
				
				if (typeof(crb_media_types['image'] == 'undefined')) {
					crb_media_types['image'] = wp.media.frames.crb_media_field = wp.media({
						title: window_label ? window_label : crbl10n.title,
						library: { type: 'image' }, // autio, video, image
						button: { text: button_label },
						multiple: false
					});
					
					var crb_media_field = crb_media_types['image'];
					
					// Runs when an image is selected.
					crb_media_field.on('select', function () {
						// Grabs the attachment selection and creates a JSON representation of the model.
						var media_attachment = crb_media_field.state().get('selection').first().toJSON();
						
						$preview.addClass('loading').find('img').remove();

						var $img = $('<img />');

						$img.appendTo($preview);

						$input.val( media_attachment['id'] );
						$img.load(function() {
							$(this).animate({
								opacity: 1
							}, 500, function() {
								$(this).parent().removeClass('loading');
							});
						});
						var image_src = media_attachment.sizes['thumbnail'].url;

						$img.css({ opacity: 0 }).attr('src', image_src).attr('width', 149).attr('height', 87);
					});
				}
				
				var crb_media_field = crb_media_types['image'];

				// Opens the media library frame
				crb_media_field.open();
			});		
		});
	}

	$.fn.custom_accordion = function(o) {
		// Enable toggle-able boxes
		$('.sortable .toggle').die('click').live('click', function() {
			var $item = $(this).closest('li');
			var speed = 300;

			if( $(this).closest('li').is('.open') ) {
				var title = $item.find('.title-field:eq(0)').val();
				var type  = $item.is('.type-image') ? 'Image' : 'Text';
				var $heading = $item.children('.title-wrap').find('h4,img');

				$heading
					[title ? 'removeClass' : 'addClass']('inactive')
					.animate({
						marginTop: 0
					}, speed)
					.find('.title-text').text( title ? title : 'Adding a new ' + type + ' Block ...' );

				if( $heading.is('.overall') ) {
					$('.overall', $heading).remove();

					totalImages = $item.find('li.type-image:not(.prototype)').size();
					totalText   = $item.find('li.type-text:not(.prototype)').size();

					totalImages += totalImages == 1 ? ' Image' : ' Images';
					totalText += totalText == 1 ? ' Text Block' : ' Text Blocks';

					$heading.append('<span class="overall"> (' + totalImages + ', ' + totalText + ')</span>');					
				}

				$item.find('.content').slideUp(speed);
				$item.removeClass('open');
				
			} else {
				$item.addClass('open');
				
				//.siblings('.open').find('.toggle:eq(0)').click();				

				$item.children('.title-wrap').find('h4,img').animate({
					marginTop: -30
				}, speed).find();

				$item.children('.content').slideDown(speed);
			}

			return false;
		});

		// Removing a row
		$('.remove.notext').die('click').live('click', function() {
			var $list = $(this).closest('li').parent();

			$(this).closest('li').fadeOut(function() {
				$(this).remove();
				$list.trigger('order_changed');
			});

			return false;
		});

		return this.each(function() {
			var $sortable    = $(this).children('.sortable'),
				$add_btn     = $(this).children('.add').size() ? $(this).children('.add') : $(this).siblings('.obo-top-row').find('.add'),
				$order_field = $(this).children('.order-field'),
				$prototype   = $sortable.children('.prototype'),
				current_i    = $sortable.children().size() - $prototype.size();


			// Fixes the order field
			var fix_order = function() {
				var order = [];

				$sortable.children(':not(.prototype,.ui-sortable-placeholder)').each(function() {
					order.push($(this).attr('data-id'));
				});

				$order_field.val(order.join(','));
			}

			// Bind an event to the ul
			$sortable.bind('order_changed.cs', fix_order);

			// Make the boxes sortable
			$sortable.sortable({
				handle: '.drag:eq(0)',
				axis: 'y',
				stop: fix_order
			});

			// Adding a new row
			$add_btn.click(function() {
				var $my_prototype;

				if( $(this).is('.add-text') || $(this).is('.add-image') ) {
					$my_prototype = $prototype.filter('.type-' + ( $(this).is('.add-text') ? 'text' : 'image' ));
				} else {
					$my_prototype = $prototype;
				}

				var $new_row = $my_prototype.clone().removeClass('prototype');
				$prototype.eq(0).before($new_row);

				$new_row.find('input,textarea,select').each(function(){
					if(typeof($(this).attr('name')) == 'undefined') {
						return;
					}

					$(this).attr('name', $(this).attr('name').replace(o.name_placeholder, current_i));
				});

				$new_row.attr('data-id', current_i);

				current_i++;

				$new_row.find('.uploader:not(.prototype .uploader)').upload_button();

				$new_row.fadeIn(function() {
					$(this).find('.toggle:eq(0)').click();
				});

				fix_order();

				$new_row.find('.cslides').custom_accordion({ name_placeholder: '%e%' })

				return false;
			});
		});
	}

	window.init_accrodion_settings = function(pt_name, menu_path) {
		var $type_switch = $('[name=menu_type]');
		var $default_box = $('#' + pt_name + '-default-box');
		var $custom_box  = $('#' + pt_name + '-obo-box');

		window.menu_path = menu_path;

		// Init the uploader
		$('.uploader:not(.prototype .uploader)').upload_button();

		// Init normal menus
		$('.cslides:not(.cparts)').custom_accordion({
			name_placeholder: '%d%'
		});

		// Init normal menus
		$('.cparts:not(.prototype .cparts)').custom_accordion({
			name_placeholder: '%e%'
		});
	}

})(jQuery);