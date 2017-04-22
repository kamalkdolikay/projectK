<?php 



/*-----------------------------------------------------------------------------------*/



/*	Testimonials Shortcodes



/*-----------------------------------------------------------------------------------*/





function testimonials_ctn( $atts, $content ){

extract( shortcode_atts( array(
        'style' => '',
        't_color' => '',
        'h_color' => '',
        'hl_color' => '',
        'bg_color' => '',
        'b_color' => '',
        'margin_top' => '',
        'margin_bottom' => '',
		'animation' => ''
	), $atts ) );
ob_start();


global $rd_data;

if($t_color == '' ){
	$t_color = $rd_data['rd_content_text_color'];
}
if($h_color == '' ){
	$h_color = $rd_data['rd_content_heading_color'];
}
if($hl_color == '' ){
	$hl_color = $rd_data['rd_content_hl_color'];
}
if($bg_color == '' ){
	$bg_color = $rd_data['rd_content_bg_color'];
}
if($b_color == '' ){
	$b_color = $rd_data['rd_content_border_color'];
}

$id = RandomString(20);	



$output= '<style>';


if($style == 'rd_tm_1' ){

	$output.= '#tm_'.$id.'.rd_tm_1 .tm_author,#tm_'.$id.'.rd_tm_1 .tm_info{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_1 .tm_text{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_1 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_1 .rd_tm_pager a.selected{background:none!important; border:1px solid '.$t_color.'; }';
	
	
}



elseif($style == 'rd_tm_2' ){

	$output.= '#tm_'.$id.'.rd_tm_2 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_2 .tm_text,#tm_'.$id.'.rd_tm_2 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_2 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.'; border-right-color:'.$hl_color.';}#tm_'.$id.'.rd_tm_2 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_2 .rd_tm_pager a.selected{background:'.$hl_color.'}';
	
	
}



elseif($style == 'rd_tm_3' ){

	$output.= '#tm_'.$id.'.rd_tm_3 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_3 .tm_text,#tm_'.$id.'.rd_tm_3 .tm_text:after,#tm_'.$id.'.rd_tm_3 .tm_image{ color:'.$t_color.'; background:'.$bg_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_3 .rd_tm_pager a{background:'.$bg_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_3 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_3 .rd_tm_pager a.selected:after{background:'.$hl_color.';}';	
	
}


elseif($style == 'rd_tm_4' ){

	$output.= '#tm_'.$id.'.rd_tm_4 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_4 .tm_text,#tm_'.$id.'.rd_tm_4 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_4 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.';}#tm_'.$id.'.rd_tm_4 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_4 .rd_tm_pager a.selected{background:'.$hl_color.'}';
	
	
}



elseif($style == 'rd_tm_5' ){

	$output.= '#tm_'.$id.'.rd_tm_5 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_5 .tm_text,#tm_'.$id.'.rd_tm_5 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_5 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.';}#tm_'.$id.'.rd_tm_5 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_5 .rd_tm_pager a.selected{background:'.$hl_color.'}#tm_'.$id.'.rd_tm_5 .tm_image{  border-color:'.$b_color.';}';
	
	
}



elseif($style == 'rd_tm_6' ){

	$output.= '#tm_'.$id.'.rd_tm_6 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_6 .tm_text,#tm_'.$id.'.rd_tm_6 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_6 .rd_tm_pager a{background:none; border-color:'.$t_color.';}#tm_'.$id.'.rd_tm_6 .rd_tm_pager a.selected{background:'.$t_color.'}';
	
	
}


elseif($style == 'rd_tm_7' ){

	$output.= '#tm_'.$id.'.rd_tm_7 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_7 .tm_text,#tm_'.$id.'.rd_tm_7 .tm_text:after{ color:'.$t_color.'; background:'.$bg_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_7 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_7 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_7 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_7 .rd_tm_pager a.selected{background:'.$hl_color.';}';	
	
}


