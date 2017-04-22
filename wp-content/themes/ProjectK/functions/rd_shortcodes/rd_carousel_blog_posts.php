<?php 

/*-----------------------------------------------------------------------------------*/



/*  Recent carousel post shortcode



/*-----------------------------------------------------------------------------------*/

function carousel_posts_sc($atts, $content = null) {  






    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'to_show' => '1000',
		
		'posts_per_line' => '4',
		
		'category' => 'all',
		
		'show_tn' => 'yes',

		'show_content' => '',
		'bg_color' => '',
		'h_color' => '',
		't_color' => '',
		'hover_color' => '',
		
		'title' => '',
		'desc' => '',
		'b_text' => '',
		'b_link' => '',
		'pos' => '',

		
		'type' => ''
		

				
    ), $atts));

	ob_start();

$rp_rs = RandomString(20);
global $rd_data;
$blog_rand_class = RandomString(20);

	
if ($type == 'cbp_type01' ){
	$hl_color = $rd_data['rd_content_hl_color'];
$hover_color = $rd_data['rd_content_hover_color'];	

echo '<style>.rand'.$blog_rand_class.'_post .widget_post_title a,.rand'.$blog_rand_class.'_post .rp_date a,.rand'.$blog_rand_class.'_post .rp_date { color:#fff;}.rand'.$blog_rand_class.'_post .rp_date a,.rand'.$blog_rand_class.'_post .rp_date {padding-bottom:0; margin-bottom:0;}.rand'.$blog_rand_class.'_post .blog_box_content {position:absolute; bottom: 20px ;min-width: 100%; text-align: center;}.cbp_type01 .recent_port_ctn:hover .blog_box_content {bottom:85px;}.recent_port_ctn:hover .blog_img_link,.recent_port_ctn:hover .blog_post_link{bottom:35px}</style>';	
}

if ($type == 'cbp_type02' ){
	$hl_color = $rd_data['rd_content_hl_color'];
$hover_color = $rd_data['rd_content_hover_color'];	

echo '<style>.rand'.$blog_rand_class.'_post .widget_post_title a,.rand'.$blog_rand_class.'_post .rp_date a,.rand'.$blog_rand_class.'_post .rp_date { color:#fff;}.rand'.$blog_rand_class.'_post .rp_date a,.rand'.$blog_rand_class.'_post .rp_date {padding-bottom:0; margin-bottom:0;}.rand'.$blog_rand_class.'_post .blog_box_content {position:absolute; bottom: 0px ;min-width: 100%; text-align: center;}.rand'.$blog_rand_class.'_post:hover .widget_post_title a{color:'.$hl_color.'}.rand'.$blog_rand_class.'_post a:hover{color:'.$hover_color.' !important;}</style>';	
}
if ($type == 'cbp_type03' || $type == 'cbp_type04' || $type == 'cbp_type07' ){
	

if($h_color == ''){$h_color = $rd_data['rd_content_heading_color'];}
if($t_color == ''){$t_color = $rd_data['rd_content_text_color'];}
if($hover_color == ''){$hover_color = $rd_data['rd_content_hover_color'];}
		
	
echo '<style>.rd_'.$rp_rs.' .post-title h2 a{color:'.$h_color.';}.rd_'.$rp_rs.' .post-info,.rd_'.$rp_rs.' .post-info a,.rd_'.$rp_rs.' .entry{color:'.$t_color.';}.rd_'.$rp_rs.' .post-title h2 a:hover{color:'.$hover_color.';}.rd_'.$rp_rs.' .post-info a:hover,.rd_'.$rp_rs.' .entry a:hover{color:'.$hover_color.';}</style>';	
}

if ($type == 'cbp_type05' || $type == 'cbp_type06'  || $type == 'cbp_type08'  ){
echo '<style>.rand'.$blog_rand_class.'_post .blog_box_content{background:'.$bg_color.'}</style>';	
}

		
			
		echo '
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {
		j$(".rd_'.$rp_rs.'.rp_sc ul").carouFredSel({
					responsive: true,
					width: "100%",
						height: "variable",
					scroll: 1,';
					
					
if($type == 'cbp_type04'){
					
echo				'prev: ".rd_'.$rp_rs.'.related_left",
					next: ".rd_'.$rp_rs.'.related_right",';
					
}else{

echo				'prev: ".rd_'.$rp_rs.'.rp_left",
					next: ".rd_'.$rp_rs.'.rp_right",';	
	
}
					
echo 				'auto: false,
					items: {
						width: 330,
						height: "variable",
						visible: {
							min: 1,
							max: '.$posts_per_line.'
						}
					}
				});
				});
	</script>';
if($type == 'cbp_type04'){ 


	echo '	<h2 class="single_related">'.$title.'</h2>
	<div class="related_nav '.$type.'">
  <p class="rd_'.$rp_rs.' related_left"></p>
  <p class="rd_'.$rp_rs.' related_right"></p>
</div>';

}

