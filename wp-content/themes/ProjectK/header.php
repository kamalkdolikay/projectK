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
if ($rd_data['rd_custom_favicon']['url'] !== '') { ?>
<link rel="shortcut icon" href="<?php echo esc_url($rd_data['rd_custom_favicon']['url']) ?>"/>
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/fav.png"/>
<?php } ?>
<script>
mixajaxurl = "<?php echo get_option("siteurl") ?>/wp-admin/admin-ajax.php";
</script>
<!-- html5.js for IE less than 9 -->
<!--[if lt IE 9]>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<!--<![endif]-->
<!-- css3-mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<!--<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:100,200,300,700,800,900' rel='stylesheet' type='text/css'>
<?php  

global $rd_data;
$nav_type = $rd_data['rd_nav_type'];
$topbar_type = $rd_data['rd_topbar_type'];
wp_head(); ?>
</head>

<body <?php body_class(); if($nav_type == 'nav_type_15' ||  $nav_type == 'nav_type_16' ||  $nav_type == 'nav_type_17' ||  $nav_type == 'nav_type_18') { echo 'id="header_sub_nav"'; }elseif ($nav_type == 'nav_type_19' ||  $nav_type == 'nav_type_19_f') { echo 'id="fixed_body_left"'; }?> >
<?php if($rd_data['rd_loader'] == 'yes'){ 
if($rd_data['rd_loader_type'] == 'simple_loader'){ 
?>
<div id="jpreOverlay" class="<?php echo esc_attr($rd_data['rd_loader_style']); ?>">
  <div id="preloader_3"></div>
  <div id="jpreLoader">
    <div id="jpreBar"></div>
  </div>
  <div id="jprePercentage">0%</div>
  <img class="pre_dummy_img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/loader.gif"/></div>
<?php }else{ ?>
<div id="jpreOverlay" class="<?php echo esc_attr($rd_data['rd_loader_style']); ?> tf_complex_loader">
  <div id="jpreLoader">
    <div id="jpreBar"></div>
  </div>
  <div class='thefox_bigloader'>
    <div class='thefox_loader_line'>
      <div class='loader_tophalf'></div>
      <div class='loader_inner'></div>
      <div class='loader_bottomhalf'></div>
      <div class='loader_button'></div>
    </div>
    <div class='thefox_loader_logo_bg'></div>
    <div class='thefox_loader_logo'>
      <?php if($rd_data['rd_loader_logo']['url'] !== ''){ ?>
      <img  src="<?php echo esc_url($rd_data['rd_loader_logo']['url']); ?>"/>
      <?php } ?>
    </div>
    <div id="jprePercentage">0%</div>
  </div>
  <img class="pre_dummy_img" src="<?php echo get_template_directory_uri(); ?>/images/loader.gif"/></div>
<?php } } 

//Set boxed layout

if($rd_data['rd_boxed'] == true) { 

echo '<div id="boxed_layout" class="menu_slide">';

 } ?>
<div id="top_bg" <?php if($rd_data['rd_boxed'] == false) { echo 'class="menu_slide"'; } ?> >
<?php 


do_action( '__before_header' );


//Set top bar

