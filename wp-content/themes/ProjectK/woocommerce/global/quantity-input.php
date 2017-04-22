<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wp_enqueue_script('qtybuttons', get_template_directory_uri() . '/js/qtybuttons.js');

?>
<div class="quantity"><input type="button" value="-" class="qtyminus qty-number"  data-type="minus" data-field="<?php echo esc_attr( $input_name ); ?>"><input type="number" step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'thefoxwp' ) ?>" class="input-text qty text" size="4" /><input type="button" value="+" class="qtyplus qty-number" data-type="plus" data-field="<?php echo esc_attr( $input_name ); ?>"></div>
