<?php
/*
Plugin Name: 4k Icons for Visual Composer
Description: Adds a shortcode to Visual Composer for using 9,000+ icons
Author: Benjamin Intal, Gambit
Version: 2.9
Author URI: http://gambit.ph
Plugin URI: http://codecanyon.net/user/gambittech/portfolio
Text Domain: gambit-vc-4k-icons
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

defined( 'VERSION_GAMBIT_VC_4K_ICONS' ) or define( 'VERSION_GAMBIT_VC_4K_ICONS', 2.9 );

// Identifies the plugin itself. If already existing, it will not redefine itself.
defined( 'GAMBIT_VC_4K_ICONS' ) or define( 'GAMBIT_VC_4K_ICONS', 'gambit-vc-4k-icons' );


class FourKIconShortcode {

	private static $printedIconArray = false;
	private static $iconId = 1;

	// The number of font packs that we have
	const NUM_FONT_PACKS = 5;

	// Used for loading stuff only once during a page load
    private static $firstLoad = 0;

	/**
	 * Hook into WordPress
	 *
	 * @return	void
	 * @since	1.0
	 */
	function __construct() {
		// Initialize plugin
		add_shortcode( '4k_icon', array( $this, 'renderShortcode' ) );

		// Create as a Visual Composer addon
        add_action( 'after_setup_theme', array( $this, 'initVisualComposer' ), 1 );

		// Our translations
		add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ), 1 );

		// Gambit links
		add_filter( 'plugin_row_meta', array( $this, 'pluginLinks' ), 10, 2 );

		// Activation instructions & CodeCanyon rating notices
		$this->createNotices();

		// File checking to ensure the font packs are installed.
		add_filter( 'admin_notices', array( $this, 'displayAdminNotificationIncompletePack' ) );

		// Add styles to add the element icon, see more in function desc
		add_action( 'admin_head', array( $this, 'fixVCCss' ) );
	}


	/**
	 * Fixes the element icon in VC since our base starts with a number, CSS rules aren't being applied
	 * This writes new styles to show the icon
	 *
	 * @return	void
	 * @since	2.8
	 */
	public function fixVCCss() {
		echo "<style>
			.vc_el-container [id='4k_icon'] .vc_element-icon,
            .wpb_4k_icon .wpb_element_title .vc_element-icon {
				background-image: url(" . RD_DIRECTORY . '/includes/4k-icons/vc-icon.png'.");
			}
		</style>";
	}


	/**
	 * Initializes our VC integration
	 *
	 * @return	void
	 * @since	1.0
	 */
    public function initVisualComposer() {
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
        if ( version_compare( WPB_VC_VERSION, '4.2', '<' ) ) {
			add_action( 'after_setup_theme', array( $this, 'integrateWithVC' ) );
    		add_action( 'after_setup_theme', array( $this, 'createShortcode' ) );
        } else {
			add_action( 'vc_after_mapping', array( $this, 'integrateWithVC' ) );
    		add_action( 'vc_after_mapping', array( $this, 'createShortcode' ) );
        }
		add_action( 'admin_head', array( $this, 'createFontClassArray' ) );

    }


	public function createFontClassArray() {
		if ( ! self::$printedIconArray ) {
			include( trailingslashit( dirname( __FILE__ ) ) . 'inc/font-js-classes.php' );
		}
		self::$printedIconArray = true;
	}


	public function integrateWithVC() {
        add_shortcode_param( '4k_icon', array( $this, 'createIconSettingsField' ), RD_DIRECTORY . '/includes/4k-icons/js/script-vc-ck.js' );
	}



	/**
	 * Displays a notification in the admin if one or more of the font packs are not installed.
	 *
	 * @since 1.0
	 */
	public function displayAdminNotificationIncompletePack() {

	$numActivated = apply_filters( '4k_icon_font_pack_activated', 0 );
		if ( $numActivated < self::NUM_FONT_PACKS ) {

			echo "<div class='error'><p><strong>"
				. sprintf( __( "You are missing %d required font pack(s) for the 4k Icons plugin, they are not activated or installed. The font packs are included in the package downloaded from CodeCanyon.", GAMBIT_VC_4K_ICONS ), self::NUM_FONT_PACKS - $numActivated )
				. sprintf( "<br><a href='%s'>%s</a>",
					admin_url( "plugins.php" ),
					__( "Click here to go to the plugins page to install or activate it.", GAMBIT_VC_4K_ICONS ) )
			. "</strong></p></div>";
		}
    }


	/**
	 * Loads the translations
	 *
	 * @return	void
	 * @since	1.0
	 */
	public function loadTextDomain() {
		load_plugin_textdomain( GAMBIT_VC_4K_ICONS, false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * Adds plugin links
	 *
	 * @access	public
	 * @param	array $plugin_meta The current array of links
	 * @param	string $plugin_file The plugin file
	 * @return	array The current array of links together with our additions
	 * @since	1.0
	 **/
	public function pluginLinks( $plugin_meta, $plugin_file ) {
		if ( $plugin_file == plugin_basename( __FILE__ ) ) {
			$pluginData = get_plugin_data( __FILE__ );

			$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
				"http://support.gambit.ph?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
				__( "Get Customer Support", GAMBIT_VC_4K_ICONS )
			);
			$plugin_meta[] = sprintf( "<a href='%s' target='_blank'>%s</a>",
				"https://gambit.ph/plugins?utm_source=" . urlencode( $pluginData['Name'] ) . "&utm_medium=plugin_link",
				__( "Get More Plugins", GAMBIT_VC_4K_ICONS )
			);
		}
		return $plugin_meta;
	}

	/************************************************************************
	 * Activation instructions & CodeCanyon rating notices START
	 ************************************************************************/
	/**
	 * For theme developers who want to include our plugin, they will need
	 * to disable this section. This can be done by include this line
	 * in their theme:
	 *
	 * defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) or define( 'GAMBIT_DISABLE_RATING_NOTICE', true );
	 */

	/**
	 * Adds the hooks for the notices
	 *
	 * @access	protected
	 * @return	void
	 * @since	1.0
	 **/
	protected function createNotices() {
		register_activation_hook( __FILE__, array( $this, 'justActivated' ) );
		register_deactivation_hook( __FILE__, array( $this, 'justDeactivated' ) );

		add_action( 'admin_notices', array( $this, 'remindSettingsAndSupport' ) );

		if ( ! defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
			add_action( 'admin_notices', array( $this, 'remindRating' ) );
			add_action( 'wp_ajax_' . __CLASS__ . '-ask-rate', array( $this, 'ajaxRemindHandler' ) );
		}
	}


	/**
	 * Creates the transients for triggering the notices when the plugin is activated
	 *
	 * @return	void
	 * @since	1.0
	 **/
	public function justActivated() {
		delete_transient( __CLASS__ . '-activated' );
		set_transient( __CLASS__ . '-activated', time(), MINUTE_IN_SECONDS * 2 );

		if ( ! defined( 'GAMBIT_DISABLE_RATING_NOTICE' ) ) {
			delete_transient( __CLASS__ . '-ask-rate' );
			set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS * 4 );

			update_option( __CLASS__ . '-ask-rate-placeholder', 1 );
		}
	}


	/**
	 * Removes the transients & triggers when the plugin is deactivated
	 *
	 * @return	void
	 * @since	1.0
	 **/
	public function justDeactivated() {
		delete_transient( __CLASS__ . '-activated' );
		delete_transient( __CLASS__ . '-ask-rate' );
		delete_option( __CLASS__ . '-ask-rate-placeholder' );
	}


	/**
	 * Ajax handler for when a button is clicked in the 'ask rating' notice
	 *
	 * @return	void
	 * @since	1.0
	 **/
	public function ajaxRemindHandler() {
		check_ajax_referer( __CLASS__, '_nonce' );

		if ( $_POST['type'] == 'remove' ) {
			delete_option( __CLASS__ . '-ask-rate-placeholder' );
		} else { // remind
			set_transient( __CLASS__ . '-ask-rate', time(), DAY_IN_SECONDS );
		}

		die();
	}


	/**
	 * Displays the notice for reminding the user to rate our plugin
	 *
	 * @return	void
	 * @since	1.0
	 **/
	public function remindRating() {
		if ( get_option( __CLASS__ . '-ask-rate-placeholder' ) === false ) {
			return;
		}
		if ( get_transient( __CLASS__ . '-ask-rate' ) ) {
			return;
		}

		$pluginData = get_plugin_data( __FILE__ );
		$nonce = wp_create_nonce( __CLASS__ );

		echo '<div class="updated gambit-ask-rating" style="border-left-color: #3498db">
				<p>
					<img src="' .  RD_DIRECTORY . '/includes/4k-icons/gambit-logo.png'. '" style="display: block; margin-bottom: 10px"/>
					<strong>' . sprintf( __( 'Enjoying %s?', GAMBIT_VC_4K_ICONS ), $pluginData['Name'] ) . '</strong><br>' .
					__( 'Help us out by rating our plugin 5 stars in CodeCanyon! This will allow us to create more awesome products and provide top notch customer support.', GAMBIT_VC_4K_ICONS ) . '<br>' .
					'<button data-href="http://codecanyon.net/downloads?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=rate_notice" class="button button-primary" style="margin: 10px 10px 10px 0;">' . __( 'Rate us 5 stars in CodeCanyon :)', GAMBIT_VC_4K_ICONS ) . '</button>' .
					'<button class="button button-secondary remind" style="margin: 10px 10px 10px 0;">' . __( 'Remind me tomorrow', GAMBIT_VC_4K_ICONS ) . '</button>' .
					'<button class="button button-secondary nothanks" style="margin: 10px 0;">' . __( 'I&apos;ve already rated!', GAMBIT_VC_4K_ICONS ) . '</button>' .
					'<script>
					jQuery(document).ready(function($) {
						"use strict";

						$(".gambit-ask-rating button").click(function() {
							if ( $(this).is(".button-primary") ) {
								var $this = $(this);

								var data = {
									"_nonce": "' . $nonce . '",
									"action": "' . __CLASS__ . '-ask-rate",
									"type": "remove"
								};

								$.post(ajaxurl, data, function(response) {
									$this.parents(".updated:eq(0)").fadeOut();
									window.open($this.attr("data-href"), "_blank");
								});

							} else if ( $(this).is(".remind") ) {
								var $this = $(this);

								var data = {
									"_nonce": "' . $nonce . '",
									"action": "' . __CLASS__ . '-ask-rate",
									"type": "remind"
								};

								$.post(ajaxurl, data, function(response) {
									$this.parents(".updated:eq(0)").fadeOut();
								});

							} else if ( $(this).is(".nothanks") ) {
								var $this = $(this);

								var data = {
									"_nonce": "' . $nonce . '",
									"action": "' . __CLASS__ . '-ask-rate",
									"type": "remove"
								};

								$.post(ajaxurl, data, function(response) {
									$this.parents(".updated:eq(0)").fadeOut();
								});
							}
							return false;
						});
					});
					</script>
				</p>
			</div>';
	}


	/**
	 * Displays the notice that we have a support site and additional instructions
	 *
	 * @return	void
	 * @since	1.0
	 **/
	public function remindSettingsAndSupport() {
		if ( ! get_transient( __CLASS__ . '-activated' ) ) {
			return;
		}

		$pluginData = get_plugin_data( __FILE__ );

		echo '<div class="updated" style="border-left-color: #3498db">
				<p>
					<img src="' .  RD_DIRECTORY . '/includes/4k-icons/gambit-logo.png'.'" style="display: block; margin-bottom: 10px"/>
					<strong>' . sprintf( __( 'Thank you for activating %s!', GAMBIT_VC_4K_ICONS ), $pluginData['Name'] ) . '</strong><br>' .

					// Tell users how to use the plugin.
					__( 'Now just edit your pages, add one of more than 4k icons in list, and style it, all in Visual Composer.', GAMBIT_VC_4K_ICONS ) . '<br>' .

					__( 'If you need any support, you can leave us a ticket in our support site. The link to our support site is also listed in the plugin details for future reference.', GAMBIT_VC_4K_ICONS ) . '<br>' .
					'<a href="http://support.gambit.ph?utm_source=' . urlencode( $pluginData['Name'] ) . '&utm_medium=activation_notice" class="gambit_ask_rate button button-default" style="margin: 10px 0;" target="_blank">' . __( 'Visit our support site', GAMBIT_VC_4K_ICONS ) . '</a>' .
					'<br>' .
					'<em style="color: #999">' . __( 'This notice will go away in a moment', GAMBIT_VC_4K_ICONS ) . '</em><br>
				</p>
			</div>';
	}


	/************************************************************************
	 * Activation instructions & CodeCanyon rating notices END
	 ************************************************************************/



	public function createIconSettingsField( $settings, $value ) {
	    $dependency = vc_generate_dependencies_attributes($settings);
	    return '<div class="my_param_block">'
		  	  . '<style>.fourk_select_window i {'
			  . 'display:inline-block;height:40px;min-width:40px;text-align:center;padding:5px;vertical-align:middle;border:1px solid #ddd;margin:2px;cursor:pointer;box-sizing:content-box'
		  	  . '}</style>'
  			  .'<div class="4k_icon_preview" style="display: inline-block;
					margin-right: 10px;
					height: 60px;
					width: 90px;
					text-align: center;
					background: #FAFAFA;
					font-size: 60px;
					padding: 15px 0;
					margin-bottom: 10px;
					border: 1px solid #DDD;
					float: left;
					box-sizing: content-box;"><i class="bk-ice-cream"></i></div>'
	              .'<input placeholder="' . __( "Search icon or pick one below...", GAMBIT_VC_4K_ICONS ) . '" name="' . $settings['param_name'] . '"'
				. ' data-param-name="' . $settings['param_name'] . '"'
				. ' data-icon-css-path="' .  RD_DIRECTORY . '/includes/4k-icons/'. '"'
	              .'class="wpb_vc_param_value wpb-textinput'
	              .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
	              .$value.'" ' . $dependency . ' style="width: 230px; margin-right: 10px; vertical-align: top; float: left; margin-bottom: 10px"/>'
				. '<select class="4k_icon_filter" style="
						width: auto;
						display: inline-block;
						vertical-align: top;
						float: left;
						"><option value="">- ' . __( "Search Filter", GAMBIT_VC_4K_ICONS ) . ' -</option>
						<option value="all">' . __( "Show all icons (may be a bit slow)", GAMBIT_VC_4K_ICONS ) . '</option>
						<option value="lp-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "105 Loops", "Pranav" )
						. '</option>'
						. '<option value="mi-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "50 Mini Icons", "Victor Erixon" )
						. '</option>'
						. '<option value="sw-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "80 Shades of White Icons", "Victor Erixon" )
						. '</option>'
						. '<option value="oi-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Any Old Icon", "Ian Yates" )
						. '</option>'
						. '<option value="ba-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Batch", "Adam Whitcroft" )
						. '</option>'
						. '<option value="br-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Brandico", "Fontello" )
						. '</option>'
						. '<option value="bk-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Brankic1979", "Brankic1979" )
						. '</option>'
						. '<option value="bc-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Broccolidry", "Visual Idiot" )
						. '</option>'
						. '<option value="cl-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Clear Icons", "Appzgear" )
						. '</option>'
						. '<option value="cn-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Countricons", "Freepik" )
						. '</option>'
						. '<option value="ct-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Cuticons", "Vaibhav Bhat" )
						. '</option>'
						. '<option value="dr-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Dripicons", "Amit Jakhu" )
						. '</option>'
						. '<option value="ec-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Eco Ico", "Matthew Skiles" )
						. '</option>'
						. '<option value="elu-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Elusive Icons", "Aristath" )
						. '</option>'
						. '<option value="en-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Entypo", "Daniel Bruce" )
						. '</option>'
						. '<option value="ft-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Fat Icons", "Designerz Base" )
						. '</option>'
						. '<option value="file-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "File Formats", "Freepik" )
						. '</option>'
						. '<option value="fa-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Font Awesome", "Dave Gandy" )
						. '</option>'
						. '<option value="fo-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Fontelico", "Fontello" )
						. '</option>'
						. '<option value="foa-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Foundation Icons - Accessibility", "ZURB" )
						. '</option>'
						. '<option value="draw-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Hand Drawn", "Freepik" )
						. '</option>'
						. '<option value="im-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Icon Minia", "Egemen Kapusuz" )
						. '</option>'
						. '<option value="imf-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "IcoMoon - Free", "Keyamoon" )
						. '</option>'
						. '<option value="ic-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Iconic", "PJ. Onori" )
						. '</option>'
						. '<option value="ion-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Ionicons", "Drifty" )
						. '</option>'
						. '<option value="ls-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Ligature Symbols", "Kazuyuki Motoyama" )
						. '</option>'
						. '<option value="lis-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Line Icon Set", "Situ Herrera" )
						. '</option>'
						. '<option value="elg-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Elegant Icons", "Elegant Themes" )
						. '</option>'
						. '<option value="el-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Line Icons", "Elegant Themes" )
						. '</option>'
						. '<option value="ln-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Linecons", "Sergey Shmidt" )
						. '</option>'
						. '<option value="mk-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Maki", "Mapbox" )
						. '</option>'
						. '<option value="ma-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Map Icons", "Scott de Jonge" )
						. '</option>'
						. '<option value="mt-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Meteocons", "Alessio Atzeni" )
						. '</option>'
						. '<option value="mfg-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "MFG Labs", "MFG Labs" )
						. '</option>'
						. '<option value="mo-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Mobile Phones", "Freepik" )
						. '</option>'
						. '<option value="mp-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Modern Pictograms", "John Caserta" )
						. '</option>'
						. '<option value="mn-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "MonoSocialIcons Font", "Ivan Drinchev" )
						. '</option>'
						. '<option value="moon-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Moon Phase 1", "Freepik" )
						. '</option>'
						. '<option value="mm-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Multimedia", "Freepik" )
						. '</option>'
						. '<option value="ow-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "OpenWeb Icons", "Matthias Pfefferle" )
						. '</option>'
						. '<option value="creditcard-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Payment Cards", "Freepik" )
						. '</option>'
						. '<option value="payment-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Payment Logos", "Freepik" )
						. '</option>'
						. '<option value="business-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Simpleicon Business", "SimpleIcon" )
						. '</option>'
						. '<option value="ecommerce-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Simpleicon eCommerce", "SimpleIcon" )
						. '</option>'
						. '<option value="place-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Simpleicon Places", "SimpleIcon" )
						. '</option>'
						. '<option value="st-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Steadysets", "Tommy Sahl" )
						. '</option>'
						. '<option value="ty-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Typicons", "Stephen Hutchings" )
						. '</option>'
						. '<option value="ty2-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Typicons (Updated)", "Stephen Hutchings" )
						. '</option>'
						. '<option value="u8-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Universal 08", "Freepik" )
						. '</option>'
						. '<option value="u12-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Universal 12", "Freepik" )
						. '</option>'
						. '<option value="gesture-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Using Gesture", "Mobiletuxedo" )
						. '</option>'
						. '<option value="games-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Video Games", "Freepik" )
						. '</option>'
						. '<option value="wi-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Weather Icons", "Erik Flowers" )
						. '</option>'
						. '<option value="ws-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Web Symbols", "Just Be Nice Studio" )
						. '</option>'
						. '<option value="wl-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Website Logos", "Freepik" )
						. '</option>'
						. '<option value="wb-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "WebHostingHub Glyphs", "WebHostingHub" )
						. '</option>'
						. '<option value="zm-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "WPZoom Developer Icon Set", "David Ferreria" )
						. '</option>'
						. '<option value="usa-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "StateFace", "ProPublica" )
						. '</option>'
						. '<option value="zo-">'
						. sprintf( __( '%s by %s', GAMBIT_VC_4K_ICONS ), "Zocial", "Sam Collins" )
						. '</option>
						</select>'
				. '<div class="fourk_select_window" style="display: none; font-size: 40px; width: 100%; padding: 8px;
					box-sizing: border-box;
					-moz-box-sizing: border-box;
					background: #FAFAFA;
					height: 250px;
					overflow-y: scroll;
					border: 1px solid #DDD;
					clear: both"></div>'
	          .'</div>';
	}


	public function createShortcode() {
		if ( ! is_admin() ) {
			return;
		}

		vc_map( array(
		    'base' => '4k_icon',
		    'name' => __( '4k Icon', GAMBIT_VC_4K_ICONS ),
			'description' => __( 'Awesome styleable icon', GAMBIT_VC_4K_ICONS ),
			// URL to my icon for Visual Composer
		    'icon' =>  RD_DIRECTORY . '/includes/4k-icons/vc-icon.png',
			// All my attributes, define as many as we need
		    'params' => array(
                array(
                    'type' => '4k_icon',
                    'heading' => __( 'Choose your icon', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'icon',
                    'value' => '',
                    'description' => __( 'Choose an icon. Type in the text box above to search for a specific icon. Use the drop down above to filter or show icons from specific icon sets.', GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Icon Color', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'icon_color',
                    'value' => '#3498db',
                    'description' => __( 'Pick a color for your icon.', GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Icon Size', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'icon_size',
                    'value' => '50',
                    'description' => __( 'The size of your icon in pixels.', GAMBIT_VC_4K_ICONS )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Background Shape', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'shape',
                    'value' => array(
						__( 'No background shape', GAMBIT_VC_4K_ICONS ) => 'none',
						__( 'Circle', GAMBIT_VC_4K_ICONS ) => 'circle',
						__( 'Square', GAMBIT_VC_4K_ICONS ) => 'square',
						__( 'Rounded-Square', GAMBIT_VC_4K_ICONS ) => 'rounded',
					),
                    'description' => __( "Select a background shape for your icon. <em>(Changes may not be visible in the frontend editor)</em>", GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Background Shape Type', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'shape_type',
                    'value' => array(
						__( 'Normal, solid background', GAMBIT_VC_4K_ICONS ) => 'solid',
						__( 'Solid background with a dark bottom border', GAMBIT_VC_4K_ICONS ) => 'button',
						__( 'Thin bordered background', GAMBIT_VC_4K_ICONS ) => 'thin-border',
						__( 'Thick bordered background', GAMBIT_VC_4K_ICONS ) => 'thick-border',
					),
                    'description' => __( "Select a type of background shape for your icon. This is only applied when there are no hover effects.", GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'shape',
						'value' => array( 'circle', 'square', 'rounded' )
					),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Background Shape Border Radius', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'border_radius',
                    'value' => '8',
                    'description' => __( 'The border radius of the background shape in pixels.', GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'shape',
						'value' => array( 'rounded' )
					),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Background Shape Color', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'shape_color',
                    'value' => '#dddddd',
                    'description' => __( "Pick a color for your icon's background shape.", GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'shape',
						'value' => array( 'circle', 'square', 'rounded' )
					),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Shape Size', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'shape_size',
                    'value' => '60',
                    'description' => __( "The size for your icon's background shape in pixels.", GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'shape',
						'value' => array( 'circle', 'square', 'rounded' )
					),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Hover Effect', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'hover_effect',
                    'value' => array(
						__( 'No hover effect', GAMBIT_VC_4K_ICONS ) => 'none',
						'(faint-circle) ' . __( "Faint background shape that solidifies on hover with an outline", GAMBIT_VC_4K_ICONS ) => 'faint-circle',
						'(solid-outline) ' . __( "Solid background shape that gets smaller when hovered on and shows a border", GAMBIT_VC_4K_ICONS ) => 'solid-outline',
						'(flip-vertical) ' . __( "Solid background shape, that flips vertically when hovered with inverted colors", GAMBIT_VC_4K_ICONS ) => 'flip-vertical',
						'(flip-horizontal) ' . __( "Solid background shape, that flips horizontally when hovered with inverted colors", GAMBIT_VC_4K_ICONS ) => 'flip-horizontal',
						'(swipe-down) ' . __( "Solid background shape, icon swipes down on hover and gets replaced with inverted colors", GAMBIT_VC_4K_ICONS ) => 'swipe-down',
						'(swipe-up) ' . __( "Solid background shape, icon swipes up on hover and gets replaced with inverted colors", GAMBIT_VC_4K_ICONS ) => 'swipe-up',
						'(swipe-left) ' . __( "Solid background shape, icon swipes left on hover and gets replaced with inverted colors", GAMBIT_VC_4K_ICONS ) => 'swipe-left',
						'(swipe-right) ' . __( "Solid background shape, icon swipes right on hover and gets replaced with inverted colors", GAMBIT_VC_4K_ICONS ) => 'swipe-right',
						'(fill-up) ' . __( "Outlined background shape that gets filled up from the bottom when hovered", GAMBIT_VC_4K_ICONS ) => 'fill-up',
						'(border-solid) ' . __( "Border background shape that gets filled up from the edges when hovered", GAMBIT_VC_4K_ICONS ) => 'border-solid',
						'(border-thick) ' . __( "Border background shape that gets smaller with another thicker border when hovered", GAMBIT_VC_4K_ICONS ) => 'border-thick',
					),
                    'description' => __( "The hover effect to play when the mouse hovers over the icon. <em>(Changes may not be visible in the frontend editor)</em>", GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'shape',
						'value' => array( 'circle', 'square', 'rounded' )
					),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Hover Effect Trigger', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'hover_on',
                    'value' => array(
						__( 'When the mouse hovers over the icon', GAMBIT_VC_4K_ICONS ) => 'icon',
						__( "When the mouse hovers over the icon's container", GAMBIT_VC_4K_ICONS ) => 'parent',
						sprintf( __( "When the mouse hovers over the icon's container (%d containers outward)", GAMBIT_VC_4K_ICONS ), 2) => 'parent2',
						sprintf( __( "When the mouse hovers over the icon's container (%d containers outward)", GAMBIT_VC_4K_ICONS ), 3) => 'parent3',
						sprintf( __( "When the mouse hovers over the icon's container (%d containers outward)", GAMBIT_VC_4K_ICONS ), 4) => 'parent4',
						__( "When the mouse hovers over the row", GAMBIT_VC_4K_ICONS ) => 'row',
					),
                    'description' => __( "Choose the element which would trigger the hover effect. You may need to play around this value depending on your hover effect since some may have additional containers for the effect. <em>(Changes may not be visible in the frontend editor)</em>", GAMBIT_VC_4K_ICONS ),
					'dependency' => array(
 						'element' => 'hover_effect',
						'value' => array( 'faint-circle', 'solid-outline', 'solid-outline2', 'flip-vertical', 'flip-horizontal', 'swipe-down', 'swipe-up', 'swipe-left', 'swipe-right', 'fill-up', 'border-solid', 'border-thick' ),
					),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Link to go to When Icon is Clicked', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'link',
                    'value' => '',
                    'description' => __( "Enter a URL here to make your icon a link.", GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Open The Link in a New Window?', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'link_new_window',
                    'value' => array(
                        __( 'Check this to open the link above in a new window', GAMBIT_VC_4K_ICONS ) => 'new_window'
                    ),
                    'description' => '',
					'dependency' => array(
 						'element' => 'link',
						'not_empty' => true
					),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon Float', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'float',
                    'value' => array(
						__( "Don't float", GAMBIT_VC_4K_ICONS ) => 'none',
						__( 'Float left', GAMBIT_VC_4K_ICONS ) => 'left',
						__( 'Float right', GAMBIT_VC_4K_ICONS ) => 'right',
					),
                    'description' => __( "The float rule of the icon.", GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Overflow the Next Content?', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'overflow_next',
                    'value' => array(
                        __( "If the next content box is a single text block, you can check this field in order for the icon to occupy the whole height (not like when floated). This only applies when you have the float field set to left or right.", GAMBIT_VC_4K_ICONS ) => 'overflow'
                    ),
                    'description' => '',
					'dependency' => array(
 						'element' => 'float',
						'value' => array( 'left', 'right' ),
					),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Icon Margin', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'margin',
                    'value' => '20',
                    'description' => __( "The margin in pixels. By default this margin will be placed on the bottom of your icon. If floated left or right, this margin will also be used on the side the icon meets your content.", GAMBIT_VC_4K_ICONS ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Class name', GAMBIT_VC_4K_ICONS ),
                    'param_name' => 'extra_class',
                    'value' => '',
                    'description' => __( "You can add an extra class name to this icon if you want to add custom CSS styles to it.", GAMBIT_VC_4K_ICONS ),
                ),
		    ),
		) );
	}


	// All $atts are filled up with the default values for you,
	// Start rendering my shortcode
	public function renderShortcode( $atts, $content ) {
        $defaults = array(
            'icon' => '',
            'icon_color' => '#3498db',
            'icon_size' => '50',
            'shape' => 'none',
            'shape_type' => 'solid',
            'border_radius' => '8',
            'shape_color' => '#dddddd',
            'shape_size' => '60',
            'hover_effect' => 'none',
            'hover_on' => 'icon',
            'link' => '',
            'link_new_window' => '',
            'float' => 'none',
            'overflow_next' => '',
            'margin' => '20',
            'extra_class' => '',
        );
        $atts = array_merge( $defaults, $atts );

		$ret = '';

		// Enqueue the CSS
		if ( ! empty( $atts['icon'] ) ) {
			$cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );
            // Don't load the CSS files to trim loading time, include the specific styles via PHP
            // wp_enqueue_style( '4k-icon-' . $cssFile, plugins_url( 'icons/css/' . $cssFile . '.css', __FILE__ ) );
			wp_enqueue_style( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/css/icon-styles.css' , null, VERSION_GAMBIT_VC_4K_ICONS );
			wp_enqueue_script( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/js/script-ck.js', array( 'jquery' ), VERSION_GAMBIT_VC_4K_ICONS, true );
		}

		$divClasses = array();

		if ( empty( $atts['shape'] ) ) {
			$atts['shape'] = 'none';
		}

		$dataAttributes = array();
		$shapeColor = $atts['shape_color'];
		if ( ! empty( $shapeColor ) && $atts['shape'] != 'none' ) {
			$shapeColor = $this->hex2rgb( $shapeColor );
			if ( $atts['shape'] != 'none' && $atts['hover_effect'] == 'faint-circle' ) {
				$shapeColor[] = '.2';
				$dataAttributes[] = "data-hover-background='" . $atts['shape_color'] . "'";
			} else {
				$shapeColor[] = '1';
			}
			$shapeColor = 'rgba(' . implode( ',', $shapeColor ) . ')';
		}

		$containerStyles = array();
		$divStyles = array();
		$beforeStyles = array();
		$afterStyles = array();
		$iconStyles = array();
		$iconHoverStyles = array();

		$containerStyles[] = 'text-align:' . 'center';//$atts['alignment'];

		if ( $atts['shape'] == 'none' ) {
			$atts['hover_effect'] = 'none';
		}

		if ( $atts['shape'] != 'none' ) {
			$divStyles[] = 'background-color:' . $shapeColor;
			$divStyles[] = 'padding:' . ( ( (int)$atts['shape_size'] - (int)$atts['icon_size'] ) / 2 ) . 'px 0';
			$divStyles[] = 'width:' . (int)$atts['shape_size'] . 'px';
			$divStyles[] = 'height:' . (int)$atts['icon_size'] . 'px';
			$beforeStyles[] = 'border-color:' . $atts['shape_color'];
			$afterStyles[] = 'border-color:' . $atts['shape_color'];
		} else {
			$divStyles[] = 'background-color: transparent';
		}

		if ( $atts['shape'] == 'rounded' ) {
			$divStyles[] = 'border-radius:' . (int)$atts['border_radius'] . 'px';
			$beforeStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] * 2 ) . 'px';
			$afterStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] * 2 ) . 'px';
			if ( $atts['hover_effect'] == 'fill-up'
			     || $atts['hover_effect'] == 'border-solid' ) {
				$afterStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] ) . 'px';
			}
			if ( $atts['hover_effect'] == 'solid-outline' ) {
				$afterStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] ) . 'px';
				$beforeStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] ) . 'px';
			}
			if ( $atts['hover_effect'] == 'border-thick' ) {
				$afterStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] ) . 'px';
				$beforeStyles[] = 'border-radius:' . ( (int)$atts['border_radius'] * 1.5 ) . 'px';
			}
		} else if ( $atts['shape'] == 'circle' ) {
			$divStyles[] = 'border-radius:100%';
			$beforeStyles[] = 'border-radius:100%';
			$afterStyles[] = 'border-radius:100%';
		}

		// Shape type
		if ( $atts['hover_effect'] == 'none' && $atts['shape'] != 'none' ) {
			if ( $atts['shape_type'] == 'button' ) {
				$divStyles[] = 'box-shadow: inset 0 -5px 0 rgba(0, 0, 0, 0.2)';
			} else if ( $atts['shape_type'] == 'thin-border' ) {
				$divStyles[] = 'background-color: transparent';
				$divStyles[] = 'box-shadow: inset 0 0 0 2px ' . $atts['shape_color'];
			} else if ( $atts['shape_type'] == 'thick-border' ) {
				$divStyles[] = 'background-color: transparent';
				$divStyles[] = 'box-shadow: inset 0 0 0 4px ' . $atts['shape_color'];
			}

				// 'solid' => __( 'Normal, solid background', GAMBIT_VC_4K_ICONS ),
				// 'button' => __( 'Solid background with a dark bottom border', GAMBIT_VC_4K_ICONS ),
				// 'thin-border' => __( 'Thin bordered background', GAMBIT_VC_4K_ICONS ),
				// 'thick-border' => __( 'Thick bordered background', GAMBIT_VC_4K_ICONS ),
		}

		if ( $atts['hover_effect'] == 'solid-outline'
		     || $atts['hover_effect'] == 'fill-up'
		     || $atts['hover_effect'] == 'border-solid'
		     || $atts['hover_effect'] == 'border-thick' ) {
			$beforeStyles[] = 'background:' . $atts['shape_color'];
			// $afterStyles[] = 'background:' . $atts['shape_color'];
			$iconHoverStyles[] = 'color:' . $atts['shape_color'];
			$afterStyles[] = 'box-shadow: inset 0 0 0 3px ' . $atts['shape_color'];
		}
		if ( $atts['hover_effect'] == 'border-thick' ) {
			$beforeStyles[] = 'box-shadow: inset 0 0 0 4px ' . $atts['shape_color'];
		}

		$iconStyles[] = 'font-size:' . (int)$atts['icon_size'] . 'px';
		$iconStyles[] = 'line-height:' . (int)$atts['icon_size'] . 'px';
		$iconStyles[] = 'color:' . $atts['icon_color'];
		if ( $atts['hover_effect'] == 'fill-up'
		     || $atts['hover_effect'] == 'border-solid' ) {
			$iconStyles[] = 'color:' . $atts['shape_color'];
		}

		$containerStyles = array_filter( $containerStyles );
		$divStyles = array_filter( $divStyles );
		$beforeStyles = array_filter( $beforeStyles );
		$afterStyles = array_filter( $afterStyles );
		$iconStyles = array_filter( $iconStyles );
		$iconHoverStyles = array_filter( $iconHoverStyles );

		$divClasses[] = 'fourk-icon';
		$divClasses[] = $atts['shape'];
		$divClasses[] = $atts['hover_effect'];
		$divClasses[] = $atts['extra_class'];
		$divClasses = array_filter( $divClasses );

		/*
		 * Add styles
		 */

        global $iconContents;
        include( 'icons/icon-contents.php' );

		// Normal styles used for everything
        $cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );

        $iconFile =  RD_DIRECTORY . '/includes/4k-icons/icons/fonts/' . $cssFile;
		$iconFile = apply_filters( '4k_icon_font_pack_path', $iconFile, $cssFile );

		// Fix ligature icons (these are icons that use more than 1 symbol e.g. mono social icons)
		$ligatureStyle = '';
        if ( $cssFile == 'mn' ) {
            $ligatureStyle = '-webkit-font-feature-settings:"liga","dlig";-moz-font-feature-settings:"liga=1, dlig=1";-moz-font-feature-settings:"liga","dlig";-ms-font-feature-settings:"liga","dlig";-o-font-feature-settings:"liga","dlig";
                         	 font-feature-settings:"liga","dlig";
                        	 text-rendering:optimizeLegibility;';
        }

		$iconCode = '';
		if ( ! empty( $atts['icon'] ) ) {
			$iconCode = $iconContents[ $atts['icon'] ];
		}

		$ret .= "<style>
            @font-face {
            	font-family: '" . $cssFile . "';
            	src:url('" . $iconFile . ".eot');
            	src:url('" . $iconFile . ".eot?#iefix') format('embedded-opentype'),
            		url('" . $iconFile . ".woff') format('woff'),
            		url('" . $iconFile . ".ttf') format('truetype'),
            		url('" . $iconFile . ".svg#oi') format('svg');
            	font-weight: normal;
            	font-style: normal;
            }
            #fourk" . self::$iconId . " ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #fourk" . self::$iconId . " ." . $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
			#fourk" . self::$iconId . " { " . implode( ';', $containerStyles ) . " }
			#fourk" . self::$iconId . " .fourk-icon { " . implode( ';', $divStyles ) . " }
			#fourk" . self::$iconId . " .fourk-icon:before { " . implode( ';', $beforeStyles ) . " }
			#fourk" . self::$iconId . " .fourk-icon:after { " . implode( ';', $afterStyles ) . " }
			#fourk" . self::$iconId . " i { " . implode( ';', $iconStyles ) . " }
			#fourk" . self::$iconId . " .fourk-icon.hovered i { " . implode( ';', $iconHoverStyles ) . " }
			#fourk" . self::$iconId . " i { text-align: center; }";


		// Additional styles for the flip effect (flip effect adds a new element)
		if ( stripos( $atts['hover_effect'], 'flip-' ) !== false ) {
			$axis = 'X';
			if ( $atts['hover_effect'] == 'flip-horizontal' ) {
				$axis = 'Y';
			}
			$ret .= "#fourk" . self::$iconId . " .back {
				-webkit-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(180deg);
				   -moz-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(180deg);
				    -ms-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(180deg);
				     -o-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(180deg);
				        transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(180deg);
			} #fourk" . self::$iconId . " .back i {
				color: {$atts['shape_color']};
			} #fourk" . self::$iconId . " .back {
				" . implode( ';', $divStyles ) . ";
				background-color: {$atts['icon_color']};
			} #fourk" . self::$iconId . " .hovered + .back {
				-webkit-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(0deg);
				   -moz-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(0deg);
				    -ms-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(0deg);
				     -o-transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(0deg);
				        transform: translateX(-" . ( (int)$atts['shape_size'] / 2 ) . "px) rotate{$axis}(0deg);
			}";
			$divClasses[] = 'front';
		} else if ( stripos( $atts['hover_effect'], 'swipe-' ) !== false ) {
			$translate = 'X';
			$translateOffset = 'Y';
			if ( $atts['hover_effect'] == 'swipe-up' || $atts['hover_effect'] == 'swipe-down' ) {
				$translate = 'Y';
				$translateOffset = 'X';
			}
			$negate = '';
			$iconNegate = '-';
			if ( $atts['hover_effect'] == 'swipe-right' || $atts['hover_effect'] == 'swipe-down' ) {
				$negate = '-';
				$iconNegate = '';
			}
			$ret .= "#fourk" . self::$iconId . " .swipe {
				" . implode( ';', $divStyles ) . ";
				background-color: {$atts['icon_color']};
				width: " . (int)$atts['shape_size'] . "px;
				height:" . (int)$atts['icon_size'] . "px;
			} #fourk" . self::$iconId . " .swipe i {
				color: {$atts['shape_color']};
			} #fourk" . self::$iconId . " .swipe {
				-webkit-transform: translate{$translate}({$negate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				   -moz-transform: translate{$translate}({$negate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				    -ms-transform: translate{$translate}({$negate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				     -o-transform: translate{$translate}({$negate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				        transform: translate{$translate}({$negate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				opacity: 0;
			} #fourk" . self::$iconId . " .hovered .swipe {
				-webkit-transform: translate{$translate}(0);
				   -moz-transform: translate{$translate}(0);
				    -ms-transform: translate{$translate}(0);
				     -o-transform: translate{$translate}(0);
				        transform: translate{$translate}(0);
				opacity: 1;
			} #fourk" . self::$iconId . " .hovered > i {
				-webkit-transform: translate{$translate}({$iconNegate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				   -moz-transform: translate{$translate}({$iconNegate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				    -ms-transform: translate{$translate}({$iconNegate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				     -o-transform: translate{$translate}({$iconNegate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
				        transform: translate{$translate}({$iconNegate}" . ( (int)$atts['shape_size'] * .99 ) . "px);
			}";

			// prevent edge bleed through
			$ret .= "#fourk" . self::$iconId . " .fourk-icon.hovered {
				background: {$atts['icon_color']} !important;
				-webkit-transition-delay: .3s;
				   -moz-transition-delay: .3s;
				    -ms-transition-delay: .3s;
				     -o-transition-delay: .3s;
				        transition-delay: .3s;
			} #fourk" . self::$iconId . " .fourk-icon {
				-webkit-transition-duration: 0s;
				   -moz-transition-duration: 0s;
				    -ms-transition-duration: 0s;
				     -o-transition-duration: 0s;
				        transition-duration: 0s;
			}";
		} else if ( $atts['hover_effect'] == 'fill-up' ) {
			$ret .= "#fourk" . self::$iconId . " .fourk-icon:before {
				-webkit-transform: translateY(" . ( (int)$atts['shape_size'] * .99 ) . "px);
				   -moz-transform: translateY(" . ( (int)$atts['shape_size'] * .99 ) . "px);
				    -ms-transform: translateY(" . ( (int)$atts['shape_size'] * .99 ) . "px);
				     -o-transform: translateY(" . ( (int)$atts['shape_size'] * .99 ) . "px);
				        transform: translateY(" . ( (int)$atts['shape_size'] * .99 ) . "px);
				border-radius: 0;
			} #fourk" . self::$iconId . " .fourk-icon.hovered:before {
				-webkit-transform: translateY(0);
				   -moz-transform: translateY(0);
				    -ms-transform: translateY(0);
				     -o-transform: translateY(0);
				        transform: translateY(0);
			} #fourk" . self::$iconId . " .fourk-icon.hovered i {
				color: {$atts['icon_color']};
			}";
		} else if ( $atts['hover_effect'] == 'border-solid' ) {
			$ret .= "#fourk" . self::$iconId . " .fourk-icon.hovered:after {
				box-shadow: inset 0 0 0 " . ( (int)$atts['shape_size'] / 1.9 ) . "px " . $atts['shape_color'] . ";
			} #fourk" . self::$iconId . " .fourk-icon.hovered i {
				color: {$atts['icon_color']};
			}";
		}

		// Floats & margins
		if ( $atts['float'] != 'none' ) {
			$margin = 'right';
			if ( $atts['float'] == 'right' ) {
				$margin = 'left';
			}
			$ret .= "#fourk" . self::$iconId . " {
				float: {$atts['float']};
				margin-{$margin}: {$atts['margin']}px;
			}";
		} else {
			$ret .= "#fourk" . self::$iconId . " {
				margin-bottom: {$atts['margin']}px;
			}";
		}

		// Overflow
		if ( $atts['overflow_next'] == 'overflow' ) {
			$ret .= "#fourk" . self::$iconId . " + * {
				overflow: hidden;
			}";
		}

		// Link
		if ( ! empty( $atts['link'] ) ) {
			$ret .= "#fourk" . self::$iconId . " .fourk-icon, #fourk" . self::$iconId . " .fourk-icon + * {
				cursor: pointer;
			}";
		}

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";

		/*
		 * Link
		 */
		if ( ! empty( $atts['link'] ) ) {
			$target = '_self';
			if ( $atts['link_new_window'] == 'new_window' ) {
				$target = '_blank';
			}
			$ret .= "<script>
				jQuery(document).ready(function(\$) {
					'use strict';
					\$('#fourk" . self::$iconId . " .fourk-icon, #fourk" . self::$iconId . " .fourk-icon + *').click(function() {
						window.open('" . esc_url( $atts['link'] ) . "', '" . $target . "');
					});
				})
			</script>";
		}


		/*
		 * Add the necessary html
		 */

		$ret .= "<div id='fourk" . self::$iconId . "' class='fourk-icon-container'>";

		// Put everything in a container for the flip effect
		if ( stripos( $atts['hover_effect'], 'flip-' ) !== false ) {
			$ret .= "<div class='fourk-flip-container'>";
		}

		$ret .= "<div class='" . implode( ' ', $divClasses ) . "' data-hover-trigger='" . $atts['hover_on'] . "' " . implode( ' ', $dataAttributes ) . ">";

		$ret .= "<i class='" . $atts['icon'] . "'></i>";

		if ( stripos( $atts['hover_effect'], 'swipe-' ) !== false ) {
			$ret .= "<div class='swipe'><i class='" . $atts['icon'] . "'></i></div>";
		}

		$ret .= "</div>";

		// Add a new element for the flip effect
		if ( stripos( $atts['hover_effect'], 'flip-' ) !== false ) {
			$ret .= "<div class='back'><i class='" . $atts['icon'] . "'></i></div>";
			$ret .= "</div>";
		}

		$ret .= "</div>";

		self::$iconId++;

		return $ret;
	}

	private function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return $rgb; // returns an array with the rgb values
	}
}
new FourKIconShortcode();
