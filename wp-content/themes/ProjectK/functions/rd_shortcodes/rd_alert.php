<?php 



/*-----------------------------------------------------------------------------------*/



/*	Alerts Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_alert( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'style'   => 'white'


    ), $atts));

   return '<div class="alert '.$style.'">'. $content .'<div class="alert_del_btn fa-times"></div></div>';


}


add_shortcode('alert', 'rd_alert');




function rd_vc_alert( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'type'   => '',
		'style'   => '',
		'title'   => '',
		'mt'   => '',
		'mb'   => '',
		'animation'   => '',


    ), $atts));

if($style == 'rd_small_alert'){

   return '<div class="alert '.$style.' '.$type.' '.$animation.'" style="margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;"><div class="rd_alert_content">'. $content .'</div><div class="alert_del_btn"></div></div>';

}else{


   return '<div class="alert '.$style.' '.$type.' '.$animation.'" style="margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;"><div class="rd_alert_content"><h3 class="rd_alert_title">'. $title .'</h3>'. $content .'</div><div class="alert_del_btn"></div></div>';


}

}


add_shortcode('vc_alert', 'rd_vc_alert');



?>