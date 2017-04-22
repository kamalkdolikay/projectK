<?php 

/*-----------------------------------------------------------------------------------*/



/*  Blog shortcode



/*-----------------------------------------------------------------------------------*/


function blog_sc($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'heading_size' => '' ,
                'heading_color' => '',
				'type' => 'type1',
                'heading_text' => '',
                'posts_per_page' => '10',
                'category' => 'all',
                'column' => '',
                'tn_size' => '',
				'blog_bg_color' => '',
				'blog_text_color' => '',
				'blog_heading_color' => '',
				'blog_hl_color' => '',
				'blog_hover_color' => '',
				'blog_border_color' => '',
				'blog_timelinedb_color' => '',
				'blog_v_color' => '',
				'blog_v_alt_color' => '',
				
				'blog_navigation' => '',
				
				'blog_click' => '',
				
				'nav_bg' => '',
				'nav_color' => '',
				'nav_border' => '',
				'nav_hover_color' => '',
				'nav_hover_bg' => '',
				'button_bg' => '',
				'button_title' => '',
				'button_border' => '',
				'button_hover_title' => '',
				'button_hover_bg' => '',

            ), $atts));
ob_start();

$id = RandomString(20);
global $rd_data;

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
	$blog_hover_color = $rd_data['rd_content_hover_color'];
}
if($blog_v_color == '' ){
	$blog_v_color = $rd_data['rd_content_hl_color'];
}
if($blog_v_alt_color == '' ){
	$blog_v_alt_color = $rd_data['rd_content_hover_color'];
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

 if ($type == 'type2') { 
 $blog_navigation = 'loadmore_nav';
 
 }


$custom_blog_css = '<style>';
//normal blog
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
$custom_blog_css .= '.standard_trend_post_wrapper .post-title h2:after{color:'.$blog_text_color.';}' ;
$custom_blog_css .= '.standard_trend_post_wrapper .post-info,.standard_trend_post_wrapper .post-info a{color:'.$blog_hl_color.';}' ; 
$custom_blog_css .= '.standard_trend_post_wrapper .more{background:'.$blog_hover_color.'; color:#fff;}.standard_trend_post_wrapper .more:hover{background:'.$blog_hl_color.'; color:#fff;}' ; 
$custom_blog_css .= '.standard_trend_post_wrapper .post-info-bottom{border-top:1px solid '.$blog_border_color.'; color:'.$blog_text_color.';}.standard_trend_post_wrapper .post-info-bottom a{color:'.$blog_text_color.';}' ; 

 
 
//masonry grid 
$custom_blog_css .= '.masonry_post_wrapper,.masonry_post_wrapper .post-info a,.masonry_post_wrapper .post-bottom-info a{color:'.$blog_text_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper a{color:'.$blog_hl_color.';}.masonry_post_wrapper a:hover,.masonry_post_wrapper .post-info a:hover,.masonry_post_wrapper .post-bottom-info a:hover{color:'.$blog_hover_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .more-link{color:'.$blog_heading_color.'; border:1px solid '.$blog_heading_color.';}.masonry_post_wrapper .more-link:hover{background:'.$blog_heading_color.'; color:'.$blog_bg_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper{background:'.$blog_bg_color.'; border:1px solid '.$blog_border_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .post-info{border-bottom:1px solid '.$blog_border_color.';}' ;
$custom_blog_css .= '.masonry_post_wrapper .post-bottom-info{border-top:1px solid '.$blog_border_color.';}';
$custom_blog_css .= '.masonry_post_wrapper .flex-direction-nav li a{color:'.$blog_heading_color.'; background:'.$blog_bg_color.';}' ;

$custom_blog_css .= '.post_masonry .more-link,.post_timeline .more{color:'.$blog_bg_color.'; border:1px solid '.$blog_heading_color.'; background:'.$blog_heading_color.'}.post_masonry .more-link:hover{background:'.$blog_hover_color.'; color:'.$blog_bg_color.'; border:1px solid '.$blog_hover_color.';}' ;
$custom_blog_css .= '.grid_blog_post .more{color:'.$blog_heading_color.'; border:1px solid '.$blog_heading_color.'; background:'.$blog_bg_color.'}.grid_blog_post .more:hover{background:'.$blog_heading_color.'; color:'.$blog_bg_color.'; border:1px solid '.$blog_heading_color.';}' ;
$custom_blog_css .= '.post.multi_author_post .more-link{color:'.$blog_heading_color.';  background:none; border:none;}.post.multi_author_post .more-link:hover{color:'.$blog_hover_color.'; background:none; border:none; }' ;
$custom_blog_css .= '.trending_post_wrapper,.standard_trend_post_wrapper{background:'.$blog_bg_color.'; border:1px solid '.$blog_border_color.'}';  
 
//timeline
$custom_blog_css .= 'div.post_timeline:after,div.post_timeline:before{background:'.$blog_bg_color.'; box-shadow: 0 0 0 3px '.$blog_bg_color.'; border:1px solid '.$blog_hl_color.'}';
$custom_blog_css .= '.timeline_ctn .v_line{background: '.$blog_v_color.'; background: -moz-linear-gradient(top, '.$blog_v_color.' 1%, '.$blog_v_alt_color.' 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,'.$blog_v_color.'), color-stop(100%,'.$blog_v_alt_color.')); background: -webkit-linear-gradient(top, '.$blog_v_color.' 1%,'.$blog_v_alt_color.' 100%); background: -o-linear-gradient(top, '.$blog_v_color.' 1%,'.$blog_v_alt_color.' 100%); background: -ms-linear-gradient(top, '.$blog_v_color.' 1%,'.$blog_v_alt_color.' 100%); background: linear-gradient(to bottom, '.$blog_v_color.' 1%,'.$blog_v_alt_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$blog_v_color.'", endColorstr="'.$blog_v_alt_color.'",GradientType=0 );}';
$custom_blog_css .= '.timeline_month{background:'.$blog_timelinedb_color.';}';
$custom_blog_css .= '.post_timeline .arrow_l,.post_timeline .arrow_r{color:'.$blog_heading_color.';}.post_timeline:hover .arrow_l,.post_timeline:hover .arrow_r{color:'.$blog_hover_color.';}';
$custom_blog_css .= '.timeline_pd_l,.timeline_pd_r{background:'.$blog_heading_color.'; color:'.$blog_bg_color.';}.timeline_pd_l:before,.timeline_pd_r:before{border-color:transparent '.$blog_heading_color.' transparent;}';
$custom_blog_css .= '.post-attachement a.blog_img_overlay:before{background:'.$blog_hover_color.';}';
$custom_blog_css .= '.masonry_post_wrapper{box-shadow:0 0px 0px '.$blog_bg_color.', 0 10px 0 -1px '.$blog_bg_color.', 0 0px 0px 0px '.$blog_bg_color.',0 0px 0px '.$blog_bg_color.', 0 10px 0 0px '.$blog_border_color.', 0px 0px 0px 0px '.$blog_bg_color.';}';


//multi author
$custom_blog_css .= '.author_date_ctn .rounded_date_ctn{border-color:'.$blog_bg_color.'; color:'.$blog_bg_color.'; background:'.$blog_heading_color.';}';
$custom_blog_css .= '.multi_author_post:hover .rounded_date_ctn,.author_date_ctn:before{background:'.$blog_hl_color.';}'; 
$custom_blog_css .= '.multi_author_ctn,.multi_author_ctn:after,.author_date_ctn img{background:'.$blog_bg_color.'; border:1px solid '.$blog_border_color.'; }';
 
 

$custom_blog_css .= '</style>';

echo !empty( $custom_blog_css ) ? $custom_blog_css : '';

wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting_bp', get_template_directory_uri() . '/js/sorting_bp.js');
wp_enqueue_script('js_refresh_bp', get_template_directory_uri() . '/js/refresh_bp.js');


global $rd_data;
$items_on_start = $posts_per_page; 
$items_per_click = $blog_click;
$view_type = $type;    
$category = $category;  



	        wp_enqueue_style( 'wp-mediaelement' );
	        wp_enqueue_script( 'wp-playlist' );	
	
	 ?>
<script>



jQuery.noConflict();
var $ = jQuery;

"use strict";

$(document).ready(function(){
<?php 

if($blog_navigation !== 'classic_nav'){ ?>


   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                var html_template = "<?php echo esc_js($view_type); ?>";
                var column = "<?php echo esc_js($column); ?>";
                var cat = "<?php echo esc_js($category); ?>";
                var tn_size = "<?php echo esc_js($tn_size); ?>";
                var now_open_works = 0;
                var first_load = true;

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                function get_blog_posts (this_obj) {

                    if(typeof(this_obj)=="undefined") {data_option_value="*";}
                    else {var data_option_value = this_obj.attr("data-option-value");}

                    if (first_load == true) {

                        works_per_load = <?php echo esc_js($items_on_start); ?>;
                        first_load = false;

                    } else {

                        works_per_load = <?php echo esc_js($items_per_click); ?>;

                    }

                    $.ajax({

                        type: "POST",
                        url: mixajaxurl,
                        data: "html_template="+html_template+"&now_open_works="+now_open_works+"&action=get_blog_posts"+"&works_per_load="+works_per_load+"&column="+column+"&first_load="+first_load+"&category="+cat+"&tn_size="+tn_size+"",
                        success: function(result){

	                            if(result.length<1){
                                $("#rd_<?php echo esc_js($id); ?> .blog_load_more_cont").hide("fast");
	                            }

                            now_open_works = now_open_works + works_per_load;
							first_load = false;
                            var $newItems = $(result);
                            $("#rd_<?php echo esc_js($id); ?>").isotope( 'insert', $newItems, function() {
                            $("#rd_<?php echo esc_js($id); ?>").ready(function(){
                            $("#rd_<?php echo esc_js($id); ?>").isotope('layout');

                            //Blog
                            $('#rd_<?php echo esc_js($id); ?> .isotope-item').each(function(){
                            $(this).css('margin-top', Math.floor(-1*($(this).height()/2))+'px');
                            });
                            });


                               $("#rd_<?php echo esc_js($id); ?>").isotope('layout');
							   
							   $(window).trigger('resize');
							   
							});


$(".wpb_row:empty").remove();
$(".wpb_column:empty").remove();
$(".wpb_wrapper:empty").remove();
$(".post-attachement").fitVids();
$(".entry").fitVids();
$(".video_sc").fitVids();
/* global mejs, _wpmejsSettings */
	// add mime-type aliases to MediaElement plugin support
	mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
	mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

	$(function () {
		var settings = {};

		if ( typeof _wpmejsSettings !== 'undefined' ) {
			settings = _wpmejsSettings;
		}

		settings.success = function (mejs) {
			var autoplay, loop;

			if ( 'flash' === mejs.pluginType ) {
				autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
				loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;

				autoplay && mejs.addEventListener( 'canplay', function () {
					mejs.play();
				}, false );

				loop && mejs.addEventListener( 'ended', function () {
					mejs.play();
				}, false );
			}
		};

		$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer( settings );
	});

$('.wp-audio-shortcode').removeClass('wp-audio-shortcode');
$('.flexslider').flexslider({
animation: "slide",              //String: Select your animation type, "fade" or "slide"
slideDirection: "horizontal",
directionNav: true,
start: function(slider){ // init the height of the first item on start
var $new_height = slider.slides.eq().height();     
slider.height($new_height);                                     
},          

before: function(slider){ // init the height of the next item before slide
var $new_height = slider.slides.eq(slider.animatingTo).height();                
if($new_height != slider.height()){
slider.animate({ height: $new_height  }, 400);

}
}          

});
                            $('a.prettyPhoto').prettyPhoto();
					
							$(".refresh_icn").removeClass("fa-spin");
							$(".refresh_icn").removeClass("fa-refresh");
							$(".refresh_icn").addClass("fa-plus");

                    }   

                    });
					
				}

                $(".get_blog_posts_btn").click(function(){
				$(".refresh_icn").removeClass("fa-plus");
				$(".refresh_icn").addClass("fa-refresh");
                $(".refresh_icn").addClass("fa-spin");
                get_blog_posts();						
					$(".masonry_ctn").isotope('layout');

				return false;

                });


               /* load at start */

                $(window).load(function(){

                get_blog_posts();
				
	
				
				
$('.masonry_ctn').isotope({
  // options
  itemSelector : '.ajax_post',
  layoutMode : 'masonry'
});

<?php }else { ?>

 $(window).load(function(){
<?php } ?>

function watchblog() {

$(".masonry_ctn").isotope({
  // options
  itemSelector : '.ajax_post',
  layoutMode : 'masonry'
});

}

setInterval(watchblog, 100);

});});


</script>
<?php   if ($type == 'type2') { ?>

<div class="timeline_ctn">
<div class="v_line"></div>
<?php } ?>
<div id="rd_<?php echo esc_attr($id); ?>" class="masonry_ctn <?php  if ($type == 'type2') { echo 'blog_timeline';  }elseif($type == 'type4' || $type == 'type6') { echo 'grid_post';  }elseif($type == 'type3') { echo 'blog_masonry';  }elseif($type == 'type7') { echo 'standard_trending';  }if($type == 'type6' || $type == 'type7' ) { echo ' trend_loadmore';  } if($blog_navigation !== 'classic_nav'){ echo ' ajax_blog';  } ?>">
<?php 

if ($blog_navigation == 'classic_nav') { 

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }	
		if ($category!=="all" && $category!=="") {
	query_posts('category_name='.$category.'&posts_per_page='.$posts_per_page.'&paged='.$paged.'&post_status=publish');
		}else{
	query_posts('posts_per_page='.$posts_per_page.'&paged='.$paged.'&post_status=publish');
			 
}	
	
	global $more,$post;
	$more = 0;

 while (have_posts()) : the_post(); global $rd_data;  
 
 
if  ($type == 'type1') { ?>

<div class="post ajax_post" <?php post_class(); ?>>

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
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
		if($tn_size !== '' ){
		echo the_post_thumbnail('full');
		}else{
		echo the_post_thumbnail('blog_tn');			
		}
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
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
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			if($tn_size !== '' ){
			echo wp_get_attachment_image( $id, 'full', 0 );
			}else{
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			}

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

<?php  } }elseif  ($type == 'type7') { ?>

<div class="post ajax_post" <?php post_class(); ?>>
<div class="standard_trend_post_wrapper">
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
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
		if($tn_size !== '' ){
		echo the_post_thumbnail('full');
		}else{
		echo the_post_thumbnail('blog_tn');			
		}
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
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
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			if($tn_size !== '' ){
			echo wp_get_attachment_image( $id, 'full', 0 );
			}else{
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			}

			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></li>";
					}
			echo "</ul></div></div><div class='sep_25'></div>"; 
				}
		}
	}

 
 ?>
  <div class="post_ctn"> 
       <!-- post-info-top -->
    
    <div class="post-info"><?php the_time('j F, Y') ?>    /    <?php the_category(', '); ?>    /    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></div>
   
    
    <!-- post-info END--> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
    </div>
     <!-- .title END--> 
    
    <!-- .entry -->    
    <div class="entry">
<?php  echo rd_custom_excerpt('rd_port_long_excerpt','rd_trend_more'); ?>
    </div>   
    <!-- .entry END --> 
    <div class="post-info-bottom">
    <?php the_author(); if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	} ?>
    </div>
     </div>
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->

