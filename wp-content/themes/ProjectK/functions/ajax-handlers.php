<?php

add_action('wp_ajax_get_unused_id_ajax', 'get_unused_id_ajax');
if (!function_exists('get_unused_id_ajax')) {
    function get_unused_id_ajax()
    {
        $lastid = get_theme_option("last_slide_id");
        if ($lastid < 3) {
            $lastid = 2;
        }
        $lastid++;

        echo esc_html($lastid);

        update_theme_option("last_slide_id", $lastid);

        die();
    }
}


#Get media for postid
add_action('wp_ajax_get_media_for_postid', 'get_media_for_postid');
if (!function_exists('get_media_for_postid')) {
    function get_media_for_postid()
    {
        $postid = $_POST['post_id'];
        $page = $_POST['page'];
        $media_for_this_post = get_media_for_this_post($postid, $page);
        if (is_array($media_for_this_post) && count($media_for_this_post)>0) {
            echo get_media_html($media_for_this_post, "small");
        } else {
            echo "no_items";
        }

        die();
    }
}



#Load portfolio works

add_action('wp_ajax_get_portfolio_works', 'get_portfolio_works');
add_action('wp_ajax_nopriv_get_portfolio_works', 'get_portfolio_works');

if (!function_exists('get_portfolio_works')) {
    function get_portfolio_works()
    {
        $html_template = $_POST['html_template'];
        $now_open_works = $_POST['now_open_works'];
        $works_per_load = $_POST['works_per_load'];		
        $thumbnail = $_POST['thumbnail'];
        $category = ($_POST['category']!=="all" ? $_POST['category'] : '');
        $tags = ($_POST['tags']!=="all" ? $_POST['tags'] : '');
		global $post;
        $temp = (isset($wp_query) ? $wp_query : '');
        $wp_query = null;
        $wp_query = new WP_Query();
        $args = array(
            'post_type' => 'portfolio',
        	'post_status' => 'publish',
            'order' => 'DESC',
            'offset' => $now_open_works,
            'posts_per_page' => $works_per_load,
        );

        if ($category !== '' && $category !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'catportfolio',
                    'field' => 'slug',
                    'terms' => $category
                )
            );
        }

        if ($tags !== '' && $tags !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'tagportfolio',
                    'field' => 'slug',
                    'terms' => $tags
                )
            );
        }

        if ($category !== '' && $category !== "all" && $tags !== '' && $tags !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'catportfolio',
                    'field' => 'slug',
                    'terms' => $category
                ),
				array(
                    'taxonomy' => 'tagportfolio',
                    'field' => 'slug',
                    'terms' => $tags
                )
            );
        }

        $wp_query->query($args);
        $i = 1;
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $pf = get_post_format();
			$project_url = get_post_meta($post->ID, 'rd_p_url', true);
			$project_thumb = get_post_meta($post->ID, 'rd_thumb', true);
            $linkToTheWork = get_permalink();
            $target = "";

	if (!isset($echoallterm)) {$echoallterm = ''; $showterm ='';}
		$new_term_list = get_the_terms(get_the_id(), "tagportfolio");
		if (is_array($new_term_list)) {
			foreach ($new_term_list as $term) {
                    $tempname = strtr($term->name, array(
                    ' ' => '-',
                    ));
                    $echoallterm .= strtolower($tempname) . " ";
                    $echoterm = $term->name;
		}
		foreach ($new_term_list as $term) {
                    $showterm .= strtolower($term->name) . " ";
    	}
	}


          
//Generating new items
if($thumbnail == 'thumbnail_type_5' || $thumbnail == 'thumbnail_type_6' ){
	echo '<div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element rd_'.$project_thumb.'">';
}else{
	echo '<div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element">';
}
	if ($html_template == "port_type_6") {
		echo '
		<div class="port_item_details"><a href="' . get_permalink( $post->ID ) . '"><h2>' . get_the_title() . '</h2></a><h3>'.$showterm.'</h3>
		<div class="item_details_info"><div class="item_details_date">' . get_the_date() . '</div>';
		if( function_exists('zilla_likes') ){
			echo do_shortcode('[zilla_likes]');
			
		}
		echo '</div></div><div class="portfolio_sub_info"><div class="isotope_portfolio_name">' . get_the_title() . '</div><div class="isotope_portfolio_date">' . get_the_date('Y-m-d') . '</div></div>';
	}
	echo '
		<div class="filter_img">
		<div class="port_thumb_ctn">
		<div class="port_overlay"></div>
        <a '.$target.' href="' . $linkToTheWork . '" class="ico_link">';
					 