if($rd_data['rd_topbar']== 'yes'){ ?>
<div id="top_bar" class="<?php echo esc_attr($topbar_type); ?>">
  <div class="wrapper">
    <?php if ( $rd_data['rd_topbar_wpml'] == 'yes' && rd_check_wpml_status() == true) { ?>
    <div id="rd_wpml">
      <?php do_action('icl_language_selector'); ?>
    </div>
    <?php }
	
	
	if ( $rd_data['rd_topbar_icon'] == 'yes' && $rd_data['rd_topbar_icon_pos'] == 'left') { ?>
    <div id="header_socials" class="header_top_si si_float_left">
      <?php rd_social_icon(); if ($rd_data['rd_header_search'] == 'no' ){?>
      <div id="searchtop"> <a id="searchtop_img"><i class="fa fa-search"></i></a> </div>
      <?php } ?>
    </div>
    <?php }  if ($rd_data['rd_topbar_phone'] == 'yes') { ?>
    <div class="top_phone"><?php echo !empty( $rd_data['rd_topbar_phone_text'] ) ? $rd_data['rd_topbar_phone_text'] : '';  // accept HTML  ?></div>
    <?php } ?>
    <?php if ($rd_data['rd_topbar_mail'] == 'yes') { ?>
    <div class="top_email"><a href="mailto:<?php echo esc_attr($rd_data['rd_topbar_mail_text']); ?>" ><?php echo esc_html($rd_data['rd_topbar_mail_text']); ?></a></div>
    <?php } ?>
    <?php if ($rd_data['rd_topbar_news'] == 'yes') { ?>
    <div class="top_text"><?php echo !empty( $rd_data['rd_topbar_news_text'] ) ? $rd_data['rd_topbar_news_text'] : '';// accept HTML ?></div>
    <?php } ?>
    <?php  if($rd_data['rd_topbar_menu'] == 'yes'){ ?>
    <div class="top_bar_menu">
      <?php wp_nav_menu( array(
	  
		    'theme_location' => 'top-bar',

			'container' => '', 

            'before' => '',

                    ) ); 
 ?>
    </div>
    <?php } if ( $rd_data['rd_topbar_icon'] == 'yes' && $rd_data['rd_topbar_icon_pos'] == 'right') { ?>
    <div id="header_socials" class="header_top_si si_float_right">
      <?php rd_social_icon(); if ($rd_data['rd_header_search'] == 'no' ){?>
      <div id="searchtop"> <a id="searchtop_img"><i class="fa fa-search"></i></a> </div>
      <?php } ?>
    </div>
    <?php }if(rd_check_woo_status() == true && $rd_data['rd_header_cart'] !== 'yes' && $rd_data['rd_topbar_cart'] == 'yes' ){ global $woocommerce;?>
    <ul class="header_current_cart">
      <li><a class="cart-content-tb <?php echo esc_attr($rd_data['rd_topbar_cart_type']); if($rd_data['rd_topbar_cart_text'] == 'no'){ echo ' t_none'; } ?>" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"> <?php echo __('My Cart','thefoxwp'); ?></a>
        <div class="cart-notification"><span class="item-name"></span>&nbsp;<?php echo __(' was successfully added to your cart.', 'thefoxwp'); ?></div>
        <ul class="header_cart_dropdown cdp_2">
          <div class="widget_shopping_cart_content"></div>
        </ul>
      </li>
    </ul>
    <?php }
	 
	 if ($rd_data['rd_topbar_login'] == 'yes' && rd_check_woo_status() == true ){
	echo '<div class="topbar_woocommerce_login '.$rd_data['rd_topbar_login_type'].'">';
	
	 if ( is_user_logged_in() ) { ?>
    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>" class="topbar_signed_in">
    <?php _e('My Account','woothemes'); ?>
    </a>
    <?php } 
 else { ?>
    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>" class="topbar_sign_in">
    <?php _e('Sign in','woothemes'); ?>
    </a>
    <?php if($rd_data['rd_topbar_login_type'] == 'type1'){ echo ' or '; }?>
    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>" class="topbar_register">
    <?php _e('Join now','woothemes'); ?>
    </a>
    <?php } echo '</div>'; }  ?>
  </div>
</div>
<!--top bar END -->
<?php } ?>
<div id="header_container">
<!-- header -->
<header  class="<?php if ($nav_type !== 'nav_type_15' && $nav_type !== 'nav_type_16' && $nav_type !== 'nav_type_17' && $nav_type !== 'nav_type_18' && $nav_type !== 'nav_type_19' && $nav_type !== 'nav_type_19_f' ){echo 'header_shadow sticky_header '.$nav_type.''; }elseif($nav_type == 'nav_type_19'){ echo 'fixed_header_left';}elseif($nav_type == 'nav_type_19_f'){ echo 'fixed_header_left absolute_navigation';}else{ echo esc_attr($nav_type);} ?> clearfix" >
<div class="wrapper">
<!-- logo -->
<?php 
	if ($rd_data['rd_logo']['url'] !== '' && $rd_data['rd_mobile_logo']['url'] !== '') { ?>
<div id="logo_img"><a href="<?php echo home_url(''); ?>"><img class="dark_logo desktop_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_white_logo']['url']);}else{echo esc_url($rd_data['rd_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="white_logo desktop_logo" src="<?php echo esc_url($rd_data['rd_white_logo']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="dark_logo mobile_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_mobile_white_logo']['url']);}else{echo esc_url($rd_data['rd_mobile_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="white_logo mobile_logo" src="<?php echo esc_url($rd_data['rd_mobile_white_logo']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a></div>



<?php }elseif($rd_data['rd_logo']['url'] !== '' ) { ?>
<div id="logo_img"><a href="<?php echo home_url(''); ?>"><img class="dark_logo desktop_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_white_logo']['url']);}else{echo esc_url($rd_data['rd_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="white_logo desktop_logo" src="<?php echo esc_url($rd_data['rd_white_logo']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="dark_logo mobile_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_white_logo']['url']);}else{echo esc_url($rd_data['rd_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/><img class="white_logo mobile_logo" src="<?php echo esc_url($rd_data['rd_white_logo']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a></div>


<?php }else { ?>
<div class="logo_text"><a href="<?php echo home_url(''); ?>">
  <p>
    <?php bloginfo('name'); ?>
  </p>
  </a></div>
<?php } ?>
<!-- logo END-->

<?php if ($nav_type == 'nav_type_15' && $rd_data['rd_topbar_icon'] !== 'yes'|| $nav_type == 'nav_type_16' && $rd_data['rd_topbar_icon'] !== 'yes' || $nav_type == 'nav_type_17' && $rd_data['rd_topbar_icon'] !== 'yes' ) { ?>
<div id="header_socials" class="header_si" >
  <?php  rd_social_icon(); echo ' </div>'; } ?>
  
  <!-- menu -->
  <?php if ($nav_type == 'nav_type_15' || $nav_type == 'nav_type_16' || $nav_type == 'nav_type_17' || $nav_type == 'nav_type_18') { ?>
  </header>
  <div class="header_bottom_nav header_shadow sticky_header <?php echo esc_attr($nav_type); ?> clearfix" >
    <div class="wrapper tf_o_visible">
      <?php if(rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' && $nav_type =='nav_type_15' || rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' && $nav_type =='nav_type_16' || rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' && $nav_type =='nav_type_17' || rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' && $nav_type =='nav_type_18'){ global $woocommerce; ?>
      <ul class="header_current_cart">
        <div class="current_item_number"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div>
        <li><a class="cart-content" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"> </a>
          <div class="cart-notification"><span class="item-name"></span>&nbsp;<?php echo __(' was successfully added to your cart.', 'thefoxwp'); ?></div>
          <ul class="header_cart_dropdown cdp_2">
            <div class="widget_shopping_cart_content"></div>
          </ul>
        </li>
      </ul>
      <?php }  ?>
      <div id="search-form">
        <form method="get" action="<?php echo home_url(''); ?>" id="searchform">
          <input type="text" name="s" placeholder="Search" class="search" id="ssform"   value="<?php the_search_query(); ?>" />
          <input type="submit" id="searchsubmit" value="" />
          <span class="search_button_icon"></span>
        </form>
      </div>
      <div id="searchtop"> <a id="searchtop_img"><i class="fa fa-search"></i></a> </div>
      <?php }?>
      <?php if(rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' && $nav_type !=='nav_type_15' && $nav_type !=='nav_type_16' && $nav_type !=='nav_type_17' && $nav_type !=='nav_type_18'&& $nav_type !=='nav_type_19' && $nav_type !=='nav_type_19_f'){ global $woocommerce; ?>
      <ul class="header_current_cart">
        <div class="current_item_number"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div>
        <li><a class="cart-content" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>"> </a>
          <div class="cart-notification"><span class="item-name"></span>&nbsp;<?php echo __(' was successfully added to your cart.', 'thefoxwp'); ?></div>
          <ul class="header_cart_dropdown cdp_2">
            <div class="widget_shopping_cart_content"></div>
          </ul>
        </li>
      </ul>
      <?php 
 } if ($rd_data['rd_header_search'] == 'yes' && $nav_type !== 'nav_type_15'  && $nav_type !== 'nav_type_16'  && $nav_type !== 'nav_type_17'  && $nav_type !== 'nav_type_18' && $nav_type !== 'nav_type_19' && $nav_type !== 'nav_type_19_f'){ ?>
      <div id="search-form">
        <form method="get" action="<?php echo home_url(''); ?>" id="searchform">
          <input type="text" name="s" placeholder="Search" class="search" id="ssform"  value="<?php the_search_query(); ?>" />
          <input type="submit" id="searchsubmit" value="" />
          <span class="search_button_icon"></span>
        </form>
      </div>
      <div id="searchtop"> <a id="searchtop_img"><i class="fa fa-search"></i></a> </div>
      <?php }



		echo '<nav class="'.$nav_type.'">';
		
			wp_nav_menu( array(

		    'theme_location' => 'main-menu',

			'container' => '', 

            'before' => '',
			
			'fallback_cb' => 'please_set_menu',
			
			'walker' => new rd_megamenu_walker
                    
			)
			); 

          ?>
      </nav>
      <!-- menu END-->
      <?php if ($rd_data['rd_header_search'] == 'yes' && $nav_type == 'nav_type_19'  || $rd_data['rd_header_search'] == 'yes' && $nav_type == 'nav_type_19_f'){?>
      <div id="edge-search-form">
        <form method="get" action="<?php echo home_url(''); ?>" id="searchform">
          <input type="text" name="s" placeholder="Search" class="search" id="ssform"  value="<?php the_search_query(); ?>" />
          <input type="submit" id="searchsubmit" value="" />
          <span class="search_button_icon"></span>
        </form>
      </div>
      <?php }  if ($nav_type == 'nav_type_19' && $rd_data['rd_header_socials'] == 'yes' || $nav_type == 'nav_type_19_f' && $rd_data['rd_header_socials'] == 'yes'){ ?>
      <div id="fixed_header_socials" class="header_si" >
        <?php rd_social_icon(); ?>
      </div>
      <?php }  ?>
    </div>
  </div>
  <?php if ($nav_type !== 'nav_type_15' && $nav_type !== 'nav_type_16' && $nav_type !== 'nav_type_17' && $nav_type !== 'nav_type_18') { ?>
  </header>
  <!-- header END-->
  <?php }else{ ?>
</div>
<?php } ?>
