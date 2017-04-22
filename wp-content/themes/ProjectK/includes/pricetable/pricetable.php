<?php



/*

Plugin Name: Price Table

Plugin URI: http://siteorigin.com/pricetable-wordpress-plugin

Description: Creates a price table custom post type with a drag and drop builder. Based on the dashing price table design by Orman Clark

Author: Greg Priday

Version: 0.2.2

Author URI: http://siteorigin.com/

License: GPL

*/



define('PRICETABLE_FEATURED_WEIGHT', 1);

define('PRICETABLE_VERSION', '0.2.2');



/**

 * Activate the pricetable plugin

 */

function siteorigin_pricetable_activate(){

	// Flush rules so we can view price table pages

	flush_rewrite_rules();

	

	delete_option('siteorigin_pricetable_welcome');

}

register_activation_hook(__FILE__, 'siteorigin_pricetable_activate');



/**

 * Deactivate the pricetable plugin

 */

function siteorigin_pricetable_deactivate(){

	delete_option('siteorigin_pricetable_welcome');

}

register_deactivation_hook(__FILE__, 'siteorigin_pricetable_deactivate');






/**

 * Check if we need to redirect the user to the welcome page

 */

function siteorigin_pricetable_display_welcome(){

	if(get_option('siteorigin_pricetable_welcome', false) === false && isset($page) && @$_GET['page'] != 'pricetable-welcome' && current_user_can('manage_options')){

		

	}

}

add_action('admin_init', 'siteorigin_pricetable_display_welcome');



/**

 * Add custom columns to pricetable post list in the admin

 * @param $cols

 * @return array

 */

function siteorigin_pricetable_register_custom_columns($cols){

	unset($cols['title']);

	unset($cols['date']);

	

	$cols['title'] = __('Title', 'thefoxwp');

	$cols['options'] = __('Options', 'thefoxwp');

	$cols['features'] = __('Features', 'thefoxwp');

	$cols['featured'] = __('Featured Option', 'thefoxwp');

	$cols['date'] = __('Date', 'thefoxwp');

	return $cols;

}

add_filter( 'manage_pricetable_posts_columns', 'siteorigin_pricetable_register_custom_columns');



/**

 * Render the contents of the admin columns

 * @param $column_name

 */

function siteorigin_pricetable_custom_column($column_name){

	global $post;

	switch($column_name){

	case 'options' :

		$table = get_post_meta($post->ID, 'price_table', true);

		print count($table);

		break;

	case 'features' :

	case 'featured' :

		$table = get_post_meta($post->ID, 'price_table', true);

		foreach((array)$table as $col){

		if(!empty($col['featured']) && $col['featured'] == 'true'){

			if($column_name == 'featured') print $col['title'];

			else print count($col['features']);

			break;

		}

		}

		break;

	}

}

add_action( 'manage_pricetable_posts_custom_column', 'siteorigin_pricetable_custom_column');





/**

 * Enqueue the pricetable scripts

 */

function siteorigin_pricetable_scripts(){

	global $post, $pricetable_queued, $pricetable_displayed;

	if(is_singular() && (($post->post_type == 'pricetable') || ($post->post_type != 'pricetable' && preg_match( '#\[ *price_table([^\]])*\]#i', $post->post_content ))) || !empty($pricetable_displayed)){

		$pricetable_queued = true;

	}

}

add_action('wp_enqueue_scripts', 'siteorigin_pricetable_scripts');



/**

 * Add administration scripts

 * @param $page

 */

