<?php 



/*-----------------------------------------------------------------------------------*/



/*	Promo text Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_lt( $atts, $content = null ) {

	extract(shortcode_atts(array(

		'sub_text'   => 'Sub Text',

'margin_top'   => '0',

'margin_bottom'   => '0'

    ), $atts));

   return '  <div class="lt_box" style="margin:'.$margin_top.'px 0 '.$margin_bottom.'px 0;">

<div class="lt_text">

'. do_shortcode($content) . '

</div>

<div class="lt_sub_text">

'.$sub_text.'

</div>

</div>';


}


add_shortcode('lt', 'rd_lt');




?>