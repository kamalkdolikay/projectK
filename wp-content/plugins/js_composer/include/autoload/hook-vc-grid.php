<?php

/**
 * Class Vc_Hooks_Vc_Grid
 * @since 4.4
 */
Class Vc_Hooks_Vc_Grid implements Vc_Vendor_Interface {
	protected $grid_id_unique_name = 'vc_gid'; // if you change this also change in vc-basic-grid.php

	/**
	 * Initializing hooks for grid element,
	 * Add actions to save appended shortcodes to post meta (for rendering in preview with shortcode id)
	 * And add action to hook request for grid data, to output it.
	 * @since 4.4
	 */
	public function load() {

		// Hook for set post settings meta with shortcodes data
		/**
		 * Filter called after page saved, used to append some post meta for post
		 * Used to save appended grid shortcodes to post meta with serialized array,
		 * @see Vc_Hooks_Vc_Grid::gridSavePostSettings (fetching shortcodes and return it data) and Vc_Hooks_Vc_Grid::get_shortcode_regex (search exact shortcode in content)
		 * @see Vc_Post_Admin::setSettings for filter info
		 * @deprecated since 4.4.3 due to invalid hash algorithm on saving.
		 */
		add_filter( 'vc_hooks_vc_post_settings', array(
			&$this,
			'gridSavePostSettings'
		), 10, 3 );
		/**
		 * @since 4.4.3
		 */
		add_filter( 'vc_hooks_vc_post_settings', array(
			&$this,
			'gridSavePostSettingsId'
		), 10, 3 );
		/**
		 * Used to output shortcode data for ajax request. called on any page request.
		 */
		// add_action( 'template_redirect', array( &$this, 'getGridDataForAjax' ) );
		add_action( 'wp_ajax_vc_get_vc_grid_data', array( &$this, 'getGridDataForAjax' ) );
		add_action( 'wp_ajax_nopriv_vc_get_vc_grid_data', array( &$this, 'getGridDataForAjax' ) );
	}

	/**
	 * @since 4.4.3
	 * @deprecated and should not be used and will be removed in future!
	 * @return string
	 */
	private function getShortcodeRegexForHash() {
		$tagnames = apply_filters( 'vc_grid_shortcodes_tags', array(
			'vc_basic_grid',
			'vc_masonry_grid',
			'vc_media_grid',
			'vc_masonry_media_grid'
		) ); // return only grid shortcodes
		$tagregexp = join( '|', array_map( 'preg_quote', $tagnames ) );

		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]

	}

	/**
	 * @since 4.4.3
	 * @return string
	 */
	private function getShortcodeRegexForId() {
		return
			'\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "([\\w-_]+)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'

			. '(?:'
			. '('
			. $this->grid_id_unique_name // 4: GridId must exist
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')+'
			. ')'

			. ')'
			. '(?:'
			. '(\\/)'                        // 5: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 6: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';            // 7: Optional second closing brocket for escaping shortcodes: [[tag]]
	}

	/**
	 * Set page meta box values with vc_adv_pager shortcodes data
	 * @since 4.4
	 * @deprecated since 4.4.3
	 *
	 * @param array $settings
	 * @param $post_id
	 * @param $post
	 *
	 * @return array - shortcode settings to save.
	 */
	public function gridSavePostSettings( array $settings, $post_id, $post ) {
		$pattern = $this->getShortcodeRegexForHash();
		preg_match_all( "/$pattern/", $post->post_content, $found ); // fetch only needed shortcodes
		$settings['vc_grid'] = array();
		if ( is_array( $found ) && ! empty( $found[0] ) ) {
			$to_save = array();
			foreach ( $found[3] as $key => $shortcode_atts ) {
				if ( strpos( $shortcode_atts, 'vc_gid:' ) !== false ) {
					continue;
				}
				$atts = shortcode_parse_atts( $shortcode_atts );
				$data = array(
					'tag' => $found[2][ $key ],
					'atts' => $atts,
					'content' => $found[5][ $key ],
				);
				$hash = sha1( serialize( $data ) );
				$to_save[ $hash ] = $data;
			}
			if ( ! empty( $to_save ) ) {
				$settings['vc_grid'] = array( 'shortcodes' => $to_save );
			}
		}

		return $settings;
	}

	/**
	 * @since 4.4.3
	 *
	 * @param array $settings
	 * @param $post_id
	 * @param $post
	 *
	 * @return array
	 */
	public function gridSavePostSettingsId( array $settings, $post_id, $post ) {
		$pattern = $this->getShortcodeRegexForId();
		preg_match_all( "/$pattern/", $post->post_content, $found ); // fetch only needed shortcodes
		$settings['vc_grid_id'] = array();
		if ( is_array( $found ) && ! empty( $found[0] ) ) {
			$to_save = array();

			foreach ( $found[1] as $key => $parse_able ) {
				if ( empty( $parse_able ) || $parse_able != '[' ) {
					$id_pattern = '/' . $this->grid_id_unique_name . '\:([\w-_]+)/';
					$id_value = $found[4][ $key ];

					preg_match( $id_pattern, $id_value, $id_matches );

					if ( ! empty( $id_matches ) ) {
						$id_to_save = $id_matches[1];

						// why we need to check if shortcode is parse able?
						// 1: if it is escaped it must not be displayed (parsed)
						// 2: so if 1 is true it must not be saved in database meta
						$shortcode_tag = $found[2][ $key ];
						$shortcode_atts_string = $found[3][ $key ];
						/** @var $atts array */
						$atts = shortcode_parse_atts( $shortcode_atts_string );
						$content = $found[6][ $key ];
						$data = array(
							'tag' => $shortcode_tag,
							'atts' => $atts,
							'content' => $content,
						);

						$to_save[ $id_to_save ] = $data;
					}
				}
			}
			if ( ! empty( $to_save ) ) {
				$settings['vc_grid_id'] = array( 'shortcodes' => $to_save );
			}
		}

		return $settings;
	}

	/**
	 * @since 4.4
	 *
	 * @output/@return string - grid data for ajax request.
	 */
	public function getGridDataForAjax() {
		$tag = vc_request_param( 'tag' );
		if ( $tag ) {
			$shorcode_fishbone = visual_composer()->getShortCode( $tag );
			if ( is_object( $shorcode_fishbone ) ) {
				/** @var $vc_grid WPBakeryShortcode_Vc_Basic_Grid */
				$vc_grid = $shorcode_fishbone->shortcodeClass();
				if ( method_exists( $vc_grid, 'renderAjax' ) ) {
					die( $vc_grid->renderAjax( vc_request_param( 'data' ) ) );
				}
			}
		}
	}

}

/**
 * @since 4.4
 * @var Vc_Hooks_Vc_Grid $hook
 */
$hook = new Vc_Hooks_Vc_Grid();

// when visual composer initialized let's trigger Vc_Grid hooks.
add_action( 'vc_after_init', array( $hook, 'load' ) );