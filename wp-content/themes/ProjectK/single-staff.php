<?php
/// Set the slider

$slider_page_id = $post->ID;
if(is_home() && !is_front_page()){
	$slider_page_id = get_option('page_for_posts');
}

if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layer' && (get_post_meta($slider_page_id, 'rd_slider', true) || get_post_meta($slider_page_id, 'rd_slider', true) != 0)){ 

	function add_revolution_slider(){
		echo '<div>';
	    echo do_shortcode('[rev_slider '.get_post_meta(get_the_ID(), 'rd_slider', true).']'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_revolution_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_revolution_slider');
	}


}
if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layerslider' && (get_post_meta($slider_page_id, 'rd_layerslider', true) || get_post_meta($slider_page_id, 'rd_layerslider', true) != 0)){ 

	function add_layer_slider(){
		echo '<div>';
	    echo do_shortcode('[layerslider  id="'.get_post_meta(get_the_ID(), 'rd_layerslider', true).'"]'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_layer_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_layer_slider');
	}


}


get_header();
global $rd_data; 
$header_top_bar = get_post_meta( $post->ID, 'rd_top_bar', true );
$header_transparent = get_post_meta( $post->ID, 'rd_header_transparent', true );
$title = get_post_meta($post->ID, 'rd_title', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_color = get_post_meta($post->ID, 'rd_title_color', true);
$titlebg_color = get_post_meta($post->ID, 'rd_titlebg_color', true);
	$ctbg = get_post_meta($post->ID, 'rd_ctbg', true);
	$bc = get_post_meta($post->ID, 'rd_bc', true);
	$home = __('Home', 'thefoxwp'); // text for the 'Home' link
	$mc_bg_color = $rd_data['rd_content_bg_color'];
	$mc_heading_color = $rd_data['rd_content_heading_color'];
	$mc_text_color = $rd_data['rd_content_text_color'];
	$mc_hl_color = $rd_data['rd_content_hl_color'];
	$mc_hover_color = $rd_data['rd_content_hover_color'];
	$mc_light_hover_color = $rd_data['rd_content_light_hover_color'];
	$mc_border_color = $rd_data['rd_content_border_color']; 

$generated_section = get_post_meta($post->ID, 'rd_generated_section', true);      
$facebook = get_post_meta($post->ID, 'rd_facebook', true);
$twitter = get_post_meta($post->ID, 'rd_twitter', true);
$linkedin = get_post_meta($post->ID, 'rd_linkedin', true);
$tumblr = get_post_meta($post->ID, 'rd_tumblr', true);
$gplus = get_post_meta($post->ID, 'rd_gplus', true);
$mail = get_post_meta($post->ID, 'rd_mail', true);
$skype = get_post_meta($post->ID, 'rd_skype', true);
$Pinterest= get_post_meta($post->ID, 'rd_pinterest', true);
$vimeo = get_post_meta($post->ID, 'rd_vimeo', true);
$youtube = get_post_meta($post->ID, 'rd_youtube', true);
$dribbble = get_post_meta($post->ID, 'rd_dribbble', true);
$deviantart = get_post_meta($post->ID, 'rd_deviantart', true);
$reddit = get_post_meta($post->ID, 'rd_reddit', true);
$behance = get_post_meta($post->ID, 'rd_behance', true);
$digg = get_post_meta($post->ID, 'rd_digg', true);
$flickr = get_post_meta($post->ID, 'rd_flickr', true);
$instagram = get_post_meta($post->ID, 'rd_instagram', true);
$position = get_post_meta($post->ID, 'rd_position', true);
$member_desc = get_post_meta($post->ID, 'rd_small_desc', true);
$real_name = get_post_meta($post->ID, 'rd_real_name', true);
$phone = get_post_meta($post->ID, 'rd_phone', true);
$member_url = get_post_meta($post->ID, 'rd_member_url', true);
$skills = get_post_meta($post->ID, 'rd_skills', true);


	

/// Check if need to hide header top bar

if ($header_top_bar == 'yes' ){

 echo '<style>#top_bar {display:none;}</style>';

}



/// Check if header is transparent

if( ( $rd_data['rd_nav_type'] == 'nav_type_1' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_2' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_3' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_8' && $header_transparent == "yes" || $rd_data['rd_nav_type'] == 'nav_type_9' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 90;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 133;
}
}
if( ( $rd_data['rd_nav_type'] == 'nav_type_10' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 91;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 134;
}
}

if($rd_data['rd_nav_type'] == 'nav_type_4' && $header_transparent == "yes" ){

	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 101;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 144;
}

}
if(($rd_data['rd_nav_type'] == 'nav_type_5' || $rd_data['rd_nav_type'] == 'nav_type_6' || $rd_data['rd_nav_type'] == 'nav_type_7' || $rd_data['rd_nav_type'] == 'nav_type_12'  ) && $header_transparent == "yes"){

	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 100;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 143;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_10' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 91;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 134;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_11' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 110;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 153;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_13' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 62;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 105;
}
}


if( ( $rd_data['rd_nav_type'] == 'nav_type_14' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 65;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 108;
}
}

if( ( $rd_data['rd_nav_type'] == 'nav_type_15' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 140;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 183;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_16' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 160;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 203;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_17' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 159;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 202;
}
}if( ( $rd_data['rd_nav_type'] == 'nav_type_18' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 162;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 205;
}
}
if( ( $rd_data['rd_nav_type'] == 'nav_type_19' ) && $header_transparent == "yes"){
	
if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom + 162;
	
}else{
		$title_padding_bottom = 43;
	$title_padding_top = 43;
}
}


