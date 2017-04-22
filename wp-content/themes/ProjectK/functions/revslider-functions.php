<?php
/* Add revslider styles */
function thefox_revslider_styles() {
	global $wpdb, $revSliderVersion;

	$plugin_version = $revSliderVersion;

	$table_name = $wpdb->prefix . 'revslider_css';
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name && function_exists('rev_slider_shortcode') && $plugin_version != get_option('thefox_revslider_version')) {

		$styles = array(
		
			// NO TEXT TRANSFORM
			
			//bold
			'.thefox_blod_big_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"48px","line-height":"56px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_big_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"48px","line-height":"56px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_large_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"36px","line-height":"48px","font-family":"Lato","font-weight":"900"}', // business 04
			'.thefox_blod_large_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"36px","line-height":"48px","font-family":"Lato","font-weight":"900"}', // business 04
			'.thefox_blod_mediumlarge_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"30px","line-height":"46px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_mediumlarge_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"30px","line-height":"46px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_medium_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"24px","line-height":"30px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_medium_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"24px","line-height":"30px","font-family":"Lato","font-weight":"700"}', // business 04
			'.thefox_blod_small_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"20px","line-height":"28px","font-family":"Lato","font-weight":"900"}', // business 04
			'.thefox_blod_small_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"20px","line-height":"28px","font-family":"Lato","font-weight":"900"}', // business 04
			
			//normal
			'.thefox_medium_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"24px","line-height":"40px","font-family":"Lato","font-weight":"normal"}', // business 02
			'.thefox_medium_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"24px","line-height":"40px","font-family":"Lato","font-weight":"normal"}', // business 02
			'.thefox_minismall_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"16px","line-height":"26px","font-family":"Lato","font-weight":"normal"}', // business 02
			'.thefox_minismall_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"16px","line-height":"26px","font-family":"Lato","font-weight":"normal"}', // business 02
			'.thefox_mini_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"14px","line-height":"24px","font-family":"Lato","font-weight":"normal"}', // business 02
			'.thefox_mini_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"14px","line-height":"24px","font-family":"Lato","font-weight":"normal"}', // business 02
			
			//light
			'.thefox_light_huge_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"72px","line-height":"80px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_huge_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"72px","line-height":"80px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_big_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"60px","line-height":"80px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_big_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"60px","line-height":"80px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_large_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"48px","line-height":"60px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_large_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"48px","line-height":"60px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_mediumlarge_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"30px","line-height":"40px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_mediumlarge_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"30px","line-height":"40px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_medium_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"24px","line-height":"30px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_medium_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"24px","line-height":"30px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_small_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"18px","line-height":"24px","font-family":"Lato","font-weight":"300"}', // business 02
			'.thefox_light_small_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"18px","line-height":"24px","font-family":"Lato","font-weight":"300"}', // business 02
			
			
			// UPPERCASE
			
			//bold	
			'.thefox_bold_hugest_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"72px","line-height":"85px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_hugest_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"72px","line-height":"85px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_huge_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"60px","line-height":"80px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_huge_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"60px","line-height":"80px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_big_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"50px","line-height":"60px","font-family":"Lato","letter-spacing":"1px","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_big_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"50px","line-height":"60px","font-family":"Lato","letter-spacing":"1px","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_medium_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"24px","line-height":"30px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"2px","font-weight":"900"}', // business 01
			'.thefox_bold_medium_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"24px","line-height":"30px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"2px","font-weight":"900"}', // business 01
			'.thefox_bold_small_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"18px","line-height":"24px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			'.thefox_bold_small_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"18px","line-height":"24px","font-family":"Lato","text-transform":"uppercase","font-weight":"900"}', // business 01
			
			//normal			
			'.thefox_mediumlarge_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"30px","line-height":"36px","font-family":"Lato", "text-transform":"uppercase","letter-spacing":"4px", "font-weight":"normal"}', // creative 01
			'.thefox_mediumlarge_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"30px","line-height":"36px","font-family":"Lato", "text-transform":"uppercase","letter-spacing":"4px", "font-weight":"normal"}', // creative 01
			'.thefox_medium_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"24px","line-height":"30px","font-family":"Lato", "text-transform":"uppercase","letter-spacing":"4px", "font-weight":"normal"}', // creative 01
			'.thefox_medium_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"24px","line-height":"30px","font-family":"Lato", "text-transform":"uppercase","letter-spacing":"4px", "font-weight":"normal"}', // business 04
			'.thefox_small_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"18px","line-height":"24px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"3px", "font-weight":"normal"}',  // creative 011
			'.thefox_small_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"18px","line-height":"24px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"3px", "font-weight":"normal"}',  // creative 011
			'.thefox_mini_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"16px","line-height":"22px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"2px", "font-weight":"normal"}',  // creative 011
			'.thefox_mini_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"16px","line-height":"22px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"2px", "font-weight":"normal"}',  // creative 01
						
			//light						
			'.thefox_light_mediumlarge_uppercase_white_text' => '{"position":"absolute","color":"#ffffff","font-size":"30px","line-height":"36px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"0px","font-weight":"300"}', // creative 02
			'.thefox_light_mediumlarge_uppercase_black_text' => '{"position":"absolute","color":"#1a1c27","font-size":"30px","line-height":"36px","font-family":"Lato","text-transform":"uppercase","letter-spacing":"0px","font-weight":"300"}', // creative 02
		
			
			
			// BLOCK TEXT
			
			'.thefox_block_big_white' => '{"position":"absolute","color":"#ffffff","font-size":"36px","line-height":"73px","font-family":"Lato","font-weight":"normal","background":"rgba(34, 37, 51, 0.2)","border":"1px solid #fff","padding":"0 20px"}', // business 03
			'.thefox_block_big_dark' => '{"position":"absolute","color":"#ffffff","font-size":"36px","line-height":"73px","font-family":"Lato","font-weight":"normal","background":"rgba(34, 37, 51, 0.8)","border":"1px solid rgba(34, 37, 51, 0.8)","padding":"0 20px"}', // business 03
			'.thefox_block_medium_white' => '{"position":"absolute","color":"#ffffff","font-size":"19px","line-height":"38px","font-family":"Lato","font-weight":"normal","background":"rgba(34, 37, 51, 0.2)","border":"1px solid #fff","padding":"0 20px"}',// business 03
			'.thefox_block_medium_dark' => '{"position":"absolute","color":"#ffffff","font-size":"19px","line-height":"38px","font-family":"Lato","font-weight":"normal","background":"rgba(34, 37, 51, 0.8)","border":"1px solid rgba(34, 37, 51, 0.8)","padding":"0 20px"}', // business 03
			
			'.thefox_block_big_uppercase_white' => '{"position":"absolute","color":"rgba(26, 28, 39, 1)","font-size":"48px","line-height":"55px","font-family":"Lato","font-weight":"900","background":"rgba(255,255,255, 0.9)","padding":"0 20px"}', // business 03
			'.thefox_block_big_uppercase_black' => '{"position":"absolute","color":"#ffffff","font-size":"48px","line-height":"55px","font-family":"Lato","font-weight":"900","background":"rgba(26, 28, 39, 0.9)","padding":"0 20px"}', // business 03
			'.thefox_block_medium_uppercase_white' => '{"position":"absolute","color":"rgba(26, 28, 39, 1)","font-size":"26px","line-height":"39px","font-family":"Lato","font-weight":"700","background":"rgba(255,255,255, 0.9)","padding":"0 20px"}', // business 03
			'.thefox_block_medium_uppercase_black' => '{"position":"absolute","color":"#ffffff","font-size":"26px","line-height":"39px","font-family":"Lato","font-weight":"700","background":"rgba(26, 28, 39, 0.9)","padding":"0 20px"}', // business 03
			


			
		);

		foreach($styles as $handle => $params) {
			$test = $wpdb->get_var($wpdb->prepare('SELECT handle FROM ' . $table_name . ' WHERE handle = %s', $handle));

			if($test != $handle) {
				$wpdb->replace(
					$table_name,
					array(
						'handle' => $handle,
						'params' => $params,
					),
					array(
						'%s',
						'%s',
					)
				);
			}
		}

		update_option('thefox_revslider_version', $plugin_version);
	}
}


if(function_exists('rev_slider_shortcode')) {
	add_action('admin_init', 'thefox_revslider_styles');
}


?>