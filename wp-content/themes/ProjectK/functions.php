<?php  
define('RD_FILEPATH', get_template_directory());
define('RD_DIRECTORY', get_template_directory_uri());
define('RD_STYLEPATH', get_stylesheet_directory_uri());
define("THEMESHORT", 'thefox');


////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////              THEME MAIN SETTINGS                ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////



// WooCommerce HOOKS
function rd_check_woo_status() {
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('woocommerce/woocommerce.php')) {
 return true;	
}
else{
	return false;
}
}
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


// Visual Composer HOOKS
function rd_check_vc_status() {
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('js_composer/js_composer.php')) {
 return true;
 	
}
else{
	return false;
}
}

// Revolution slider HOOKS
function rd_check_rev_status() {
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('revslider/revslider.php')) {
 return true;
 	
}
else{
	return false;
}
}

// WPML slider HOOKS
function rd_check_wpml_status() {
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('sitepress-multilingual-cms/sitepress.php')) {
 return true;
 	
}
else{
	return false;
}
}





// Add Localization



$lang = apply_filters('thefoxwp', get_template_directory()  . '/lang');
load_theme_textdomain('thefoxwp', $lang);
require get_template_directory()  . '/admin/admin-init.php';



// Loads the Options Panel 
require_once ('admin/admin-init.php');


// Load all required script and style
function rd_style(){	

	    global $rd_data;
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'googlefonts', "$protocol://fonts.googleapis.com/css?family=Lato:100,300,400,600,700,900|Raleway:900|Playfair+Display|' rel='stylesheet' type='text/css" );
//seperate style file in two for IE style limit.
	    wp_enqueue_style('style', RD_STYLEPATH. '/style.css');
	    wp_enqueue_style('style_end', RD_DIRECTORY. '/style_end.css');
if( rd_check_woo_status() == true) {
		define( 'WOOCOMMERCE_USE_CSS', false );
		if ($rd_data['rd_shop_design']== 'classic'){
		wp_enqueue_style( 'rd_woocommerce', RD_DIRECTORY. '/css/woocommerce.css');
		}
		else{
		wp_enqueue_style( 'rd_woocommerce', RD_DIRECTORY. '/css/woocommerce_trending.css');	
		}
}

    if($rd_data['rd_responsive']== true){
	if ($rd_data['rd_nav_type'] !== 'nav_type_19' && $rd_data['rd_nav_type'] !== 'nav_type_19_f' ){	
	    wp_enqueue_style('media-queries',  RD_DIRECTORY. '/media-queries_wide.css');
	}
	else {
	    wp_enqueue_style('media-queries',  RD_DIRECTORY. '/media-queries_edge_nav.css');		
	}
	}
	    wp_enqueue_style('rgs',  RD_DIRECTORY. '/css/rgs.css');
	    wp_enqueue_style('css3_animations',  RD_DIRECTORY. '/css/animations.css');
	    wp_enqueue_style('flexslidercss',  RD_DIRECTORY. '/includes/Flexslider/flexslider.css');    
		wp_enqueue_style('font-awesome-thefox',  RD_DIRECTORY. '/css/font-awesome.css');    
		wp_enqueue_style('moon',  RD_DIRECTORY. '/css/moon.css');    
		wp_enqueue_style('elegant',  RD_DIRECTORY. '/css/elegant.css');
	    wp_enqueue_style('prettyphotocss',  RD_DIRECTORY. '/includes/prettyPhoto/css/prettyPhoto.css');  
		wp_enqueue_style('js_frontend',  RD_DIRECTORY. '/css/thefox_js_composer.css');   
		include_once(ABSPATH.'wp-admin/includes/plugin.php');
}

if ( !is_admin() ) add_action('wp_enqueue_scripts', 'rd_style');

