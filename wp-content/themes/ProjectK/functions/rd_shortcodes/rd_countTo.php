<?php 

/*-----------------------------------------------------------------------------------*/


/* Count to


/*-----------------------------------------------------------------------------------*/

function count_sc($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'use_icon' => '',

		'icon' => '',
		
		'i_color' => '',
		'i_bg_color' => '',
		'i_bg_alt_color' => '',
		'bb_color' => '',
		'bbg_color' => '',
		
		'heading_color' => '',
		'h_heading_color' => '',
		
		'type' => '',
		
		'number' => '250',
		
		'number_color' => '',
		'line_color' => '',

		'h_number_color' => '',
		'h_bg' => '',

		'decimals' => '0',
	
		'speed' => '1000',
		'animation' => '',
    ), $atts));


$c_id = RandomString(20);
$output = '';


//// Type 1

if($type == ''){
		
	$output .='<div class="rd_count_to  '.$animation.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}
//// Type 9

if($type == '9'){
	
	$output .='<div class="rd_count_to count_style_9  '.$animation.'"  id="rand_'.$c_id.'" ><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}	

//// Type 7

if($type == '7'){
		
	$output .='<div class="rd_count_to rd_ct_bt  '.$animation.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}
//// Type 2

if($type == '2'){

if(strpos($h_bg, '#') === 0){


$bs = rd_hex_to_rgb_array($h_bg); 

$output .='<style>#rand_'.$c_id.':hover {background:'.$h_bg.'; box-shadow:0 0 0 15px rgba('.$bs[0].','.$bs[1].','.$bs[2].',0.7); border-color:'.$h_bg.';}#rand_'.$c_id.':hover .count_number{color:'.$h_number_color.' !important; }#rand_'.$c_id.':hover .count_title{color:'.$h_heading_color.' !important; }</style>';
	
}else{


$output .='<style>#rand_'.$c_id.':hover {background:'.$h_bg.'; box-shadow:0 0 0 15px '.$h_bg.'; border-color:'.$h_bg.';}#rand_'.$c_id.':hover .count_number{color:'.$h_number_color.' !important; }#rand_'.$c_id.':hover .count_title{color:'.$h_heading_color.' !important; }</style>';		
		
}


		
	$output .='<div class="rd_count_to count_style_2  '.$animation.'" id="rand_'.$c_id.'"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'"></div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}


		// Enqueue the CSS
		if ( ! empty( $atts['icon'] ) ) {
            // Don't load the CSS files to trim loading time, include the specific styles via PHP
            // wp_enqueue_style( '4k-icon-' . $cssFile, plugins_url( 'icons/css/' . $cssFile . '.css', __FILE__ ) );
			$cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );
			wp_enqueue_style( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/css/icon-styles.css' , null, VERSION_GAMBIT_VC_4K_ICONS );
			wp_enqueue_script( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/js/script-ck.js', array( 'jquery' ), VERSION_GAMBIT_VC_4K_ICONS, true );
		}
  global $iconContents;

        include('icon-contents.php' );

		// Normal styles used for everything
        $cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );

        $iconFile =  RD_DIRECTORY . '/includes/4k-icons/icons/fonts/' . $cssFile;
		$iconFile = apply_filters( '4k_icon_font_pack_path', $iconFile, $cssFile );

		// Fix ligature icons (these are icons that use more than 1 symbol e.g. mono social icons)
		$ligatureStyle = '';
        if ( $cssFile == 'mn' ) {
            $ligatureStyle = '-webkit-font-feature-settings:"liga","dlig";-moz-font-feature-settings:"liga=1, dlig=1";-moz-font-feature-settings:"liga","dlig";-ms-font-feature-settings:"liga","dlig";-o-font-feature-settings:"liga","dlig";
                         	 font-feature-settings:"liga","dlig";
                        	 text-rendering:optimizeLegibility;';
        }

		$iconCode = '';
		if ( ! empty( $atts['icon'] ) ) {
			$iconCode = $iconContents[ $atts['icon'] ];
		}

		$ret = "<style>
            @font-face {
            	font-family: '" . $cssFile . "';
            	src:url('" . $iconFile . ".eot');
            	src:url('" . $iconFile . ".eot?#iefix') format('embedded-opentype'),
            		url('" . $iconFile . ".woff') format('woff'),
            		url('" . $iconFile . ".ttf') format('truetype'),
            		url('" . $iconFile . ".svg#oi') format('svg');
            	font-weight: normal;
            	font-style: normal;
            }
            #rand_".$c_id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #rand_".$c_id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";


//// Type 3

if($type == '3'){
	
		$output .= $ret;
		
	$output .='<style>#rand_'.$c_id.' .count_icon_circle{background:'.$i_color.';}#rand_'.$c_id.' .count_number:after{background:'.$i_color.';}</style>';	
	$output .='<div class="rd_count_to count_style_3  '.$animation.'"  id="rand_'.$c_id.'" ><div class="count_icon_circle" ><i class="'.$icon.'"></i></div><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}	



//// Type 4

if($type == '4'){
	$output .= '<div class="rd_count_wrap  '.$animation.'">';
	if($icon !== ''){
		
		$output .= $ret;
		$output .= '<div class="count_bigicon_circle" id="rand_'.$c_id.'" style="border:2px solid '.$i_color.'"><div class="count_bigsub_circle" style="background:'.$i_color.'"></div><i class="'.$icon.'" style="background:'.$i_color.'"></i></div>';
		
	}
		
	$output .='<div class="rd_count_to count_style_3"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div></div>';

	
return  $output;

}

//// Type 5

if($type == '5'){
	$output .= '<div class="rd_count_wrap big_text  '.$animation.'">';
	if($icon !== ''){
		
		$output .= $ret;
		$output .= '<div class="count_bigicon_circle" id="rand_'.$c_id.'" style="border:2px solid '.$i_color.'"><div class="count_bigsub_circle" style="background:'.$i_color.'"></div><i class="'.$icon.'" style="background:'.$i_color.'"></i></div>';
		
	}
		
	$output .='<div class="rd_count_to count_style_3"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div></div>';

	
return  $output;

}		
		


//// Type 6

if($type == '6'){
	
	global $rd_data;
if(	$bbg_color == '' ){
	
	$bbg_color = $rd_data['rd_content_bg_color'];
}
if(	$bb_color == '' ){
	
	$bb_color = $rd_data['rd_content_border_color'];
}
	
	
$output .= '<style>#rand_'.$c_id.' { background:'.$bbg_color.'; border: 1px solid '.$bb_color.'; box-shadow: 0 0px 0px rgba(255, 255, 255, 0), 0 7px 0 -1px '.$bbg_color.', 0 0px 0px 0px '.$bbg_color.',0 0px 0px '.$bbg_color.', 0 7px 0 0px '.$bb_color.';}</style>';

	$output .= '<div class="rd_count_box  '.$animation.'" id="rand_'.$c_id.'">';




	if($icon !== ''){
		
		$output .= $ret;
		$output .= '<div class="count_box_circle"  style="border:2px solid '.$i_color.'"><i class="'.$icon.'"></i></div>';
		
	}
		
	$output .='<div class="rd_count_to"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div></div>';

	
return  $output;

}



//// Type 8

if($type == '8'){
	
		$output .= $ret;
		
	$output .='<style>#rand_'.$c_id.' .count_icon_circle{color:'.$i_color.'; background:'.$i_bg_color.';}#rand_'.$c_id.' .count_icon_circle:before{ background:'.$i_bg_color.';}#rand_'.$c_id.' .count_number:after{background:'.$line_color.';}</style>';	
	$output .='<div class="rd_count_to count_style_8  '.$animation.'"  id="rand_'.$c_id.'" ><div class="count_icon_circle" ><i class="'.$icon.'"></i></div><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div>';

	
return  $output;

}	



//// Type 10

if($type == '10'){
	$output .= '<div class="rd_count_wrap '.$animation.'" id="rand_'.$c_id.'" >';
	if($icon !== ''){
		
		$output .= $ret;
		$output .= '<style>#rand_'.$c_id.' .count_stroke_circle{border:1px solid '.$number_color.'; color:'.$number_color.';}#rand_'.$c_id.':hover .count_stroke_circle{border:1px solid '.$i_color.'; }#rand_'.$c_id.':hover .count_stroke_circle i{color:#fff;}</style>';
		$output .= '<div class="count_stroke_circle" ><div class="count_bigsub_circle" style="background:'.$i_color.'"></div><i class="'.$icon.'"></i></div>';
		
	}
		
	$output .='<div class="rd_count_to count_style_10"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div></div>';

	
return  $output;

}
		

//// Type 11

if($type == '11'){
	$output .= '<div class="rd_count_wrap '.$animation.'" id="rand_'.$c_id.'" >';
	if($icon !== ''){
		
		$output .= $ret;
		$output .= '<style>#rand_'.$c_id.' .count_gradient_circle .count_gradient_bg,#rand_'.$c_id.' .count_gradient_circle i{ background: '.$i_bg_color.'; background: -moz-linear-gradient(-45deg,  '.$i_bg_color.' 0%, '.$i_bg_alt_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$i_bg_color.'), color-stop(100%,'.$i_bg_alt_color.')); background: -webkit-linear-gradient(-45deg,  '.$i_bg_color.' 0%,'.$i_bg_alt_color.' 100%); background: -o-linear-gradient(-45deg,  '.$i_bg_color.' 0%,'.$i_bg_alt_color.' 100%); background: -ms-linear-gradient(-45deg,  '.$i_bg_color.' 0%,'.$i_bg_alt_color.' 100%); background: linear-gradient(135deg,  '.$i_bg_color.' 0%,'.$i_bg_alt_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$i_bg_color.'", endColorstr="'.$i_bg_alt_color.'",GradientType=1 );}#rand_'.$c_id.' .count_gradient_circle i{border-color:'.$i_color.'; color:'.$i_color.';}#rand_'.$c_id.' .count_number:after{background:'.$heading_color.';}</style>';
		$output .= '<div class="count_gradient_circle" ><div class="count_gradient_bg"></div><i class="'.$icon.'"></i></div>';
		
	}
		
	$output .='<div class="rd_count_to count_style_11"><div class="count_number" data-from="0" data-to="'.$number.'" data-speed="'.$speed.'" data-refresh-interval="25" data-decimals="'.$decimals.'" style="color:'.$number_color.'">0</div><span class="count_title" style="color:'.$heading_color.'">'.$content.'</span></div></div>';

	
return  $output;

}
		
		

}

add_shortcode("count_sc", "count_sc");




?>