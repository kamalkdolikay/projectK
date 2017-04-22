<?php


/*
Plugin Name: TheFox Custom Post
Plugin URI: http://thefoxwp.com/
Description: Plugin that will create a custom post type Portfolio / Staff / Partners for TheFox WordPress Theme.
Version: 1.0
Author: Tranmautritam's Team
Author URI: http://themeforest.net/user/tranmautritam
License: GPLv2
*/


// Register custom staff post 
add_action('init', 'rd_staff_custom_init');

function rd_staff_custom_init(){
    $labels = array(
        'name' => _x('Staff', 'post type general name', 'thefoxwp'),
        'singular_name' => _x('Staff', 'post type singular name', 'thefoxwp'),
        'add_new' => _x('Add New', 'Staff' ,'thefoxwp'),
        'add_new_item' => __('Add New staff member', 'thefoxwp'),
        'edit_item' => __('Edit staff member', 'thefoxwp'),
        'new_item' => __('New staff member', 'thefoxwp'),
        'view_item' => __('View staff member', 'thefoxwp'),
        'search_items' => __('Search staff member', 'thefoxwp'),
        'not_found' => __('No staff member found', 'thefoxwp'),
        'not_found_in_trash' => __('No staff member found in Trash', 'thefoxwp'),
        'parent_item_colon' => '',
        'menu_name' => 'Staff Member'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "staff"),
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('Staff', $args);

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Groups', 'taxonomy general name', 'thefoxwp' ),
		'singular_name' => _x( 'Group', 'taxonomy singular name', 'thefoxwp' ),
		'search_items' =>  __( 'Search Groups', 'thefoxwp' ),
		'all_items' => __( 'All Groups', 'thefoxwp' ),
		'parent_item' => __( 'Parent Group', 'thefoxwp' ),
		'parent_item_colon' => __( 'Parent Group:', 'thefoxwp' ),
		'edit_item' => __( 'Edit Groups', 'thefoxwp' ),
		'update_item' => __( 'Update Group', 'thefoxwp' ),
		'add_new_item' => __( 'Add New Group', 'thefoxwp' ),
		'new_item_name' => __( 'New Group Name', 'thefoxwp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('staffgroups',array('staff'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'staff-group' ),
	  ));

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Filter Categories', 'taxonomy general name', 'thefoxwp' ),
		'singular_name' => _x( 'Filter Category', 'taxonomy singular name', 'thefoxwp' ),
		'search_items' =>  __( 'Search Filter Categories', 'thefoxwp' ),
		'all_items' => __( 'All Filter Categories', 'thefoxwp' ),
		'parent_item' => __( 'Parent Filter Category', 'thefoxwp' ),
		'parent_item_colon' => __( 'Parent Filter Category:', 'thefoxwp' ),
		'edit_item' => __( 'Edit Filter Categories', 'thefoxwp' ),
		'update_item' => __( 'Update Filter Category', 'thefoxwp' ),
		'add_new_item' => __( 'Add Filter Category', 'thefoxwp' ),
		'new_item_name' => __( 'New Filter Category', 'thefoxwp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('staffposition',array('staff'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'staff-position' ),
	  ));
	

}



// Register custom sponsor post 
add_action('init', 'rd_partners_custom_init');

