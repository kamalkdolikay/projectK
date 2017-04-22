<?php 


/*-----------------------------------------------------------------------------------*/



/*  Accordion shortcode



/*-----------------------------------------------------------------------------------*/


function accordian_open_tag( $atts, $content='' ) {
  return '<div class="accordion">'.do_shortcode($content).'</div>';
}


function accordian_section( $atts, $content= null ) {
	$defaults = array( 'title' => 'Section' );
		extract( shortcode_atts( $defaults, $atts ) );
		  return '<div class="toggle"><a href="#">'.$title .'</a></div>' . 
         '<div class="toggle-content">'.$content.'</div>';
}

add_shortcode( 'accordions', 'accordian_open_tag' );
add_shortcode( 'accordion', 'accordian_section' );



?>