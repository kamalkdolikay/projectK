<?php 



/*-----------------------------------------------------------------------------------*/



/* Lines Shortcodes



/*-----------------------------------------------------------------------------------*/
function rd_line($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'type'   => 'normal',
		'pos'   => 'small_l_centered',
		'color'   => '',
		'alt_color'   => '',
		'icon'   => '',
		'icon_size'   => '',
		'icon_color'   => '',
		'icon_pos'   => '',
		'line_pos'   => '',
		'width' => '',
		'margin_top' => '0',
		'margin_bottom' => '0',
    ), $atts));
	

ob_start();

$id = RandomString(20);		

	
$output ='<style>';


if($width !== ""){

$output .='#l_'.$id.'{width:'.$width.'px;}';	
	
}
if($type == "rd_line_normal"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:1px solid '.$color.';}';

}if($type == "rd_line_double"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:1px solid '.$color.'; border-bottom:1px solid '.$color.'; height:4px;}';

}if($type == "rd_line_dashed"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:1px dashed '.$color.';}';

}if($type == "rd_line_d_dashed"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:1px dashed '.$color.'; border-bottom:1px dashed '.$color.'; height:5px;}';

}if($type == "rd_line_l_dashed"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:2px dashed '.$color.';}';

}if($type == "rd_line_bold"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:3px solid '.$color.';}';

}
if($type == "rd_line_bcolor"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line {border-top:2px solid '.$color.';}#l_'.$id.' .rd_colored_line {position:absolute; top:-2px; left:0px; height:2px; width:25%; background:'.$alt_color.' ;}';

}
if($line_pos == "right"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line{margin-left:auto!important;}';

}elseif($line_pos == "center"){

$output .='#l_'.$id.'.sc_line ,#l_'.$id.' .sc_line{margin-left:auto!important; margin-right:auto!important;}';

}


$output .='#l_'.$id.' {margin:'.$margin_top.'px 0 '.$margin_bottom.'px 0; padding:0;}</style>';	
	
if ($icon == '' ){

if($type !== "rd_line_bcolor" && $icon == ''){

	$output .='<div class="clearfix"></div><div id="l_'.$id.'"  class="sc_line '.$type.'" ></div>';

}elseif($type == "rd_line_bcolor" && $icon == ''){

	$output .= '<div class="clearfix"></div><div id="l_'.$id.'"  class="sc_line '.$type.'" ><span class="rd_colored_line"></span></div>';	

}


}else{



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
            #l_".$id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #l_".$id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";


	$output .= $ret;




if($type !== "rd_line_bcolor" && $icon !== '' && $icon_pos == 'left'){

$ctn_size = $icon_size+5;
$top_m = $icon_size/2;
$left_m = $icon_size+10;

$output .='<style>#l_'.$id.'.rd_icon_line_l{height:'.$ctn_size.'px;}#l_'.$id.'.rd_icon_line_l i{line-height:'.$icon_size.'px; width:'.$icon_size.'px ; font-size:'.$icon_size.'px; color:'.$icon_color.' ; }#l_'.$id.' .sc_line{margin:'.$top_m.'px 0 0 '.$left_m.'px;}</style>';


	$output .='<div class="clearfix"></div><div id="l_'.$id.'"  class="rd_icon_line_l"><i class="'.$icon.'"></i><div class="sc_line '.$type.'" ></div></div>';

}

if($type !== "rd_line_bcolor" && $icon !== '' && $icon_pos == 'right'){

$ctn_size = $icon_size+5;
$top_m = $icon_size/2;
$right_m = $icon_size+10;

$output .='<style>#l_'.$id.'.rd_icon_line_r{height:'.$ctn_size.'px;}#l_'.$id.'.rd_icon_line_r i{line-height:'.$icon_size.'px; width:'.$icon_size.'px ; font-size:'.$icon_size.'px; color:'.$icon_color.' ; }#l_'.$id.' .sc_line{margin:'.$top_m.'px '.$right_m.'px 0 0;}</style>';


	$output .='<div class="clearfix"></div><div id="l_'.$id.'"  class="rd_icon_line_r"><i class="'.$icon.'"></i><div class="sc_line '.$type.'" ></div></div>';

}


if($type !== "rd_line_bcolor" && $icon !== '' && $icon_pos == 'center'){

$ctn_size = $icon_size+5;
$top_m = $icon_size/2;
$m = $top_m +10;

$output .='<style>#l_'.$id.'.rd_icon_line_c{height:'.$ctn_size.'px;}#l_'.$id.'.rd_icon_line_c i{line-height:'.$icon_size.'px; width:'.$icon_size.'px ; font-size:'.$icon_size.'px; color:'.$icon_color.' ; margin-left:-'.$top_m.'px;}#l_'.$id.' .sc_line_l{float:left; margin:'.$top_m.'px 0 0 0; width: -moz-calc(50% - '.$m.'px); width: -webkit-calc(50% - '.$m.'px); width: -o-calc(50% - '.$m.'px); width: calc(50% - '.$m.'px);}#l_'.$id.' .sc_line_r{float:right; margin:'.$top_m.'px 0 0 0; width: -moz-calc(50% - '.$m.'px); width: -webkit-calc(50% - '.$m.'px); width: -o-calc(50% - '.$m.'px); width: calc(50% - '.$m.'px);}</style>';


	$output .='<div class="clearfix"></div><div id="l_'.$id.'"  class="rd_icon_line_c"><i class="'.$icon.'"></i><div class="sc_line_l sc_line '.$type.'" ></div><div class="sc_line sc_line_r '.$type.'" ></div></div>';

}



}


echo !empty( $output ) ? $output : '';	


$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}

add_shortcode("rd_line", "rd_line");



/*-----------------------------------------------------------------------------------*/



/* Vertical Lines Shortcodes



/*-----------------------------------------------------------------------------------*/


function rd_vline($atts, $content = null) {  
    extract(shortcode_atts(array( 
		'color'   => '',
		'height'   => '',
		'margin_top' => '0',
		'margin_bottom' => '0',
    ), $atts));
	

ob_start();

$id = RandomString(20);		

	
$output ='<style>';
$output .='#l_'.$id.'.sc_vline {background:'.$color.'; min-height:'.$height.'px; width:2px;}';
$output .='#l_'.$id.'{margin:'.$margin_top.'px auto '.$margin_bottom.'px auto; padding:0;}</style>';	
$output .='<div class="clearfix"></div><div id="l_'.$id.'"  class="sc_vline" ></div>';



echo !empty( $output ) ? $output : '';	


$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}

add_shortcode("rd_vline", "rd_vline");


?>