//Set thumbnail depending on portfolio design					 
	if( $html_template == 'port_type_7' || $html_template == 'port_type_8' || $html_template == 'port_type_9'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_classic"); }
	elseif($thumbnail == 'thumbnail_type_1'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_tn");
}elseif($thumbnail == 'thumbnail_type_2'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_squared");
}elseif($thumbnail == 'thumbnail_type_3'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_landscape");
}elseif($thumbnail == 'thumbnail_type_4'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_portrait");
}elseif($thumbnail == 'thumbnail_type_5'){
	if($project_thumb == 'portfolio_small_squared' || $project_thumb == 'portfolio_squared'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_squared');
	}if($project_thumb == 'portfolio_portrait'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_portrait');
	}if($project_thumb == 'portfolio_landscape'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_landscape');
	}
}elseif($thumbnail == 'thumbnail_type_6'){
	if($project_thumb == 'portfolio_small_squared' || $project_thumb == 'portfolio_squared'){
		echo get_the_post_thumbnail(get_the_id(), array(960, 600));
	}if($project_thumb == 'portfolio_portrait'){
		echo get_the_post_thumbnail(get_the_id(), array (480, 600));
	}if($project_thumb == 'portfolio_landscape'){
		echo get_the_post_thumbnail(get_the_id(), array(960, 300));
	}
}elseif($thumbnail == 'thumbnail_type_7'){
	echo get_the_post_thumbnail(get_the_id(), 'full');
}
	echo   '
		</a><figcaption><div>
		<h2>' . get_the_title() . '</h2>
		<p>'.$showterm.'</p>
		</div>
		<a href="' . $linkToTheWork . '">View more</a>
		</figcaption>';
				


	if ('' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
	echo '<a href="'.$url. '" class="prettyPhoto port_img_link">';
    echo "<span class='img_link'>";
    echo '';
	echo "</span></a><a href='" . get_permalink( $post->ID ) . "' class='port_post_link'>";
    echo "<span class='post_link'><h2 class='fw_port_link'>" . get_the_title() . "</h2><h3 class='fw_port_tag'>".$showterm."</h3>";
    echo '';
	echo "</span></a>";
	echo ""; 
	
	}

	echo
        '<div class="portfolio_desc">
		<h2><a href="' . $linkToTheWork . '">' . get_the_title() . '</a></h2>
		<h3>'.$showterm.'</h3>
        </div>
		</div><!-- port_thumb_ctn END -->
		</div><!-- Filter img END -->';
	
	if ($html_template == "port_type_5" || $html_template == "port_type_7" || $html_template == "port_type_8" || $html_template == "port_type_9"   ) {
		echo '
		<div class="port_item_details"><a href="' . get_permalink( $post->ID ) . '"><h2>' . get_the_title() . '</h2></a><h3>'.$showterm.'</h3>
		<div class="item_details_info"><div class="item_details_date">' . get_the_date() . '</div>';
		if( function_exists('zilla_likes') ){
			echo do_shortcode('[zilla_likes]');
			
		}
		echo '</div><div class="port_small_excerpt">';
	if ( $html_template == "port_type_7" || $html_template == "port_type_8" ) {
		echo rd_custom_excerpt('rd_port_excerpt','rd_port_more');
	}
	if ( $html_template == "port_type_9" ) {
		echo rd_custom_excerpt('rd_port_long_excerpt','rd_port_more');
	}	
		echo '<div class="port_project_buttons">'; if($project_url !== '' ){ echo'<a href="'.$project_url.'" target="_blank" class="view-portfolio-pp">' . __('Launch Project', 'thefoxwp') . '</a>'; }
		echo '<a class="view-portfolio-item" href="' . get_permalink($post->ID) . '">' . __('View More', 'thefoxwp') . '</a></div></div>
		</div>';
	}

	echo'<div class="portfolio_sub_info"><div class="isotope_portfolio_name">' . get_the_title() . '</div><div class="isotope_portfolio_date">' . get_the_date('Y-m-d') . '</div></div></div><!-- element END -->';


#END Portfolio 



	$i++;
	unset($echoallterm, $pf);
	endwhile;
	die();

    }

}


#Load blog posts

add_action('wp_ajax_get_blog_posts', 'get_blog_posts');

add_action('wp_ajax_nopriv_get_blog_posts', 'get_blog_posts');