function rd_scripts(){
		global $rd_data;
	    if ( !is_admin() ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'loader', RD_DIRECTORY. '/js/pre-loader.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'customjs', RD_DIRECTORY. '/js/customjs.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'flexslider', RD_DIRECTORY.'/includes/Flexslider/jquery.flexslider.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easing', RD_DIRECTORY.'/js/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'transit', RD_DIRECTORY.'/js/jquery.transit.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids',  RD_DIRECTORY.'/js/jquery.fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyPhoto',  RD_DIRECTORY.'/includes/prettyPhoto/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'superfish',  RD_DIRECTORY.'/js/superfish.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints',  RD_DIRECTORY.'/js/waypoints.js', array( 'jquery' ), false, true );		
		wp_enqueue_script( 'carousel',  RD_DIRECTORY.'/js/jcarousel.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countTo',  RD_DIRECTORY.'/js/countTo.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'tiptip',  RD_DIRECTORY.'/js/jquery.tipTip.js', array( 'jquery' ), false, true );		
		wp_enqueue_script( 'rd_woocommerce',  RD_DIRECTORY.'/js/custom_woo_js.js', array( 'jquery' ), false, true );	
	if($rd_data['rd_smooth_scroll']== true){
		wp_enqueue_script( 'smoothscroll',  RD_DIRECTORY.'/js/smoothscroll.js', array( 'jquery' ), false, true );
		}
	if( rd_check_woo_status() == true) {	
		wp_enqueue_script( 'slick',  RD_DIRECTORY.'/js/slick.js', array( 'jquery' ), false, true );
		}
	if ( is_single() ) {
		wp_enqueue_script( 'comment-reply',  RD_DIRECTORY.'/js/comment-reply.js', array( 'jquery' ), false, true );
		}
	}
}
add_action( 'init', 'rd_scripts' ); //Load All Scripts
if ( !is_admin() ) add_action('wp_enqueue_scripts', 'rd_scripts');


function rd_admin_styles() {
		wp_enqueue_style( 'rd_back_end', RD_DIRECTORY.'/css/thefox_backend.css');
		wp_enqueue_script('menu_iconselector', RD_DIRECTORY . '/includes/4k-icons/js/script-vc-ck-mm.js'  );
		wp_enqueue_script('menu_iconselector_alt', RD_DIRECTORY . '/includes/4k-icons/js/script-vc-mm.js'  );
}  

add_action( 'admin_enqueue_scripts', 'rd_admin_styles' );



////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////              Load the included plugins          ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////


// Add Multiple sidebars plugin
include_once('includes/m_s/multiple_sidebars.php');

// Add Pricing table plugin 
include("includes/pricetable/pricetable.php");

/* Add Page builder 
include_once('includes/page-builder/pb_loader.php');
*/
// Add Metaboxes 
include_once('includes/metaboxes/metaboxes.php');

// Add Google fonts array for theme options 
require_once("includes/google-fonts/fonts.php");


// Add Simple mega menu option 
require_once("includes/rd_mega_menu/rd_mega_menu.php");


// Include Like plugin
include("includes/zilla-likes/zilla-likes.php");

// Include featured galleries plugin
include("includes/featured-galleries/featured-galleries.php");

// Include 4k Icon plugin
include("includes/4k-icons/4k-vc-icon-shortcode.php");
include("includes/4k-icons/icons/4k-icons-pack01/4k-icon-pack.php");
include("includes/4k-icons/icons/4k-icons-pack02/4k-icon-pack.php");
include("includes/4k-icons/icons/4k-icons-pack03/4k-icon-pack.php");
include("includes/4k-icons/icons/4k-icons-pack04/4k-icon-pack.php");
include("includes/4k-icons/icons/4k-icons-pack05/4k-icon-pack.php");





// Add code plugin for Tinymce 


require_once (RD_FILEPATH . '/tinymce/tinymce.loader.php');
function rd_mce_external_plugins($plugins) {   

    $plugins['code'] = RD_DIRECTORY. '/tinymce/js/plugin.min.js';
    return $plugins;
}
add_filter('mce_external_plugins', 'rd_mce_external_plugins');

/**/




////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////         Load the theme custom functions         ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////


// Load theme functions 
require_once (RD_FILEPATH . '/functions/theme-functions.php');

