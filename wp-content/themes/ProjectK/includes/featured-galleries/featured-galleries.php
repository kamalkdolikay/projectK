<?php
/*
 * Plugin Name:       Featured Galleries
 * Plugin URI:        http://wordpress.org/plugins/featured-galleries/
 * Description:       WordPress ships with a Featured Image functionality. This adds a very similar functionality, but allows for full featured galleries with multiple images.
 * Version:           1.3.1
 * Author:            Andy Mercer
 * Author URI:        http://www.andymercer.net
 * Text Domain:       featured-galleries
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/


if(!defined('FG_BASE_DIR')) {
	define('FG_BASE_DIR', dirname(__FILE__));
}
if(!defined('FG_BASE_URL')) {
	define('FG_BASE_URL', plugin_dir_url(__FILE__));
}
if(!defined('FG_BASE_FILE')) {
	define('FG_BASE_FILE', __FILE__);
}

require_once(FG_BASE_DIR .'/components/enqueuing.php' );
require_once(FG_BASE_DIR .'/components/metabox.php' );
require_once(FG_BASE_DIR .'/components/ajax-update.php' );
require_once(FG_BASE_DIR .'/components/readmethods.php' );

add_action( 'add_meta_boxes', 'fg_register_metabox' );
add_action( 'save_post', 'fg_save_perm_metadata', 1, 2 );
add_action( 'admin_enqueue_scripts', 'fg_enqueue_stuff' );
add_action( 'wp_ajax_fg_update_temp', 'fg_update_temp' );

// Hook the textdomain in
add_action( 'plugins_loaded', 'fg_load_textdomain' );
function fg_load_textdomain() {
	load_plugin_textdomain( 'featured-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}