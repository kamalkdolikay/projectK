<?php 

/*-----------------------------------------------------------------------------------*/



/* Divider with Text



/*-----------------------------------------------------------------------------------*/

function text_divider($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'font_size' => '15',

		'font_weight' => 'bold',
	
		'text_transform' => 't_uppercase',

		'color' => '#444444'
    ), $atts));
			return '

<!-- Divider -->

<div class="clearfix" style="padding-top:'.$margin_top.'px"></div><div class="sc_divider" ><span class="'.$text_transform.'" style="font-size:'.$font_size.'px; font-weight:'.$font_weight.'; color:'.$color.';">'.$content.'</span></div><div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>

<!-- Divider END-->';

}

add_shortcode("text_divider", "text_divider");

?>