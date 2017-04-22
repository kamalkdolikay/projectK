<?php

add_action( 'vc_before_init', 'rd_vcSetAsTheme' );
function rd_vcSetAsTheme() {
    vc_set_as_theme();
}


function rd_vc_remove_frontend_links() {
    vc_disable_frontend(); // this will disable frontend editor
}
add_action( 'vc_after_init', 'rd_vc_remove_frontend_links' );


$list = array(
    'page',
    'post',
    'staff',
    'product',
);
vc_set_default_editor_post_types( $list );



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            List of plugin files that I've modified        /////


////templates/shortcodes/vc_row.php
////templates/shortcodes/vc_tabs.php
////templates/shortcodes/vc_tab.php


///                                                                         /////
//                                                                         /////
///////////////////////////////////////////////////////////////////////////////


  vc_remove_element( 'vc_separator' );
  vc_remove_element( 'vc_text_separator' );
  vc_remove_element( 'vc_message' );
  vc_remove_element( 'vc_toggle' );
  vc_remove_element( 'vc_gallery' );
  vc_remove_element( 'vc_posts_slider' );
  vc_remove_element( 'vc_images_carousel' );
  vc_remove_element( 'vc_button' ); 
  vc_remove_element( 'vc_button2' ); 
  vc_remove_element( 'vc_cta_button' ); 
  vc_remove_element( 'vc_cta_button2' ); 
  vc_remove_element( 'vc_flickr' ); 
  vc_remove_element( 'vc_progress_bar' ); 
  vc_remove_element( 'vc_pie' ); 
  vc_remove_element( 'vc_basic_grid' );
  vc_remove_element( 'vc_media_grid' );
  vc_remove_element( 'vc_masonry_grid' );
  vc_remove_element( 'vc_masonry_media_grid' );
  vc_remove_element( 'vc_icon' );
  vc_remove_element( 'vc_wp_search' );
  vc_remove_element( 'vc_element-description' );
  vc_remove_element( 'vc_wp_recentcomments' );
  vc_remove_element( 'vc_wp_calendar' ); 
  vc_remove_element( 'vc_wp_pages' ); 
  vc_remove_element( 'vc_wp_tagcloud' ); 
  vc_remove_element( 'vc_wp_custommenu' ); 
  vc_remove_element( 'vc_wp_text' ); 
  vc_remove_element( 'vc_wp_posts' ); 
  vc_remove_element( 'vc_wp_categories' ); 
  vc_remove_element( 'vc_wp_archives' ); 
  vc_remove_element( 'vc_wp_rss' );  
  vc_remove_element( 'vc_wp_meta' ); 
  
function thefox_vc_remove_cf7() {
    if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        vc_remove_element( 'contact-form-7' );
        // Add other elements that should be removed here
    }
}
// Hook for admin editor.
add_action( 'vc_build_admin_page', 'thefox_vc_remove_cf7', 11 );
// Hook for frontend editor.
add_action( 'vc_load_shortcode', 'thefox_vc_remove_cf7', 11 );



$settings = array (
  'weight' => '98',
);
vc_map_update( 'vc_custom_heading', $settings );

$settings = array (
  'weight' => '97',
);
vc_map_update( 'vc_empty_space', $settings );


$settings = array (
  'weight' => '67',
);
vc_map_update( 'vc_tabs', $settings );

$settings = array (
  'weight' => '66',
);
vc_map_update( 'vc_tour', $settings );

$settings = array (
  'weight' => '65',
);
vc_map_update( 'vc_accordion', $settings );


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            Change column name                             /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////
 
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
  if ($tag=='vc_column' || $tag=='vc_column_inner') {
    $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'vc_span$1', $class_string);
  }
  return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);








///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ROW module modifications                       /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

vc_remove_param( "vc_row", "full_width" ); 
vc_remove_param( "vc_row", "parallax" );  
vc_remove_param( "vc_row", "parallax_image" ); 


$settings = array (
  'weight' => '100',
);

vc_map_update( 'vc_row', $settings );



$attributes = array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'thefoxwp' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'thefoxwp' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("type",'thefoxwp' ),
	'param_name' => 'type',
	'value' => array(__("In container",'thefoxwp' ) => "", __("Full width background",'thefoxwp' ) => "full-width-section", __("Full width content",'thefoxwp' ) => 'full-width-content'),
	'description' => __("Select the row type",'thefoxwp' )
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Make background parallax?",'thefoxwp' ),
	'param_name' => 'parallax_background',
	'value' => array(  'Yes'  => true ),
	'description' => __("Make the background parallax ( must have an image set as background )",'thefoxwp' )
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Parallax type",'thefoxwp'),
	'param_name' => 'parallax_type',
	'value' => array(__("Fixed",'thefoxwp') => "", __("Cover",'thefoxwp') => 'cover'),
	'description' => __("Select the parallax type",'thefoxwp'),
	'dependency' => array( 'element' => 'parallax_background', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Use video as background?",'thefoxwp'),
	'param_name' => 'video_background',
	'value' => array(  'Yes'  => true ),
	'description' => __("Select if you want to use a video as background",'thefoxwp')
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'textarea',
	'heading' => __("Video link",'thefoxwp'),
	'param_name' => 'video_link',
	'value' => '',
	'description' => __("Copy your video link ( mp4, ogg ).You can upload a video through WordPress Media Library, if not done already.",'thefoxwp'),
	'dependency' => array( 'element' => 'video_background', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Use Overlay?",'thefoxwp'),
	'param_name' => 'overlay',
	'value' => array(  'Yes'  => true ),
	'description' => __("Select if you want to use an Overlay",'thefoxwp')
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Overlay Color",'thefoxwp'),
	'param_name' => 'overlay_color',
	'value' => '#ffffff',
	'description' => __("Select the Overlay Color and Opacity",'thefoxwp'),
	'dependency' => array( 'element' => 'overlay', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Show an Icon on the top of the section?",'thefoxwp'),
	'param_name' => 'i_select',
	'value' => array(  'Yes'  => true ),
	'description' => __("Select if you want to use an Icon for the section",'thefoxwp')
);
vc_add_param('vc_row', $attributes);


$attributes =  array(
	'type' => '4k_icon',
	'heading' => __( 'Choose your icon', 'thefoxwp' ),
	'param_name' => 'icon',
	'value' => '',
	'description' => __( 'Select an icon to show on top of the section.', 'thefoxwp' ),
	'dependency' => array( 'element' => 'i_select', 'not_empty' => true)
                
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Icon background color",'thefoxwp'),
	'param_name' => 'i_bg_color',
	'value' => '#ffffff',
	'description' => __("Select the Icon background color",'thefoxwp'),
	'dependency' => array( 'element' => 'i_select', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Icon color",'thefoxwp'),
	'param_name' => 'i_color',
	'value' => '#21c2f8',
	'description' => __("Select the Icon color",'thefoxwp'),
	'dependency' => array( 'element' => 'i_select', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Use an arrow on the bottom of the section?",'thefoxwp'),
	'param_name' => 'a_select',
	'value' => array(  'Yes'  => true ),
	'description' => __("Select if you want to use an Arrow on the bottom of the section",'thefoxwp')
);
vc_add_param('vc_row', $attributes);



$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Arrow color",'thefoxwp'),
	'param_name' => 'a_bg_color',
	'value' => '#ffffff',
	'description' => __("Select the Arrow color",'thefoxwp'),
	'dependency' => array( 'element' => 'a_select', 'not_empty' => true)
);
vc_add_param('vc_row', $attributes);



$attributes = array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'thefoxwp' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'thefoxwp' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		);
vc_add_param('vc_row_inner', $attributes);

		
		
///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            COLUMN module modifications                    /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////
$attributes =     		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'thefoxwp' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'thefoxwp' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		);
vc_add_param('vc_column', $attributes);


$attributes =          array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         );
vc_add_param('vc_column', $attributes);


$attributes =     		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'thefoxwp' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'thefoxwp' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		);
vc_add_param('vc_column_inner', $attributes);

$attributes =          array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         );
vc_add_param('vc_column_inner', $attributes);




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                       COLUMN TEXT module modifications                    /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

vc_remove_param( "vc_column_text", "css_animation" ); 


$settings = array (
  'weight' => '99',
);

vc_map_update( 'vc_column_text', $settings );


$attributes = array(
	'type' => 'textfield',
	'heading' => __("Font size ( optional )", 'thefoxwp' ),
	'param_name' => 'font_size',
	'value' => '',
	'description' => __("Enter font size ( e.g 18 ) | Leave Blank to use default font size", 'thefoxwp' ),
);
vc_add_param('vc_column_text', $attributes);



$attributes = array(
	'type' => 'textfield',
	'heading' => __("Line height ( optional )", 'thefoxwp' ),
	'param_name' => 'line_height',
	'value' => '',
	'description' => __("Enter Line height ( e.g 30 ) | Leave Blank to use default Line height", 'thefoxwp' ),
);
vc_add_param('vc_column_text', $attributes);


$attributes =          array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
			);
vc_add_param('vc_column_text', $attributes);





///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                       SINGLE IMAGE module modifications                   /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////




vc_remove_param( "vc_single_image", "css_animation" ); 


$settings = array (
  'weight' => '93',
);

vc_map_update( 'vc_single_image', $settings );



$attributes =          array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Hover effect", 'thefoxwp' ),
            "param_name" => "hover_effect",
			'value' => array("No" => "","Zoom Icon (if Image has link or prettyphoto)" => "img_zoom_effect","Play Icon (if Image has link or prettyphoto)" => "img_play_effect", "Reduce Opacity" => "img_reduce_opacity", "Remove Opacity" => "img_remove_opacity", "Add Color" => "img_add_color", "Remove Color" => "img_remove_color","Show Title on Hover" => "img_hover_title"),
            "description" => __("Select the effect on hover", 'thefoxwp' )
         );
vc_add_param('vc_single_image', $attributes);

$attributes =          array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         );
vc_add_param('vc_single_image', $attributes);




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            TABS module modifications                      /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs style",'thefoxwp'),
	'param_name' => 'type',
	'value' => array(__("Type 1",'thefoxwp') => "rd_tab_1", __("Type 2",'thefoxwp') => "rd_tab_2", __("Type 3",'thefoxwp') => "rd_tab_3", __("Type 4",'thefoxwp') => 'rd_tab_4'),
	'description' => __("Select the Tabs type",'thefoxwp')
);
vc_add_param('vc_tabs', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs color",'thefoxwp'),
	'param_name' => 'color',
	'value' => array(__("Theme color",'thefoxwp') => "", __("Dark",'thefoxwp') => 'rd_dark_tabs'),
	'description' => __("Select the Tabs color",'thefoxwp')
);
vc_add_param('vc_tabs', $attributes);


$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin top",'thefoxwp'),
	'param_name' => 'mt',
	'value' => '0',
	'description' => __("Enter the margin top for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_tabs', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin bottom",'thefoxwp'),
	'param_name' => 'mb',
	'value' => '0',
	'description' => __("Enter the margin bottom for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_tabs', $attributes);


	$attributes =	 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Use icon?",'thefoxwp'),
            "param_name" => "use_icon",
            "value" => array ( __("No",'thefoxwp') => "no",__("Yes",'thefoxwp') => "yes" ), 
            "description" => __("Use icon for the tab?",'thefoxwp'),			
         );
vc_add_param('vc_tab', $attributes);
			$attributes =	  array(
			"type" => "4k_icon",
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"admin_label" => true,
			"description" => __("Select the icon from the list.",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))		
    	     );
vc_add_param('vc_tab', $attributes);

// Tour settings


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs style",'thefoxwp'),
	'param_name' => 'type',
	'value' => array(__("Type 1",'thefoxwp') => "rd_vtab_1", __("Type 2",'thefoxwp') => 'rd_vtab_2'),
	'description' => __("Select the Tabs type",'thefoxwp')
);
vc_add_param('vc_tour', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs positions",'thefoxwp'),
	'param_name' => 'pos',
	'value' => array(__("Tabs on the left",'thefoxwp') => "rd_vtab_left", __("Tabs on the Right",'thefoxwp') => 'rd_vtab_right'),
	'description' => __("Select the Tabs position ( left or right )",'thefoxwp')
);
vc_add_param('vc_tour', $attributes);



$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin top",'thefoxwp'),
	'param_name' => 'mt',
	'value' => '0',
	'description' => __("Enter the margin top for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_tour', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin bottom",'thefoxwp'),
	'param_name' => 'mb',
	'value' => '0',
	'description' => __("Enter the margin bottom for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_tour', $attributes);





///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ACCORDION module modifications                 /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs style",'thefoxwp'),
	'param_name' => 'style',
	'value' => array(__("Style 1",'thefoxwp') => "rd_acc_1",__("Style 2",'thefoxwp') => "rd_acc_2",__("Style 3",'thefoxwp') => "rd_acc_3",__("Style 4",'thefoxwp') => "rd_acc_4",__("Style 5",'thefoxwp') => "rd_acc_5",__("Style 6",'thefoxwp') => "rd_acc_6",__("Style 7",'thefoxwp') => "rd_acc_7",__("Style 8",'thefoxwp') => "rd_acc_8",__("Style 9",'thefoxwp') => "rd_acc_9",__("Style 10",'thefoxwp') => "rd_acc_10",__("Style 11",'thefoxwp') => "rd_acc_11",__("Style 12",'thefoxwp') => "rd_acc_12",__("Style 13",'thefoxwp') => "rd_acc_13",__("Style 14",'thefoxwp') => "rd_acc_14",__("Style 15",'thefoxwp') => "rd_acc_15",__("Style 16",'thefoxwp') => "rd_acc_16",),
	'description' => __("Select the Tabs type",'thefoxwp')
);
vc_add_param('vc_accordion', $attributes);



$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin top",'thefoxwp'),
	'param_name' => 'mt',
	'value' => '0',
	'description' => __("Enter the margin top for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_accordion', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin bottom",'thefoxwp'),
	'param_name' => 'mb',
	'value' => '0',
	'description' => __("Enter the margin bottom for the tabs ( e.g 30 )",'thefoxwp'),
);
vc_add_param('vc_accordion', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Title color",'thefoxwp'),
	'param_name' => 'title_color',
	'description' => __("Select the Title color",'thefoxwp')
);
vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Title background color",'thefoxwp'),
	'param_name' => 'title_bg_color',
	'description' => __("Select the Title background color",'thefoxwp')
);
vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Title second background color",'thefoxwp'),
	'param_name' => 'title_altbg_color',
	'description' => __("Select the Title second background color ( not used in all style )",'thefoxwp')
);
vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tab border color",'thefoxwp'),
	'param_name' => 'border_color',
	'description' => __("Select the border color",'thefoxwp')
);
vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Content text color",'thefoxwp'),
	'param_name' => 'content_text_color',
	'description' => __("Select the tab content text color",'thefoxwp')
);
vc_add_param('vc_accordion_tab', $attributes);


$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Content background color",'thefoxwp'),
	'param_name' => 'content_bg_color',
	'description' => __("Select the tab content background color",'thefoxwp')
);

vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab title color",'thefoxwp'),
	'param_name' => 'active_title_color',
	'description' => __("Select the Active Tab Title color",'thefoxwp')
);

vc_add_param('vc_accordion_tab', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab background color",'thefoxwp'),
	'param_name' => 'active_bg_color',
	'description' => __("Select the Active Tab Title background color",'thefoxwp')
);

vc_add_param('vc_accordion_tab', $attributes);


$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab second background color",'thefoxwp'),
	'param_name' => 'active_altbg_color',
	'description' => __("Select the Active Tab Title background color ( not used in all style )",'thefoxwp')
);

vc_add_param('vc_accordion_tab', $attributes);


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD TABLE SHORTCODES                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_table_sc' );
function rd_table_sc() {
vc_map( array(
    "name" => __("Table", 'thefoxwp'),
    "base" => "table_ctn",
	"weight" => "79",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_table.png",
    "as_parent" => array('only' => 'table_sc'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of column",'thefoxwp'),
            "param_name" => "col_nb",
            "value" => array (__("1 Column",'thefoxwp') => "rd_table_1_col",__("2 Columns",'thefoxwp') => "rd_table_2_col",__("3 Columns",'thefoxwp') => "rd_table_3_col",__("4 Columns",'thefoxwp') => "rd_table_4_col",__("5 Columns",'thefoxwp') => "rd_table_5_col" ), 
            "description" => __("Choose the number of columns",'thefoxwp')
         ),		  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Table Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose Table text color (optional)",'thefoxwp')
         ),	 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Table background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose Table background color (optional)",'thefoxwp')
         ), 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Table border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Choose Table border color (optional)",'thefoxwp')
         ),
    ),
    "js_view" => 'VcColumnView'
) );	


