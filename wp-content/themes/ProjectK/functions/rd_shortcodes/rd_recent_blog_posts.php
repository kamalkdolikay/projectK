<?php 

/*-----------------------------------------------------------------------------------*/



/*  Blog shortcode



/*-----------------------------------------------------------------------------------*/


function recent_blog_sc($atts, $content = null)
        {
            extract(shortcode_atts(array(
                'heading_size' => '' ,
                'heading_color' => '',
				'type' => '',
                'heading_text' => '',
                'posts_per_page' => '10',
                'category' => 'all',
				'blog_bg_color' => '',
				'blog_text_color' => '',
				'blog_heading_color' => '',
				'blog_hover_color' => '',
				'blog_hl_color' => '',
				'blog_border_color' => '',
				'blog_timelinedb_color' => '',
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


$rp_id = RandomString(20);

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




wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting_bp', get_template_directory_uri() . '/js/sorting_bp.js');
wp_enqueue_script('js_refresh_bp', get_template_directory_uri() . '/js/refresh_bp.js');


$items_on_start = $posts_per_page; 
$items_per_click = $blog_click;
$view_type = $type;    
$category = $category;  

$output ='<style>';

if($blog_navigation !== '' ) {


$output .= '#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more{background:'.$button_bg.'; color:'.$button_title.'; border:1px solid '.$button_border.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more .refresh_icn:before{color:'.$button_title.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more:hover{background:'.$button_hover_bg.'; color:'.$button_hover_title.'; border:1px solid '.$button_hover_bg.';}#rp_'.$rp_id.' .blog_load_more_cont .btn_load_more:hover .refresh_icn:before{color:'.$button_hover_title.';}';
}


if($type == 'type01' ) {
$column = 'blog_3_col';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info,#rp_'.$rp_id.' .rp_post_info a{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_time:before,#rp_'.$rp_id.' .rp_post_comment:before,#rp_'.$rp_id.' .rp_post_cat:before{color:'.$blog_hl_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-40px;}';

}


if($type == 'type02' ) {
$column = 'blog_2_col';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.'; border-color:'.$blog_border_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a{color:'.$blog_hl_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_time{background:'.$blog_heading_color.'; color:#fff;}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}


if($type == 'type03' ) {
$column = 'blog_2_col';
$output .='#rp_'.$rp_id.' .post_ctn,#rp_'.$rp_id.' .rp_post_info{border-color:'.$blog_border_color.';}';
$output .='#rp_'.$rp_id.' .post_ctn{background:'.$blog_bg_color.';}';
$output .='#rp_'.$rp_id.' .post_ctn:hover{background:'.$rd_data['rd_content_bg_color'].'; color:'.$rd_data['rd_content_text_color'].'}';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info {background:'.$rd_data['rd_content_bg_color'].';}';
$output .='#rp_'.$rp_id.' .rp_post_info a{color:'.$rd_data['rd_content_text_color'].';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';
$output .='#rp_'.$rp_id.' .rp_type03 .rp_image,#rp_'.$rp_id.' .rp_type03 .rp_gallery,#rp_'.$rp_id.' .rp_type03 .rp_quote,#rp_'.$rp_id.' .rp_type03 .rp_video,#rp_'.$rp_id.' .rp_type03 .rp_normal,#rp_'.$rp_id.' .rp_type03 .rp_audio{background:'.$blog_hl_color.';}';

}


if($type == 'type04' ) {
$column = 'blog_2_col';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info,#rp_'.$rp_id.' .rp_post_info a{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_time:before,#rp_'.$rp_id.' .rp_post_comment:before,#rp_'.$rp_id.' .rp_post_cat:before{color:'.$blog_hl_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-40px;}';

}

if($type == 'type05' ) {
$column = 'blog_2_col';
$output .='#rp_'.$rp_id.' .post_ctn,#rp_'.$rp_id.' .rp_post_info,#rp_'.$rp_id.' .rp_post_cat,#rp_'.$rp_id.' .rp_post_author{border-color:'.$blog_border_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}



if($type == 'type06' ) {
$column = 'blog_3_col';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info a:hover{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}


if($type == 'type07' ) {
$column = 'blog_2_col';	
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a,#rp_'.$rp_id.' .rp_post_info{color:'.$blog_hl_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info:hover,#rp_'.$rp_id.' .rp_post_info:hover a{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}


if($type == 'type08' ) {
$column = 'blog_4_col';
$output .='#rp_'.$rp_id.' .rp_type08:hover .post-title,#rp_'.$rp_id.' .rp_post_time{background:'.$blog_hl_color.';}';
$output .='#rp_'.$rp_id.' .rp_type08 .rp_post_info a{color:'.$blog_text_color.';}#rp_'.$rp_id.' .rp_type08:hover .rp_post_info a{color:#fff;}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}



if($type == 'type09' ) {
$column = 'blog_3_col';
$output .='#rp_'.$rp_id.' .post-attachement{border-color:'.$blog_border_color.';}#rp_'.$rp_id.' .rp_entry{border-top-color:'.$blog_border_color.';}';
$output .='#rp_'.$rp_id.' .post_ctn{background:'.$blog_bg_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a,#rp_'.$rp_id.' .rp_post_info{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info:hover,#rp_'.$rp_id.' .rp_post_info:hover a{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';

}


if($type == 'type10' ) {
$column = 'blog_2_col';
$output .='#rp_'.$rp_id.' .post_ctn,#rp_'.$rp_id.' .rp_type10 .post-attachement:before{background:'.$blog_bg_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a{color:'.$blog_heading_color.';}';
$output .='#rp_'.$rp_id.' .rp_post_info a,#rp_'.$rp_id.' .rp_post_info{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .rp_entry{color:'.$blog_text_color.';}';
$output .='#rp_'.$rp_id.' .post-title h2 a:hover,#rp_'.$rp_id.' .rp_post_info:hover,#rp_'.$rp_id.' .rp_post_info:hover a{color:'.$blog_hover_color.';}';
$output .='#rp_'.$rp_id.' .blog_load_more_cont {bottom:-70px;}';
$output .='#rp_'.$rp_id.' .rp_type10:hover .rp_image,#rp_'.$rp_id.' .rp_type10:hover .rp_gallery,#rp_'.$rp_id.' .rp_type10:hover .rp_quote,#rp_'.$rp_id.' .rp_type10:hover .rp_video,#rp_'.$rp_id.' .rp_type10:hover .rp_normal,#rp_'.$rp_id.' .rp_type10:hover .rp_audio{background:'.$blog_hl_color.';}';

}


$output .='</style>';

echo !empty( $output ) ? $output : '';
	
	 ?>
<script>



jQuery.noConflict();
var $ = jQuery;
"use strict";
$(document).ready(function(){


   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                var html_template = "<?php echo esc_js($view_type); ?>";
                var column = "<?php echo esc_js($column); ?>";
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
                        data: "html_template="+html_template+"&now_open_works="+now_open_works+"&action=get_blog_posts"+"&works_per_load="+works_per_load+"&column="+column+"&first_load="+first_load+"&category=<?php echo esc_js($category); ?>",
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
							   
							   $(window).trigger('resize');
							   
							});


$(".wpb_row:empty").remove();
$(".wpb_column:empty").remove();
$(".wpb_wrapper:empty").remove();
$(".post-attachement").fitVids();
$(".entry").fitVids();
$(".video_sc").fitVids();

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


$('.love-it').click(function() {
		var $this = $(this);	
		var post_id = $this.data('post-id');
		var user_id = $this.data('user-id');
		var data = {
			action: 'love_it',
			item_id: post_id,
			user_id: user_id,
			love_it_nonce: love_it_vars.nonce
		};
		
		// don't allow the user to love the item more than once
		if($this.hasClass('loved')) {
			return false;
		}	
		if(love_it_vars.logged_in == 'false' && $.cookie('loved-' + post_id)) {
			return false;
		}
		
		$.post(love_it_vars.ajaxurl, data, function(response) {
			if(response == 'loved') {
				$this.addClass('loved');
				var count_wrap = $this.find('span');
				var count = count_wrap.text();
				count_wrap.text(parseInt(count) + 1);
				if(love_it_vars.logged_in == 'false') {
					$.cookie('loved-' + post_id, 'yes', { expires: 1 });
				}
			} else {
			}
		});
		return false;
	});	
	
	$('.love-it').removeClass('love-it');
	

$('.love-it-wrapper .post_love_link').click(function () {
	
	
$(this).parents('div[class^="rp_like"]').css('background','#ef584d');
	
});


$('.loved').parents('div[class^="rp_like"]').css('background','#ef584d');
							
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
                get_blog_posts();
					$(window).trigger('resize');							
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


});});


</script>

<div class="masonry_ctn <?php echo esc_attr($column); ?>" id="rp_<?php echo esc_attr($rp_id); ?>">

<?php if($blog_navigation !== '' ) { ?>



<div class="blog_load_more_cont"><a class="btn_load_more get_blog_posts_btn" href="#"><span class="fa-plus refresh_icn"></span><?php echo __('Load More','thefoxwp'); ?></a></div><div class="clear"><!-- ClearFix --></div>

<?php } ?>
</div>
<?php 



$output_string = ob_get_contents();
ob_end_clean();

return $output_string; } 
       
        add_shortcode('recent_blog_sc', 'recent_blog_sc');




?>