// Load ajax script needed for blog and portfolio 
require_once("functions/ajax-handlers.php");

// Load the Shortcodes 
include("functions/theme-shortcodes.php");

// Custom page Navigation system 
include("functions/rd_theme_functions/rd-custom-navigation.php");

// Custom comments system 
include("functions/rd_theme_functions/rd-custom-comments.php");

// Custom breadcrumbs 
include("functions/rd_theme_functions/rd-custom-breadcrumbs.php");

// Custom child pages 
include("functions/rd_theme_functions/rd-child-pages.php");

// Custom excerpt 
include("functions/rd_theme_functions/rd-custom-excerpt.php");

// Check if Mobile
include("functions/rd_theme_functions/rd-check-mobile.php");

// Calculate colors 
include("functions/rd_theme_functions/rd-color.php");

// Create share icons 
include("functions/rd_theme_functions/rd-share-panel.php");

// Create social icons 
include("functions/rd_theme_functions/rd-social-icons.php");

// Find related post
include("functions/rd_theme_functions/rd-related-post.php");

// Create share icons 
include("functions/rd_theme_functions/rd-randomstring.php");

// Include Woocommerce custom functions 
if( rd_check_woo_status() == true) {
if ($rd_data['rd_shop_design']== 'classic'){
include("functions/woocommerce-functions.php");
}
else{
include("functions/woocommerce-functions-trending.php");
}
}

// Include Revolution slider custom functions 
if( rd_check_rev_status() == true) {
if(function_exists( 'set_revslider_as_theme' )){
add_action( 'init', 'rd_custom_function_name' );
function rd_custom_function_name() {
 set_revslider_as_theme();
}
}	
	
include("functions/revslider-functions.php");
}


// Include Visual composer custom functions 
if( rd_check_vc_status() == true) {
include("functions/vc-functions.php"); 
add_action('wp_enqueue_scripts', 'rd_js_dequeue_function');

function rd_js_dequeue_function() {
    wp_dequeue_style( array('js_composer_front', 'js_composer_front-css') );
    wp_deregister_style( array('js_composer_front', 'js_composer_front-css') );
}

}



////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////         Load the theme custom widgets           ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////


// Add the Latest Tweets Custom Widget 

include("functions/widget-tweets.php");

// Add the Latest Blogposts Custom Widgets 

include("functions/rd_widget/widget-s-blogposts.php");
include("functions/rd_widget/widget-blogposts.php");

// Add the Latest Portfolio Custom Widgets 

include("functions/rd_widget/widget-s-portfolio.php");
include("functions/rd_widget/widget-portfolio.php");

// Add the Sponsors Custom Widgets 

include("functions/rd_widget/widget-sponsors.php");

// Add the Social Icons Custom Widgets 

include("functions/rd_widget/widget-social-icons.php");

// Add the Google map Custom Widget 

include("functions/rd_widget/gmaps.php");














////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   Register : Sidebar / Plugins / Menu / Posts   ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////




    if(function_exists('register_sidebar')){  

        register_sidebar(array('name' => 'Sidebar',
			'id' => 'thefox_mc_sidebar',
            'before_widget' => '<div id="%1$s" class="sb_widget  %2$s">',  
            'after_widget' => '</div>',  
            'before_title' => '<h3>',  
            'after_title' => '</h3>',  
        ));  

        register_sidebar(array('name' => 'Footer 1 Column',
			'id' => 'thefox_fs_col1',  
            'before_widget' => '<div class="widget %2$s">',  
            'after_widget' => '</div>',  
            'before_title' => '<h2>',  
            'after_title' => '</h2><div class="sc_small_line widget_line"><span class="small_l_left"></span></div>',  
        ));
        register_sidebar(array('name' => 'Footer 2 Column',  
			'id' => 'thefox_fs_col2',  
            'before_widget' => '<div class="widget %2$s">',  
            'after_widget' => '</div>',  
            'before_title' => '<h2>',  
            'after_title' => '</h2><div class="sc_small_line widget_line"><span class="small_l_left"></span></div>',  
        ));
        register_sidebar(array('name' => 'Footer 3 Column',  
			'id' => 'thefox_fs_col3',  
            'before_widget' => '<div class="widget %2$s">',  
            'after_widget' => '</div>',  
            'before_title' => '<h2>',  
            'after_title' => '</h2><div class="sc_small_line widget_line"><span class="small_l_left"></span></div>',  
        ));
        register_sidebar(array('name' => 'Footer 4 Column',  
			'id' => 'thefox_fs_col4',  
            'before_widget' => '<div class="widget %2$s">',  
            'after_widget' => '</div>',  
            'before_title' => '<h2>',  
            'after_title' => '</h2><div class="sc_small_line widget_line"><span class="small_l_left"></span></div>',  
        ));

    if(rd_check_woo_status() == true){  

        register_sidebar(array('name' => 'Shop sidebar',  
			'id' => 'thefox_shop_sidebar',  
            'before_widget' => '<div id="%1$s" class="sb_widget %2$s" >',  
            'after_widget' => '</div>',  
            'before_title' => '<h3>',  
            'after_title' => '</h3>',  
    	    ));  
		}
    }  



