<?php

/*

Template Name: One page

*/


/// Set the slider

$slider_page_id = $post->ID;
if(is_home() && !is_front_page()){
	$slider_page_id = get_option('page_for_posts');
}

if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layer' && (get_post_meta($slider_page_id, 'rd_slider', true) || get_post_meta($slider_page_id, 'rd_slider', true) != 0)){ 

	function add_revolution_slider(){
		echo '<div>';
	    echo do_shortcode('[rev_slider '.get_post_meta(get_the_ID(), 'rd_slider', true).']'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_revolution_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_revolution_slider');
	}


}
if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layerslider' && (get_post_meta($slider_page_id, 'rd_layerslider', true) || get_post_meta($slider_page_id, 'rd_layerslider', true) != 0)){ 

	function add_layer_slider(){
		echo '<div>';
	    echo do_shortcode('[layerslider  id="'.get_post_meta(get_the_ID(), 'rd_layerslider', true).'"]'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_layer_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_layer_slider');
	}


}


get_header('onepage');
the_post();
global $rd_data;
global $bp; 
$header_top_bar = get_post_meta( $post->ID, 'rd_top_bar', true );
$header_transparent = get_post_meta( $post->ID, 'rd_header_transparent', true );
$p_sidebar = get_post_meta( $post->ID, 'rd_sidebar', true );
$title = get_post_meta($post->ID, 'rd_title', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_color = get_post_meta($post->ID, 'rd_title_color', true);
$titlebg_color = get_post_meta($post->ID, 'rd_titlebg_color', true);
$ctbg = get_post_meta($post->ID, 'rd_ctbg', true);
$bc = get_post_meta($post->ID, 'rd_bc', true);
$content_border_color = $rd_data['rd_content_border_color'];


/// Check if need to hide header top bar
if ($header_top_bar == 'yes' ){

 echo '<style>#top_bar {display:none;}</style>';

}

/// Check if header is transparent
if( ( $rd_data['rd_nav_type'] == 'nav_type_1' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_2' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_3' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_8' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_9' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 90;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 133;
}
}
if( ( $rd_data['rd_nav_type'] == 'nav_type_10' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 91;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 134;
}
}

if($rd_data['rd_nav_type'] == 'nav_type_4' && $header_transparent == "yes" ){

	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 101;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 144;
}

}
if(($rd_data['rd_nav_type'] == 'nav_type_5' || $rd_data['rd_nav_type'] == 'nav_type_6' || $rd_data['rd_nav_type'] == 'nav_type_7' || $rd_data['rd_nav_type'] == 'nav_type_12'  ) && $header_transparent == "yes"){

	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 100;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 143;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_10' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 91;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 134;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_11' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 110;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 153;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_13' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 62;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 105;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_14' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 65;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 108;
}
}

if( ( $rd_data['rd_nav_type'] == 'nav_type_15' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 140;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 183;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_16' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 160;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 203;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_17' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 159;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 202;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_18' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 162;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 205;
}
}
if( ( $rd_data['rd_nav_type'] == 'nav_type_19' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 162;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 43;
}
}


if($header_transparent == "yes" && $rd_data['rd_nav_type'] !== 'nav_type_19' && $rd_data['rd_nav_type'] !== 'nav_type_19_f' ){
 ?>
<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
		
		
		j$('#header_container').css('position', 'absolute');
		j$('#header_container').css('width', '100%');	
		j$('header').addClass('transparent_header');		
		j$('.header_bottom_nav').addClass('transparent_header');
		
</script>






<?php

}else {

if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom;
}else{
	
	$title_padding_bottom = $title_padding_top = 43;

}
}



 
/// Set title height
echo '<style>.page_title_ctn {padding-top:'.$title_padding_top.'px; padding-bottom:'.$title_padding_bottom.'px;}</style>';


/// Set the title color

if($title_color !== ''){
	$rgba= rd_hex_to_rgb_array($title_color);
	echo '<style>.page_title_ctn h1,.page_title_ctn h2,#crumbs,#crumbs a{color:'.$title_color.';}.page_t_boxed h1,.page_t_boxed h1{border-color:rgba('. $rgba[0].','.$rgba[1].','.$rgba[2] .',0.5); }#crumbs span{color:rgba('. $rgba[0].','.$rgba[1].','.$rgba[2] .',0.8);}</style>';
}
/// Set the title background
if($titlebg_color !== ''){
	echo '<style>.page_title_ctn {background-color:'.$titlebg_color.';}</style>';
}
if($ctbg !== ''){
	echo '<style>.page_title_ctn{background:url('.$ctbg.') top center; background-size: cover; border-bottom:1px solid '.$content_border_color.'; }</style>';
}

/// Check title style
if($title !== 'no'){  ?>
<div class="page_title_ctn"> 
  <div class="wrapper table_wrapper">
  <h1><?php the_title(); ?></h1>
  <?php if($bc !== 'no') { echo wpb_list_child_pages();  ?>     
<div id="breadcrumbs">
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
</div>
<?php } ?> 
</div>
</div>
<?php } 

do_action( '__after_page_title' );

?>
<div class="section def_section">
  <div class="wrapper section_wrapper">
 <?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { 
 ?>
    <div id="posts" class=" <?php if ( $p_sidebar == 'right' ) { echo 'left_posts"'; } else { echo 'right_posts "'; } ?> ">
      <?php  }else{ ?>
<div id="fw_c" class="clearfix tf_single_page">
    <?php } the_content();  ?>
    </div>
        <?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { ?>
        <div id="sidebar" class=" <?php if ( $p_sidebar == 'right' ) { echo "right_sb"; } else { echo "left_sb"; } ?> ">
      <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); } ?>
    </div>
    <div class="clearfix"></div>
    <?php  } ?>
    
  </div>
</div>
<?php get_footer(); ?>