function rd_partners_custom_init(){
    $labels = array(
        'name' => _x('Partners', 'post type general name', 'thefoxwp'),
        'singular_name' => _x('Partner', 'post type singular name', 'thefoxwp'),
        'add_new' => _x('Add New', 'partner', 'thefoxwp'),
        'add_new_item' => __('Add New Partner', 'thefoxwp'),
        'edit_item' => __('Edit Partner', 'thefoxwp'),
        'new_item' => __('New Partner', 'thefoxwp'),
        'view_item' => __('View Partner', 'thefoxwp'),
        'search_items' => __('Search Partners', 'thefoxwp'),
        'not_found' => __('No partners found', 'thefoxwp'),
        'not_found_in_trash' => __('No partners found in Trash', 'thefoxwp'),
        'parent_item_colon' => '',
        'menu_name' => 'Partners'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "partners"),
        'menu_position' => 5,
        'supports' => array('title','thumbnail')
	);
    register_post_type('partners', $args);

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Groups', 'taxonomy general name', 'thefoxwp' ),
		'singular_name' => _x( 'Group', 'taxonomy singular name', 'thefoxwp' ),
		'search_items' =>  __( 'Search Groups', 'thefoxwp' ),
		'all_items' => __( 'All Groups', 'thefoxwp' ),
		'parent_item' => __( 'Parent Group', 'thefoxwp' ),
		'parent_item_colon' => __( 'Parent Group:', 'thefoxwp' ),
		'edit_item' => __( 'Edit Groups', 'thefoxwp' ),
		'update_item' => __( 'Update Group', 'thefoxwp' ),
		'add_new_item' => __( 'Add New Group', 'thefoxwp' ),
		'new_item_name' => __( 'New Group Name', 'thefoxwp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('groups',array('partners'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'partners-group' ),
	  ));
	}


	// Custom Messages - rd_project_updated_messages
	add_filter('post_updated_messages', 'rd_partner_updated_messages');

	function rd_partner_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['partners'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Partner updated. <a href="%s">View partner</a>','thefoxwp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','thefoxwp'),
		3 => __('Custom field deleted.','thefoxwp'),
		4 => __('Partner updated.','thefoxwp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Partner restored to revision from %s','thefoxwp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Partner published. <a href="%s">View partner</a>','thefoxwp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Partner saved.','thefoxwp'),
		8 => sprintf( __('Partner submitted. <a target="_blank" href="%s">Preview partner</a>','thefoxwp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Partner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview partner</a>','thefoxwp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'thefoxwp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Partner draft updated. <a target="_blank" href="%s">Preview partner</a>','thefoxwp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}

	/*--- #end SECTION - rd_project_updated_messages ---*/
	/*--- Portfolio tags meta box ---*/

	add_action('admin_init','rd_partners_meta_init');

	function rd_partners_meta_init()
	{
		// add a meta box for wordpress 'project' type
		add_meta_box('partners_meta', 'Project Infos', 'rd_partners_meta_setup', 'Group', 'side', 'low');
		// add a callback function to save any data a user enters in
		add_action('save_post','rd_partners_meta_save');
	}

	function rd_partners_meta_setup(){
		global $post;
		?>
	  	<div class="partners_meta_control">
	    <label>URL</label>
	    <p>
	      <input type="text" name="_url" value="<?php echo get_post_meta($post->ID,'_url',TRUE); ?>" style="width: 100%;" />
	    </p>
	  </div>
	  <?php
		// create for validation
			echo '<input type="hidden" name="meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
		}

	function rd_partners_meta_save($post_id) 
	{
		// check nonce
		if (!isset($_POST['meta_noncename']) || !wp_verify_nonce($_POST['meta_noncename'], __FILE__)) {
		return $post_id;
		}
		// check capabilities
		if ('post' == $_POST['post_type']) {
		if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
		}
		} elseif (!current_user_can('edit_page', $post_id)) {
		return $post_id;
		}
		// exit on autosave
		if (defined('DOING_AUTOSAVE') == DOING_AUTOSAVE) {
		return $post_id;
		}
		if(isset($_POST['_url'])) 
		{
			update_post_meta($post_id, '_url', $_POST['_url']);

		} else { 
			delete_post_meta($post_id, '_url');
		}
	}


// Register custom portfolio post 
add_action('init', 'rd_portfolio_custom_init');  

function rd_portfolio_custom_init(){
	$labels = array(
		'name' => _x('Portfolio', 'post type general name', 'thefoxwp'),
		'singular_name' => _x('Project', 'post type singular name', 'thefoxwp'),
		'add_new' => _x('Add New', 'Project', 'thefoxwp'),
		'add_new_item' => __('Add New Project', 'thefoxwp'),
		'edit_item' => __('Edit Project', 'thefoxwp'),
		'new_item' => __('New Project', 'thefoxwp'),
		'view_item' => __('View Project', 'thefoxwp'),
		'search_items' => __('Search Projects', 'thefoxwp'),
		'not_found' =>  __('No projects found', 'thefoxwp'),
		'not_found_in_trash' => __('No projects found in Trash', 'thefoxwp'),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	  );

	 $args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array ("slug" => "project" ),
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail','comments')
	  );
	  register_post_type('portfolio',$args);

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Category', 'Category general name', 'thefoxwp' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'thefoxwp' ),
		'search_items' =>  __( 'Search Category', 'thefoxwp' ),
		'all_items' => __( 'All Categories', 'thefoxwp' ),
		'parent_item' => __( 'Parent Category', 'thefoxwp' ),
		'parent_item_colon' => __( 'Parent Category:', 'thefoxwp' ),
		'edit_item' => __( 'Edit Category', 'thefoxwp' ),
		'update_item' => __( 'Update Category', 'thefoxwp' ),
		'add_new_item' => __( 'Add New Category', 'thefoxwp' ),
		'new_item_name' => __( 'New Category Name', 'thefoxwp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('catportfolio',array('portfolio'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'cat-portifolio' ),
	  ));
	

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'thefoxwp' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'thefoxwp' ),
		'search_items' =>  __( 'Search Types', 'thefoxwp' ),
		'all_items' => __( 'All Tags', 'thefoxwp' ),
		'parent_item' => __( 'Parent Tag', 'thefoxwp' ),
		'parent_item_colon' => __( 'Parent Tag:', 'thefoxwp' ),
		'edit_item' => __( 'Edit Tags', 'thefoxwp' ),
		'update_item' => __( 'Update Tag', 'thefoxwp' ),
		'add_new_item' => __( 'Add New Tag', 'thefoxwp' ),
		'new_item_name' => __( 'New Tag Name', 'thefoxwp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('tagportfolio',array('portfolio'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tag-portifolio' ),
	  ));
	}


	// Custom Messages - rd_project_updated_messages
	add_filter('post_updated_messages', 'rd_project_updated_messages');

	function rd_project_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Project updated. <a href="%s">View project</a>','thefoxwp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','thefoxwp'),
		3 => __('Custom field deleted.','thefoxwp'),
		4 => __('Project updated.','thefoxwp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s','thefoxwp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>','thefoxwp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Project saved.','thefoxwp'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>','thefoxwp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>','thefoxwp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'thefoxwp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>','thefoxwp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}

	/*--- #end SECTION - rd_project_updated_messages ---*/
	/*--- Portfolio tags meta box ---*/

	add_action('admin_init','rd_portfolio_meta_init');

	function rd_portfolio_meta_init()
	{
		// add a meta box for wordpress 'project' type
		add_meta_box('portfolio_meta', 'Project Infos', 'rd_portfolio_meta_setup', 'project', 'side', 'low');
		// add a callback function to save any data a user enters in
		add_action('save_post','rd_portfolio_meta_save');
	}

	function rd_portfolio_meta_setup(){
		global $post;
		?>
	  	<div class="portfolio_meta_control">
	    <label>URL</label>
	    <p>
	      <input type="text" name="_url" value="<?php echo get_post_meta($post->ID,'_url',TRUE); ?>" style="width: 100%;" />
	    </p>
	  </div>
	  <?php
		// create for validation
			echo '<input type="hidden" name="meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
		}

	function rd_portfolio_meta_save($post_id) 
	{
		// check nonce
		if (!isset($_POST['meta_noncename']) || !wp_verify_nonce($_POST['meta_noncename'], __FILE__)) {
		return $post_id;
		}
		// check capabilities
		if ('post' == $_POST['post_type']) {
		if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
		}
		} elseif (!current_user_can('edit_page', $post_id)) {
		return $post_id;
		}
		// exit on autosave
		if (defined('DOING_AUTOSAVE') == DOING_AUTOSAVE) {
		return $post_id;
		}
		if(isset($_POST['_url'])) 
		{
			update_post_meta($post_id, '_url', $_POST['_url']);

		} else { 
			delete_post_meta($post_id, '_url');
		}
	}
	