if (!function_exists('get_blog_posts')) {

    function get_blog_posts()

    {



        $html_template = $_POST['html_template'];

        $column = $_POST['column'];
		
        $tn_size = $_POST['tn_size'];

        $now_open_works = $_POST['now_open_works'];

        $works_per_load = $_POST['works_per_load'];
				
        $first_load = $_POST['first_load'];
		
        $category = ($_POST['category']!=="all" ? $_POST['category'] : '');

if( $now_open_works == 0 ){

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
		if ($category!=="all" && $category!=="") {
	query_posts('category_name='.$category.'&posts_per_page=1');
		}else{
	query_posts('posts_per_page=1');
			 
		}	
	
	global $more,$post;
	$more = 0;

 while (have_posts()) : the_post();


$archive_month = get_the_time('M');
$archive_year = get_the_time('Y');  
$current_month = $archive_month.' '.$archive_year;

endwhile;


}else {
	
$last_post = $now_open_works-1;

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
		if ($category!=="all" && $category!=="") {
	query_posts('offset='.$last_post.'&category_name='.$category.'&posts_per_page=1');
		}else{
	query_posts('offset='.$last_post.'&posts_per_page=1');
			 
		}	
	
	global $more,$post;
	$more = 0;

 while (have_posts()) : the_post();


$archive_month = get_the_time('M');
$archive_year = get_the_time('Y');  
$current_month = $archive_month.' '.$archive_year;

endwhile;
	
	
}
		
global $post;
global $rd_data;
$temp = (isset($wp_query) ? $wp_query : '');
$wp_query = null;
$wp_query = new WP_Query();
$args = array(
		'post_type' => 'post',
		'order' => 'DESC',
		'offset' => $now_open_works,
		'posts_per_page' => $works_per_load,
        'post_status' => 'publish',
       );
if ($category !== '' && $category !== "all") {
            $args['category_name']= $category;
    }	   
$wp_query->query($args);
$i = 1;
$last_month = '';
while ($wp_query->have_posts()) : $wp_query->the_post();
$pf = get_post_format();
$archive_month = get_the_time('M');
$archive_year = get_the_time('Y');  
$current_post_month = $archive_month.' '.$archive_year;
$linkToTheWork = get_permalink();
$target = "";








			#START Recent posts Type 01


if ($html_template == "type01") { ?>

<div class=" rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

echo "<div class='post-attachement'>";
echo the_post_thumbnail(array(340,400));

if($post_format == '' ) {
		
	echo "<div class='rp_normal'></div>";	
		
	}elseif( $post_format == 'gallery' ){	
echo "<div class='rp_gallery'></div>";
	
	}elseif( $post_format == 'image' ){	
echo "<div class='rp_image'></div>";
	}elseif( $post_format == 'quote' ){	
echo "<div class='rp_quote'></div>";	
	}elseif( $post_format == 'audio' ){
echo "<div class='rp_audio'></div>";	
	}elseif ($post_format == 'video'){
echo "<div class='rp_video'></div>";	
	}
			echo "</div>"; 



 
 ?>
  </a>
  <div class="post_ctn"> 
    <!-- title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- title END--> 
    
    <!-- post-info-top -->
    
    <div class="rp_post_info">
      <div class="rp_post_time">
        <?php the_time('j F Y') ?>
      </div>
      <div class="rp_post_comment">
        <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>
      </div>
      <div class="rp_post_cat">
        <?php the_category(','); ?>
      </div>
    </div>
    
    <!-- post-info END--> 
    
  </div>
  <!-- post-content END--> 
</div>
<!-- post END -->

<?php 


			}

            #END Recent posts Type 01


			#START Recent posts Type 02
            if ($html_template == "type02") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail(array(340, 306));

 ?>
 
  <div class="rp_post_time">
    <?php echo get_the_time('d M'); ?>
  </div>
  </a></div>
  
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_staff2_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    
    <!-- post-info -->
    <div class="rp_post_info"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>  /  <?php the_category(','); ?>  /  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo __('Read More', 'thefoxwp'); ?></a></div>

    <!-- post-info END--> 
  </div>
  <!-- post-content END--> 

<!-- post END -->

<?php 


			}

            #END Recent posts Type 02



			#START Recent posts Type 03
            if ($html_template == "type03") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail('staff_tn');

 ?>
 
   <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if($post_format == '' ) {
		
	echo "<div class='rp_normal'></div>";	
		
	}elseif( $post_format == 'gallery' ){	
echo "<div class='rp_gallery'></div>";
	
	}elseif( $post_format == 'image' ){	
echo "<div class='rp_image'></div>";
	}elseif( $post_format == 'quote' ){	
echo "<div class='rp_quote'></div>";	
	}elseif( $post_format == 'audio' ){
echo "<div class='rp_audio'></div>";	
	}elseif ($post_format == 'video'){
echo "<div class='rp_video'></div>";	
	} 



 
 ?>
  <div class="rp_post_time">
    <span class="rp_day"><?php echo get_the_time('d'); ?></span>
    <span class="rp_month"><?php echo get_the_time('M'); ?></span>
  </div>
  </a></div>    
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_staff2_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    

  </div>
  <!-- post-content END-->
      <!-- post-info -->
    <div class="rp_post_info"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>  /  <?php the_category(','); ?>  /  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo __('Read More', 'thefoxwp'); ?></a></div>
    <!-- post-info END-->  

<!-- post END -->

<?php 


			}

            #END Recent posts Type 03



			#START Recent posts Type 04


