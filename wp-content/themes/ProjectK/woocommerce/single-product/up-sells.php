<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">
    	<div class="upsells_nav">
  <p class="upsells_left"></p>
  <p class="upsells_right"></p>
</div>

		<h2><?php _e( '<strong>You may</strong> also like&hellip;', 'thefoxwp' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