vc_map( array(
	'name' => __( 'Column', 'thefoxwp' ),
	'base' => 'table_sc',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_table.png",
	'category' => __( 'Content', 'thefoxwp' ),
	  "as_child" => array('only' => 'table_ctn'),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Table Column title', 'thefoxwp' ),
			'param_name' => 'title',
			'description' => __( 'Enter the column title.', 'thefoxwp' )
		),		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title color",'thefoxwp'),
            "param_name" => "title_color",
            "value" => '', //Default Red color
            "description" => __("Choose Title color (optional)",'thefoxwp')
         ),		 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title background color",'thefoxwp'),
            "param_name" => "title_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose Title background color (optional)",'thefoxwp')
         ),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Tables values', 'thefoxwp' ),
			'param_name' => 'values',
			'description' => __( 'Input Table values here. Divide values with linebreaks (Enter).', 'thefoxwp' ),
			'value' => __("First Value,Second Value,Third Value",'thefoxwp')
		),	

    ),
) );
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_table_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_table_sc extends WPBakeryShortCode {
    }
}


}

///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD TESTIMONIALS SHORTCODES                    /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_testimonials_sc' );
function rd_testimonials_sc() {
vc_map( array(
    "name" => __("Testimonials", 'thefoxwp'),
    "base" => "testimonials_ctn",
	"weight" => "76",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_testimonials.png",
    "as_parent" => array('only' => 'testimonial_sc'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Testionials Style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Style 1" => "rd_tm_1","Style 2 ( need image )" => "rd_tm_2","Style 3 ( need image )" => "rd_tm_3","Style 4 ( need image )" => "rd_tm_4","Style 5 ( need image )" => "rd_tm_5","Style 6 ( need image )" => "rd_tm_6","Style 7 ( need image )" => "rd_tm_7","Style 8" => "rd_tm_8","Style 9" => "rd_tm_9","Style 10 ( need image )" => "rd_tm_10","Style 11 ( need image )" => "rd_tm_11","Style 12 ( need image )" => "rd_tm_12","Style 13 ( need image )" => "rd_tm_13","Style 14" => "rd_tm_14","Style 15 ( need image )" => "rd_tm_15", "Style 16" => "rd_tm_16", "Style 17" => "rd_tm_18", "Style 18  ( need image )" => "rd_tm_17", "Style 19  ( need image )" => 'rd_tm_19', "Style 20" => 'rd_tm_20'), 
            "description" => __("Select the Testimonials Style ( design )",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),		  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Testimonial Text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Choose the text color (optional)",'thefoxwp')
         ),		  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Testimonial Heading color",'thefoxwp'),
            "param_name" => "h_color",
            "value" => '', //Default Red color
            "description" => __("Choose the heading color (optional)",'thefoxwp')
         ),		  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Testimonial Highlight color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose the high light color (optional)",'thefoxwp')
         ),	 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Testimonial background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the background color (optional)",'thefoxwp')
         ), 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Testionials border color",'thefoxwp'),
            "param_name" => "b_color",
            "value" => '', //Default Red color
            "description" => __("Choose the border color (optional)",'thefoxwp')
         ),		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Testimonials (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Testimonials (e.g 20 )",'thefoxwp')
         ), 
    ),
    "js_view" => 'VcColumnView'
) );	


vc_map( array(
	'name' => __( 'Testimonial', 'thefoxwp' ),
	'base' => 'testimonial_sc',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_testimonials.png",
	'category' => __( 'Content', 'thefoxwp' ),
	  "as_child" => array('only' => 'testimonials_ctn'),
	'params' => array(
		
		array(
			'type' => 'attach_image',
			'heading' => __( 'Author image', 'thefoxwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select the image for the author (optional).', 'thefoxwp' )
		),	array(
			'type' => 'textfield',
			'heading' => __( 'Author name', 'thefoxwp' ),
			'param_name' => 'author',
			'description' => __( 'Enter Author name.', 'thefoxwp' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Author information', 'thefoxwp' ),
			'param_name' => 'a_info',
			'description' => __( 'Enter author information.', 'thefoxwp' )
		),
		array(
			'type' => 'textarea_html',
			//holder' => 'div',
			//'admin_label' => true,
			'heading' => __( 'Quote from author', 'thefoxwp' ),
			'param_name' => 'content',
			'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'thefoxwp' )
		),

    ),
) );
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_testimonials_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_testimonial_sc extends WPBakeryShortCode {
    }
}


}






///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                          ADD TIMELINE EVENT SHORTCODES                    /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_timeline_event_sc' );
function rd_timeline_event_sc() {
vc_map( array(
    "name" => __("Timeline Event", 'thefoxwp'),
    "base" => "timeline_event_ctn",
	"weight" => "68",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_timeline_event.png",
    "as_parent" => array('only' => 'timeline_event,timeline_date'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
		  	 	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the background color (optional)",'thefoxwp')
         ),	  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Vertical Line Background color",'thefoxwp'),
            "param_name" => "vline_color",
            "value" => '', //Default Red color
            "description" => __("Choose the vertical line background color (optional)",'thefoxwp')
         ),	  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Vertical Line Second Background color",'thefoxwp'),
            "param_name" => "vline_alt_color",
            "value" => '', //Default Red color
            "description" => __("Choose the second background color for gradient (optional)",'thefoxwp')
         ),	  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Highlight color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose the high light color (optional)",'thefoxwp')
         ),	  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Second Highlight color",'thefoxwp'),
            "param_name" => "alt_hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose the second high light color (optional)",'thefoxwp')
         ),		  	 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Heading color",'thefoxwp'),
            "param_name" => "h_color",
            "value" => '', //Default Red color
            "description" => __("Choose the heading color (optional)",'thefoxwp')
         ),	  		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Choose the text color (optional)",'thefoxwp')
         ),		 		
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline border color",'thefoxwp'),
            "param_name" => "b_color",
            "value" => '', //Default Red color
            "description" => __("Choose the border color (optional)",'thefoxwp')
         ),		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Timeline (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Timeline (e.g 20 )",'thefoxwp','thefoxwp')
         ), 
    ),
    "js_view" => 'VcColumnView'
) );	


vc_map( array(
	'name' => __( 'Event', 'thefoxwp' ),
	'base' => 'timeline_event',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_timeline_event.png",
	'category' => __( 'Content', 'thefoxwp' ),
	  "as_child" => array('only' => 'timeline_event_ctn'),
	'params' => array(
		
		array(
			'type' => 'attach_image',
			'heading' => __( 'Event image', 'thefoxwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select the image for the Event.', 'thefoxwp' )
		),	array(
			'type' => 'textfield',
			'heading' => __( 'Event Title', 'thefoxwp' ),
			'param_name' => 'title',
			'description' => __( 'Enter the Title.', 'thefoxwp' )
		),
		array(
			'type' => 'textarea_html',
			'heading' => __( 'Event Main Text', 'thefoxwp' ),
			'param_name' => 'content',
			'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'thefoxwp' )
		),
		array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),

    ),
) );

vc_map( array(
	'name' => __( 'Date', 'thefoxwp' ),
	'base' => 'timeline_date',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_timeline_date.png",
	'category' => __( 'Content', 'thefoxwp' ),
	  "as_child" => array('only' => 'timeline_event_ctn'),
	'params' => array(
		
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Date', 'thefoxwp' ),
			'param_name' => 'date',
			'description' => __( 'Enter the Date (e.g 2015)', 'thefoxwp' )
		),


    ),
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_timeline_event_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_timeline_event extends WPBakeryShortCode {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_timeline_date extends WPBakeryShortCode {
    }
}


}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                               ADD BOXED HEADING                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_heading_box_sc' );
function rd_heading_box_sc() {
   vc_map( array(
      "name" => __("Boxed Heading",'thefoxwp'),
      "base" => "heading_box_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_heading_box.png",
      "class" => "",
	  "weight" => "94",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		array(
			'type' => 'textfield',
			//holder' => 'div',
			//'admin_label' => true,
			'heading' => __( 'Heading text', 'thefoxwp' ),
			'param_name' => 'content',
			'value' => __( 'Heading text', 'thefoxwp' )
		),			 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color",'thefoxwp'),
            "param_name" => "color",
            "value" => '', //Default Red color
            "description" => __("Heading color",'thefoxwp')
         ),			 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Background Color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Heading Background color",'thefoxwp')
         ),			 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Border Color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Heading Border color",'thefoxwp')
         ),			 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Bottom Border Color",'thefoxwp'),
            "param_name" => "border_bottom_color",
            "value" => '', //Default Red color
            "description" => __("Heading Bottom Border color",'thefoxwp')
         ),	
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin top",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Margin Top for the  heading box (e.g 20)",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin bottom",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Margin Bottom for the heading box (e.g 20)",'thefoxwp')
         ),	
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                               ADD CODE BOX                                /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_code_box_sc' );
function rd_code_box_sc() {
   vc_map( array(
      "name" => __("Code Box",'thefoxwp'),
      "base" => "rd_code_box",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_code_box.png",
      "class" => "",
	  "weight" => "55",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		array(
			'type' => 'textarea_html',
			//holder' => 'div',
			//'admin_label' => true,
			'heading' => __( 'Enter the code you want to show', 'thefoxwp' ),
			'param_name' => 'content',
			'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'thefoxwp' )
		),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin top",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Margin Top for the social icons (e.g 20)",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin bottom",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Margin Bottom for the social icons (e.g 20)",'thefoxwp')
         ),	
      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PROFILE TESTIMONIAL                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_profile_testi_sc' );
function rd_profile_testi_sc() {
   vc_map( array(
      "name" => __("Profile Testimonial",'thefoxwp'),
      "base" => "profile_testimonial_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_profile_testimonial.png",
      "class" => "",
	  "weight" => "74",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),	
		array(
			'type' => 'attach_image',
			'heading' => __( 'Background image', 'thefoxwp' ),
			'param_name' => 'bg',
			'value' => '',
			'description' => __( 'Select the background image.', 'thefoxwp' )
		),	
		array(
			'type' => 'attach_image',
			'heading' => __( 'Logo image', 'thefoxwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select the Logo image ( better if white with transparent bg).', 'thefoxwp' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Author name', 'thefoxwp' ),
			'param_name' => 'author',
			'description' => __( 'Enter Author name.', 'thefoxwp' )
		),
		array(
			'type' => 'textarea_html',
			//holder' => 'div',
			//'admin_label' => true,
			'heading' => __( 'Quote from author', 'thefoxwp' ),
			'param_name' => 'quote',
			'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'thefoxwp' )
		),			 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Quote High Light Color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose Quote High light color",'thefoxwp')
         ),	
         
      )
   ) );
}





///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD FOUR QUOTES                               /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_four_quotes_sc' );
function rd_four_quotes_sc() {
   vc_map( array(
      "name" => __("4 Quotes",'thefoxwp'),
      "base" => "rd_fq_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_four_quotes.png",
      "class" => "",
	  "weight" => "75",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Quote text color",'thefoxwp'),
            "param_name" => "q_color",
            "value" => '', //Default Red color
            "description" => __("Choose Quote text color",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Quote Author color",'thefoxwp'),
            "param_name" => "a_color",
            "value" => '', //Default Red color
            "description" => __("Choose Quote Author text color",'thefoxwp')
         ),		 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Quote Author Info color",'thefoxwp'),
            "param_name" => "ai_color",
            "value" => '', //Default Red color
            "description" => __("Choose Quote Author information text color",'thefoxwp')
         ),				 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Quote High Light Color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose Quote High light color",'thefoxwp')
         ),				 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Color",'thefoxwp'),
            "param_name" => "i_color",
            "value" => '', //Default Red color
            "description" => __("Choose Icon color",'thefoxwp')
         ),				 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Background Color",'thefoxwp'),
            "param_name" => "i_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose Icon background color",'thefoxwp')
         ),				 		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Border Color",'thefoxwp'),
            "param_name" => "i_b_color",
            "value" => '', //Default Red color
            "description" => __("Choose Icon border color",'thefoxwp')
         ),		 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("First Quote Author Name",'thefoxwp'),
            "param_name" => "author_one",
            "value" => __("First Author",'thefoxwp'),
            "description" => __("First Quote's Author name",'thefoxwp')
         ),		 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("First Quote Author Info",'thefoxwp'),
            "param_name" => "info_one",
            "value" => __("First Programmer",'thefoxwp'),
            "description" => __("First Quote's Author information",'thefoxwp')
         ),		 		  
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("First Quote Text",'thefoxwp'),
            "param_name" => "quote_one",
            "value" => __("This is an Awesome quote text! Replace me with your own quote text!",'thefoxwp'),
            "description" => __("First Quote's text",'thefoxwp')
         ),			 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Second Quote Author Name",'thefoxwp'),
            "param_name" => "author_two",
            "value" => __("Second Author",'thefoxwp'),
            "description" => __("Second Quote's Author name",'thefoxwp')
         ),		 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Second Quote Author Info",'thefoxwp'),
            "param_name" => "info_two",
            "value" => __("Second Programmer",'thefoxwp'),
            "description" => __("Second Quote's Author information",'thefoxwp')
         ),		 		  
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Second Quote Text",'thefoxwp'),
            "param_name" => "quote_two",
            "value" => __("This is an Awesome quote text! Replace me with your own quote text!",'thefoxwp'),
            "description" => __("Second Quote's text",'thefoxwp')
         ),			 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Third Quote Author Name",'thefoxwp'),
            "param_name" => "author_three",
            "value" => __("Third Author",'thefoxwp'),
            "description" => __("Third Quote's Author name",'thefoxwp')
         ),		 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Third Quote Author Info",'thefoxwp'),
            "param_name" => "info_three",
            "value" => __("Third Programmer",'thefoxwp'),
            "description" => __("Third Quote's Author information",'thefoxwp')
         ),		 		  
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Third Quote Text",'thefoxwp'),
            "param_name" => "quote_three",
            "value" => __("This is an Awesome quote text! Replace me with your own quote text!",'thefoxwp'),
            "description" => __("Third Quote's text",'thefoxwp')
         ),			 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Fourth Quote Author Name",'thefoxwp'),
            "param_name" => "author_four",
            "value" => __("Fourth  Author",'thefoxwp'),
            "description" => __("Fourth  Quote's Author name",'thefoxwp')
         ),		 		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Fourth Quote Author Info",'thefoxwp'),
            "param_name" => "info_four",
            "value" => __("Fourth  Programmer",'thefoxwp'),
            "description" => __("Fourth  Quote's Author information",'thefoxwp')
         ),		 		  
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Fourth Quote Text",'thefoxwp'),
            "param_name" => "quote_four",
            "value" => __("This is an Awesome quote text! Replace me with your own quote text!",'thefoxwp'),
            "description" => __("Fourth  Quote's text",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin top",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Margin Top for the social icons (e.g 20)",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin bottom",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Margin Bottom for the social icons (e.g 20)",'thefoxwp')
         ),	
         
      )
   ) );
}




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD SOCIAL ICONS                               /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_social_icons_sc' );
function rd_social_icons_sc() {
   vc_map( array(
      "name" => __("Social Icons",'thefoxwp'),
      "base" => "rd_social_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_social_icons.png",
      "class" => "",
	  "weight" => "59",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Social Icons style",'thefoxwp'),
            "param_name" => "style",
            "value" => array (__("Small Icons",'thefoxwp') => "rd_si_small",__("Medium Icons",'thefoxwp') => "rd_si_medium",__("Small Squared Icons",'thefoxwp') => "rd_si_squared",__("Big Squared Icons",'thefoxwp') => "rd_si_big_squared",__("Small rounded Icon",'thefoxwp') => "rd_si_rounded",__("Big rounded Icon",'thefoxwp') => 'rd_si_big_rounded',__("Big rounded Icon ( trending )",'thefoxwp') => 'rd_si_big_rounded_trend'), 
            "description" => __("Select the Social Icons Style ( design )",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "color",
            "value" => '', //Default Red color
            "description" => __("Choose Social Icons color",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose Social Icons Background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_si_big_rounded_trend'))
         ),			 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon hover color",'thefoxwp'),
            "param_name" => "h_color",
            "value" => '', //Default Red color
            "description" => __("Choose Social Icons Hover color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_si_small','rd_si_medium','rd_si_big_rounded_trend'))	
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin top",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Margin Top for the social icons (e.g 20)",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin bottom",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Margin Bottom for the social icons (e.g 20)",'thefoxwp')
         ),	 	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Facebook",'thefoxwp'),
            "param_name" => "facebook",
            "value" => "",
            "description" => __("Enter your Facebook page URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Twitter",'thefoxwp'),
            "param_name" => "twitter",
            "value" => "",
            "description" => __("Enter your Twitter URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Pinterest",'thefoxwp'),
            "param_name" => "pinterest",
            "value" => "",
            "description" => __("Enter your Pinterest URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Google+",'thefoxwp'),
            "param_name" => "google",
            "value" => "",
            "description" => __("Enter your Google+ URL",'thefoxwp')
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Dribbble",'thefoxwp'),
            "param_name" => "dribbble",
            "value" => "",
            "description" => __("Enter your Dribble URL",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Instagram",'thefoxwp'),
            "param_name" => "instagram",
            "value" => "",
            "description" => __("Enter your Instagram URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Tumblr",'thefoxwp'),
            "param_name" => "tumblr",
            "value" => "",
            "description" => __("Enter your Tumblr URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Vimeo",'thefoxwp'),
            "param_name" => "vimeo",
            "value" => "",
            "description" => __("Enter your Vimeo URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Behance",'thefoxwp'),
            "param_name" => "behance",
            "value" => "",
            "description" => __("Enter your Behance URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Flickr",'thefoxwp'),
            "param_name" => "flickr",
            "value" => "",
            "description" => __("Enter your Flickr URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Youtube",'thefoxwp'),
            "param_name" => "youtube",
            "value" => "",
            "description" => __("Enter your Youtube URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Linkedin",'thefoxwp'),
            "param_name" => "linkedin",
            "value" => "",
            "description" => __("Enter your Linkedin URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Skype",'thefoxwp'),
            "param_name" => "skype",
            "value" => "",
            "description" => __("Enter your Skype URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Reddit",'thefoxwp'),
            "param_name" => "reddit",
            "value" => "",
            "description" => __("Enter your Reddit URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Deviant Art",'thefoxwp'),
            "param_name" => "da",
            "value" => "",
            "description" => __("Enter your Deviant Art URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Digg",'thefoxwp'),
            "param_name" => "digg",
            "value" => "",
            "description" => __("Enter your Digg URL",'thefoxwp')
         ),	  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("RSS",'thefoxwp'),
            "param_name" => "rss",
            "value" => "",
            "description" => __("Enter your RSS URL",'thefoxwp')
         ),
         
      )
   ) );
}













