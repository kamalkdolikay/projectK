<?php 



/*-----------------------------------------------------------------------------------*/



/*	Progress bar Shortcodes



/*-----------------------------------------------------------------------------------*/





function rd_pb_ctn( $atts, $content ){

extract( shortcode_atts( array(
        'style' => '',
	), $atts ) );
ob_start();

echo "\n".'<!-- Progress bar --><div class="rd_pb_holder '.$style.'">'.do_shortcode($content).'</div>

<!-- Progress bar END-->'."\n";


$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

}


add_shortcode( 'progress_bar_ctn', 'rd_pb_ctn' );

function rd_progress_bar( $atts, $content = null ) {


	$src = get_stylesheet_directory_uri();


	extract(shortcode_atts(array(


		'title'   => 'title',
		'percentage' => '0',
		'title_color' => '',
		'pb_color'=> '',
		'pb_alt_color'=> '',
		'pb_ctn_color'=> '',
		'border_color'=> '',		
		'stripe'=> '',		
		'stripe_animation'=> '',


    ), $atts));

ob_start();
$pbid = RandomString(20);
global $rd_data;
	$mc_bg_color = $rd_data['rd_content_bg_color'];
	$mc_heading_color = $rd_data['rd_content_heading_color'];
	$mc_text_color = $rd_data['rd_content_text_color'];
	$mc_hl_color = $rd_data['rd_content_hl_color'];
	$mc_hover_color = $rd_data['rd_content_hover_color'];
	$mc_light_hover_color = $rd_data['rd_content_light_hover_color'];
	$mc_border_color = $rd_data['rd_content_border_color'];
	$mc_grey_color = $rd_data['rd_content_grey_color'];
$percentage;
if($title_color == ''){
	$title_color = $mc_heading_color; 
}
if($pb_color == ''){
	$pb_color = $mc_hl_color; 
}
if($pb_ctn_color == ''){
	$pb_ctn_color = $mc_grey_color; 
}
if($border_color == ''){
	$border_color = $mc_border_color; 
}
	if($percentage < 100){
$output ='<style>#pb_'.$pbid.' .pb_title,#pb_'.$pbid.' .pb_sub_title,#pb_'.$pbid.' .pb_sub_percentage,.rd_pb_1 #pb_'.$pbid.' .pb_percentage,.rd_pb_2 #pb_'.$pbid.' .pb_percentage,.rd_pb_7 #pb_'.$pbid.' .pb_percentage{color:'.$title_color.';}';
if ($pb_alt_color !== '') {
$output .='#pb_'.$pbid.' .pb_bg{background: '.$pb_color.'; background: -moz-linear-gradient(left,  '.$pb_color.' 0%, '.$pb_alt_color.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$pb_color.'), color-stop(100%,'.$pb_alt_color.'));  background: -webkit-linear-gradient(left,  '.$pb_color.' 0%,'.$pb_alt_color.' 100%); background: -o-linear-gradient(left,  '.$pb_color.' 0%,'.$pb_alt_color.' 100%); background: -ms-linear-gradient(left,  '.$pb_color.' 0%,'.$pb_alt_color.' 100%); background: linear-gradient(to right,  '.$pb_color.' 0%,'.$pb_alt_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$pb_color.'", endColorstr="'.$pb_alt_color.'",GradientType=1 ); }';


}else{
$output .='#pb_'.$pbid.' .pb_bg{background:'.$pb_color.';}';
}

$output .='.rd_pb_3 #pb_'.$pbid.' .pb_percentage,.rd_pb_8 #pb_'.$pbid.' .pb_percentage,.rd_pb_9 #pb_'.$pbid.' .pb_percentage{left:'.$percentage.'%; content:""!important; }.rd_pb_3 #pb_'.$pbid.' .pb_percentage:before,.rd_pb_8 #pb_'.$pbid.' .pb_percentage:before,.rd_pb_9 #pb_'.$pbid.' .pb_percentage:before{content:"'.$percentage.'%";}';

	if($stripe == 'yes'){
		
		
	}

$output .='#pb_'.$pbid.' .pb_ctn{background:'.$pb_ctn_color.'; border:1px solid '.$border_color.';}</style>';

$output .= '<div class="progress_bar_sc" id="pb_'.$pbid.'">

<div class="pb_title">'.$title.'</div>

<div class="pb_percentage">'.$percentage.'%</div>

<div class="clearfix"></div>

<div class="pb_ctn">

<div class="pb_bg" data-percentage-value="'.$percentage.'"><span class="pb_sub_title">'.$title.'</span><span class="pb_sub_percentage">: '.$percentage.'%</span></div>';
	
	if($stripe !== '' && $stripe_animation !== ''){

$output .= '<div class="pb_stripe moving_stripe"></div>';

	}
	elseif($stripe !== ''){

$output .= '<div class="pb_stripe"></div>';

	}
$output .= '</div>

</div>';

echo !empty( $output ) ? $output : '';

	}

	else{   return '

	<div class="progress_bar_sc">

	<div class="pb_title">'.$title.'</div>

	<div class="pb_percentage" style="left:'.$percentage.'%">'.$percentage.'%</div>

	<div class="clearfix"></div>

   <div class="pb_ctn"><div class="pb_bg" style="width:'.$percentage.'%;"><span class="pb_sub_title">'.$title.'</span><span class="pb_sub_percentage">: '.$percentage.'%</span></div></div></div>'; 

}

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 
}


add_shortcode('progress_bar', 'rd_progress_bar');



?>