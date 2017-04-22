<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version	 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
    
<div class="product_thumb_wrapper">
<div class="woo_img_next fa fa-angle-up"></div>
<div class="single_products_thumbnails">
			<?php
				// From product-image.php
				if ( has_post_thumbnail() ) {

					$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
					$image	   		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
						'title' => $image_title
						) );
					$attachment_count   = count( $product->get_gallery_attachment_ids() );

					if ( $attachment_count > 0 ) {
						$gallery = '[product-gallery]';
					} else {
						$gallery = '';
					}

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '%s', $image ), $post->ID );

				}

				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ( $attachment_ids as $attachment_id ) {

					$classes[] = 'image-'.$attachment_id;

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;

					$image	   = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '%s', $image ), $attachment_id, $post->ID, $image_class );

					$loop++;
				}

			?>

</div>
<div class="woo_img_prev fa fa-angle-down"></div>
	</div>
	<?php
}