<?php
class rd_tinymce
{
function __construct()
{
add_action('admin_init', array( &$this, 'rd_head' ));
add_action('init', array( &$this, 'rd_tinymce_rich_buttons' ));
add_action('admin_print_scripts', array( &$this, 'rd_quicktags'));
}
// --------------------------------------------------------------------------
function rd_head()
{
// css
wp_enqueue_style( 'rd-popup', RD_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
// js
wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'jquery-livequery', RD_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
wp_enqueue_script( 'jquery-appendo', RD_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
wp_enqueue_script( 'rd-popup', RD_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
}
// --------------------------------------------------------------------------
/**
* Registers TinyMCE rich editor buttons
*
* @return	void
*/
function rd_tinymce_rich_buttons()
{
if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
return;
if ( get_user_option('rich_editing') == 'true' )
{
add_filter( 'mce_external_plugins', array( &$this, 'rd_add_rich_plugins' ) );
add_filter( 'mce_buttons', array( &$this, 'rd_register_rich_buttons' ) );
}
}
// --------------------------------------------------------------------------
/**
* Defins TinyMCE rich editor js plugin
*
* @return	void
*/
function rd_add_rich_plugins( $plugin_array )
{
$plugin_array['rdShortcodes'] = RD_TINYMCE_URI . '/plugin.js';
return $plugin_array;
}
// --------------------------------------------------------------------------
/**
* Adds TinyMCE rich editor buttons
*
* @return	void
*/
function rd_register_rich_buttons( $buttons )
{
array_push( $buttons, "|", 'rd_button' );
return $buttons;
}
// --------------------------------------------------------------------------
/**
* Registers TinyMCE HTML editor quicktags buttons
*
* @return	void
*/
function rd_quicktags() {
}
}



?>