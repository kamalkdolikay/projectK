jQuery(document).ready(function($) {
	"use strict";

	var iconKeyUpTimeout = null;

    $('.wpb_edit_form_elements .4k_icon_field').each(function() {
        // var paramName = $(this).attr('data-param-name');
		var cssUrl = $(this).attr('data-icon-css-path');

		// Load all CSS of the fonts, only do this once
		if ( $('[data-4k-icon-css-admin]').length === 0 ) {
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ba.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/bc.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/bk.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/br.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/business.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/cl.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/cn.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/creditcard.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ct.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/dr.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/draw.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ec.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ecommerce.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/elg.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/el.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/elu.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/en.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/fa.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/file.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/foa.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/fo.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ft.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/games.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/gesture.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ic.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/im.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/imf.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ion.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/lis.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ln.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ls.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/lp.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ma.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mi.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mfg.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mk.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mm.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mn.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mo.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/moon.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mp.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/mt.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ow.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/oi.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/payment.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/place.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/st.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/sw.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ty.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ty2.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/u8.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/u12.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/usa.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/wi.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/wl.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/ws.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/wb.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/zm.css" type="text/css" data-4k-icon-css-admin="1" />');
			$('head').append('<link rel="stylesheet" href="' + cssUrl + 'icons/css/zo.css" type="text/css" data-4k-icon-css-admin="1" />');
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

			$.each(all4kIcons, function(i) {
			    var rSearchTerm = new RegExp($this.val(),'i');
				if ( $this.val().indexOf('-') !== -1 ) {
					rSearchTerm = new RegExp("^" + $this.val(),'i');
				}
			    if (all4kIcons[i].match(rSearchTerm)) {
					setTimeout( function() {
						$('<i class="' + all4kIcons[i] + '"></i>').prependTo($displayArea);
					}, 10 );
			    }
			});
		}, 500 );
    });

	$('.wpb_edit_form_elements .4k_icon_field ~ .fourk_select_window').on('click', 'i', function() {
		var $field = $(this).parents('.fourk_select_window').parent().find('input');
		$field.val($(this).attr('class'))
		.prev().html('<i class="' + $field.val() + '"></i>');
	});

	$('.wpb_edit_form_elements .4k_icon_filter').change(function() {
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