///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD SHARE ICONS                                /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_share_icons_sc' );
function rd_share_icons_sc() {
   vc_map( array(
      "name" => __("Share Icons",'thefoxwp'),
      "base" => "rd_share_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_share_icons.png",
      "class" => "",
	  "weight" => "58",
      "category" => __('Content','thefoxwp'),
      "params" => array(  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),	
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon Position",'thefoxwp'),
            "param_name" => "align",
			'value' => array("Center" => "a_center", "Left" => "a_left", "Right" => 'a_right'),
            "description" => __("Select the Icon Postion",'thefoxwp')
         ), 		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Enter the URL you want to Share",'thefoxwp'),
            "param_name" => "url",
            "value" => __("http://www.google.com",'thefoxwp'),
            "description" => __("Don't forget the http://",'thefoxwp')
         ),	  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Enter the Message to Share",'thefoxwp'),
            "param_name" => "msg",
            "value" => __("Check This!",'thefoxwp'),
            "description" => __("Enter the Message to share, should be short message",'thefoxwp')
         ),	  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Enter the Icon hover message",'thefoxwp'),
            "param_name" => "tooltip",
            "value" => __("Share TheFox Design",'thefoxwp'),
            "description" => __("Enter the Message to show when icon are hovered, should be short message",'thefoxwp')
         ),			 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon hover color",'thefoxwp'),
            "param_name" => "hover_color",
            "value" => '', //Default Red color
            "description" => __("Choose Social Icons Hover color",'thefoxwp'),
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin top",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Margin Top for the social icons (e.g 20)",'thefoxwp')
         ),		  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Margin bottom",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Margin Bottom for the social icons (e.g 20)",'thefoxwp')
         ),	 	  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Facebook?",'thefoxwp'),
            "param_name" => "facebook",
            'value' => array(  'Yes'  => true ),
	        "description" => __("Check if you want to Share on Facebook page",'thefoxwp')
         ),	  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Twitter",'thefoxwp'),
            "param_name" => "twitter",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share on Twitter",'thefoxwp')
         ),	  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Google+",'thefoxwp'),
            "param_name" => "gplus",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share on Google+",'thefoxwp')
         ),  	  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Tumblr",'thefoxwp'),
            "param_name" => "tumblr",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share on Tumblr",'thefoxwp')
         ),	    
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Linkedin",'thefoxwp'),
            "param_name" => "lin",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share on Linkedin",'thefoxwp')
         ),		  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Reddit",'thefoxwp'),
            "param_name" => "reddit",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share on Reddit",'thefoxwp')
         ),		  
         array(
			'type' => 'checkbox',
            "class" => "",
            "heading" => __("Share on Reddit",'thefoxwp'),
            "param_name" => "reddit",
            'value' => array(  'Yes'  => true ),
            "description" => __("Check if you want to Share by Mail",'thefoxwp')
         ),
         
      )
   ) );
}



















