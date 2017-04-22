<?php
$post=$wp_query->post;

if(get_post_type() == 'portfolio'){
	include(TEMPLATEPATH.'/single-portfolio.php');
}elseif(get_post_type() == 'partners'){
	include(TEMPLATEPATH.'/single-staff.php');
}
else{
	include(TEMPLATEPATH.'/single-default.php');
}

?>