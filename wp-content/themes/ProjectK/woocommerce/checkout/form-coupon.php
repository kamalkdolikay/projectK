<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */
 
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'thefoxwp' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'thefoxwp' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>


<form class="checkout_coupon" method="post" style="display:block">

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Enter promotion code here', 'thefoxwp' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="button alt2" name="apply_coupon" value="<?php _e( 'Apply', 'thefoxwp' ); ?>" />
	</p>

	<div class="clear"></div>
</form>