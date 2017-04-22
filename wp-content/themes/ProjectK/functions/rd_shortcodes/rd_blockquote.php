<?php 

/*-----------------------------------------------------------------------------------*/



/*  Blockquote shortcode



/*-----------------------------------------------------------------------------------*/

function blockquote( $atts, $content = null ) {

	extract(shortcode_atts(array(

		'author_name'   => '',

    ), $atts));

   return '
<blockquote>

'. do_shortcode($content) . '

</blockquote>


';


}


add_shortcode('blockquote', 'blockquote');



?>