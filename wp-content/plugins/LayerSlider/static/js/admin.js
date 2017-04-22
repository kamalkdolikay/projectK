if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function (searchElement /*, fromIndex */ ) {
		"use strict";
		if (this === null) {
			throw new TypeError();
		}
		var t = Object(this);
		var len = t.length >>> 0;
		if (len === 0) {
			return -1;
		}
		var n = 0;
		if (arguments.length > 1) {
			n = Number(arguments[1]);
			if (n != n) { // shortcut for verifying if it's NaN
				n = 0;
			} else if (n != 0 && n != Infinity && n != -Infinity) {
				n = (n > 0 || -1) * Math.floor(Math.abs(n));
			}
		}
		if (n >= len) {
			return -1;
		}
		var k = n >= 0 ? n : Math.max(len - Math.abs(n), 0);
		for (; k < len; k++) {
			if (k in t && t[k] === searchElement) {
				return k;
			}
		}
		return -1;
	};
}


function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function ucFirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}


(function( $ ) {

	$.fn.customCheckbox = function() {
		return this.each(function() {

			// Get element & hide it
			var $el = $(this).hide();

			// Create replacement element
			var $rep = $('<a href="#"><span></span></a>').addClass('ls-checkbox').insertAfter(this);

			// Check help attr
			if($el.attr('data-help') !== "undefined") {
				$rep.attr('data-help', $el.attr('data-help'));
			}

			// Set default state
			if($el.prop('checked')) {
				$rep.addClass('on');
			} else {
				$rep.addClass('off');
			}
		});
	};
})( jQuery );


var lsScreenOptionsActions = {

	init : function() {

		// Form submit
		jQuery(document).on('submit', '#ls-screen-options-form', function(e) {
			e.preventDefault(); lsScreenOptionsActions.saveSettings(this, true);
		});

		// Checkboxes
		jQuery(document).on('click', '#ls-screen-options-form input:checkbox', function() {
			var reload = false;
			if(typeof lsScreenOptionsActions[ jQuery(this).attr('name')] != "undefined") {
				lsScreenOptionsActions[ jQuery(this).attr('name')](this); }

			if(jQuery(this).hasClass('reload')) { reload = true; }

			lsScreenOptionsActions.saveSettings( jQuery(this).closest('form'), reload );
		});
	},

	saveSettings : function(form, reload) {

		var options = {};
		jQuery(form).find('input').each(function() {
			if( jQuery(this).is(':checkbox')) {
				options[jQuery(this).attr('name')] = jQuery(this).prop('checked');
			} else {
				options[jQuery(this).attr('name')] = jQuery(this).val();
			}
		});

		// Save settings
		jQuery.post(ajaxurl, jQuery.param({ action : 'ls_save_screen_options', options : options }), function() {
			if(typeof reload != "undefined" && reload === true) {
				document.location.href = 'admin.php?page=layerslider';
			}
		});
	},

	showTooltips : function(el) {

		if( jQuery(el).prop('checked') === true ) {
			lsTooltip.init();
		} else {
			lsTooltip.destroy();
		}
	}
};

var LS_BoxToggles = {

	init : function() {
		jQuery('.ls-box-toggle').click(function() {

			// Get parent
			var parent = jQuery(this).closest('.ls-box');
			var button = jQuery(this);

			// Check state
			if(parent.hasClass('collapsed')) {
				parent.removeClass('collapsed');
				button.removeClass('dashicons-arrow-right').addClass('dashicons-arrow-down');
				jQuery.post(ajaxurl, {
					action : 'ls_update_box_toggles',
					key : button.attr('id'),
					collapsed : false
				});
			} else {
				parent.addClass('collapsed');
				button.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-right');
				jQuery.post(ajaxurl, {
					action : 'ls_update_box_toggles',
					key : button.attr('id'),
					collapsed : true
				});
			}
		});
	}
};


var lsTooltip = {
	timeout : 0,

	init : function() {

		jQuery(document).on('mouseover', '[data-help]', function() {
			var el = this;
			lsTooltip.timeout = setTimeout(function() {
				lsTooltip.open(el);
			}, 400);
		});

		jQuery(document).on('mouseout', '[data-help]', function() {
			clearTimeout(lsTooltip.timeout);
			lsTooltip.close();
		});
	},

	destroy : function() {

		jQuery(document).off('mouseover', '[data-help]');
		jQuery(document).off('mouseout', '[data-help]');
	},

	open : function(el) {

		// Create tooltip
		jQuery('body').prepend( jQuery('<div>', { 'class' : 'ls-tooltip' })
			.append( jQuery('<div>', { 'class' : 'inner' }))
			.append( jQuery('<span>') )
		);

		// Get tooltip
		var tooltip = jQuery('.ls-tooltip');

		// Set tooltip text
		tooltip.find('.inner').html( jQuery(el).data('help') );

		// Get viewport dimensions
		var v_w = jQuery(window).width();

		// Get element dimensions
		var e_w = jQuery(el).width();

		// Get element position
		var e_l = jQuery(el).offset().left;
		var e_t = jQuery(el).offset().top;

		// Get toolip dimensions
		var t_w = tooltip.outerWidth();
		var t_h = tooltip.outerHeight();

		// Position tooltip
		tooltip.css({ top : e_t - t_h - 10, left : e_l - (t_w - e_w) / 2  });
		// Fix right position
		if(tooltip.offset().left + t_w > v_w) {
			tooltip.css({ 'left' : 'auto', 'right' : 10 });
			tooltip.find('span').css({ left : 'auto', right : v_w - jQuery(el).offset().left - jQuery(el).outerWidth() / 2 - 17, marginLeft : 'auto' });
		}

	},

	close : function() {
		jQuery('.ls-tooltip').remove();
	}
};