//  Auto plugin activation 
require_once(TEMPLATEPATH.'/includes/class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'rd_register_required_plugins');

function rd_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'TheFox Custom Post', // The plugin name
			'slug'     				=> 'thefox_cp', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/thefox_cp.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'LayerSlider WP', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/layerslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Contact form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/contact-form-7.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Wp User Avatar', // The plugin name
			'slug'     				=> 'wp-user-avatar', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/plugins/wp-user-avatar.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
	);

	$config = array(
		'domain'       		=> 'thefoxwp',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'thefoxwp' ),
			'menu_title'                       			=> __( 'Install Plugins', 'thefoxwp' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'thefoxwp' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'thefoxwp' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'thefoxwp' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'thefoxwp' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'thefoxwp' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa($plugins, $config);
}


// Add class to next post and previous post link 
add_filter('next_posts_link_attributes', 'rd_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'rd_posts_link_attributes');

function rd_posts_link_attributes(){
    return 'class="entries"';
}


//	Registering WP3.0+ Custom Menu 
function rd_register_menu() {
	register_nav_menu('top-bar', __('Top Bar Menu','thefoxwp'));	
	register_nav_menu('main-menu', __('Main Menu','thefoxwp'));	
	register_nav_menu('one-page-menu', __('One page Menu','thefoxwp'));
	register_nav_menu('footer-menu', __('Footer Menu','thefoxwp'));
}

add_action('init', 'rd_register_menu');

// Thumbnails setting 

include("includes/otf_regen_thumbs.php");

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	
	add_image_size ('portfolio_tn', 640 , 400 , true);
	add_image_size ('portfolio_classic', 800 , 380 , true);
	add_image_size ('portfolio_squared', 768 , 768 , true);
	add_image_size ('portfolio_landscape', 768 , 384 , true);
	add_image_size ('portfolio_portrait', 384 , 768 , true);
	add_image_size ('staff_tn', 570	 , 570 , true);
	add_image_size ('blog_tn', 850 , 400 , true);	
	add_image_size ('blog_tn_alt', 553 , 400 , true);		
	add_theme_support( 'automatic-feed-links' );
}

if ( ! isset( $content_width ) ) $content_width = 1170;
function rd_sgr_display_image_size_names_muploader( $sizes ) {
    $new_sizes = array();
    $added_sizes = get_intermediate_image_sizes();
    // $added_sizes is an indexed array, therefore need to convert it
    // to associative array, using $value for $key and $value
    foreach( $added_sizes as $key => $value) {
        $new_sizes[$value] = $value;
    }
    // This preserves the labels in $sizes, and merges the two arrays
   $new_sizes = array_merge( $new_sizes, $sizes );
   return $new_sizes;
}

add_filter('image_size_names_choose', 'rd_sgr_display_image_size_names_muploader', 11, 1);


class rd_ThumbnailUpscaler
{

