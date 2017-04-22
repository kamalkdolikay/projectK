<?php
// Generate random string 

function PTid(){

$postids = array();
$latest_category_posts = get_posts('post_type=pricetable&showposts=1000');
foreach ($latest_category_posts as $catpost) {
	
$thetitle = get_the_title( $catpost->ID );
	$postids[$thetitle] = $catpost->ID;
}

return $postids;

}

function RandomString($length) {
	
	$key = null;

    $keys = array_merge(range(0,9), range('a', 'z'));

    for($i=0; $i < $length; $i++) {

        $key .= $keys[array_rand($keys)];

    }

    return $key;

}

?>