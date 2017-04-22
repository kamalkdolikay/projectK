<?php get_header();
global $rd_data;$blog_bg_color = $blog_border_color = $blog_heading_color = $blog_hl_color = $blog_hover_color = $blog_text_color = $blog_timelinedb_color = $button_bg = $button_border = $button_hover_bg = $button_hover_title = $button_title = $nav_bg = $nav_border = $nav_color = $nav_hover_bg = $nav_hover_color = '';

if($blog_heading_color == '' ){
	$blog_heading_color = $rd_data['rd_content_heading_color'];
}
if($blog_text_color == '' ){
	$blog_text_color = $rd_data['rd_content_text_color'];
}
if($blog_hl_color == '' ){
	$blog_hl_color = $rd_data['rd_content_hl_color'];
}
if($blog_hover_color == '' ){
	$blog_hover_color = $rd_data['rd_content_alt_hover_color'];
}
if($blog_border_color == '' ){
	$blog_border_color = $rd_data['rd_content_border_color'];
}
if($blog_timelinedb_color == '' ){
	$blog_timelinedb_color = $rd_data['rd_content_bg_color'];
}
if($blog_bg_color == '' ){
	$blog_bg_color = $rd_data['rd_content_bg_color'];
}
if($button_bg == '' ){
	$button_bg = $rd_data['rd_content_bg_color'];
}
if($button_title == '' ){
	$button_title = $rd_data['rd_content_heading_color'];
}
if($button_hover_title == '' ){
	$button_hover_title = $rd_data['rd_content_bg_color'];
}
if($button_border == '' ){
	$button_border = $rd_data['rd_content_heading_color'];
}
if($button_hover_bg == '' ){
	$button_hover_bg = $rd_data['rd_content_heading_color'];
}
if($nav_bg == '' ){
	$nav_bg = $rd_data['rd_content_bg_color'];
}
if($nav_color == '' ){
	$nav_color = $rd_data['rd_content_text_color'];
}
if($nav_border == '' ){
	$nav_border = $rd_data['rd_content_border_color'];
}
if($nav_hover_color == '' ){
	$nav_hover_color = $rd_data['rd_content_bg_color'];
}
if($nav_hover_bg == '' ){
	$nav_hover_bg = $rd_data['rd_content_light_hover_color'];
}


$custom_blog_css = '<style>';

$custom_blog_css .= '.post-title h2 a{color:'.$blog_heading_color.';}.post-title h2 a:hover{color:'.$blog_hover_color.';}' ;
$custom_blog_css .= '.post,.post .post-info a{color:'.$blog_text_color.';}' ;
$custom_blog_css .= '.mejs-container .mejs-controls,.audio_ctn{background:'.$blog_text_color.' !important;}' ;
$custom_blog_css .= '.post_quote_text,.post_quote_author{background:'.$blog_hover_color.'; color:'.$blog_bg_color.';}' ;
$custom_blog_css .= '.post a{color:'.$blog_hl_color.';}.post a:hover,.post .post-info a:hover{color:'.$blog_hover_color.';}' ;
$custom_blog_css .= '.post .more-link{color:'.$blog_heading_color.'; border:1px solid '.$blog_heading_color.';}.post .more-link:hover{background:'.$blog_heading_color.'; color:'.$blog_bg_color.';}' ;
$custom_blog_css .= '.mejs-controls .mejs-time-rail .mejs-time-current{background:'.$blog_heading_color.' !important;}' ;
$custom_blog_css .= '.post .post-info{border-bottom:1px solid '.$blog_border_color.';}' ;
$custom_blog_css .= '.blog_load_more_cont .btn_load_more{background:'.$button_bg.'; color:'.$button_title.'; border:1px solid '.$button_border.';}.blog_load_more_cont .btn_load_more .refresh_icn:before{color:'.$button_title.';}.blog_load_more_cont .btn_load_more:hover{background:'.$button_hover_bg.'; color:'.$button_hover_title.'; border:1px solid '.$button_hover_bg.';}.blog_load_more_cont .btn_load_more:hover .refresh_icn:before{color:'.$button_hover_title.';}';

