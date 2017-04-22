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
		'align'   => '',
		'mt'   => '',
		'mb'   => '',
		'animation'   => '',


    ), $atts));



   	ob_start();
	global $rd_data;
$id = RandomString(20);
if($hover_color == ''){
$hover_color = $rd_data['rd_content_text_color'];
}

echo '<style>#rd_'.$id.' {margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;}#rd_'.$id.' a:hover {color:'.$hover_color.'; border:1px solid '.$hover_color.';}';
if ($tooltip !== ''){
	
echo '#rd_'.$id.' ul li a:before{content:"'.$tooltip.'"}';	
}
echo '</style>';
?>
   <div class="sc-share-box <?php echo esc_attr($align); ?>" id="rd_<?php echo esc_attr($id); ?>">
      <ul>
   <?php if($facebook !== ''){ ?>   
        <li id="facebook" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_attr($url); ?>&amp;t=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-facebook"></i></a>
         </li>

   <?php } if($twitter !== ''){ ?>         
        <li id="twitter" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://twitter.com/home?status=<?php echo esc_attr($msg); ?> <?php echo esc_attr($url); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-twitter"></i></a>
         </li>
   
   <?php } if($lin !== ''){ ?>      
        <li id="lin" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-linkedin"></i></a>
         </li>
   
   <?php } if($reddit !== ''){ ?>      
        <li id="reddit" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://reddit.com/submit?url=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-reddit"></i></a>
         </li>
     
   <?php } if($tumblr !== ''){ ?>    
        <li id="tumblr" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://www.tumblr.com/share/link?url=<?php echo urlencode($url); ?>&amp;name=<?php echo urlencode($msg); ?>&amp;description=<?php echo urlencode($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-tumblr"></i></a>
         </li>
    
   <?php } if($gplus !== ''){ ?>     
        <li id="gplus" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php echo esc_attr($url); ?>&amp;title=<?php echo esc_attr($msg); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-google-plus"></i></a>
         </li>
         
   <?php } if($mail !== ''){ ?>
        <li id="member_email" <?php if($animation !== ''){echo 'class="'.$animation.'"';} ?>> <a  target="_blank" onClick="popup = window.open('mailto:?subject=<?php echo esc_attr($msg); ?>&amp;body=<?php echo esc_attr($url); ?>', 'PopupPage', 'height=450,width=500,scrollbars=yes,resizable=yes'); return false" href="#"><i class="fa fa-envelope-o"></i></a>
          </li>
 
   <?php } ?>         
      </ul>
    </div>
	
	<?php $output_string = ob_get_contents();
ob_end_clean();
return $output_string; 

}


add_shortcode('rd_share_sc', 'rd_share_sc');


?>