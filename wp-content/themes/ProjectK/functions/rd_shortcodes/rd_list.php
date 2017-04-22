<?php 


/*-----------------------------------------------------------------------------------*/



/* List shortcode



/*-----------------------------------------------------------------------------------*/


add_shortcode( 'rd_lists_ctn', 'rd_lists_ctn' );


function rd_lists_ctn( $atts, $content ){

extract( shortcode_atts( array(
        'style' => '',
        'pos' => '',
	), $atts ) );


$return = "\n".'<!-- lists --><div class="'.$style.' '.$pos.'">'.do_shortcode($content).'</div>

<!-- lists END-->'."\n";




return $return;


}


function rd_list($atts, $content = null) {
	extract( shortcode_atts( array(
        'icon' => '',
        'title' => '',
        'title_color' => '',
        'i_color' => '',
        'link' => '',
        'content_color' => '',
	), $atts ) );
	
	
global $rd_data;


		if($title_color == '' ){ $title_color = $rd_data['rd_content_heading_color'];}
		
		if($i_color == '' ){ $i_color = $rd_data['rd_content_hl_color'];}	

		if($content_color == '' ){ $content_color = $rd_data['rd_content_text_color'];}
		
		
 $b_color = $rd_data['rd_content_border_color'];			

	$list_id = RandomString(20);	
$output = '';	

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
            #rand_".$list_id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #rand_".$list_id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";
	
	$output .= $ret;
	$output .='<style>.rd_list_1 .list_item_ctn { border-color:'.$b_color.'}.rd_list_1 #rand_'.$list_id.' .list_icn i,.rd_list_1_alt #rand_'.$list_id.' .list_icn i{color:'.$i_color.';}.rd_list_2 #rand_'.$list_id.':after{background:'.$content_color.';}.rd_list_2 #rand_'.$list_id.' .list_icn i{color:'.$i_color.';}.rd_list_3 #rand_'.$list_id.' .list_icn,.rd_list_5 #rand_'.$list_id.' .list_icn,.rd_list_6 #rand_'.$list_id.' .list_icn{background:'.$i_color.';}.rd_list_4 #rand_'.$list_id.'{background:'.$i_color.';}#rand_'.$list_id.' h3{color:'.$title_color.';}#rand_'.$list_id.' p{color:'.$content_color.';}.rd_list_7 #rand_'.$list_id.' .list_icn{color:'.$i_color.';}</style>';
	
	
	
		$output .='<div class="list_item_ctn" id="rand_'.$list_id.'">';
		$output .='<div class="list_icn"><i class="'.$icon.'"></i></div>';
if($link !== ''){$output .='<a href="'.$link.'" target="_blank">';}
		$output .='<div class="list_desc">';
if($title !== ''){		$output .='<h3>'.$title.'</h3>'; }
if($content !== ''){	$output .='<p>'.do_shortcode($content).'</p>';  }
if($link !== ''){		$output .='</a>'; }
		$output .='</div></div>';


 return $output;

	}
add_shortcode('rd_list', 'rd_list');





?>