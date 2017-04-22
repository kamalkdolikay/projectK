<?php 


/*-----------------------------------------------------------------------------------*/



/* Socials Icons shortcode



/*-----------------------------------------------------------------------------------*/

function rd_social_sc($atts, $content = null) {
	extract( shortcode_atts( array(

        'style' => '',
        'color' => '',
        'bg_color' => '',
        'h_color' => '',
        'facebook' => '',
        'twitter' => '',
        'pinterest' => '',
        'google' => '',
        'dribbble' => '',
        'instagram' => '',
        'tumblr' => '',
        'vimeo' => '',
        'behance' => '',
        'flickr' => '',
        'youtube' => '',
        'linkedin' => '',
        'skype' => '',
        'reddit' => '',
        'da' => '',
        'digg' => '',
        'rss' => '',
        'mt' => '',
        'mb' => '',
        'color' => '',
        'animation' => '',
	), $atts ) );
	
	ob_start();
 global $rd_data;	
	$id = RandomString(20);
	$i = 0;	 ?>

	<div class="rd_si_sc <?php echo esc_attr($style) ?>" id="rd_<?php echo esc_attr($id) ?>">   
	
	<?php
	

	
	
	 if($google !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="gplus" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($google) ?>" target="_blank" ><i class="fa fa-google-plus"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($skype !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="skype" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($skype) ?>"  target="_blank"><i class="fa fa-skype"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($pinterest !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="Pinterest" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($pinterest) ?>"  target="_blank" ><i class="fa fa-pinterest"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($vimeo !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="vimeo" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($vimeo) ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($youtube !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="yt" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($youtube) ?>" target="_blank"><i class="fa fa-youtube"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($da !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="da" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($da) ?>" target="_blank" ><i class="fa fa-deviantart"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($dribbble !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="dribbble" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($dribbble) ?>" target="_blank" ><i class="fa fa-dribbble"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($tumblr !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="tumblr" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($tumblr) ?>" target="_blank"><i class="fa fa-tumblr"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($linkedin !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="lin" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($linkedin) ?>" target="_blank"><i class="fa fa-linkedin"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($twitter !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="twitter" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($twitter) ?>" target="_blank"><i class="fa fa-twitter"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($reddit !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="reddit" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($reddit) ?>" target="_blank" ><i class="fa fa-reddit"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($behance !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="behance" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($behance) ?>" target="_blank" ><i class="fa fa-behance"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($digg !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="digg" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($digg) ?>" target="_blank" ><i class="fa fa-digg"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($flickr !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="flickr" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($flickr) ?>" target="_blank" ><i class="fa fa-flickr"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($instagram !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="instagram" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($instagram) ?>" target="_blank" ><i class="fa fa-instagram"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($facebook !== '') : ?>
      <?php //Using the icon link from the options panel ?>
      <div id="facebook" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($facebook) ?>" target="_blank" ><i class="fa fa-facebook"></i></a></div>
      <?php $i ++; endif; ?>
      <?php //Checking if the icon is needed from the options panel ?>
      <?php if($rss !== '') : ?>
      <div id="rss" class="<?php echo esc_attr($animation) ?>"> <a href="<?php echo esc_url($rss) ?>" target="_blank" ><i class="fa fa-rss"></i></a></div>
      <?php $i ++; endif; ?>
	  
	</div>
	 
	 <?php
	 
	$css = '<style>';
	
	$css .= '#rd_'.$id.' {margin:'.$mt.'px auto '.$mb.'px;}';
	$css .= '#rd_'.$id.' div a{color:'.$color.';}';
	if($style == 'rd_si_big_squared' || $style == 'rd_si_big_rounded'|| $style == 'rd_si_big_rounded_trend'){
	$css .= '#rd_'.$id.' div {width:'.(100/$i).'% ;}';	
	}
	if( $style == 'rd_si_big_rounded_trend'){
	$css .= '#rd_'.$id.' div a{background:'.$bg_color.';}#rd_'.$id.' div a:hover{color:'.$h_color.'!important;}';	
	}
	if($style == 'rd_si_small' && $h_color !== '' || $style == 'rd_si_medium' && $h_color !== '' ){
	$css .= '#rd_'.$id.' div a:hover{color:'.$h_color.'!important;}';	
	}
	$css .= '</style>';
	
	echo !empty( $css ) ? $css : '';
	 
	 
	 
	 
	 
$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 



	}
add_shortcode('rd_social_sc', 'rd_social_sc');





?>