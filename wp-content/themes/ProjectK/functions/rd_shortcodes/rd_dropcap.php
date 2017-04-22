<?php 


/*-----------------------------------------------------------------------------------*/



/*	Drop cap



/*-----------------------------------------------------------------------------------*/
function rd_dropcap( $atts, $content = null ) {
	$src = get_stylesheet_directory_uri();
	extract(shortcode_atts(array(
		'style'	=> 'dc_rounded',

		'color' => ''
    ), $atts));
	

if($style == 'dc_rounded'){

   return '<span class="dropcap '.$style.'" style="background-color:'.$color.';" >'. do_shortcode($content) .'</span><p>';

}
if($style == 'dc_rectangle'){

   return '<span class="dropcap '.$style.'" style="background-color:'.$color.';" >'. do_shortcode($content) .'</span><p>';

}
if($style == 'dc_squared'){

   return '<span class="dropcap '.$style.'" style="background-color:'.$color.';" >'. do_shortcode($content) .'</span><p>';

}

else{

   return '<span class="dropcap '.$style.'" style="color:'.$color.';" >'. do_shortcode($content) .'</span><p>';	}

}

add_shortcode('dropcap', 'rd_dropcap');

?>