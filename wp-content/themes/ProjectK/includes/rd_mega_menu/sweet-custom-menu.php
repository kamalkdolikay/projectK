<?php
/*
Plugin Name: Sweet Custom Menu
Plugin URL: http://remicorson.com/
Description: A little plugin to add attributes to WordPress menus
Version: 0.1
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
Text Domain: rc_scm
Domain Path: languages
*/

class rc_sweet_custom_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// load the plugin translation files
		add_action( 'init', array( $this, 'textdomain' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields_2' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'rc_scm_add_custom_nav_fields_3' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields'), 10, 3 );
		
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields_2'), 10, 3 );
		
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'rc_scm_update_custom_nav_fields_3'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'rc_scm_edit_walker'), 10, 2 );



	} // end constructor
	
	
	/**
	 * Load the plugin's text domain
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	public function textdomain() {
		load_plugin_textdomain( 'rc_scm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
	    return $menu_item;
	    
	}
	
	

	function rc_scm_add_custom_nav_fields_2( $menu_item ) {
	
	    $menu_item->megamenucol = get_post_meta( $menu_item->ID, '_menu_item_megamenucol', true );
	    return $menu_item;
	    
	}
	
	function rc_scm_add_custom_nav_fields_3( $menu_item ) {
	
	    $menu_item->megamenuheading = get_post_meta( $menu_item->ID, '_menu_item_megamenuheading', true );
	    return $menu_item;
	    
	}		
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
		
	    if(isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id]) && $_REQUEST['menu-item-megamenu'][$menu_item_db_id] !== ''){
	        $megamenu_value = $_REQUEST['menu-item-megamenu'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value  );
		}
		else{
			delete_post_meta ( $menu_item_db_id, '_menu_item_megamenu'  );
		}
	    
	    
	}

	function rc_scm_update_custom_nav_fields_2( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
		
		    if ( isset($_REQUEST['menu-item-megamenucol']) && is_array( $_REQUEST['menu-item-megamenucol']) ) {
	        $megamenucol_value = $_REQUEST['menu-item-megamenucol'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenucol', $megamenucol_value );
	    }
	    
	}


	function rc_scm_update_custom_nav_fields_3( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
		
	    if(isset($_REQUEST['menu-item-megamenuheading'][$menu_item_db_id]) && $_REQUEST['menu-item-megamenuheading'][$menu_item_db_id] !== ''){
	        $megamenu_value = $_REQUEST['menu-item-megamenuheading'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenuheading', $megamenu_value  );
		}
		else{
			delete_post_meta ( $menu_item_db_id, '_menu_item_megamenuheading'  );
		}
	    
	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function rc_scm_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}

// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new rc_sweet_custom_menu();


include_once( 'edit_custom_walker.php' );
include_once( 'custom_walker.php' );