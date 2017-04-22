<?php 


/*-----------------------------------------------------------------------------------*/



/* Timeline Event shortcode



/*-----------------------------------------------------------------------------------*/


add_shortcode( 'timeline_event_ctn', 'timeline_event_ctn' );


function timeline_event_ctn( $atts, $content ){

extract( shortcode_atts( array(
        'bg_color' => '',
		'hl_color' => '',
		'alt_hl_color' => '',
		'vline_color' => '',
		'vline_alt_color' => '',
		'h_color' => '',
		't_color' => '',
		'b_color' => '',
		'margin_bottom' => '',
		'margin_top' => '',
	), $atts ) );

ob_start();	
$id = RandomString(20);	
global $rd_data;


if($bg_color == '' ){
	$bg_color = $rd_data['rd_content_bg_color'];
}

if($hl_color == '' ){
	$hl_color = $rd_data['rd_content_hl_color'];
}
if($alt_hl_color == '' ){
	$alt_hl_color = $rd_data['rd_content_alt_hl_color'];
}

if($vline_color == '' ){
	$vline_color = $rd_data['rd_content_hl_color'];
}

if($vline_alt_color == '' ){
	$vline_alt_color = $rd_data['rd_content_alt_hl_color'];
}
if($h_color == '' ){
	$h_color = $rd_data['rd_content_heading_color'];
}

if($t_color == '' ){
	$t_color = $rd_data['rd_content_text_color'];
}

if($b_color == '' ){
	$b_color = $rd_data['rd_content_border_color'];
}


$output ='<style>#tle_'.$id.' .v_line{background: '.$vline_color.'; background: -moz-linear-gradient(top, '.$vline_color.' 1%, '.$vline_alt_color.' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,'.$vline_color.'), color-stop(100%,'.$vline_alt_color.')); background: -webkit-linear-gradient(top, '.$vline_color.' 1%,'.$vline_alt_color.' 100%); background: -o-linear-gradient(top, '.$vline_color.' 1%,'.$vline_alt_color.' 100%); background: -ms-linear-gradient(top, '.$vline_color.' 1%,'.$vline_alt_color.' 100%); background: linear-gradient(to bottom, '.$vline_color.' 1%,'.$vline_alt_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$vline_color.'", endColorstr="'.$vline_alt_color.'",GradientType=0 );}#tle_'.$id.' .event_img{border-color:'.$b_color.';}#tle_'.$id.' .event_info h2{color:'.$h_color.';}#tle_'.$id.' .event_info p{color:'.$t_color.';}#tle_'.$id.' span.timeline_event_date_ctn:nth-of-type(odd) .timeline_event_date,#tle_'.$id.' span.timeline_event_date_ctn:nth-of-type(odd) h2{background:'.$bg_color.'; color:'.$t_color.';}#tle_'.$id.' span.timeline_event_date_ctn:nth-of-type(even) .timeline_event_date,#tle_'.$id.' span.timeline_event_date_ctn:nth-of-type(even) h2{background:'.$bg_color.'; color:'.$h_color.';}#tle_'.$id.' div.timeline_event:nth-of-type(even):after {color:'.$hl_color.';}#tle_'.$id.' div.timeline_event:nth-of-type(odd):before {color:'.$alt_hl_color.';}#tle_'.$id.' {margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; }</style>';

$output .= "\n".'<!-- Timeline Event --><div class="timeline_event_ctn clearfix" id="tle_'.$id.'"><div class="v_line"></div>'.do_shortcode($content).'</div>

<!-- Timeline Event END-->'."\n";


echo !empty( $output ) ? $output : '';


$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 		

}


function timeline_event($atts, $content = null) {
	extract( shortcode_atts( array(
        'title' => '',
        'image' => '',
        'animation' => '',
	), $atts ) );

ob_start();	

$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '250'  ) );	
	
		$output = '<div class="timeline_event '.$animation.'"><div class="event_img">'.$img['thumbnail'].'</div><div class="event_info"><h2>'.$title.'</h2><p>'.do_shortcode($content).'</p></div></div>';
		

echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 		
	}
add_shortcode('timeline_event', 'timeline_event');


function timeline_date($atts, $content = null) {
	extract( shortcode_atts( array(
        'date' => '',
	), $atts ) );

	
		return '<span class="timeline_event_date_ctn"><div class="timeline_event_date"><h2>'.$date.'</h2></div></span>';
	}
add_shortcode('timeline_date', 'timeline_date')

?>