elseif($style == 'rd_tm_8' ){

	$output.= '#tm_'.$id.'.rd_tm_8 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_8 .tm_l_nav,#tm_'.$id.'.rd_tm_8 .tm_r_nav{ color:'.$t_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_8 .tm_text,#tm_'.$id.'.rd_tm_8 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_8 .tm_l_nav:hover,#tm_'.$id.'.rd_tm_8 .tm_r_nav:hover{background:'.$hl_color.'; color:#fff;}';	
	
}



elseif($style == 'rd_tm_9' ){

	$output.= '#tm_'.$id.'.rd_tm_9 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_9 .tm_l_nav,#tm_'.$id.'.rd_tm_9 .tm_r_nav{ color:'.$t_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_9 .tm_text,#tm_'.$id.'.rd_tm_9 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_9 .tm_l_nav:hover,#tm_'.$id.'.rd_tm_9 .tm_r_nav:hover{background:'.$hl_color.'; color:#fff;}';	
	
}




elseif($style == 'rd_tm_10' ){

	$output.= '#tm_'.$id.'.rd_tm_10 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_10 .tm_text,#tm_'.$id.'.rd_tm_10 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_10 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_10 .rd_tm_pager a.selected{background:'.$hl_color.';}#tm_'.$id.'.rd_tm_10 .tm_image{border-color:'.$b_color.';}#tm_'.$id.'.rd_tm_10 .tm_image img{background:'.$b_color.';}';	
	
}


elseif($style == 'rd_tm_11' ){

	$output.= '#tm_'.$id.'.rd_tm_11 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_11 .tm_text,#tm_'.$id.'.rd_tm_11 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_11 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.';}#tm_'.$id.'.rd_tm_11 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_11 .rd_tm_pager a.selected{background:'.$hl_color.'}';
	
	
}


elseif($style == 'rd_tm_12' ){

	$output.= '#tm_'.$id.'.rd_tm_12 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_12 .tm_text,#tm_'.$id.'.rd_tm_12 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_12 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_12 .rd_tm_pager a.selected{background:'.$hl_color.'}#tm_'.$id.'.rd_tm_12 .tm_image{  border-color:'.$b_color.';}';
	
	
}

elseif($style == 'rd_tm_13' ){

	$output.= '#tm_'.$id.'.rd_tm_13 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_13 .tm_text{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_13 .tm_image{background:'.$b_color.';}#tm_'.$id.'.rd_tm_13 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_13 .rd_tm_pager a{background:'.$bg_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_13 .rd_tm_pager a.selected:after{background:'.$hl_color.';}';	
	
}
elseif($style == 'rd_tm_14' ){

	$output.= '#tm_'.$id.'.rd_tm_14 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_14 .tm_text,#tm_'.$id.'.rd_tm_14 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_14 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.'; }#tm_'.$id.'.rd_tm_14 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_14 .rd_tm_pager a.selected{background:'.$hl_color.'}';
	
	
}


elseif($style == 'rd_tm_15' ){

	$output.= '#tm_'.$id.'.rd_tm_15 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_15 .tm_text,#tm_'.$id.'.rd_tm_15 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_15 .tm_text{ background:'.$bg_color.'; border-color:'.$b_color.';}#tm_'.$id.'.rd_tm_15 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_15 .rd_tm_pager a.selected{background:'.$hl_color.'}';
	
	
}


elseif($style == 'rd_tm_16' ){

	$output.= '#tm_'.$id.'.rd_tm_16 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_16 .tm_text,#tm_'.$id.'.rd_tm_16 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_16 .rd_tm_pager a{background:'.$t_color.';}#tm_'.$id.'.rd_tm_16 .rd_tm_pager a.selected{background:'.$hl_color.';}';	
	
}