if($type == 'cbp_type05' || $type == 'cbp_type06' || $type == 'cbp_type08'){ 
	echo '<div class="cbp_'.$pos.'_desc '.$type.'"><h2 class="cbp_title">'.$title.'</h2>
	<div class="rp_desc">'.$desc.'</div>
	<div class="rp_nav">
  <p class="rd_'.$rp_rs.' rp_left"></p>
  <p class="rd_'.$rp_rs.' rp_right"></p>
</div></div>';




}

	

	
echo '<div class="rd_'.$rp_rs.' rp_sc '.$type.' ';

if($type == 'cbp_type01' || $type == 'cbp_type02'){

 echo 'clearfix';

}
if($type == 'cbp_type05' || $type == 'cbp_type06' || $type == 'cbp_type08'){

 echo 'cbp_'.$pos.' ';

}




 echo '">';




if($type == 'cbp_type01' || $type == 'cbp_type02'  || $type == 'cbp_type03' ){ 


	echo '<div class="rp_nav">
  <p class="rd_'.$rp_rs.' rp_left"></p>
  <p class="rd_'.$rp_rs.' rp_right"></p>
</div>';



}
echo '<ul>';

$category_f = ($category!=="all" ? $category : '');

   global $post;
        $query = new WP_Query();
		$i = 0;
		if($category_f !== ''){
        $query->query(array(
            'post_type' => 'Post',
			'category_name' => $category_f,
          'posts_per_page' => $to_show,
        	'post_status' => 'publish',

        ));
		}
		else
		{
		 $query->query(array(
            'post_type' => 'Post',
        	'post_status' => 'publish',
          'posts_per_page' => $to_show
		));
		}
			
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
      
?>
<?php if ($type == 'cbp_type03' || $type == 'cbp_type04' || $type == 'cbp_type07'){ ?>

 <li class="blog_related_post brsc">
      
     <div class="post">

<?php

	if( get_the_post_thumbnail() ) {
		echo "<div class='post-attachement'>";
		if ($type !== 'cbp_type07'){
		echo  the_post_thumbnail(array(600, 490) );
		}else{
		echo  the_post_thumbnail(array(586, 440) );
		}
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
      <?php 	if($type !== 'cbp_type07'){	echo rd_custom_excerpt('rd_rp_excerpt','rd_related_more'); }else { echo rd_custom_excerpt('rd_rp_excerpt','rd_port_more');  }?>
    </div>   
    <!-- .entry END --> 
     </div>
	</div>
	<!-- .post-content END--> 
	<!-- .post END -->
      </li>

<?php }else{ ?>

      <li class="carousel_recent_post brsc">
      <div class="recent_port_ctn <?php echo 'rand'.$blog_rand_class.'_post'; ?> ">
      <div class="blog_box">
<?php  

if($type == 'cbp_type01'){ 

 the_post_thumbnail(array(768, 1000), array('title' => ""));

}

if($type == 'cbp_type02'){ 

 the_post_thumbnail(array(768, 560), array('title' => ""));

}

if($type == 'cbp_type05' || $type == 'cbp_type08' ){ 

 the_post_thumbnail(array(540, 460), array('title' => ""));

}
if($type == 'cbp_type06'){ 

 the_post_thumbnail( array(540, 400) , array('title' => ""));

}

echo "";
$image =wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');

if($type == 'cbp_type01'){ 

echo '<a href="'.$image[0]. '" class="prettyPhoto blog_img_link_ctn">';
echo "<span class='blog_img_link'>";
echo '';
echo "</span></a><a class='blog_post_link_ctn' href='" . get_permalink( $post->ID ) . "'>";
echo "<span class='blog_post_link'>";
echo '';
echo "</span></a>";
echo ""; 
}

if($type == 'cbp_type05' || $type == 'cbp_type06'  || $type == 'cbp_type08' ){ 

echo "<a class='blog_post_link_ctn' href='" . get_permalink( $post->ID ) . "'></a>";

}
?>

<div class="blog_box_content">
<h5 class="widget_post_title"> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'thefoxwp'), get_the_title()); ?>">
<?php the_title(); ?>
</a> </h5>
<div class="clearfix"></div>

<?php if($type == 'cbp_type01'){ ?>
<p class="rp_date" ><?php the_category(',') ?> / <?php the_time( get_option('date_format') ); ?></p>
<?php }if($type == 'cbp_type02'){ ?>
<p class="rp_date" ><?php the_time( get_option('date_format') ); ?> | <?php the_category(',') ?></p>
<?php }?>



<?php if($type !== 'cbp_type01' && $type !== 'cbp_type02'){ ?>

      <?php 		echo rd_custom_excerpt('rd_bp_excerpt','rd_related_more'); ?>

<?php } ?>

</div>
</div>
</div>
</li>

<?php } endwhile; endif; ?>
<?php wp_reset_postdata(); ?>



</ul>

</div>

<?php

$output_string = ob_get_contents();
ob_end_clean();

	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';
}
add_shortcode( 'carousel_posts_sc', 'carousel_posts_sc' );

?>