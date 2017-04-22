<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
<p class="nocomments"><?php echo __('This post is password protected. Enter the password to view comments.', 'thefoxwp') ?></p>
<?php

return;

}

?>

<!-- You can start editing here. -->

<?php if ( have_comments() && 'open' == $post->comment_status) : ?>
<?php paginate_comments_links(); ?>
<div class="clearfix sep_70"></div>
<div class="comment_count">
  <h3>
    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>
  </h3>
</div>
<div id="comments">
  <ul>
    <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
  </ul>
  <div class="clear"></div>
</div>
<div>
<div>
<?php elseif ( have_comments() ) : // this is displayed if there are no comments so far ?>
<?php paginate_comments_links(); ?>
<div class="clearfix"></div>
<div id="comments">
<ul>
  <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
</ul>
<div class="clear"></div>
<div>
<div>
<?php elseif ( 'open' == $post->comment_status) : ?>
<?php paginate_comments_links(); ?>
<div class="clearfix"></div>
<div id="comments">
<div>
<?php else : // comments are closed ?>
<div>
<div>
  <div> 
  
    <!-- If comments are closed. -->
    
    <p class="nocomments"></p>
    <?php endif; ?>
    <?php if ('open' == $post->comment_status) : ?>
    <div class="clearfix"></div>
    <div id="add-comment">
    <h4><?php echo __('Leave a Comment', 'thefoxwp') ?></h4>
      <?php 
function alter_comment_form_fields($new_fields) {
$new_fields['comment_notes_after'] = ' '; //remove website field
return $new_fields;
}


add_filter('comment_form_default_fields', 'alter_comment_form_fields'); //make sure to use comment_form_default_fields





$commenter = wp_get_current_commenter();

$req = get_option( 'require_name_email' );

$aria_req = ( $req ? " aria-required='true'" : '' );



$new_fields = array(

'author' => '<p>' .  ( $req ? '' : '' ) .
            '<input id="author" class="single_post_author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  placeholder="Name*"' . $aria_req . ' /></p>',

	'email'  => '<p>' . ( $req ? '' : '' ) .
	            '<input id="email" class="single_post_email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="Email*"' . $aria_req . ' /></p>',


	'url'    => '<p>' . 
	            '<input id="url" class="single_post_url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="Website" /></p>',

				

);



$comments_args = array(

'fields' => apply_filters( 'comment_form_default_fields', $new_fields ),

'title_reply' => '',

'comment_field' => '<p><textarea id="comment" name="comment" class="single_post_comment" placeholder="Message*"  aria-required="true"></textarea></p>'

);



comment_form($comments_args); ?>
      <?php endif; // If registration required and not logged in ?>
    </div>
  </div>
</div>
