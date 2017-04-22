<?php 



/*-----------------------------------------------------------------------------------*/



/*	Share Shortcodes



/*-----------------------------------------------------------------------------------*/




function rd_share_sc( $atts, $content = null ) {

	extract(shortcode_atts(array(


		'hover_color'   => '',
		'facebook'   => '',
		'twitter'   => '',
		'lin'   => '',
		'reddit'   => '',
		'tumblr'   => '',
		'gplus'   => '',
		'mail'   => '',
		'msg'   => '',
		'tooltip'   => '',
		'url'   => '',


    ), $atts));

   	ob_start();
?>
   <div class="sc-share-box">
      <ul>
   <?php if($facebook !== ''){ ?>   
        <li id="facebook"> <a  target="_blank" onClick="popup = window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_attr($url); ?>&amp;t=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-facebook"></i></a>
         </li>

   <?php } if($twitter !== ''){ ?>         
        <li id="twitter"> <a  target="_blank" onClick="popup = window.open('http://twitter.com/home?status=<?php echo esc_attr($msg); ?> <?php echo esc_attr($url); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-twitter"></i></a>
         </li>
   
   <?php } if($lin !== ''){ ?>      
        <li id="lin"> <a  target="_blank" onClick="popup = window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-linkedin"></i></a>
         </li>
   
   <?php } if($reddit !== ''){ ?>      
        <li id="reddit"> <a  target="_blank" onClick="popup = window.open('http://reddit.com/submit?url=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-reddit"></i></a>
         </li>
     
   <?php } if($tumblr !== ''){ ?>    
        <li id="tumblr"> <a  target="_blank" onClick="popup = window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode($url); ?>&amp;name=<?php echo urlencode($msg); ?>&amp;description=<?php echo urlencode($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-tumblr"></i></a>
         </li>
    
   <?php } if($gplus !== ''){ ?>     
        <li id="gplus"> <a  target="_blank" onClick="popup = window.open('http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-google-plus"></i></a>
         </li>
         
   <?php } if($mail !== ''){ ?>
        <li id="member_email"> <a  target="_blank" onClick="popup = window.open('mailto:?subject=<?php echo esc_attr($msg); ?>&amp;body=<?php echo esc_attr($url); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-envelope-o"></i></a>
          </li>
 
   <?php } ?>         
      </ul>
    </div>
	
	<?php 
$output_string = ob_get_contents();

}


add_shortcode('rd_share_sc', 'rd_share_sc');


?>