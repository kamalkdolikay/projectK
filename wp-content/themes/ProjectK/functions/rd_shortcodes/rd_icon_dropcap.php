<?php 


/*-----------------------------------------------------------------------------------*/



/*	Icons drop cap



/*-----------------------------------------------------------------------------------*/
function rd_icondropcap( $atts, $content = null ) {
	$src = get_stylesheet_directory_uri();
	extract(shortcode_atts(array(
		'icon'	=> 'cog',

		'style'	=> 'b',

		'color' => ''
    ), $atts));
if($style == 'b'){

	return '<span class="dropcap '.$style.'" style="background-color:'.$color.';" ><i class="fa-'.$icon.'" style="font-size:16px;" ></i></span>';

}

else{	return '<span class="dropcap '.$style.'" ><i class="fa-'.$icon.'" style="color:'.$color.'; font-size:15px;" ></i></span>';

}

}
add_shortcode('icondropcap', 'rd_icondropcap');

?>