function siteorigin_pricetable_admin_scripts($page){

	if($page == 'post-new.php' || $page == 'post.php'){

		global $post;

		

		if(!empty($post) && $post->post_type == 'pricetable'){

			// Scripts for building the pricetable

			wp_enqueue_script('placeholder', get_template_directory_uri().'/includes/pricetable/js/placeholder.jquery.js', __FILE__, array('jquery'), '1.1.1', true);

			wp_enqueue_script('jquery-ui');

			wp_enqueue_script('pricetable-admin', get_template_directory_uri().'/includes/pricetable/js/pricetable.build.js', __FILE__, array('jquery'), PRICETABLE_VERSION, true);

			

			wp_localize_script('pricetable-admin', 'pt_messages', array(

				'delete_column' => __('Are you sure you want to delete this column?', 'thefoxwp'),

				'delete_feature' => __('Are you sure you want to delete this feature?', 'thefoxwp'),

			));

			

			wp_enqueue_style('pricetable-admin', get_template_directory_uri().'/includes/pricetable/css/pricetable.admin.css', __FILE__, array(), PRICETABLE_VERSION);

			wp_enqueue_style('pricetable-icon',  get_template_directory_uri().'/includes/pricetable/css/pricetable.icon.css', __FILE__, array(), PRICETABLE_VERSION);

			wp_enqueue_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css', array(), '1.7.0');

 wp_enqueue_style('pagebuilder', get_template_directory_uri() . '/includes/page-builder/css/pb.css');
		}

	}

	

	// The light weight CSS for changing the icon

	if(isset($post_type) && @$_GET['post_type'] == 'pricetable'){

		wp_enqueue_style('pricetable-icon', get_template_directory_uri().'/includes/pricetable/css/pricetable.icon.css', __FILE__, array(), PRICETABLE_VERSION);
		

	}

	

	if($page == 'pricetable_page_pricetable-welcome'){

		// Add the welcome CSS

		wp_enqueue_style('pricetable-admin',  get_template_directory_uri().'/includes/pricetable/css/welcome.css', __FILE__, array(), PRICETABLE_VERSION);

	}

}

add_action('admin_enqueue_scripts', 'siteorigin_pricetable_admin_scripts');



/**

 * Metaboxes because we're boss

 * 

 * @action add_meta_boxes

 */

function siteorigin_pricetable_meta_boxes(){

	add_meta_box('pricetable', __('Price Table', 'thefoxwp'), 'siteorigin_pricetable_render_metabox', 'pricetable', 'normal', 'high');

	add_meta_box('pricetable-shortcode', __('Shortcode', 'thefoxwp'), 'siteorigin_pricetable_render_metabox_shortcode', 'pricetable', 'side', 'low');

}

add_action( 'add_meta_boxes', 'siteorigin_pricetable_meta_boxes' );



/**

 * Render the price table building interface

 * 

 * @param $post

 * @param $metabox

 */

function siteorigin_pricetable_render_metabox($post, $metabox){
	

	wp_nonce_field( plugin_basename( __FILE__ ), 'siteorigin_pricetable_nonce' );

	

	$table = get_post_meta($post->ID, 'price_table', true);

	if(empty($table)) {$table = array();}

	

	include(dirname(__FILE__).'/tpl/pricetable.build.phtml');

}



/**

 * Render the shortcode metabox

 * @param $post

 * @param $metabox

 */

function siteorigin_pricetable_render_metabox_shortcode($post, $metabox){

	?>

		<code>[price_table id=<?php print $post->ID ?>]</code>

		<small class="description"><?php _e('Displays price table on another page.', 'thefoxwp') ?></small>

	<?php

}



/**

 * Save the price table

 * @param $post_id

 * @return

 * 

 * @action save_post

 */

function siteorigin_pricetable_save($post_id){

	// Authorization, verification this is my vocation 



	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	if ( !current_user_can( 'edit_post', $post_id ) ) return;

	

	// Create the price table from the post variables

	$table = array();

	foreach($_POST as $name => $val){

		if(substr($name,0,6) == 'price_'){

			$parts = explode('_', $name);

			

			$i = intval($parts[1]);

			if(@$parts[2] == 'feature'){

				// Adding a feature

				$fi = intval($parts[3]);

				$fn = $parts[4];

				

				if(empty($table[$i]['features'])) $table[$i]['features'] = array();

				$table[$i]['features'][$fi][$fn] = $val;

			}

			elseif(isset($parts[2])){

				// Adding a field

				$table[$i][$parts[2]] = $val;

			}

		}

	}

	

	// Clean up the features

	foreach($table as $i => $col){

		if(empty($col['features'])) continue;

		

		foreach($col['features'] as $fi => $feature){

			if(empty($feature['title']) && empty($feature['sub']) && empty($feature['description'])){

				unset($table[$i]['features'][$fi]);

			}

		}

		$table[$i]['features'] = array_values($table[$i]['features']);

	}

	

	if(isset($_POST['price_recommend'])){

		$table[intval($_POST['price_recommend'])]['featured'] = 'true';

	}

	



	

	update_post_meta($post_id,'price_table', $table);

}

add_action( 'save_post', 'siteorigin_pricetable_save' );



/**

 * The price table shortcode.

 * @param array $atts

 * @return string

 * 

 * 

 */

