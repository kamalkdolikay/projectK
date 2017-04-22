<?php
function get_content($more_link_text = '(more...)', $stripteaser = 0, $more_file = '')
{
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
//////////// Limit the excerpt lenght , default 20 ( you can modify the lenght by changing the return number) ////////////

function new_excerpt_more($more) {

    global $post;
	
	global $rd_data;

	return '<br/><a href="'. get_permalink($post->ID) . '" class="more">'. __("Read more" ,"rdesign") .'</a>';
}

add_filter('excerpt_more', 'new_excerpt_more');
add_filter( 'get_the_excerpt', 'shortcode_unautop');
add_filter( 'get_the_excerpt', 'do_shortcode');

// Create the Custom Excerpts callback
function rd_custom_excerpt($length_callback = '', $more_callback = '')
{
	
	
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
	
	$output = the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
   
  
ob_start();
  
	echo '<p>';
	echo !empty( $output ) ? $output : '';
	echo '</p>';
	
	
$output_string = ob_get_contents();
ob_end_clean();
	
echo !empty( $output_string ) ? $output_string : '';	
	
}
// Custom Length 
function rd_port_excerpt($length) {
    return 35;
}
function rd_port_long_excerpt($length) {
    return 55;
}

function rd_related_excerpt($length) {
    return 35;
}

function rd_staff_excerpt($length) {
    return 30;
}

function rd_staff2_excerpt($length) {
    return 19;
}

function rd_staff3_excerpt($length) {
    return 25;
}

function rd_bp_excerpt($length) {
    return 16;
}

function rd_rp_excerpt($length) {
    return 22;
}

function rd_cp_excerpt($length) {
    return 13;
}

function rd_widget_excerpt($length) {
    return 12;
}
function rd_port_more($more){
global $post;
return '';
}
function rd_related_more($more){
global $post;
return '<a href="'.get_permalink().'" class="more-link">'. __('Read more','thefoxwp'). '</a>';
}
function rd_trend_more($more){
global $post;
return '<a href="'.get_permalink().'" class="more">'. __('Read more >','thefoxwp'). '</a>';
}


?>