///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD TWITTER CAROUSEL                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_twitter_sc' );
function rd_twitter_sc() {
   vc_map( array(
      "name" => __("Twitter Carousel",'thefoxwp'),
      "base" => "twitter_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_twitter_carousel.png",
      "class" => "",
	  "weight" => "57",
      "category" => __('Content','thefoxwp'),
      "params" => array(	  
	  	  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Carousel Style",'thefoxwp'),
            "param_name" => "style",
            "value" => array("Style 1" => "","Style 2" => "rd_tc_3","Style 3" => "rd_tc_4","Style 4" => "rd_tc_2",), 
            "description" => __("Choose the Twitter Carousel Design",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Twitter id",'thefoxwp'),
            "param_name" => "twitter_id",
            "value" => __("your_id",'thefoxwp'),
            "description" => __("Enter a valid Twitter id",'thefoxwp')
         ),		 
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Twitter id",'thefoxwp'),
            "param_name" => "heading",
            "value" => __("My Latest Tweet",'thefoxwp'),
            "description" => __("Enter an heading for the carousel",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_tc_2'))	
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of Tweet to load",'thefoxwp'),
            "param_name" => "count",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of tweet to load for the carousel",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color (optional)",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Highlight color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose high light color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover color",'thefoxwp'),
            "param_name" => "hover_color",
            "value" => '', //Default Red color
            "description" => __("Choose hover color (optional)",'thefoxwp'),
         ),
         
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD WOOCOMMERCE                                /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////
if( rd_check_woo_status() == true) {


add_action( 'vc_before_init', 'rd_woo_sc' );

function rd_woo_sc() {
		
 
  
   

   vc_map( array(
      "name" => __("Woocommerce product",'thefoxwp'),
      "base" => "wooc_module",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_woo_product.png",
      "class" => "",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Posts per line",'thefoxwp'),
            "param_name" => "per_line",
            "value" => __("3",'thefoxwp'),
            "description" => __("Number of post per line.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of Products to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Product type",'thefoxwp'),
            "param_name" => "pro_type",
            "value" => array ("Recent products" => "recent","Featured Products" => 'featured'), 
            "description" => __("Choose the type of product to show",'thefoxwp')
         ),
        
      )
   ) );
}

}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD STAFF SHORTCODES                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_staff_carousel_sc' );
function rd_staff_carousel_sc() {
	
	    $args_staff = array('taxonomy' => 'staffgroups', 'hide_empty' => '0');
    $variable_staff = get_terms('staffgroups', $args_staff);
	$from_get_terms_staff = array();
	$from_get_terms_staff[] = 'all';
	foreach ($variable_staff as $key_staff => $value_staff) {
        $from_get_terms_staff[] = $value_staff->name;
    }
	
   vc_map( array(
      "name" => __("Staff Carousel",'thefoxwp'),
      "base" => "staff_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_staff_carousel.png",
      "class" => "",
	  "weight" => "84",
      "category" => __('Content','thefoxwp'),
      "params" => array(	  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Carousel Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array("Style 1" => "rstaff_01","Style 2" => "rstaff_02","Style 3" => "rstaff_03","Style 4" => 'rstaff_04'), 
            "description" => __("Choose the Staff Carousel Design",'thefoxwp')
         ),
		  array(
            "type" => "dropdown",
            "class" => "",
			"admin_label" => true,
            "heading" => __("Group",'thefoxwp'),
            "param_name" => "group",
            "value" => $from_get_terms_staff, 
            "description" => __("Choose the group of Staff to show (optional)",'thefoxwp')			
         ),  
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Posts per line",'thefoxwp'),
            "param_name" => "posts_per_line",
            "value" => __("3",'thefoxwp'),
            "description" => __("Number of staff per line.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of staff member to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of staff member to load for the carousel",'thefoxwp')
         ),
         array(
			'type' => 'dropdown',
            "class" => "",
            "heading" => __("Open link in new tab?",'thefoxwp'),
            "param_name" => "l_target",
            'value' => array(  'Yes'  => '_blank', 'No'  => '_self' ),
	        "description" => __("Select if you want to open member page in a new tab",'thefoxwp')
         ),	
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color (optional)",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Highlight color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Choose high light color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Choose border color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rstaff_01'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose background color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Second Background color",'thefoxwp'),
            "param_name" => "alt_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the second background color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rstaff_02'))	
         ),

         
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                                  ADD STAFF POST                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_staff_post_sc' );
function rd_staff_post_sc() {
		
   	 
    $args_staff = array('taxonomy' => 'staffgroups', 'hide_empty' => '0');
    $variable_staff = get_terms('staffgroups', $args_staff);
	$from_get_terms_staff = array();
	$from_get_terms_staff[] = 'all';
	foreach ($variable_staff as $key_staff => $value_staff) {
        $from_get_terms_staff[] = $value_staff->name;
    } 




   vc_map( array(
      "name" => __("Staff Members",'thefoxwp'),
      "base" => "staff_post_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_staff_member.png",
      "class" => "",
	  "weight" => "85",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of Staff to load",'thefoxwp'),
            "param_name" => "posts_per_page",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of Staff member to load",'thefoxwp')
         ),
		  array(
            "type" => "dropdown",
            "class" => "",
			"admin_label" => true,
            "heading" => __("Group",'thefoxwp'),
            "param_name" => "group",
            "value" => $from_get_terms_staff, 
            "description" => __("Choose the group of Staff to show (optional)",'thefoxwp')			
         ),
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Style 1" => "type01","Style 2" => "type02","Style 3" => "type03","Style 4" => "type04","Style 5" => "type05","Style 6" => "type06","Style 7" => "type07","Style 8" => "rstaff_01","Style 9" => "rstaff_02","Style 10" => 'rstaff_03',"Style 11" => "type08","Style 12" => "type09"), 
            "description" => __("Select the Staff style ( visual )",'thefoxwp')
         ),		 
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of columns",'thefoxwp'),
            "param_name" => "column",
            "value" => array ("1 column" => "blog_1_col", "2 columns" => "blog_2_col","3 columns" => "blog_3_col","4 columns" => 'blog_4_col'), 
            "description" => __("Choose the number of columns",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type03','type04','type05','type06','rstaff_01','rstaff_02','rstaff_03','type08'))				
         ),		 
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of columns",'thefoxwp'),
            "param_name" => "alt_column",
            "value" => array ("1 column" => "blog_1_col", "2 columns" => "blog_2_col","3 columns" => "blog_3_col","4 columns" => "blog_4_col","5 columns" => 'blog_5_col'), 
            "description" => __("Choose the number of columns",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type07','type09'))				
         ),
         array(
			'type' => 'dropdown',
            "class" => "",
            "heading" => __("Open link in new tab?",'thefoxwp'),
            "param_name" => "l_target",
            'value' => array(  'Yes'  => '_blank', 'No'  => '_self' ),
	        "description" => __("Select if you want to open member page in a new tab",'thefoxwp')
         ),	
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose staff background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type05','rstaff_01','rstaff_02','rstaff_03'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Second Background color",'thefoxwp'),
            "param_name" => "alt_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the second background color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rstaff_02'))	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type03','type04','type05','type06','rstaff_01','rstaff_02','rstaff_03','type08'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type03','type04','type05','type06','rstaff_01','rstaff_02','rstaff_03','type08'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Highlight color",'thefoxwp'),
            "param_name" => "hl_color",
            "value" => '', //Default Red color
            "description" => __("Highlight color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type03','type04','type05','type06','rstaff_01','rstaff_02','rstaff_03','type08'))
        ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Border color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type01','type02','type03','type04','type05','type06','rstaff_01','rstaff_02','rstaff_03','type08'))
         ),		
		 array(
  		 	'type' => 'dropdown',
			'heading' => __("Navigation type",'thefoxwp'),
			'param_name' => 'blog_navigation',
			'value' => array(  'No Navigation'  => '','Load More button'  => 'loadmore_nav','Classic navigation'  => 'classic_nav' ),
			'description' => __("Select the navigation type",'thefoxwp')
			),		
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load on click",'thefoxwp'),
            "param_name" => "blog_click",
            "value" => __("4",'thefoxwp'),
            "description" => __("Number of post loaded when Load more clicked",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color",'thefoxwp'),
            "param_name" => "button_bg",
            "value" => '', //Default Red color
            "description" => __("button background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color",'thefoxwp'),
            "param_name" => "button_title",
            "value" => '', //Default Red color
            "description" => __("button text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button border color",'thefoxwp'),
            "param_name" => "button_border",
            "value" => '', //Default Red color
            "description" => __("button border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color hover",'thefoxwp'),
            "param_name" => "button_hover_title",
            "value" => '', //Default Red color
            "description" => __("Text color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color hover",'thefoxwp'),
            "param_name" => "button_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Background color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ), array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation background",'thefoxwp'),
            "param_name" => "nav_bg",
            "value" => '', //Default Red color
            "description" => __("navigation background",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation text color",'thefoxwp'),
            "param_name" => "nav_color",
            "value" => '', //Default Red color
            "description" => __("navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation border color",'thefoxwp'),
            "param_name" => "nav_border",
            "value" => '', //Default Red color
            "description" => __("navigation border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation text color",'thefoxwp'),
            "param_name" => "nav_hover_color",
            "value" => '', //Default Red color
            "description" => __("Current navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation background color",'thefoxwp'),
            "param_name" => "nav_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Current navigation background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),
		  array(
  		 	'type' => 'checkbox',
			'heading' => __("Use filter?",'thefoxwp'),
			'param_name' => 'filter',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want to use filter for the staff",'thefoxwp')
			),
				
		 array(
  		 	'type' => 'dropdown',
			'heading' => __("Filter Position",'thefoxwp'),
			'param_name' => 'filter_position',
			'value' => array(  'Left'  => '','Center'  => 'filter_center'),
			'description' => __("Select the Filter position",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
			),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter text color",'thefoxwp'),
            "param_name" => "filter_text_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter background color",'thefoxwp'),
            "param_name" => "filter_background_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter border color",'thefoxwp'),
            "param_name" => "filter_border_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current 'Filter' background color",'thefoxwp'),
            "param_name" => "selected_filter_bg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current 'Filter' text color",'thefoxwp'),
            "param_name" => "selected_filter_text_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
        
      )
   ) );
}




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PORTFOLIO CAROUSEL                         /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_after_init', 'rd_recentport_sc' );
function rd_recentport_sc() {
		
	
	 
    $args_c = array('taxonomy' => 'catportfolio', 'hide_empty' => '0');
    $variable_c = get_terms('catportfolio', $args_c);
	$from_get_terms_c = array();
	$from_get_terms_c[] = 'all';
	foreach ($variable_c as $key_c => $value_c) {
        $from_get_terms_c[] = $value_c->name;
    } 

		
    $args_t = array('taxonomy' => 'tagportfolio', 'hide_empty' => '0');
    $variable_t = get_terms('tagportfolio', $args_t);
	$from_get_terms_t = array();
	$from_get_terms_t[] = 'all';
	foreach ($variable_t as $key_t => $value_t) {
        $from_get_terms_t[] = $value_t->name;
    }
		

   vc_map( array(
      "name" => __("Portfolio posts carousel",'thefoxwp'),
      "base" => "recent_port_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_portfolio_carousel.png",
      "class" => "",
	  "weight" => "86",
      "category" => __('Content','thefoxwp'),
      "params" => array(	  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Style",'thefoxwp'),
            "param_name" => "style",
            "value" => array("Style 1" => "rd_pc_1","Style 2" => "rd_pc_2","Style 3" => "cbp_type08", ), 
            "description" => __("Choose the Portfolio Style ( visual )",'thefoxwp')
         ), 
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Posts per line",'thefoxwp'),
            "param_name" => "posts_per_line",
            "value" => __("3",'thefoxwp'),
            "description" => __("Number of post per line.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),	
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
			'value' => $from_get_terms_c, 
            "description" => __("Select the Category to show / Filter By Category(optional)",'thefoxwp')			
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Tag",'thefoxwp'),
            "param_name" => "tags",
			'value' => $from_get_terms_t, 
            "description" => __("Choose the Tag to show / Filter By Tag (optional)",'thefoxwp')			
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color",'thefoxwp'),
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_pc_1','rd_pc_2'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose background color",'thefoxwp'),
        ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Second Background color",'thefoxwp'),
            "param_name" => "alt_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose second background color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_pc_2'))	
        ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Choose Border color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_pc_1','rd_pc_2'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Text color",'thefoxwp'),
            "param_name" => "h_text_color",
            "value" => '', //Default Red color
            "description" => __("Choose hover text color)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_pc_1','rd_pc_2'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Background color",'thefoxwp'),
            "param_name" => "h_bg_color",
            "value" => '', //Default Red color
            "description" => __("Hover Background colorcolor",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_pc_1','rd_pc_2'))
        ),		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Carousel Title",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Recent Posts",'thefoxwp'),
            "description" => __("Put the carousel title",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('cbp_type08'))
         ),		 	 
		 array(
            "type" => "textarea_html",
            "class" => "",
            "heading" => __("Short description",'thefoxwp'),
            "param_name" => "desc",
            "value" => __("This is an awesome carousel to show your recent blog posts.",'thefoxwp'),
            "description" => __("Put the carousel description",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('cbp_type08'))
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Description Position",'thefoxwp'),
            "param_name" => "pos",
            "value" => array("Left" => "left","Right" => 'right'), 
            "description" => __("Choose Description position",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('cbp_type08'))
         ), 
        
      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PRICING TABLE                              /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_pricing_table' );
function rd_pricing_table() {
		

   vc_map( array(
      "name" => __("Pricing Table",'thefoxwp'),
      "base" => "pricetable_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_pricing_table.png",
      "class" => "",
	  "weight" => "80",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Pricing Table Style",'thefoxwp'),
            "param_name" => "pt_style",
            "value" => array("Style 1" => "rd_pt_1","Style 2" => "rd_pt_2", "Style 3" => "rd_pt_3","Style 4" => "rd_pt_4","Style 5" => "rd_pt_5","Style 6" => "rd_pt_6","Style 7" => "rd_pt_7","Style 8" => "rd_pt_8","Style 9" => "rd_pt_9","Style 10" => "rd_pt_10","Style 11" => "rd_pt_11","Style 12" => "rd_pt_12", ), 
            "description" => __("Choose the Pricing Table Design",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the alert (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the alert (e.g 20 )",'thefoxwp')
         ), 	
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Pricing Table",'thefoxwp'),
            "param_name" => "id",
            "value" => PTid(), 
            "description" => __("Choose the Pricing Table to use",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("1st Column Highlight color",'thefoxwp'),
            "param_name" => "color_1",
            "value" => '', //Default Red color
            "description" => __("Choose the first column hightlight color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("2nd Column Highlight color",'thefoxwp'),
            "param_name" => "color_2",
            "value" => '', //Default Red color
            "description" => __("Choose the second column hightlight color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("3rd Column Highlight color",'thefoxwp'),
            "param_name" => "color_3",
            "value" => '', //Default Red color
            "description" => __("Choose the third column hightlight color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("4th Column Highlight color",'thefoxwp'),
            "param_name" => "color_4",
            "value" => '', //Default Red color
            "description" => __("Choose the fourth column hightlight color (optional)",'thefoxwp')
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("5th Column Highlight color",'thefoxwp'),
            "param_name" => "color_5",
            "value" => '', //Default Red color
            "description" => __("Choose the fifth column hightlight color (optional)",'thefoxwp')
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Recommended column highlight color",'thefoxwp'),
            "param_name" => "color_rec",
            "value" => '', //Default Red color
            "description" => __("Choose the recommended column hightlight color (optional)",'thefoxwp')
         ),
		 
        
      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PORTFOLIO                                  /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_after_init', 'rd_port_sc' );
function rd_port_sc() {
		
	
	 
    $args_c = array('taxonomy' => 'catportfolio', 'hide_empty' => '0');
    $variable_c = get_terms('catportfolio', $args_c);
	$from_get_terms_c = array();
	$from_get_terms_c[] = 'all';
	foreach ($variable_c as $key_c => $value_c) {
        $from_get_terms_c[] = $value_c->name;
    } 

		
    $args_t = array('taxonomy' => 'tagportfolio', 'hide_empty' => '0');
    $variable_t = get_terms('tagportfolio', $args_t);
	$from_get_terms_t = array();
	$from_get_terms_t[] = 'all';
	foreach ($variable_t as $key_t => $value_t) {
        $from_get_terms_t[] = $value_t->name;
    }
		   
   
		

   vc_map( array(
      "name" => __("Portfolio",'thefoxwp'),
      "base" => "portfolio",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_portfolio.png",
      "class" => "",
	  "weight" => "87",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Portfolio Design Type",'thefoxwp'),
            "param_name" => "port_type",
            "value" => array("No border, No Space" => "port_type_1", "Thin border, No space" => "port_type_2", "No border, With space" => "port_type_3", "With Border and Space" => "port_type_4", "With Bottom Title" => "port_type_5", "With Top Title" => "port_type_6", "Classic default" => "port_type_7", "Classic box odd and even" => "port_type_8", "Classic with space" => "port_type_9" ), 
            "description" => __("Choose the Portfolio Design",'thefoxwp')
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Portfolio background color",'thefoxwp'),
            "param_name" => "port_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose portfolio background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8'))	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color",'thefoxwp'),
            "param_name" => "port_title_color",
            "value" => '', //Default Red color
            "description" => __("Choose title color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8','port_type_9'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text / Tag color",'thefoxwp'),
            "param_name" => "port_text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8','port_type_9'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button color",'thefoxwp'),
            "param_name" => "port_button_color",
            "value" => '', //Default Red color
            "description" => __("Choose button color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_7','port_type_8','port_type_9'))
         ),		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "port_border_color",
            "value" => '', //Default Red color
            "description" => __("Portfolio border color",'thefoxwp'),				
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_2','port_type_4','port_type_5','port_type_6','port_type_7','port_type_8','port_type_9'))
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color Hover",'thefoxwp'),
            "param_name" => "port_hover_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose background color hover",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color Hover ",'thefoxwp'),
            "param_name" => "port_hover_title_color",
            "value" => '', //Default Red color
            "description" => __("Choose title color hover",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text / Tag color Hover",'thefoxwp'),
            "param_name" => "port_hover_text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color hover)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_5','port_type_6','port_type_7','port_type_8'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button color Hover",'thefoxwp'),
            "param_name" => "port_hover_button_color",
            "value" => '', //Default Red color
            "description" => __("Choose button color hover",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_7','port_type_8'))
         ),		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color Hover",'thefoxwp'),
            "param_name" => "port_hover_border_color",
            "value" => '', //Default Red color
            "description" => __("Choose button color hover",'thefoxwp'),				
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_4','port_type_5','port_type_6','port_type_7','port_type_8'))	
         ),		 				 		 
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Choose overlay type",'thefoxwp'),
            "param_name" => "overlay",
            "value" => array("White background" => "rd_hover_white", "White background icon" => "rd_hover_whiteic", "Gradient Background" => "rd_hover_gradient", "Bubba" => "rd_hover_bubba", "Roxy" => "rd_hover_roxy", "Layla" => "rd_hover_layla", "Chico" => "rd_hover_chico", "Lily" => "rd_hover_lily", "Sadie" => "rd_hover_sadie", "Goliath" => "rd_hover_goliath", "Steve" => "rd_hover_steve","Trending" => "rd_hover_trending",), 
            "description" => __("Choose overlay type ( some may not apply depend on the design used )",'thefoxwp')
         ),		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay title color",'thefoxwp'),
            "param_name" => "desc_title",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' => array( 'element' => 'overlay', 'value' => array('rd_hover_white','rd_hover_whiteic','rd_hover_lily','rd_hover_sadie','rd_hover_goliath','rd_hover_steve'))	
         ),		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay category color",'thefoxwp'),
            "param_name" => "desc_cat",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' => array( 'element' => 'overlay', 'value' => array('rd_hover_white','rd_hover_whiteic','rd_hover_lily','rd_hover_sadie','rd_hover_goliath','rd_hover_steve'))	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay first background color",'thefoxwp'),
            "param_name" => "overlay_color",
            "value" => '', //Default Red color
            "description" => __("Optional ( may not apply depending the overlay type)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'overlay', 'value' => array('rd_hover_gradient','rd_hover_lily','rd_hover_sadie','rd_hover_bubba','rd_hover_chico','rd_hover_roxy','rd_hover_layla','rd_hover_goliath','rd_hover_steve','rd_hover_trending'))
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay second background color",'thefoxwp'),
            "param_name" => "overlay_color_2",
            "value" => '', //Default Red color
            "description" => __("Optional ( use to create gradient effect )",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'overlay', 'value' => array('rd_hover_gradient'))
         ),		 		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Overlay border color",'thefoxwp'),
            "param_name" => "desc_border",
            "value" => '', //Default Red color
            "description" => __("Optional ( not used in all design)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'overlay', 'value' => array('overlay_type_5','overlay_type_6'))	
         ),		  	
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Thumbnail type",'thefoxwp'),
            "param_name" => "port_thumbnail",
            "value" => array("Default" => "thumbnail_type_1", "Squared" => "thumbnail_type_2", "Landscape" => "thumbnail_type_3", "Portrait" => "thumbnail_type_4", "Packery Squared (Thumbnail size set in item setting)" => "thumbnail_type_5","Packery Rectangle (Thumbnail size set in item setting)" => "thumbnail_type_6","Masonry" => 'thumbnail_type_7'), 
            "description" => __("Select the thumbnail type",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_1','port_type_2','port_type_3','port_type_4','port_type_5','port_type_6'))
			
         ),		 	  	 
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Portfolio layout",'thefoxwp'),
            "param_name" => "port_layout",
            "value" => array("1 column", "2 columns", "3 columns", "4 columns" , "5 columns",  '6 columns'), 
            "description" => __("Choose portfolio layout ( some may not apply depend on the design used )",'thefoxwp'),
		 	'dependency' => array( 'element' => 'port_type', 'value' => array('port_type_1','port_type_2','port_type_3','port_type_4','port_type_5','port_type_6'))
         ),	
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
			'value' => $from_get_terms_c, 
            "description" => __("Select the Category to show / Filter By Category(optional)",'thefoxwp')			
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Tag",'thefoxwp'),
            "param_name" => "tags",
			'value' => $from_get_terms_t, 
            "description" => __("Choose the Tag to show / Filter By Tag (optional)",'thefoxwp')			
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load",'thefoxwp'),
            "param_name" => "port_start",
            "value" => __("8",'thefoxwp'),
            "description" => __("Number of post to load for the page",'thefoxwp')
         ),
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Use filter?",'thefoxwp'),
			'param_name' => 'filter',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want to use filter for the portfolio",'thefoxwp')
			),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Filter type",'thefoxwp'),
            "param_name" => "filter_type",
            "value" => array("Type 1" => "filter_type_1", "Type 2" => "filter_type_2", "Type 3" => "filter_type_3", "Type 4" => "filter_type_4", "Type 5" => "filter_type_5", "Type 6" => "filter_type_6", "Type 7" => 'filter_type_7'), 
            "description" => __("Select the filter type",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true),
			
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter text color",'thefoxwp'),
            "param_name" => "filter_text_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter background color",'thefoxwp'),
            "param_name" => "filter_background_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Filter border color",'thefoxwp'),
            "param_name" => "filter_border_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current 'Filter' color",'thefoxwp'),
            "param_name" => "selected_filter_bg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'filter', 'not_empty' => true)
         ),
		 array(
  		 	'type' => 'dropdown',
			'heading' => __("Navigation type",'thefoxwp'),
			'param_name' => 'port_navigation',
			'value' => array(  'No navigation'  => '', 'Load More button'  => 'loadmore_nav','Classic navigation'  => 'classic_nav' ),
			'description' => __("Select the navigation type",'thefoxwp')
			),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation background",'thefoxwp'),
            "param_name" => "nav_bg",
            "value" => '', //Default Red color
            "description" => __("navigation background",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation text color",'thefoxwp'),
            "param_name" => "nav_color",
            "value" => '', //Default Red color
            "description" => __("navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation border color",'thefoxwp'),
            "param_name" => "nav_border",
            "value" => '', //Default Red color
            "description" => __("navigation border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation text color",'thefoxwp'),
            "param_name" => "nav_hover_color",
            "value" => '', //Default Red color
            "description" => __("Current navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation background color",'thefoxwp'),
            "param_name" => "nav_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Current navigation background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('classic_nav'))
         ),				
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load on click",'thefoxwp'),
            "param_name" => "port_click",
            "value" => __("4",'thefoxwp'),
            "description" => __("Number of post loaded when Load more clicked",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color",'thefoxwp'),
            "param_name" => "button_bg",
            "value" => '', //Default Red color
            "description" => __("button background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color",'thefoxwp'),
            "param_name" => "button_title",
            "value" => '', //Default Red color
            "description" => __("button text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button border color",'thefoxwp'),
            "param_name" => "button_border",
            "value" => '', //Default Red color
            "description" => __("button border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),
		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color hover",'thefoxwp'),
            "param_name" => "button_hover_title",
            "value" => '', //Default Red color
            "description" => __("Text color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color hover",'thefoxwp'),
            "param_name" => "button_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Background color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'port_navigation', 'value' => array('loadmore_nav'))
         ),
 	 
        
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD RECENT BLOG POST                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_recent_post_sc' );
function rd_recent_post_sc() {
		
   
     $available_categories  = array('all');

        $args = array(
            'type'                     => 'post',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category'
        );
        $categories = get_categories( $args );

        if (is_array($categories)) {
            foreach ($categories as $category) {
                array_push($available_categories, $category->slug);
            }
        }


   vc_map( array(
      "name" => __("Recent Blog posts",'thefoxwp'),
      "base" => "recent_blog_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_recent_blog_posts.png",
      "class" => "",
	  "weight" => "90",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Post to load",'thefoxwp'),
            "param_name" => "posts_per_page",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of posts to load",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Style 1" => "type01","Style 2" => "type02","Style 3" => "type03","Style 4" => "type04","Style 5" => "type05","Style 6" => "type06","Style 7" => "type07","Style 8" => "type08","Style 9" => "type09","Style 10" => "type10",), 
            "description" => __("Select the Posts style ( visual )",'thefoxwp')
         ),	
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
            "value" => $available_categories, 
            "description" => __("Choose the category to show (optional)",'thefoxwp')			
         ),array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Blog post background",'thefoxwp'),
            "param_name" => "blog_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose blog background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type03','type09','type10'))	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color",'thefoxwp'),
            "param_name" => "blog_heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color",'thefoxwp'),
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "blog_text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color)",'thefoxwp'),
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Highlight color",'thefoxwp'),
            "param_name" => "blog_hl_color",
            "value" => '', //Default Red color
            "description" => __("Highlight color",'thefoxwp'),
        ),		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover color",'thefoxwp'),
            "param_name" => "blog_hover_color",
            "value" => '', //Default Red color
            "description" => __("Hover color",'thefoxwp'),				
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "blog_border_color",
            "value" => '', //Default Red color
            "description" => __("Border color",'thefoxwp'),
         ),		
		 array(
  		 	'type' => 'dropdown',
			'heading' => __("Navigation type",'thefoxwp'),
			'param_name' => 'blog_navigation',
			'value' => array(  'No Navigation'  => '','Load More button'  => 'loadmore_nav' ),
			'description' => __("Select the navigation type",'thefoxwp')
			),		
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load on click",'thefoxwp'),
            "param_name" => "blog_click",
            "value" => __("4",'thefoxwp'),
            "description" => __("Number of post loaded when Load more clicked",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color",'thefoxwp'),
            "param_name" => "button_bg",
            "value" => '', //Default Red color
            "description" => __("button background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color",'thefoxwp'),
            "param_name" => "button_title",
            "value" => '', //Default Red color
            "description" => __("button text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button border color",'thefoxwp'),
            "param_name" => "button_border",
            "value" => '', //Default Red color
            "description" => __("button border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color hover",'thefoxwp'),
            "param_name" => "button_hover_title",
            "value" => '', //Default Red color
            "description" => __("Text color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color hover",'thefoxwp'),
            "param_name" => "button_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Background color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
        
      )
   ) );
}






