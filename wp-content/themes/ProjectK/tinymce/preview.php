<?php
// loads wordpress
require_once('get_wp.php'); // loads wordpress stuff
// gets shortcode
$shortcode =  $_GET['sc'] ;
if ($shortcode != '') {
$shortcode = str_replace('"', "^", $shortcode);
$newsc = $shortcode;
$newsc = str_replace('^', '"', $newsc);
}
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
<?php wp_head(); ?>
<style type="text/css">
html {
margin: 0 !important;
}
body {
padding: 20px 15px;
}
</style>
</head>
<body>
<?php echo do_shortcode( $newsc ); ?></body>


</html>