if ($html_template == "type04") { ?>

<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

echo "<div class='post-attachement'>";
echo the_post_thumbnail('staff_tn');

if($post_format == '' ) {
		
	echo "<div class='rp_normal'></div>";	
		
	}elseif( $post_format == 'gallery' ){	
echo "<div class='rp_gallery'></div>";
	
	}elseif( $post_format == 'image' ){	
echo "<div class='rp_image'></div>";
	}elseif( $post_format == 'quote' ){	
echo "<div class='rp_quote'></div>";	
	}elseif( $post_format == 'audio' ){
echo "<div class='rp_audio'></div>";	
	}elseif ($post_format == 'video'){
echo "<div class='rp_video'></div>";	
	}
			echo "</div>"; 



 
 ?>
  </a>
  <div class="post_ctn"> 
    <!-- title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- title END--> 
    
    <!-- post-info-top -->
    
    <div class="rp_post_info"><?php the_time('j F Y') ?>   |   <?php the_category(','); ?>   |   <?php the_author(); ?></div>

    </div>
    <!-- post-info END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_related_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END -->  
 
  </div>
   <!-- post-content END--> 

<!-- post END -->

<?php 


			}

            #END Recent posts Type 04




			#START Recent posts Type 05
            if ($html_template == "type05") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail('staff_tn');

 ?>
 
   <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if($post_format == '' ) {
		
	echo "<div class='rp_normal'></div>";	
		
	}elseif( $post_format == 'gallery' ){	
echo "<div class='rp_gallery'></div>";
	
	}elseif( $post_format == 'image' ){	
echo "<div class='rp_image'></div>";
	}elseif( $post_format == 'quote' ){	
echo "<div class='rp_quote'></div>";	
	}elseif( $post_format == 'audio' ){
echo "<div class='rp_audio'></div>";	
	}elseif ($post_format == 'video'){
echo "<div class='rp_video'></div>";	
	} 



 
 ?>
  </a></div>    
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_rp_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    

  </div>
  <!-- post-content END-->
      <!-- post-info -->
    <div class="rp_post_info">
      <div class="rp_post_cat"><?php the_category(','); ?></div>
      <div class="rp_post_author"><?php the_author(); ?></div>
      <div class="rp_post_time"><?php the_time('j F Y') ?></div>
    </div>
    <!-- post-info END-->  

<!-- post END -->

<?php 


			}

            #END Recent posts Type 05



			#START Recent posts Type 06
            if ($html_template == "type06") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail('staff_tn');

 ?>
</a></div>
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 

<!-- post-info -->
    <div class="rp_post_info">
      <div class="rp_post_time"><?php the_time('j F Y') ?></div>
    </div>
<!-- post-info END-->  
    

  </div>
  <!-- post-content END-->
    
<!-- post END -->

<?php 


			}

            #END Recent posts Type 06



			#START Recent posts Type 07
            if ($html_template == "type07") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail('staff_tn');

 ?>
  <div class="rp_post_time">
    <span class="rp_day"><?php echo get_the_time('d'); ?></span>
    <span class="rp_month"><?php echo get_the_time('M'); ?></span>
  </div>
  </a></div>    
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_staff2_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    

      <!-- post-info -->
    <div class="rp_post_info"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></div>
    <!-- post-info END-->  

  </div>
  <!-- post-content END-->

<!-- post END -->

<?php 


			}

            #END Recent posts Type 07


			#START Recent posts Type 08
            if ($html_template == "type08") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail('portfolio_squared');

 ?>
 
  <div class="rp_post_time">
    <span class="rp_day"><?php echo get_the_time('d'); ?></span>
    <span class="rp_month"><?php echo get_the_time('M'); ?></span>
  </div>
  </a></div>    
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 

  </div>
  <!-- post-content END-->
  
 <!-- post-info -->
    <div class="rp_post_info"><span class="rp_post_comment"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></span><span class="rp_post_more"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo __('Read More', 'thefoxwp'); ?></a></span>
    </div>
    <!-- post-info END-->  


<!-- post END -->

<?php 


			}

            #END Recent posts Type 08


			#START Recent posts Type 09
            if ($html_template == "type09") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> "><div class='post-attachement'>

  <?php
echo the_post_thumbnail(array(740, 690));

 ?>
 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
 <div class="rp_arrow">
 </div>
 
  </a>
 <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <div class="rp_post_info"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>  /  <?php the_category(','); ?>  /  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo __('Read More', 'thefoxwp'); ?></a></div>
  <!-- .title END--> 
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_staff2_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    
    <!-- post-info -->
   
    <!-- post-info END--> 
  </div>
  <!-- post-content END--> 
 
 
  </div>
 
