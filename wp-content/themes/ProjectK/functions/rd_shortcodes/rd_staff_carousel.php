<?php 


/*-----------------------------------------------------------------------------------*/



/*  Staff shortcode



/*-----------------------------------------------------------------------------------*/

function staff_sc($atts, $content = null) {  





    extract(shortcode_atts(array(  
		'margin_top'   => '0',
		'margin_bottom' => '0',
		'to_show' => '100',
		'type' => '',
		'group' => '',
		'l_target' => '',
		'posts_per_line' => '4',
		'bg_color' => '',
		'alt_bg_color' => '',
		'heading_color' => '',
		'hl_color' => '',
		'border_color' => '',
		'text_color' => ''
				
    ), $atts));

	ob_start();
global $rd_data;
if($bg_color == '') {
$bg_color = $rd_data['rd_content_bg_color'];	
}
if($alt_bg_color == '') {
$alt_bg_color = $rd_data['rd_content_grey_color'];	
}
if($heading_color == '') {
$heading_color = $rd_data['rd_content_heading_color'];	
}
if($hl_color == '') {
$hl_color = $rd_data['rd_content_hl_color'];	
}
if($text_color == '') {
$text_color = $rd_data['rd_content_text_color'];	
}

if($border_color == '') {
$border_color = $rd_data['rd_content_border_color'];	
}



$staff_id = RandomString(20);

$s_style ='<style>';



if($type == 'rstaff_01'){  

$s_style .='.rd_'.$staff_id.'.'.$type.' .recent_port_ctn{border-bottom:13px solid '.$border_color.';}.rd_'.$staff_id.'.'.$type.' .recent_port_ctn:hover{border-bottom:13px solid '.$hl_color.';}.rd_'.$staff_id.'.'.$type.' .member-info{background:'.$bg_color.'; color:'.$text_color.'; border:1px solid '.$border_color.'; border-top:none;  border-bottom:none;}.rd_'.$staff_id.'.'.$type.' .bw-wrapper{border:1px solid '.$border_color.'; border-bottom:none;}.rd_'.$staff_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a:hover,.rd_'.$staff_id.'.'.$type.' .member-social-links a:hover{color:'.$hl_color.' !important;}.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left:hover,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right:hover{background:'.$hl_color.';}';

}
if($type == 'rstaff_02'){  

$s_style .='.rd_'.$staff_id.'.'.$type.' .team-member:nth-child(odd) .member-info{background:'.$bg_color.'; color:'.$text_color.';}.rd_'.$staff_id.'.'.$type.' .team-member:nth-child(even) .member-info{background:'.$alt_bg_color.'; color:'.$text_color.';}.rd_'.$staff_id.'.'.$type.'  .team-member:nth-child(odd) .bw-wrapper:after{background:'.$bg_color.';}.rd_'.$staff_id.'.'.$type.' .team-member:nth-child(even) .bw-wrapper:after{background:'.$alt_bg_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}.rd_'.$staff_id.'.'.$type.' .team-member:hover .bw-wrapper a:before{background:'.$hl_color.';}
.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left:hover,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right:hover{background:'.$hl_color.';}';

}
if($type == 'rstaff_03'){  

$s_style .='.rd_'.$staff_id.'.'.$type.' .team-member:hover .bw-wrapper a:before{border:2px solid '.$hl_color.'; transform: scale(1.03);}.rd_'.$staff_id.'.'.$type.' .carousel_recent_post img{background:'.$bg_color.';}.rd_'.$staff_id.'.'.$type.' .member-info{ color:'.$text_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a:hover{color:'.$hl_color.';}.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_left:hover,.rd_'.$staff_id.'.'.$type.' .staff_nav .staff_right:hover{background:'.$hl_color.';}';

}

if($type == 'rstaff_04'){  

$s_style .='.rd_'.$staff_id.'.'.$type.' .recent_port_ctn:hover .member-photo{background:'.$heading_color.'; }.rd_'.$staff_id.'.'.$type.' .member-info,.rd_'.$staff_id.'.'.$type.' .member_desc{ color:'.$text_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}.rd_'.$staff_id.'.'.$type.' .member-info h3 a:hover{color:'.$hl_color.';}.rd_'.$staff_id.'_pager a{background:'.$heading_color.' ;}.rd_'.$staff_id.'_pager a.selected{background:'.$hl_color.';}';

}



$s_style .='</style>';

echo !empty( $s_style ) ? $s_style : '';

if($type == 'rstaff_04'){
	
	$pl = $posts_per_line;

	
}
			
		echo '
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();		
		"use strict";
	//setup up Carousel
	j$(window).load(function() {
		j$(".rd_'.$staff_id.'.staff_sc ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".rd_'.$staff_id.'.staff_left",
					next: ".rd_'.$staff_id.'.staff_right",
					pagination: ".rd_'.$staff_id.'_pager",
					auto: false,
					height: "variable",
					items: {
						width: 330,
					height: "variable",
						visible: {
							min: 1,';
						if($type == 'rstaff_04'){
						echo 'max:1';}else{
						echo 'max: '.$posts_per_line.'';	
						}
						echo '
						}
					}
				});
				});
	</script>
	
	<div class="staff_sc rd_'.$staff_id.'  '.$type.'">
<div class="staff_nav">
  <p class="rd_'.$staff_id.' staff_left"></p>
  <p class="rd_'.$staff_id.' staff_right"></p>
</div>	
<ul>';


   global $post;
     			$args = array(
	'posts_per_page'      => $to_show,
	'post_type'           => "Staff",
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


	
		$staff_query = new WP_Query($args);
		
		
	global $more,$post;

	$more = 0;

  
$i= 1;		


  if ($staff_query->have_posts()) :while ($staff_query->have_posts()) : $staff_query->the_post();
		 

          		
      
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

$desc = get_post_meta($post->ID, 'rd_small_desc', true); 


if ($type !== 'rstaff_04') {
echo '<li class="carousel_recent_post team-member">';
}
elseif($type == 'rstaff_04' && $i == 1 ){
     echo '<li class="carousel_recent_post team-member '.$pl.' '.$i.'">';
}
?>
<div class="recent_port_ctn clearfix">
	<div class="member-photo s_effect">
    <div class="bw-wrapper">
    <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php if($type == 'rstaff_02'){  echo the_post_thumbnail( array(586, 440), array('title' => "")); }else{ echo the_post_thumbnail( 'staff_tn', array('title' => "")); } ?></a>
    <?php if($type == 'rstaff_01'){ ?>   
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
    <?php if($type == 'rstaff_04'){ ?>   
    <div class="member_desc"><?php $small_desc = substr($desc,0,130); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?></div>
	<?php }  ?>
	</div>
</div>

<?php


if($type !== 'rstaff_04') {

echo '</li>';
	  
}
if($type == 'rstaff_04' && $i == $pl ){
	 echo '</li>';
	
	$i = 0;
	
}

$i++;
endwhile; 
endif;
?>

      <?php wp_reset_postdata(); ?>

    </ul>
 <?php

if ($type == 'rstaff_04') {
    
echo '<div class="rd_'.$staff_id.'_pager rd_sc_pager"></div>';
}
?>
  </div> <?php



$output_string = ob_get_contents();
ob_end_clean();


	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';

}
add_shortcode( 'staff_sc', 'staff_sc' );

?>