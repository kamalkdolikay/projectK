<?php



/*

Template Name: 404

*/

get_header();
$allsearch = new WP_Query("s=$s&posts_per_page=-1");
$key = esc_html($s, 1);
$count = $allsearch->post_count;
global $rd_data;
?>

<div class="page_title_ctn">
  <div class="wrapper table_wrapper">
<?php  if ($rd_data['rd_error_title'] == '') {
echo   '<h1>'.__('Error 404','thefoxwp').'</h1>';
}else{
echo   '<h1>'.$rd_data['rd_error_title'].'</h1>';
}
?>
</div>
</div>

<div class="section def_section">
  <div class="wrapper section_wrapper"><?php
if ($rd_data['rd_error_text'] !== ''){
	echo '<h2 class="pnf_main_text">'.$rd_data['rd_error_text'].'</h2>';
}else{
	echo '<h2 class="pnf_main_text">'.__('Oops, This Page Could Not Be Found!','thefoxwp').'</h2>';
  	
   }
if ($rd_data['rd_error_subtext'] !== ''){
	echo '<p class="pnf_sub_text">'.$rd_data['rd_error_subtext'].'</p>';
}else{
	echo '<p class="pnf_sub_text">'.__('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.','thefoxwp').'</p>';
}

if ($rd_data['rd_error_img']['url'] !== ''){
	echo '<div class="pnf_img"><img =src="'.$rd_data['rd_error_img']['url'].'" /></div>';
}else{
	echo '<div class="pnf_img"><img src="'.get_stylesheet_directory_uri().'/images/404_default.png" /></div>';
}

echo '<div class="pnf_search">'.do_shortcode('[rd_search t_color="'.$rd_data['rd_content_text_color'].'" bg_color="'.$rd_data['rd_content_bg_color'].'" b_color="'.$rd_data['rd_content_border_color'].'" placeholder="'.__('Search','thefoxwp').'" width="570" radius="2" margin_top="0" margin_bottom="0"]').'</div>';
 ?> 

    <div class="clearfix"></div>
  </div>
<!-- #page_content END -->
</div>
<?php get_footer(); ?>
