<?php 

/*-----------------------------------------------------------------------------------*/



/*  Testimonials shortcode



/*-----------------------------------------------------------------------------------*/


function testimonials( $atts, $content='' ) {
  return '<div class="testimonials-wrapper">'.do_shortcode($content).'<div class="testimonial-next"></div>

				<div class="testimonial-prev"></div></div>';
}
function testimonial( $atts, $content= null ) {
$defaults = array( 'author' => 'Author' , 'authorlink' => '#' );
		extract( shortcode_atts( $defaults, $atts ) );


  return '<div class="testimonial">

		  <div class="testimonial-content">'.$content.'</div>' . 

         '<div class="testimonial-author"><a href="'.$authorlink.'">'.$author .'</a></div></div>';

}
add_shortcode( 'testimonials', 'testimonials' );
add_shortcode( 'testimonial', 'testimonial' );

?>