var LayerSlider = {

	uploadInput : null,
	dragIndex : 0,
	newIndex : 0,
	timeout : 0,
	counter : 0,

	selectMainTab : function(el) {

		// Remove highlight from the other tabs
		jQuery('#ls-main-nav-bar a').removeClass('active');

		// Highlight selected tab
		jQuery(el).addClass('active');

		// Hide other pages
		jQuery('#ls-pages .ls-page').removeClass('active');

		// Show selected page
		jQuery('#ls-pages .ls-page').eq( jQuery(el).index() ).addClass('active');

		// Init CodeMirror
		if(jQuery(el).hasClass('callbacks')) {
			if(jQuery('.ls-callback-page .CodeMirror-code').length === 0) {
				LS_CodeMirror.init({ mode: 'javascript', autofocus : false, styleActiveLine : false });
				jQuery(window).scrollTop(0);
			}
		}
	},


	selectSettingsTab : function(li) {
		var index = jQuery(li).index();
		jQuery(li).siblings().removeClass('active');
		jQuery(li).addClass('active');
		jQuery('div.ls-settings-contents tbody.active').removeClass('active');
		jQuery('div.ls-settings-contents tbody').eq(index).addClass('active');

		// SliderStyle Editor
		if(jQuery(li).hasClass('codemirror')) {
			if(jQuery('div.ls-settings-contents tbody:eq('+index+') .CodeMirror-code').length === 0) {
				var cm = CodeMirror.fromTextArea( jQuery('div.ls-settings-contents tbody:eq('+index+') textarea.ls-codemirror')[0], {
					mode: 'css', theme: 'solarized', lineWrapping : true
				});
				cm.on("change", function(instance) {
					instance.getTextArea().value = instance.getValue();
				});
			}
		}
	},

	addLayer : function() {

		// Clone the sample layer page
		var clone = jQuery('#ls-sample > div').clone();

		// Append to place
		clone.appendTo('#ls-layers');

		// Close other layers
		jQuery('#ls-layer-tabs a').removeClass('active');

		// Get layer index
		var index = clone.index();

		// Add layer tab
		var tab = jQuery('<a href="#">Slide #'+(index+1)+'<span class="dashicons dashicons-dismiss"></span>').insertBefore('#ls-add-layer');

		// Open new layer
		tab.click();

		// Add sortables
		LayerSlider.addSortables();

		// Generate preview
		LayerSlider.generatePreview(index);
		LayerSlider.addPreviewSlider( jQuery('.ls-editor-slider', clone) );
		LayerSlider.addColorPicker( clone.find('.ls-colorpicker') );
	},

	removeLayer : function(el) {

		if(confirm('Are you sure you want to remove this slide?')) {

			// Get menu item
			var item = jQuery(el).parent();

			// Get layer
			var layer = jQuery(el).closest('#ls-layer-tabs').next().children().eq( item.index() );

			// Open next or prev layer
			if(layer.next().length > 0) {
				item.next().click();

			} else if(layer.prev().length > 0) {
				item.prev().click();
			}

			// Remove menu item
			item.remove();

			// Remove the layer
			layer.remove();

			// Reindex layers
			LayerSlider.reindexLayers();
		}
	},

	selectLayer : function(el) {

		// Close other layers
		jQuery('#ls-layer-tabs a').removeClass('active');
		jQuery('#ls-layers .ls-layer-box').removeClass('active');

		// Open new layer
		jQuery(el).addClass('active');
		jQuery('#ls-layers .ls-layer-box').eq( jQuery(el).index() ).addClass('active');

		// Open first sublayer
//		jQuery('#ls-layers .ls-layer-box').eq( jQuery(el).index() ).find('.ls-sublayers td:first').click();

		// Update preview
		LayerSlider.generatePreview( jQuery(el).index() );

		// Stop preview
		LayerSlider.stop();

		// Hide Timeline
		lsTimeLine.hide( jQuery('.ls-tl') );
	},

	duplicateLayer : function(el) {

		// Clone fix
		LayerSlider.cloneFix();

		// Get layer index
		var index = jQuery(el).closest('.ls-layer-box').index();

		// Append new tab
		jQuery('<a href="#">Slide #0<span class="dashicons dashicons-dismiss"></span></a>').insertBefore('#ls-layer-tabs a:last');

		// Rename tab
		LayerSlider.reindexLayers();

		// Clone layer
		var clone = jQuery(el).closest('.ls-layer-box').clone();

		// Append new layer
		clone.appendTo('#ls-layers');

		// Remove active class if any
		clone.removeClass('active');

		// Add sortables
		LayerSlider.addSortables();

		// Color picker
		jQuery('.ls-editor-slider', clone).empty().next().text('100%');
		LayerSlider.addPreviewSlider( jQuery('.ls-editor-slider', clone) );
		clone.find('.ls-colorpicker').minicolors('destroy');
		LayerSlider.addColorPicker( clone.find('.ls-colorpicker') );
	},

	addPreviewSlider : function(target) {

		jQuery(target).slider({
			value: 1,
			min: 0.3,
			max: 2,
			step: 0.1,
			range: 'min',
      		orientation: "horizontal",
      		slide : function(event, ui) {

      			// Set value
      			jQuery(ui.handle).parent().next().text(''+parseInt(ui.value*100)+'%');

      			// Get vars
      			var $slide = jQuery(ui.handle).closest('.ls-layer-box');
      			var $preview = $slide.find('.ls-preview-wrapper').css('zoom', ui.value);
      		}
		});
	},

	addSublayer : function(el) {

		// Get clone from sample
		var clone = jQuery('#ls-sample .ls-sublayers > tr').clone();

		// Appent to place
		clone.appendTo( jQuery(el).prev().find('.ls-sublayers') );

		// Get sublayer index
		var index = clone.index();

		// Rewrite sublayer number
		clone.find('.ls-sublayer-number').html( index + 1);
		clone.find('.ls-sublayer-title').val('Layer #' + (index + 1) );

		// Open it
		clone.click();
		LayerSlider.addColorPicker( clone.find('.ls-colorpicker') );
	},

	selectSubLayer : function(el) {

		if(jQuery(el).index() == jQuery(el).parent().children('.active:first').index() ) {
			return;
		}

		// Close other sublayers
		jQuery(el).parent().children().removeClass('active');

		// Open the new one
		jQuery(el).addClass('active');

		// Hide Timeline
		lsTimeLine.hide( jQuery(el).closest('table').find('.ls-tl') );
	},

	selectSublayerPage : function(el) {

		// Close previous page
		jQuery(el).parent().children().removeClass('active');
		jQuery(el).parent().next().find('.ls-sublayer-page').removeClass('active');

		// Open the selected one
		jQuery(el).addClass('active');
		jQuery(el).parent().next().find('.ls-sublayer-page').eq( jQuery(el).index() ).addClass('active');
	},

	removeSublayer : function(el) {

		if(!confirm('Are you sure you want to remove this layer?')) {
			return;
		}

		// Get sublayer
		var sublayer = jQuery(el).closest('tr');

		// Get layer index
		var layer = jQuery(el).closest('.ls-layer-box');

		// Open the next or prev sublayer
		if(sublayer.next().length > 0) {
			sublayer.next().click();

		} else if(sublayer.prev().length > 0) {
			sublayer.prev().click();
		}

		// Remove menu item
		jQuery(el).remove();

		// Remove sublayer
		sublayer.remove();

		// Update preview
		LayerSlider.generatePreview( layer.index() );
	},

	highlightSublayer : function(el) {

		if(!jQuery(el).hasClass('active')) {

			// Deselect other checkboxes
			jQuery('.ls-highlight').removeClass('active');
			jQuery(el).addClass('active');

			// Restore sublayers in the preview
			jQuery(el).closest('.ls-layer-box').find('.draggable').children().css({ opacity : 0.5 });

			// Get element index
			var index = jQuery(el).closest('tr').index();

			// Highlight selected one
			jQuery(el).closest('.ls-layer-box').find('.draggable').children().eq(index).css({ zIndex : 1000, opacity : 1 });

		} else {

			// Restore sublayers in the preview
			jQuery(el).removeClass('active');
			jQuery(el).closest('.ls-layer-box').find('.draggable').children().each(function(index) {
				jQuery(this).css({ zIndex : 10 + index });
				jQuery(this).css('opacity', 1);
			});
		}
	},

	eyeSublayer : function(el) {

		if(jQuery(el).hasClass('active')) {
			jQuery(el).removeClass('active');
		} else {
			jQuery(el).addClass('active');
		}

		// Update preview
		LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
	},

	lockSublayer : function(el) {

		if(jQuery(el).hasClass('active')) {
			jQuery(el).removeClass('active');
		} else {
			jQuery(el).addClass('active');
		}

		// Update preview
		LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
	},

	addColorPicker : function(el) {
		jQuery(el).minicolors({
			opacity: true,
			changeDelay : 100,
			position: 'bottom right',
			change : function(hex, opacity) {
				LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
			}
		});
	},

	duplicateSublayer : function(el) {

		// Clone fix
		LayerSlider.cloneFix();

		// Clone sublayer
		var clone = jQuery(el).closest('.ls-sublayer-wrapper').closest('tr').clone();

		// Remove active class
		clone.removeClass('active');

		// Append
		clone.appendTo( jQuery(el).closest('.ls-sublayers')  );

		// Rename sublayer
		clone.find('.ls-sublayer-title').val( clone.find('.ls-sublayer-title').val() + ' copy' );
		LayerSlider.reindexSublayers();

		// Update preview
		LayerSlider.generatePreview( jQuery(el).closest('.ls-layer-box').index() );

		// Color picker
		clone.find('.ls-colorpicker').minicolors('destroy');
		LayerSlider.addColorPicker( clone.find('.ls-colorpicker') );
	},

	skipSublayer : function(el) {

		LayerSlider.generatePreview( jQuery(el).closest('.ls-layer-box').index()  );
	},

	selectMediaType : function(el) {

		// Layer and sections
		var layer = jQuery(el).closest('.ls-sublayer-page');
		var section = jQuery(el).data('section');
		var sections = jQuery('.ls-layer-sections', layer).children();

		// Set active class
		jQuery(el).siblings().removeAttr('class');
		jQuery(el).attr('class', 'active');

		// Store selection
		jQuery('input[name="media"]', layer).val(section);

		// Show the corresponding sections
		sections.hide().removeClass('ls-hidden');
		jQuery('.ls-sublayer-element', layer).hide().removeClass('ls-hidden');
		jQuery('.ls-html-code p', layer).hide().removeClass('ls-hidden');
		switch(section) {
			case 'img': sections.eq(0).show(); break;
			case 'text':
				sections.eq(1).show();
				layer.find('.ls-sublayer-element').show();
				break;
			case 'html':
				sections.eq(1).show();
				jQuery('.ls-html-code p', layer).show();
				break;
			case 'post':
				sections.eq(1).show();
				sections.eq(2).show();
				break;
		}

		LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
	},

	selectElementType : function(el) {

		// Layer and properties
		var layer = jQuery(el).closest('.ls-sublayer-page');
		var element = jQuery(el).data('element');

		// Set active class
		jQuery(el).siblings().removeClass('active');
		jQuery(el).addClass('active');

		// Store selection
		jQuery('input[name="type"]', layer).val(element);
		LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
	},


	willGeneratePreview : function(index) {
		clearTimeout(LayerSlider.timeout);
		LayerSlider.timeout = setTimeout(function() {

			if(index == -1) {
				jQuery('#ls-layers .ls-layer-box').each(function( index ) {
					LayerSlider.generatePreview(index);
				});
			} else {
				LayerSlider.generatePreview(index);
			}
		}, 1000);
	},

	generatePreview : function(index) {

		// Get main elements
		var slide = jQuery('#ls-layers .ls-layer-box').eq(index);
		var preview = jQuery('.ls-preview').eq( index + 1 );
		var draggable = preview.find('.draggable');
		var $settings = jQuery('.ls-settings');

		// Get sizes
		var width = jQuery('input[name="width"]', $settings).val();
		var height = jQuery('input[name="height"]', $settings).val();
			height = (height.indexOf('%') != -1) ? 400 : height;
		var sub_container = jQuery('input[name="sublayercontainer"]', $settings).val();

		// Which width?
		if(sub_container != '' && sub_container != 0) {
			width = sub_container;
		}

		// Set sizes
		preview.add(draggable).css({ width : width, height : height });
		preview.parent().css({ width : width });

		// Get post content if any
		var posts = window.lsPostsJSON;
		var postOffset = jQuery('input[name="post_offset"]', slide).val();

		if(postOffset == -1) { postOffset = index; }
		var post = posts[postOffset];

		// Get backgrounds
		var bgColor = jQuery('input[name="backgroundcolor"]', $settings).val();
			bgColor = (bgColor !== '') ? bgColor : 'transparent';

		var bgImage = jQuery('input[name="backgroundimage"]', $settings).val();
			bgImage = (bgImage !== '') ? 'url('+bgImage+')' : 'none';

		// Set backgrounds
		preview.css({ backgroundColor : bgColor });
		preview.css({ backgroundImage : bgImage });


		// Get yourLogo
		var yourLogo = jQuery('input[name="yourlogo"]', $settings).val();
		var yourLogoStyle = jQuery('input[name="yourlogostyle"]', $settings).val();

		// Remove previous yourLogo
		preview.parent().find('.yourlogo').remove();

		// Set yourLogo
		if(yourLogo && yourLogo !== '') {
			var logo = jQuery('<img src="'+yourLogo+'" class="yourlogo">').prependTo( jQuery(preview).parent() );
			logo.attr('style', yourLogoStyle);

			var oL = oR = oT = oB = 'auto';

			if( logo.css('left') != 'auto' ){
				var logoLeft = logo[0].style.left;
			}
			if( logo.css('right') != 'auto' ){
				var logoRight = logo[0].style.right;
			}
			if( logo.css('top') != 'auto' ){
				var logoTop = logo[0].style.top;
			}
			if( logo.css('bottom') != 'auto' ){
				var logoBottom = logo[0].style.bottom;
			}

			if( logoLeft && logoLeft.indexOf('%') != -1 ){
				oL = width / 100 * parseInt( logoLeft ) - logo.width() / 2;
			}else{
				oL = parseInt( logoLeft );
			}

			if( logoRight && logoRight.indexOf('%') != -1 ){
				oR = width / 100 * parseInt( logoRight ) - logo.width() / 2;
			}else{
				oR = parseInt( logoRight );
			}

			if( logoTop && logoTop.indexOf('%') != -1 ){
				oT = height / 100 * parseInt( logoTop ) - logo.height() / 2;
			}else{
				oT = parseInt( logoTop );
			}

			if( logoBottom && logoBottom.indexOf('%') != -1 ){
				oB = height / 100 * parseInt( logoBottom ) - logo.height() / 2;
			}else{
				oB = parseInt( logoBottom );
			}

			logo.css({
				left : oL,
				right : oR,
				top : oT,
				bottom : oB
			});
		}

		// Get slide background
		var background = jQuery('input[name="background"]', slide).val();
		if(background == '[image-url]') {
			background = post['image-url'];
			jQuery('.slide-image:eq(0) img', slide).attr('src', post['image-url']);
		}

		// Set slide background
		if(background != '') {
			draggable.css({
				backgroundImage : 'url('+background+')',
				backgroundPosition : 'center center'
			});
		} else {
			draggable.css({
				backgroundImage : 'none'
			});
		}

		// Empty draggable
		draggable.children().remove();

		// Iterate over the sublayers
		jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-sublayers > tr').each(function(layerkey) {

			if(jQuery('input[name="skip"]', this).prop('checked')) {
				jQuery('<div>').appendTo(draggable).hide();
				return true; }

			if(jQuery('.ls-icon-eye', this).hasClass('active')) {
				jQuery('<div>').appendTo(draggable).hide();
				return true;
			}

			var item;
			var type = jQuery('input[name="type"]', this).val();
			var html = jQuery('textarea[name="html"]', this).val();
			switch( jQuery('input[name="media"]', this).val() ) {
				case 'img': type = 'img'; break;
				case 'html': type = 'div'; break;
				case 'post': type = 'post'; break;
			}
			var id = jQuery('input[name="id"]', this).val();
			var classes = jQuery('input[name="class"]', this).val();

			// Append element
			if(type == 'img') {
				var url = jQuery('input[name="image"]', this).val();

				if(url == '[image-url]') {
					url = post['image-url'];
					jQuery('.slide-image:eq(0) img', this).attr('src', post['image-url']);
				}

				var tmpContent = (url !== '') ? '<img src="'+url+'">' : '<div>';
				item = jQuery(tmpContent).appendTo(draggable);

			} else if(type == 'post') {

				var textlength = jQuery('input[name="post_text_length"]', this).val();
				for(var key in post) {
					if(html.indexOf('['+key+']') !== -1) {
						if( (key == 'title' || key == 'content' || key == 'excerpt') && textlength > 0) {
							post[key] = post[key].substr(0, textlength);
						}
						html = html.replace('['+key+']', post[key]);
					}
				}

				// Test for html wrapper
				html = jQuery.trim(html);
				var first = html.substr(0, 1);
				var last = html.substr(html.length-1, 1);
				if(first == '<' && last == '>') {
					html = html.replace(/(\r\n|\n|\r)/gm,"");
					item = jQuery(html).appendTo(draggable);
				} else {
					item = jQuery('<div>').html(html).appendTo(draggable);
				}

			} else {
				item = jQuery('<'+type+'>').appendTo(draggable);
				if(html !== '') { item.html(html); }
			}


			// Editor options
			if(jQuery('.ls-icon-lock', this).hasClass('active')) {
				item.addClass('disabled'); }

			// Get style settings
			var top = jQuery('input[name="top"]', this).val();
			var left = jQuery('input[name="left"]', this).val();
			var custom = jQuery('textarea[name="style"]', this).val();

			// Styles
			var styles = {};
			jQuery('.ls-sublayer-style input.auto', this).each(function() {
				var cssVal = jQuery(this).val();
				var cssProp = jQuery(this).attr('name');
				if(cssVal === '') {
					return true;
				}

				if(cssVal.slice(-1) == ';' ) {
					cssVal = cssVal.substring(0, cssVal.length - 1);
				}

				styles[cssProp] = isNumber(cssVal) ? cssVal + 'px' : cssVal;
			});

			// Apply style settings and attributes
			item.attr('style', custom).css(styles);
			item.attr('id', id).addClass(classes);
			if(jQuery('input[name="wordwrap"]', this).prop('checked') === false) {
				item.css('white-space', 'nowrap');
			}

			var pt = isNaN( parseInt( item.css('padding-top') ) ) ? 0 : parseInt( item.css('padding-top') );
			var pl = isNaN( parseInt( item.css('padding-left') ) ) ? 0 : parseInt( item.css('padding-left') );
			var bt = isNaN( parseInt( item.css('border-top-width') ) ) ? 0 : parseInt( item.css('border-top-width') );
			var bl = isNaN( parseInt( item.css('border-left-width') ) ) ? 0 : parseInt( item.css('border-left-width') );

			var setPositions = function(){

				// Position the element
				if(top.indexOf('%') !== -1) {
					item.css({ top : draggable.height() / 100 * parseInt( top ) - item.height() / 2 - pt - bt });
				} else {
					item.css({ top : parseInt(top) });
				}

				if(left.indexOf('%') !== -1) {
					item.css({ left : draggable.width() / 100 * parseInt( left ) - item.width() / 2 - pl - bl });
				} else {
					item.css({ left : parseInt(left) });
				}
			};

			if( item.is('img') ){

				item.load(function(){
					setPositions();
				}).attr('src',item.attr('src') );
			}else{
				setPositions();
			}

			// Z-index
			item.css({ zIndex : 10 + item.index() });
		});


		// Add draggable
		LayerSlider.addDraggable();
	},

	openMediaLibrary : function() {

		// New 3.5 media uploader
		if(newMediaUploader == true) {

			jQuery(document).on('click', '.ls-upload', function(e) {
				e.preventDefault();

				uploadInput = this;

				// Get library type
				var type = jQuery(this).hasClass('ls-insert-media') ? 'video,audio' : 'image';

				if(jQuery(this).hasClass('ls-insert-media') || jQuery(this).hasClass('ls-mass-upload')) {
					var multiple = true;
				} else {
					var multiple = false;
				}

				// Media Library params
				var frame = wp.media({
					title : 'Pick an image to use it in LayerSlider WP',
					multiple : multiple,
					library : { type : type },
					button : { text : 'Insert' }
				});

				// Runs on select
				frame.on('select',function() {

					// Image with preview
					var attachment = frame.state().get('selection').first().toJSON();
					var attachments = frame.state().get('selection').toJSON();

					if( jQuery(uploadInput).hasClass('ls-mass-upload') ) {

						// Get layer
						var layer = jQuery(uploadInput).closest('.ls-layer-box');
						var sublayer = layer.find('.ls-sublayers > tr:last-child');

						// Set first image
						jQuery(uploadInput).prev().val(attachment.url);
						jQuery(uploadInput).prev().prev().val(attachment.id);
						if(typeof attachment.sizes.thumbnail != "undefined") {
							jQuery(uploadInput).find('img').attr('src', attachment.sizes.thumbnail.url);
						} else {
							jQuery(uploadInput).find('img').attr('src', attachment.sizes.full.url);
						}

						for(c = 1; c < attachments.length; c++) {
							var count = layer.find('.ls-sublayers > tr').length + 1;
							var clone = jQuery('#ls-sample .ls-sublayers > tr').clone();
							var input = clone.appendTo( layer.find('.ls-sublayers') ).find('div.ls-image');

								input.prev().val(attachments[c].url);
								input.prev().prev().val(attachments[c].id);
								if(typeof attachments[c].sizes.thumbnail != "undefined") {
									input.find('img').attr('src', attachments[c].sizes.thumbnail.url);
								} else {
									input.find('img').attr('src', attachments[c].sizes.full.url);
								}
								clone.find('input[name="subtitle"]').val('Layer #' + count);
								clone.find('.ls-sublayer-number').text(count);
						}

						// Expand lastly inserted layer
						if(typeof clone != "undefined") {
							clone.click();
						}

					} else if( jQuery(uploadInput).is('div.ls-image') ) {
						jQuery(uploadInput).prev().val(attachment.url);
						jQuery(uploadInput).prev().prev().val(attachment.id);
						if(typeof attachment.sizes.thumbnail != "undefined") {
							jQuery(uploadInput).find('img').attr('src', attachment.sizes.thumbnail.url);
						} else {
							jQuery(uploadInput).find('img').attr('src', attachment.sizes.full.url);
						}

					// Multimedia HTML
					} else if( jQuery(uploadInput).hasClass('ls-insert-media')) {

						var hasVideo = false;
						var hasAudio = false;

						var videos = [];
						var audios = [];

						var mediaHTML = '';

						// Iterate over selected items
						for(c = 0; c < attachments.length; c++) {
							var url = '/' + attachments[c].url.split('/').slice(3).join('/');
							if(attachments[c].type === 'video') {
								hasVideo = true;
								videos.push({ url: url, mime: attachment.mime });

							} else if(attachments[c].type === 'audio') {
								hasAudio = true;
								audios.push({ url: url, mime: attachment.mime });
							}
						}

						// Insert multimedia
						if(hasVideo) {
							mediaHTML += '<video width="320" height="240" preload="metadata" controls>\r\n';
							for(c = 0; c < videos.length; c++) {
								mediaHTML += '\t<source src="'+videos[c].url+'" type="'+videos[c].mime+'">\r\n';
							}
							mediaHTML += '</video>';
						}

						if(hasAudio) {

							if(hasVideo) { mediaHTML += '\r\n\r\n'; }

							mediaHTML += '<audio preload="metadata" nocontrols>\r\n';
							for(c = 0; c < audios.length; c++) {
								mediaHTML += '\t<source src="'+audios[c].url+'" type="'+audios[c].mime+'">\r\n';
							}
							mediaHTML += '</audio>';
						}

						jQuery(uploadInput).parent().prev().val(mediaHTML);

					// Image with input field
					} else {
						jQuery(uploadInput).val( attachment['url'] );
						if(jQuery(uploadInput).is('input[name="image"]')) {
							jQuery(uploadInput).prev().attr('src', attachment['url']);
						}
					}

					// Generate preview
					LayerSlider.generatePreview( jQuery('.ls-layer-box.active').index() );
				});

				// Open ML
				frame.open();
			});

		} else {

			// Bind upload button to show media uploader
			jQuery(document).on('click', '.ls-upload', function(e) {
				e.preventDefault();
				uploadInput = this;
				tb_show('Upload or select a new image to insert into LayerSlider WP', 'media-upload.php?type=image&amp;TB_iframe=true&width=650&height=400');
				return false;
			});
		}
	},

	insertUpload : function() {

		// Bind an event to image url insert
		window.send_to_editor = function(html) {

			// Insert image
			var img = jQuery('img',html).attr('src');
			if(jQuery(uploadInput).is('div.ls-image')) {
				jQuery(uploadInput).prev().val(attachment.url);
				jQuery(uploadInput).prev().prev().val(attachment.id);
				jQuery(uploadInput).children('img').attr('src', attachment.sizes.thumbnail.url);
			} else {
				jQuery(uploadInput).val( img );
			}

			// Remove thickbox and update preview
			tb_remove();
			LayerSlider.generatePreview( jQuery('.ls-layer-box.active').index() );
		};
	},

	addSortables : function() {

		// Bind sortable function
		jQuery('.ls-sublayer-sortable').sortable({

			// Properties
			handle : 'span.ls-sublayer-sortable-handle',
			containment : 'parent',
			tolerance : 'pointer',
			delay: 150,
			axis : 'y',

			// Events
			helper: function(e, tr) {
				var $originals = tr.children();
				var $helper = tr.clone();
				$helper.children().each(function(index) {

					// Set helper cell sizes to match the original sizes
					jQuery(this).width($originals.eq(index).width());
				});
				return $helper;
			},

			update : function(event, ui) {
				LayerSlider.reindexSublayers();
				LayerSlider.generatePreview( jQuery('#ls-layers .ls-layer-box.active').index() );
			},
		});
	},

	addLayerSortables : function() {

		// Bind sortable function
		jQuery('#ls-layer-tabs').sortable({
			//axis : 'x',
			start : function() {
				LayerSlider.dragIndex = jQuery('.ui-sortable-placeholder').index() - 1;
			},
			change: function() {
				jQuery('.ui-sortable-helper').addClass('moving');
			},
			stop : function(event, ui) {

				// Get old index
				var oldIndex = LayerSlider.dragIndex;

				// Get new index
				var index = jQuery('.moving').index();

				if( index > -1 ){

					// Rearraange layer pages

					if(index == 0) {
						jQuery('#ls-layers .ls-layer-box').eq(oldIndex).prependTo('#ls-layers');
					}else{
						var layerObj = jQuery('#ls-layers .ls-layer-box').eq(oldIndex);
						jQuery('#ls-layers .ls-layer-box').eq(oldIndex).remove();

						layerObj.insertAfter('#ls-layers .ls-layer-box:eq('+(index-1)+')');
					}
				}

				jQuery('.moving').removeClass('moving');

				// Reindex layers
				LayerSlider.reindexLayers();

				// Sortable
				LayerSlider.addSortables();

				// Reinit colorpicker
				jQuery('#ls-layers .ls-colorpicker').minicolors('destroy');
				LayerSlider.addColorPicker('#ls-layers .ls-colorpicker');
			},
			containment : 'parent',
			tolerance : 'pointer',
			items : 'a:not(.unsortable)'
		});
	},

	addDraggable : function() {

		// Add dragable
		jQuery('.draggable').children().draggable({
			drag : function() {

				LayerSlider.dragging();
			},
			stop : function() {

				LayerSlider.dragging();
			}
		});

		jQuery('.draggable .disabled').draggable('disable');
	},

	dragging : function() {

		// Get positions
		var top = parseInt(jQuery('.ui-draggable-dragging').position().top);
		var left = parseInt(jQuery('.ui-draggable-dragging').position().left);

		// Get index
		var wrapper = jQuery('.ui-draggable-dragging').closest('.ls-layer-box');
		var index = jQuery('.ui-draggable-dragging').index();

		// Set positions
		wrapper.find('input[name="top"]').eq(index).val(top + 'px');
		wrapper.find('input[name="left"]').eq(index).val(left + 'px');
	},

	selectDragElement : function(el) {

		jQuery(el).closest('.ls-layer-box').find('.ls-sublayers > tr').eq( jQuery(el).index() ).click();
		jQuery(el).closest('.ls-layer-box').find('.ls-sublayers > tr').eq( jQuery(el).index() ).find('.ls-sublayer-nav a:eq(1)').click();
	},

	reindexSublayers : function(el) {

		jQuery('#ls-layers .ls-layer-box.active .ls-sublayers > tr').each(function(index) {

			// Reindex sublayer number
			jQuery(this).find('.ls-sublayer-number').html( index + 1 );

			// Reindex sublayer title if it is untoched
			if(
				jQuery(this).find('.ls-sublayer-title').val().indexOf('Sublayer') != -1 &&
				jQuery(this).find('.ls-sublayer-title').val().indexOf('Layer') != -1 &&
				jQuery(this).find('.ls-sublayer-title').val().indexOf('copy') == -1
			) {
				jQuery(this).find('.ls-sublayer-title').val('Layer #' + (index + 1) );
			}
		});
	},

	reindexLayers : function() {
		jQuery('#ls-layer-tabs a:not(.unsortable)').each(function(index) {
			jQuery(this).html('Slide #' + (index + 1) + '<span class="dashicons dashicons-dismiss"></span>');
		});
	},

	play : function( index ) {

		// Get layerslider contaier
		var layerslider = jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-real-time-preview');

		// Stop
		if(layerslider.children().length > 0) {
			jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-preview').show();
			layerslider.find('.ls-container').layerSlider('stop');
			layerslider.html('').hide();
			jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-preview-button').html('Enter Preview').removeClass('playing');

			// Remove Timeline slider
			lsTimeLine.remove();

			return;
		}

		// Slider settings
		var width = jQuery('.ls-settings input[name="width"]').val();
		var height = jQuery('.ls-settings input[name="height"]').val();
		var posts = window.lsPostsJSON;

		// Switch between preview and editor
		layerslider.show();
		layerslider = jQuery('<div class="layerslider">').appendTo(layerslider);
		jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-preview').hide();
		jQuery('#ls-layers .ls-layer-box').eq(index).find('.ls-preview-button').html('Exit Preview').addClass('playing');

		// Apply global settings
		layerslider.css({
			width: width,
			height : height
		});

		// Add backgrounds
		var backgroundColor = jQuery('.ls-settings input[name="backgroundcolor"]').val();
		var backgroundImage = jQuery('.ls-settings input[name="backgroundimage"]').val();
		if(backgroundColor != '') {
			layerslider.css({ backgroundColor : backgroundColor }); }

		if(backgroundImage != '') {
			 layerslider.css({ backgroundImage : 'url('+backgroundImage+')' }); }



		// Iterate over the slides
		jQuery('#ls-layers .ls-layer-box').each(function(slidekey) {

			// Get post data
			var slide = jQuery(this);

			// Get post content if any
			var postOffset = jQuery('input[name="post_offset"]', slide).val();
			if(postOffset == -1) { postOffset = index; }
			var post = posts[postOffset];

			// Slide properties
			var layerprops = '';
			jQuery(this).find('.layerprop').each(function() {
				layerprops += ''+jQuery(this).attr('name')+':'+jQuery(this).val()+';';
			});

			// Build the Slide
			var layer = jQuery('<div class="ls-layer">').appendTo(layerslider);
				layer.attr('data-ls', layerprops);

			// Get background
			var background = jQuery(this).find('input[name="background"]').val();
			if(background === '[image-url]') {
				background = post['image-url'];
			}

			// Add background
			if(background != '') {
				jQuery('<img src="'+background+'" class="ls-bg">').appendTo(layer);
			}

			// Get selected transitions
			var tr2d = jQuery('input[name="2d_transitions"]', this).val();
			var tr3d = jQuery('input[name="3d_transitions"]', this).val();
			var tr2dcustom = jQuery('input[name="custom_2d_transitions"]', this).val();
			var tr3dcustom = jQuery('input[name="custom_3d_transitions"]', this).val();

			// Apply transitions
			if( tr2d == '' && tr3d == '' && tr2dcustom == '' && tr3dcustom == '' ) {
				layer.attr('data-ls', layer.attr('data-ls') + ' transition2d: all; ');
				layer.attr('data-ls', layer.attr('data-ls') + ' transition3d: all; ');
			} else {
				if(tr2d != '') layer.attr('data-ls', layer.attr('data-ls') + ' transition2d: '+tr2d+'; ');
				if(tr3d != '') layer.attr('data-ls', layer.attr('data-ls') + ' transition3d: '+tr3d+'; ');
				if(tr2dcustom != '') layer.attr('data-ls', layer.attr('data-ls') + ' customtransition2d: '+tr2dcustom+'; ');
				if(tr3dcustom != '') layer.attr('data-ls', layer.attr('data-ls') + ' customtransition3d: '+tr3dcustom+'; ');
			}


			// Iterate over layers
			jQuery(this).find('.ls-sublayers > tr').each(function(layerkey) {

				// Skip sublayer?
				if( jQuery('input[name="skip"]', this).prop('checked') ) {
					jQuery('<div>').appendTo(layer)
					return true;
				}

				// Gather sublayer data
				var type = jQuery('input[name="type"]', this).val();
				switch( jQuery('input[name="media"]', this).val() ) {
					case 'img': type = 'img'; break;
					case 'html': type = 'div'; break;
					case 'post': type = 'post'; break;
				}

				var image = jQuery('input[name="image"]', this).val();
				var html = jQuery('textarea[name="html"]', this).val();
				var style = jQuery('textarea[name="style"]', this).val();
				var top = jQuery('input[name="top"]', this).val();
				var left = jQuery('input[name="left"]', this).val();
				var skip = jQuery('input[name="skip"]', this).prop('checked');
				var url = jQuery('input[name="url"]', this).val();
				var id = jQuery('input[name="id"]', this).val();
				var classes = jQuery('input[name="class"]', this).val();

				// Sublayer properties
				var sublayerprops = '';
				jQuery(this).find('.sublayerprop').each(function() {
					if(jQuery(this).is(':checkbox')) {
						sublayerprops += jQuery(this).attr('name')+':'+jQuery(this).prop('checked')+';';
					} else {
						sublayerprops += jQuery(this).attr('name')+':'+jQuery(this).val()+';';
					}
				});

				// Styles
				var styles = {};
				jQuery(this).find('.ls-sublayer-style input.auto').each(function() {
					var cssVal = jQuery(this).val();
					var cssProp = jQuery(this).attr('name');
					if(cssVal === '') { return true; }

					if(cssVal.slice(-1) == ';' ) {
						cssVal = cssVal.substring(0, cssVal.length - 1);
					}

					styles[cssProp] = isNumber(cssVal) ? cssVal + 'px' : cssVal;
				});

				// Build the sublayer
				var sublayer;
				if(type == 'img') {
					if(image == '') { return true; }
					if(image == '[image-url]') { image = post['image-url']; }

					sublayer = jQuery('<img src="'+image+'" class="ls-s">').appendTo(layer);

				} else if(type == 'post') {

					// Parse post placeholders
					var textlength = jQuery('input[name="post_text_length"]', this).val();
					for(var key in post) {
						if(html.indexOf('['+key+']') !== -1) {
							if( (key == 'title' || key == 'content' || key == 'excerpt') && textlength > 0) {
								post[key] = post[key].substr(0, textlength);
							}
							html = html.replace('['+key+']', post[key]);
						}
					}

					// Test html
					html = jQuery.trim(html);
					var first = html.substr(0, 1);
					var last = html.substr(html.length-1, 1);
					if(first == '<' && last == '>') {
						html = html.replace(/(\r\n|\n|\r)/gm,"");
						sublayer = jQuery(html).appendTo(layer).addClass('ls-s');
					} else {
						sublayer = jQuery('<div>').appendTo(layer).html(html).addClass('ls-s');
					}

				} else {
					sublayer = jQuery('<'+type+'>').appendTo(layer).html(html).addClass('ls-s');
				}

				// Apply styles and attributes
				sublayer.attr('id', id).attr('style', style).addClass(classes)
				sublayer.css(styles);
				if(jQuery('input[name="wordwrap"]', this).prop('checked') == false) {
					sublayer.css('white-space', 'nowrap'); }

				// Position the element
				if(top.indexOf('%') != -1) { sublayer.css({ top : top });
					} else { sublayer.css({ top : parseInt(top) }); }

				if(left.indexOf('%') != -1) { sublayer.css({ left : left });
					} else { sublayer.css({ left : parseInt(left) }); }

				if(url != '' && url.match(/^\#[0-9]/)) {
					sublayer.addClass('ls-linkto-' + url.substr(1));
				}

				sublayer.attr('data-ls', sublayerprops);
			});
		});

		// Get slider settings
		var autoPlayVideos = jQuery('.ls-settings-contents input[name="autoplayvideos"]').prop('checked');
			autoPlayVideos = autoPlayVideos ? true : false;

		// Init layerslider
		jQuery(layerslider).layerSlider({
			width : width,
			height : height,
			responsive : false,
			skin : 'preview',
			skinsPath : pluginPath + 'skins/',
			animateFirstLayer : true,
			firstLayer : (index + 1),
			autoStart : false,
			pauseOnHover : false,
			autoPlayVideos : autoPlayVideos,
			cbInit : function(){
				lsTimeLine.create();
			},
			cbTimeLineStart : function(g,d){
				if( g.nextLayerIndex == jQuery('#ls-layer-tabs .active').index() + 1 ){
					lsTimeLine.start(d);
				}
			}

		});

		jQuery(layerslider).layerSlider('start');
	},


	stop : function() {

		// Get layerslider contaier
		var layersliders = jQuery('#ls-layers .ls-layer-box .ls-real-time-preview');

		// Stop the preview if any
		if(layersliders.children().length > 0) {

			// Show the editor
			jQuery('#ls-layers .ls-layer-box .ls-preview').show();

			// Stop LayerSlider
			layersliders.find('.ls-container').layerSlider('stop');

			// Empty and hide the Preview
			layersliders.html('').hide();

			// Rewrote the Preview button text
			jQuery('#ls-layers .ls-layer-box .ls-preview-button').text('Enter Preview').removeClass('playing');
		}

		// Remove Timeline slider
		lsTimeLine.remove();
	},

	openTransitionGallery : function() {

		// Create overlay
		jQuery('body').prepend( jQuery('<div>', { 'class' : 'ls-overlay'}));

		// Empty table
		jQuery('#ls-transition-window table').empty();

		// Append transitions
		LayerSlider.appendTransition('', '2d_transitions', layerSliderTransitions['t2d']);
		LayerSlider.appendTransition('', '3d_transitions', layerSliderTransitions['t3d']);

		// Append custom transitions
		if(typeof layerSliderCustomTransitions != "undefined") {
			if(layerSliderCustomTransitions['t2d'].length) {
				LayerSlider.appendTransition('Custom 2D transitions', 'custom_2d_transitions', layerSliderCustomTransitions['t2d']);
			}
			if(layerSliderCustomTransitions['t3d'].length) {
				LayerSlider.appendTransition('Custom 3D transitions', 'custom_3d_transitions', layerSliderCustomTransitions['t3d']);
			}
		}

		// Select proper tab
		jQuery('#ls-transition-window .filters li.active').click();

		// Close event
		jQuery(document).one('click', '.ls-overlay', function() {
			LayerSlider.closeTransitionGallery();
		});


		jQuery('#ls-transition-window').show();
	},

	closeTransitionGallery : function() {

		jQuery('#ls-transition-window').hide();
		jQuery('.ls-overlay').remove();
	},

	appendTransition : function(title, tbodyclass, transitions) {

		// Append new tbody
		var tbody = jQuery('<tbody>').data('tr-type', tbodyclass).appendTo('#ls-transition-window table');

		// Get checked transitions
		var checked = jQuery('#ls-layers .ls-layer-box.active').find('input[name="'+tbodyclass+'"]').val();
			checked = (checked != '') ? checked.split(',') : [];

		if(title != '') {
			jQuery('<tr>').appendTo(tbody).append('<th colspan="4">'+title+'</th>');
		}

		for(c = 0; c < transitions.length; c+=2) {

			// Append new table row
			var tr = jQuery('<tr>').appendTo(tbody)
				.append( jQuery('<td class="c"></td>') )
				.append( jQuery('<td></td>') )
				.append( jQuery('<td class="c"></td>') )
				.append( jQuery('<td></td>')
			);

			// Append transition col 1 & 2
			tr.children().eq(0).append('<i>'+(c+1)+'</i><i class="dashicons dashicons-yes"></i>');
			tr.children().eq(1).append( jQuery('<a>', { 'href' : '#', 'html' : transitions[c]['name']+'', 'data-key' : (c+1) } ) )
			if(transitions.length > (c+1)) {
				tr.children().eq(2).append('<i>'+(c+2)+'</i><i class="dashicons dashicons-yes"></i>');
				tr.children().eq(3).append( jQuery('<a>', { 'href' : '#', 'html' : transitions[(c+1)]['name']+'', 'data-key' : (c+2) } ) );
			}

			// Check transitions
			if(checked.indexOf(''+(c+1)+'') != -1 || checked == 'all') {
				tr.children().eq(0).addClass('added');
				tr.children().eq(1).addClass('added');
			}

			if((checked.indexOf(''+(c+2)+'') != -1 || checked == 'all') ) {
				tr.children().eq(2).addClass('added');
				tr.children().eq(3).addClass('added');
			}
		}
	},

	selectAllTransition : function(index, check) {

		// Get checkbox and transition type
		var checkbox = jQuery('#ls-transition-window header i:last');
		var cat = jQuery('#ls-transition-window tbody').eq(index).data('tr-type');

		if(typeof check != undefined && check == true) {

			jQuery('#ls-transition-window tbody').eq(index).find('td').addClass('added');
			checkbox.attr('class', 'on').text('Deselect all');
			jQuery('#ls-layers .ls-layer-box.active').find('input[name="'+cat+'"]').val('all');

		} else {

			jQuery('#ls-transition-window tbody').eq(index).find('td').removeClass('added');
			checkbox.attr('class', 'off').text('Select all');
			jQuery('#ls-layers .ls-layer-box.active').find('input[name="'+cat+'"]').val('');
		}
	},

	toggleTransition : function(el) {

		// Toggle addded class
		if(jQuery(el).parent().hasClass('added')) {
			jQuery(el).parent().removeClass('added').prev().removeClass('added');

		} else {
			jQuery(el).parent().addClass('added').prev().addClass('added');
		}

		// Get transitions
		var trs = jQuery(el).closest('tbody').find('td');

		// All selected
		if(trs.filter('.c.added').length == trs.filter('.c').length) {

			LayerSlider.selectAllTransition( jQuery(el).closest('tbody').index(), true );
			return;

		// Uncheck select all
		} else {

			// Check the checkbox
			jQuery('#ls-transition-window header i:last').attr('class', 'off').text('Select all');
		}

		// Get category
		var cat = jQuery(el).closest('tbody').data('tr-type');

		// Gather checked selected transitions
		var checked = [];
		trs.filter('.added').find('a').each(function() {
			checked.push( jQuery(this).data('key') );
		});

		// Set hidden input
		jQuery('#ls-layers .ls-layer-box.active').find('input[name="'+cat+'"]').val( checked.join(',') );
	},

	showTransition : function(el) {

		// Get transition index
		var index = parseInt(jQuery(el).data('key')) - 1;

		// Create popup
		jQuery('body').prepend( jQuery('<div>', { 'class' : 'ls-popup' })
			.append( jQuery('<div>', { 'class' : 'inner ls-transition-preview' }))
		);

		// Get popup
		var popup = jQuery('.ls-popup');

		// Get viewport dimensions
		var v_w = jQuery(window).width();

		// Get element dimensions
		var e_w = jQuery(el).width();

		// Get element position
		var e_l = jQuery(el).offset().left;
		var e_t = jQuery(el).offset().top;

		// Get toolip dimensions
		var t_w = popup.outerWidth();
		var t_h = popup.outerHeight();

		// Position tooltip
		popup.css({ top : e_t - t_h - 14, left : e_l - (t_w - e_w) / 2  });

		// Fix top
		if(popup.offset().top < 20) {
			popup.css('top', e_t + 26);
		}

		// Fix left
		if(popup.offset().left < 20) {
			popup.css('left', 20);
		}

		// Get transition class
		var trclass = jQuery(el).closest('tbody').data('tr-type');

		// Built-in 3D
		if(trclass == '3d_transitions') {
			var trtype = '3d';
			var trObj = layerSliderTransitions['t'+trtype+''][index];

		// Built-in 2D
		} else if(trclass == '2d_transitions') {
			var trtype = '2d';
			var trObj = layerSliderTransitions['t'+trtype+''][index];

		// Custom 3D
		} else if(trclass == 'custom_3d_transitions') {
			var trtype = '3d';
			var trObj = layerSliderCustomTransitions['t'+trtype+''][index];

		// Custom 3D
		} else if(trclass == 'custom_2d_transitions') {
			var trtype = '2d';
			var trObj = layerSliderCustomTransitions['t'+trtype+''][index];
		}

		// Init transition
		popup.find('.inner').lsTransitionPreview({
			transitionType : trtype,
			transitionObject : trObj,
			imgPath : lsTrImgPath,
			skinsPath: lsTrImgPath+'../skins/',
			delay : 100
		});
	},

	hideTransition : function(el) {

		// Stop transition
		jQuery('.ls-popup').find('.inner').lsTransitionPreview('stop');

		// Remove transition
		jQuery('.ls-popup').remove();
	},

	save : function(el) {

		var settings = slides = callbacks = [];

		// Temporary disable submit button
		jQuery('.ls-publish').addClass('saving').find('button').text('Saving ...').attr('disabled', true);

		// Slider settings
		jQuery('.ls-slider-settings').find('input:not(.nochange), select, textarea').each(function() {
			jQuery(this).data('name', jQuery(this).attr('name') );
			jQuery(this).attr('name', 'ls_data[properties]['+jQuery(this).attr('name')+']');
		});

		// Post options
		jQuery('#ls-post-options').find('input, select').each(function() {
			jQuery(this).data('name', jQuery(this).attr('name') );

			if(jQuery(this).attr('name').substr(-2, 2) == '[]') {
				var nameAttr = jQuery(this).attr('name');
					nameAttr = nameAttr.substring(0, nameAttr.length - 2);
				jQuery(this).attr('name', 'ls_data[properties]['+nameAttr+'][]');
			} else {
				jQuery(this).attr('name', 'ls_data[properties]['+jQuery(this).attr('name')+']');
			}
		});

		// Slides
		jQuery('#ls-layers .ls-layer-box').each(function(layer) {

			jQuery('.ls-slide-options', this).find('input, select').each(function() {
				jQuery(this).data('name', jQuery(this).attr('name') );
				jQuery(this).attr('name', 'ls_data[layers]['+layer+'][properties]['+jQuery(this).attr('name')+']');
			});

			// Layers
			jQuery(this).find('.ls-sublayers > tr').each(function(sublayer) {

				// Transtions
				var transitionProps = {};
				jQuery(this).find('.sublayerprop').each(function() {
					transitionProps[jQuery(this).attr('name')] = jQuery(this).is(':checkbox') ? jQuery(this).prop('checked') : jQuery(this).val();
					jQuery(this).data('name', jQuery(this).attr('name') ).attr('name', '');
				});

				// Style editor
				var styles = {};
				jQuery(this).find('input.auto').each(function() {

					if(jQuery(this).val() != '') {
						styles[jQuery(this).attr('name')] = jQuery(this).val();
					}

					jQuery(this).data('name', jQuery(this).attr('name') ).attr('name', '');
				});

				// Generate styles object
				jQuery(this).find('.ls-sublayer-style input[name="styles"]').val( JSON.stringify(styles) );
				jQuery(this).find('.ls-sublayer-options input[name="transition"]').val( JSON.stringify(transitionProps) );


				// Iterate over the sublayer properties
				jQuery(this).find('input, select, textarea').filter(':not(.auto,.sublayerprop)').each(function() {
					if(jQuery(this).attr('name') == '') { return true; }
					jQuery(this).data('name', jQuery(this).attr('name') );
					jQuery(this).attr('name', 'ls_data[layers]['+layer+'][sublayers]['+sublayer+']['+jQuery(this).attr('name')+']');
				});
			});

			slides.push( jQuery('input, textarea, select', this).serialize() );
		});

		// Callbacks
		jQuery('.ls-callback-page textarea').each(function() {
			jQuery(this).data('name', jQuery(this).attr('name') );
			jQuery(this).attr('name', 'ls_data[properties]['+jQuery(this).attr('name')+']');
		});

		// Save slider
		jQuery.ajax({
			type: 'post', url: ajaxurl, dataType: 'text',
			data: {
				action: 'ls_save_slider',
				id: jQuery('#ls-slider-form input[name="slider_id"]').val(),
				settings: jQuery('.ls-slider-settings, #ls-post-options').find('input:not(.nochange), select, textarea').serialize(),
				callbacks: jQuery('.ls-callback-page textarea').serialize(),
				slides: slides
			},
			error : function(jqXHR, textStatus, errorThrown) {
				alert('It seems there is a server issue that prevented LayerSlider from saving your work. Please, try to temporary disable themes/plugins, or contact with your hosting provider. Your HTTP server thrown the following error: \n\n' + errorThrown);
			},
			complete : function(data) {

				// Button feedback
				jQuery('.ls-publish').removeClass('saving').addClass('saved').find('button').text('Saved');
				setTimeout(function() {
					jQuery('.ls-publish').removeClass('saved').find('button').text('Save changes').attr('disabled', false);
				}, 2000);

				// Store fields name attrs
				jQuery('#ls-slider-form').find('input, select, textarea').each(function() {
					if(!! jQuery(this).data('name')) {
						jQuery(this).attr('name', jQuery(this).data('name'));
					}
				});
			}
		});
	},

	cloneFix : function() {

		jQuery('textarea').each(function() {
			jQuery(this).text( jQuery(this).val() );
		});

		// Select clone fix
		jQuery('select:not([multiple])').each(function() {

			// Get selected index
			var index = jQuery(this).find('option:selected').index();

			// Deselect old options
			jQuery(this).find('option').attr('selected', false);

			// Select the new one
			jQuery(this).find('option').eq( index ).attr('selected', true);
		});
	}
};


