<?php 



/*-----------------------------------------------------------------------------------*/



/*	Buttons Shortcodes



/*-----------------------------------------------------------------------------------*/
function rd_button( $atts, $content = null ) {

	extract(shortcode_atts(array(

		'type'     	 => 'rd_normal_bt',
		'size'	=> '',		
		'use_icon'     => '',			
		'icon'     => '',			
		'icon_color'     => '',			
		'icon_position'     => 'left',			
		'icon_type'     => '',	
		't_color'   => '',		
		'b_color'   => '',	
		't_hover_color'   => '',		
		'b_hover_color'   => '',	
		'alt_b_color'   => '',
		'radius'   => '0',
		'border_size'   => '0',
		'font_weight'   => '900',
		'url'     	 => '#',
		'target'     => '',		
		'position'   => '',
		'mt'     => '',
		'mb'   => '',
		'ml'     => '',
		'mr'   => '',
		'animation'   => '',

    ), $atts));
	

$button_rand_class = RandomString(20);	
	
if( $use_icon == 'no'){
	
if( $type == 'rd_normal_bt' && $alt_b_color !== '' ){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background: '.$b_color.'; background: -moz-linear-gradient(-45deg,  '.$b_color.' 0%, '.$alt_b_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$b_color.'), color-stop(100%,'.$alt_b_color.')); background: -webkit-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -o-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -ms-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: linear-gradient(135deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$b_color.'", endColorstr="'.$alt_b_color.'",GradientType=1 );  margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}

elseif( $type == 'rd_normal_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}
elseif( $type == 'rd_stroke_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; border-style:solid; border-color:'.$t_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ; border-color:'.$b_hover_color.';}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$border_size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}
elseif( $type == 'rd_3dstroke_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.';border-width:1px; border-style:solid; border-color:'.$t_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ; border-color:'.$b_hover_color.';}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}

	
elseif( $type == 'rd_3d_bt' && $alt_b_color !== ''){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background: '.$b_color.'; background: -moz-linear-gradient(-45deg,  '.$b_color.' 0%, '.$alt_b_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$b_color.'), color-stop(100%,'.$alt_b_color.')); background: -webkit-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -o-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -ms-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: linear-gradient(135deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$b_color.'", endColorstr="'.$alt_b_color.'",GradientType=1 ); margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}

elseif( $type == 'rd_3d_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$animation.'" href="'.$url.'" target="'.$target.'" >' . do_shortcode($content) . '</a></div>';
}



return $output_string;

}


else{
	
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
            #b_".$button_rand_class." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #b_".$button_rand_class." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";


	
	
if( $type == 'rd_normal_bt' && $alt_b_color !== '' ){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background: '.$b_color.'; background: -moz-linear-gradient(-45deg,  '.$b_color.' 0%, '.$alt_b_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$b_color.'), color-stop(100%,'.$alt_b_color.')); background: -webkit-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -o-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -ms-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: linear-gradient(135deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$b_color.'", endColorstr="'.$alt_b_color.'",GradientType=1 );  margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" ><i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}

elseif( $type == 'rd_normal_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" >';
	if($icon_position == 'bt_icon_right'){
		$output_string .= '<span>' . do_shortcode($content) . '</span><i class="'.$icon.'" ></i></a></div>';
	}else{
		$output_string .= '<i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}




}
elseif( $type == 'rd_stroke_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; border-style:solid; border-color:'.$t_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ; border-color:'.$b_hover_color.';}</style>';



$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$border_size.'  '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" >';
	if($icon_position == 'bt_icon_right'){
		$output_string .= '<span>' . do_shortcode($content) . '</span><i class="'.$icon.'" ></i></a></div>';
	}else{
		$output_string .= '<i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}



}
elseif( $type == 'rd_3dstroke_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.';border-width:1px; border-style:solid; border-color:'.$t_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ; border-color:'.$b_hover_color.';}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" >';
	if($icon_position == 'bt_icon_right'){
		$output_string .= '<span>' . do_shortcode($content) . '</span><i class="'.$icon.'" ></i></a></div>';
	}else{
		$output_string .= '<i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}


}

	
elseif( $type == 'rd_3d_bt' && $alt_b_color !== ''){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background: '.$b_color.'; background: -moz-linear-gradient(-45deg,  '.$b_color.' 0%, '.$alt_b_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$b_color.'), color-stop(100%,'.$alt_b_color.')); background: -webkit-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -o-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: -ms-linear-gradient(-45deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); background: linear-gradient(135deg,  '.$b_color.' 0%,'.$alt_b_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$b_color.'", endColorstr="'.$alt_b_color.'",GradientType=1 ); margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" >';
	if($icon_position == 'bt_icon_right'){
		$output_string .= '<span>' . do_shortcode($content) . '</span><i class="'.$icon.'" ></i></a></div>';
	}else{
		$output_string .= '<i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}

}

elseif( $type == 'rd_3d_bt'){

$output_string = '<style>#b_'.$button_rand_class.' a{color:'.$t_color.'; background:'.$b_color.'; margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;  margin-left:'.$ml.'px; margin-right:'.$mr.'px; font-weight:'.$font_weight.'; border-radius:'.$radius.'px;}#b_'.$button_rand_class.' a:hover{color:'.$t_hover_color.' ; background:'.$b_hover_color.' ;}</style>';


$output_string .= '<div class="'.$position.' tf_btn_pos" id="b_'.$button_rand_class.'" ><a class="'.$type.' '.$size.' '.$icon_position.' '.$icon_type.' '.$animation.'" href="'.$url.'" target="'.$target.'" >';
	if($icon_position == 'bt_icon_right'){
		$output_string .= '<span>' . do_shortcode($content) . '</span><i class="'.$icon.'" ></i></a></div>';
	}else{
		$output_string .= '<i class="'.$icon.'" ></i><span>' . do_shortcode($content) . '</span></a></div>';
}

}
if($icon_color !== ''){
$output_string .= '<style>#b_'.$button_rand_class.' i {color:'.$icon_color.';}#b_'.$button_rand_class.' a:hover i{color:'.$t_hover_color.';}</style>';
}
$output_string .= $ret;


return $output_string;
}


}
add_shortcode('button', 'rd_button');

?>