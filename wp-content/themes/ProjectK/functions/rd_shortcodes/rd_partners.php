<?php 



/*-----------------------------------------------------------------------------------*/



/*  Partners shortcode



/*-----------------------------------------------------------------------------------*/

function partners_sc($atts, $content = null) {  



    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'to_show' => '1000',
		
		'per_line' => '5',
		'category' => ''
		
    ), $atts));

	ob_start();

?> 

<div class="partners_ctn <?php echo esc_attr($per_line );?>">



<?php
   global $post;
		$i = 0;
		if ($category!=="all" && $category!=="") {
		$args = array(
	'post_type'           => "partners",
    "posts_per_page" => $to_show,	'tax_query' => array( 
            array(
                'taxonomy' => 'groups',
                'field' => 'slug',
        		'post_status' => 'publish',
                'terms' => $category
            ),
),
);
		}
		else{
			$args = array(
            "post_type" => "partners",
        	'post_status' => 'publish',
            "posts_per_page" => $to_show,
);
		}
       
	   
		$partners_query = new WP_Query($args);
	   $i = 1;
		
        if ($partners_query->have_posts()) : while ($partners_query->have_posts()) : $partners_query->the_post(); ?>
      
<?php $link = get_post_meta($post->ID, 'rd_link', true); ?>
    <div><a href="<?php echo esc_url($link); ?>" target="_blank">
      <?php the_post_thumbnail('sponsor_tn', array('title' => "")); ?>
      </a></div>
      
      <?php
	  if($per_line == 'part_col_1' ){
	  if($i == 1 ){ echo '<div class="clearfix"></div>'; $i = 0; }
	  }
	  if($per_line == 'part_col_2' ){
	  if($i == 2 ){ echo '<div class="clearfix"></div>'; $i = 0; }
	  }
	  if($per_line == 'part_col_3' ){
	  if($i == 3 ){ echo '<div class="clearfix"></div>'; $i = 0; }
	  }
	  if($per_line == 'part_col_4' ){
	  if($i == 4 ){ echo '<div class="clearfix"></div>'; $i = 0; }
	  }
	  if($per_line == 'part_col_5' ){
	  if($i == 5 ){ echo '<div class="clearfix"></div>'; $i = 0; }
	  }
	   $i ++; endwhile; endif; ?>
      
      </div>
      
      <?php wp_reset_postdata(); 
	  
$output_string = ob_get_contents();
ob_end_clean();


	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';
}
add_shortcode( 'partners_sc', 'partners_sc' );

?>