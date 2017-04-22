<?php 


/*-----------------------------------------------------------------------------------*/



/* Divider with Icon



/*-----------------------------------------------------------------------------------*/

function icon_divider($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'font_size' => '30',

		'color' => '#d6d6d6',

		'icon'	=> 'cog',
    ), $atts));
			return '

<!-- Divider -->

<div class="clearfix" style="padding-top:'.$margin_top.'px"></div><div class="sc_divider" ><span class="fa-'.$icon.'" style="color:'.$color.'; font-size:'.$font_size.'px;"></span></div><div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>

<!-- Divider END-->';

}

add_shortcode("icon_divider", "icon_divider");

?>