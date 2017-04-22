<?php 



/*-----------------------------------------------------------------------------------*/



/*	Tooltip Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_tooltip( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'tip_text'   => 'Text that will appear in tooltip',



    ), $atts));
	
   return '<span class="tiptip" title="'.$tip_text.'">'. do_shortcode($content) .'</span>';

}


add_shortcode('tooltip_sc', 'rd_tooltip');




?>