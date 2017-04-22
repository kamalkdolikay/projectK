<?php 

/*-----------------------------------------------------------------------------------*/



/*  Staf shortcode



/*-----------------------------------------------------------------------------------*/


function staff_post_sc($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'heading_size' => '' ,
                'heading_color' => '',
				'type' => '',
				'group' => '',
                'heading_text' => '',
                'posts_per_page' => '10',
                'column' => '',
                'l_target' => '',
				'alt_column' => '',
				'bg_color' => '',
				'alt_bg_color' => '',
				'text_color' => '',
				'heading_color' => '',
				'hl_color' => '',
				'border_color' => '',
				'blog_navigation' => '',
				'blog_click' => '',
				'filter' => '',
				'filter_position' => '',
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
				'filter_text_color' => '',
				'filter_background_color' => '',
				'selected_filter_bg_color' => '',
				'selected_filter_text_color' => '',
				'filter_border_color' => '',

            ), $atts));
ob_start();


$rp_id = RandomString(20);

global $rd_data;

if($heading_color == '' ){
	$heading_color = $rd_data['rd_content_heading_color'];
}
if($text_color == '' ){
	$text_color = $rd_data['rd_content_text_color'];
}
if($hl_color == '' ){
	$hl_color = $rd_data['rd_content_hl_color'];
}
if($border_color == '' ){
	$border_color = $rd_data['rd_content_border_color'];
}
if($bg_color == '' ){
	$bg_color = $rd_data['rd_content_bg_color'];
}

