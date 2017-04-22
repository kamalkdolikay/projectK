<?php
// Setup for the comments 

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

  <div id="comment-<?php comment_ID(); ?>" class="comment_ctn">

    <div class="avatar"> <?php echo get_avatar($comment,$size='76',$default='<path_to_url>' ); ?></div>

    <?php if ($comment->comment_approved == '0') : ?>

    <em>

    <?php _e('Your comment is awaiting moderation.','thefoxwp') ?>

    </em> <br />

    <?php endif; ?>

    <div class="details"> <span class="author"><?php printf(__('%s','thefoxwp'), get_comment_author_link()) ?></span><span class="Reply">

      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

      <?php edit_comment_link(__('Edit','thefoxwp'),'','') ?>

      </span>
      <span class="date"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'thefoxwp'), get_comment_date(),  get_comment_time()) ?></a></span>

      <div class="comment">

        <?php comment_text() ?>

      </div>

    </div>

  </div>

  <?php }

?>