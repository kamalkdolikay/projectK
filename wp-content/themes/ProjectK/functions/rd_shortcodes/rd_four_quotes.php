<?php 



/*-----------------------------------------------------------------------------------*/



/*	Share Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_fq_sc( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'q_color'   => '',
		'a_color'   => '',
		'ai_color'   => '',
		'hl_color'   => '',
		'i_color'   => '',
		'i_b_color'   => '',
		'i_bg_color'   => '',
		'author_one'   => '',
		'info_one'   => '',
		'quote_one'   => '',
		'author_two'   => '',
		'info_two'   => '',
		'quote_two'   => '',
		'author_three'   => '',
		'info_three'   => '',
		'quote_three'   => '',
		'author_four'   => '',
		'info_four'   => '',
		'quote_four'   => '',
		'animation'   => '',
		'mt'   => '',
		'mb'   => '',


    ), $atts));



   	ob_start();
	global $rd_data;
$id = RandomString(20);
if($hl_color == ''){
$hl_color = $rd_data['rd_content_hl_color'];
}

$output = '<style>#rd_'.$id.' {margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;}#rd_'.$id.' .sc-four-quote-first,#rd_'.$id.' .sc-four-quote-last{border-color:'.$i_b_color.' !important; }#rd_'.$id.' p{color:'.$q_color.'; }#rd_'.$id.' h3{color:'.$a_color.'; }#rd_'.$id.' h4{color:'.$ai_color.'; }#rd_'.$id.' .quote_meta h3:before{background:'.$hl_color.'; }#rd_'.$id.' .sc-four-quote-icon:before{background:'.$i_bg_color.'; box-shadow: 0 0 0 1px '.$i_b_color.',0 0 0 5px '.$i_bg_color.',0 0 0 6px '.$i_b_color.';}#rd_'.$id.' .sc-four-quote-icon:after{color:'.$i_color.';}';

$output .= '</style>';

$output .= '<div class="sc-four-quote" id="rd_'.$id.'">';



$output .= '<div class="sc-four-quote-ctn quote-top-row"><div class="sc-four-quote-first"><p>'.$quote_one.'</p><div class="quote_meta clearfix"><h3>'.$author_one.'</h3><h4>/ '.$info_one.'</h4></div></div>';
$output .= '<div class="sc-four-quote-last "><p>'.$quote_two.'</p><div class="quote_meta clearfix"><h3>'.$author_two.'</h3><h4>/ '.$info_two.'</h4></div></div></div>';
$output .= '<div class="sc-four-quote-icon '.$animation.'"></div><div class="sc-four-quote-ctn quote-bottom-row">';
$output .= '<div class="sc-four-quote-first"><p>'.$quote_three.'</p><div class="quote_meta clearfix"><h3>'.$author_three.'</h3><h4>/ '.$info_three.'</h4></div></div>';
$output .= '<div class="sc-four-quote-last"><p>'.$quote_four.'</p><div class="quote_meta clearfix"><h3>'.$author_four.'</h3><h4>/ '.$info_four.'</h4></div></div></div>';


$output .= '</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

}


add_shortcode('rd_fq_sc', 'rd_fq_sc');


?>