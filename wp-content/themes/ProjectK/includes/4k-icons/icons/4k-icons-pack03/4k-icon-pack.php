<?php
/*
Plugin Name: 4k Icons Font Pack (3/5)
Description: Font pack for 4k Icons plugin. Must be installed all together. Requires the 4k Icons for Visual Composer.
Author: Benjamin Intal, Gambit
Version: 1.0
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
*/

add_filter( '4k_icon_font_pack_activated', 'fourk_icon_font_pack03_activation' );
function fourk_icon_font_pack03_activation( $numActive ) {
	return $numActive + 1;
}

add_filter( '4k_icon_font_pack_path', 'fourk_icon_font_pack_path03', 10, 2 );
function fourk_icon_font_pack_path03( $iconFile, $cssFile ) {
	
	if ( in_array( $cssFile, array ( 'fo', 'foa', 'ft',	'games', 'gesture', 'ic', 'im',	'imf', 'ion', 'lis', 'ln', 'lp', 'ls', 'ma', 'mfg',	'mi', 'mk',	'mm' ) ) ) {
		$iconFile = RD_DIRECTORY . '/includes/4k-icons/icons/4k-icons-pack03/icons/fonts/' . $cssFile;
	}
	
	return $iconFile;
}