if($button_bg == '' ){
	$button_bg = $rd_data['rd_content_bg_color'];
}if($alt_bg_color == '') {
$alt_bg_color = $rd_data['rd_content_grey_color'];	
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

if($filter_background_color== '' ){

	$filter_background_color = $rd_data['rd_content_bg_color'];
}
				if($filter_text_color== '' ){

	$filter_text_color = $rd_data['rd_content_text_color'];
}
				if($selected_filter_bg_color== '' ){

	$selected_filter_bg_color = $rd_data['rd_content_hl_color'];					

}				if($selected_filter_text_color== '' ){

	$selected_filter_text_color = "#ffffff";					

}
				if($filter_border_color== '' ){
					
	$filter_border_color = $rd_data['rd_content_border_color'];

}
if ($type == 'type07' || $type == 'type09' ){

$column = $alt_column;	
	
}

wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting_bp', get_template_directory_uri() . '/js/sorting_sp.js');
wp_enqueue_script('js_refresh_bp', get_template_directory_uri() . '/js/refresh_bp.js');


$items_on_start = $posts_per_page; 
$items_per_click = $blog_click;
$view_type = $type;    

$output ='<style>';




if($type == 'type01' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p01 .member-info{color:'.$text_color.'; background:'.$bg_color.';}#rp_'.$rp_id.' .rd_staff_p01 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p01 .member-info h3 a:hover{color:'.$hl_color.' !important;}#rp_'.$rp_id.' .rd_staff_p01 .member-social-links a{color:'.$text_color.' !important;}#rp_'.$rp_id.' .rd_staff_p01 .member-social-links a:hover{color:'.$hl_color.' !important;}#rp_'.$rp_id.' .rd_staff_p01 .member_desc{color:'.$text_color.'; background:'.$bg_color.'; border-top:1px solid '.$border_color.';}#rp_'.$rp_id.' .staff_post_ctn{ border:1px solid '.$border_color.';}';

}
elseif($type == 'type02' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p02 .staff_post_ctn{border:1px solid '.$border_color.';}#rp_'.$rp_id.' .rd_staff_p02 .member-info{color:'.$text_color.'; background:'.$bg_color.';  border-top:1px solid '.$border_color.';}#rp_'.$rp_id.' .rd_staff_p02 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p02 .staff_post_ctn:hover .position{color:'.$hl_color.' !important;}#rp_'.$rp_id.' .rd_staff_p02 .member-social-links a{color:'.$text_color.' !important;}#rp_'.$rp_id.' .rd_staff_p02 .member-social-links a:hover{color:'.$hl_color.' !important;}#rp_'.$rp_id.' .rd_staff_p02 .member_desc{ background:'.$bg_color.'; border-top:1px solid '.$border_color.';}#rp_'.$rp_id.' .rd_staff_p02 .staff_post_ctn:hover .bw-wrapper a:before{background:'.$hl_color.' } ';

}

elseif($type == 'type03' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p03 .member-info{color:'.$text_color.';}#rp_'.$rp_id.' .rd_staff_p03 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p03 .member-info h3 a:hover{color:'.$hl_color.';}#rp_'.$rp_id.' .rd_staff_p03 .staff_post_ctn:hover .bw-wrapper a:before{background:'.$hl_color.' }#rp_'.$rp_id.' .rd_staff_p03 .staff_post_ctn:hover .bw-wrapper{border: 20px solid '.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p03 .member-photo{color:'.$border_color.';}';

}


elseif($type == 'type04' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p04 .member-info{color:'.$text_color.';}#rp_'.$rp_id.' .rd_staff_p04 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p04 .member-info h3 a:hover{color:'.$hl_color.';}#rp_'.$rp_id.' .rd_staff_p04 .member-photo{-moz-box-shadow: 0 0 0px 1px '.$text_color.'; -webkit-box-shadow: 0 0 0px 1px '.$text_color.'; box-shadow: 0 0 0px 1px '.$text_color.';} ';

}
elseif($type == 'type05' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p05 .member-info{color:'.$text_color.'; background:'.$bg_color.';}#rp_'.$rp_id.' .rd_staff_p05 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p05 .member-info h3 a:hover{color:'.$hl_color.' !important;}#rp_'.$rp_id.' .rd_staff_p05 .member_desc{color:'.$text_color.'; background:'.$bg_color.'; border-top:1px solid '.$border_color.';}#rp_'.$rp_id.' .rd_staff_p05 .staff_post_ctn{ border:1px solid '.$border_color.';}.rd_staff_p05 .staff_button{color:'.$heading_color.'; border-color:'.$heading_color.';}.rd_staff_p05 .staff_button:hover{color:#ffffff; border-color:'.$hl_color.'; background:'.$hl_color.';}#rp_'.$rp_id.' .staff_post_ctn{ border:1px solid '.$border_color.';}';

}

elseif($type == 'type06' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p06 .member-info{color:'.$text_color.';}#rp_'.$rp_id.' .rd_staff_p06 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p06 .member-info h3 a:hover{color:'.$hl_color.';}#rp_'.$rp_id.' .rd_staff_p06 .member-photo{background:'.$border_color.';}';

}elseif($type == 'type08' ) {


$output .='#rp_'.$rp_id.' .rd_staff_p08 .member-info{color:'.$text_color.';}#rp_'.$rp_id.' .rd_staff_p08 .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.' .rd_staff_p08 .member-info h3 a:hover,#rp_'.$rp_id.' .rd_staff_p08 .member-info .position{color:'.$hl_color.';}#rp_'.$rp_id.' .rd_staff_p08 .position{border-bottom-color:'.$border_color.';}';

}
elseif($type == 'rstaff_01'){  

$output .='#rp_'.$rp_id.'.rstaff_01 .recent_port_ctn{border-bottom:13px solid '.$border_color.';}#rp_'.$rp_id.'.'.$type.' .recent_port_ctn:hover{border-bottom:13px solid '.$hl_color.';}#rp_'.$rp_id.'.'.$type.' .member-info{background:'.$bg_color.'; color:'.$text_color.'; border:1px solid '.$border_color.'; border-top:none;  border-bottom:none;}#rp_'.$rp_id.'.'.$type.' .bw-wrapper{border:1px solid '.$border_color.'; border-bottom:none;}#rp_'.$rp_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.'.'.$type.' .member-info h3 a:hover,#rp_'.$rp_id.'.'.$type.' .member-social-links a:hover{color:'.$hl_color.' !important;}#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_left,#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_left:hover,#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_right:hover{background:'.$hl_color.';}';

}
elseif($type == 'rstaff_02'){  

$output .='#rp_'.$rp_id.'.rstaff_02{background:'.$bg_color.';}#rp_'.$rp_id.'.rstaff_02 .team-member:nth-child(odd) .member-info{background:'.$bg_color.'; color:'.$text_color.';}#rp_'.$rp_id.'.'.$type.' .team-member:nth-child(even) .member-info{background:'.$alt_bg_color.'; color:'.$text_color.';}#rp_'.$rp_id.'.'.$type.'  .team-member:nth-child(odd) .bw-wrapper:after{background:'.$bg_color.';}#rp_'.$rp_id.'.'.$type.' .team-member:nth-child(even) .bw-wrapper:after{background:'.$alt_bg_color.';}#rp_'.$rp_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.'.'.$type.' .team-member:hover .bw-wrapper a:before{background:'.$hl_color.';}
#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_left,#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_left:hover,#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_right:hover{background:'.$hl_color.';}';

}
elseif($type == 'rstaff_03'){  
$output .='#rp_'.$rp_id.'.rstaff_03 .team-member:hover .bw-wrapper a:before{border:2px solid '.$hl_color.'; transform: scale(1.03);}#rp_'.$rp_id.'.rstaff_03 .carousel_recent_post img{background:'.$bg_color.';}#rp_'.$rp_id.'.'.$type.' .member-info{ color:'.$text_color.';}#rp_'.$rp_id.'.'.$type.' .member-info h3 a{color:'.$heading_color.';}#rp_'.$rp_id.'.'.$type.' .member-info h3 a:hover{color:'.$hl_color.';}#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_left,#rp_'.$rp_id.'.'.$type.' .staff_nav .staff_right{background:'.$heading_color.' ;}';

}



if($blog_navigation !== '' ) {


$output .= '#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more{background:'.$button_bg.'; color:'.$button_title.'; border:1px solid '.$button_border.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more .refresh_icn:before{color:'.$button_title.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more:hover{background:'.$button_hover_bg.'; color:'.$button_hover_title.'; border:1px solid '.$button_hover_bg.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more:hover .refresh_icn:before{color:'.$button_hover_title.';}.navigation .pagination span,.navigation .pagination a{border:1px solid '.$nav_border.'; color:'.$nav_color.'; background:'.$nav_bg.';}.navigation .pagination .current,.navigation .pagination span:hover,.navigation .pagination a:hover{ color:'.$nav_hover_color.' !important; background:'.$nav_hover_bg.'; border:1px solid '.$nav_hover_bg.'; }.navigation{border-top:1px solid '.$nav_border.';}.pagination_current_position{color:'.$nav_color.';}';

}



if($filter !== '' ) {

$output .= '#staff-position.filter_'.$rp_id.' #options a {color:'.$filter_text_color.'; background:'.$filter_background_color.'; border:1px solid '.$filter_border_color.';}#staff-position.filter_'.$rp_id.' #options .selected a{color:'.$selected_filter_text_color.'; background:'.$selected_filter_bg_color.'; border:1px solid '.$selected_filter_bg_color.';}';


}

$output .='</style>';

echo !empty( $output ) ? $output : '';
	
	 ?>
<script>



jQuery.noConflict();
var $ = jQuery;
"use strict";

$(document).ready(function(){
<?php 

if($blog_navigation == 'loadmore_nav'){ ?>

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                var html_template = "<?php echo esc_js($view_type); ?>";
                var column = "<?php echo esc_js($column); ?>";
                var l_target = "<?php echo esc_js($l_target); ?>";
                var now_open_works = 0;
                var first_load = true;

   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                function get_staff_posts (this_obj) {

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
                        data: "html_template="+html_template+"&now_open_works="+now_open_works+"&action=get_staff_posts"+"&works_per_load="+works_per_load+"&column="+column+"&l_target="+l_target+"&first_load="+first_load+"&group=<?php echo esc_js($group); ?>",
                        success: function(result){

	                            if(result.length<1){
                                $("#rp_<?php echo esc_js($rp_id); ?> .blog_load_more_cont").hide("fast");
	                            }

                            now_open_works = now_open_works + works_per_load;
							first_load = false;
                            var $newItems = $(result);
                            $("#rp_<?php echo esc_js($rp_id); ?>").isotope( 'insert', $newItems, function() {
                            $("#rp_<?php echo esc_js($rp_id); ?>").ready(function(){
                            $("#rp_<?php echo esc_js($rp_id); ?>").isotope('layout');

                            //Blog
                            $('#rp_<?php echo esc_js($rp_id); ?> .isotope-item').each(function(){
                            $(this).css('margin-top', Math.floor(-1*($(this).height()/2))+'px');
                            });
                            });


                               $("#rp_<?php echo esc_js($rp_id); ?>").isotope('layout');
							   
							   $(".filter_<?php echo esc_js($rp_id); ?> .staffoptionset li a").each(function() {
									
								var filter_class = $(this).attr('data-option-value');
								 if ($('#rp_<?php echo esc_js($rp_id); ?>').find(filter_class).length) { // implies *not* zero
								$(this).parent('li').show();
								 }else{
								$(this).parent('li').hide();
								 }
								
								
								
								});
								
							   
							   $(window).trigger('resize');
							   
							});


$(".wpb_row:empty").remove();
$(".wpb_column:empty").remove();
$(".wpb_wrapper:empty").remove();
							
							$(".refresh_icn").removeClass("fa-spin");
							$(".refresh_icn").removeClass("fa-refresh");
							$(".refresh_icn").addClass("fa-plus");

                    }   

                    });
					
				}

                $("#rp_<?php echo esc_js($rp_id); ?> .get_blog_posts_btn").click(function(){
				$(".refresh_icn").removeClass("fa-plus");
				$(".refresh_icn").addClass("fa-refresh");
                $(".refresh_icn").addClass("fa-spin");
                get_staff_posts();						
					$(".masonry_ctn").isotope('layout');

				return false;

                });


               /* load at start */

                $(window).load(function(){

                get_staff_posts();
				
				
				
<?php }else { ?>

 $(window).load(function(){
							   $(".filter_<?php echo esc_js($rp_id); ?> .staffoptionset li a").each(function() {
									
								var filter_class = $(this).attr('data-option-value');
								 if ($('#rp_<?php echo esc_js($rp_id); ?>').find(filter_class).length) { // implies *not* zero
								$(this).parent('li').show();
								 }else{
								$(this).parent('li').hide();
								 }
								});	
<?php } ?>				
						   
								
								
											
$('.masonry_ctn').isotope({
  // options
  itemSelector : '.staff_post',
  layoutMode : 'masonry'
});


});});


</script>
<?php

if ( $filter !== ''){
			echo '
				<div id="staff-position" class="filter_'.$rp_id.' '.$filter_position.'">
				<ul class="splitter" id="options">';
			echo '<li>';
			
			
			rd_showstaffposition();
            echo '      </li>';        
			echo '</ul></div>';
		
		
}

?>

<div class="rd_staff_posts_ctn masonry_ctn <?php echo esc_attr($column.' '.$type.''); if($blog_navigation !==''){echo ' staff_has_nav';}?>" id="rp_<?php echo esc_attr($rp_id); ?>">

<?php if($blog_navigation !== 'loadmore_nav'){ 
		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
		else { $paged = 1; }
			$args = array(
	'posts_per_page'      => $posts_per_page,
	'post_type'           => "Staff",
	'paged' => $paged
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




 while ($staff_query->have_posts()) : $staff_query->the_post();


	$current = $staff_query->query_vars['paged'];
	$maxpages = $staff_query->max_num_pages;

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


   if ($type == "type01") {  $icon = 0; ?>
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
        <?php if ($twitter!== '' && $icon < 4) { $icon++;?>
		<div id="twitter"> <a  target="_blank" href="http://twitter.com/<?php echo esc_attr($twitter); ?>"  ><i class="fa fa-twitter"></i></a></div>
        <?php } ?>
        <?php if ($linkedin!== '' && $icon < 4) { $icon++;?>
<div id="lin"> <a  target="_blank" href="<?php  echo esc_url($linkedin);  ?>"  ><i class="fa fa-linkedin"></i></a></div>
        <?php } ?>
        <?php if ($tumblr!== '' && $icon < 4) { $icon++;?>
		 <div id="tumblr"> <a  target="_blank" href="<?php  echo esc_url($tumblr);  ?>"  ><i class="fa fa-tumblr"></i></a></div>
        <?php } ?>
        <?php if ($skype!== '' && $icon < 4) { $icon++;?>
<div id="skype">  <a  target="_blank" href="<?php  echo esc_url($skype);  ?>"  ><i class="fa fa-skype"></i></a></div>
        <?php } ?>
        <?php if ($Pinterest!== '' && $icon < 4) { $icon++;?>
<div id="Pinterest"> <a  target="_blank" href="<?php  echo esc_url($Pinterest);  ?>"  ><i class="fa fa-pinterest"></i></a></div>
        <?php } ?>
        <?php if ($vimeo!== '' && $icon < 4) { $icon++;?>
<div id="vimeo"> <a  target="_blank" href="<?php  echo esc_url($vimeo);  ?>"  ><i class="fa fa-vimeo-square"></i></a></div>
        <?php } ?>
        <?php if ($youtube!== '' && $icon < 4) { $icon++;?>
<div id="yt"> <a  target="_blank" href="<?php  echo esc_url($youtube);  ?>"  ><i class="fa fa-youtube"></i></a></div>
        <?php } ?>
        <?php if ($dribbble!== '' && $icon < 4) { $icon++;?>
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble); ?>"  ><i class="fa fa-dribbble"></i></a></div>
        <?php } ?>
        <?php if ($deviantart!== '' && $icon < 4) { $icon++;?>
<div id="da"> <a  target="_blank" href="<?php  echo esc_url($deviantart);  ?>"  ><i class="fa fa-deviantart"></i></a></div>
        <?php } ?>
        <?php if ($reddit!== '' && $icon < 4) { $icon++;?>
<div id="reddit"> <a  target="_blank" href="<?php  echo esc_url($reddit);  ?>"  ><i class="fa fa-reddit"></i></a></div>
        <?php } ?>
        <?php if ($behance!== '' && $icon < 4) { $icon++;?>
<div id="behance"> <a  target="_blank" href="<?php  echo esc_url($behance);  ?>"  ><i class="fa fa-behance"></i></a></div>
        <?php } ?>
        <?php if ($digg!== '' && $icon < 4) { $icon++;?>
<div id="digg"> <a  target="_blank" href="<?php  echo esc_url($digg);  ?>"  ><i class="fa fa-digg"></i></a></div>
        <?php } ?>
        <?php if ($flickr!== '' && $icon < 4) { $icon++;?>
 <div id="flickr"> <a  target="_blank" href="<?php  echo esc_url($flickr);  ?>"  ><i class="fa fa-flickr"></i></a></div>
        <?php } ?>
        <?php if ($instagram!== '' && $icon < 4) { $icon++;?>
<div id="instagram"> <a  target="_blank" href="<?php  echo esc_url($instagram);  ?>"  ><i class="fa fa-instagram"></i></a></div>
        <?php } ?>
        <?php if ($gplus!== '' && $icon < 4) { $icon++;?>
<div id="gplus"> <a  target="_blank" href="<?php  echo esc_url($gplus);  ?>"  ><i class="fa fa-google-plus"></i></a></div>
        <?php } ?>
        <?php if ($mail!== '' && $icon < 4) { $icon++;?>
        <div id="member_email"> <a  target="_blank" href="<?php  echo esc_url($mail);  ?>"  ><i class="fa fa-envelope-o"></i></a></div>
        <?php } ?>
    </div>
 
  </div>
    
    <div class="member_desc"><?php $small_desc = substr($desc,0,200); $small_desc .= '...'; echo !empty( $small_desc ) ? $small_desc : ''; ?></div>


</div>
</div>


<?php }


           elseif ($type == "type02") { ?>
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
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble); ?>"  ><i class="fa fa-dribbble"></i></a></div>
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



   elseif ($type == "type03") { ?>
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


   elseif ($type == "type04") { ?>
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


   elseif ($type == "type05") { ?>
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
    <div class="member_desc"><?php $small_desc = substr($desc,0,120); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>" class="staff_button"><?php echo __('Read More', 'thefoxwp'); ?></a></div>
  </div>
    


</div>
</div>


<?php }



   elseif ($type == "type06") { $icon = 0; ?>
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
    <div class="member_desc"><?php $small_desc = substr($desc,0,160); $small_desc .= '...';  echo !empty( $small_desc ) ? $small_desc : ''; ?></div>
  </div>
    


</div>
</div>


<?php }



   elseif ($type == "type07") { $icon = 0; ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p07 ajax_post <?php echo esc_attr($echoallterm); ?>">
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

			<div class="member-info">
		    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>
		    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
			</div>


		</div>
    </div>
</div>

<?php }



   elseif ($type == "type08") { $icon = 0; ?>
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



   elseif ($type == "type09") { $icon = 0; ?>
<div data-category="<?php echo esc_attr($echoallterm); ?>" class="staff_post rd_staff_p09 ajax_post <?php echo esc_attr($echoallterm); ?>">
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

			<div class="member-info">
		    <h3><a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php echo the_title() ?></a></h3>
		    <span class="position" ><?php echo !empty( $position ) ? $position : ''; ?></span>
			</div>


		</div>
    </div>
</div>

<?php }


 if($type !== "type01" && $type !== "type02" && $type !== "type03" && $type !== "type04" && $type !== "type05" && $type !== "type06" && $type !== "type07" && $type !== "type08" && $type !== "type09" ){ ?>
<div class="carousel_recent_post team-member staff_post ajax_post <?php echo esc_attr($echoallterm); ?>">
    <div class="recent_port_ctn clearfix">

  
         <div class="member-photo s_effect">

    <div class="bw-wrapper">       <a href="<?php echo the_permalink() ?>" target="<?php echo esc_attr($l_target); ?>"><?php if($type == 'rstaff_02'){  echo the_post_thumbnail( array(586, 440), array('title' => "")); }else{ echo the_post_thumbnail( 'staff_tn', array('title' => "")); } ?> 
  </a> <?php if($type == 'rstaff_01'){ ?>   
    
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
<div id="dribbble"><a  target="_blank" href="<?php  echo esc_url($dribbble); ?>"  ><i class="fa fa-dribbble"></i></a></div>
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
	unset($echoallterm, $pf); endwhile;  }


 if($blog_navigation == 'loadmore_nav' ) { ?>
<div class="blog_load_more_cont"><a class="btn_load_more get_blog_posts_btn" href="#"><span class="fa-plus refresh_icn"></span><?php echo __('Load More','thefoxwp'); ?></a></div><div class="clear"><!-- ClearFix --></div>
<?php } ?>



</div>
<?php 
if($blog_navigation == 'classic_nav'){ ?>

<!-- .navigation -->

     <div class="navigation clearfix">

        <?php kriesi_pagination($maxpages); echo "<span class='pagination_current_position'>". __("Page", "rdesign").' '.$current."/".$maxpages."</span>"; ?>

      </div>

<!-- .navigation END -->

<?php }

$output_string = ob_get_contents();
ob_end_clean();

return $output_string; } 
       
        add_shortcode('staff_post_sc', 'staff_post_sc');




?>