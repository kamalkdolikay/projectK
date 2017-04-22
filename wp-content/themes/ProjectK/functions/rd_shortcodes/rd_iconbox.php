<?php 


/*-----------------------------------------------------------------------------------*/



/*	Icons Box



/*-----------------------------------------------------------------------------------*/
function rd_iconbox( $atts, $content = null ) {
	
	global $rd_data;
	$box_id = RandomString(20);
	
	extract(shortcode_atts(array(

		'title'   => 'Title',

		't_color' => '',

		'target' => '',

		'i_color' => '',
		
		'i_bg_color' => '',
		
		'i_b_color' => '',

		'type' => 'top',

		'link' => '#',
		
		'content_color' => '',	

		'icon'	=> 'cog',
						
		'button_text' => '',
		
		'button_color' => '',
		
		'change_hover' => '',
		
		'hover_i_color' => '',
		
		'hover_i_bg_color' => '',
		
		'hover_i_b_color' => '',
		
		'hover_t_color' => '',
		
		'hover_text_color' => '',
		
		'hover_button_color' => '',
		'mt' => '',
		
		'mb' => '',
		'animation' => '',

    ), $atts));


if($t_color == '' ){ $t_color = $rd_data['rd_content_heading_color'];}
if($i_color == '' ){ $i_color = $rd_data['rd_content_hl_color'];}
if($content_color == '' ){ $content_color = $rd_data['rd_content_text_color'];}


$output ='<style>#rand_'.$box_id.' {margin-top:'.$mt.'px; margin-bottom:'.$mb.'px; }</style>';

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
            #rand_".$box_id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #rand_".$box_id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";

///////// TYPE 1 Icon only

if($type == '10'){
	
	$output .= $ret;
	
if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{color:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
}
	$output .= '<div id="rand_'.$box_id.'" class="icon_box_si '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="color:'.$i_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;


}

///////// TYPE 11 Medium Icon only

if($type == '11'){
	
	$output .= $ret;
	
if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{color:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
}
	$output .= '<div id="rand_'.$box_id.'" class="icon_box '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="color:'.$i_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 class="mi_heading" style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;


}


///////// TYPE 1 Icon only

if($type == '1'){
	
	$output .= $ret;
	
if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{color:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
}
	$output .= '<div id="rand_'.$box_id.'" class="icon_box '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="color:'.$i_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;


}
///////// TYPE 2 Rounded Icon

elseif($type == '2'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_rounded '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="background:'.$i_color.'; color:#fff;"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}

///////// TYPE 13 Rounded Icon

elseif($type == '13'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{background:'.$hover_i_color.'!important; border-color:'.$hover_i_color.'!important; color:#fff!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_rounded_trend '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="background:'.$i_bg_color.'; color:'.$i_color.'; border:1px solid '.$i_b_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}


///////// TYPE 3 Hexagon Icon

elseif($type == '3'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover .ib_hexagon{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover .ib_hexagon:before{border-bottom-color:'.$hover_i_color.';}#rand_'.$box_id.':hover .ib_hexagon:after{border-top-color:'.$hover_i_color.';}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_hex '.$animation.'">';
	$output .= '<style>#rand_'.$box_id.' .ib_hexagon{background:'.$i_color.'; }.ib_hexagon:before{border-bottom-color:'.$i_color.';}.ib_hexagon:after{border-top-color:'.$i_color.';}</style>';
	$output .= '<div class="ib_hexagon"><i class="'.$icon.'" style="color:#fff;"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.';" href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}


///////// TYPE 4 square Icon

elseif($type == '4'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover .ib_square{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{background:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_square '.$animation.'">';
	$output .= '<style>#rand_'.$box_id.' .ib_square{background:'.$i_color.'; }</style>';
	$output .= '<div class="ib_square"><i class="'.$icon.'" style="color:#fff;"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="background:'.$button_color.'; color:#fff;" href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}


///////// TYPE 5 Big Rounded Icon

elseif($type == '5'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_bigrounded '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="background:'.$i_color.'; color:#fff;"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}

///////// TYPE 6 big square Icon

elseif($type == '6'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover .ib_bigsquare{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{background:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_bigsquare '.$animation.'">';
	$output .= '<style>#rand_'.$box_id.' .ib_bigsquare{background:'.$i_color.'; }</style>';
	$output .= '<div class="ib_bigsquare"><i class="'.$icon.'" style="color:#fff;"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="background:'.$button_color.'; color:#fff;" href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}



///////// TYPE 7 medium square Icon

elseif($type == '7'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover .ib_medsquare{background:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_medsquare '.$animation.'">';
	$output .= '<style>#rand_'.$box_id.' .ib_medsquare{background:'.$i_color.'; }</style>';
	$output .= '<div class="ib_medsquare"><i class="'.$icon.'" style="color:#fff;"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.';" href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}

///////// TYPE 8 square partern

elseif($type == '8'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover .ib_squareptn{background-color:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_squareptn '.$animation.'">';
	$output .= '<style>#rand_'.$box_id.' .ib_squareptn{background-color:'.$i_color.'; }</style>';
	$output .= '<div class="ib_squareptn"><i class="'.$icon.'" style="color:#fff;"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.';" href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}
///////// TYPE 9 Rounded stroke

elseif($type == '9'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{border-color:'.$hover_i_color.'!important; color:'.$hover_i_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_rounded_stroke '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="border:2px solid '.$i_color.'; color:'.$i_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}

///////// TYPE 12 Big Rounded stroke

elseif($type == '12'){

	$output .= $ret;
	
	if($change_hover !== ''){
	
		if($hover_t_color == '' ){ $hover_t_color = $rd_data['rd_content_hl_color'];}
		
		if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
				
		if($hover_text_color == '' ){ $hover_boxbg_color = '';}

		if($hover_button_color == '' ){ $hover_button_color = '#2d3e50';}

	$output .= '<style>#rand_'.$box_id.':hover i{border-color:'.$hover_i_color.'!important; background:'.$hover_i_color.'!important; color:#ffffff!important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.'!important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_box_button{color:'.$hover_button_color.'!important;}</style>';

	
	}

	$output .= '<div id="rand_'.$box_id.'" class="icon_box_big_rounded_stroke '.$animation.'">';
	$output .= '<i class="'.$icon.'" style="border:1px solid '.$i_color.'; color:'.$i_color.';"></i><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="color:'.$content_color.'">'. do_shortcode($content) .'</p>';


if($button_text !== ''){
	$output .= '<a class="icon_box_button" style="color:'.$button_color.'"; href="'.$link.'" target="'.$target.'" >'.$button_text.'</a>';
}
	$output .= '</div>';

	return $output;
}



}


add_shortcode('iconbox', 'rd_iconbox');

?>