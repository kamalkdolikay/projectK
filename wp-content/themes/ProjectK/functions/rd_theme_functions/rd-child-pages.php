<?php
function wpb_list_child_pages() {

global $post;
 
if ( is_page() && $post->post_parent )
 
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
else
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
 
if ( isset($childpages) == true ) {
    $string = '<div class="rd_child_pages child_closed"  id="rd_child_pages"><ul class="child_pages_ctn">' . $childpages . '</ul></div>';
}
return $string;

}

?>