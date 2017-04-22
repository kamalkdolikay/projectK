<?php 

/*-----------------------------------------------------------------------------------*/



/*  Search shortcode



/*-----------------------------------------------------------------------------------*/




function rd_search( $atts, $content ){

extract( shortcode_atts( array(
        't_color' => '',
        'bg_color' => '',
        'b_color' => '',
        'h_color' => '',
        'placeholder' => '',
        'margin_top' => '',
        'margin_bottom' => '',
		'animation' => '',
		'width' => '',
		'radius' => '',
	), $atts ) );
ob_start();

$id = RandomString(20);	
global $rd_data; 

if($t_color == '' ){
$t_color = $rd_data['rd_content_text_color'];
	
}if($b_color == '' ){
$b_color = $rd_data['rd_content_border_color'];
	
}
if($bg_color == '' ){
$bg_color = $rd_data['rd_content_bg_color'];
	
}if($h_color == '' ){
$h_color = $rd_data['rd_content_hover_color'];
	
}if($placeholder == '' ){
$placeholder = "Search";
	
}
if ($width !== ''){
echo '<style>#rd_'.$id.' {width:'.$width.'px;}</style>';
}
echo '<style>#rd_'.$id.' {margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;}#rd_'.$id.' #search input[type=text]{background:'.$bg_color.'; border:1px solid '.$b_color.'; color:'.$t_color.'; border-radius:'.$radius.'px;}#rd_'.$id.' #search input[type=submit]{color:'.$t_color.'}#rd_'.$id.' #search input[type=submit]:hover{color:'.$h_color.'}</style>';
echo '<div class="rd_search_sc '.$animation.'" id="rd_'.$id.'"><div id="search">';

?><form method="get" action="<?php echo esc_url(home_url("")); ?>"><input type="text" name="s" placeholder="<?php echo esc_attr($placeholder);?>" class="search"  value="<?php echo the_search_query(); ?>"/><input type="submit" id="searchsubmit" value=""></form>

			</div></div> <?php

$output_string = ob_get_contents();
ob_end_clean();
return $output_string; 
}
add_shortcode( 'rd_search', 'rd_search' );

?>