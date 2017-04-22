<?php
/*
Plugin Name: 4k Icons Font Pack (2/5)
Description: Font pack for 4k Icons plugin. Must be installed all together. Requires the 4k Icons for Visual Composer.
Author: Benjamin Intal, Gambit
Version: 1.0
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
*/

add_filter( '4k_icon_font_pack_activated', 'fourk_icon_font_pack02_activation' );
function fourk_icon_font_pack02_activation( $numActive ) {
	return $numActive + 1;
}

add_filter( '4k_icon_font_pack_path', 'fourk_icon_font_pack_path02', 10, 2 );
function fourk_icon_font_pack_path02( $iconFile, $cssFile ) {
	
	if ( in_array( $cssFile, array ( 'draw', 'ec', 'ecommerce',	'elg', 'el', 'elu', 'en', 'fa', 'file'	) ) ) {
		$iconFile = RD_DIRECTORY . '/includes/4k-icons/icons/4k-icons-pack02/icons/fonts/' . $cssFile;
	}
	
	return $iconFile;
}