///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD BLOG POST CAROUSEL                         /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_carousel_post_sc' );
function rd_carousel_post_sc() {
		
   
         $available_categories  = array('all');

        $args = array(
            'type'                     => 'post',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category'
        );
        $categories = get_categories( $args );

        if (is_array($categories)) {
            foreach ($categories as $category) {
                array_push($available_categories, $category->slug);
            }
        }


   vc_map( array(
      "name" => __("Blog posts Carousel",'thefoxwp'),
      "base" => "carousel_posts_sc",
	  "icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_blog_posts_carousel.png",
      "class" => "",
	  "weight" => "89",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Style 1 ( full width row )" => "cbp_type01","Style 2 ( full width row )" => "cbp_type02","Style 3" => "cbp_type03","Style 4" => "cbp_type04","Style 5" => "cbp_type05","Style 6" => "cbp_type06","Style 7" => "cbp_type08","Style 8" => 'cbp_type07'), 
            "description" => __("Select the Posts style ( visual )",'thefoxwp')
         ),	
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "h_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type03','cbp_type04'))	
         ),	
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Choose Text color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type03','cbp_type04'))	
         ),	
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover color",'thefoxwp'),
            "param_name" => "hover_color",
            "value" => '', //Default Red color
            "description" => __("Choose Hover color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type03','cbp_type04'))	
         ),		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Carousel Title",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Recent Posts",'thefoxwp'),
            "description" => __("Put the carousel title",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type04','cbp_type05','cbp_type06','cbp_type08'))
         ),		 	 
		 array(
            "type" => "textarea_html",
            "class" => "",
            "heading" => __("Short description",'thefoxwp'),
            "param_name" => "desc",
            "value" => __("This is an awesome carousel to show your recent blog posts.",'thefoxwp'),
            "description" => __("Put the carousel description",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type05','cbp_type06','cbp_type08'))
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Description Position",'thefoxwp'),
            "param_name" => "pos",
            "value" => array("Left" => "left","Right" => 'right'), 
            "description" => __("Choose Description position",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type05','cbp_type06','cbp_type08'))
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Carousel block background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose carousel background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('cbp_type05','cbp_type06','cbp_type08'))	
         ),		
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of post per line",'thefoxwp'),
            "param_name" => "posts_per_line",
            "value" => array ('4','3','2','1'), 
            "description" => __("Choose the number of post to show in line",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
            "value" => $available_categories, 
            "description" => __("Choose the category to show (optional)",'thefoxwp')			
         ),
        
      )
   ) );
}





///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD BLOG SLIDER                                /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_blog_slide_sc' );
function rd_blog_slide_sc() {
		
   
         $available_categories  = array('all');

        $args = array(
            'type'                     => 'post',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category'
        );
        $categories = get_categories( $args );

        if (is_array($categories)) {
            foreach ($categories as $category) {
                array_push($available_categories, $category->slug);
            }
        }


   vc_map( array(
      "name" => __("Blog Slider",'thefoxwp'),
      "base" => "blog_slide_sc",
	  "icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_blog_slider.png",
      "class" => "",
  	  "weight" => "88",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Style 1" => "","Style 2" => "rd_alt_slide","Style 3" => 'rd_squared_slide'), 
            "description" => __("Select the Slider visual",'thefoxwp')
         ),		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
            "value" => $available_categories, 
            "description" => __("Choose the category to show (optional)",'thefoxwp')			
         ),
        
      )
   ) );
}




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PARTNERS CAROUSEL                          /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_after_init', 'rd_partners_sc' );
function rd_partners_sc() {
		
     $args = array('taxonomy' => 'groups', 'hide_empty' => '0');
    $variable = get_terms('groups', $args);
	$part_get_terms = array();
	$part_get_terms[] = 'all';
	foreach ($variable as $key => $value) {
        $part_get_terms[] = $value->name;
    }  
        

   vc_map( array(
      "name" => __("Sponsors / Partners",'thefoxwp'),
      "base" => "partners_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_partners.png",
      "class" => "",
	  "weight" => "83",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of sponsor to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of column",'thefoxwp'),
            "param_name" => "per_line",
            "value" => array ("5 Columns" => "part_col_5","4 Columns" => "part_col_4","3 Columns" => "part_col_3","2 Columns" => "part_col_2","1 Columns" => 'part_col_1'), 
            "description" => __("Choose the number of column",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
			"admin_label" => true,
            "heading" => __("Group",'thefoxwp'),
            "param_name" => "category",
            "value" => $part_get_terms, 
            "description" => __("Choose the group of partners to show (optional)",'thefoxwp')			
         ),
        
      )
   ) );
}




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PARTNERS CAROUSEL                          /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_after_init', 'rd_partners_carousel_sc' );
function rd_partners_carousel_sc() {
		
		
     $args = array('taxonomy' => 'groups', 'hide_empty' => '0');
    $variable = get_terms('groups', $args);
	$partners_get_terms = array();
	$partners_get_terms[] = 'all';
	foreach ($variable as $key => $value) {
        $partners_get_terms[] = $value->name;
    }    
        

   vc_map( array(
      "name" => __("Sponsors / Partners Carousel",'thefoxwp'),
      "base" => "partners_carousel_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_partners_carousel.png",
      "class" => "",
	  "weight" => "82",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of sponsor to load",'thefoxwp'),
            "param_name" => "to_show",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post to load",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Numver of sponsor per line",'thefoxwp'),
            "param_name" => "per_line",
            "value" => array ('5','4','3','2','1'), 
            "description" => __("Choose the number of logo in line",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
			"admin_label" => true,
            "heading" => __("Group",'thefoxwp'),
            "param_name" => "category",
            "value" => $partners_get_terms, 
            "description" => __("Choose the group of partners to show (optional)",'thefoxwp')			
         ),
        
      )
   ) );
}




///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD DIVIDER                                    /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_divider_sc' );
function rd_divider_sc() {
     

   vc_map( array(
      "name" => __("Line / Separator",'thefoxwp'),
      "base" => "rd_line",
	  "weight" => "96",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_line_separator.png",
      "class" => "",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Line type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Normal" => "rd_line_normal", "Double" => "rd_line_double", "Dashed" => "rd_line_dashed", "Double Dashed" => "rd_line_d_dashed", "Large Dashed" => "rd_line_l_dashed", "Bold line" => "rd_line_bold", "Bold line and color" => "rd_line_bcolor" ), 
            "description" => __("Choose the Line type",'thefoxwp')
         ),	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Line color",'thefoxwp'),
            "param_name" => "color",
            "value" => '', //Default Red color
            "description" => __("Choose the Line color",'thefoxwp'),	
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Line second color",'thefoxwp'),
            "param_name" => "alt_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Line second color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rd_line_bcolor'))
         ),
		  array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Use icon?",'thefoxwp'),
            "param_name" => "use_icon",
            "value" => array ( "No" => "no","Yes" => "yes" ), 
            "description" => __("Use icon for the Line",'thefoxwp'),			
         ),
		 array(
			"type" => "4k_icon",
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"admin_label" => true,
			"description" => __("Select the icon from the list.",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))		
    	     ),
		 	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Line icon color",'thefoxwp'),
            "param_name" => "icon_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Line Icon color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))	
         ),		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon size",'thefoxwp'),
            "param_name" => "icon_size",
            "value" => __("50",'thefoxwp'),
            "description" => __("Choose the icon size (e.g 35 )",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))	
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon position",'thefoxwp'),
            "param_name" => "icon_pos",
            "value" => array ("Left" => "left", "Right" => "right", "Center" => "center" ), 
            "description" => __("Choose the Icon position",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))	
         ),			  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Line Width",'thefoxwp'),
            "param_name" => "width",
            "value" => "",
            "description" => __("Leave Blank for Full width ( e.g. 200 )",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Line position",'thefoxwp'),
            "param_name" => "line_pos",
            "value" => array ("Left" => "left", "Right" => "right", "Center" => "center" ), 
            "description" => __("Choose the Line position",'thefoxwp'),
         ),	  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "",
            "description" => __("Top margin for the Line (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "",
            "description" => __("Bottom margin for the Line (e.g 20 )",'thefoxwp')
         ), 	 
        
      )
   ) );
}

///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD VERTICAL DIVIDER                           /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_vdivider_sc' );
function rd_vdivider_sc() {
     

   vc_map( array(
      "name" => __("Vertical Line / Separator",'thefoxwp'),
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_vertical_line.png",
      "base" => "rd_vline",
	  "weight" => "95",
      "class" => "",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Line color",'thefoxwp'),
            "param_name" => "color",
            "value" => '', //Default Red color
            "description" => __("Choose the Line color",'thefoxwp'),	
         ),	  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Line Height",'thefoxwp'),
            "param_name" => "height",
            "value" => __("200",'thefoxwp'),
            "description" => __("Select the Line height (e.g 200 )",'thefoxwp')
         ),	  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Line (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Line (e.g 20 )",'thefoxwp')
         ),	 
      
      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD SEARCH FORM                                /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_search_sc' );
function rd_search_sc() {
     

   vc_map( array(
      "name" => __("Search Field",'thefoxwp'),
      "base" => "rd_search",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_search.png",
      "class" => "",
	  "weight" => "56",
      "category" => __('Content','thefoxwp'),
      "params" => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Text color",'thefoxwp'),	
         ),array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Background color",'thefoxwp'),	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "b_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Border color",'thefoxwp'),	
         ),	
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover color",'thefoxwp'),
            "param_name" => "h_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Hover color",'thefoxwp'),	
         ),	  		  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Place Holder",'thefoxwp'),
            "param_name" => "placeholder",
            "value" => __("Search",'thefoxwp'),
            "description" => __("Place Holder text for the search form",'thefoxwp')
         ),	  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Search Field Width",'thefoxwp'),
            "param_name" => "width",
            "value" => "",
            "description" => __("Leave Blank for Full width (e.g 200 )",'thefoxwp')
         ),	  		  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Border Radius",'thefoxwp'),
            "param_name" => "radius",
            "value" => "0",
            "description" => __("Border Radius of the Form (e.g 5)",'thefoxwp')
         ),		  		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Line (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Line (e.g 20 )",'thefoxwp')
         ),	 
      
      )
   ) );
}

///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            CALL TO ACTION BOX                             /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_cta_sc' );
function rd_cta_sc() {
     

   vc_map( array(
      "name" => __("Promo box",'thefoxwp'),
      "base" => "rd_cta",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_promo_box.png",
      "class" => "",
	  "weight" => "64",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",	
            "heading" => __("Promo box style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Style 1" => "rd_cta_1", "Style 2" => "rd_cta_2", "Style 3" => "rd_cta_3" ), 
            "description" => __("Choose Box Design",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),	 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Box Title",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Box Title",'thefoxwp'),
            "description" => __("Enter the Title for the Box",'thefoxwp')
         ),  
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title color",'thefoxwp'),
            "param_name" => "title_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Title color",'thefoxwp'),	
         ), 
         array(
            "type" => "textarea",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Box Text",'thefoxwp'),
            "param_name" => "content",
            "value" => __('This is the main text','thefoxwp'), 
            "description" => __("Heading for the module",'thefoxwp')
         ),				 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Text color",'thefoxwp'),	
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the box background color",'thefoxwp'),
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box Border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Choose the box border color",'thefoxwp'),
         ),		 		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box Left Border color",'thefoxwp'),
            "param_name" => "left_border_color",
            "value" => '', //Default Red color
            "description" => __("Choose the box left border color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_2'))
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button text",'thefoxwp'),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("Enter the button text",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1','rd_cta_2'))
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button link",'thefoxwp'),
            "param_name" => "button_link",
            "value" => "",
            "description" => __("Enter the link for the button",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1','rd_cta_2'))
         ),  
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button text color",'thefoxwp'),
            "param_name" => "button_color",
            "value" => '', //Default Red color
            "description" => __("Choose the button text color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1','rd_cta_2'))	
         ),   
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button background color",'thefoxwp'),
            "param_name" => "button_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the button background color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1','rd_cta_2'))	
         ),  
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button hover background color",'thefoxwp'),
            "param_name" => "button_hover_color",
            "value" => '', //Default Red color
            "description" => __("Choose the button hover color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1','rd_cta_2'))		
         ), 
		 
		 array(
			"type" => "4k_icon",
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"admin_label" => true,
			"description" => __("Select the icon from the list.",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1'))		
    	     ),
		 	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("icon color",'thefoxwp'),
            "param_name" => "icon_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Icon color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1'))	
         ),		  
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("icon background color",'thefoxwp'),
            "param_name" => "icon_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Icon background color",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1'))	
         ),		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Icon size",'thefoxwp'),
            "param_name" => "icon_size",
            "value" => __("25",'thefoxwp'),
            "description" => __("Choose the icon size (e.g 35 )",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_cta_1'))		
         ), 		  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Box (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Box (e.g 20 )",'thefoxwp')
         ), 	 
        
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD COUNT TO    		                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_count_to_sc' );
function rd_count_to_sc() {
		



   vc_map( array(
      "name" => __("Count to",'thefoxwp'),
      "base" => "count_sc",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_count_to.png",
      "class" => "",
	  "weight" => "60",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Count to type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Default no icon" => "","Medium Text" => "9","Big Text" => "7", "In circle" => "2", "With small Icon" => "3", "With small Icon Gradient" => "11", "With Medium icon" => "8", "With Medium Stroke icon" => "10", "With Big icon" => "4", "With Big icon, big text" => "5" , "In Box" => "6" ), 
            "description" => __("Choose the 'Count to' type",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number",'thefoxwp'),
            "param_name" => "Number",
            "value" => "",
            "description" => __("Use '.' to separate the number example 3.50",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("number of decimal",'thefoxwp'),
            "param_name" => "decimals",
            "value" => "0",
            "description" => __("Default 0",'thefoxwp')
         ),		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Speed",'thefoxwp'),
            "param_name" => "speed",
            "value" => __("1000",'thefoxwp'),
            "description" => __("Example : 1 = super fast , 1500 = normal , 5000 = slow",'thefoxwp')
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Number color",'thefoxwp'),
            "param_name" => "number_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Number color",'thefoxwp'),
            "param_name" => "h_number_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('2'))	
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Line color",'thefoxwp'),
            "param_name" => "line_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('8'))	
         ),  
         array(
            "type" => "textarea",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Heading",'thefoxwp'),
            "param_name" => "content",
            "value" => __('Potatoes','thefoxwp'), 
            "description" => __("Heading for the module",'thefoxwp')
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
         ),	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Heading color",'thefoxwp'),
            "param_name" => "h_heading_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('2'))	
         ),		 	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover background color",'thefoxwp'),
            "param_name" => "h_bg",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('2'))		
         ),
		 	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box background color",'thefoxwp'),
            "param_name" => "bbg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('6'))			
         ),	 
		 	 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box border color",'thefoxwp'),
            "param_name" => "bb_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('6'))			
         ),	 
		 array(
             'type' => '4k_icon',
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Select the icon from the list.", 'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('3','4','5','6','8','10','11'))			
    	     ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "i_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('3','4','5','6','8','10','11'))			
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon background color",'thefoxwp'),
            "param_name" => "i_bg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('8','11'))			
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon second background color",'thefoxwp'),
            "param_name" => "i_bg_alt_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('11'))			
         ),		  

      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD ICON BOX			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_icon_para_sc' );
