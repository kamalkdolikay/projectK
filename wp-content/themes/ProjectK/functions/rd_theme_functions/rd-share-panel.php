<?php
	function rd_share_panel()
	{
	ob_start();
?>
   <div class="share-box">
      <ul>
        <li id="facebook"> <a  target="_blank" onClick="popup = window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-facebook"></i></a>
         </li>
        <li id="twitter"> <a  target="_blank" onClick="popup = window.open('http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-twitter"></i></a>
         </li>
        <li id="lin"> <a  target="_blank" onClick="popup = window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-linkedin"></i></a>
         </li>
        <li id="reddit"> <a  target="_blank" onClick="popup = window.open('http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-reddit"></i></a>
         </li>
        <li id="tumblr"> <a  target="_blank" onClick="popup = window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php the_title(); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-tumblr"></i></a>
         </li>
        <li id="gplus"> <a  target="_blank" onClick="popup = window.open('http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-google-plus"></i></a>
         </li>
        <li id="member_email"> <a  target="_blank" onClick="popup = window.open('mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-envelope-o"></i></a>
         </li>
      </ul>
    </div>
	
	<?php 
$output_string = ob_get_contents();
ob_end_clean();

echo !empty( $output_string ) ? $output_string : '';
	}

	function rd_woo_share_panel()
	{
	ob_start();
?>
   <div class="woo-share-box">
      <ul>
        <li id="facebook"> <a  target="_blank" onClick="popup = window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-facebook"></i></a>
         </li>
        <li id="twitter"> <a  target="_blank" onClick="popup = window.open('http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-twitter"></i></a>
         </li>
        <li id="lin"> <a  target="_blank" onClick="popup = window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-linkedin"></i></a>
         </li>
        <li id="reddit"> <a  target="_blank" onClick="popup = window.open('http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-reddit"></i></a>
         </li>
        <li id="tumblr"> <a  target="_blank" onClick="popup = window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php the_title(); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-tumblr"></i></a>
         </li>
        <li id="gplus"> <a  target="_blank" onClick="popup = window.open('http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-google-plus"></i></a>
         </li>
        <li id="member_email"> <a  target="_blank" onClick="popup = window.open('mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-envelope-o"></i></a>
          </li>
      </ul>
    </div>
	
	<?php 
$output_string = ob_get_contents();
ob_end_clean();

echo !empty( $output_string ) ? $output_string : '';
	}

?>