<?php  } }elseif($type == 'type5') { ?>

<div class="post ajax_post multi_author_post">
<div class="author_date_ctn">
<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 103 ); }?>
<div class="rounded_date_ctn">
<div class="author_date_d"> <?php echo get_the_time('d'); ?> </div>
<div class="author_date_m"> <?php echo get_the_time('M'); ?> </div>
</div>
</div>

<div class="multi_author_ctn">

  <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);



if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {
	if( $post_format == 'quote'  ){	
		echo '<a class="post_quote_ctn" href="';
		echo the_permalink() ;
		echo '"><div class="post_quote_text" >';
		echo !empty( $quote_text ) ? $quote_text : '';
		echo '<span class="post_quote_icon fa-link"></span></div>';
		echo '<div class="post_quote_author" >';
		echo !empty( $quote_author ) ? $quote_author : '';	
		echo '</div>';
		echo '</a><div class="sep_25"></div>';
	}elseif($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			if($tn_size == 'full' ){
			echo the_post_thumbnail('full');
			}else{
			echo the_post_thumbnail('blog_tn');			
			}
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
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
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";
	}elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
			if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
			foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );	
			echo "<li>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
				if($tn_size == 'full' ){
				echo wp_get_attachment_image( $id, 'full', 0 );
				}else{
				echo wp_get_attachment_image( $id, 'blog_tn', 0 );
				}
			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></li>";
			}
			echo "</ul></div></div><div class='sep_25'></div>"; 
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
    
    <div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>
    
    <!-- post-info END--> 
    
    <!-- .entry -->
    
    <div class="entry">
      <?php 	if ( $post_format == 'audio' ){ echo !empty( $content ) ? $content : '';}else{ the_content(__('Read more', 'thefoxwp')); }?>
    </div>
    
    <!-- .entry END --> 
    
  </div>
  <!-- .post-content END--> 
  </div>
  <!-- .multi_author_ctn END--> 
