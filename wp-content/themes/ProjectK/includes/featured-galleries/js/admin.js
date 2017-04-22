jQuery(document).ready(function($){

	// Uploading files

	if (jQuery('#fg_removeall').hasClass('premp6')) {var button = '<button class="media-modal-icon"></button>';}

	else {var button = '<button></button>';}
	
	jQuery('#fg_select').on('click', function(event){
	
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			fixBackButton();
			return;
		}
		
		// Create the media frame.
		var file_frame = wp.media.frame = wp.media({
			frame: "post",
			state: "featured-gallery",
			library : { type : 'image'},
			button: {text: "Edit Image Order"},
			multiple: true
		});

		// Create Featured Gallery state. This is essentially the Gallery state, but selection behavior is altered.
		file_frame.states.add([
			new wp.media.controller.Library({
				id:         'featured-gallery',
				title:      'Select Images for Gallery',
				priority:   20,
				toolbar:    'main-gallery',
				filterable: 'uploaded',
				library:    wp.media.query( file_frame.options.library ),
				multiple:   file_frame.options.multiple ? 'reset' : false,
				editable:   true,
				allowLocalEdits: true,
				displaySettings: true,
				displayUserSettings: true
			}),
		]);
		
		file_frame.on('open', function() {
			var selection = file_frame.state().get('selection');
			var library = file_frame.state('gallery-edit').get('library');
			var ids = jQuery('#fg_perm_metadata').val();
			if (ids) {
				idsArray = ids.split(',');
				idsArray.forEach(function(id) {
					attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
				});
				file_frame.setState('gallery-edit');
				idsArray.forEach(function(id) {
					attachment = wp.media.attachment(id);
					attachment.fetch();
					library.add( attachment ? [ attachment ] : [] );
				});
			}
		});

		file_frame.on('ready', function() {
			jQuery( '.media-modal' ).addClass( 'no-sidebar' );
		});

		file_frame.on('change', function() {
			fixBackButton();
		});
		 
		// When an image is selected, run a callback.
		file_frame.on('update', function() {
			var imageIDArray = [];
			var imageHTML = '';
			var metadataString = '';
			images = file_frame.state().get('library');
			images.each(function(attachment) {
				imageIDArray.push(attachment.attributes.id);
				imageHTML += '<li>'+button+'<img id="'+attachment.attributes.id+'" src="'+attachment.attributes.url+'"></li>';
			});
			metadataString = imageIDArray.join(",");
			if (metadataString) {
				jQuery("#fg_perm_metadata").val(metadataString);
				jQuery("#featuredgallerydiv ul").html(imageHTML);
				jQuery('#fg_select').text('Edit Selection');
				jQuery('#fg_removeall').addClass('visible');
				setTimeout(function(){
					ajaxUpdateTempMetaData();
				},0);
			}
		});
		 
		// Finally, open the modal
		file_frame.open();

	});

	jQuery('#featuredgallerydiv ul').on('click', 'button', function(event){

		event.preventDefault();

		if (confirm('Are you sure you want to remove this image?')) {

			var removedImage = jQuery(this).parent().children('img').attr('id');

			var oldGallery = jQuery("#fg_perm_metadata").val();

			var newGallery = oldGallery.replace(','+removedImage,'').replace(removedImage+',','').replace(removedImage,'');

			jQuery(this).parent('li').remove();

			jQuery("#fg_perm_metadata").val(newGallery);

			if (newGallery == "") {

				jQuery('#fg_select').text('Select Images');

				jQuery('#fg_removeall').removeClass('visible');

			}

			ajaxUpdateTempMetaData();

		}

	});

	jQuery('#fg_removeall').on('click', function(event){

		event.preventDefault();

		if (confirm('Are you sure you want to remove all images?')) {

			jQuery("#featuredgallerydiv ul").html("");

			jQuery("#fg_perm_metadata").val("");

			jQuery('#fg_removeall').removeClass('visible');

			jQuery('#fg_select').text('Select Images');

			ajaxUpdateTempMetaData();

		}

	});

});

function fixBackButton() {

	setTimeout(function(){

		jQuery('.media-menu a:first-child').text('← Edit Selection').addClass('button').addClass('button-large').addClass('button-primary');

	},0);

}

function ajaxUpdateTempMetaData() {

	jQuery.ajax({
		type : "post",
		dataType : "json",
		url : myAjax.ajaxurl,
		data : {
			action: "fg_update_temp", 
			fg_post_id: jQuery("#fg_perm_metadata").data("post_id"), 
			fg_temp_noncedata: jQuery("#fg_temp_noncedata").val(), 
			fg_temp_metadata: jQuery("#fg_perm_metadata").val()
		},
		success: function(response) {
			if (response == "error") {
				alert("There was an issue with updating the live preview. Make sure that you click Save to ensure your changes aren't lost.");
			}
		}
	});

}