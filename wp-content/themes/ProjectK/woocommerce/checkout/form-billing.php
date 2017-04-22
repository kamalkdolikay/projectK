<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

	<h2><?php _e( 'Billing &amp; Shipping', 'thefoxwp' ); ?></h2>

<?php else : ?>

	<h2><?php _e( 'Billing Address', 'thefoxwp' ); ?></h2>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout ); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>



<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>


	<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
<div class="popup_bg"></div>
	<div class="create-account">

		<div class="create_acc_header"><h3><?php _e( 'Register.', 'thefoxwp' ); ?></h3></div>
        <div class="create_acc_container">

		<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>
        		<?php if ( $checkout->enable_guest_checkout ) : ?>


			<p class="c_acc_box"><input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'thefoxwp' ); ?></label></p>

		<?php endif; ?>
        <a class="button create_acc_done alt"><?php _e( 'Register', 'thefoxwp' ); ?></a>

		<div class="clear"></div>
</div>
	</div>

	<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

<?php endif; ?>