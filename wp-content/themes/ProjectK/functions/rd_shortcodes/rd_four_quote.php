<?php 



/*-----------------------------------------------------------------------------------*/



/*	Share Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_fq_sc( $atts, $content = null ) {

	extract(shortcode_atts(array(


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


    ), $atts));



   	ob_start();
	global $rd_data;
$id = RandomString(20);
if($hover_color == ''){
$hover_color = $rd_data['rd_content_text_color'];
}

$output = '<style>#rd_'.$id.' {margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;}';

$output .= '</style>';

$output .= '<div class="sc-four-quote" id="rd_'.$id.'">';



$output .= '<div class="sc-four-quote-first"><p>'.$quote_one.'</p><div class="quote_meta"><h3>'.$author_one.'</h3><h4>/ '.$info_one.'</h4></div>';
$output .= '<div class="sc-four-quote-two"><p>'.$quote_two.'</p><div class="quote_meta"><h3>'.$author_two.'</h3><h4>/ '.$info_two.'</h4></div>';
$output .= '<div class="sc-four-quote-icon"></div>';
$output .= '<div class="sc-four-quote-three"><p>'.$quote_three.'</p><div class="quote_meta"><h3>'.$author_three.'</h3><h4>/ '.$info_three.'</h4></div>';
$output .= '<div class="sc-four-quote-four"><p>'.$quote_four.'</p><div class="quote_meta"><h3>'.$author_four.'</h3><h4>/ '.$info_four.'</h4></div>';


$output .= '</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

}


add_shortcode('rd_fq_sc', 'rd_fq_sc');


?>