</div>

<!-- .post END -->

<?php  } }elseif  ( $type == 'type4' ) { ?>

<div class="post ajax_post grid_blog_post <?php  echo esc_attr($column.''); ?> " <?php post_class(); ?>>

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
			echo '</a><div class="sep_25"></div>';
}
	
else{
	
	
		if($post_format !== 'gallery' && $post_format !== 'audio' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
		echo the_post_thumbnail('blog_tn_alt');
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
		}
		elseif( $post_format == 'audio' ){
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		preg_match("!\[audio.+?\]\[\/audio\]!", $content , $match_audio);
		if(!empty($match_audio)) {
			echo "<div class='post-attachement'>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			echo the_post_thumbnail('blog_tn_alt');
			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a>";
			echo '<div class="audio_ctn" >';
			echo do_shortcode($match_audio[0]);
			echo '</div></div>';
			
			$content = str_replace($match_audio[0], "", $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo "<div class='sep_25'></div>";
			}
		}
		elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
				if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
					foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );	
			echo "<li>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			echo wp_get_attachment_image( $id, 'blog_tn_alt', 0 );
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
    <div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></div>
     
    <!-- post-info END-->     
    <!-- .entry -->    
    <div class="entry">
<?php  the_excerpt(); ?>
    </div>   
    <!-- .entry END --> 
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->

<?php   }elseif  ( $type == 'type6' ) { ?>

<div class="post ajax_post grid_trend_blog_post <?php  echo esc_attr($column.''); ?> " <?php post_class(); ?>>
<div class="trending_post_wrapper">
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
			echo '</a><div class="sep_25"></div>';
}
	