</div>
<!-- post END -->

<?php 


			}

            #END Recent posts Type 09




			#START Recent posts Type 10
            if ($html_template == "type10") { ?>
<div class="rp_<?php echo esc_attr($html_template) ?> ajax_post <?php echo esc_attr($column) ?> ">
<div class="rp_left_info">

 <?php
 
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if($post_format == '' ) {
		
	echo "<div class='rp_normal'></div>";	
		
	}elseif( $post_format == 'gallery' ){	
echo "<div class='rp_gallery'></div>";
	
	}elseif( $post_format == 'image' ){	
echo "<div class='rp_image'></div>";
	}elseif( $post_format == 'quote' ){	
echo "<div class='rp_quote'></div>";	
	}elseif( $post_format == 'audio' ){
echo "<div class='rp_audio'></div>";	
	}elseif ($post_format == 'video'){
echo "<div class='rp_video'></div>";	
	} 



 
 ?><div class="rp_avatar">
  
<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 80 ); }?>
</div>
<div class="rp_like"><?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>

  <div class="rp_post_time">
    <span class="rp_day"><?php echo get_the_time('d'); ?></span>
    <span class="rp_month"><?php echo get_the_time('M'); ?></span>
  </div>
 </div>




<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
  <?php
echo "<div class='post-attachement'>";
echo the_post_thumbnail(array(520, 388));

 ?>
  </a></div>
  <div class="post_ctn"> 
    <!-- .title -->
    <div class="post-title">
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a>
      </h2>
    </div>
    <!-- .title END--> 


      <!-- post-info -->
    <div class="rp_post_info"><?php the_category(','); ?></div>
    <!-- post-info END-->  
    
    <!-- .entry --> 
    <div class="rp_entry">
	<?php	echo rd_custom_excerpt('rd_staff2_excerpt','rd_port_more'); ?>
    </div>
    <!-- .entry END --> 
    


  </div>
  <!-- post-content END-->

<!-- post END -->

<?php 


			}

            #END Recent posts Type 10



 #Normal

            if ($html_template == "type1") { ?>
<div class="post ajax_post">
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
			echo '</a>';
}

else{

	if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
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
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";}elseif($post_format == 'gallery' ){
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
}}

 
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
    
    <div class="post-info">By <?php the_author(); ?>    |    <?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php the_time('j F, Y') ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>
    
    <!-- post-info END--> 
    
    <!-- .entry -->
    
    <div class="entry">
      <?php 	if ( $post_format == 'audio' ){ echo !empty( $content ) ? $content : '';}else{ the_content(__('Read more', 'thefoxwp')); }?>
    </div>
    
    <!-- .entry END --> 
    
  </div>
  <!-- .post-content END--> 
</div>

<!-- .post END -->

<?php 
	}

			}

            #END Normal Blog

			#Standard trending

            if ($html_template == "type7") { ?>
<div class="post ajax_post">
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
			echo '</a>';
}

else{

	if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '" class="blog_img_overlay">';
	if($tn_size == 'full' ){
		echo the_post_thumbnail('full');
		}else{
		echo the_post_thumbnail('blog_tn');			
		}
		echo "</a><a href='".$url. "' class='prettyPhoto post-att-zoom'><i class='fa fa-expand'></i></a></div>";
	}elseif( $post_format == 'audio' ){
		preg_match("!\[audio.+?\]\[\/audio\]!", $content , $match_audio);
		if(!empty($match_audio)) {
			echo '<div class="audio_ctn" >';
			echo do_shortcode($match_audio[0]);
			echo '</div>';
			$content = str_replace($match_audio[0], "", $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo "";
		}
	}elseif ($post_format == 'video' && $my_video !== ''){
		echo "<div class='post-attachement'>".$my_video."</div>";}elseif($post_format == 'gallery' ){
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
			echo "</ul></div></div>"; 
	}
}}

 
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

<?php 
	}

			}

            #END Standard trending




 #Multi Author

            if ($html_template == "type5") { ?>
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

if( $post_format == 'quote' ){	
	echo '<a class="post_quote_ctn" href="';
	echo the_permalink() ;
	echo '"><div class="post_quote_text" >';
	echo !empty( $quote_text ) ? $quote_text : '';
	echo '<span class="post_quote_icon fa-link"></span></div>';
	echo '<div class="post_quote_author" >';
	echo !empty( $quote_author ) ? $quote_author : '';
	echo '</div>';
			echo '</a>';
}

else{

	if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
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
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";}elseif($post_format == 'gallery' ){
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
}}

 
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
    
    <div class="post-info">By <?php the_author(); ?>    |    <?php the_category(', '); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>
    
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

