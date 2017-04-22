<?php

/*

Template Name: Search

*/

get_header();
$allsearch = new WP_Query("s=$s&posts_per_page=-1");
$key = esc_html($s, 1);
$count = $allsearch->post_count;
global $rd_data;
$home = __('Home', 'thefoxwp'); // text for the 'Home' link

$blog_bg_color = $blog_border_color = $blog_heading_color = $blog_hl_color = $blog_hover_color = $blog_text_color = $blog_timelinedb_color = $button_bg = $button_border = $button_hover_bg = $button_hover_title = $button_title = $nav_bg = $nav_border = $nav_color = $nav_hover_bg = $nav_hover_color = '';

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

echo !empty( $custom_blog_css  ) ? $custom_blog_css  : '';


wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting_bp', get_template_directory_uri() . '/js/sorting_bp.js');
wp_enqueue_script('js_refresh_bp', get_template_directory_uri() . '/js/refresh_bp.js');

?>

<div class="page_title_ctn">
  <div class="wrapper table_wrapper">
    <h1><?php echo __('Search Results','thefoxwp'); ?></h1>
    <div id="breadcrumbs">
      <div id="crumbs"><a href="<?php echo home_url(''); ?>"><?php echo esc_html($home); ?></a><i class="fa-angle-right crumbs_delimiter"></i><span><?php echo __('Search results for ','thefoxwp').'"'.$key.'"'; ?></span></div>
    </div>
  </div>
</div>
<div class="section def_section">
  <div class="wrapper section_wrapper">
    <div id="posts"  class="<?php  echo 'left_posts"'; ?> ">
     <div class="search_results">
     <h1><?php echo esc_html($count).' '.__('results for','thefoxwp').' "<strong>'.$key.'</strong>"'; ?></h1>
     <p><?php echo __('If you didn\'t find what you were looking for, try again!','thefoxwp'); ?></p>
     <div class="search_sf"><?php echo do_shortcode('[rd_search t_color="'.$rd_data['rd_content_text_color'].'" bg_color="'.$rd_data['rd_content_bg_color'].'" b_color="'.$rd_data['rd_content_border_color'].'" placeholder="'.__('Search','thefoxwp').'" width="100%" radius="2" margin_top="25" margin_bottom="33"]'); ?></div>
     </div>
      <div class="masonry_ctn blog_masonry search_masonry">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="ajax_post post_masonry blog_3_col">
          <div class="masonry_post_wrapper">
			<?php if( get_post_type($post->ID) == 'post' ){  if('' != get_the_post_thumbnail() ) { ?>
            <div class="post-attachement">
            <?php 
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo get_the_post_thumbnail(get_the_id(), "blog_tn");
			echo '</a>';
			?>
            </div>
            <div class="sep_25"></div>
			<?php } ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Blog Post', 'thefoxwp'); ?></span></div>
          
		  <?php }
							
			elseif( get_post_type($post->ID) == 'page' ){ ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Page', 'thefoxwp'); ?></span></div>
          <?php }
							
			elseif( get_post_type($post->ID) == 'portfolio' ){ if('' != get_the_post_thumbnail() ) { ?>
            <div class="post-attachement">
            <?php 
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo get_the_post_thumbnail(get_the_id(), "blog_tn");
			echo '</a>';
			?>
            </div>
            <div class="sep_25"></div>
			<?php } ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Portfolio Item', 'thefoxwp'); ?></span></div>
            <?php }
							
			else if( get_post_type($post->ID) == 'product' ){  if('' != get_the_post_thumbnail() ) { ?>
            <div class="post-attachement">
            <?php 
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo get_the_post_thumbnail(get_the_id(), "blog_tn");
			echo '</a>';
			?>
            </div>
            <div class="sep_25"></div>
			<?php } ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Product', 'thefoxwp'); ?></span></div>
			<?php }
			
			else if( get_post_type($post->ID) == 'staff' ){  if('' != get_the_post_thumbnail() ) { ?>
            <div class="post-attachement">
            <?php 
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo get_the_post_thumbnail(get_the_id(), "blog_tn");
			echo '</a>';
			?>
            </div>
            <div class="sep_25"></div>
			<?php } ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Staff', 'thefoxwp'); ?></span></div>
			<?php }else { ?>
            <!-- .title -->
            <div class="post-title">
              <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <!-- .title END-->
            <div class="post-bottom-info"><span><?php echo __('Result', 'thefoxwp'); ?></span></div>
			<?php } ?>
            
          </div>
        </div>
        <?php endwhile; ?>
      </div>
      
      <!-- .navigation -->
      <div class="navigation clearfix">
        <?php kriesi_pagination(); ?>
      </div>
      
      <!-- .navigation END --> 
    </div>
    
    <!-- #posts END -->
    
    <div id="sidebar" class="right_sb" >
      <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); } ?>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<?php else : ?>

</div>
</div>
    <div id="sidebar" class="right_sb" >
      <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); } ?>
    </div>
    <div class="clearfix"></div>

</div>

<!-- #page_content END -->

<?php endif; ?>
<?php get_footer(); ?>
