<?php 


/*-----------------------------------------------------------------------------------*/



/*	Images carousel Shortcodes



/*-----------------------------------------------------------------------------------*/


function rd_images_gallery( $atts, $content = null ) {


	$src = get_stylesheet_directory_uri();


	extract(shortcode_atts(array(


		'images'   => '',

		'onclick' => '',
		
		'column' => '',
		
		'custom_links' => '',

		'margin_top' => '',

		'margin_bottom' => '',
		
		'animation' => '',
		
		'size' => '',

		
		


    ), $atts));

ob_start();
global $rd_data;

$id = RandomString(20);	


if ($size == ''){
	
	$size = "full";
	
}

$gal_images = '';
$thumb_images = '';
$link_start = '';
$link_end = '';
if ( $images == '' ) $images = '-1,-2,-3';

$pretty_rel_random = ' rel="prettyPhoto[rel-' . rand() . ']"'; //rel-'.rand();

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}
$images = explode( ',', $images );
$i = - 1;

foreach ( $images as $attach_id ) {
	$i ++;
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $size ) );
	}

	$thumbnail = $post_thumbnail['thumbnail'];
	$p_img_large = $post_thumbnail['p_img_large'];
	$link_start = $link_end = '';

	if ( $onclick == 'link_image' ) {
		$link_start = '<a class="prettyphoto '.$column.' '.$animation.'" href="' . $p_img_large[0] . '"' . $pretty_rel_random . '>';
		$link_end = '</a>';
	} else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
		$link_start = '<a class="'.$column.' '.$animation.'" href="' . $custom_links[$i] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>';
		$link_end = '</a>';
	}
	else {
		$link_start = '<div class="'.$column.' '.$animation.'">';
		$link_end = '</div>';
	}
	$gal_images .= $link_start . $thumbnail . $link_end;
}
foreach ( $images as $attach_id ) {
	$i ++;
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => '200*200' ) );
	}

	$thumbnail = $post_thumbnail['thumbnail'];
	$p_img_large = $post_thumbnail['p_img_large'];
	$link_start = $link_end = '';
	$thumb_images .= '<div class="'.$animation.'">'. $thumbnail .'</div>';
}

$output ='';






$output .= '<div class="rd_img_gallery_ctn clearfix" style="margin:'.$margin_top.'px auto '.$margin_bottom.'px;">';

$output .= $gal_images;

$output .= '</div>';



echo !empty( $output ) ? $output : '';


$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

		


}


add_shortcode('rd_images_gallery', 'rd_images_gallery');


?>