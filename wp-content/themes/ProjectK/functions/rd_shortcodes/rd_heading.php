<?php 

/*-----------------------------------------------------------------------------------*/



/* Title / Heading



/*-----------------------------------------------------------------------------------*/

function heading_sc($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'font_size' => '24',

		'text_align' => 'left',
		
		'letter_spacing' => 'normal',
		
		'font_weight' => 'normal',
	
		'text_transform' => 'none',

		'color' => '#444444'
    ), $atts));
	
	$line_height = $font_size + 6;
	
			return '<h3 class="heading_sc" style="text-align:'.$text_align.'; font-weight:'.$font_weight.'; letter-spacing:'.$letter_spacing.'px; font-size:'.$font_size.'px; padding-top:'.$margin_top.'px; padding-bottom:'.$margin_bottom.'px; color:'.$color.'; text-transform:'.$text_transform.'; line-height:'.$line_height.'px; margin:0;">'.$content.'</h3>';

}

add_shortcode("heading_sc", "heading_sc");


?>