function rd_icon_para_sc() {
		



   vc_map( array(
      "name" => __("Paragraph with icon",'thefoxwp'),
      "base" => "iconbox",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_paragraph_icon.png",
      "class" => "",
	  "weight" => "71",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("IconBox type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Small Icon only" => "10","Medium Icon only" => "11","Icon only" => "1", "Rounded" => "2", "Rounded ( trending )" => "13","Rounded Stroke" => "9","Big Rounded Stroke" => "12", "Hexagon" => "3", "Squared" => "4", "Big Square" => "7", "Square background pattern" => "8", "Big rounded" => "5", "Big rounded square" => "6" ), 
            "description" => __("Choose the icon box type",'thefoxwp'),
         	),	  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
			"description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
			),  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the Box (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the Box (e.g 20 )",'thefoxwp')
         ), 
		 array(
                    'type' => '4k_icon',
			"class" => "",
			"heading" => __("Select Icon:", 'thefoxwp'),
			"param_name" => "icon",
			"admin_label" => true,
			"value" => "android",
			"description" => __("Select the icon from the list.", 'thefoxwp'),		
    	     ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "i_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Background color",'thefoxwp'),
            "param_name" => "i_bg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('13'))	
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon Border color",'thefoxwp'),
            "param_name" => "i_b_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('13'))	
         ), 
		 array(
            "type" => "textfield",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Heading",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Awesome heading!",'thefoxwp'),
            "description" => __("Enter the heading",'thefoxwp')
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
         ), 
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Main text",'thefoxwp'),
            "param_name" => "content",
            "value" => __('Awesome main text goes here','thefoxwp'), 
            "description" => __("Enter the main text",'thefoxwp')
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Main text color",'thefoxwp'),
            "param_name" => "content_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
         ),  
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button text",'thefoxwp'),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("Enter if you want to use a button",'thefoxwp')
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button text color",'thefoxwp'),
            "param_name" => "button_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'button_text', 'not_empty' => true)	
         ),	
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Link",'thefoxwp'),
            "param_name" => "link",
            "value" => "",
            "description" => __("Enter if you want to put a link for the box",'thefoxwp')
         ),		 
         array(
			'type' => 'dropdown',
            "class" => "",
            "heading" => __("Open link in new tab?",'thefoxwp'),
            "param_name" => "target",			
		 	'dependency' => array( 'element' => 'link', 'not_empty' => true),	
            'value' => array(  'Yes'  => '_blank', 'No'  => '_self' ),
	        "description" => __("Select if you want to open the link in a new tab",'thefoxwp')
         ),	 
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Change color on hover?",'thefoxwp'	),
			'param_name' => 'change_hover',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want the box to change color on hover",'thefoxwp'	),
		),
			
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Icon color",'thefoxwp'),
            "param_name" => "hover_i_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)		
         ),		  
			 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Heading color",'thefoxwp'),
            "param_name" => "hover_t_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Text color",'thefoxwp'),
            "param_name" => "hover_text_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Button text color",'thefoxwp'),
            "param_name" => "hover_button_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ),		  

      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD GOOGLE MAP			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_gmaps_sc' );
function rd_gmaps_sc() {
		



   vc_map( array(
      "name" => __("Google maps",'thefoxwp'),
      "base" => "rd_gmaps",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_gmaps.png",
      "class" => "",
	  "weight" => "78",
      "category" => __('Map','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Map title",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Our headquarters",'thefoxwp'),
            "description" => __("optional",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Map height",'thefoxwp'),
            "param_name" => "height",
            "value" => __("400px",'thefoxwp'),
            "description" => __("Example 500px",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Latitude",'thefoxwp'),
            "param_name" => "lat",
            "value" => __("40.843292",'thefoxwp'),
            "description" => __("needed",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Longitude",'thefoxwp'),
            "param_name" => "lng",
            "value" => __("-73.864512",'thefoxwp'),
            "description" => __("needed",'thefoxwp')
         ),
		  array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Zoom",'thefoxwp'),
            "param_name" => "zoom",
            "value" => __("12",'thefoxwp'),
            "description" => __("Example : 20 ( for a close view ) , 5 ( for a far view )",'thefoxwp')
         ),
		 array(
			'type' => 'attach_image',
			'heading' => __( 'Image to replace marker', 'thefoxwp' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select the image to replace the original map marker (optional).', 'thefoxwp' )
		),
        
      )
   ) );
}

///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD BLOG                                       /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_blog_sc' );
function rd_blog_sc() {
		
   
         $available_categories  = array('all');

        $args = array(
            'type'                     => 'post',
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'exclude'                  => '',
            'include'                  => '',
            'number'                   => '',
            'taxonomy'                 => 'category'
        );
        $categories = get_categories( $args );

        if (is_array($categories)) {
            foreach ($categories as $category) {
                array_push($available_categories, $category->slug);
            }
        }


   vc_map( array(
      "name" => __("Blog",'thefoxwp'),
      "base" => "blog_sc",
	  "icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_blog.png",
	  "weight" => "91",
      "class" => "",
      "category" => __('Content','thefoxwp'),
      "params" => array(
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Post per page",'thefoxwp'),
            "param_name" => "posts_per_page",
            "value" => __("5",'thefoxwp'),
            "description" => __("Number of post per page",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Blog type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Standard" => "type1","Standard Trending" => "type7", "Grid" => "type4", "Grid Trending" => "type6", "Masonry" => "type3",	"Timeline" => "type2",	"Multi Author" => 'type5'), 
            "description" => __("Choose the Blog Type ( Design )",'thefoxwp')
         ),		 
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Blog number of columns",'thefoxwp'),
            "param_name" => "column",
            "value" => array ("4 columns" => "blog_4_col", "3 columns" => "blog_3_col", "2 columns" => 'blog_2_col'), 
            "description" => __("Choose the number of columns",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'type', 'value' => array('type3','type4','type6'))	
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Thumbnail size",'thefoxwp'),
            "param_name" => "tn_size",
            "value" => array ("Croped" => "", "Image Original Size" => 'full'), 
            "description" => __("Choose if you want the images to be croped or full width",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'type', 'value' => array('type1','type2','type5'))	
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Category",'thefoxwp'),
            "param_name" => "category",
            "value" => $available_categories, 
            "description" => __("Choose the category to show (optional)",'thefoxwp')			
         ),array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Blog post background",'thefoxwp'),
            "param_name" => "blog_bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose blog background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type2','type3','type5','type6','type7'))	
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading Color",'thefoxwp'),
            "param_name" => "blog_heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color",'thefoxwp'),
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "blog_text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color)",'thefoxwp'),
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Highlight color",'thefoxwp'),
            "param_name" => "blog_hl_color",
            "value" => '', //Default Red color
            "description" => __("Highlight color",'thefoxwp'),
        ),		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover color",'thefoxwp'),
            "param_name" => "blog_hover_color",
            "value" => '', //Default Red color
            "description" => __("Hover color",'thefoxwp'),				
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "blog_border_color",
            "value" => '', //Default Red color
            "description" => __("Border color",'thefoxwp'),
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline date box color",'thefoxwp'),
            "param_name" => "blog_timelinedb_color",
            "value" => '', //Default Red color
            "description" => __("Timeline date box color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type2'))
         ),		 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Vertical Line first color",'thefoxwp'),
            "param_name" => "blog_v_color",
            "value" => '', //Default Red color
            "description" => __("Timeline Vertical Line first color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type2'))
        ),		  
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Timeline Vertical Line second color",'thefoxwp'),
            "param_name" => "blog_v_alt_color",
            "value" => '', //Default Red color
            "description" => __("Timeline Vertical Line second color ( for gradient )",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('type2'))				
         ),
		 array(
  		 	'type' => 'dropdown',
			'heading' => __("Navigation type",'thefoxwp'),
			'param_name' => 'blog_navigation',
			'value' => array(  'Load More button'  => 'loadmore_nav','Classic navigation'  => 'classic_nav' ),
			'description' => __("Select the navigation type",'thefoxwp'),
			'dependency' => array( 'element' => 'type', 'value' => array('type1','type4','type3','type5','type6','type7'))
			),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation background",'thefoxwp'),
            "param_name" => "nav_bg",
            "value" => '', //Default Red color
            "description" => __("navigation background",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation text color",'thefoxwp'),
            "param_name" => "nav_color",
            "value" => '', //Default Red color
            "description" => __("navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Navigation border color",'thefoxwp'),
            "param_name" => "nav_border",
            "value" => '', //Default Red color
            "description" => __("navigation border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation text color",'thefoxwp'),
            "param_name" => "nav_hover_color",
            "value" => '', //Default Red color
            "description" => __("Current navigation text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Current navigation background color",'thefoxwp'),
            "param_name" => "nav_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Current navigation background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('classic_nav'))
         ),				
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of post to load on click",'thefoxwp'),
            "param_name" => "blog_click",
            "value" => __("4",'thefoxwp'),
            "description" => __("Number of post loaded when Load more clicked",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color",'thefoxwp'),
            "param_name" => "button_bg",
            "value" => '', //Default Red color
            "description" => __("button background color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color",'thefoxwp'),
            "param_name" => "button_title",
            "value" => '', //Default Red color
            "description" => __("button text color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button border color",'thefoxwp'),
            "param_name" => "button_border",
            "value" => '', //Default Red color
            "description" => __("button border color",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
		 	 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button text color hover",'thefoxwp'),
            "param_name" => "button_hover_title",
            "value" => '', //Default Red color
            "description" => __("Text color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),				 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Loadmore button background color hover",'thefoxwp'),
            "param_name" => "button_hover_bg",
            "value" => '', //Default Red color
            "description" => __("Background color on hover",'thefoxwp'),			
		 	'dependency' => array( 'element' => 'blog_navigation', 'value' => array('loadmore_nav'))
         ),
        
      )
   ));
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD ICON BOX 2			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_icon_box_sc' );
function rd_icon_box_sc() {
		



   vc_map( array(
      "name" => __("IconBox",'thefoxwp'),
      "base" => "iconbox2",
	  "icon" => get_template_directory_uri() . "/images/vc_icons/vc_icon_box.png",
      "class" => "",
	  "weight" => "72",
      "category" => __('Content','thefoxwp'),
      "params" => array(	  

array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("IconBox type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("type 1 ( small rounded icon top of box )" => "st", "type 2 ( medium rounded icon top of box )" => "simple", "type 3 ( big rounded icon top of box )" => "default","type 4 ( small rounded icon with background patern )" => "sc", "type 5 ( medium rounded icon )" => "big_circle","type 6 ( big rounded icon )" => "big_cg","type 7 ( big rounded icon Trending )" => "big_cg_trending","type 8 ( medium hexagon icon )" => "hex","type 9 ( in box hexagon icon )" => "hex_box", "type 10 ( in box big rounded icon )" => "br", "type 11 ( rounded icon in left part of the box )" => "left_b",  "type 12 ( in box need to be use in full width row )" => "super_simple",  "type 13 ( in box need to be use in full width row )" => "trending_box", ), 
            "description" => __("Choose the icon box type",'thefoxwp')
         ),  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the Box (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the Box (e.g 20 )",'thefoxwp')
         ), 
		 array(
            'type' => '4k_icon',
			"class" => "",
			"heading" => __("Select Icon:", 'thefoxwp'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Select the icon from the list.", 'thefoxwp'),		
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "i_color",
            "value" => '', //Default Red color
            "description" => __("Choose the icon color",'thefoxwp'),
         ), 	
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon second color",'thefoxwp'),
            "param_name" => "i_alt_color",
            "value" => '', //Default Red color
            "description" => __("Gradient or Alternate background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type','value' => array('hex','big_cg','big_cg_trending'))
         ), 		 		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box background color",'thefoxwp'),
            "param_name" => "boxbg_color",
            "value" => '', //Default Red color
            "description" => __("Choose box background color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('default','simple','super_simple','hex_box','left_b','br','trending_box'))	
         ), 
		 		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Box border color",'thefoxwp'),
            "param_name" => "boxb_color",
            "value" => '', //Default Red color
            "description" => __("Choose box border color (optional)",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('default','simple','super_simple','hex_box','left_b','br','big_cg_trending','trending_box'))	
         ), 
		 array(
            "type" => "textfield",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Heading",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Awesome heading!",'thefoxwp'),
            "description" => __("Enter the heading",'thefoxwp')
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Choose the heading color",'thefoxwp'),	
         ),	 
		 array(
            "type" => "textfield",
			"admin_label" => true,
            "class" => "",
            "heading" => __("Sub title",'thefoxwp'),
            "param_name" => "subtitle",
            "value" => __("Awesome heading!",'thefoxwp'),
            "description" => __("Enter the Subtitle",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type','value' => array('big_cg_trending'))
         ),
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Subtitle color",'thefoxwp'),
            "param_name" => "st_color",
            "value" => '', //Default Red color
            "description" => __("Choose the subtitle color",'thefoxwp'),
            "description" => __("Enter the Subtitle",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type','value' => array('big_cg_trending'))	
         ),		 
         array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Main text",'thefoxwp'),
            "param_name" => "content",
            "value" => __('Here enter your main text','thefoxwp'), 
            "description" => __("Enter the main text",'thefoxwp')
         ),		 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Main text color",'thefoxwp'),
            "param_name" => "content_color",
            "value" => '', //Default Red color
            "description" => __("Choose the main text color",'thefoxwp'),	
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("button text",'thefoxwp'),
            "param_name" => "button_text",
            "value" => "",
            "description" => __("Enter if you want to use a button",'thefoxwp')
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button background color",'thefoxwp'),
            "param_name" => "button_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'button_text', 'not_empty' => true)	
         ),		  
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button border color",'thefoxwp'),
            "param_name" => "button_b_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'button_text', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button text color",'thefoxwp'),
            "param_name" => "button_t_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'button_text', 'not_empty' => true)	
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Link",'thefoxwp'),
            "param_name" => "link",
            "value" => "",
            "description" => __("Enter if you want to put a link for the box",'thefoxwp')
         ),		 
         array(
			'type' => 'dropdown',
            "class" => "",
            "heading" => __("Open link in new tab?",'thefoxwp'),
            "param_name" => "target",			
		 	'dependency' => array( 'element' => 'link', 'not_empty' => true),	
            'value' => array(  'Yes'  => '_blank', 'No'  => '_self' ),
	        "description" => __("Select if you want to open the link in a new tab",'thefoxwp')
         ),	 
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Change color on hover?",'thefoxwp'),
			'param_name' => 'change_hover',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want the box to change color on hover",'thefoxwp')
		),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Icon color",'thefoxwp'),
            "param_name" => "hover_i_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)		
         ),		  
			 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Box background color",'thefoxwp'),
            "param_name" => "hover_boxbg_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true),
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Box border color",'thefoxwp'),
            "param_name" => "hover_boxb_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Heading color",'thefoxwp'),
            "param_name" => "hover_t_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Main text color",'thefoxwp'),
            "param_name" => "hover_text_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Button background color",'thefoxwp'),
            "param_name" => "hover_button_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)	
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Button text color",'thefoxwp'),
            "param_name" => "hover_button_t_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),	
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)		
         ), 
		  array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover Button border color",'thefoxwp'),
            "param_name" => "hover_button_b_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),		
		 	'dependency' => array( 'element' => 'change_hover', 'not_empty' => true)
		 ),


         
 )
 
 )) ;
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD BUTTON  			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_button_sc' );
function rd_button_sc() {
		



   vc_map( array(
      "name" => __("Button",'thefoxwp'),
      "base" => "button",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_button.png",
      "class" => "",
	  "weight" => "70",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ("Normal" => "rd_normal_bt", "Stroke" => "rd_stroke_bt", "3D" => "rd_3d_bt", "3D Stroke" => "rd_3dstroke_bt", ), 
            "description" => __("Choose the Button type",'thefoxwp')
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),		 
	     array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button size",'thefoxwp'),
            "param_name" => "size",
            "value" => array ("Small" => "small_rd_bt", "Small Medium" => "smallmedium_rd_bt", "Medium" => "medium_rd_bt","Medium Large" => "mediumlarge_rd_bt", "Large" => "large_rd_bt","X Large" => "xlarge_rd_bt" ), 
            "description" => __("Choose the Button size",'thefoxwp')
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Use icon?",'thefoxwp'),
            "param_name" => "use_icon",
            "value" => array ( "No" => "no","Yes" => "yes" ), 
            "description" => __("Use icon for the button?",'thefoxwp'),			
         ),
		 array(
			"type" => "4k_icon",
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"admin_label" => true,
			"description" => __("Select the icon from the list.",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))		
    	     ),
			 
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon position",'thefoxwp'),
            "param_name" => "icon_position",
            "value" => array ( "Left" => "bt_icon_left","Right" => "bt_icon_right" ), 
            "description" => __("CHoose the icon position",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))				
         ),
			 
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon type",'thefoxwp'),
            "param_name" => "icon_type",
            "value" => array ( "Icon only" => "","Icon with border" => "bt_icon_border" ), 
            "description" => __("CHoose the icon type",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))				
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "icon_color",
            "value" => '', //Default Red color
            "description" => __("Select button Icon color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Select button text / border color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button background color",'thefoxwp'),
            "param_name" => "b_color",
            "value" => '', //Default Red color
            "description" => __("Select the button background color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Button alternate background color ( to create gradient )",'thefoxwp'),
            "param_name" => "alt_b_color",
            "value" => '', //Default Red color
            "description" => __("Optional",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('rd_normal_bt', 'rd_3d_bt'))		
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover text color",'thefoxwp'),
            "param_name" => "t_hover_color",
            "value" => '', //Default Red color
            "description" => __("Hover text and border color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover background color",'thefoxwp'),
            "param_name" => "b_hover_color",
            "value" => '', //Default Red color
            "description" => __("Hover background color",'thefoxwp'),
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Border radius",'thefoxwp'),
            "param_name" => "radius",
            "value" => '', //Default Red color
            "description" => __("Enter only number e.g 10",'thefoxwp'),			
         ),		 	 
	     array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Border size",'thefoxwp'),
            "param_name" => "border_size",
            "value" => array ("1px" => "border_1px","2px" => "border_2px","3px" => "border_3px","4px" => "border_4px","5px" => "border_5px","6px" => "border_6px", ), 
            "description" => __("Choose the Button border size",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'type', 'value' => array('rd_stroke_bt'))		
         ), 
		 array(
            "type" => "textfield",			
			"admin_label" => true,
            "class" => "",
            "heading" => __("Button text",'thefoxwp'),
            "param_name" => "content",
            "value" => __("Button text",'thefoxwp'),
            "description" => __("Enter button text",'thefoxwp')
         ), 	 	 
	     array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Font weight",'thefoxwp'),
            "param_name" => "font_weight",
            "value" => array ("Ultra bold" => "900","Bold" => "700","Normal" => "500","Light" => "300", ), 
            "description" => __("Choose the Button Font weight",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Button link",'thefoxwp'),
            "param_name" => "url",
            "value" => "",
            "description" => __("Link for the button ( don't forget http://",'thefoxwp')
         ),
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Open in a new tab?",'thefoxwp'),
			'param_name' => 'target',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you the link to open in a new tab",'thefoxwp'),
		 	'dependency' => array( 'element' => 'url', 'not_empty' => true),
			),	 	 
	     array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button position",'thefoxwp'),
            "param_name" => "position",
            "value" => array ("left" => "ta_left","right" => "ta_right","center" => "ta_center" ), 
            "description" => __("Choose the Button position",'thefoxwp')
         ), 		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Left Margin",'thefoxwp'),
            "param_name" => "ml",
            "value" => "0",
            "description" => __("Left margin for the button (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Right Margin",'thefoxwp'),
            "param_name" => "mr",
            "value" => "0",
            "description" => __("Right margin for the button (e.g 20 )",'thefoxwp')
         ), 		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the button (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the button (e.g 20 )",'thefoxwp')
         ), 
        
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD 2 BUTTON  			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_double_button_sc' );
function rd_double_button_sc() {
		



   vc_map( array(
      "name" => __("Double Button",'thefoxwp'),
      "base" => "double_button",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_double_button.png",
      "class" => "",
	  "weight" => "69",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Button style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Style 1" => "rd_db_1","Style 2" => "rd_db_2","Style 3" => "rd_db_3","Style 4" => "rd_db_4","Style 5" => "rd_db_5","Style 6" => "rd_db_6" ), 
            "description" => __("Choose the Button style",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",			
			"admin_label" => true,
            "class" => "",
            "heading" => __("First Button text",'thefoxwp'),
            "param_name" => "f_b_text",
            "value" => __("Button text",'thefoxwp'),
            "description" => __("Enter first button text",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("First Button link",'thefoxwp'),
            "param_name" => "f_url",
            "value" => "",
            "description" => __("Link for the first button ( don't forget http:// )",'thefoxwp')
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("First Button text color",'thefoxwp'),
            "param_name" => "f_t_color",
            "value" => '', //Default Red color
            "description" => __("Select First button text / border color",'thefoxwp')
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("First Button background color",'thefoxwp'),
            "param_name" => "f_b_color",
            "value" => '', //Default Red color
            "description" => __("Select the First button background color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover text color",'thefoxwp'),
            "param_name" => "f_t_hover_color",
            "value" => '', //Default Red color
            "description" => __("First button Hover text and border color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover background color",'thefoxwp'),
            "param_name" => "f_b_hover_color",
            "value" => '', //Default Red color
            "description" => __("First button Hover background color",'thefoxwp'),
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("First Button CSS Animation",'thefoxwp'),
            "param_name" => "f_animation",
			'value' => array("No" => "", "Fade In" => "rda_fadeIn", "Fade Top to Bottom" => "rda_fadeInDown", "Fade Bottom to Top" => "rda_fadeInUp", "Fade Left to Right" => "rda_fadeInLeft", "Fade Right to Left" => "rda_fadeInRight", "Bounce In" => "rda_bounceIn", "Bounce Top to Bottom" => "rda_bounceInDown", "Bounce Bottom to Top" => "rda_bounceInUp", "Bounce Left to Right" => "rda_bounceInLeft", "Bounce Right to Left" => "rda_bounceInRight", "Zoom In" => "rda_zoomIn", "Flip Vertical" => "rda_flipInX", "Flip Horizontal" => "rda_flipInY", "Bounce" => "rda_bounce", "Flash" => "rda_flash", "Shake" => "rda_shake", "Pulse" => "rda_pulse", "Swing" => "rda_swing", "Rubber band" => "rda_rubberBand", "Wobble" => "rda_wobble", "Tada!" => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",	'thefoxwp')),  
		 array(
            "type" => "textfield",			
			"admin_label" => true,
            "class" => "",
            "heading" => __("Second Button text",'thefoxwp'),
            "param_name" => "s_b_text",
            "value" => __("Button text",'thefoxwp'),
            "description" => __("Enter Second button text",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Second Button link",'thefoxwp'),
            "param_name" => "s_url",
            "value" => "",
            "description" => __("Link for the Second button ( don't forget http:// )",'thefoxwp')
         ),
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Second Button text color",'thefoxwp'),
            "param_name" => "s_t_color",
            "value" => '', //Default Red color
            "description" => __("Select Second button text / border color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Second Button background color",'thefoxwp'),
            "param_name" => "s_b_color",
            "value" => '', //Default Red color
            "description" => __("Select the Second button background color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover text color",'thefoxwp'),
            "param_name" => "s_t_hover_color",
            "value" => '', //Default Red color
            "description" => __("Second button Hover text and border color",'thefoxwp'),
         ), 
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Hover background color",'thefoxwp'),
            "param_name" => "s_b_hover_color",
            "value" => '', //Default Red color
            "description" => __("Second button Hover background color",'thefoxwp'),
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Second Button CSS Animation",'thefoxwp'),
            "param_name" => "s_animation",
			'value' => array("No" => "", "Fade In" => "rda_fadeIn", "Fade Top to Bottom" => "rda_fadeInDown", "Fade Bottom to Top" => "rda_fadeInUp", "Fade Left to Right" => "rda_fadeInLeft", "Fade Right to Left" => "rda_fadeInRight", "Bounce In" => "rda_bounceIn", "Bounce Top to Bottom" => "rda_bounceInDown", "Bounce Bottom to Top" => "rda_bounceInUp", "Bounce Left to Right" => "rda_bounceInLeft", "Bounce Right to Left" => "rda_bounceInRight", "Zoom In" => "rda_zoomIn", "Flip Vertical" => "rda_flipInX", "Flip Horizontal" => "rda_flipInY", "Bounce" => "rda_bounce", "Flash" => "rda_flash", "Shake" => "rda_shake", "Pulse" => "rda_pulse", "Swing" => "rda_swing", "Rubber band" => "rda_rubberBand", "Wobble" => "rda_wobble", "Tada!" => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ), 		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the buttons (e.g 20 )",'thefoxwp')
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the buttons (e.g 20 )",'thefoxwp')
         ),	

      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD ALERTS  			                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_alert_sc' );
function rd_alert_sc() {

   vc_map( array(
      "name" => __("Alerts Message",'thefoxwp'),
      "base" => "vc_alert",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_alert.png",
      "class" => "",
	  "weight" => "63",
      "category" => __('Content','thefoxwp'),
      "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Alert style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Clear" => "rd_clear_alert", "Solid" => "rd_solid_alert", "Big" => "rd_big_alert", "Small" => "rd_small_alert", ), 
            "description" => __("Choose the Alert style ( visual )",'thefoxwp'),
         ),		 
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Alert type",'thefoxwp'),
            "param_name" => "type",
            "value" => array ( "Notice" => "rd_notice_alert", "Success" => "rd_success_alert", "Warning" => "rd_warning_alert", "Error" => "rd_error_alert", "Info" => "rd_info_alert" ), 
            "description" => __("Choose the Alert type",'thefoxwp'),
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),	
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Alert Title",'thefoxwp'),
            "param_name" => "title",
            "description" => __("Alert title",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_clear_alert', 'rd_solid_alert','rd_big_alert'))		
         ), 
		 array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Alert Text",'thefoxwp'),
            "param_name" => "content",
            "description" => __("Alert main text",'thefoxwp'),
         ),  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "mt",
            "value" => "0",
            "description" => __("Top margin for the alert (e.g 20 )",'thefoxwp'),
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "mb",
            "value" => "0",
            "description" => __("Bottom margin for the alert (e.g 20 )",'thefoxwp'),
         ), 
        
      )
   ) );
}