function siteorigin_pricetable_shortcode($atts = array()) {

	global $post, $pricetable_displayed;

	

	$pricetable_displayed = true;

	

	extract( shortcode_atts( array(

		'id' => null,

		'width' => 100,

	), $atts ) );

	

	if($id == null) $id = $post->ID;

	

	$table = get_post_meta($id , 'price_table', true);

	if(empty($table)) $table = array();

	

	// Set all the classes

	$featured_index = null;

	foreach($table as $i => $column) {

		$table[$i]['classes'] = array('pricetable-column');

		$table[$i]['classes'][] = (isset($table[$i]['featured']) && @$table[$i]['featured'] === 'true') ? 'pricetable-featured' : 'pricetable-standard';

		

		if(isset($table[$i]['featured']) && @$table[$i]['featured'] == 'true') $featured_index = $i;

		if(isset($table[$i+1]['featured']) && @$table[$i+1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-before-featured';

		if(isset($table[$i-1]['featured']) && @$table[$i-1]['featured'] == 'true') $table[$i]['classes'][] = 'pricetable-after-featured';

	}

	$table[0]['classes'][] = 'pricetable-first';

	$table[count($table)-1]['classes'][] = 'pricetable-last';

	

	// Calculate the widths

	$width_total = 0;

	foreach($table as $i => $column){

		if(isset($column['featured']) && @$column['featured'] === 'true') $width_total += PRICETABLE_FEATURED_WEIGHT;

		else $width_total++;

	}

	$width_sum = 0;

	foreach($table as $i => $column){

		if(isset($column['featured']) && @$column['featured'] === 'true'){

			// The featured column takes any width left over after assigning to the normal columns

			$table[$i]['width'] = 100 - (floor(100/$width_total) * ($width_total-PRICETABLE_FEATURED_WEIGHT));

		}

		else{

			$table[$i]['width'] = floor(100/$width_total);

		}

		$width_sum += $table[$i]['width'];

	}

	

	// Create fillers

	if(!empty($table[0]['features'])){

		for($i = 0; $i < count($table[0]['features']); $i++){

			$has_title = false;

			$has_sub = false;

			

			foreach($table as $column){

				$has_title = ($has_title || !empty($column['features'][$i]['title']));

				$has_sub = ($has_sub || !empty($column['features'][$i]['sub']));

			}

			

			foreach($table as $j => $column){

				if($has_title && empty($table[$j]['features'][$i]['title'])) $table[$j]['features'][$i]['title'] = '&nbsp;';

				if($has_sub && empty($table[$j]['features'][$i]['sub'])) $table[$j]['features'][$i]['sub'] = '&nbsp;';

			}

		}

	}

	

	// Find the best pricetable file to use

	if(file_exists(get_stylesheet_directory().'/pricetable.php')) $template = get_stylesheet_directory().'/pricetable.php';

	elseif(file_exists(get_template_directory().'/pricetable.php')) $template = get_template_directory().'/pricetable.php'; 

	else $template = dirname(__FILE__).'/tpl/pricetable.phtml';

	

	// Render the pricetable

	ob_start();

	include($template);

	$pricetable = ob_get_clean();

	

	if($width != 100) $pricetable = '<div style="width:'.$width.'%; margin: 0 auto;">'.$pricetable.'</div>';

	

	$post->pricetable_inserted = true;

	

	return $pricetable;

}

add_shortcode( 'price_table', 'siteorigin_pricetable_shortcode' );



// Add the pricetable to the content.

function siteorigin_pricetable_the_content_filter($the_content){

	global $post;

	

	if(is_single() && $post->post_type == 'pricetable' && empty($post->pricetable_inserted)){

		$the_content = siteorigin_pricetable_shortcode().$the_content;

	}

	return $the_content;

}

// Filter the content after WordPress has had a chance to do shortcodes (priority 10)

add_filter('the_content', 'siteorigin_pricetable_the_content_filter',11);



// action wp_footer

 




// Render the welcome screen


function siteorigin_pricetable_render_welcome(){

	add_option('siteorigin_pricetable_welcome', true, null, 'no');

	

	$info = get_plugin_data(__FILE__);

	

	include(dirname(__FILE__).'/tpl/welcome.phtml');

}



// Add the welcome page to the admin menu


function siteorigin_pricetable_add_welcome(){

	add_theme_page(

		'edit.php?post_type=pricetable',

		__('Thanks for Installing Price Table', 'thefoxwp'),

		__('Welcome', 'thefoxwp'),

		'manage_options',

		'pricetable-welcome',

		'siteorigin_pricetable_render_welcome'

	);

}

add_action('admin_menu', 'siteorigin_pricetable_add_welcome');