var LS_GoogleFontsAPI = {

	results : 0,
	fontName : null,
	fontIndex : null,

	init : function() {

		// Prefetch fonts
		jQuery('.ls-font-search input').focus(function() {
			LS_GoogleFontsAPI.getFonts();
		});

		// Search
		jQuery('.ls-font-search button').click(function(e) {
			e.preventDefault();
			var input = jQuery(this).prev()[0];
			LS_GoogleFontsAPI.timeout = setTimeout(function() {
				LS_GoogleFontsAPI.search(input);
			}, 500);
		});

		jQuery('.ls-font-search input').keydown(function(e) {
			if(e.which === 13) {
				e.preventDefault();
				var input = this;
				LS_GoogleFontsAPI.timeout = setTimeout(function() {
					LS_GoogleFontsAPI.search(input);
				}, 500);
			}
		});

		// Select font
		jQuery('.ls-google-fonts .fonts').on('click', 'li:not(.unselectable)', function() {
			LS_GoogleFontsAPI.showVariants(this);
		});

		// Add font event
		jQuery('.ls-font-search').on('click', 'button.add-font', function(e) {
			e.preventDefault();
			LS_GoogleFontsAPI.addFonts(this);
		});

		// Back to results event
		jQuery('.ls-google-fonts .variants').on('click', 'button:last', function(e) {
			e.preventDefault();
			LS_GoogleFontsAPI.showFonts(this);
		});

		// Close event
		jQuery(document).on('click', '.ls-overlay', function() {

			if(jQuery(this).data('manualclose')) {
				return false;
			}

			if(jQuery('.ls-pointer').length) {
				jQuery(this).remove();
				jQuery('.ls-pointer').children('div.fonts').show().next().hide();
				jQuery('.ls-pointer').animate({ marginTop : 40, opacity : 0 }, 150, function() {
					this.style.display = 'none';
				});
			}
		});

		// Remove font
		jQuery('.ls-font-list').on('click', 'a.remove', function(e) {
			e.preventDefault();
			jQuery(this).parent().animate({ height : 0, opacity : 0 }, 300, function() {

				// Add notice if needed
				if(jQuery(this).siblings().length < 2) {
					jQuery(this).parent().append(
						jQuery('<li>', { 'class' : 'ls-notice', 'text' : 'You didn\'t add any Google font to your library yet.'})
					);
				}

				jQuery(this).remove();
			});
		});

		// Add script
		jQuery('.ls-google-fonts .footer select').change(function() {

			// Prevent adding the placeholder option tag
			if(jQuery('option:selected', this).index() !== 0) {

				// Selected item
				var item = jQuery('option:selected', this);
				var hasDuplicate = false;

				// Prevent adding duplicates
				jQuery('.ls-google-font-scripts input').each(function() {
					if(jQuery(this).val() === item.val()) {
						hasDuplicate = true;
						return false;
					}
				});

				// Add item
				if(!hasDuplicate) {
					var clone = jQuery('.ls-google-font-scripts li:first').clone();
						clone.find('span').text( item.text() );
						clone.find('input').val( item.val() );
						clone.removeClass('ls-hidden').appendTo('.ls-google-font-scripts');
				}

				// Show the placeholder option tag
				jQuery('option:first', this).prop('selected', true);
			}
		});

		// Remove script
		jQuery('.ls-google-font-scripts').on('click', 'li a', function(event) {
			event.preventDefault();

			if(jQuery('.ls-google-font-scripts li').length > 2) {
				jQuery(this).closest('li').remove();
			} else {
				alert('You need to have at least one character set added. Please select another item before removing this one.');
			}
		});
	},

	getFonts : function() {

		if(LS_GoogleFontsAPI.results == 0) {
			var API_KEY = 'AIzaSyC_iL-1h1jz_StV_vMbVtVfh3h2QjVUZ8c';
			jQuery.getJSON('https://www.googleapis.com/webfonts/v1/webfonts?key=' + API_KEY, function(data) {
				LS_GoogleFontsAPI.results = data;
			});
		}
	},

	search : function(input) {

		// Hide overlay if any
		jQuery('.ls-overlay').remove();

		// Get search field
		var searchValue = jQuery(input).val().toLowerCase();

		// Wait until fonts being fetched
		if(LS_GoogleFontsAPI.results != 0 && searchValue.length > 2 ) {

			// Search
			var indexes = [];
			var found = jQuery.grep(LS_GoogleFontsAPI.results.items, function(obj, index) {
				if(obj.family.toLowerCase().indexOf(searchValue) !== -1) {
					indexes.push(index);
					return true;
				}
			});

			// Get list
			var list = jQuery('.ls-font-search .ls-pointer .fonts ul');

			// Remove previous contents and append new ones
			list.empty();
			if(found.length) {
				for(c = 0; c < found.length; c++) {
					list.append( jQuery('<li>', { 'data-key' : indexes[c], 'text' : found[c]['family'] }));
				}
			} else {
				list.append(jQuery('<li>', { 'class' : 'unselectable' })
					.append( jQuery('<h4>', { 'text' : 'No results were found' }))
				);
			}

			// Show pointer and append overlay
			jQuery('.ls-font-search .ls-pointer').show().animate({ marginTop : 15, opacity : 1 }, 150);
			jQuery('<div>', { 'class' : 'ls-overlay ls-add-slider-overlay'}).prependTo('body');
		}
	},

	showVariants : function(li) {

		// Get selected font
		var fontName = jQuery(li).text();
		var fontIndex = jQuery(li).data('key');
		var fontObject = LS_GoogleFontsAPI.results.items[fontIndex]['variants'];
		LS_GoogleFontsAPI.fontName = fontName;
		LS_GoogleFontsAPI.fontIndex = fontIndex;

		// Get and empty list
		var list = jQuery(li).closest('div').next().children('ul');
			list.empty();


		// Change header
		jQuery(li).closest('.ls-box').children('.header').text('Select "'+fontName+'" variants');

		// Append variants
		for(c = 0; c < fontObject.length; c++) {
			list.append( jQuery('<li>', { 'class' : 'unselectable' })
				.append( jQuery('<input>', { 'type' : 'checkbox'} ))
				.append( jQuery('<span>', { 'text' : ucFirst(fontObject[c]) }))
			);
		}

		// Init checkboxes
		list.find(':checkbox').customCheckbox();

		// Show variants
		jQuery(li).closest('.fonts').hide().next().show();
	},

	showFonts : function(button) {
		jQuery(button).closest('.ls-box').children('.header').text('Choose a font family');
		jQuery(button).closest('.variants').hide().prev().show();
	},

	addFonts: function(button) {

		// Get variants
		var variants = jQuery(button).parent().prev().find('input:checked');

		var apiUrl = [];
		var urlVariants = [];
		apiUrl.push(LS_GoogleFontsAPI.fontName.replace(/ /g, '+'));

		if(variants.length) {
			apiUrl.push(':');
			variants.each(function() {
				urlVariants.push( jQuery(this).siblings('span').text().toLowerCase() );
			});
			apiUrl.push(urlVariants.join(','));
		}

		LS_GoogleFontsAPI.appendToFontList( apiUrl.join('') );
	},

	appendToFontList : function(url) {

		// Empty notice if any
		jQuery('ul.ls-font-list li.ls-notice').remove();

		var index = jQuery('ul.ls-font-list li').length - 1;

		// Append list item
		var item = jQuery('ul.ls-font-list li.ls-hidden').clone();
			item.children('input:text').val(url).attr('name', 'urlParams[]');
			item.children('input:checkbox').attr('name', 'onlyOnAdmin[]');
			item.appendTo('ul.ls-font-list').attr('class', '');

		// Reset search field
		jQuery('.ls-font-search input').val('');

		// Close pointer
		jQuery('.ls-overlay').click();
	}
};

