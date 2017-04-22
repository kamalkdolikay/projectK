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
$client = get_post_meta($post->ID, 'rd_client', true);
$p_url = get_post_meta($post->ID, 'rd_p_url', true);
$title = get_post_meta($post->ID, 'rd_title', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_color = get_post_meta($post->ID, 'rd_title_color', true);
$titlebg_color = get_post_meta($post->ID, 'rd_titlebg_color', true);
$subtitle = get_post_meta($post->ID, 'rd_subtitle', true);
$ctbg = get_post_meta($post->ID, 'rd_ctbg', true);
$portfolio_layout = get_post_meta($post->ID, 'rd_width', true);
$content_border_color = $rd_data['rd_content_border_color'];
		$bc = get_post_meta($post->ID, 'rd_bc', true);
 $home = __('Home', 'thefoxwp'); // text for the 'Home' link
$mc_bg_color = $rd_data['rd_content_bg_color'];
	$mc_heading_color = $rd_data['rd_content_heading_color'];
	$mc_text_color = $rd_data['rd_content_text_color'];
	$mc_hl_color = $rd_data['rd_content_hl_color'];
	$mc_hover_color = $rd_data['rd_content_hover_color'];
	$mc_light_hover_color = $rd_data['rd_content_light_hover_color'];
	$mc_border_color = $rd_data['rd_content_border_color']; 
	$main_cat = '';


	if(get_post_meta($post->ID, 'rd_width', true) == 'half') {
		$portfolio_width = 'slider';
		$information_width = 'information';
	}
	else{
		$portfolio_width = 'full_slider';
		$information_width = 'full_information';
	}
	if(get_post_meta($post->ID, 'rd_share_buttons', true) !== 'yes'){
echo "<style>#information,#content { padding-bottom:60px; }</style>";
	}


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
	$title_padding_top = $title_padding_bottom;
	
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
	$title_padding_top = $title_padding_bottom + 162;
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
if($title !== 'no'){  ?>
<div class="page_title_ctn"> 
  <div class="wrapper table_wrapper">
  <h1><?php the_title(); ?></h1>
  <?php if($bc !== 'no') { echo wpb_list_child_pages();  ?>     
<div id="breadcrumbs">
    <div id="crumbs"><a href="<?php echo home_url(''); ?>">
      <?php echo !empty( $home ) ? $home : ''; ?>
      </a><i class="fa-angle-right crumbs_delimiter"></i><a href="<?php if($rd_data['rd_bc_portlink']){echo esc_url($rd_data['rd_bc_portlink']);} ?>">
      <?php if($rd_data['rd_bc_porttext']){echo !empty( $rd_data['rd_bc_porttext'] ) ? $rd_data['rd_bc_porttext'] : '';} ?>
      </a><i class="fa-angle-right crumbs_delimiter"></i><span>
      <?php the_title(); ?>
      </span></div>
  </div>
<?php } ?> 
</div>
</div>
<?php } 
 	
do_action( '__after_page_title' );	
	
?>







<div class="section def_section">
<?php if($portfolio_layout !== 'page') {?>
<div class="wrapper portfolio_single_page">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
<div class="single_port_navigation"><a href="<?php if($rd_data['rd_bc_portlink']){echo esc_url($rd_data['rd_bc_portlink']);} ?>" class="all_projects_btn"><span class="ap_top_point"></span><span class="ap_bottom_point"></span></a><?php $prev = get_permalink(get_adjacent_post(false,'',false)); if ($prev != get_permalink()) { ?><a href="<?php echo esc_url($prev); ?>" class="next_project"><?php echo __('Next', 'thefoxwp'); ?></a><?php } ?><?php $next = get_permalink(get_adjacent_post(false,'',true)); if ($next != get_permalink()) { ?><a href="<?php echo esc_url($next); ?>" class="previous_project"><?php echo __('Previous', 'thefoxwp'); ?></a><?php } ?></div>

<div class="port_details_<?php echo esc_attr($portfolio_width); ?> clearfix">
     <?php
$galleryArray = get_post_gallery_ids($post->ID); 	 
$isgallery = array_filter($galleryArray);
$video = get_post_meta($post->ID, 'rd_video', true);
if ($video !== ''){
	echo "<div class='post-attachement'>".$video."</div>";
}
elseif(!empty($isgallery)){
	echo "<div class='post_att_s'><div class='flexslider'><ul class='slides'>";
	foreach ($galleryArray as $id) {
	$url = wp_get_attachment_url( $id, 'full', 0 );
	echo "<li>";
	echo '<a href="' .$url. '"  class="prettyPhoto ">';
	echo wp_get_attachment_image( $id, 'blog_tn', 0 );
	echo "</a></li>";
	}
	echo "</ul></div></div>"; 
}elseif('' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
	echo '<a href="'.$url. '" class="prettyPhoto ">';
	echo get_the_post_thumbnail(get_the_id(), "full");
	echo '</a>';
	
}

?>

<?php
global $post;

$categories = get_the_terms( $post->ID, 'catportfolio' );
if ( $categories && ! is_wp_error( $categories ) ) : 
			$all_categories = array();
			$first_cat = array();
			foreach ( $categories as $category ){
				$all_categories[] = $category->name;
			}
			$all_categories = str_replace(' ', ' ', $all_categories);
			$first_cat = str_replace(' ', '-', $all_categories);
			$main_cat = join( "", $first_cat );	
			$categories_r = join( ", ", $all_categories );		
			else :	
			$categories_r = '';	
			endif;



$tags = get_the_terms( $post->ID, 'tagportfolio' );
if ( $tags && ! is_wp_error( $tags ) ) : 
			$all_tags = array();
			foreach ( $tags as $tag ){
				$all_tags[] = $tag->name;
			}
			$all_tags = str_replace(' ', ' ', $all_tags);	
			$tags_r = join( ", ", $all_tags );		
			else :	
			$tags_r = '';	
			endif;
?>
    </div>
<!-- Slider END--> 
    


<!-- informations -->
    
    <div class="port_details_<?php echo esc_attr($information_width); ?>">
  <h2 class="port_details_title"><?php the_title(); ?></h2>
  <?php if($subtitle !== ''){ 
  echo '<h6 class="port_details_subtitle">'.$subtitle.'</h6>';
  
  } 
  
	echo '<div class="item_details_info"><div class="item_details_date">' . get_the_date() . '</div>';
	if( function_exists('zilla_likes') ){
			echo do_shortcode('[zilla_likes]');
			
		}
	echo	'</div><div class="item_details_entry clearfix">';
	
  
   the_content(); 


if(get_post_meta($post->ID, 'rd_width', true) !== 'half' ) { 


if(get_post_meta($post->ID, 'rd_share_buttons', true) == 'yes' ) { ?>
    
	
    <div class="share_icons_container"><div class="shareicons_icon"></div><div class="single_post_share_icon"><?php rd_share_panel(); ?></div></div>
    
    <?php }	
	
	if ($p_url !=='') {
		echo '<div class="port_vp">';
	 		
				echo '<a href="'.$p_url.'" target="_blank">'.__('Launch Project', 'thefoxwp').'</a>';
	 		
		echo '</div>';
	}
	
	}



	echo '</div>';

echo '<div class="port_metas">';
	if ($client !=='') {
		 
		echo '<div class="port_meta clearfix"><div class="port_meta_first">'.__('Client', 'thefoxwp').':</div>';
		echo '<div class="port_meta_last">'.$client.'</div></div>';
	}
	if ($p_url !=='') {
		echo '<div class="port_meta clearfix"><div class="port_meta_first">'.__('Project url', 'thefoxwp').':</div>';
		$url = preg_replace('#^https?://#', '', $p_url);
				echo '<div class="port_meta_last"><a href="'.$p_url.'" target="_blank">'.$url.'</a></div></div>';
	}
	if ($categories_r !=='') {
		 
		echo '<div class="port_meta clearfix"><div class="port_meta_first">'.__('Category', 'thefoxwp').':</div>';
		echo '<div class="port_meta_last">'.$categories_r.'</div></div>';
	}
	if ($tags_r !=='') {
		 
		echo '<div class="port_meta clearfix"><div class="port_meta_first">'.__('Tags', 'thefoxwp').':</div>';
		echo '<div class="port_meta_last">'.$tags_r.'</div></div>';
	}
	echo '</div>';
	

if(get_post_meta($post->ID, 'rd_width', true) == 'half' ) { 


if(get_post_meta($post->ID, 'rd_share_buttons', true) == 'yes' ) { ?>
    
	
    <div class="share_icons_container"><div class="shareicons_icon"></div><div class="single_post_share_icon"><?php rd_share_panel(); ?></div></div>
    
    <?php }	
	
	if ($p_url !=='') {
		echo '<div class="port_vp">';
	 		
				echo '<a href="'.$p_url.'" target="_blank">'.__('Launch Project', 'thefoxwp').'</a>';
	 		
		echo '</div>';
	}
	
	}
	
	 endwhile; ?>
      <?php else : ?>
      <div id="notfound">
        <h2>Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here.</p>
      </div>
      <?php endif; ?>
    </div>
    
    <!-- #informations END -->
	
 <?php  if(get_post_meta($post->ID, 'rd_author_bio', true) == 'yes') {?>

<div id="author-bio">
				<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 103 ); }?>
								<div id="author-info">
									<h3><?php the_author(); ?></h3>
									<p><?php the_author_meta('description'); ?></p>
								<?php echo '<a href="'. get_author_posts_url(get_the_author_meta( 'ID' )).'" class="author_posts_link">'. __('More posts by','thefoxwp') .' '.get_the_author().' </a>'; ?>
								</div>
							</div>
    <div class="clearfix"></div>

<?php }
	
  if(get_post_meta($post->ID, 'rd_related_post', true) == 'yes') {?>
	
    <div class="single_port_related clearfix">
      <h2><?php echo __('Related Projects', 'thefoxwp'); ?>:</h2>

 <?php 
 if($main_cat == "" ){$main_cat = 'all';}
echo do_shortcode('[portfolio port_type="port_type_3" overlay="rd_hover_goliath" desc_title="'.$mc_heading_color.'" desc_cat="'.$mc_text_color.'" overlay_color="'.$mc_bg_color.'" port_thumbnail="thumbnail_type_1" port_layout="4 columns" category="'.$main_cat.'" tags="all" port_start="8" filter_type="filter_type_1" port_navigation=""]');
  }
  
  ?>
 
 <div class="single_port_comments"><?php
  comments_template(); 
 
  ?>
  </div>
  
    </div>
    
<?php }else { ?>


<div id="fw_c" class="clearfix tf_single_page">
  <div class="wrapper section_wrapper">

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <?php  the_content();  ?>
    
	<?php endwhile; ?>
    
      <?php else : ?>
      <div id="notfound">
        <h2>Not Found</h2>
        <p>Sorry, but you are looking for something that isn't here.</p>
      </div>
      <?php endif; ?>
</div>

<?php } ?>    
    
  </div>
  
  <!-- #page END --> 
  
</div>
<!-- wrapper END -->
<?php get_footer(); ?>
