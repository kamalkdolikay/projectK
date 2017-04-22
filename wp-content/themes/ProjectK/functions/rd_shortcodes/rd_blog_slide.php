<?php 

/*-----------------------------------------------------------------------------------*/



/*  Recent carousel post shortcode



/*-----------------------------------------------------------------------------------*/

function blog_slide_sc($atts, $content = null) {  






    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'to_show' => '1000',
		
		'posts_per_line' => '4',
		
		'category' => 'all',
		
		'show_tn' => 'yes',

		'show_content' => '',
		'bg_color' => '',
		
		'title' => '',
		'desc' => '',

		
		'type' => ''
		

				
    ), $atts));

	ob_start();

$rp_rs = RandomString(20);
global $rd_data;

$hl_color = $rd_data['rd_content_hl_color'];
$hover_color = $rd_data['rd_content_hover_color'];	
	
	echo '
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {
		j$(".'.$rp_rs.'.slide_sc ul").carouFredSel({
					responsive: true,
					width: "100%",
        				height: "variable",
        			scroll : { fx : "crossfade" },
					prev: ".'.$rp_rs.'.sp_left",
					next: ".'.$rp_rs.'.sp_right",	
					auto: false,
					items: {
						width: 570,
        				height: "variable",
						visible: {
							min: 1,
							max: 1
						}
					}
				});
				});
	</script>';

	

	
echo '<div class="'.$rp_rs.' slide_sc '.$type.'">';
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

 <li class="slide_post">
      

<?php
if($type == ''){
		echo  the_post_thumbnail(array(570, 420) ); 
}
elseif($type == 'rd_alt_slide'){
		echo  the_post_thumbnail(array(570, 545) ); 
}
elseif($type == 'rd_squared_slide'){
		echo  the_post_thumbnail('portfolio_squared' ); 
}

 
 ?>
  <div class="slide_post_info"> 
      <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <?php if($type == ''){
		  echo rd_custom_excerpt('rd_rp_excerpt','rd_port_more');
			 }elseif($type == 'rd_alt_slide'){
			 echo rd_custom_excerpt('rd_staff_excerpt','rd_port_more');
			 }else {
				 
			 }
?>
<h3 class="sp_date" ><?php the_time( get_option('date_format') ); ?></h3>
<div class="rp_nav">
<?php echo'<div class="'.$rp_rs.' sp_left"></div><div class="'.$rp_rs.' sp_right"></div>'; ?>
</div>

     </div>
	  </li>




<?php  endwhile; endif; ?>
<?php wp_reset_postdata(); ?>



</ul>

</div>

<?php

$output_string = ob_get_contents();
ob_end_clean();

	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';
}
add_shortcode( 'blog_slide_sc', 'blog_slide_sc' );

?>