///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PIE CHART                                  /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////


add_action( 'vc_before_init', 'rd_piechart_sc' );
function rd_piechart_sc() {
   vc_map( array(
      "name" => __("Pie Chart",'thefoxwp'),
      "base" => "rd_chart",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_chart.png",
      "class" => "",
	  "weight" => "61",
      "category" => __('Content','thefoxwp'),
      "params" => array(	  
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Pie Chart Style",'thefoxwp'),
            "param_name" => "type",
            "value" => array("Style 1" => "rd_pie_01","Style 2" => "rd_pie_02","Style 3" => "rd_pie_03","Style 4" => "rd_pie_04","Style 5" => "rd_pie_05" ), 
            "description" => __("Choose the Pie chart Design",'thefoxwp'),
         ),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Percentage",'thefoxwp'),
            "param_name" => "percentage",
            "value" => __("80",'thefoxwp'),
            "description" => __("Enter the percentage ( e.g 80 )",'thefoxwp'),
         ),	 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Percentage color",'thefoxwp'),
            "param_name" => "p_color",
            "value" => '', //Default Red color
            "description" => __("Choose percentage text color",'thefoxwp'),
         ),		 	 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Percentage text background color",'thefoxwp'),
            "param_name" => "p_b_color",
            "value" => '', //Default Red color
            "description" => __("Choose percentage text background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rd_pie_02','rd_pie_03'))	
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Bar color",'thefoxwp'),
            "param_name" => "bar_color",
            "value" => '', //Default Red color
            "description" => __("Choose bar color",'thefoxwp'),
         ),	 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Bar alternative color ( for gradient )",'thefoxwp'),
            "param_name" => "bar_alt_color",
            "value" => '', //Default Red color
            "description" => __("Choose bar alternative color if you want to create a gradient effect (optional)",'thefoxwp'),
         ),	 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Track color",'thefoxwp'),
            "param_name" => "track_color",
            "value" => '', //Default Red color
            "description" => __("Choose the track color ( path color )",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rd_pie_01','rd_pie_03','rd_pie_04','rd_pie_05'))	
         ),	 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Choose the Pie chart background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rd_pie_02','rd_pie_03'))
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Ball color",'thefoxwp'),
            "param_name" => "ball_color",
            "value" => '', //Default Red color
            "description" => __("Choose ball color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'type', 'value' => array('rd_pie_05'))
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Pie Chart Heading",'thefoxwp'),
            "param_name" => "heading",
			"admin_label" => true,
            "value" => "",
            "description" => __("Pie Chart Heading (optional)",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Heading color",'thefoxwp'),
            "param_name" => "heading_color",
            "value" => '', //Default Red color
            "description" => __("Choose heading color (optional)",'thefoxwp'),
         ),
		 array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("Pie Chart Text",'thefoxwp'),
            "param_name" => "text",
            "value" => "",
            "description" => __("Pie Chart Text (optional)",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Text color",'thefoxwp'),
            "param_name" => "text_color",
            "value" => '', //Default Red color
            "description" => __("Choose text color (optional)",'thefoxwp'),
         ),	
         
      )
   ) );
}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            ADD PROGRESS BAR 		                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_progressbar_sc' );
function rd_progressbar_sc() {
vc_map( array(
    "name" => __("Progress bar",'thefoxwp'),
    "base" => "progress_bar_ctn",
    "icon" => get_template_directory_uri() . "/images/vc_icons/vc_progress_bar.png", 
    "as_parent" => array('only' => 'progress_bar'),
    "content_element" => true,
	"weight" => "62",
    "show_settings_on_create" => true,
    "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Progress bar style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Style 1" => "rd_pb_1","Style 2" => "rd_pb_2","Style 3" => "rd_pb_3","Style 4" => "rd_pb_4","Style 5" => "rd_pb_5","Style 6" => "rd_pb_6","Style 7" => "rd_pb_7","Style 8" => "rd_pb_8","Style 9 ( Trending )" => "rd_pb_9" ), 
            "description" => __("Choose the Progress bar style ( visual )",'thefoxwp'),
			)	
    ),
    "js_view" => 'VcColumnView'
) );	
   vc_map( array(
      "name" => __("Bar",'thefoxwp'),
      "base" => "progress_bar",
      "class" => "",
      "category" => __('Content','thefoxwp'),
	  "as_child" => array('only' => 'progress_bar_ctn'),
      "params" => array(
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Progress bar title",'thefoxwp'),
            "param_name" => "title",
            "value" => __("Webdesign",'thefoxwp'),
            "description" => __("Enter the title for the progress bar",'thefoxwp'),
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Percentage",'thefoxwp'),
            "param_name" => "percentage",
            "value" => __("80",'thefoxwp'),
            "description" => __("Enter the percentage ( e.g 80 )",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color",'thefoxwp'),
            "param_name" => "title_color",
            "value" => '', //Default Red color
            "description" => __("Choose Title color",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Progress bar color",'thefoxwp'),
            "param_name" => "pb_color",
            "value" => '', //Default Red color
            "description" => __("Choose Progress bar color",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Progress bar second color",'thefoxwp'),
            "param_name" => "pb_alt_color",
            "value" => '', //Default Red color
            "description" => __("Add this color to create gradient (optional)",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Progress bar container color",'thefoxwp'),
            "param_name" => "pb_ctn_color",
            "value" => '', //Default Red color
            "description" => __("Choose Progress container color",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "border_color",
            "value" => '', //Default Red color
            "description" => __("Choose border color",'thefoxwp'),
        ),
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Add Stripe?",'thefoxwp'),
			'param_name' => 'stripe',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want to add stripe to the bar",'thefoxwp'),
			),	
		 array(
  		 	'type' => 'checkbox',
			'heading' => __("Animate the stripe?",'thefoxwp'),
			'param_name' => 'stripe_animation',
			'value' => array(  'Yes'  => 'yes' ),
			'description' => __("Select if you want to make the stripe move",'thefoxwp'),
			),	

    ),
) );
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_progress_bar_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_progress_bar extends WPBakeryShortCode {
    }
}

}



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            Images Carousel   		                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////



vc_map( array(
	'name' => __( 'Images Carousel', 'thefoxwp' ),
	'base' => 'rd_images_carousel',
	'weight' => '92',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_image_carousel.png",
	'category' => __( 'Content', 'thefoxwp' ),
	'description' => __( 'Animated carousel with images', 'thefoxwp' ),
	'params' => array(
		array(
            "type" => "dropdown",
			'heading' => __( 'Carousel Style', 'thefoxwp' ),
			'param_name' => 'style',
			"value" => array ( "Images only" => "","Images In box with thumbnail for pagination" => "rd_ic_tp" ), 
			'description' => __( 'If "YES" prev/next control will be removed.', 'thefoxwp' ),
		),
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'thefoxwp' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'thefoxwp' )
		),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Images size",'thefoxwp'),
            "param_name" => "size",
            "value" => "",
            "description" => __('Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.','thefoxwp'),
         ),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'thefoxwp' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'thefoxwp' ) => 'link_image',
				__( 'Do nothing', 'thefoxwp' ) => 'link_no',
				__( 'Open custom link', 'thefoxwp' ) => 'custom_link'
			),
			'description' => __( 'What to do when slide is clicked?', 'thefoxwp' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'thefoxwp' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'thefoxwp' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),		
		array(
            "type" => "dropdown",
			'heading' => __( 'Hide prev/next buttons?', 'thefoxwp' ),
			'param_name' => 'hide_prev_next_buttons',
			"value" => array ( "No" => "no","Yes" => "yes" ), 
			'description' => __( 'If "YES" prev/next control will be removed.', 'thefoxwp' ),
		 	'dependency' => array( 'element' => 'style', 'value' => array(''))
		),
		array(
            "type" => "dropdown",
			'heading' => __( 'Navigation style', 'thefoxwp' ),
			'param_name' => 'nav_style',
			"value" => array ( "Above Images" => "","On Image when hover" => "hover_nav_style" ), 
			'description' => __( 'Select the Navigation Style ( design )', 'thefoxwp' ),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
		),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("prev/next text color",'thefoxwp'),
            "param_name" => "t_color",
            "value" => '', //Default Red color
            "description" => __("Navigation text color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("prev/next background color",'thefoxwp'),
            "param_name" => "bg_color",
            "value" => '', //Default Red color
            "description" => __("Navigation background color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("prev/next border color",'thefoxwp'),
            "param_name" => "b_color",
            "value" => '', //Default Red color
            "description" => __("Navigation border color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("prev/next hover text color",'thefoxwp'),
            "param_name" => "h_t_color",
            "value" => '', //Default Red color
            "description" => __("Navigation text hover color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("prev/next hover background color",'thefoxwp'),
            "param_name" => "h_bg_color",
            "value" => '', //Default Red color
            "description" => __("Navigation background hover color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_prev_next_buttons', 'value' => array('no'))	
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            'heading' => __( 'Hide pagination control?', 'thefoxwp' ),
			'param_name' => 'hide_pagination_control',
			"value" => array ( "No" => "no","Yes" => "yes" ), 
            "description" => __("If YES pagination control will be removed.",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array(''))			
         ),array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Pagination text color",'thefoxwp'),
            "param_name" => "pag_t_color",
            "value" => '', //Default Red color
            "description" => __("Pagination text color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_pagination_control', 'value' => array('no'))		
    	 
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Pagination background color",'thefoxwp'),
            "param_name" => "pag_bg_color",
            "value" => '', //Default Red color
            "description" => __("Pagination background color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_pagination_control', 'value' => array('no'))
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Pagination border color",'thefoxwp'),
            "param_name" => "pag_b_color",
            "value" => '', //Default Red color
            "description" => __("Pagination border color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_pagination_control', 'value' => array('no'))
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Pagination hover text color",'thefoxwp'),
            "param_name" => "pag_h_t_color",
            "value" => '', //Default Red color
            "description" => __("Pagination text hover color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_pagination_control', 'value' => array('no'))
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Pagination hover background color",'thefoxwp'),
            "param_name" => "pag_h_bg_color",
            "value" => '', //Default Red color
            "description" => __("Pagination background hover color",'thefoxwp'),
			'dependency' =>  array( 'element' => 'hide_pagination_control', 'value' => array('no'))
         )	,
		 array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Background color",'thefoxwp'),
            "param_name" => "alt_bg_color",
            "value" => '', //Default Red color
            "description" => __("Background color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_ic_tp'))
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Border color",'thefoxwp'),
            "param_name" => "alt_b_color",
            "value" => '', //Default Red color
            "description" => __("Border color",'thefoxwp'),
		 	'dependency' => array( 'element' => 'style', 'value' => array('rd_ic_tp'))
         ),  		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Image Carousel (e.g 20 )",'thefoxwp'),
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Image Carousel(e.g 20 )",'thefoxwp'),
         ), 
	)
) );



///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            Images Gallery  		                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////



vc_map( array(
	'name' => __( 'Images Gallery', 'thefoxwp' ),
	'base' => 'rd_images_gallery',
	'weight' => '92',
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_image_gallery.png",
	'category' => __( 'Content', 'thefoxwp' ),
	'description' => __( 'Simple Image Gallery', 'thefoxwp' ),
	'params' => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'thefoxwp' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'thefoxwp' )
		),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Images size",'thefoxwp'),
            "param_name" => "size",
            "value" => "",
            "description" => __('Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.','thefoxwp'),
         ),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'thefoxwp' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'thefoxwp' ) => 'link_image',
				__( 'Do nothing', 'thefoxwp' ) => 'link_no',
				__( 'Open custom link', 'thefoxwp' ) => 'custom_link'
			),
			'description' => __( 'What to do when slide is clicked?', 'thefoxwp' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'thefoxwp' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'thefoxwp' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),				 
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Number of columns",'thefoxwp'),
            "param_name" => "column",
            "value" => array ("1 column" => "ig_col_1", "2 columns" => "ig_col_2","3 columns" => "ig_col_3","4 columns" => 'ig_col_4',"5 columns" => 'ig_col_5',"6 columns" => 'ig_col_6'), 
            "description" => __("Choose the number of columns",'thefoxwp'),		
         ),				 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Top Margin",'thefoxwp'),
            "param_name" => "margin_top",
            "value" => "0",
            "description" => __("Top margin for the Image Carousel (e.g 20 )",'thefoxwp'),
         ), 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Bottom Margin",'thefoxwp'),
            "param_name" => "margin_bottom",
            "value" => "0",
            "description" => __("Bottom margin for the Image Carousel(e.g 20 )",'thefoxwp'),
         ), 
	)
) );

