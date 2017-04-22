<?php 



/*-----------------------------------------------------------------------------------*/



/*	Promo text Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_cta( $atts, $content = null ) {

	extract(shortcode_atts(array(

		'style'   => '',
		'title'   => '',
		'title_color'   => '',
		'text_color'   => '',
		'bg_color'   => '',
		'border_color'   => '',
		'left_border_color'   => '',
		'button_text'   => '',
		'button_link'   => '',
		'button_color'   => '',
		'button_bg_color'   => '',
		'button_hover_color'   => '',
		'icon'   => '',
		'icon_color'   => '',
		'icon_bg_color'   => '',
		'icon_size'   => '',
		'animation'   => '',

'margin_top'   => '0',

'margin_bottom'   => '0'

    ), $atts));

ob_start();
$id = RandomString(20);		

$output ='<style>#promo_'.$id.' {margin:'.$margin_top.'px 0 '.$margin_bottom.'px 0;}</style>';



if($style == 'rd_cta_1') {

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
            #promo_".$id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #promo_".$id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";


	$output .= $ret;	
	
	$output .='<style>#promo_'.$id.' {color:'.$text_color.'; background:'.$bg_color.'; border:1px solid '.$border_color.';}#promo_'.$id.' .promo_title{color:'.$title_color.';}#promo_'.$id.' .promo_btn{color:'.$button_color.'; background:'.$button_bg_color.';}#promo_'.$id.' .promo_btn:hover{background:'.$button_hover_color.';}#promo_'.$id.' i{color:'.$icon_color.'; background:'.$icon_bg_color.'; font-size:'.$icon_size.'px;}</style>';



   $output .='<div id="promo_'.$id.'" class="rd_promo_box '.$style.' '.$animation.'">';
   $output .='<i class="'.$icon.'"></i>';
   $output .='<div class="promo_text"><h2 class="promo_title">'.$title.'</h2><p class="cta_mt">'.$content. '<p></div>';
   $output .='<a class="promo_btn" href="'.$button_link.'" target="_blank" >'.$button_text.'</a></div>';
   
}


if($style == 'rd_cta_2') {


	
	$output .='<style>#promo_'.$id.' {color:'.$text_color.'; background:'.$bg_color.'; border:1px solid '.$border_color.';}#promo_'.$id.' .promo_text{border-left:10px solid '.$left_border_color.'; }#promo_'.$id.' .promo_title{color:'.$title_color.';}#promo_'.$id.' .promo_btn{color:'.$button_color.'; background:'.$button_bg_color.';}#promo_'.$id.' .promo_btn:hover{background:'.$button_hover_color.';}</style>';



   $output .='<div id="promo_'.$id.'" class="rd_promo_box '.$style.' '.$animation.'">';
   $output .='<div class="promo_text"><div class="promo_text_ctn"><h2 class="promo_title">'.$title.'</h2><p class="cta_mt">'.$content. '<p></div>';
   $output .='<a class="promo_btn" href="'.$button_link.'" target="_blank" >'.$button_text.'</a></div></div>';
   
}


if($style == 'rd_cta_3') {


	
	$output .='<style>#promo_'.$id.' {color:'.$text_color.'; background:'.$bg_color.';}#promo_'.$id.' .promo_text{border:5px solid '.$border_color.'; }#promo_'.$id.' .promo_title{color:'.$title_color.';}</style>';



   $output .='<div id="promo_'.$id.'" class="rd_promo_box '.$style.' '.$animation.'">';
   $output .='<div class="promo_text"><h2 class="promo_title">'.$title.'</h2><p class="cta_mt">'.$content. '<p></div>';
   $output .='</div>';
   
}


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}


add_shortcode('rd_cta', 'rd_cta');




?>