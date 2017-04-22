<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'type'   => '',
	'el_id' => '',
    'parallax_background'   => '',
    'parallax_type'   => '',
    'video_background'   => '',
    'video_link'   => '',
    'overlay'   => '',
    'overlay_color'   => '',
    'i_select'   => '',
	'icon'   => '',
    'i_bg_color'   => '',
    'i_color'   => '',
    'a_select'   => '',
	'a_bg_color'   => '',
    'css' => ''
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$row_id = RandomString(20);

if ( ! empty( $atts['i_select'] ) ) {
            // Don't load the CSS files to trim loading time, include the specific styles via PHP
            // wp_enqueue_style( '4k-icon-' . $cssFile, plugins_url( 'icons/css/' . $cssFile . '.css', __FILE__ ) );
			$cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );
			wp_enqueue_style( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/css/icon-styles.css' , null, VERSION_GAMBIT_VC_4K_ICONS );
			wp_enqueue_script( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/js/script-ck.js', array( 'jquery' ), VERSION_GAMBIT_VC_4K_ICONS, true );
		
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
            #row_".$row_id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #row_".$row_id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
            #row_".$row_id."{ background:" . $atts['i_bg_color'] . "; }#row_".$row_id." i{ background:" . $atts['i_color'] . "; }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";
	
		
		}

		

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

$output .= '<div ';

$output .= isset( $el_id ) && ! empty( $el_id ) ? " id='" . esc_attr( $el_id ) . "'" : ""; 
$output .= 'class="'.$css_class.' '.$type.' ';
if ($video_background == true){
$output .= ' rd_video_ctn '; 	
}
if ($parallax_background == true){
$output .= ' rd_parallax_section '; 	
}
$output .= '"'.$style.'>';

$output .= wpb_js_remove_wpautop($content);
if ( $i_select !== '' ){
$output .= $ret;	
$output .= '<div class="row_top_icon" id="row_'.$row_id.'"><i class="'.$icon.'"></i></div>';
}
if ( $a_select !== '' ){
$arr = "<style>#row_".$row_id.".row_bottom_arrow{ background:" . $atts['a_bg_color'] . "; }</style>";
$arr = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $arr ) ) )
			. "\n";
$output .= $arr;	
$output .= '<div class="row_bottom_arrow" id="row_'.$row_id.'"></div>';
}
if ($video_background == true){
$output .= '<video class="parallax_video" preload="auto" autoplay="true" loop="loop" muted="muted" data-top-default="0"><source src="'.$video_link.'" "></video>';
}
if ($parallax_background == true){
	if($parallax_type == 'cover'){
		$output .= '<div class="parallax_wrap" id="rd_'.$row_id.'_parallaxid"><div class="parallax_bg"></div></div>';
	}else{
		$output .= '<div class="parallax_wrap" id="rd_'.$row_id.'_parallaxid"><div class="parallax_bg parallax_fixed"></div></div>';		
	}
}
if ($overlay == true){
$output .= '<div class="rd_row_overlay" style="background:'.$overlay_color.';"></div>';
}
$output .= '</div>'.$this->endBlockComment('row');

echo !empty( $output ) ? $output : '';