elseif($style == 'rd_tm_17' ){

	$output.= '#tm_'.$id.'.rd_tm_17 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_17 .tm_text{ color:'.$t_color.'; background:'.$bg_color.';}#tm_'.$id.'.rd_tm_17 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_17 .rd_tm_pager a{background:none; border-color:'.$t_color.';}#tm_'.$id.'.rd_tm_17 .rd_tm_pager a.selected{background:'.$t_color.'}#tm_'.$id.'.rd_tm_17 .tm_text:after{border-color: transparent '.$bg_color.' transparent;}';	
	
}
elseif($style == 'rd_tm_18' ){

	$output.= '#tm_'.$id.'.rd_tm_18 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_18 .tm_text{ color:'.$t_color.'; background:'.$bg_color.';}#tm_'.$id.'.rd_tm_18 .tm_info{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_18 .rd_tm_pager a{background:none; border-color:'.$t_color.';}#tm_'.$id.'.rd_tm_18 .rd_tm_pager a.selected{background:'.$t_color.'}#tm_'.$id.'.rd_tm_18 .tm_text:after{border-color: transparent '.$bg_color.' transparent;}';	
	
}

elseif($style == 'rd_tm_19' ){

	$output.= '#tm_'.$id.'.rd_tm_19 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_19 .tm_text{ color:'.$t_color.';}#tm_'.$id.'.rd_tm_19 .tm_image{background:'.$b_color.';}#tm_'.$id.'.rd_tm_19 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_19 .rd_tm_pager a{background:none; border-color:'.$t_color.';}#tm_'.$id.'.rd_tm_19 .rd_tm_pager a.selected{background:'.$t_color.'}';	
	
}


elseif($style == 'rd_tm_20' ){

	$output.= '#tm_'.$id.'.rd_tm_20 .tm_author{ color:'.$h_color.';}#tm_'.$id.'.rd_tm_20 .tm_l_nav,#tm_'.$id.'.rd_tm_20 .tm_r_nav{ color:'.$t_color.'; border:1px solid '.$b_color.';}#tm_'.$id.'.rd_tm_20 .tm_text,#tm_'.$id.'.rd_tm_20 .tm_info{color:'.$t_color.'; }#tm_'.$id.'.rd_tm_20 .tm_l_nav:hover,#tm_'.$id.'.rd_tm_20 .tm_r_nav:hover{background:'.$hl_color.'; color:#fff;}';	
	
}



$output.= '#tm_'.$id.' {margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;}</style>';




	$output .= '<script type="text/javascript" charset="utf-8">
				var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {1
		j$("#tm_'.$id.' .rd_testimonials").carouFredSel({
					
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: "#tm_'.$id.'_left",
					next: "#tm_'.$id.'_right",
					pagination: "#tm_'.$id.'_pager",
					height: "variable",
					auto: false,
					items: {
        				height: "variable",
						visible: {
							min: 1,
							max: 1
						}
					}
				});
				});
	</script>';


$output .= '<div class="rd_testimonials_ctn '.$style.' '.$animation.'" id="tm_'.$id.'"><div class="rd_testimonials">'.do_shortcode($content).'</div><div class="tm_nav"><div class="tm_l_nav" id="tm_'.$id.'_left" ></div><div class="tm_r_nav" id="tm_'.$id.'_right" ></div></div><div id="tm_'.$id.'_pager" class="rd_tm_pager"></div></div>';

echo !empty( $output ) ? $output : '';


$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

}


add_shortcode( 'testimonials_ctn', 'testimonials_ctn' );

function testimonial_sc( $atts, $content = null ) {


	$src = get_stylesheet_directory_uri();


	extract(shortcode_atts(array(


		'image'   => '',
		'author' => '',
		'a_info' => '',


    ), $atts));

ob_start();


$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '250'  ) );

$output = '<div class="rd_testimonial">

   <div class="tm_text">'.$content.'</div>
   <div class="tm_author_info">
	<div class="tm_author">'.$author.'</div>

	<div class="tm_info">'.$a_info.'</div>

   
   <div class="tm_image">'.$img['thumbnail'].'</div></div></div>'; 


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 
}


add_shortcode('testimonial_sc', 'testimonial_sc');



?>