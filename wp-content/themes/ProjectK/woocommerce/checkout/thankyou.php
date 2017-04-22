<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'thefoxwp' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'thefoxwp' );
			else
				_e( 'Please attempt your purchase again.', 'thefoxwp' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'thefoxwp' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', 'thefoxwp' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>
		<div class="order_complete_ctn">
        <h2><?php _e( 'Billing Details', 'thefoxwp' ); ?></h2>
		<h3 class="thx_msg"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'thefoxwp' ), $order ); ?></h3>

		<ul class="order_details">
			<li class="order">
				<?php _e( 'Order:', 'thefoxwp' ); ?>
				<strong><?php echo esc_html($order->get_order_number()); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', 'thefoxwp' ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', 'thefoxwp' ); ?>
				<strong><?php echo ''.$order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment method:', 'thefoxwp' ); ?>
				<strong><?php echo esc_html($order->payment_method_title); ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>

	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'thefoxwp' ), null ); ?></p>

<?php endif; ?>