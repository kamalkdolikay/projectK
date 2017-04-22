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
$p_sidebar = get_post_meta( $post->ID, 'rd_sidebar', true );
$title = get_post_meta($post->ID, 'rd_title', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_color = get_post_meta($post->ID, 'rd_title_color', true);
$titlebg_color = get_post_meta($post->ID, 'rd_titlebg_color', true);
$ctbg = get_post_meta($post->ID, 'rd_ctbg', true);
$post_nav = get_post_meta($post->ID, 'rd_show_navigation', true);
$content_border_color = $rd_data['rd_content_border_color'];
$bc = get_post_meta($post->ID, 'rd_bc', true);
	   

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

<div class="section">
  <div class="wrapper">

<?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { 
 ?>
    <div id="posts" class=" <?php if ( $p_sidebar == 'right' ) { echo 'left_posts"'; } else { echo 'right_posts"'; } ?> ">
      <?php  }else{ ?>
<div id="fw_c" class="fw_single_post clearfix">
    <?php } ?>
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      
      <!-- .post -->
      
    <div class="post post_single vc_row">
<?php if($post_nav !== 'no') { ?>   
    
<div class="single_post_navigation"><?php $prev = get_permalink(get_adjacent_post(false,'',false)); if ($prev != get_permalink()) { ?><a href="<?php echo esc_url($prev); ?>" class="next_project"><?php echo __('Next', 'thefoxwp'); ?></a><?php } ?><?php $next = get_permalink(get_adjacent_post(false,'',true)); if ($next != get_permalink()) { ?><a href="<?php echo esc_url($next); ?>" class="previous_project"><?php echo __('Previous', 'thefoxwp'); ?></a><?php } ?></div>
<?php

}


$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo '<a href="'.$url. '" class="prettyPhoto ">';
		echo "<div class='post-attachement'>";
		echo the_post_thumbnail('blog_tn');
		echo "</a></div><div class='sep_25'></div>";
	}
	elseif( $post_format == 'quote' ){	
	echo '<a class="post_quote_ctn"><div class="post_quote_text" >';
	echo !empty( $quote_text ) ? $quote_text : '';
	echo '<span class="post_quote_icon fa-link"></span></div>';
	echo '<div class="post_quote_author" >';
	echo !empty( $quote_author ) ? $quote_author : '';	
	echo '</div><div class="sep_25"></div>';
			echo '</a>';
	}elseif( $post_format == 'audio' ){
		preg_match("!\[audio.+?\]\[\/audio\]!", $content , $match_audio);
		if(!empty($match_audio)) {
			echo '<div class="audio_ctn" >';
			echo do_shortcode($match_audio[0]);
			echo '</div>';
			$content = str_replace($match_audio[0], "", $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo "<div class='sep_25'></div>";
		}
	}elseif ($post_format == 'video' && $my_video !== ''){
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";}
	
	elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
				if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
					foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );
			echo "<li>";
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			echo "</a></li>";
					}
			echo "</ul></div></div><div class='sep_25'></div>"; 
				}
	}
}
 
 ?>
  <div class="post_ctn clearfix"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
    </div>
     <!-- .title END--> 
     <!-- post-info-top -->
    <div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php the_time('j F, Y') ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	} ?></div>
    <!-- post-info END-->     
    <!-- .entry -->    
    <div class="entry">
      <?php 	the_content(__('Read more', 'thefoxwp')); wp_link_pages(); ?>
    </div>   
    <!-- .entry END --> 
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->
    
    <div class="tags_container"><div class="tags_icon"></div><div class="single_post_tags"><?php $tag = get_the_tags(); if (! $tag)  { echo __('No tags.','thefoxwp') ; } else { ?><?php the_tags(' ', ' ,', ''); ?><?php } ?></div></div>
    
    <?php endwhile; ?>
    <?php if(get_post_meta($post->ID, 'rd_share_buttons', true) == 'yes') {  ?>
    
	
    <div class="share_icons_container"><div class="shareicons_icon"></div><div class="single_post_share_icon"><?php rd_share_panel(); ?></div></div>
    
	
<?php } if(get_post_meta($post->ID, 'rd_author_bio', true) == 'yes') {?>


<div id="author-bio">
				<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 103 ); }?>
								<div id="author-info">
									<h3><?php the_author(); ?></h3>
									<p><?php the_author_meta('description'); ?></p>
								<?php echo '<a href="'. get_author_posts_url(get_the_author_meta( 'ID' )).'" class="author_posts_link">'. __('More posts by','thefoxwp') .' '.get_the_author().' </a>'; ?>
								</div>
							</div>