	static function rd_image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop)
	{
	    if(!$crop)
	    	return null; 
	
	    $aspect_ratio = $orig_w / $orig_h;
	    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
	
	    $crop_w = round($new_w / $size_ratio);
	    $crop_h = round($new_h / $size_ratio);
	
	    $s_x = floor( ($orig_w - $crop_w) / 2 );
	    $s_y = floor( ($orig_h - $crop_h) / 2 );
	
	    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
}

add_filter('image_resize_dimensions', array('rd_ThumbnailUpscaler', 'rd_image_crop_dimensions'), 10, 6);


//add post format options
add_theme_support( 'post-formats', array( 'quote', 'gallery','video','image','audio' ) );


#Get all staff member postion inline
function rd_showstaffposition($postid = "")
	{
    if (!isset($term_list)) {
		$term_list = '';
    }
    global $rd_data;
    $permalink = get_permalink();
    $args = array('taxonomy' => 'staffposition');
    $terms = get_terms('staffposition', $args);
    $count = count($terms);
    $i = 0;
    $iterm = 1;
    if ($count > 0) {
        if (!isset($_GET['slug'])) $all_current = 'selected';
        $cape_list = '';
        $term_list .= '<li class="' . $all_current . '">';
        $term_list .= '<a href="#filter" data-option-value="*">'. __('All', 'thefoxwp') .'</a>
		</li>';
        $termcount = count($terms) ;
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $i++;
                $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                $term_list .= '<li ';
                if (isset($_GET['slug'])) {
                    $getslug = $_GET['slug'];
                } else {
                    $getslug = '';
                }
                if (strnatcasecmp($getslug, $term->name) == 0) $term_list .= 'class="selected"';
                $tempname = strtr($term->name, array(
                    ' ' => '-',
                ));
                $tempname = strtolower($tempname);
                $term_list .= '><a href="#filter" data-option-value=".sf_' . $tempname . '" title="' . sprintf(__('View all post filed under %s', 'thefoxwp'), $term->name) . '">' . $term->name . '</a>
                </li>';
                if ($count != $i) $term_list .= ' '; else $term_list .= '';
                if ($iterm<$termcount) {$term_list .= '';}
                $iterm++;
            }
        }
        echo '<ul class="staffoptionset" data-option-key="filter">' . $term_list . '</ul>';
    }
}

#Get all portfolio category inline

function rd_showPortCategory($postid = "")
	{
    if (!isset($term_list)) {
		$term_list = '';
    }
    global $rd_data;
    $permalink = get_permalink();
    $args = array('taxonomy' => 'tagportfolio');
    $terms = get_terms('tagportfolio', $args);
    $count = count($terms);
    $i = 0;
    $iterm = 1;
    if ($count > 0) {
        if (!isset($_GET['slug'])) $all_current = 'selected';
        $cape_list = '';
        $term_list .= '<li class="' . $all_current . '">';
        $term_list .= '<a href="#filter" data-option-value="*">'. __('All', 'thefoxwp') .'</a>
		</li>';
        $termcount = count($terms) ;
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $i++;
                $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                $term_list .= '<li ';
                if (isset($_GET['slug'])) {
                    $getslug = $_GET['slug'];
                } else {
                    $getslug = '';
                }
                if (strnatcasecmp($getslug, $term->name) == 0) $term_list .= 'class="selected"';
                $tempname = strtr($term->name, array(
                    ' ' => '-',
                ));
                $tempname = strtolower($tempname);
                $term_list .= '><a href="#filter" data-option-value=".' . $tempname . '" title="' . sprintf(__('View all post filed under %s', 'thefoxwp'), $term->name) . '">' . $term->name . '</a>
                </li>';
                if ($count != $i) $term_list .= ' '; else $term_list .= '';
                if ($iterm<$termcount) {$term_list .= '';}
                $iterm++;
            }
        }
        echo '<ul class="optionset" data-option-key="filter">' . $term_list . '</ul>';
    }
}

#set title output

function thefox_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'thefoxwp' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'thefox_wp_title', 10, 2 );

?>