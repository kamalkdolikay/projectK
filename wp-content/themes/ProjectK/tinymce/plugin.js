(function($) {
"use strict";   
 


 			//Shortcodes
           tinymce.PluginManager.add( 'rdShortcodes', function( editor, url ) {

				editor.addCommand("rdPopup", function ( a, params )
				
				{
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
				});
     
                editor.addButton( 'rd_button', {
                    icon: 'rd-mce-icon',
					type: 'splitbutton' ,
					onclick : function(e) {},
					menu: [
					{text: 'Dropcap',onclick:function(){
						editor.execCommand("rdPopup", false, {title: 'Dropcap',identifier: 'dropcap'})
					}},
					{text: 'Highlight',onclick:function(){
						editor.execCommand("rdPopup", false, {title: 'Hightlight',identifier: 'highlight'})
					}},
					{text: 'Tool-tip',onclick:function(){
						editor.execCommand("rdPopup", false, {title: 'Tool tips',identifier: 'tooltip'})
					}},
					]                
        	  });
         
          });
         
 
})(jQuery);