<?php }if(get_post_meta($post->ID, 'rd_related_post', true) == 'yes') {



ob_start();
if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { 

$max_post = 3;
}else {
$max_post = 4;	
}
			
		echo '
		<div class="single_post_related_carousel"><script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {
		j$(".rp_sc ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".related_left",
					next: ".related_right",
					auto: false,
					items: {
						width: 310,
						height: null,
					//	height: "30%",	//	optionally resize item-height
						visible: {
							min: 1,
							max: '.$max_post.'
						}
					}
				});
				});
	</script>
	
	<h2 class="single_related">'. __('Related Post','thefoxwp').'</h2>
	<div class="related_nav">
  <p class="related_left"></p>
  <p class="related_right"></p>
</div>
	<div class="rp_sc">
<ul>';




   global $post;
		$current_post = array($post->ID);
$related = get_related_tag_posts_ids( $post->ID, 5 );
        $query = new WP_Query();
		$i = 0;
        $query->query(array(
            'post_type' => 'Post',
            'posts_per_page' => '8',
		'post__in'      => $related,
		'orderby'       => 'post__in',
        'post__not_in' => $current_post,
		'no_found_rows' => true, // no need for pagination
	
			


        ));
      
				
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
      


?>
      <!-- related post -->

      <li class="blog_related_post brsc">
      
     <div class="post">

<?php

	if( get_the_post_thumbnail() ) {
		echo "<div class='post-attachement'>";
		echo  the_post_thumbnail(array(600, 490) ); 
		echo "</div><div class='sep_25'></div>";
	}	

 
 ?>
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
    </div>
     <!-- .title END--> 
     <!-- post-info-top -->     
    <div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></div>
     
    <!-- post-info END-->     
    <!-- .entry -->    
    <div class="entry">
      <?php 		echo rd_custom_excerpt('rd_related_excerpt','rd_related_more'); ?>
    </div>   
    <!-- .entry END --> 
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->
      </li>

      <?php  endwhile; endif; ?>

      <?php wp_reset_postdata(); ?>

    </ul>

  </div>
</div>
<?php

$output_string = ob_get_contents();
ob_end_clean();
	
echo !empty( $output_string ) ? $output_string : '';		
	

}

 comments_template(); if($post_nav !== 'no') { ?>
 

 <div class="single_post_navigation_bottom"><?php $prev = get_permalink(get_adjacent_post(false,'',false)); if ($prev != get_permalink()) { ?><a href="<?php echo esc_url($prev); ?>" class="next_project"><?php echo __('Next', 'thefoxwp'); ?></a><?php } ?><?php $next = get_permalink(get_adjacent_post(false,'',true)); if ($next != get_permalink()) { ?><a href="<?php echo esc_url($next); ?>" class="previous_project"><?php echo __('Previous', 'thefoxwp'); ?></a><?php } ?></div>
 
 <?php } ?>
 
  </div>
  
  <!-- #posts END -->
  
  <?php if ( $p_sidebar == 'right' || $p_sidebar == 'left' ) { ?>
        <div id="sidebar" class=" <?php if ( $p_sidebar == 'right' ) { echo "right_sb"; } else { echo "left_sb"; } ?> ">
      <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); } ?>
    </div>
    <div class="clearfix"></div>
    <?php  } ?>
</div>

<!-- #page_content END -->

</div>
<?php else : ?>
<div id="notfound">
  <h2>Not Found</h2>
  <p>Sorry, but you are looking for something that isn't here.</p>
</div>
<?php endif; ?>
<?php get_footer(); ?>
