<?php 



/*-----------------------------------------------------------------------------------*/



/*	Highlight Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_highlight( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'bg_color'   => '#21c2f8',
		'text_color'   => '#ffffff',
		'border_color'   => '',


    ), $atts));
	
	if($border_color !== ''){

   return '<span class="rd_highlight_border" style="color:'.$text_color.'; background:'.$bg_color.'; border:1px dashed '.$border_color.';">'. $content .'</span>';

	}else{

   return '<span class="rd_highlight" style="color:'.$text_color.'; background:'.$bg_color.';">'. $content .'</span>';
		
	}
}


add_shortcode('highlight_sc', 'rd_highlight');




?>