jQuery(document).ready(function($) {
	"use strict";

	var iconKeyUpTimeout = null;

    $('.thefoxmenu_icon_field .4k_icon_field').each(function() {
        // var paramName = $(this).attr('data-param-name');
		var cssUrl = $(this).attr('data-icon-css-path');

		// Load all CSS of the fonts, only do this once
		if ( $('[data-4k-icon-css-admin]').length === 0 ) {
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/elg.css" type="text/css" data-4k-icon-css-admin="1" />')
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/fa.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/imf.css" type="text/css" data-4k-icon-css-admin="1" />')
		}

		// update the icon preview
		$(this).prev().html('<i class="' + $(this).val() + '"></i>');


    }).on('keyup', function() {
		$(this).prev().html('<i class="' + $(this).val() + '"></i>');

		if ( iconKeyUpTimeout !== null ) {
			clearTimeout( iconKeyUpTimeout );
			iconKeyUpTimeout = null;
		}

		var $this = $(this);
		iconKeyUpTimeout = setTimeout( function() {
			var $displayArea = $this.parent().find('.fourk_select_window');
			$displayArea.html('').show();

			$.each(menu4kIcons, function(i) {
			    var rSearchTerm = new RegExp($this.val(),'i');
				if ( $this.val().indexOf('-') !== -1 ) {
					rSearchTerm = new RegExp("^" + $this.val(),'i');
				}
			    if (menu4kIcons[i].match(rSearchTerm)) {
					setTimeout( function() {
						$('<i class="' + menu4kIcons[i] + '"></i>').prependTo($displayArea);
					}, 10 );
			    }
			});
		}, 500 );
    });

	$('.thefoxmenu_icon_field .4k_icon_field ~ .fourk_select_window').on('click', 'i', function() {
		var $field = $(this).parents('.fourk_select_window').parent().find('input');
		$field.val($(this).attr('class'))
		.prev().html('<i class="' + $field.val() + '"></i>');
	});

	$('.thefoxmenu_icon_field .4k_icon_filter').change(function() {
		var $field = $(this).parent().find('input');
		if ( $(this).val() === '' ) {
			// nothing
		} else if ( $(this).val() === 'all' ) {
			$field.val('').trigger('keyup');
		} else {
			$field.val($(this).val()).trigger('keyup');
		}
	});
});