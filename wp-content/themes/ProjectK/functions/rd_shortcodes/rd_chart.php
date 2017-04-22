<?php 

/*-----------------------------------------------------------------------------------*/



/* Chart


/*-----------------------------------------------------------------------------------*/

function rd_chart($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',
	
		'type' => '',
		'percentage' => '',
		'p_color' => '',
		'p_b_color' => '',
		'bar_color' => '',
		'bar_alt_color' => '',
		'track_color' => '',
		'bg_color' => '',
		'ball_color' => '',
		'heading' => '',
		'heading_color' => '',
		'text' => '',
		'text_color' => '',
		'animation' => '',
    ), $atts));
	
$pc_id = RandomString(20);
	$output = '<style>#rd_'.$pc_id.' {margin-top:'.$margin_top.'; margin-bottom:'.$margin_bottom.';}#rd_'.$pc_id.' .rd_pc_status{color:'.$p_color.';}#rd_'.$pc_id.' .rd_pc_heading{color:'.$heading_color.';}#rd_'.$pc_id.' .rd_pc_text{color:'.$text_color.';}</style>';
	
	
	
	

if($bar_alt_color == ''){
	$bar_alt_color = $bar_color ;
}
	
	$output .='<div class="'.$type.' rd_pie_chart '.$animation.'" id="rd_'.$pc_id.'"><div class="rd_count_to rd_pc_status"><span class="count_number" data-from="0" data-to="'.$percentage.'" data-speed="1000" data-refresh-interval="25">0</span><span>%</span></div>';

if($type== 'rd_pie_01'){
	
	$output .='<div class="rd_pc_track" style="color:'.$track_color.'"></div><div class="rd_pc_track_in"></div><canvas class="rd_pc_01" width="520" height="400" data-percentage-value="'.$percentage.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" >Your browser does not support the HTML5 canvas tag.</canvas>';
	}


	if($type== 'rd_pie_02'){

if($p_b_color == ''){
	$p_b_color = "#ecf0f1" ;
}
if($bg_color == ''){
	$bg_color = "#ffffff" ;
}
	$output .='<canvas class="rd_pc_02" width="520" height="400" data-percentage-value="'.$percentage.'" data-percentage-color="'.$p_b_color.'" data-background-color="'.$bg_color.'" data-track-color="'.$track_color.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" >Your browser does not support the HTML5 canvas tag.</canvas>';
	}
	
	if($type== 'rd_pie_03'){
if($p_b_color == ''){
	$p_b_color = "#34495e" ;
}
if($bg_color == ''){
	$bg_color = "#cdd5db" ;
}
	$output .='<canvas class="rd_pc_03" width="520" height="400" data-percentage-value="'.$percentage.'" data-percentage-color="'.$p_b_color.'" data-background-color="'.$bg_color.'" data-track-color="'.$track_color.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" >Your browser does not support the HTML5 canvas tag.</canvas>';
	}
	if($type== 'rd_pie_04'){
	$output .='<canvas class="rd_pc_04" width="340" height="200" data-percentage-value="'.$percentage.'" data-track-color="'.$track_color.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" >Your browser does not support the HTML5 canvas tag.</canvas>';
	}
	if($type== 'rd_pie_05'){
	$output .='<canvas class="rd_pc_05" width="520" height="400" data-percentage-value="'.$percentage.'" data-track-color="'.$track_color.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" data-ball-color="'.$ball_color.'">Your browser does not support the HTML5 canvas tag.</canvas>';
	}
	if($heading !== ''){
	$output .='<h3 class="rd_pc_heading">'.$heading.'</h3>';
	}
	if($text !== ''){
	$output .='<p class="rd_pc_text">'.$text.'</p>';
	}
	$output .='</div>';

	return $output;
	

}

add_shortcode("rd_chart", "rd_chart");





?>