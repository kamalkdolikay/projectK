<?php 



/*-----------------------------------------------------------------------------------*/



/*	Profile Testimonials Shortcodes



/*-----------------------------------------------------------------------------------*/


function profile_testimonial_sc( $atts, $content = null ) {



	extract(shortcode_atts(array(


		'bg'   => '',
		'image'   => '',
		'author' => '',
		'quote' => '',
		'hl_color' => '',
		'animation' => '',


    ), $atts));

ob_start();

	global $rd_data;
$id = RandomString(20);
if($hl_color == ''){
$hl_color = $rd_data['rd_content_hl_color'];
}


$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '400x400'  ) );


$bg_id = preg_replace( '/[^\d]/', '', $bg );
$bg_img = wp_get_attachment_image_src( $bg_id, 'staff_tn'  );


$output = '<style>#rd_'.$id.' {background:url('.$bg_img[0].');}#rd_'.$id.' .tm_quote:before{background:'.$hl_color.';}</style><div id="rd_'.$id.'" class="rd_profile_testimonial '.$animation.'">

<div class="tm_logo">'.$img['thumbnail'].'
<div class="tm_quote">'.$quote.'</div>
<div class="tm_author">'.$author.'</div></div>
</div>'; 


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 
}


add_shortcode('profile_testimonial_sc', 'profile_testimonial_sc');



?>