///////////////////////////////////////////////////////////////////////////////////////
//////                                                                           /////
/////                            LISTS           		                        /////
////                                                                           /////
///////////////////////////////////////////////////////////////////////////////////

add_action( 'vc_before_init', 'rd_lists_sc' );
function rd_lists_sc() {
vc_map( array(
    "name" => __("Lists",'thefoxwp'),
    "base" => "rd_lists_ctn",
	"weight" => "77",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_lists.png",
    "as_parent" => array('only' => 'rd_list'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
	       array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("List style",'thefoxwp'),
            "param_name" => "style",
            "value" => array ("Small icon" => "rd_list_1_alt","Small icon and border" => "rd_list_1","Big icon" => "rd_list_2","Small Rounded Icon" => "rd_list_6","Small Stroke Rounded Icon" => "rd_list_7","Rounded Icon" => "rd_list_5","Big squared Icon" => "rd_list_3","In Box List" => "rd_list_4" ), 
            "description" => __("Choose the List style ( visual )",'thefoxwp'),
         ),
		 array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("Icon position",'thefoxwp'),
            "param_name" => "pos",
            "value" => array ("Left" => "rd_list_left","Right" => 'rd_list_right'),
            "description" => __("Choose the Icon position",'thefoxwp'),
		 	'dependency' =>  array( 'element' => 'style', 'value' => array('rd_list_3','rd_list_5','rd_list_6','rd_list_7'))	
         ),	
    ),
    "js_view" => 'VcColumnView'
) );	
   vc_map( array(
      "name" => __("List item",'thefoxwp'),
      "base" => "rd_list",
	"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_lists.png",
      "class" => "",
      "category" => __('Content','thefoxwp'),
	  "as_child" => array('only' => 'rd_lists_ctn'),
      "params" => array(
         
		 array(
			"type" => "4k_icon",
			"class" => "",
			"heading" => __("Select Icon:",'thefoxwp'),
			"param_name" => "icon",
			"description" => __("Select the icon from the list.",'thefoxwp'),			
		 	'dependency' =>  array( 'element' => 'use_icon', 'value' => array('yes'))		
    	     ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Icon color",'thefoxwp'),
            "param_name" => "i_color",
            "value" => '', //Default Red color
            "description" => __("Select the icon color",'thefoxwp'),
         ),
		 
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("List title",'thefoxwp'),
            "param_name" => "title",
            "value" => "",
            "description" => __("Enter the title for list (optional)",'thefoxwp'),
         ),		 
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("Title Color",'thefoxwp'),
            "param_name" => "title_color",
            "value" => '', //Default Red color
            "description" => __("Choose Title color",'thefoxwp'),
         ),
		 array(
            "type" => "textarea",
            "class" => "",
            "heading" => __("List main text",'thefoxwp'),
            "param_name" => "content",
            "value" => "",
            "description" => __("Enter List main text (optional)",'thefoxwp'),
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __("main text color",'thefoxwp'),
            "param_name" => "content_color",
            "value" => '', //Default Red color
            "description" => __("Choose main text color",'thefoxwp'),
         ),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Link (optional)",'thefoxwp'),
            "param_name" => "link",
            "value" => "",
            "description" => __("Enter the link for list (use http://)",'thefoxwp'),
         ),
		 


    ),
) );
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_rd_lists_ctn extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_rd_list extends WPBakeryShortCode {
    }
}
}


// Contact form 7 plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	global $wpdb;
	$cf7 = $wpdb->get_results(
		"
  SELECT ID, post_title
  FROM $wpdb->posts
  WHERE post_type = 'wpcf7_contact_form'
  "
	);
	$contact_forms = array();
	if ( $cf7 ) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms[__( 'No contact forms found', 'thefoxwp' )] = 0;
	}
	vc_map( array(
		'base' => 'rd_cf7',
		'name' => __( 'Contact Form 7', 'thefoxwp' ),
		"icon"		=> get_template_directory_uri() . "/images/vc_icons/vc_cf7.png",
		"weight" => "81",
		'category' => __( 'Content', 'thefoxwp' ),
		'description' => __( 'Place Contact Form7', 'thefoxwp' ),
		'params' => array(
         array(
            "type" => "dropdown",
            "class" => "",
            "heading" => __("CSS Animation",'thefoxwp'),
            "param_name" => "animation",
			'value' => array(__("No",'thefoxwp') => "",__("Fade In",'thefoxwp') => "rda_fadeIn",__("Fade Top to Bottom",'thefoxwp') => "rda_fadeInDown", __("Fade Bottom to Top",'thefoxwp') => "rda_fadeInUp", __("Fade Left to Right",'thefoxwp') => "rda_fadeInLeft", __("Fade Right to Left",'thefoxwp') => "rda_fadeInRight", __("Bounce In",'thefoxwp') => "rda_bounceIn",__("Bounce Top to Bottom",'thefoxwp') => "rda_bounceInDown",__("Bounce Bottom to Top",'thefoxwp') => "rda_bounceInUp", __("Bounce Left to Right",'thefoxwp') => "rda_bounceInLeft", __("Bounce Right to Left",'thefoxwp') => "rda_bounceInRight", __("Zoom In",'thefoxwp') => "rda_zoomIn", __("Flip Vertical",'thefoxwp') => "rda_flipInX",__("Flip Horizontal",'thefoxwp') => "rda_flipInY", __("Bounce",'thefoxwp') => "rda_bounce", __("Flash",'thefoxwp') => "rda_flash",__("Shake",'thefoxwp') => "rda_shake",__( "Pulse",'thefoxwp') => "rda_pulse",__( "Swing",'thefoxwp') => "rda_swing", __("Rubber band",'thefoxwp') => "rda_rubberBand", __("Wobble",'thefoxwp') => "rda_wobble", __("Tada!",'thefoxwp') => 'rda_tada'),
            "description" => __("Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.",'thefoxwp')
         ),	
		 	array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Text color",'thefoxwp'),
            	"param_name" => "text_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the Text color",'thefoxwp'),
        	),			
			array(
				'type' => 'dropdown',
				'heading' => __( 'Font weight', 'thefoxwp' ),
				'param_name' => 'font_weight',
				'value' => array('Normal' => '','Bold' => 'bold','Ultra Bold' => '900', 'Ultra Bold Trending' => 'trending_style',),
				'description' => __( 'Choose text font weight.', 'thefoxwp' )
			),
	         array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Field Border color",'thefoxwp'),
            	"param_name" => "b_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the border color",'thefoxwp'),
        	),
	         array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Field Background color",'thefoxwp'),
            	"param_name" => "bg_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the border color",'thefoxwp'),
        	),			
	         array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Button Background color",'thefoxwp'),
            	"param_name" => "button_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the button background color",'thefoxwp'),
        	),			
	         array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Button text color",'thefoxwp'),
            	"param_name" => "button_text_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the button text color",'thefoxwp'),
        	),			
	         array(
            	"type" => "colorpicker",
            	"class" => "",
            	"heading" => __("Button Hover color",'thefoxwp'),
            	"param_name" => "button_hover_color",
            	"value" => '', //Default Red color
            	"description" => __("Choose the button hover background color",'thefoxwp'),
        	),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Field position', 'thefoxwp' ),
				'param_name' => 'type',
				'value' => array('Horizontal' => '','Vertical' => 'vertical'),
				'description' => __( 'Choose the field position.', 'thefoxwp' )
			),			
			array(
				'type' => 'dropdown',
				'heading' => __( 'Field space', 'thefoxwp' ),
				'param_name' => 'f_space',
				'value' => array('Normal' => 'fs_normal','Medium' => 'fs_medium','Small' => 'fs_small'),
				'description' => __( 'Choose the size of the space between fields.', 'thefoxwp' )
			),
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Field Border Radius",'thefoxwp'),
            "param_name" => "field_radius",
            "value" => "0",
            "description" => __("If you want to make the field rounded ( e.g. 10 (optional) )",'thefoxwp'),
         ),	
		 array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Textarea height",'thefoxwp'),
            "param_name" => "height",
            "value" => "",
            "description" => __("e.g. 200 (optional)",'thefoxwp'),
         ),	
			array(
				'type' => 'dropdown',
				'heading' => __( 'Button type', 'thefoxwp' ),
				'param_name' => 'btn',
				'value' => array('Normal' => '','Stroke' => 'stroke','Big' => 'big','Full width' => 'full_width','Full width stroke' => 'full_width_stroke'),
				'description' => __( 'Choose the button design.', 'thefoxwp' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select contact form', 'thefoxwp' ),
				'param_name' => 'id',
				'value' => $contact_forms,
				'description' => __( 'Choose previously created contact form from the drop down list.', 'thefoxwp' )
			)
		)
	) );
} // if contact form7 plugin active


?>