<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'thefoxwp' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'thefoxwp' ).'</span></div>';

			echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'thefoxwp'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

			echo '</div>';

		} else {

			echo '<h2>'.__( 'Reviews', 'thefoxwp' ).'</h2>';

		}

	} else {

		echo '<h2>'.__( 'Reviews', 'thefoxwp' ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><span class="meta-nav">&larr;</span><?php previous_comments_link( __( ' Previous', 'thefoxwp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next ', 'thefoxwp' ) ); ?><span class="meta-nav">&rarr;</span></div>
			</div>
		<?php endif;

		echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button" title="' . __( 'Add Your Review', 'thefoxwp' ) . '">' . __( 'Add Review', 'thefoxwp' ) . '</a></p>';

		$title_reply = __( 'Add a review', 'thefoxwp' );

	else :

		$title_reply = __( 'Be the first to review', 'thefoxwp' ).' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<p class="noreviews">'.sprintf(__( 'There are no reviews yet, would you like to <a href="%s" class="inline show_review_form">submit yours</a>?', 'thefoxwp' ),'#review_form').'</p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div>';
	
	
	 if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>
	<div id="review_form_wrapper"><div id="review_form">
	<?php
	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'thefoxwp' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'thefoxwp' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __( 'Submit Review', 'thefoxwp' ),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', 'thefoxwp' ) .'</label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', 'thefoxwp' ).'</option>
			<option value="5">'.__( 'Perfect', 'thefoxwp' ).'</option>
			<option value="4">'.__( 'Good', 'thefoxwp' ).'</option>
			<option value="3">'.__( 'Average', 'thefoxwp' ).'</option>
			<option value="2">'.__( 'Not that bad', 'thefoxwp' ).'</option>
			<option value="1">'.__( 'Very Poor', 'thefoxwp' ).'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'thefoxwp' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . wp_nonce_field('comment_rating', true, false);

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	echo '</div></div>';
	
	else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'thefoxwp' ); ?></p>

	<?php endif; ?>
<div class="clear"></div></div>
<?php endif; ?>