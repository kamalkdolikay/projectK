<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); 




		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	global $rd_data;
		$shop_id = get_option('woocommerce_shop_page_id');
		$custom =  get_post_custom($shop_id);	
		$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
		$slider = get_post_meta($shop_id, "_chosen_slider", $single = false);
		
$header_transparent = get_post_meta( $shop_id, 'rd_header_transparent', true );
$pb_content = get_post_meta($shop_id, 'rd_pb_content', true);
$wp_content = get_post_meta($shop_id, 'rd_content', true);
$p_sidebar = get_post_meta( $shop_id, 'rd_sidebar', true );
$title = get_post_meta($shop_id, 'rd_title', true);
$title_t = get_post_meta($shop_id, 'rd_title_type', true);
$title_text_align = get_post_meta($shop_id, 'rd_title_text_align', true);
$title_height = get_post_meta($shop_id, 'rd_title_height', true);
$title_size = get_post_meta($shop_id, 'rd_title_size', true);
$title_color = get_post_meta($shop_id, 'rd_title_color', true);
$titlebg_color = get_post_meta($shop_id, 'rd_titlebg_color', true);
$ctbg = get_post_meta($shop_id, 'rd_ctbg', true);
$bc = get_post_meta($shop_id, 'rd_bc', true);
$content_border_color = $rd_data['rd_content_border_color'];

/// Check if header is transparent

if($rd_data['rd_nav_type'] !== 'style 4' && $rd_data['rd_nav_type'] !== 'style 5' && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 100;
	
}else
{
		$title_padding_bottom = 35;
	$title_padding_top = 135;
}
	
	 ?>


<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		
		
		j$('#header_container').css('position', 'absolute');
		j$('#header_container').css('width', '100%');	
		j$('header').addClass('transparent_header');
		
		j$('.header_bottom_nav').addClass('transparent_header');
		
</script>






<?php }elseif($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom;
	
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
<div class="page_title_ctn <?php echo ' '.$title_t.' '.$title_text_align.' '.$title_size.' '; ?>"> <?php 
?>

  <div class="wrapper">
  		<h1><?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
			  woocommerce_page_title();}else{  the_title(); }?>
        </h1>  
      <?php if($bc !== 'no') : ?>
<div id="breadcrumbs">
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
</div>
<?php endif; ?>
<section id="content">
</div>
</div>
<?php } ?>
<div class="section">
<?php /// Set the slider


	$slider_page_id = $shop_id;
		if(is_home() && !is_front_page()){
		$slider_page_id = get_option('page_for_posts');
	}
	if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layer' && (get_post_meta($slider_page_id, 'rd_slider', true) || get_post_meta($slider_page_id, 'rd_slider', true) != 0)){ 
    echo do_shortcode('[rev_slider '.get_post_meta($slider_page_id, 'rd_slider', true).']'); 
	
}

?>
  <div class="wrapper">
 
 <?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { 
 	global $rd_data;
	$content_border_color = $rd_data['rd_content_border_color'];
 ?>
    <div id="posts" class=" <?php if ( $p_sidebar == 'right' ) { echo 'left_posts"'; } else { echo 'right_posts"'; } ?> ">
      <?php  }else{ ?>
<div id="fw_c">
<?php } 

if($rd_data['rd_shop_columns'] == 4){
	$col_class = 'shop_four_col' ;
}elseif($rd_data['rd_shop_columns'] == 2 ){
	$col_class = 'shop_two_col' ;
}else {
	$col_class = 'shop_three_col' ;
}


?>
<script type='application/javascript'>
var j$ = jQuery;

j$.noConflict();
j$(window).load(function() {

	j$(".product").addClass("<?php echo esc_js($col_class) ?>");
		j$(".products").css("opacity","1");
})
</script>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>

				<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php woocommerce_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>

			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>

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
        <?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { ?>
        <div id="sidebar" class=" <?php if ( $p_sidebar == 'right' ) { echo "right_sb"; } else { echo "left_sb"; } ?> ">
      <?php if ( is_active_sidebar( 'thefox_shop_sidebar' ) ) { if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Shop sidebar' ) ) ?>
    </div>
    <div class="clearfix"></div>
    <?php  } }?>
    
  </div>
</div>
<?php get_footer('shop'); ?>