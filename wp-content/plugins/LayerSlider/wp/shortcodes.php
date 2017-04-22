<?php


function layerslider($id = 0, $filters = '') {
	echo LS_Shortcode::handleShortcode(array('id' => $id, 'filters' => $filters));
}

class LS_Shortcode {

	// A counter used to make slider IDs
	// that are guaranteed to be unique
	public static $sliderCount = 0;

	private function __contruct() {}


	/**
	 * Registers the LayerSlider shortcode.
	 *
	 * @since 5.3.3
	 * @access public
	 * @return void
	 */

	public static function registerShortcode() {
		if(!shortcode_exists('layerslider')) {
			add_shortcode('layerslider', array(__CLASS__, 'handleShortcode'));
		}
	}




	/**
	 * Handles the shortcode workflow to display the
	 * appropriate content.
	 *
	 * @since 5.3.3
	 * @access public
	 * @param array $atts Shortcode attributes
	 * @return bool True on successful validation, false otherwise
	 */

	public static function handleShortcode($atts = array()) {

		if(self::validateFilters($atts)) {
			if($slider = self::validateShortcode($atts)) {
				return self::processShortcode($slider);
			} else {

				$data = '<div style="margin: 10px auto; padding: 10px; border: 2px solid red; border-radius: 5px;">';
				$data.= '<strong style="display: block; font-size: 18px;">'.__('LayerSlider encountered a problem while it tried to show your slider.', 'LayerSlider').'</strong>';
				$data.= __("Please make sure that you've used the right shortcode or method to insert the slider, and check if the corresponding slider exists and it wasn't deleted previously.", "LayerSlider");
				$data.= '</div>';

				return $data;
			}
		}
	}




	/**
	 * Validates the provided shortcode filters (if any).
	 *
	 * @since 5.3.3
	 * @access public
	 * @param array $atts Shortcode attributes
	 * @return bool True on successful validation, false otherwise
	 */

	public static function validateFilters($atts = array()) {

		// Bail out early and pass the validation
		// if there aren't filters provided
		if(empty($atts['filters'])) {
			return true;
		}

		// Gather data needed for filters
		$pages = explode(',', $atts['filters']);
		$currSlug = basename(get_permalink());
		$currPageID = (string) get_the_ID();

		foreach($pages as $page) {

			if(($page == 'homepage' && is_front_page())
				|| $currPageID == $page
				|| $currSlug == $page
				|| in_category($page)
			) {
				return true;
			}
		}

		// No filters matched,
		// return false
		return false;
	}



	/**
	 * Validates the shortcode parameters and checks
	 * the references slider.
	 *
	 * @since 5.3.3
	 * @access public
	 * @param array $atts Shortcode attributes
	 * @return bool True on successful validation, false otherwise
	 */

	public static function validateShortcode($atts = array()) {

		// Has ID attribute
		if(!empty($atts['id'])) {

			// Slider exists and isn't deleted
			$slider = LS_Sliders::find($atts['id']);
			if(!empty($slider) || $slider['flag_deleted'] != '1') {
				return $slider;
			}
		}

		return false;
	}





	public static function processShortcode($slider) {

		// Increase slider counter to make slider IDs
		// that are guaranteed to be unique
		self::$sliderCount++;

		// Slider and markup data
		$slides = $slider['data'];
		$id = $slider['id'];
		$sliderID = 'layerslider_'.$id.'_'.self::$sliderCount;
		$output = '';

		// Include slider file
		if(is_array($slides)) {

			// Get phpQuery
			if(!class_exists('phpQuery')) {
				libxml_use_internal_errors(true);
				include LS_ROOT_PATH.'/helpers/phpQuery.php';
			}

			include LS_ROOT_PATH.'/config/defaults.php';
			include LS_ROOT_PATH.'/includes/slider_markup_init.php';
			include LS_ROOT_PATH.'/includes/slider_markup_html.php';
			$output = implode('', $output);
		}

		// Filter to override the printed HTML markup
		if(has_filter('layerslider_slider_markup')) {
			$output = apply_filter('layerslider_slider_markup', $output);
		}

		// Return data
		if(get_option('ls_concatenate_output', true)) {
			$output = trim(preg_replace('/\s+/u', ' ', $output));
		}

		// Bug fix in v5.4.0: Use self closing tag for <source>
		$output = str_replace('></source>', ' />', $output);

		return $output;
	}
}