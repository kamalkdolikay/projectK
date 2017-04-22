<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
wc_print_notices(); ?>


<script type="text/javascript" charset="utf-8">
	var j$ = jQuery;

j$.noConflict();

	j$(window).load(function() {


			j$(".popup_bg").css("visibility","visible");
			j$(".popup_bg").css("visibility","hidden");
if (j$(window).width() > 1036) {


var height = j$( "#payment" ).height()+190;

 j$('.rd_coupon_form').css("bottom",height);

}


if (j$(window).width() < 1036) {


var height = j$( "#payment" ).height()+186;

 j$('.rd_coupon_form').css("bottom",height);

}

if (j$(window).width() < 766) { 


var height = j$( "#payment" ).height()+163;

 j$('.rd_coupon_form').css("bottom",height);

}






j$(window).resize(function() {



if (j$(window).width() > 1036) {


var height = j$( "#payment" ).height()+190;

 j$('.rd_coupon_form').css("bottom",height);

}


if (j$(window).width() < 1036) {


var height = j$( "#payment" ).height()+186;

 j$('.rd_coupon_form').css("bottom",height);

}

if (j$(window).width() < 766) { 


var height = j$( "#payment" ).height()+163;

 j$('.rd_coupon_form').css("bottom",height);

}

})






j$('.cart_details_back').filter(':hidden').filter(':first')

 <?php if(is_user_logged_in()){ ?>
			j$(".popup_bg").css("visibility","hidden");
			j$(".popup_bg").css("opacity","0");
			j$(".create-account").css("top","125%");					
			j$(".create-account").css("opacity","0");
			j$("#rd_login_form").css("display","none");			
			j$(".rd_guest_checkout").css("display","none");
			j$("#customer_details").css("visibility","visible");
			j$("#customer_details").css("height","auto");
			j$("#customer_details").css("overflow","visible");		
 <?php } ?>		
			j$('.rd_create_acc').click(function (e) {
			j$(".popup_bg").css("visibility","visible");
			j$(".popup_bg").css("opacity","0.6");			
			j$(".create-account").css("opacity","1");
			j$(".create-account").css("top","50%");
				
		})
			j$('.popup_bg').click(function (e) {
			e.preventDefault();
			j$(".popup_bg").css("visibility","hidden");
			j$(".popup_bg").css("opacity","0");
			j$(".create-account").css("top","125%");					
			j$(".create-account").css("opacity","0");	
				
		})
		
			j$('.create_acc_done').click(function (e) {
			e.preventDefault();
			j$(".popup_bg").css("visibility","hidden");
			j$(".popup_bg").css("opacity","0");
			j$(".create-account").css("top","125%");					
			j$(".create-account").css("opacity","0");
			j$("#rd_login_form").css("display","none");			
			j$(".rd_guest_checkout").css("display","none");
			j$("#customer_details").css("visibility","visible");
			j$("#customer_details").css("height","auto");
			j$("#customer_details").css("overflow","visible");			
	
		})
		
			j$('.rd_guest_acc').click(function (e) {
			e.preventDefault();
			j$("#rd_login_form").css("display","none");			
			j$(".rd_guest_checkout").css("display","none");
			j$("#customer_details").css("visibility","visible");
			j$("#customer_details").css("height","auto");
			j$("#customer_details").css("overflow","visible");			
	
		})
		
		j$('.customer_details_back').click(function (e) {
			e.preventDefault();
			j$("#rd_login_form").css("display","block");			
			j$(".rd_guest_checkout").css("display","block");
			j$("#customer_details").css("visibility","hidden");
			j$("#customer_details").css("height","0");
			j$("#customer_details").css("overflow","hidden");			
	
		})
				
		j$('.customer_details_next').click(function (e) {
			e.preventDefault();
			j$("#customer_details").css("visibility","hidden");
			j$("#customer_details").css("height","0");
			j$("#customer_details").css("overflow","hidden");			
			j$(".rd_order_review").css("visibility","visible");
			j$(".rd_order_review").css("height","auto");
			j$(".rd_order_review").css("overflow","visible");				
			j$(".rd_coupon_form").css("visibility","visible");
			j$(".rd_coupon_form").css("height","auto");
			j$(".rd_coupon_form").css("overflow","visible");			
	
		})
		
				
		j$('.cart_details_back').click(function (e) {
			e.preventDefault();
			j$("#customer_details").css("visibility","visible");
			j$("#customer_details").css("height","auto");
			j$("#customer_details").css("overflow","visible");			
			j$(".rd_order_review").css("visibility","hidden");
			j$(".rd_order_review").css("height","0");
			j$(".rd_order_review").css("overflow","hidden");				
			j$(".rd_coupon_form").css("visibility","hidden");
			j$(".rd_coupon_form").css("height","0");
			j$(".rd_coupon_form").css("overflow","hidden");			
	
		})	

		j$('.step_signin').click(function (e) {
			e.preventDefault();			
			j$(".checkout_step").removeClass("active_step");
			j$(this).addClass("active_step");			
			j$("#rd_login_form").css("display","block");			
			j$(".rd_guest_checkout").css("display","block");	
			j$("#customer_details").css("visibility","hidden");
			j$("#customer_details").css("height","0");
			j$("#customer_details").css("overflow","hidden");
			j$(".rd_order_review").css("visibility","hidden");
			j$(".rd_order_review").css("height","0");
			j$(".rd_order_review").css("overflow","hidden");				
			j$(".rd_coupon_form").css("visibility","hidden");
			j$(".rd_coupon_form").css("height","0");
			j$(".rd_coupon_form").css("overflow","hidden");			
	
		})
		
		j$('.step_billing').click(function (e) {
			e.preventDefault();
			j$(".checkout_step").removeClass("active_step");
			j$(this).addClass("active_step");
			j$("#customer_details").css("visibility","visible");
			j$("#customer_details").css("height","auto");
			j$("#customer_details").css("overflow","visible");
			j$("#rd_login_form").css("display","none");			
			j$(".rd_guest_checkout").css("display","none");			
			j$(".rd_order_review").css("visibility","hidden");
			j$(".rd_order_review").css("height","0");
			j$(".rd_order_review").css("overflow","hidden");				
			j$(".rd_coupon_form").css("visibility","hidden");
			j$(".rd_coupon_form").css("height","0");
			j$(".rd_coupon_form").css("overflow","hidden");			
	
		})
		
				j$('.step_payment').click(function (e) {
			e.preventDefault();
			j$(".checkout_step").removeClass("active_step");
			j$(this).addClass("active_step");
			j$("#customer_details").css("visibility","hidden");
			j$("#customer_details").css("height","0");
			j$("#customer_details").css("overflow","hidden");	
			j$("#rd_login_form").css("display","none");			
			j$(".rd_guest_checkout").css("display","none");			
			j$(".rd_order_review").css("visibility","visible");
			j$(".rd_order_review").css("height","auto");
			j$(".rd_order_review").css("overflow","visible");				
			j$(".rd_coupon_form").css("visibility","visible");
			j$(".rd_coupon_form").css("height","auto");
			j$(".rd_coupon_form").css("overflow","visible");			
	
		})		
		

	});

