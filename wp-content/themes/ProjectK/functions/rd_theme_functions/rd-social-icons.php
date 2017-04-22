<?php
	function rd_social_icon(){
			
 global $rd_data;	
	ob_start();
		if($rd_data['rd_facebook_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="facebook"> <a href="<?php echo esc_url($rd_data['rd_facebook_link']) ?>" target="_blank" ><i class="fa fa-facebook"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_twitter_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="twitter"> <a href="<?php echo esc_url($rd_data['rd_twitter_link']) ?>" target="_blank"><i class="fa fa-twitter"></i></a></div>
      <?php endif; ?>
      <?php if($rd_data['rd_googleplus_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="gplus"> <a href="<?php echo esc_url($rd_data['rd_googleplus_link']) ?>" target="_blank" ><i class="fa fa-google-plus"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_dribbble_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="dribbble"> <a href="<?php echo esc_url($rd_data['rd_dribbble_link']) ?>" target="_blank" ><i class="fa fa-dribbble"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_skype_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="skype"> <a href="<?php echo esc_url($rd_data['rd_skype_link']) ?>"  target="_blank"><i class="fa fa-skype"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_pinterest_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="Pinterest"> <a href="<?php echo esc_url($rd_data['rd_pinterest_link']) ?>"  target="_blank" ><i class="fa fa-pinterest"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_vimeo_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="vimeo"> <a href="<?php echo esc_url($rd_data['rd_vimeo_link']) ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_yt_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="yt"> <a href="<?php echo esc_url($rd_data['rd_yt_link'] )?>" target="_blank"><i class="fa fa-youtube"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_da_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="da"> <a href="<?php echo esc_url($rd_data['rd_da_link']) ?>" target="_blank" ><i class="fa fa-deviantart"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_tumblr_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="tumblr"> <a href="<?php echo esc_url($rd_data['rd_tumblr_link']) ?>" target="_blank"><i class="fa fa-tumblr"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_lin_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="lin"> <a href="<?php echo esc_url($rd_data['rd_lin_link']) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_reddit_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="reddit"> <a href="<?php echo esc_url($rd_data['rd_reddit_link']) ?>" target="_blank" ><i class="fa fa-reddit"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_behance_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="behance"> <a href="<?php echo esc_url($rd_data['rd_behance_link']) ?>" target="_blank" ><i class="fa fa-behance"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_digg_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="digg"> <a href="<?php echo esc_url($rd_data['rd_digg_link']) ?>" target="_blank" ><i class="fa fa-digg"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_flickr_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="flickr"> <a href="<?php echo esc_url($rd_data['rd_flickr_link']) ?>" target="_blank" ><i class="fa fa-flickr"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_instagram_link'] !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="instagram"> <a href="<?php echo esc_url($rd_data['rd_instagram_link']) ?>" target="_blank" ><i class="fa fa-instagram"></i></a></div>
      <?php endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rd_data['rd_feedburner'] !== '') : ?>
      <div id="rss"> <a href="<?php $feed = $rd_data['rd_feedburner'];
                                            // if feedburner URL is provided in the Theme Options Panel it uses it
                                            if ($feed != '')
                                            {
                                                echo esc_url($rd_data['rd_feedburner']);
                                            }
                                            else
                                            {
                                                // else it uses the standard RSS link
                                                bloginfo('rss2_url');
                                            } ?>
                                            " target="_blank" ><i class="fa fa-rss"></i></a></div>
      <?php endif;
	 
$output_string = ob_get_contents();
ob_end_clean();

echo !empty( $output_string ) ? $output_string : '';
	}


?>