/**

 * Register the price table post type

 */

function siteorigin_pricetable_register(){

	register_post_type('pricetable',array(

		'labels' => array(

			'name' => __('Price Tables', 'thefoxwp'),

			'singular_name' => __('Price Table', 'thefoxwp'),

			'add_new' => __('Add New', 'book', 'thefoxwp'),

			'add_new_item' => __('Add New Price Table', 'thefoxwp'),

			'edit_item' => __('Edit Price Table', 'thefoxwp'),

			'new_item' => __('New Price Table', 'thefoxwp'),

			'all_items' => __('All Price Tables', 'thefoxwp'),

			'view_item' => __('View Price Table', 'thefoxwp'),

			'search_items' => __('Search Price Tables', 'thefoxwp'),

			'not_found' =>  __('No Price Tables found', 'thefoxwp'),

		),

		'public' => true,

		'has_archive' => false,

		'supports' => array( 'title', 'editor', 'revisions', 'thumbnail', 'excerpt' ),

		'menu_icon' => get_template_directory_uri().'/includes/pricetable/images/icon.png', __FILE__

	));

}

add_action( 'init', 'siteorigin_pricetable_register');

	
add_action( 'after_setup_theme', 'rd_portfolio_custom_init' );
add_action('after_setup_theme', 'rd_partners_custom_init');
add_action('after_setup_theme', 'rd_staff_custom_init');