<?php 
	}

			}

            #END Multi Author Blog


			 #Grid

            if ($html_template == "type4") { ?>
<div class="post ajax_post grid_blog_post  <?php echo esc_attr($column) ?> ">
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
		echo '<a href="' . get_permalink( $post->ID ) . '">';
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
    <div class="post-info">By <?php the_author(); ?>    |    <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?></div>
    <!-- post-info END--> 
    <!-- .entry -->
    <div class="entry">
<?php  the_excerpt(); ?>
    </div>
    
    <!-- .entry END --> 
    
  </div>
  
  <!-- .post-content END--> 
</div>

<!-- .post END -->

<?php 


			}

            #END Grid Blog
			
			#Grid Trending

            if ($html_template == "type6") { ?>
<div class="post ajax_post grid_trend_blog_post  <?php echo esc_attr($column) ?> ">
<div class="trending_post_wrapper">
  <?php
$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);

	
	
		if($post_format !== 'gallery' && $post_format !== 'audio' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo "<div class='post-attachement'>";
		echo '<a href="' . get_permalink( $post->ID ) . '">';
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
    <div class="post-info"><?php the_category(', '); ?>  |  <?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>  |  <?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></div>
     
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

<?php 


			}

            #END Grid Blog



            #TimeLine

            if ($html_template == "type2") { ?>
<div class="ajax_post post_masonry post_timeline ">
  <?php if($now_open_works == 0){ echo '<div class="timeline_month month_left">'.$current_post_month.'</div><div class="timeline_month month_right">'.$current_post_month.'</div>';}elseif($last_month == '' && $current_month !== $current_post_month ){ echo '<div class="timeline_month month_left">'.$current_post_month.'</div><div class="timeline_month month_right">'.$current_post_month.'</div>';}elseif($current_post_month !== $last_month && $last_month !== ''){ echo '<div class="timeline_month month_left">'.$current_post_month.'</div><div class="timeline_month month_right">'.$current_post_month.'</div>'; } 
$post_date = get_the_time('d M'); 

?>
  <div class="arrow_l"></div>
  <div class="arrow_r"></div>
  <div class="timeline_pd_l"><?php echo !empty( $post_date ) ? $post_date : ''; ?></div>
  <div class="timeline_pd_r"><?php echo !empty( $post_date ) ? $post_date : ''; ?></div>
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
		if($tn_size == 'full' ){
		echo the_post_thumbnail('full');
		}else{
		echo the_post_thumbnail('blog_tn');			
		}
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
						if($tn_size == 'full' ){
			echo wp_get_attachment_image( $id, 'full', 0 );
			}else{
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			}
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
    
    <div class="post-info">By <?php the_author(); ?>    |    <?php the_category(',');  ?></div>
    
    <!-- post-info END--> 
    
    <!-- .entry -->
    
    <div class="entry">
      <?php 	 the_excerpt();  ?>
    </div>
    <?php } ?>
    <div class="post-bottom-info"><span class="info_comment"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    </span><span class="info_time"><?php the_time('j F Y') ?>    |    </span><span class="info_like"><?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></span></div>
  </div>
  
  <!-- .post-content END--> 
  
</div>

<!-- .post END -->

<?php 
				



            }

            #END TimeLine





            #Masonry

            if ($html_template == "type3") {


?>
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
    
    <div class="post-info">By <?php the_author(); ?>    |    <?php the_time('j F Y') ?></div>  
    <!-- post-info END--> 
    
    <!-- .entry -->
    
    <div class="entry">
      <?php 	if ( $post_format == 'audio' ){ echo !empty( $content ) ? $content : '';}else{ the_content(__('Read more', 'thefoxwp')); }?>
    </div>
    <?php } ?>
    <div class="post-bottom-info"><span class="info_comment"><?php comments_popup_link(__('0 comment','thefoxwp'),__('1  comment','thefoxwp'),__('% comments','thefoxwp'),'comments-link',__('Comments are Closed','thefoxwp')); ?>    |    </span><span class="info_like"><?php if( function_exists('zilla_likes') ){ echo do_shortcode('[zilla_likes]');	}?></span></div></div>
  
  <!-- .post-content END--> 
  
</div>

<!-- .post END -->

<?php 
				



            }

            #END Masonry
$now_open_works = 1;
$last_month = $current_post_month;

            $i++;

            unset($echoallterm, $pf);

        endwhile;



        die();

    }

}





add_action('wp_ajax_get_staff_posts', 'get_staff_posts');
add_action('wp_ajax_nopriv_get_staff_posts', 'get_staff_posts');

