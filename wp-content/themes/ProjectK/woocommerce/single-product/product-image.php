<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version	 2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="rd_woo_image_ctn">
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
	//setup up Carousel
		j$(window).load(function() {

				var j$carousel = j$('.single_product_main_image'),
					j$pager = j$('.single_products_thumbnails');
					
j$('.single_products_thumbnails img').each(function(i) {
		j$(this).addClass( 'itm'+i );
		
		/* add onclick event to thumbnail to make the main 
		carousel scroll to the right slide*/
		j$(this).click(function() {
			j$('.single_product_main_image').trigger( 'slideTo', [i, 0, true] );
			return false;
		});
	});

		j$('.single_products_thumbnails img.itm0').addClass( 'selected' );
	

				j$carousel.carouFredSel({
					synchronise: ['.single_products_thumbnails', false], 
					responsive: true,
					auto: false,
					height:"variable",
					prev: ".product_nav_left",
					next: ".product_nav_right",
					scroll: {
			fx: 'directscroll',
			onBefore: function() {
				/* Everytime the main slideshow changes, it check to 
					make sure thumbnail and page are displayed correctly */
				/* Get the current position */
				var pos = j$(this).triggerHandler( 'currentPosition' );
				
				/* Reset and select the current thumbnail item */
				j$('.single_products_thumbnails img').removeClass( 'selected' );
				j$('.single_products_thumbnails img.itm'+pos).addClass( 'selected' );

				/* Move the thumbnail to the right page */
			}},
					width: "100%",
					height:"variable",
					items: {
						visible: 1,
					height:"variable",
						}
					
					
					
				});
				j$pager.carouFredSel({
					width: '100%',  
					auto: false,
					height: "92%",
					items: {
						min:4,
					},
                    direction:"up",
				});
				
				j$('.single_product_main_image').css('opacity','1' );
				j$('.single_products_thumbnails').css('opacity', '1' );
				
			
$(".woo_img_next").click(function() { 
			j$(".single_products_thumbnails, .single_product_main_image").trigger( "next" ); 
		});
		j$(".woo_img_prev").click(function() { 
			j$(".single_products_thumbnails, .single_product_main_image").trigger( "prev" ); 
		});
				});
	</script>
	<div class="product_image_wrapper">
    <div class="product_nav_left"></div>
    <div class="product_nav_right"></div>
	<div class="single_product_main_image">
			<?php
				if ( has_post_thumbnail() ) {

					$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
					$image	   		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
						'title' => $image_title
						) );
					$attachment_count   = count( $product->get_gallery_attachment_ids() );

					if ( $attachment_count > 0 ) {
						$gallery = '[product-gallery]';
					} else {
						$gallery = '';
					}

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_title, $image ), $post->ID );

					$attachment_ids = $product->get_gallery_attachment_ids();

					$loop = 0;

					foreach ( $attachment_ids as $attachment_id ) {
						$classes[] = 'image-'.$attachment_id;

						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;

						$image	   = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_thumbnail_size', 'shop_single' ) );
						$image_class = esc_attr( implode( ' ', $classes ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_title, $image ), $attachment_id, $post->ID, $image_class );
						//echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

						$loop++;
					}

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div><img src="%s" alt="Placeholder" /></div>', wc_placeholder_img_src() ), $post->ID );

				}
			?>
</div>
	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
