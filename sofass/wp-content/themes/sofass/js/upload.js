jQuery(document).ready(function($){
	"use strict";
	var sofass_upload;
	var sofass_selector;

	function sofass_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		sofass_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( sofass_upload ) {
			sofass_upload.open();
			return;
		} else {
			// Create the media frame.
			sofass_upload = wp.media.frames.sofass_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			sofass_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = sofass_upload.state().get('selection').first();

				sofass_upload.close();
				sofass_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					sofass_selector.find('.sofass_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		sofass_upload.open();
	}

	function sofass_remove_file(selector) {
		selector.find('.sofass_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.sofass_upload_image_action .remove-image', function(event) {
		sofass_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.sofass_upload_image_action .add-image', function(event) {
		sofass_add_file(event, $(this).parent().parent());
	});

});