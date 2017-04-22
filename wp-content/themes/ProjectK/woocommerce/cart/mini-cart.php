<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<li>
					<?php if ( ! $_product->is_visible() ) { ?>
						<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name; ?>
					<?php } else { ?>
						<a href="<?php echo get_permalink( $product_id ); ?>">
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name; ?>
						</a>
					<?php } ?>
						<?php echo WC()->cart->get_item_data( $cart_item ); ?>

						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?><?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove fa fa-times" title="%s"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'thefoxwp' ) ), $cart_item_key );
						?>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'thefoxwp' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->
<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<div class="clear_total">
<a class="rd_clear_btn" href="<?php echo the_permalink(); ?>?empty-cart"><?php _e( 'Empty Cart', 'thefoxwp' ); ?></a><div class="total"><?php _e( 'Subtotal', 'thefoxwp' ); ?>:&nbsp;<?php echo WC()->cart->get_cart_subtotal(); ?></div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
</div>
	<div class="rd_cart_buttons">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button wc-forward"><?php _e( 'View Cart', 'thefoxwp' ); ?></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'thefoxwp' ); ?></a>
	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
