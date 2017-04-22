<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php global $rd_data; ?>
<?php if($rd_data['rd_responsive']== true){ ?>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<?php } ?>
<title>
<?php wp_title('|', true, 'right'); ?>
</title>
<?php 
if ($rd_data['rd_custom_favicon']) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($rd_data['rd_custom_favicon']['url']); ?>"/>
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/fav.png"/>
<?php } ?>
<script>
mixajaxurl = "<?php echo get_option("siteurl") ?>/wp-admin/admin-ajax.php";
</script>
<!-- html5.js for IE less than 9 -->
<!--[if lt IE 9]>-->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js"></script>
<!--<![endif]-->
<!-- css3-mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]>-->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<!--<![endif]-->
<?php  

 global $rd_data;
$nav_type = $rd_data['rd_nav_type'];
$topbar_type = $rd_data['rd_topbar_type'];
 wp_head(); ?>
</head>

<body <?php body_class();?> id="<?php echo esc_attr($rd_data['rd_csp_style']); ?>">

<?php if($rd_data['rd_loader'] == 'yes'){ 
if($rd_data['rd_loader_type'] == 'simple_loader'){ 
?>
<div id="jpreOverlay" class="<?php echo esc_attr($rd_data['rd_loader_style']); ?>"><div id="preloader_3"></div><div id="jpreLoader"><div id="jpreBar"></div></div><div id="jprePercentage">0%</div><img class="pre_dummy_img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/loader.gif"/></div>

<?php }else{ ?>
<div id="jpreOverlay" class="<?php echo esc_attr($rd_data['rd_loader_style']); ?> tf_complex_loader"><div id="jpreLoader"><div id="jpreBar"></div></div><div class='thefox_bigloader'>

<div class='thefox_loader_line'>
<div class='loader_tophalf'></div>
<div class='loader_inner'></div>
<div class='loader_bottomhalf'></div>
<div class='loader_button'></div>
</div>

<div class='thefox_loader_logo_bg'></div>
<div class='thefox_loader_logo'>
<?php if(isset($rd_data['rd_csp_logo'])){ ?>
<img  src="<?php echo esc_url($rd_data['rd_loader_logo']['url']); ?>"/>
<?php } ?>
</div> 
<div id="jprePercentage">0%</div>
</div><img class="pre_dummy_img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/loader.gif"/></div>

<?php } } ?>