else{
	
	
		if($post_format !== 'gallery' && $post_format !== 'audio' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
		echo the_post_thumbnail('blog_tn_alt');
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
		}
		elseif( $post_format == 'audio' ){
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		preg_match("!\[audio.+?\]\[\/audio\]!", $content , $match_audio);
		if(!empty($match_audio)) {
			echo "<div class='post-attachement'>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			echo the_post_thumbnail('blog_tn_alt');
			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a>";
			echo '<div class="audio_ctn" >';
			echo do_shortcode($match_audio[0]);
			echo '</div></div>';
			
			$content = str_replace($match_audio[0], "", $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo "<div class='sep_25'></div>";
			}
		}
		elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
				if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
					foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );	
			echo "<li>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			echo wp_get_attachment_image( $id, 'blog_tn_alt', 0 );
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
    <div class="post-info"><?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>
     
    <!-- post-info END-->     
    <!-- .entry -->    
    <div class="entry">
<?php  echo rd_custom_excerpt('rd_staff3_excerpt','rd_trend_more'); ?>
    </div>   
    <!-- .entry END --> 
     </div>
     
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->

<?php   } elseif($type == 'type3') { ?>
	
<div class="ajax_post post_masonry <?php echo esc_attr($column) ?> ">


 <div class="masonry_post_wrapper">
<?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
		echo the_post_thumbnail('full');
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div><div class='sep_25'></div>";
	}elseif( $post_format == 'quote' ){	
	echo '<a class="post_quote_ctn" href="';
	echo the_permalink() ;
	echo '"><div class="post_quote_text" >';
	echo !empty( $quote_text ) ? $quote_text : '';
	echo '<span class="post_quote_icon fa-link"></span></div>';
	echo '<div class="post_quote_author" >';
	echo !empty( $quote_author ) ? $quote_author : '';	
	echo '</div>';
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
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";}elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
			if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
			foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );	
			echo "<li>";
			echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
			echo wp_get_attachment_image( $id, 'full', 0 );
			echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></li>";
			}
			echo "</ul></div></div><div class='sep_25'></div>"; 
	}
}}
if ( $post_format !== 'quote' ) { ?>
<!-- .title -->
<div class="post-title">
<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
<?php the_title(); ?>
</a></h2>
</div>
<!-- .title END--> 
<!-- post-info-top -->
<div class="post-info"><?php echo __('By','thefoxwp') ?> <?php the_author(); ?>    |    <?php the_time('j F, Y') ?></div>
<!-- post-info END--> 
<!-- .entry -->
<div class="entry">
      <?php 	if ( $post_format == 'audio' ){ echo !empty( $content ) ? $content : '';}else{ the_content(__('Read more', 'thefoxwp')); }?>
</div> <?php } ?>
<div class="post-bottom-info"><span class="info_comment"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    </span><span class="info_like"><?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	} ?></span></div>
</div>
</div>
<!-- .post-content END--> 
<!-- .post END -->	
	<?php
	
 } endwhile; if($blog_navigation == 'classic_nav'){ ?>

<!-- .navigation -->
</div>
<div class="navigation clearfix">
  <?php kriesi_pagination(); ?>
</div>

<!-- .navigation END -->

<?php }}
if($type == 'type2'){echo '</div>'; }if ($blog_navigation !== 'classic_nav' && $type !== 'type5') {echo '<div class="blog_load_more_cont"><a class="btn_load_more get_blog_posts_btn" href="#"><span class="fa-plus refresh_icn"></span>'.__('Load More','thefoxwp').'</a></div></div><div class="clear"><!-- ClearFix --></div>'; }elseif($blog_navigation !== 'classic_nav'){echo '<div class="blog_load_more_cont multi_author_load"><a class="btn_load_more get_blog_posts_btn" href="#"><span class="fa-plus refresh_icn"></span></a></div></div><div class="clear"><!-- ClearFix --></div>';}
  wp_reset_postdata();

$output_string = ob_get_contents();
ob_end_clean();

return $output_string; } 
       
        add_shortcode('blog_sc', 'blog_sc');




?>