$custom_blog_css .= '.navigation .pagination span,.navigation .pagination a{border:1px solid '.$nav_border.'; color:'.$nav_color.'; background:'.$nav_bg.';}.navigation .pagination .current,.navigation .pagination span:hover,.navigation .pagination a:hover{ color:'.$nav_hover_color.' !important; background:'.$nav_hover_bg.'; border:1px solid '.$nav_hover_bg.'; }.navigation{border-top:1px solid '.$nav_border.';}.pagination_current_position{color:'.$nav_color.';}' ;
 
 
$custom_blog_css .= '.masonry_post_wrapper,.masonry_post_wrapper .post-info a,.masonry_post_wrapper .post-bottom-info a{color:'.$blog_text_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper a{color:'.$blog_hl_color.';}.masonry_post_wrapper a:hover,.masonry_post_wrapper .post-info a:hover,.masonry_post_wrapper .post-bottom-info a:hover{color:'.$blog_hover_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .more-link{color:'.$blog_heading_color.'; border:1px solid '.$blog_heading_color.';}.masonry_post_wrapper .more-link:hover{background:'.$blog_heading_color.'; color:'.$blog_bg_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper{background:'.$blog_bg_color.'; border:1px solid '.$blog_border_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .post-info{border-bottom:1px solid '.$blog_border_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .post-bottom-info{border-top:1px solid '.$blog_border_color.';}';
$custom_blog_css .= '.masonry_post_wrapper .flex-direction-nav li a{color:'.$blog_heading_color.'; background:'.$blog_bg_color.';}' ;


$custom_blog_css .= '.post_masonry .more{color:'.$blog_bg_color.'; border:1px solid '.$blog_heading_color.'; background:'.$blog_heading_color.'}.post_masonry .more:hover{background:'.$blog_hover_color.'; color:'.$blog_bg_color.'; border:1px solid '.$blog_hover_color.';}' ;
 
 
 
$custom_blog_css .= 'div.post_timeline:after,div.post_timeline:before{background:'.$blog_bg_color.'; box-shadow: 0 0 0 3px '.$blog_bg_color.'; border:1px solid '.$blog_hl_color.'}';
$custom_blog_css .= '.timeline_ctn .v_line{background: '.$blog_hl_color.'; background: -moz-linear-gradient(top, '.$blog_hl_color.' 1%, '.$blog_hover_color.' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,'.$blog_hl_color.'), color-stop(100%,'.$blog_hover_color.')); background: -webkit-linear-gradient(top, '.$blog_hl_color.' 1%,'.$blog_hover_color.' 100%); background: -o-linear-gradient(top, '.$blog_hl_color.' 1%,'.$blog_hover_color.' 100%); background: -ms-linear-gradient(top, '.$blog_hl_color.' 1%,'.$blog_hover_color.' 100%); background: linear-gradient(to bottom, '.$blog_hl_color.' 1%,'.$blog_hover_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$blog_hl_color.'", endColorstr="'.$blog_hover_color.'",GradientType=0 );}';
$custom_blog_css .= '.timeline_month{background:'.$blog_timelinedb_color.';}';
$custom_blog_css .= '.post_timeline .arrow_l,.post_timeline .arrow_r{color:'.$blog_heading_color.';}.post_timeline:hover .arrow_l,.post_timeline:hover .arrow_r{color:'.$blog_hover_color.';}';
$custom_blog_css .= '.timeline_pd_l,.timeline_pd_r{background:'.$blog_heading_color.'; color:'.$blog_bg_color.';}.timeline_pd_l:before,.timeline_pd_r:before{background:transparent '.$blog_heading_color.' transparent;}';


$custom_blog_css .= '.masonry_post_wrapper{box-shadow:0 0px 0px '.$blog_bg_color.', 0 10px 0 -1px '.$blog_bg_color.', 0 0px 0px 0px '.$blog_bg_color.',0 0px 0px '.$blog_bg_color.', 0 10px 0 0px '.$blog_border_color.', 0px 0px 0px 0px '.$blog_bg_color.';}';
 

$custom_blog_css .= '</style>';

echo !empty( $custom_blog_css ) ? $custom_blog_css : '';

?>

<div class="page_title_ctn boxed_t_left">
  <div class="wrapper">
    <h1>
      <?php echo __('Blog', 'thefoxwp'); ?> </h1>
      <?php if ($rd_data['rd_breadcrumbs'] == true){ ?>
    <div id="breadcrumbs">
      <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
    </div>
    <?php } ?>
  </div>
</div>
<div class="section def_section">
  <div class="wrapper section_wrapper">
    <div id="posts"  class="<?php  echo 'left_posts"'; ?> ">
      <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
      <?php if ( is_sticky() ) {?>
   <div class="post ajax_post sticky_post" <?php post_class(); ?>>
<?php } else { ?>
   <div class="post ajax_post" <?php post_class(); ?>>
<?php } ?>
      

<?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);	
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if( $post_format == 'quote' ){	
	echo '<a class="post_quote_ctn" href="';
	echo the_permalink() ;
	echo '"><div class="post_quote_text" >';
	echo !empty( $quote_text ) ? $quote_text : '';
	echo '<span class="post_quote_icon fa-link"></span></div>';
	echo '<div class="post_quote_author" >';
	echo !empty( $quote_author ) ? $quote_author : '';	
	echo '</div>';
			echo '</a></div>';
}
	
else{
	
	if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {
	
		if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '">';
		echo the_post_thumbnail('blog_tn');
		echo "</a></div><div class='sep_25'></div>";
		}
		
		elseif( $post_format == 'audio' ){
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
		}
		
		
		elseif ($post_format == 'video' && $my_video !== ''){
			echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";
		}
		
		
		elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
				if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
					foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );	
			echo "<li>";
			echo '<a href="' . get_permalink( $post->ID ) . '">';
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></li>";
					}
			echo "</ul></div></div><div class='sep_25'></div>"; 
				}
		}
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
    
    <div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php the_time('j F, Y') ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	} ?></div>
   
    
    <!-- post-info END-->     
    <!-- .entry -->    
    <div class="entry">
      <?php 	if ( $post_format == 'audio' ){ echo !empty( $content ) ? $content : '';}else{ the_content(__('Read more', 'thefoxwp')); }?>
    </div>   
    <!-- .entry END --> 
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->
      
      <?php  } endwhile; ?>
      
      <!-- .navigation -->
      
      <div class="navigation clearfix">
        <?php kriesi_pagination(); ?>
      </div>
      
      <!-- .navigation END -->
      
      <?php else : ?>
      <?php global $rd_data; if ($rd_data['rd_error_text']) { ?>
      <?php echo esc_html($rd_data['rd_error_text']); ?>
      <?php } else { ?>
      Oops, It looks like an error has occured
      <?php } ?>
      <?php endif; ?>
    </div>
    <div id="sidebar" class="right_sb" >
      <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); }?>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php get_footer(); ?>
