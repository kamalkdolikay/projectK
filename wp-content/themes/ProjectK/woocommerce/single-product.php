<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop');
global $rd_data;
global $bp; 
$header_top_bar = get_post_meta( $post->ID, 'rd_top_bar', true );
$header_transparent = get_post_meta( $post->ID, 'rd_header_transparent', true );
$pb_content = get_post_meta($post->ID, 'rd_pb_content', true);
$wp_content = get_post_meta($post->ID, 'rd_content', true);
$p_sidebar = get_post_meta( $post->ID, 'rd_sidebar', true );
$title = get_post_meta($post->ID, 'rd_title', true);
$title_t = get_post_meta($post->ID, 'rd_title_type', true);
$title_text_align = get_post_meta($post->ID, 'rd_title_text_align', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_size = get_post_meta($post->ID, 'rd_title_size', true);
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
if( ( $rd_data['rd_nav_type'] == 'nav_type_1' || $rd_data['rd_nav_type'] == 'nav_type_2' || $rd_data['rd_nav_type'] == 'nav_type_3' || $rd_data['rd_nav_type'] == 'nav_type_8' || $rd_data['rd_nav_type'] == 'nav_type_9' ) && $header_transparent == "yes"){
	
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


if($header_transparent == "yes"){
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
	$title_padding_top = $title_padding_bottom + 162;
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
	echo '<style>.page_title_ctn {background-color:'.$titlebg_color.'; }</style>';
}
if($ctbg !== ''){
	echo '<style>.page_title_ctn{background:url('.$ctbg.') top center; background-size: cover; border-bottom:1px solid '.$content_border_color.'; }</style>';
}

/// Check title style
if($title !== 'no'){  ?>
<div class="page_title_ctn <?php echo ' '.$title_t.' '.$title_text_align.' '.$title_size.' '; ?>"> 
  <div class="wrapper">
  <h1><?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { woocommerce_page_title();}else{  the_title(); }?></h1>
  <?php if($bc !== 'no') { ?>     
<div id="breadcrumbs">
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
</div>
<?php } ?> 
</div>
</div>
<?php } ?><script type="text/javascript" charset="utf-8">

var j$ = jQuery;

j$.noConflict();

	j$(window).load(function() {

		j$(".woocommerce-tabs").css("opacity","1");	
		
		j$(".related ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".related_left",
					next: ".related_right",
					auto: false,
					items: {
						width: 330,
						height: "100%",
					//	height: "30%",	//	optionally resize item-height
						visible: {
							min: 1,
							max: 4							
						}
					}
				});
		j$(".upsells ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".upsells_left",
					next: ".upsells_right",
					auto: false,
					items: {
						width: 330,
						height: "100%",
					//	height: "30%",	//	optionally resize item-height
						visible: {
							min: 1,
							max: 4							
						}
					}
				});				
		j$(".products").css("opacity","1");	
		
		
		j$('.show_review_form').click(function (e) {
			e.preventDefault();
			j$("#review_form_wrapper").css("visibility","visible");
			j$("#review_form_wrapper").css("height","auto");
			j$("#review_form_wrapper").css("opacity","1");
				
		})
		
		
    // grab the initial top offset of the navigation 
    var sticky_shareicon_offset_top = j$('.woo-share-box').offset().top-100;
     
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var sticky_shareicon = function(){
        var scroll_top = j$(window).scrollTop(); // our current vertical position from the top
         
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_shareicon_offset_top) {
			
			j$('.woo-share-box').addClass('fixed-woo-share-box');

        } else {
			
			j$('.woo-share-box').removeClass('fixed-woo-share-box');	
        }   
    };
     
    // run our function on load
    sticky_shareicon();
     
    // and run it again every time you scroll
    j$(window).scroll(function() {
         sticky_shareicon();
    });	
				});
	</script>
<div class="section">
  <div class="wrapper">

<div id="fw_c">
			<?php echo rd_woo_share_panel();
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action('woocommerce_before_main_content');
			?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action('woocommerce_after_main_content');
			?>

			<?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action('woocommerce_sidebar');
			?>
			 </div>
   </div>
  </div>
<?php get_footer('shop'); ?>