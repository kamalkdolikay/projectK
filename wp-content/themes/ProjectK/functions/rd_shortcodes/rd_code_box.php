<?php 


/*-----------------------------------------------------------------------------------*/



/*	Drop cap



/*-----------------------------------------------------------------------------------*/
function rd_code_box( $atts, $content = null ) {
	$src = get_stylesheet_directory_uri();
	extract(shortcode_atts(array(	
		'margin_top'   => '',
		'margin_bottom' => '',
		'animation' => '',

    ), $atts));
	

   return '<div class="code_box_ctn '.$animation.'" style="margin:'.$margin_top.'px 0 '.$margin_bottom.'px 0">'.do_shortcode($content).'</div>';
}

add_shortcode('rd_code_box', 'rd_code_box');

?>