if($header_transparent == "yes" && $rd_data['rd_nav_type'] !== 'nav_type_19' && $rd_data['rd_nav_type'] !== 'nav_type_19_f' ){
 ?>
<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
		
		
		j$('#header_container').css('position', 'absolute');
		j$('#header_container').css('width', '100%');	
		j$('header').addClass('transparent_header');		
		j$('.header_bottom_nav').addClass('transparent_header');
		
</script>

<?php

}else {

if($title_height !== ''){
	
	$title_padding_bottom = $title_height/2;
	$title_padding_top = $title_padding_bottom;
}else{
	
	$title_padding_bottom = $title_padding_top = 43;

}
}

/// Set title height
echo '<style>.page_title_ctn {padding-top:'.$title_padding_top.'px; padding-bottom:'.$title_padding_bottom.'px;}</style>';
 
/// Set the title color
if($title_color !== ''){
	$rgba= rd_hex_to_rgb_array($title_color);
	echo '<style>.page_title_ctn h1,.page_title_ctn h2,#crumbs,#crumbs a{color:'.$title_color.';}.page_t_boxed h1,.page_t_boxed h1{border-color:rgba('. $rgba[0].','.$rgba[1].','.$rgba[2] .',0.5); }#crumbs span{color:rgba('. $rgba[0].','.$rgba[1].','.$rgba[2] .',0.8);}</style>';
}
/// Set the title background
if($titlebg_color !== ''){
	echo '<style>.page_title_ctn {background-color:'.$titlebg_color.'; }</style>';
}
if($ctbg !== ''){
	echo '<style>.page_title_ctn{background:url('.$ctbg.') top center; background-size: cover; border-bottom:1px solid '.$content_border_color.'; }</style>';
}
/// Check title style
/// Check title style
if($title !== 'no'){  ?>
<div class="page_title_ctn"> 
  <div class="wrapper table_wrapper">
  <h1><?php the_title(); ?></h1>
  <?php if($bc !== 'no') { echo wpb_list_child_pages();  ?>     
<div id="breadcrumbs">
  <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
</div>
<?php } ?> 
</div>
</div>
<?php } 
 	
do_action( '__after_page_title' );	
	
?>






<div class="section def_section">
<div class="wrapper <?php if($generated_section !== 'no'){ echo 'staff_single_page'; } ?> section_wrapper">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); 

if($generated_section !== 'no'){
	
	?>
    
    
<div class="staff_profile">
<?php echo the_post_thumbnail('staff_tn'); ?>
</div>

<div class="staff_generated_info">

<div class="staff_name_position"><h2 class="single_staff_name"><?php the_title(); ?></h2>
<?php if($position !== ''){ 
  echo '<h6 class="single_staff_position">'.$position.'</h6>';
  
  } 
  ?>
</div>

 <div class="single_staff_social">
        <?php if ($facebook!== '') { ?>
		<div id="facebook"><a  target="_blank" href="http://www.facebook.com/<?php echo esc_attr($facebook); ?>"  ><i class="fa fa-facebook"></i></a></div>
        <?php } ?>
        <?php if ($twitter!== '') { ?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '') { ?>
<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '') { ?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '') { ?>
<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '') { ?>
<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '') { ?>
<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '') { ?>
<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '') { ?>
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble);  ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '') { ?>
<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '') { ?>
<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '') { ?>
<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '') { ?>
<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '') { ?>
 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '') { ?>
<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '') { ?>
<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '') { ?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    </div>

<?php  if($member_desc !== ''){ 
  echo '<div class="single_staff_desc">'.$member_desc.'</div>';
 
		} 

?>
<div class="single_staff_meta">
<?php  if($real_name !== ''){ 
  echo '<div class="staff_meta_first">'.__('Real name','thefoxwp').':</div><div class="staff_meta_last">'.$real_name.'</div>';
 		}if($member_url !== ''){
		$url = preg_replace('#^https?://#', '', $member_url); 
  echo '<div class="staff_meta_first">'.__('Website','thefoxwp').':</div><div class="staff_meta_last"><a href="'.$member_url.'" target="_blank">'.$url.'</a></div>';
 		}if($mail !== ''){ 
  echo '<div class="staff_meta_first">'.__('Email','thefoxwp').':</div><div class="staff_meta_last">'.$mail.'</div>';
 		}if($phone !== ''){ 
  echo '<div class="staff_meta_first">'.__('Phone','thefoxwp').':</div><div class="staff_meta_last">'.$phone.'</div>';
 		}if($skills !== ''){ 
  echo '<div class="staff_meta_first">'.__('Skills','thefoxwp').':</div><div class="staff_meta_last">'.$skills.'</div>';
 		}  

?>
</div>

</div>    
<?php } ?>
<div <?php if($generated_section == 'no'){ echo 'id="fw_c"'; } ?> class="single_staff_content clearfix">
<?php echo    the_content(); ?>
</div>    
    
    
    
<?php endwhile; ?>
      <?php else : ?>
      <div id="notfound">
        <h2>Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here.</p>
      </div>
      <?php endif; ?>
    
  </div>
  
  <!-- #page END --> 
  
</div>
<!-- wrapper END -->
<?php get_footer(); ?>