</script>

<div class="checkout_steps">
<?php if(!is_user_logged_in()){ ?>
<div class="checkout_step step_signin active_step">1. <?php _e( 'Sign in', 'thefoxwp' ); ?></div>
<div class="checkout_step step_billing">2. <?php _e( 'Billing', 'thefoxwp' ); ?></div>
<div class="checkout_step step_payment">3. <?php _e( 'Payment', 'thefoxwp' ); ?></div>
<div class="checkout_step last_step">4. <?php _e( 'Confirmation', 'thefoxwp' ); ?></div>
<?php }else{ ?>
<div class="checkout_step logged step_billing active_step">1. <?php _e( 'Billing', 'thefoxwp' ); ?></div>
<div class="checkout_step logged step_payment ">2. <?php _e( 'Payment', 'thefoxwp' ); ?></div>
<div class="checkout_step logged last_step">3. <?php _e( 'Confirmation', 'thefoxwp' ); ?></div>
<?php } ?>
</div>
<?php

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'thefoxwp' ) );
	return;
}


echo '<div class="rd_guest_checkout"><h2>'. __( 'New customer.', 'thefoxwp' ).'</h2><a class="button alt2 rd_guest_acc">'. __( 'Checkout as guest.', 'thefoxwp' ).'</a><a class="button alt3 rd_create_acc">'. __( 'Create an account.', 'thefoxwp' ).'</a></div>';


// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">

			<div class="col-1">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>

			</div>

			<div class="col-2">

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

			</div>
            <div class="checkout_nav">
        <?php if(!is_user_logged_in()){ ?><a class="button alt2 customer_details_back"><?php _e( 'Previous step', 'thefoxwp' ); ?></a><?php } ?><a class="button alt3 customer_details_next"><?php _e( 'Next step', 'thefoxwp' ); ?></a>
		</div>
        </div>
        <div class="rd_order_review">

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<h2 id="order_review_heading"><?php _e( 'Your order', 'thefoxwp' ); ?></h2>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>
</form>
    <div class="rd_coupon_form">
	<?php
    do_action( 'rd_checkout_coupon_form' , $checkout );
	?>
    </div>
	

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>