if (!function_exists('get_staff_posts')) {
    function get_staff_posts()
    {
        $html_template = $_POST['html_template'];
        $now_open_works = $_POST['now_open_works'];
        $works_per_load = $_POST['works_per_load'];
        $l_target = $_POST['l_target'];
        $group = $_POST['group'];
		global $post;
        $temp = (isset($wp_query) ? $wp_query : '');
        $wp_query = null;
        $wp_query = new WP_Query();
        $args = array(
            'post_type' => 'Staff',
            'order' => 'DESC',
            'offset' => $now_open_works,
            'posts_per_page' => $works_per_load,
	        'post_status' => 'publish',
        );

 if ($group !== '' && $group !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'staffgroups',
                    'field' => 'slug',
                    'terms' => $group
                )
            );
        }


        $wp_query->query($args);
        $i = 1;
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $linkToTheWork = get_permalink();
			
$position = get_post_meta($post->ID, 'rd_position', true);
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
$desc = get_post_meta($post->ID, 'rd_small_desc', true); 

if (!isset($echoallterm)) {$echoallterm = '';}
		$new_term_list = get_the_terms(get_the_id(), "staffposition");
		if (is_array($new_term_list)) {
			foreach ($new_term_list as $term) {
                    $tempname = strtr($term->name, array(
                    ' ' => '-',
                    ));
                    $echoallterm .= "sf_".strtolower($tempname) . " ";
                    $echoterm = $term->name;
		}
	}




          
            if ($html_template == "type01") { $icon = 0; ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p01 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
        
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
 
  <div class="member-social-links">

        <?php if ($facebook!== '' && $icon < 4) { $icon++; ?>
		<div id="facebook"><a  target="_blank" href="http://www.facebook.com/<?php echo esc_attr($facebook); ?>"  ><i class="fa fa-facebook"></i></a></div>
        <?php } ?>
        <?php if ($twitter!== '' && $icon < 4) { $icon++; ?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '' && $icon < 4) { $icon++; ?>
<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '' && $icon < 4) { $icon++; ?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '' && $icon < 4) { $icon++; ?>
<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '' && $icon < 4) { $icon++; ?>
<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '' && $icon < 4) { $icon++; ?>
<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '' && $icon < 4) { $icon++; ?>
<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '' && $icon < 4) { $icon++; ?>
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble);  ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '' && $icon < 4) { $icon++; ?>
<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '' && $icon < 4) { $icon++; ?>
<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '' && $icon < 4) { $icon++; ?>
<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '' && $icon < 4) { $icon++; ?>
<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '' && $icon < 4) { $icon++; ?>
 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '' && $icon < 4) { $icon++; ?>
<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '' && $icon < 4) { $icon++; ?>
<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '' && $icon < 4) { $icon++; ?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    </div>
 
  </div>
    
    <div class="member_desc"><?php $small_desc = substr($desc,0,200); $small_desc .= '...'; echo !empty( $small_desc ) ? $small_desc : ''; ?></div>


</div>
</div>


<?php }


           if ($html_template == "type02") { ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p02 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
    
 
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
  </div>
    
    <div class="member_desc">  <div class="member-social-links"> 

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
       </div>


</div>
</div>


<?php }



   if ($html_template == "type03") { ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p03 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
    
 
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
    
  </div>
    


</div>
</div>


<?php }


   if ($html_template == "type04") { ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p04 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
    
 
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
    <div class="member_desc"><?php $small_desc = substr($desc,0,130); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?></div>
  </div>
    


</div>
</div>

<?php }


   if ($html_template == "type05") { ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p05 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
    
 
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
    <div class="member_desc"><?php $small_desc = substr($desc,0,120); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?><a href="<?php echo the_permalink() ?>" target="_blank" class="staff_button"><?php echo __('Read More', 'thefoxwp'); ?></a></div>
  </div>
    


</div>
</div>


<?php }

  if ($html_template == "type06") { $icon = 0; ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p06 ajax_post <?php echo esc_attr($echoallterm); ?>">

      
      <div class="staff_post_ctn">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?> 
  </a>  
    
 
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
      <div class="member-social-links">

        <?php if ($facebook!== '' && $icon < 3) { $icon++; ?>
		<div id="facebook"><a  target="_blank" href="http://www.facebook.com/<?php echo esc_attr($facebook); ?>"  ><i class="fa fa-facebook"></i></a></div>
        <?php } ?>
        <?php if ($twitter!== '' && $icon < 3) { $icon++;?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '' && $icon < 3) { $icon++;?>
<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '' && $icon < 3) { $icon++;?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '' && $icon < 3) { $icon++;?>
<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '' && $icon < 3) { $icon++;?>
<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '' && $icon < 3) { $icon++;?>
<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '' && $icon < 3) { $icon++;?>
<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '' && $icon < 3) { $icon++;?>
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble);  ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '' && $icon < 3) { $icon++;?>
<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '' && $icon < 3) { $icon++;?>
<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '' && $icon < 3) { $icon++;?>
<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '' && $icon < 3) { $icon++;?>
<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '' && $icon < 3) { $icon++;?>
 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '' && $icon < 3) { $icon++;?>
<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '' && $icon < 3) { $icon++;?>
<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '' && $icon < 3) { $icon++;?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    </div>
    <div class="member_desc"><?php $small_desc = substr($desc,0,160); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?></div>
  </div>
    


</div>
</div>

<?php }

  if ($html_template == "type07") { $icon = 0; ?>

<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p07 ajax_post <?php echo esc_attr($echoallterm); ?>" >
	<div class="staff_post_ctn">
		<div class="member-photo s_effect">
			<div class="bw-wrapper"><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?></a>
            </div>
      		
            <div class="member-social-links">
        <?php if ($facebook!== '' && $icon < 3) { $icon++; ?>
		<div id="facebook"><a  target="_blank" href="http://www.facebook.com/<?php echo esc_attr($facebook); ?>"  ><i class="fa fa-facebook"></i></a></div>
        <?php } ?>
        <?php if ($twitter!== '' && $icon < 3) { $icon++;?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '' && $icon < 3) { $icon++;?>
		<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '' && $icon < 3) { $icon++;?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '' && $icon < 3) { $icon++;?>
		<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '' && $icon < 3) { $icon++;?>
		<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '' && $icon < 3) { $icon++;?>
		<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '' && $icon < 3) { $icon++;?>
		<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '' && $icon < 3) { $icon++;?>
		<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble);  ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '' && $icon < 3) { $icon++;?>
		<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '' && $icon < 3) { $icon++;?>
		<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '' && $icon < 3) { $icon++;?>
		<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '' && $icon < 3) { $icon++;?>
		<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '' && $icon < 3) { $icon++;?>
		 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '' && $icon < 3) { $icon++;?>
		<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '' && $icon < 3) { $icon++;?>
		<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '' && $icon < 3) { $icon++;?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    		</div>

			<div class="member-info">
		    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>
		    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
			</div>


		</div>
    </div>
</div>
  
  <?php }

  if ($html_template == "type08") { $icon = 0; ?>

<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p08 ajax_post <?php echo esc_attr($echoallterm); ?>">
	<div class="staff_post_ctn">
		<div class="member-photo s_effect">
			<div class="bw-wrapper"><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_post_thumbnail( 'staff_tn', array('title' => ""));  ?></a>
            </div>
      		
            <div class="member-social-links">
        <?php if ($facebook!== '' && $icon < 3) { $icon++; ?>
		<div id="facebook"><a  target="_blank" href="http://www.facebook.com/<?php echo esc_attr($facebook); ?>"  ><i class="fa fa-facebook"></i></a></div>
        <?php } ?>
        <?php if ($twitter!== '' && $icon < 3) { $icon++;?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '' && $icon < 3) { $icon++;?>
		<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '' && $icon < 3) { $icon++;?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '' && $icon < 3) { $icon++;?>
		<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '' && $icon < 3) { $icon++;?>
		<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '' && $icon < 3) { $icon++;?>
		<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '' && $icon < 3) { $icon++;?>
		<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '' && $icon < 3) { $icon++;?>
		<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble); ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '' && $icon < 3) { $icon++;?>
		<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '' && $icon < 3) { $icon++;?>
		<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '' && $icon < 3) { $icon++;?>
		<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '' && $icon < 3) { $icon++;?>
		<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '' && $icon < 3) { $icon++;?>
		 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '' && $icon < 3) { $icon++;?>
		<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '' && $icon < 3) { $icon++;?>
		<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '' && $icon < 3) { $icon++;?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    		</div>
			
            </div>
			<div class="member-info">   
		    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>
		    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
            <div class="member_desc"><?php $small_desc = substr($desc,0,160); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?></div>
			</div>


    </div>
</div>
  
  
<?php }

   if ($html_template == "rstaff_01" || $html_template == "rstaff_02" ||  $html_template == "rstaff_03") { ?>
   <div data-category="<?php echo esc_attr($echoallterm); ?>" class="carousel_recent_post team-member staff_post ajax_post <?php echo esc_attr($echoallterm); ?>">
    <div class="recent_port_ctn clearfix">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php if($html_template == 'rstaff_02'){  echo the_post_thumbnail( array(586, 440), array('title' => "")); }else{ echo the_post_thumbnail( 'staff_tn', array('title' => "")); } ?> 
  </a> <?php if($html_template == 'rstaff_01'){ ?>   
    
   <div class="member-social-links">

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
<?php } ?>
    
    
    </div>

  </div>

  <div class="member-info">

    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>

    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
   

  </div>
</div>


</div>


<?php }




#END Staff



	$i++;
	unset($echoallterm, $pf);
	endwhile;
	die();

    }

}




?>
