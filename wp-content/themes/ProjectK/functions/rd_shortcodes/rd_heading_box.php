<?php 

/*-----------------------------------------------------------------------------------*/



/* Title / Heading



/*-----------------------------------------------------------------------------------*/

function heading_box_sc($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',
		'animation' => '',

		'color' => '',
		'bg_color' => '',
		'border_color' => '',
		'border_bottom_color' => '',
    ), $atts));
	
	global $rd_data;
	if($color == '' ){
		$color = $rd_data['rd_content_heading_color'];
	}
	if($bg_color == '' ){
		$bg_color = $rd_data['rd_content_bg_color'];
	}
	if($border_color == '' ){
		$border_color = $rd_data['rd_content_heading_color'];
	}
	if($border_bottom_color == '' ){
		$border_bottom_color = $rd_data['rd_content_hl_color'];
	}
	
			return '<div class="heading_box_sc_ctn" style="margin:'.$margin_top.'px 0px '.$margin_bottom.'px;"><div class="heading_box_sc '.$animation.'" style="border-color:'.$border_bottom_color.';"><h3 style="border-color:'.$border_color.'; color:'.$color.'; background:'.$bg_color.'">'.$content.'</h3></div></div>';

}

add_shortcode("heading_box_sc", "heading_box_sc");


?>