var lsTimeLine = {

	opened : false,

	init : function(){

		jQuery(document).on('click', '.ls-tl-toggle', function(e) {
			e.preventDefault();
			var t = jQuery(this).closest('table');
			var tl = jQuery(this).closest('table').find('.ls-tl');
			if( tl.eq(0).css('display') == 'none' ){
				lsTimeLine.show(t,tl);
			}else{
				lsTimeLine.hide(tl);
			}
		});
	},

	show : function(t,tl){

		if( t.find('tr').length != -1 ){

			if( t.find('tr.active').length != -1 ){
				this.opened = t.find('tr.active');
				t.find('tr.active').removeClass('active');
			}else{
				this.opened = false;
			}

			// Adjust the width of layer's title field
			jQuery('.ls-sublayer-title').outerWidth(138);

			var osd = parseInt( jQuery('#ls-layers .active').find('input[name="slidedelay"]').val() );

			tl.addClass('ls-tl-active');
			tl.each(function(){

				var slidedelay = osd;

				var percent = slidedelay / 100;
				var tableWidth = '100%';

				var tlVal = [];
				var tlName = ['delayin','durationin','showuntil','durationout'];
				var tlTTName = ['Delay in','Duration in','Show until','Duration out'];

				tlVal.push( parseInt( jQuery(this).closest('.ls-sublayer-wrapper').find('input[name="delayin"]').val() ) );
				tlVal.push( parseInt( jQuery(this).closest('.ls-sublayer-wrapper').find('input[name="durationin"]').val() ) );
				tlVal.push( parseInt( jQuery(this).closest('.ls-sublayer-wrapper').find('input[name="showuntil"]').val() ) );
				tlVal.push( parseInt( jQuery(this).closest('.ls-sublayer-wrapper').find('input[name="durationout"]').val() ) );

				var osu = tlVal[2];
				if( tlVal[2] === 0 ){
					tlVal[3] = 0;
					tlVal[2] = slidedelay - ( tlVal[0] + tlVal[1] ) > 0 ? slidedelay - ( tlVal[0] + tlVal[1] ) : 0;
				}

				if( slidedelay > tlVal[0] + tlVal[1] + tlVal[2] + tlVal[3] ){
					tableWidth = ( tlVal[0] + tlVal[1] + tlVal[2] + tlVal[3] ) / percent + '%';
				}

				jQuery(this).find('table').css({
					width : tableWidth
				});

				for(var x = 0; x<tlVal.length; x++ ){
					slidedelay -= tlVal[x];
					var el = jQuery(this).find('.ls-tl-'+tlName[x]);
					var w = tlVal[x] / percent + '%';
					if( slidedelay < 0 ){
						w = ( tlVal[x] + slidedelay ) / percent + '%';
						el.css('width',w);
						el.attr('data-help', tlTTName[x] + ': ' + (tlVal[x] + slidedelay) + ' ms (original: ' + tlVal[x] + ' ms but the current Slide delay is ' + osd + ' ms, so this slide will change before)');
						break;
					}else{
						el.css('width',w);
						if( x == 2 && osu == 0 ){
							el.attr('data-help', 'This layer will be shown until the slide change and it will be animate out with the other layers.');
						}else{
							el.attr('data-help', tlTTName[x] + ': ' + tlVal[x] + ' ms');
						}
					}
				}
			});

			// create ruler

			var h = t.find('.ls-sublayers').height();
			var tr = jQuery('<div>').addClass('ls-tl-ruler').appendTo( t.find('tr:eq(0) td') );
			var rn = osd%1000 === 0 ? osd/1000 + 1 : parseInt( osd/1000 ) + 2;
			var l, d, ms;

			for( var r=0; r<rn;r++ ){

				l = r === rn-1 ? 100 + '%' : ( r * 1000 ) / ( osd / 100 ) + '%';
				ms = r === rn-1 ? osd : r*1000;

				d = jQuery('<div>').css({
					top: -5,
					left: l,
					height: h+6
				}).appendTo( tr );
				jQuery('<p>').text( ms+' ms' ).appendTo( d );
			}

		}
	},

	hide : function(tl){
		tl.removeClass('ls-tl-active');

		// Adjust the width of layer's title field
		jQuery('.ls-sublayer-title').width(250);

		jQuery('.ls-tl-ruler').remove();
		if( this.opened && jQuery('#ls-layers .active .ls-sublayers tr.active').length == 0 ){
			this.opened.addClass('active');
		}
		this.opened = false;
	},

	create : function(){
		var tls = jQuery('<div>').addClass('ls-tl-slider').appendTo('.ls-tl-active');
//		var timer = jQuery('<div>').addClass('ls-tl-timer').appendTo('.ls-tl-slider:eq(0)');
	},

	start : function(d){
		var slidedelay = parseInt( jQuery('#ls-layers .active').find('input[name="slidedelay"]').val() );
		var tls = jQuery('.ls-tl-slider');
		var w = jQuery('.ls-tl-active:eq(0)').width();
		var d = d ? d : 0;

		tls.css({
			width: 0
		}).delay(d).animate({
			width : w
		}, slidedelay, 'linear' );
/*
		var timer;

		var t = function(){
			timer = parseInt( (tls.eq(0).width() / w * slidedelay)/50 ) * 50 + 50;
			setTimeout(function(){
				console.log('s')
				jQuery('.ls-tl-timer').text( timer + ' ms');
				if( timer < slidedelay ){
					t();
				}else{
					jQuery('.ls-tl-timer').text( slidedelay + ' ms');
				}
			},50);
		};

		t();
*/
	},

	remove : function(){
		jQuery('.ls-tl-slider').stop().remove();
	}
};

