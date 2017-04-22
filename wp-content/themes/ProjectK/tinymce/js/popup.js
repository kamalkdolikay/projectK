
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var rds = {
    	loadVals: function()
    	{
    		var shortcode = $('#_rd_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.rd-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('rd_', ''),		// gets rid of the rd_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_rd_ushortcode').remove();
    		$('#rd-sc-form-table').prepend('<div id="_rd_ushortcode" class="hidden">' + uShortcode + '</div>');
    		
    		// updates preview
    		rds.updatePreview();
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_rd_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.rd-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('rd_', '')		// gets rid of the rd_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_rd_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_rd_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_rd_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_rd_ushortcode').remove();
    		$('#rd-sc-form-table').prepend('<div id="_rd_ushortcode" class="hidden">' + pShortcode + '</div>');
    		
    		// updates preview
    		rds.updatePreview();
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	updatePreview: function()
    	{
    		if( $('#rd-sc-preview').size() > 0 )
    		{
	    		var	shortcode = $('#_rd_ushortcode').html(),
	    			iframe = $('#rd-sc-preview'),
	    			iframeSrc = iframe.attr('src'),
	    			iframeSrc = iframeSrc.split('preview.php'),
	    			iframeSrc = iframeSrc[0] + 'preview.php';
    			
	    		// updates the src value
	    		iframe.attr( 'src', iframeSrc + '?sc=' + escape( shortcode ) );
	    		
	    		// update the height
	    		$('#rd-sc-preview').height( $('#rd-popup').outerHeight()-42 );
    		}
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				rdPopup = $('#rd-popup'),
				no_preview = ($('#_rd_preview').text() == 'false') ? true : false;
			
			if( no_preview )
			{
				ajaxCont.css({
					paddingTop: 0,
					paddingLeft: 0,
					height: (tbWindow.outerHeight()-47),
					overflow: 'scroll', // IMPORTANT
					width: 560
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					marginLeft: -(ajaxCont.outerWidth()/2)
				});
				
				$('#rd-popup').addClass('no_preview');
			}
			else
			{
				ajaxCont.css({
					padding: 0,
					// height: (tbWindow.outerHeight()-47),
					height: rdPopup.outerHeight()-15,
					overflow: 'hidden' // IMPORTANT
				});
				
				tbWindow.css({
					width: ajaxCont.outerWidth(),
					height: (ajaxCont.outerHeight() + 30),
					marginLeft: -(ajaxCont.outerWidth()/2),
					marginTop: -((ajaxCont.outerHeight() + 47)/2),
					top: '50%'
				});
			}
    	},
    	load: function()
    	{
    		var	rds = this,
    			popup = $('#rd-popup'),
    			form = $('#rd-sc-form', popup),
    			shortcode = $('#_rd_shortcode', form).text(),
    			popupType = $('#_rd_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		rds.resizeTB();
    		$(window).resize(function() { rds.resizeTB() });
    		
    		// initialise
    		rds.loadVals();
    		rds.children();
    		rds.cLoadVals();
    		
    		// update on children value change
    		$('.rd-cinput', form).live('change', function() {
    			rds.cLoadVals();
    		});
    		
    		// update on value change
    		$('.rd-input', form).change(function() {
    			rds.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.rd-insert', form).click(function(event) {event.preventDefault();
                if(parent.tinyMCE)
                {   
                    parent.tinyMCE.execCommand('mceInsertContent', false, $('#_rd_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#rd-popup').livequery( function() { rds.load(); } );
	
	
});