var LS_CodeMirror = {

	init : function(settings) {

		var defaults = {
			mode: 'css',
			theme: 'solarized',
			lineNumbers: true,
			autofocus: true,
			indentUnit: 4,
			indentWithTabs: true,
			foldGutter: true,
			gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
			styleActiveLine: true,
			extraKeys: {
				"Ctrl-Q": function(cm) {
					cm.foldCode(cm.getCursor());
				}
			}
		}

		if(typeof settings !== "undefined") {
			jQuery.extend(defaults, settings);
		}

		jQuery('.ls-codemirror').each(function() {
			var cm = CodeMirror.fromTextArea(this, defaults);
			cm.on("change", function(instance) {
				instance.getTextArea().value = instance.getValue();
			});
		});
	}
};

var LS_PostOptions = {

	init : function() {

		jQuery('#ls-layers').on('click', '.ls-configure-posts', function(e) {
			e.preventDefault(); LS_PostOptions.open(this);
		});

		jQuery('.ls-configure-posts-modal .header a').click(function(e) {
			e.preventDefault(); LS_PostOptions.close();
		});

		jQuery('#ls-post-options select:not(.ls-post-taxonomy, .post_offset)').change(function() {
			LS_PostOptions.change(this);
		});

		jQuery('#ls-post-options select.offset').change(function() {
			jQuery('#ls-layers .ls-layer-box.active input[name="post_offset"]').val( jQuery(this).val() );
			LayerSlider.willGeneratePreview( jQuery('.ls-layer-box.active').index() );
		});

		jQuery('#ls-post-options select.ls-post-taxonomy').change(function() {
			LS_PostOptions.getTaxonoies(this);
		});

		jQuery('#ls-layers').on('click', '.ls-post-placeholders li', function() {
			LS_PostOptions.insertPlaceholder(this);
		});
	},

	open : function(el) {

		// Create overlay
		jQuery('body').prepend(jQuery('<div>', { 'class' : 'ls-overlay'}));

		// Get slide's post offset
		var offset = jQuery('#ls-layers .ls-layer-box.active input[name="post_offset"]').val();
			offset = parseInt(offset) + 1;

		// Show modal window
		var modal = jQuery('#ls-post-options').show();
			modal.find('select.offset option').prop('selected', false).eq(offset).prop('selected', true);

		// Close event
		jQuery(document).one('click', '.ls-overlay', function() {
			LS_PostOptions.close();
		});

		// First open?
		if(modal.find('.ls-post-previews ul').children().length === 0) {
			LS_PostOptions.change( modal.find('select')[0] );
		}
	},

	getTaxonoies : function(select) {

		var target = jQuery(select).next().empty();

		if(jQuery(select).val() == 0) {
			LS_PostOptions.change(select);

		} else {

			jQuery.post(ajaxurl, jQuery.param({ action : 'ls_get_taxonomies', taxonomy : jQuery(select).val() }), function(data) {
				var data = jQuery.parseJSON(data);
				for(c = 0; c < data.length; c++) {
					target.append( jQuery('<option>', { 'value' : data[c]['term_id'], 'text' : data[c]['name'] }));
				}
			});
		}
	},

	change : function(el) {

		// Get options
		var items = {};
		jQuery('#ls-post-options').find('select').each(function() {
			items[ jQuery(this).data('param') ] = jQuery(this).val();
		});

		jQuery.post(ajaxurl, jQuery.param({ action: 'ls_get_post_details', params : items }), function(data) {

			// Handle data
			var parsed = jQuery.parseJSON(data);
			window.lsPostsJSON = parsed;

			// Update preview
			LayerSlider.willGeneratePreview( jQuery('.ls-layer-box.active').index() );
			LS_PostOptions.update(el, parsed );
		});
	},

	update : function(el, data) {

		var preview = jQuery('#ls-post-options').find('.ls-post-previews ul').empty();

		if(data.length === 0) {
			preview.append( jQuery('<li>')
				.append( jQuery('<h4>', { 'text' : 'No posts were found with the current filters.' }) )
			);

		} else {
			for(c = 0; c < data.length; c++) {
				preview.append( jQuery('<li>')
					.append( jQuery('<span>', { 'class' : 'counter', 'text' : ''+(c+1)+'. ' }))
					.append( jQuery('<img>', { 'src' : data[c]['thumbnail'] } ))
					.append( jQuery('<h3>', { 'html' : data[c]['title'] } ))
					.append( jQuery('<p>', { 'html' : data[c]['content'] } ))
					.append( jQuery('<span>', { 'class' : 'author', 'text' : data[c]['date-published']+' by '+data[c]['author'] } ))
				);
			}
		}
	},

	close : function() {
		jQuery('#ls-post-options').hide();
		jQuery('.ls-overlay').remove();
	},

	insertPlaceholder : function(el) {

		var element = jQuery(el).closest('.ls-sublayer-page').find('textarea[name="html"]')[0];
		var text = (typeof jQuery(el).data('placeholder') != "undefined") ? jQuery(el).data('placeholder') : jQuery(el).children().text();

		if (document.selection) {
			element.focus();
			var sel = document.selection.createRange();
			sel.text = text;
			element.focus();
		} else if (element.selectionStart || element.selectionStart === 0) {
			var startPos = element.selectionStart;
			var endPos = element.selectionEnd;
			var scrollTop = element.scrollTop;
			element.value = element.value.substring(0, startPos) + text + element.value.substring(endPos, element.value.length);
			element.focus();
			element.selectionStart = startPos + text.length;
			element.selectionEnd = startPos + text.length;
			element.scrollTop = scrollTop;
		} else {
			element.value += text;
			element.focus();
		}

		jQuery(element).keyup();
	}
};


jQuery(document).ready(function() {


	// Global

		// Tooltips
		if(typeof lsScreenOptions != 'undefined' && lsScreenOptions['showTooltips'] == 'true') {
			lsTooltip.init();
		}

		// Screen options
		jQuery('#ls-screen-options').children().first().appendTo('#screen-meta');
		jQuery('#ls-screen-options').children().last().appendTo('#screen-meta-links');

		// Screen option actions
		lsScreenOptionsActions.init();

		// CodeMirror
		if(document.location.href.indexOf('&action=edit') === -1) {
			LS_CodeMirror.init();
		}

		// Checkbox event
		jQuery(document).on('click', '.ls-checkbox', function(e){

			// Prevent browers default submission
			e.preventDefault();

			// Get checkbox
			var el = jQuery(this).prev()[0];

			if( jQuery(el).is(':checked') ) {
				jQuery(el).prop('checked', false);
				jQuery(this).removeClass('on').addClass('off');
			} else {
				jQuery(el).prop('checked', true);
				jQuery(this).removeClass('off').addClass('on');
			}

			// Trigger events
			jQuery('#ls-layers').trigger( jQuery.Event('click', { target : el } ) );
			jQuery(document).trigger( jQuery.Event('click', { target : el } ) );
		});

		// Share sheet
		jQuery('#ls-share-template .inner a').click(function(e) {
			e.preventDefault();

			var newWindow = window.open('', '_blank', 'width=700,height=400');
				newWindow.location.href = jQuery(this).attr('href');
				newWindow.focus();
		});

		jQuery('#ls-share-template h3 a').click(function(e) {
			e.preventDefault();
			jQuery('#ls-share-template, .ls-overlay').remove();
		});


	// List view
	if(
		document.location.href.indexOf('page=layerslider') != -1 &&
		document.location.href.indexOf('layerslider_add_new') == -1 &&
		document.location.href.indexOf('action=edit') == -1 &&
		document.location.href.indexOf('ls-skin-editor') == -1 &&
		document.location.href.indexOf('ls-style-editor') == -1 &&
		document.location.href.indexOf('ls-transition-builder') == -1
	) {

		LS_BoxToggles.init();

		// Checkboxes
		jQuery('.ls-global-settings :checkbox').customCheckbox();
		jQuery('.ls-google-fonts :checkbox').customCheckbox();


		// Google Fonts API
		LS_GoogleFontsAPI.init();

		// Slider remove
		jQuery('.ls-sliders-list a.remove').click(function(e) {
			e.preventDefault();
			if(confirm('Are you sure you want to remove this slider?')){
				document.location.href = jQuery(this).attr('href');
			}
		});

		// Add slider
		jQuery('#ls-add-slider-button').click(function(e) {
			e.preventDefault();
			var offsets = jQuery(this).position();
			var popup = jQuery('#ls-add-slider-template');

			popup.css({
				top : offsets.top + 35,
				left : offsets.left - popup.outerWidth() / 2 + jQuery(this).width() / 2 + 7
			}).show().animate({ marginTop : 0, opacity : 1 }, 150, function() {
				jQuery(this).find('.inner input').focus();
			});

			jQuery('<div>', { 'class' : 'ls-overlay ls-add-slider-overlay'}).prependTo('body');
		});

		// Import sample slider
		jQuery('#ls-import-samples-button').click(function(e) {
			e.preventDefault();
			var offsets = jQuery(this).position();
			var popup = jQuery('#ls-import-samples-template');

			popup.css({
				top : offsets.top + 35,
				left : offsets.left - popup.outerWidth() / 2 + jQuery(this).width() / 2 + 7
			}).show().animate({ marginTop : 0, opacity : 1 }, 150);

			jQuery('<div>', { 'class' : 'ls-overlay ls-add-slider-overlay'}).prependTo('body');
		});

		// Close add slider window
		jQuery(document).on('click', '.ls-overlay', function() {

			if(jQuery(this).data('manualclose')) {
				return false;
			}

			if(jQuery('.ls-pointer').length) {
				jQuery('.ls-overlay').remove();
				jQuery('.ls-pointer').animate({ marginTop : 40, opacity : 0 }, 150);
			}
		});

		// Auto-update authorization
		jQuery('.ls-auto-update').submit(function(e) {

			// Prevent browser default submission
			e.preventDefault();

			// Send request and provide feedback message
			jQuery('.ls-auto-update span.status').text('Validating ...').css('color', '#333');

			// Post it
			jQuery.post( ajaxurl, jQuery(this).serialize(), function(data) {

				// Parse response and set message
				var data = jQuery.parseJSON(data);
				var success = (typeof data.errCode === "undefined") ? true : false;
				var color = success ? '#4b982f' : '#c33219';
				var status = success ? 'Successfully set up automatic updates.' : 'Failed to set up automatic updates.';
					status = (typeof data.status === "undefined") ? status : data.status;

				// Status message
				jQuery('.ls-auto-update span.status').html(status).css('color', color);

				// Show or hide 'Check for updates' button
				if(success) {
					jQuery('.ls-auto-update .footer a').removeClass('ls-hidden');
				} else {
					jQuery('.ls-auto-update .footer a').addClass('ls-hidden');
				}

				// Alert message (if any)
				if(typeof data.message !== "undefined") {
					alert(data.message);
				}
			});
		});


		// Auto-update deauthorization
		jQuery('.ls-auto-update a.ls-deauthorize').click(function(event) {
			event.preventDefault();
			jQuery.get( ajaxurl, jQuery.param({ action: 'layerslider_deauthorize_site'}), function(data) {

				// Parse response and set message
				var data = jQuery.parseJSON(data);

				if(typeof data.errCode === "undefined") {
					jQuery('.ls-auto-update span.status').html(data.status).css('color', '#c33219');
					jQuery('.ls-auto-update .footer a').addClass('ls-hidden');
					jQuery('.ls-auto-update input[name="purchase_code"]').val('');
				}

				// Alert message (if any)
				if(typeof data.message !== "undefined") {
					alert(data.message);
				}
			});
		});

		// Permission form
		jQuery('#ls-permission-form').submit(function(e) {
			e.preventDefault();
			if(confirm('WARNING: This option controls who can access to this plugin, you can easily lock out yourself by accident. Please, make sure that you have entered a valid capability without whitespaces or other invalid characters. Do you want to proceed?')) {
				this.submit();
			}
		});

		// News filters
		jQuery('.ls-news .filters li').click(function() {

			// Highlight
			jQuery(this).siblings().attr('class', '');
			jQuery(this).attr('class', 'active');

			// Get stuff
			var page = jQuery(this).data('page');
			var frame = jQuery(this).closest('.ls-box').find('iframe');
			var baseUrl = frame.attr('src').split('#')[0];

			// Set filter
			frame.attr('src', baseUrl+'#'+page);

		});

		// Shortcode
		jQuery('input.ls-shortcode').click(function() {
			this.focus();
			this.select();
		});

		// Import
		jQuery('form.ls-import-box button').click(function() {
			jQuery(this).addClass('saving').text('Importing');
		});

		jQuery('#ls-import-samples-template li').click(function() {
			jQuery('#ls-import-samples-button').addClass('saving').text('Importing, please wait');
		});


	// Skin editor
	} else if(
		document.location.href.indexOf('ls-skin-editor') != -1 ||
		document.location.href.indexOf('ls-style-editor') != -1
	) {

		// Select
		jQuery('select[name="skin"]').change(function() {
			document.location.href = 'admin.php?page=ls-skin-editor&skin=' + jQuery(this).children(':selected').val();
		});


	// Transition builder
	} else if(document.location.href.indexOf('ls-transition-builder') != -1) {

	// Editor view
	} else {

		// URL rewrite after creating slider
		if( history.replaceState ) {
			if(document.location.href.indexOf('&showsettings=1') != -1) {
				var url = document.location.href.replace('&showsettings=1', '');
				history.replaceState(null, document.title, url);
			}
		}

		// Main tab bar page select
		jQuery('#ls-main-nav-bar a:not(.unselectable)').click(function(e) {
			e.preventDefault(); LayerSlider.selectMainTab( this );
		});

		// Generate preview if user resizes the browser
		jQuery(window).resize(function(){
			// LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
		});

		// Settings: checkboxes
		jQuery('.ls-settings :checkbox, .ls-layer-box :checkbox:not(.noreplace)').customCheckbox();

		// Generate preview
		jQuery(window).load(function() {
			LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
		});

		// Uploads
		LayerSlider.openMediaLibrary();
		LayerSlider.insertUpload();

		// Clear uploaded image
		jQuery(document).on({
			mouseenter : function() {
				if(jQuery(this).prev().val() != '') {
					jQuery(this).addClass('hover');
				}
			},
			mouseleave : function() {
				if(jQuery(this).prev().val() != '') {
					jQuery(this).removeClass('hover');
				}
			}
		}, '.ls-image');
		jQuery(document).on('click', '.ls-image a', function(e) {
			e.preventDefault();
			e.stopPropagation();
			jQuery(this).closest('.ls-image').removeClass('hover');
			jQuery(this).closest('.ls-image').find('img').attr('src', lsTrImgPath+'/not_set.png');
			jQuery(this).closest('.ls-image').prev().val('');
			jQuery(this).closest('.ls-image').prev().prev().val('');
			LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
		});

		// Settings: width, height
		jQuery('.ls-settings').find('input[name="width"], input[name="height"], input[name="sublayercontainer"]').keyup(function() {
			LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
		});

		// Settings: backgroundColor
		jQuery('.ls-settings input[name="backgroundcolor"]').keyup(function() {
			LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
		});

		// Settings: reset button
		jQuery(document).on('click', '.ls-reset', function() {

			// Empty field
			jQuery(this).prev().val('');

			// Generate preview
			LayerSlider.generatePreview( jQuery('.ls-box.active').index() );
		});

		// Settings: yourLogoStyle
		jQuery('.ls-settings input[name="yourlogostyle"]').keyup(function() {
			LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
		});

		// Add layer
		jQuery('#ls-add-layer').click(function(e) {
			e.preventDefault();
			LayerSlider.addLayer();
		});

		// Select layer
		jQuery('#ls-layer-tabs').on('click', 'a:not(.unsortable)', function(e) {
			e.preventDefault();
			LayerSlider.selectLayer(this);
		});

		// Duplicate layer
		jQuery('#ls-layers').on('click', 'button.ls-layer-duplicate', function(e){
			e.preventDefault();
			LayerSlider.duplicateLayer(this);
		});

		// Enter URL
		jQuery('#ls-layers').on('click', '.ls-url-prompt', function(e){
			e.preventDefault();
			var $target = null;
			var url = prompt('Enter an image URL');
			if(!url || url == '') { return false; }

			// Slide options
			if(jQuery(this).parent().is('.slide-image')) {
				$target = jQuery(this).closest('.slide-image');

			// Image layer
			} else if(jQuery(this).parent().parent().is('.ls-image-uploader')) {
				$target = jQuery(this).closest('.ls-image-uploader');
			}

			$target.children('input').eq(0).val('');
			$target.children('input').eq(1).val(url);
			$target.find('.ls-image img').attr('src', url);
			LayerSlider.willGeneratePreview( jQuery('.ls-box.active').index() );
		});

		// Open Transition gallery
		jQuery('#ls-layers').on('click', '.ls-select-transitions', function(e) {
			e.preventDefault();
			LayerSlider.openTransitionGallery();
		});

		// Close transition gallery
		jQuery(document).on('click', '#ls-transition-window header b', function(e) {
			e.preventDefault();
			LayerSlider.closeTransitionGallery();
		});

		// Add/Remove layer transitions
		jQuery(document).on('click', '#ls-transition-window tbody a:not(.ls-checkbox)', function(e) {
			e.preventDefault();
			LayerSlider.toggleTransition(this);
		});

		// Add/Remove layer transitions
		jQuery(document).on('click', '#ls-transition-window header i:last', function(e) {
			var check = jQuery(this).hasClass('off') ? true : false;
			jQuery('#ls-transition-window tbody.active').each(function() {
				LayerSlider.selectAllTransition( jQuery(this).index(), check );
			});
		});

		// Apply on others
		jQuery(document).on('click', '#ls-transition-window header i:not(:last)', function(e) {

			// Confirmation
			if(!confirm('Are you sure you want to apply the currently selected transitions on the other slides?')) {
				return false;
			}

			// Dim color briefly
			var button = jQuery(this);
			button.css('color', '#bbb');
			setTimeout(function() {
				button.css('color', '#444');
			}, 2000);

			// Apply to other slides
			jQuery('.ls-layer-box:not(.active) input[name="3d_transitions"]').val(
				jQuery('.ls-layer-box.active input[name="3d_transitions"]').val()
			);

			jQuery('.ls-layer-box:not(.active) input[name="2d_transitions"]').val(
				jQuery('.ls-layer-box.active input[name="2d_transitions"]').val()
			);

			jQuery('.ls-layer-box:not(.active) input[name="custom_3d_transitions"]').val(
				jQuery('.ls-layer-box.active input[name="custom_3d_transitions"]').val()
			);

			jQuery('.ls-layer-box:not(.active) input[name="custom_2d_transitions"]').val(
				jQuery('.ls-layer-box.active input[name="custom_2d_transitions"]').val()
			);
		});

		// Show transition
		jQuery(document).on('mouseenter', '#ls-transition-window table a:not(.ls-checkbox)', function() {
			LayerSlider.showTransition(this);
		});

		// Hide transition
		jQuery(document).on('mouseleave', '#ls-transition-window table a:not(.ls-checkbox)', function() {
			LayerSlider.hideTransition(this);
		});

		// Add sublayer
		jQuery('#ls-layers').on('click', '.ls-add-sublayer', function(e) {
			e.preventDefault();
			LayerSlider.addSublayer(this);
		});

		// Remove layer
		jQuery('#ls-layer-tabs').on('click', 'a span', function(e) {
			e.preventDefault();
			e.stopPropagation();
			LayerSlider.removeLayer(this);
		});


		// Select sublayer
		jQuery('#ls-layers').on('click', '.ls-sublayers tr', function() {
			LayerSlider.selectSubLayer(this);
		});


		// Sublayer pages
		jQuery('#ls-layers').on('click', '.ls-sublayer-nav a:not(:last-child)', function(e) {
			e.preventDefault();
			LayerSlider.selectSublayerPage(this);
		});

		// Remove sublayer
		jQuery('#ls-layers').on('click', '.ls-sublayer-nav a:last-child', function(e) {
			e.preventDefault();
			LayerSlider.removeSublayer(this);
		});

		// Duplicate sublayer
		jQuery('#ls-layers').on('click', '.ls-sublayer-options button.duplicate', function(e) {
			e.preventDefault();
			LayerSlider.duplicateSublayer(this);
		});

		// Highlight sublayer
		jQuery('#ls-layers').on('click', '.ls-highlight', function(e) {
			e.stopPropagation();
			LayerSlider.highlightSublayer(this);
		});

		// Sublayer media type
		jQuery('#ls-layers').on('click', '.ls-layer-kind li', function(e) {
			e.preventDefault();
			LayerSlider.selectMediaType(this);
		});

		// Sublayer element type
		jQuery('#ls-layers').on('click', '.ls-sublayer-element > li', function(e) {
			e.preventDefault();
			LayerSlider.selectElementType(this);
		});

		// Restore sublayer media type
		jQuery('#ls-layers .ls-sublayer-basic').each(function() {

			var kind = jQuery('input[name="media"]', this).val();
			var type = jQuery('input[name="type"]', this).val();
			var kindEl = jQuery('.ls-layer-kind li[data-section="'+kind+'"]', this);
			var typeEl = jQuery('.ls-sublayer-element > li[data-element="'+type+'"]', this);

			LayerSlider.selectMediaType(kindEl);
			LayerSlider.selectElementType(typeEl);
		});

		// Sublayer: Style
		jQuery('#ls-layers').on('keyup', '.ls-sublayer-style input, .ls-sublayer-style select, .ls-sublayer-style textarea', function() {
			LayerSlider.willGeneratePreview( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Sublayer: WordWrap
		jQuery('#ls-layers').on('click', '.ls-sublayers input[name="wordwrap"]', function() {
			LayerSlider.generatePreview( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Sublayer: HTML
		jQuery('#ls-layers').on('keyup', '.ls-sublayers textarea[name="html"]', function() {
			LayerSlider.willGeneratePreview( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Post content text length
		jQuery('#ls-layers').on('keydown change', '.ls-sublayers input[name="post_text_length"]', function() {
			LayerSlider.willGeneratePreview( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Sublayer: sortables, draggable, etc
		LayerSlider.addSortables();
		LayerSlider.addDraggable();
		LayerSlider.addLayerSortables();

		// Sublayer: skip
		jQuery('#ls-layers').on('click', '.ls-sublayer-options input[name="skip"]', function() {
			LayerSlider.skipSublayer(this);
		});

		// Preview
		jQuery('#ls-layers').on('click', '.ls-preview-button', function(e) {
			e.preventDefault();
			LayerSlider.play( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Preview drag element select
		jQuery('#ls-layers').on('click', '.draggable > *', function(e) {
			e.preventDefault();
			LayerSlider.selectDragElement(this);
		});

		// Save changes
		jQuery('#ls-slider-form').submit(function(e) {
			e.preventDefault();
			LayerSlider.save(this);
		});

		// Add color picker
		LayerSlider.addColorPicker( jQuery('#ls-slider-form input.ls-colorpicker') );


		// Show color picker on focus
		jQuery('.color').focus(function() {
			jQuery(this).next().slideDown();
		});

		// Show color picker on blur
		jQuery('.color').blur(function() {
			jQuery(this).next().slideUp();
		});

		// Eye icon for layers
		jQuery('#ls-layers').on('click', '.ls-icon-eye', function(e) {
			e.stopPropagation();
			LayerSlider.eyeSublayer(this);
		});

		// Lock icon for layers
		jQuery('#ls-layers').on('click', '.ls-icon-lock', function(e) {
			e.stopPropagation();
			LayerSlider.lockSublayer(this);
		});

		jQuery('ul.ls-settings-sidebar > li').click(function() {
			LayerSlider.selectSettingsTab(this);
		});

		// Collapse layer before sorting
		jQuery('#ls-layers').on('mousedown', '.ls-sublayer-sortable-handle', function(){
			jQuery(this).closest('.ls-sublayers').addClass('dragging');
		});


		// Expand layer after sorting
		jQuery('#ls-layers').on('mouseup', '.ls-sublayer-sortable-handle', function(){
			jQuery('#ls-layers .ls-layer-box.active .ls-sublayer-sortable').removeClass('dragging');
		});

		// Timeline
		lsTimeLine.init();
		LS_PostOptions.init();
		LayerSlider.addPreviewSlider( jQuery('#ls-layers .ls-editor-slider') );

		// Transitions gallery
		jQuery('#ls-transition-window .filters li').click(function() {

			// Update navigation
			jQuery(this).siblings().removeClass('active');
			jQuery(this).addClass('active');

			// Update view
			jQuery('#ls-transition-window tbody').removeClass('active');
			jQuery('#ls-transition-window tbody').eq( jQuery(this).index() ).addClass('active');

			// Custom transitions
			if(jQuery(this).index() == 2) {
				jQuery('#ls-transition-window tbody').eq(3).addClass('active');
			}

			// Update 'Select all' button
			var trs = jQuery('#ls-transition-window tbody.active td');
			if(trs.filter('.c.added').length == trs.filter('.c').length) {
				jQuery('#ls-transition-window header i:last').attr('class', 'on').text('Deselect all');
			} else {
				jQuery('#ls-transition-window header i:last').attr('class', 'off').text('Select all');
			}
		});

		// Link slide to post url
		jQuery('#ls-layers').on('click', '.ls-slide-link a', function(e) {
			e.preventDefault();
			jQuery(this).closest('.ls-slide-link').children('input').val('[post-url]');
		});


		// Use post image as slide background
		jQuery('#ls-layers').on('click', '.slide-image .ls-post-image', function(e) {
			e.preventDefault();
			jQuery(this).closest('.slide-image').children('input[name="backgroundId"]').val('');
			jQuery(this).closest('.slide-image').children('input[name="background"]').val('[image-url]');

			jQuery(this).closest('.slide-image').children('input[name="imageId"]').val('');
			jQuery(this).closest('.slide-image').children('input[name="image"]').val('[image-url]');

			LayerSlider.generatePreview( jQuery(this).closest('.ls-layer-box').index() );
		});

		// Hide zoom slider if not supported by browser
		if(typeof document.body.style.zoom === 'undefined') {
			jQuery('.ls-editor-zoom').addClass('ls-hidden');
		}
	}

});
