<?php

/*-----------------------------------------------------------------------------------*/

/* Output Custom CSS from theme options

/*-----------------------------------------------------------------------------------*/


function rd_head_css() {

	global $rd_data;
	$output = '';


/*-----------------------------------------------------------------------------------*/

/* Output custom CSS field 

/*-----------------------------------------------------------------------------------*/

	$custom_css = $rd_data['rd_custom_css'];
	if ($custom_css <> '') {
		$output .= $custom_css . "\n";
	}		




/*-----------------------------------------------------------------------------------*/

/* Set Boxed Layout

/*-----------------------------------------------------------------------------------*/

//set variable

	$boxed_margin = $rd_data['rd_topmargin'];
	$output .= '#boxed_layout{margin-top:'.$boxed_margin.'px; margin-bottom:'.$boxed_margin.'px;}';




/*-----------------------------------------------------------------------------------*/

/* Set Logo

/*-----------------------------------------------------------------------------------*/

//set variable

	$logo_width = $rd_data['rd_logo_width'];
	$output .= '#logo_img img{max-width:'.$logo_width.'px;}';




/*-----------------------------------------------------------------------------------*/

/* Set Mobile Menu

/*-----------------------------------------------------------------------------------*/

//set variable

	$mb_text = $rd_data['rd_mb_text'];
	$mb_hl = $rd_data['rd_mb_hl'];
	$mb_icon = $rd_data['rd_mb_icon'];
	$mb_bg = $rd_data['rd_mb_bg'];
	$mb_current = $rd_data['rd_mb_current'];
	$mb_sm = $rd_data['rd_mb_submenu'];
	$mb_s_sm = $rd_data['rd_mb_sub_submenu'];
	$mb_sm_icon = $rd_data['rd_mb_submenu_icon'];
	$mb_s_sm_text = $rd_data['rd_mb_sub_submenu_text'];
	
	$output .= '#mobile-menu{background:'.$mb_bg.'}#mobile-menu ul ul{background:'.$mb_sm.';}#mobile-menu ul ul ul{background:'.$mb_s_sm.';}';
	$output .= '#mobile-menu .mobile-ul-open > a{color:'.$mb_hl.'}#mobile-menu .mobile-ul-open:after{color:'.$mb_hl.' !important;}';
	$output .= '#mobile-menu .current_page_item{ background:'.$mb_current.';}#mobile-menu .current_page_item > a { border-left:2px solid '.$mb_hl.';}';
	$output .= '#mobile-menu ul li a{color:'.$mb_text.'}#mobile-menu .menu-item-has-children:after{color:'.$mb_icon.';}#mobile-menu ul li li li a{color:'.$mb_s_sm_text.'}#mobile-menu ul ul .menu-item-has-children:after{color:'.$mb_sm_icon.';}';
	$output .= '#mobile_menu_search #search input[type=text]{background:'.$mb_current.' !important; color:'.$mb_s_sm_text.';}#mobile_menu_search #search input[type=submit]{color:'.$mb_s_sm_text.';}';
		
	
	
/*-----------------------------------------------------------------------------------*/

/* Set Header Top Bar

/*-----------------------------------------------------------------------------------*/

//set variable

	$topbar_bg = $rd_data['rd_topbar_bg_color'];
	$topbar_text = $rd_data['rd_topbar_text_color'];
	$topbar_alttext = $rd_data['rd_topbar_textalt_color'];
	$topbar_hl = $rd_data['rd_topbar_hl_color'];
	$topbar_border_color = $rd_data['rd_topbar_border_color'];
	$topbar_topborder_color = $rd_data['rd_topbar_topborder_color'];

// Header default setting

	$output .='#top_bar,#rd_wpml #lang_sel ul ul{background:'.$topbar_bg.';}';

	
// Topbar_type_1 setting
	$output .='.topbar_type_1,.topbar_type_1 a,.topbar_type_1 #rd_wpml #lang_sel a{color:'.$topbar_text.';}.topbar_type_1 strong,.topbar_type_1 .topbar_woocommerce_login.type1 .topbar_sign_in,.topbar_type_1 .topbar_woocommerce_login.type1 .topbar_register,.topbar_type_1 .topbar_woocommerce_login.type1 .topbar_signed_in,.topbar_type_1 #rd_wpml #lang_sel li li a:hover{color:'.$topbar_alttext.';}';
	$output .='.topbar_type_1 .top_email:before,.topbar_type_1 .top_phone:before,.topbar_type_1 .top_text:before{color:'.$topbar_hl.';}';
	$output .='.topbar_type_1 .top_email,.topbar_type_1 .top_phone,.topbar_type_1 #header_socials,.topbar_type_1 .header_current_cart{border-right:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';	
	$output .='.topbar_type_1 .topbar_woocommerce_login{border-right:1px solid '.$topbar_border_color.'; border-left:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';
	$output .='.topbar_type_1 #rd_wpml,.topbar_type_1 .top_bar_menu{border-right:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_1 .wrapper > div:first-child {border-left:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_1 .topbar_woocommerce_login.type1 .topbar_register{ border:1px solid '.$topbar_border_color.'; border-bottom:2px solid '.$topbar_border_color.'}';			
	$output .='.topbar_type_1 .topbar_woocommerce_login.type2 .topbar_register{ border:1px solid '.$topbar_text.'; background:'.$topbar_text.'; color:'.$topbar_bg.';}';			
	$output .='.topbar_type_1 .topbar_woocommerce_login.type2 .topbar_sign_in,.topbar_type_1 .topbar_woocommerce_login.type2 .topbar_signed_in{ border:1px solid '.$topbar_text.';}';			
	$output .='.topbar_type_1 #header_socials a:hover{ color:'.$topbar_alttext.';}';	

// Topbar_type_2 setting
	$output .='.topbar_type_2,.topbar_type_2 a,.topbar_type_2 #rd_wpml #lang_sel a{color:'.$topbar_text.';}.topbar_type_2 strong,.topbar_type_2 .topbar_woocommerce_login.type1 .topbar_sign_in,.topbar_type_2 .topbar_woocommerce_login.type1 .topbar_register,.topbar_type_2 .topbar_woocommerce_login.type1 .topbar_signed_in,.topbar_type_2 #rd_wpml #lang_sel li li a:hover{color:'.$topbar_alttext.';}';
	$output .='.topbar_type_2 .top_email:before,.topbar_type_2 .top_phone:before,.topbar_type_2 .top_text:before{color:'.$topbar_hl.';}';
	$output .='.topbar_type_2 .top_email,.topbar_type_2 .top_phone,.topbar_type_2 #header_socials,.topbar_type_2 .header_current_cart{border-right:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';	
	$output .='.topbar_type_2 .topbar_woocommerce_login{border-right:1px solid '.$topbar_border_color.'; border-left:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';
	$output .='.topbar_type_2 { border-top:5px solid '.$topbar_topborder_color.';}';
	$output .='.topbar_type_2 #rd_wpml,.topbar_type_2 .top_bar_menu{border-right:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_2 .wrapper > div:first-child {border-left:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_2 .topbar_woocommerce_login.type1 .topbar_register{ border:1px solid '.$topbar_border_color.'; border-bottom:2px solid '.$topbar_border_color.'}';			
	$output .='.topbar_type_2 .topbar_woocommerce_login.type2 .topbar_register{ border:1px solid '.$topbar_text.'; background:'.$topbar_text.'; color:'.$topbar_bg.';}';			
	$output .='.topbar_type_2 .topbar_woocommerce_login.type2 .topbar_sign_in,.topbar_type_2 .topbar_woocommerce_login.type2 .topbar_signed_in{ border:1px solid '.$topbar_text.';}';		
	$output .='.topbar_type_2 #header_socials a:hover{ color:'.$topbar_alttext.';}';	

// Topbar_type_3 setting
	$output .='.topbar_type_3,.topbar_type_3 a,.topbar_type_3 #rd_wpml #lang_sel a{color:'.$topbar_text.';}.topbar_type_3 strong,.topbar_type_3 .topbar_woocommerce_login.type1 .topbar_sign_in,.topbar_type_3 .topbar_woocommerce_login.type1 .topbar_register,.topbar_type_3 .topbar_woocommerce_login.type1 .topbar_signed_in,.topbar_type_3 #rd_wpml #lang_sel li li a:hover{color:'.$topbar_alttext.';}';
	$output .='.topbar_type_3 .top_email:before,.topbar_type_3 .top_phone:before,.topbar_type_3 .top_text:before{color:'.$topbar_hl.';}';
	$output .='.topbar_type_2 { border-top:5px solid '.$topbar_topborder_color.';}';
	$output .='.topbar_type_3 .topbar_woocommerce_login.type1 .topbar_register{ border:1px solid '.$topbar_border_color.'; border-bottom:2px solid '.$topbar_border_color.'}';			
	$output .='.topbar_type_3 .topbar_woocommerce_login.type2 .topbar_register{ border:1px solid '.$topbar_text.'; background:'.$topbar_text.'; color:'.$topbar_bg.';}';			
	$output .='.topbar_type_3 .topbar_woocommerce_login.type2 .topbar_sign_in,.topbar_type_3 .topbar_woocommerce_login.type2 .topbar_signed_in{ border:1px solid '.$topbar_text.';}';				
	$output .='.topbar_type_3 #header_socials a:hover{ color:'.$topbar_alttext.';}';

// Topbar_type_4 setting
	$output .='.topbar_type_4,.topbar_type_4 a,.topbar_type_4 #rd_wpml #lang_sel a{color:'.$topbar_text.';}.topbar_type_4 strong,.topbar_type_4 .topbar_woocommerce_login.type1 .topbar_sign_in,.topbar_type_4 .topbar_woocommerce_login.type1 .topbar_register,.topbar_type_4 .topbar_woocommerce_login.type1 .topbar_signed_in,.topbar_type_4 #rd_wpml #lang_sel li li a:hover{color:'.$topbar_alttext.';}';
	$output .='.topbar_type_4 .top_email:before,.topbar_type_4 .top_phone:before,.topbar_type_4 .top_text:before{color:'.$topbar_hl.';}';
	$output .='.topbar_type_4 { border-top:5px solid '.$topbar_topborder_color.';}';
	$output .='.topbar_type_4 .topbar_woocommerce_login.type1 .topbar_register{ border:1px solid '.$topbar_border_color.'; border-bottom:2px solid '.$topbar_border_color.'}';			
	$output .='.topbar_type_4 .topbar_woocommerce_login.type2 .topbar_register{ border:1px solid '.$topbar_text.'; background:'.$topbar_text.'; color:'.$topbar_bg.';}';			
	$output .='.topbar_type_4 .topbar_woocommerce_login.type2 .topbar_sign_in,.topbar_type_4 .topbar_woocommerce_login.type2 .topbar_signed_in{ border:1px solid '.$topbar_text.';}';				
	$output .='.topbar_type_4 #header_socials a:hover{ color:'.$topbar_alttext.';}';
	
// Topbar_type_5 setting
	$output .='.topbar_type_5,.topbar_type_5 a,.topbar_type_5 #rd_wpml #lang_sel a{color:'.$topbar_text.';}.topbar_type_5 strong,.topbar_type_5 .topbar_woocommerce_login.type1 .topbar_sign_in,.topbar_type_5 .topbar_woocommerce_login.type1 .topbar_register,.topbar_type_5 .topbar_woocommerce_login.type1 .topbar_signed_in,.topbar_type_5 #rd_wpml #lang_sel li li a:hover,.topbar_woocommerce_login.type2 .topbar_sign_in:hover,.top_email a:hover{color:'.$topbar_alttext.';}';
	$output .='.topbar_type_5 .top_email:before,.topbar_type_5 .top_phone:before,.topbar_type_5 .top_text:before{color:'.$topbar_hl.'; }';	
	$output .='.topbar_type_5 .top_email,.topbar_type_5 .top_phone,.topbar_type_5 #header_socials,.topbar_type_5 .header_current_cart{border-right:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';
	$output .='.topbar_type_5 .topbar_woocommerce_login{border-right:1px solid '.$topbar_border_color.'; border-left:1px solid '.$topbar_border_color.'; padding-right:20px; padding-left:20px;}';
	$output .='.topbar_type_5 .wrapper > div:first-child {border-left:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_5 #rd_wpml,.topbar_type_5 .top_bar_menu{border-right:1px solid '.$topbar_border_color.';}';
	$output .='.topbar_type_5 { border-top:4px solid '.$topbar_topborder_color.'; border-bottom:1px solid '.$topbar_border_color.'}';
	$output .='.topbar_type_5 .topbar_woocommerce_login.type1 .topbar_register{ border:1px solid '.$topbar_border_color.'; border-bottom:2px solid '.$topbar_border_color.'}';			
	$output .='.topbar_type_5 .topbar_woocommerce_login.type2 .topbar_register{ border:1px solid '.$topbar_text.'; background:'.$topbar_text.'; color:'.$topbar_bg.';}';			
	$output .='.topbar_type_5 .topbar_woocommerce_login.type2 .topbar_sign_in,.topbar_type_5 .topbar_woocommerce_login.type2 .topbar_signed_in{ border:1px solid '.$topbar_text.';}';
	$output .='.topbar_type_5 #header_socials a:hover{ color:'.$topbar_alttext.';}';
	$output .='.header_current_cart .cart-content-tb.tbi-with-border{border:1px solid '.$topbar_border_color.';}.header_current_cart .cart-content-tb.tbi-with-bg{background:'.$topbar_border_color.';}.header_current_cart .cart-content-tb:before{color:'.$topbar_hl.';}.header_current_cart .cart-content-tb:hover{color:'.$topbar_text.';}';
	


/*-----------------------------------------------------------------------------------*/

/* Set Header & Navigation

/*-----------------------------------------------------------------------------------*/

//set variables

	$header_bg = $rd_data['rd_header_bg_color'];
	$transparent_header_bg = $rd_data['rd_transparent_header_bg_color']['rgba'];
	$header_border = $rd_data['rd_header_border_color'];
	$leftnav_border = $rd_data['rd_left_header_border_color'];
	$transparent_header_border = $rd_data['rd_transparent_header_border_color']['rgba'];
	$nav_bg = $rd_data['rd_menu_bg_color'];
	$nav_text = $rd_data['rd_menu_color'];
	$nav_current_text = $rd_data['rd_current_menu_color'];
	$nav_current_bg = $rd_data['rd_current_menu_bg_color'];
	
	
	$menu_custom_font = $rd_data['rd_custom_menu_font'];
	
	$nav_font_family = $rd_data['rd_menu_font']['font-family'];
	$nav_font_size =  $rd_data['rd_menu_font']['font-size'];
	$nav_font_weight =  $rd_data['rd_menu_font']['font-weight'];



	if($menu_custom_font == 1 ){
		
	$output .= '.nav_type_1 ul li a,.nav_type_2 ul li a,.nav_type_3 ul li a,.nav_type_4 ul li a,.nav_type_5 ul li a,.nav_type_6 ul li a,.nav_type_7 ul li a,.nav_type_8 ul li a,.nav_type_9 ul li a,.nav_type_10 ul li a,.nav_type_11 ul li a,.nav_type_12 ul li a,.nav_type_13 ul li a,.nav_type_14 ul li a,.nav_type_15 ul li a,.nav_type_16 ul li a,.nav_type_17 ul li a,.nav_type_18 ul li a{font-family:'.$nav_font_family.' !important; font-size:'.$nav_font_size.' !important; font-weight:'.$nav_font_weight.' !important; }';

	}

	

// Header default setting
	$output .='.transparent_header{background:'.$transparent_header_bg.'!important;}.transparent_header{border-bottom:1px solid '.$transparent_header_border.'!important;}';
	
	$output .='header,.mt_menu{background:'.$header_bg.';}header.transparent_header.opaque_header{background:'.$header_bg.' !important; border-bottom:none!important;}#nav_button:before,#nav_button_alt:before{color:'.$nav_text.';}.logo_text a{color:'.$nav_text.';}.transparent_header .logo_text a{color:#fff;}.transparent_header.opaque_header .logo_text a{color:'.$nav_text.';}';
	
// Nav_type_1 setting
	$output .='.nav_type_1 nav ul,.nav_type_1 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_1 ul li a,.nav_type_1 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_1 nav ul li a:hover,.nav_type_1 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';
	$output .='.nav_type_1 .cart-content:hover,.nav_type_1 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_2 setting
	$output .='header.nav_type_2{border-top:1px solid '.$header_border.';}';
	$output .='.nav_type_2 nav ul,.nav_type_2 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_2 ul li a,.nav_type_2 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_2 nav ul li a:hover,.nav_type_2 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:3px solid '.$nav_current_text.'; }';
	$output .='.nav_type_2 .cart-content:hover,.nav_type_2 #searchtop_img:hover i{color:'.$nav_current_text.';}';	

// Nav_type_3 setting	
	$output .='header.nav_type_3{border-top:1px solid '.$header_border.';}';
	$output .='.nav_type_3 nav ul,.nav_type_3 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_3 ul li a,.nav_type_3 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_3 nav ul li a:hover,.nav_type_3 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';
	$output .='.nav_type_3 .cart-content:hover,.nav_type_3 #searchtop_img:hover i{color:'.$nav_current_text.';}';

// Nav_type_4 setting	
	$output .='header.nav_type_4{border-top:1px solid '.$header_border.';}';
	$output .='.nav_type_4 nav ul,.nav_type_4 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_4 ul li a,.nav_type_4 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_4 nav ul li a:hover,.nav_type_4  > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';
	$output .='.nav_type_4 .cart-content:hover,.nav_type_4 #searchtop_img:hover i{color:'.$nav_current_text.';}';

	
// Nav_type_5 setting
	$output .='.nav_type_5 nav ul,.nav_type_5 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_5 ul li a{color:'.$nav_text.'; border-top:5px solid '.$nav_bg.';}';
	$output .='.nav_type_5 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_5 nav ul li a:hover,.nav_type_5 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:5px solid '.$nav_current_text.' !important; }';	
	$output .='.nav_type_5 .cart-content:hover,.nav_type_5 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_6 setting
	$output .='.nav_type_6 nav ul,.nav_type_6 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_6 ul li a{color:'.$nav_text.'; border-top:5px solid '.$nav_bg.';}';
	$output .='.nav_type_6 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_6 nav ul li a:hover,.nav_type_6 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:5px solid '.$nav_current_text.' !important;}';		
	$output .='.nav_type_6 .cart-content:hover,.nav_type_6 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_7 setting
	$output .='.nav_type_7 nav ul,.nav_type_7 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_7 ul li a,.nav_type_7 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_7 nav ul li a:hover,.nav_type_7 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';	
	$output .='.nav_type_7 .cart-content:hover,.nav_type_7 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_8 setting
	$output .='header.nav_type_8{border-top:1px solid '.$header_border.';}';
	$output .='.nav_type_8 nav ul,.nav_type_8 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_8 ul li a,.nav_type_8 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_8 nav ul li a:hover,.nav_type_8 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';
	$output .='.nav_type_8 .cart-content:hover,.nav_type_8 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_9 setting
	$output .='.nav_type_9 nav ul,.nav_type_9 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_9 ul li a{color:'.$nav_text.'; border-top:5px solid rgba(0,0,0,0);}';
	$output .='.nav_type_9 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_9 nav ul li a:hover,.nav_type_9 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:5px solid '.$nav_current_text.' !important;}';	
	$output .='.nav_type_9 .cart-content:hover,.nav_type_9 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_10 setting
	$output .='.nav_type_10 nav ul,.nav_type_10 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_10 ul li a{color:'.$nav_text.'; border-top:5px solid rgba(0,0,0,0);}';
	$output .='.nav_type_10 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_10 nav ul li a:hover,.nav_type_10 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:5px solid '.$nav_current_text.' !important;}';
	$output .='.nav_type_10 .cart-content:hover,.nav_type_10 #searchtop_img:hover i{color:'.$nav_current_text.';}';
									
// Nav_type_11 setting
	$output .='.nav_type_11 nav ul,.nav_type_11 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_11 ul li a{color:'.$nav_text.'; border:1px solid rgba(0,0,0,0);}';
	$output .='.nav_type_11 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_11 nav ul li a:hover,.nav_type_11 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border:1px solid '.$nav_current_text.'; background:'.$nav_current_bg.';}';	
	$output .='.nav_type_11 .cart-content:hover,.nav_type_11 #searchtop_img:hover i{color:'.$nav_current_text.';}';
										
// Nav_type_12 setting
	$output .='.nav_type_12 nav ul,.nav_type_12 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_12 ul li a{color:'.$nav_text.'; border:2px solid rgba(0,0,0,0);}';
	$output .='.nav_type_12 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_12 nav ul li a:hover,.nav_type_12 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border:2px solid '.$nav_current_text.'; background:'.$nav_current_bg.';}';									
	$output .='.nav_type_12 .cart-content:hover,.nav_type_12 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_13 setting
	$output .='header.nav_type_13{border-top:2px solid '.$header_border.';}';
	$output .='.nav_type_13 nav ul,.nav_type_13 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_13 ul li a,.nav_type_13 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_13 nav ul li a:hover,.nav_type_13 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';	
	$output .='.nav_type_13 .cart-content:hover,.nav_type_13 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_14 setting
	$output .='header.nav_type_14{border-top:5px solid '.$header_border.';}';
	$output .='.nav_type_14 nav ul,.nav_type_1 .header_current_cart{background:'.$nav_bg.';}';
	$output .='.nav_type_14 ul li a,.nav_type_14 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_14 nav ul li a:hover,.nav_type_14 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';										
	$output .='.nav_type_14 .cart-content:hover,.nav_type_14 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
//Bottom navigation setting

	$output .='.header_bottom_nav.transparent_header.opaque_header{background:'.$nav_bg.' !important;}';	
	
// Nav_type_15 setting
	$output .='header.nav_type_15,.header_bottom_nav.nav_type_15{border-top:1px solid '.$header_border.';}';
	$output .='.header_bottom_nav.nav_type_15{background:'.$nav_bg.';}';
	$output .='.nav_type_15 ul li a{color:'.$nav_text.'; border-right:1px solid '.$header_border.'}.nav_type_15 ul li:first-child a{border-left:1px solid '.$header_border.'} ';
	$output .='.nav_type_15 nav ul li a:hover,.nav_type_15 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';
	$output .='header #header_socials a,.nav_type_15 a#searchtop_img{color:'.$nav_text.';}header #header_socials a:hover{color:'.$nav_current_text.';}';										
	$output .='.header_bottom_nav.nav_type_15 .cart-content:hover,.header_bottom_nav.nav_type_15 #searchtop_img:hover i{color:'.$nav_current_text.';}';

// Nav_type_16 setting
	$output .='.header_bottom_nav.nav_type_16{border-top:1px solid '.$header_border.';}';
	$output .='.header_bottom_nav.nav_type_16{background:'.$nav_bg.';}';
	$output .='.nav_type_16 ul li a,.nav_type_16 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_16 nav ul li a:hover,.nav_type_16 > ul > .current-menu-item > a{color:'.$nav_current_text.'; background:'.$nav_current_bg.';}';											
	$output .='.header_bottom_nav.nav_type_16 .cart-content:hover,.header_bottom_nav.nav_type_16 #searchtop_img:hover i{color:'.$nav_current_text.';}';

// Nav_type_17 setting
	$output .='.header_bottom_nav.nav_type_17{border-top:1px solid '.$header_border.';}';
	$output .='.header_bottom_nav.nav_type_17{background:'.$nav_bg.';}';
	$output .='.nav_type_17 ul li a,.nav_type_17 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_17 nav ul li a:hover,.nav_type_17 > ul > .current-menu-item > a{color:'.$nav_current_text.'; border-top:3px solid '.$nav_current_text.';}';										
	$output .='.header_bottom_nav.nav_type_17 .cart-content:hover,.header_bottom_nav.nav_type_17 #searchtop_img:hover i{color:'.$nav_current_text.';}';
	
// Nav_type_18 setting
	$output .='.header_bottom_nav.nav_type_18{border-top:1px solid '.$header_border.';}';
	$output .='.header_bottom_nav.nav_type_18{background:'.$nav_bg.';}';
	$output .='.nav_type_18 ul li a,.nav_type_18 a#searchtop_img{color:'.$nav_text.';}';
	$output .='.nav_type_18 nav ul li a:hover,.nav_type_18 > ul >.current-menu-item > a{color:'.$nav_current_text.'; background'.$nav_current_bg.';}';										
	$output .='.header_bottom_nav.nav_type_18 .cart-content:hover,.header_bottom_nav.nav_type_18 #searchtop_img:hover i{color:'.$nav_current_text.';}';	
	
	
// Nav_type_19 / 20 setting
	$output .='.nav_type_19 ul li a,.nav_type_19_f ul li a{color:'.$nav_text.';}.nav_type_19 ul > li > a,.nav_type_19_f ul > li > a{border-bottom:1px solid '.$header_border.';}.nav_type_19 ul ul li a,.nav_type_19_f ul ul li a{border-right:1px solid '.$header_border.';}';
	$output .='#edge-search-form .search_button_icon{color:'.$nav_text.';}';
	$output .='.nav_type_19 ul li a:hover,.nav_type_19 > ul > .current-menu-item > a,.nav_type_19_f ul li a:hover,.nav_type_19_f > ul > .current-menu-item > a{color:'.$nav_current_text.';}';									
	$output .='.nav_type_19 .cart-content:hover,.nav_type_19 #searchtop_img:hover i,.nav_type_19_f .cart-content:hover,.nav_type_19_f #searchtop_img:hover i{color:'.$nav_current_text.';}';
	$output .='#fixed_header_socials a{color:'.$nav_text.';}#fixed_header_socials a{border:1px solid '.$header_border.';}.fixed_header_left{border-right:1px solid '.$leftnav_border.';}#edge-search-form input[type=text]{border:1px solid '.$header_border.'; background:'.$header_bg.';}';			


	$output .='ul.header_current_cart li .cart-content{color:'.$nav_text.'; font-weight: normal;}.transparent_header.opaque_header nav > ul > li > a, .transparent_header.opaque_header .cart-content{color:'.$nav_text.' !important;}';


/*-----------------------------------------------------------------------------------*/

/* Set Dropdown

/*-----------------------------------------------------------------------------------*/


//Set variables

	$drop_bg_color = $rd_data['rd_drop_bg_color'];
	$drop_heading_color = $rd_data['rd_drop_heading_color'];
	$drop_text_color = $rd_data['rd_drop_text_color'];
	$drop_hl_color = $rd_data['rd_drop_hl_color'];
	$drop_hover_color = $rd_data['rd_drop_hover_color'];
	$drop_light_hover_color = $rd_data['rd_drop_light_hover_color'];
	$drop_border_color = $rd_data['rd_drop_border_color'];
	
	
	
	$drop_font_family = $rd_data['rd_dropdown_font']['font-family'];
	$drop_font_size =  $rd_data['rd_dropdown_font']['font-size'];
	$drop_font_weight =  $rd_data['rd_dropdown_font']['font-weight'];
	$drop_font_line_height =  $rd_data['rd_dropdown_font']['line-height'];


	if($menu_custom_font == 1 ){
		
	$output .= '#header_container nav .rd_megamenu ul ul li a, .rd_megamenu ul ul li a,#header_container nav ul ul li a{font-family:'.$drop_font_family.' !important; font-size:'.$drop_font_size.' !important; font-weight:'.$drop_font_weight.' !important; line-height:'.$drop_font_line_height.' !important; }';

	}
	
	
	$output .= 'ul.header_cart_dropdown,.header_cart_dropdown .button,#search-form,#search-form.pop_search_form #ssform,.child_pages_ctn li,#header_container nav ul li ul,#header_container nav ul li ul a{background:'.$drop_bg_color.';}';
	$output .= '#header_container nav .rd_megamenu ul li a, .rd_megamenu ul li a,.header_cart_dropdown ul.cart_list li a,.header_cart_dropdown .widget_shopping_cart_content .rd_cart_buttons a{color:'.$drop_heading_color.';}';	
	$output .= '.header_cart_dropdown, #header_container nav .rd_megamenu ul ul li a, .rd_megamenu ul ul li a,#header_container nav ul ul li a,.header_cart_dropdown .rd_clear_btn,.header_cart_dropdown .total,#search-form.pop_search_form #ssform,.child_pages_ctn a{color:'.$drop_text_color.';}';	
	$output .= '.header_cart_dropdown .quantity,.header_cart_dropdown .product_list_widget span.amount,.header_cart_dropdown .total .amount,.search_button_icon{color:'.$drop_hl_color.';}';	
	$output .= '.header_cart_dropdown ul.cart_list li a.remove:hover,.child_pages_ctn a:hover{background:'.$drop_hover_color.'; color:'.$drop_bg_color.';}';	
	$output .= '.header_cart_dropdown ul.cart_list li a:hover{color:'.$drop_hover_color.';}';		
	$output .= '.header_cart_dropdown .rd_clear_btn:hover{color:'.$drop_light_hover_color.';}';	
	$output .= 'ul.header_cart_dropdown,#search-form.pop_search_form #ssform{border:1px solid '.$drop_border_color.';}#header_container nav ul ul .current-menu-item li a, #header_container nav ul ul li a{border-left:1px solid '.$drop_border_color.';}#header_container .fixed_header_left nav ul ul ul li a{border-left:1px solid '.$drop_border_color.' !important;}#header_container .fixed_header_left nav ul ul .current-menu-item li a, #header_container .fixed_header_left nav ul ul li a{border-right:1px solid '.$drop_border_color.' !important;}#header_container .fixed_header_left nav ul ul, #header_container .fixed_header_left nav ul ul{border-top:1px solid '.$drop_border_color.' !important;}';
	$output .= '#header_container nav ul ul li,ul.header_cart_dropdown ul.product_list_widget li.child_pages_ctn a{border-bottom:1px solid '.$drop_border_color.';}';
	$output .= '#header_container .rd_megamenu ul li ul,.header_cart_dropdown .clear_total{border-top:1px solid '.$drop_border_color.';}';
	$output .= '#header_container nav ul ul,.widget_shopping_cart_content,#search-form{border-top:3px solid '.$drop_hl_color.';}';
	$output .= '.current_item_number{background:'.$drop_hl_color.';}';
	$output .= '.rd_cart_buttons{background:'.$drop_light_hover_color.';}';
	$output .= '.header_cart_dropdown .button{background:'.$drop_bg_color.'; border:2px solid '.$drop_bg_color.'  !important;}';
	$output .= '.header_cart_dropdown .widget_shopping_cart_content .rd_cart_buttons .button:hover{background:'.$drop_light_hover_color.'; border:2px solid '.$drop_bg_color.' !important; color:'.$drop_bg_color.';}';
	$output .= '.current_item_number:before{border-color: transparent '.$drop_hl_color.' transparent;}';
	$output .= '.header_cart_dropdown ul.cart_list li a.remove{background:'.$drop_text_color.';}';
	$output .= '#header_container nav ul ul li a:hover,#header_container nav ul ul li.current-menu-item a{background:'.$drop_border_color.'; color:'.$drop_heading_color.';}';
	$output .= '#header_container nav ul ul .mm_widget_area{border:none!important; border-left:1px solid '.$drop_border_color.' !important;}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .product_list_widget a{color:'.$drop_heading_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .product_list_widget a:hover{color:'.$drop_hover_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .sb_widget h3{color:'.$drop_heading_color.'}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #lang_sel a{color:'.$drop_text_color.'; background:'.$drop_bg_color.'; border:1px solid '.$drop_border_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #lang_sel a:hover{color:'.$drop_heading_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_recent_entries ul li{border-bottom:1px solid '.$drop_border_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_recent_entries ul li a{color:'.$drop_text_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_recent_entries ul li a:hover{color:'.$drop_hl_color.'}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #recentcomments li{border-bottom:1px solid '.$drop_border_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #recentcomments li a{color:'.$drop_heading_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #recentcomments li a:hover{color:'.$drop_hover_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .rd_widget_recent_entries li{border-bottom:1px solid '.$drop_border_color.'}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .w_comment a{color:'.$drop_text_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .w_comment a:hover{color:'.$drop_hl_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_recent_entry h4 a{color:'.$drop_heading_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_recent_entry h4 a:hover{color:'.$drop_hl_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_archive ul li,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_meta ul li{border-bottom:1px solid '.$drop_border_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_archive ul li a,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_meta ul li a{color:'.$drop_text_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_archive ul li a:hover,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .widget_meta ul li a:hover{color:'.$drop_hl_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .page_item a, #header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .menu-item a{border-bottom:1px solid '.$drop_border_color.'; color:'.$drop_text_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .page_item a:hover, #header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .menu-item a:hover,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .current_page_item a,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .current_page_item a{color:'.$drop_hl_color.'; }#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .page_item a:before, #header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area .menu-item a:before { color:'.$drop_light_hover_color.';}';
	$output .= '#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar caption{background:'.$drop_heading_color.'; color:'.$drop_bg_color.'}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar{border:1px solid '.$drop_border_color.'}#wp-calendar th{color:'.$drop_light_hover_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar tbody td a{color:#fff; background:'.$drop_light_hover_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar tbody td a:hover{color:#fff; background:'.$drop_hl_color.';}#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar td#next a:hover:after,#header_container nav .rd_megamenu .mm_widget_area .rd_megamenu_widget_area #wp-calendar td#prev a:hover:after{background:'.$drop_hl_color.';}';	
	
	
	

/*-----------------------------------------------------------------------------------*/

/* Set Main content

/*-----------------------------------------------------------------------------------*/


//Set variables

	$mc_bg_color = $rd_data['rd_content_bg_color'];
	$mc_heading_color = $rd_data['rd_content_heading_color'];
	$mc_text_color = $rd_data['rd_content_text_color'];
	$mc_hl_color = $rd_data['rd_content_hl_color'];
	$mc_hover_color = $rd_data['rd_content_hover_color'];
	$mc_light_hover_color = $rd_data['rd_content_light_hover_color'];
	$mc_border_color = $rd_data['rd_content_border_color'];
	$mc_grey_color = $rd_data['rd_content_grey_color'];
	$mc_alt_bg_color = $rd_data['rd_content_alt_bg_color'];
	$mc_alt_heading_color = $rd_data['rd_content_alt_heading_color'];
	$mc_alt_text_color = $rd_data['rd_content_alt_text_color'];
	$mc_alt_hl_color = $rd_data['rd_content_alt_hl_color'];
	$mc_alt_hover_color = $rd_data['rd_content_alt_hover_color'];
	$mc_alt_light_hover_color = $rd_data['rd_content_alt_light_hover_color'];
	$mc_alt_border_color = $rd_data['rd_content_alt_border_color'];


	$mc_custom_font = $rd_data['rd_custom_font'];

	$mc_font_family = $rd_data['rd_body_font']['font-family'];
	$mc_font_size =  $rd_data['rd_body_font']['font-size'];
	$mc_font_weight =  $rd_data['rd_body_font']['font-weight'];
	$mc_font_line_height =  $rd_data['rd_body_font']['line-height'];


	$mc_custom_heading_font = $rd_data['rd_custom_heading_font'];	
	
	$h1_font_family = $rd_data['rd_h1_font']['font-family'];
	$h1_font_size =  $rd_data['rd_h1_font']['font-size'];
	$h1_font_weight =  $rd_data['rd_h1_font']['font-weight'];
	$h1_font_line_height =  $rd_data['rd_h1_font']['line-height'];
	
	$h2_font_family = $rd_data['rd_h2_font']['font-family'];
	$h2_font_size =  $rd_data['rd_h2_font']['font-size'];
	$h2_font_weight =  $rd_data['rd_h2_font']['font-weight'];
	$h2_font_line_height =  $rd_data['rd_h2_font']['line-height'];
	
	$h3_font_family = $rd_data['rd_h3_font']['font-family'];
	$h3_font_size =  $rd_data['rd_h3_font']['font-size'];
	$h3_font_weight =  $rd_data['rd_h3_font']['font-weight'];
	$h3_font_line_height =  $rd_data['rd_h3_font']['line-height'];
	
	$h4_font_family = $rd_data['rd_h4_font']['font-family'];
	$h4_font_size =  $rd_data['rd_h4_font']['font-size'];
	$h4_font_weight =  $rd_data['rd_h4_font']['font-weight'];
	$h4_font_line_height =  $rd_data['rd_h4_font']['line-height'];
	
	$h5_font_family = $rd_data['rd_h5_font']['font-family'];
	$h5_font_size =  $rd_data['rd_h5_font']['font-size'];
	$h5_font_weight =  $rd_data['rd_h5_font']['font-weight'];
	$h5_font_line_height =  $rd_data['rd_h5_font']['line-height'];
	
	$h6_font_family = $rd_data['rd_h6_font']['font-family'];
	$h6_font_size =  $rd_data['rd_h6_font']['font-size'];
	$h6_font_weight =  $rd_data['rd_h6_font']['font-weight'];
	$h6_font_line_height =  $rd_data['rd_h6_font']['line-height'];
	
	
	if($mc_custom_font == 1 ){

	$output .= 'body{font-family:'.$mc_font_family.'; font-size:'.$mc_font_size.'; font-weight:'.$mc_font_weight.'; line-height:'.$mc_font_line_height.'; }';

	}


	if($mc_custom_heading_font == 1 ){
		
	$output .= 'h1{font-family:'.$h1_font_family.'; font-size:'.$h1_font_size.'; font-weight:'.$h1_font_weight.'; line-height:'.$h1_font_line_height.'; }';
	$output .= 'h2{font-family:'.$h2_font_family.'; font-size:'.$h2_font_size.'; font-weight:'.$h2_font_weight.'; line-height:'.$h2_font_line_height.'; }';
	$output .= 'h3{font-family:'.$h3_font_family.'; font-size:'.$h3_font_size.'; font-weight:'.$h3_font_weight.'; line-height:'.$h3_font_line_height.'; }';
	$output .= 'h4{font-family:'.$h4_font_family.'; font-size:'.$h4_font_size.'; font-weight:'.$h4_font_weight.'; line-height:'.$h4_font_line_height.'; }';
	$output .= 'h5{font-family:'.$h5_font_family.'; font-size:'.$h5_font_size.'; font-weight:'.$h5_font_weight.'; line-height:'.$h5_font_line_height.'; }';
	$output .= 'h6{font-family:'.$h6_font_family.'; font-size:'.$h6_font_size.'; font-weight:'.$h6_font_weight.'; line-height:'.$h6_font_line_height.'; }';

		
	}
/*-----------------------------------------------------------------------------------*/

/* Set Body default, background , text, a, heading, input

/*-----------------------------------------------------------------------------------*/




	$output .= 'body,#jprePercentage{color:'.$mc_text_color.'}body a,.hl_color,#sidebar #search input[type=submit]:hover,.wpb_widgetised_column #search input[type=submit]:hover,.strong_colored strong{color:'.$mc_hl_color.'}body a:hover{color:'.$mc_hover_color.'}';
	$output .= 'h1,h2,h3,h4,h5,h6{color:'.$mc_heading_color.'}';
	$output .= '.def_section,blockquote{background:'.$mc_bg_color.'}';
	$output .= '#to_top:hover{background:'.$mc_alt_hl_color.'}';
	$output .= '::-webkit-input-placeholder{color:'.$mc_alt_text_color.'}:-moz-placeholder{color:'.$mc_alt_text_color.'}::-moz-placeholder{color:'.$mc_alt_text_color.'}:-ms-input-placeholder{color:'.$mc_alt_text_color.'}#sidebar #search input[type=submit],.wpb_widgetised_column #search input[type=submit]{color:'.$mc_alt_text_color.'}';
	$output .= 'input[type=text], input[type=email], input[type=password], textarea,#coupon_code{color:'.$mc_alt_text_color.'; border:1px solid '.$mc_alt_border_color.'; background:'.$mc_alt_bg_color.';}';
	$output .= 'input[type="checkbox"]{color:'.$mc_alt_bg_color.'; border:1px solid '.$mc_alt_border_color.'; background:'.$mc_alt_bg_color.';}input[type=checkbox]:checked{color:'.$mc_alt_bg_color.'; border:1px solid '.$mc_alt_hover_color.'; background:'.$mc_alt_hover_color.';}';
	$output .= '.flex-direction-nav li a{color:'.$mc_heading_color.'; background:'.$mc_bg_color.';}';
	$output .= '.wpb_text_column ol li:before{background:'.$mc_text_color.'}.wpb_text_column ol li:hover:before{background:'.$mc_hl_color.'}';
	$output .= 'blockquote{ border:1px solid '.$mc_border_color.'; }blockquote:before,.post-password-form input[type=submit]{ background:'.$mc_alt_hl_color.'; }';
	$output .= '.code_box_ctn{ background:'.$mc_grey_color.'; }.wp-caption{ background:'.$mc_grey_color.'; border:1px solid '.$mc_border_color.'; }';
	$output .= '.tp-caption a {    color: #fff;}.tp-caption a:hover {  color: #fff;}';
	
	

/*-----------------------------------------------------------------------------------*/

/* Set Revolution slider Load Bar Color

/*-----------------------------------------------------------------------------------*/
	
	$output .= '.tp-bannertimer{background: '.$mc_hover_color.'; background: -moz-linear-gradient(left,  '.$mc_hover_color.' 0%, '.$mc_alt_hover_color.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$mc_hover_color.'), color-stop(100%,'.$mc_alt_hover_color.')); background: -webkit-linear-gradient(left,  '.$mc_hover_color.' 0%,'.$mc_alt_hover_color.' 100%); background: -o-linear-gradient(left,  '.$mc_hover_color.' 0%,'.$mc_alt_hover_color.' 100%); background: -ms-linear-gradient(left,  '.$mc_hover_color.' 0%,'.$mc_alt_hover_color.' 100%); background: linear-gradient(to right,  '.$mc_hover_color.' 0%,'.$mc_alt_hover_color.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$mc_hover_color.'", endColorstr="'.$mc_alt_hover_color.'",GradientType=1 );} ';


/*-----------------------------------------------------------------------------------*/

/* Set Title

/*-----------------------------------------------------------------------------------*/
//Set variables

	$title_bg_color = $rd_data['rd_title_bg_color'];
	$title_color = $rd_data['rd_title_color'];
	$breadbtn_bg_color = $rd_data['rd_breadbtn_bg_color'];
	$breadbtn_text_color = $rd_data['rd_breadbtn_text_color'];
	$breadcrumbs_color = $rd_data['rd_breadcrumbs_color'];
	$title_border_color = $rd_data['rd_title_border'];
	$output .= '.page_title_ctn{background:'.$title_bg_color.'; border-bottom:1px solid '.$title_border_color.';  }';
	$output .= '.page_title_ctn h1{color:'.$title_color.'; }';
	$output .= '#crumbs a,#crumbs span{color:'.$breadcrumbs_color.'; }';
	$output .= '.rd_child_pages{color:'.$breadbtn_text_color.'; border:1px solid '.$breadbtn_text_color.'; background:'.$breadbtn_bg_color.';}';
	

/*-----------------------------------------------------------------------------------*/

/* Set Search Page

/*-----------------------------------------------------------------------------------*/
	
	$output .= '.search_results strong{color:'.$mc_hl_color.'; }.search_sf .rd_search_sc #search input[type=submit]{background:'.$mc_heading_color.' !important;}.search_sf .rd_search_sc #search input[type=submit]:hover{background:'.$mc_hover_color.' !important;}';
 

/*-----------------------------------------------------------------------------------*/

/* Set single Blog post / check rd_blog.php for blog settings

/*-----------------------------------------------------------------------------------*/


	$output .= '.post_single .post-title h2 a,.blog_related_post .post-title h2 a,.logged-in-as a{color:'.$mc_heading_color.'}';
	$output .= '.post_single .post-title h2 a:hover,.blog_related_post .post-title h2 a:hover{color:'.$mc_hover_color.'}';
	$output .= '.mejs-container .mejs-controls,.audio_ctn{background:'.$mc_text_color.' !important;}.mejs-controls .mejs-time-rail .mejs-time-current{background:'.$mc_heading_color.' !important; }.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{background:'.$mc_hover_color.' !important; }' ;
	$output .= '.post_quote_text,.post_quote_author{background:'.$mc_alt_hl_color.'; color:#ffffff!important;}' ;
	$output .= '.post-info a{color:'.$mc_text_color.'}.post_single .post-info a:hover{color:'.$mc_hover_color.'}';
	$output .= '.single_post_navigation,.post-info{border-bottom:1px solid '.$mc_border_color.'}';
	$output .= '.single_post_navigation_bottom{border-top:1px solid '.$mc_border_color.'}';
	$output .= '.tags_icon{background:'.$mc_alt_heading_color.'; color:'.$mc_alt_bg_color.';}.single_post_tags{border:1px solid '.$mc_alt_border_color.'; background:'.$mc_alt_bg_color.';}';
	$output .= '.shareicons_icon{background:'.$mc_alt_hl_color.'; color:'.$mc_alt_bg_color.';}.single_post_share_icon{border:1px solid '.$mc_alt_border_color.'; background:'.$mc_alt_bg_color.';}.single_post_share_icon .share-box li a{color:'.$mc_alt_text_color.';}.single_post_share_icon .share-box li a:hover{color:'.$mc_alt_hl_color.' !important;}';
	$output .= '#author-bio{border:1px solid '.$mc_alt_border_color.'; background:'.$mc_grey_color.'; color:'.$mc_alt_text_color.'; box-shadow:0 0px 0px '.$mc_bg_color.', 0 4px 0 -1px '.$mc_bg_color.', 0 0px 0px 0px '.$mc_bg_color.',0 0px 0px '.$mc_bg_color.', 0 4px 0 0px '.$mc_border_color.', 0px 0px 0px 0px '.$mc_bg_color.';}#author-info h3{color:'.$mc_alt_heading_color.';}.author_posts_link{color:'.$mc_alt_text_color.';}.author_posts_link:hover{color:'.$mc_alt_hl_color.';}';	
	$output .= '.comment_ctn{border:1px solid '.$mc_alt_border_color.'; background:'.$mc_alt_bg_color.'; color:'.$mc_alt_text_color.'; box-shadow:0 0px 0px '.$mc_bg_color.', 0 4px 0 -1px '.$mc_bg_color.', 0 0px 0px 0px '.$mc_bg_color.',0 0px 0px '.$mc_bg_color.', 0 4px 0 0px '.$mc_border_color.', 0px 0px 0px 0px '.$mc_bg_color.';}';	
	$output .= '.comment_count h3 a{color:'.$mc_heading_color.'}';
	$output .= '#comments ul li .details span.author{color:'.$mc_alt_heading_color.'}';
	$output .= '#comments ul li .details span.date a{color:'.$mc_alt_text_color.'}';
	$output .= '#comments ul li .details span.Reply a{background:'.$mc_alt_text_color.'; color:'.$mc_alt_bg_color.'}#comments ul li .details span.Reply a:hover{background:'.$mc_alt_light_hover_color.'; color:'.$mc_alt_bg_color.'}';
	$output .= '#comments > ul > li ul{border-left:1px solid '.$mc_border_color.'}#comments ul li li .comment_ctn:before{background:'.$mc_border_color.';}';
	$output .= 'input.single_post_author,input.single_post_email,input.single_post_url,.single_post_comment{background:'.$mc_grey_color.'}input.single_post_author:focus,input.single_post_email:focus,input.single_post_url:focus,.single_post_comment:focus{background:'.$mc_alt_bg_color.'}';
	$output .= '#add-comment input#submit{background:'.$mc_heading_color.'; color:'.$mc_bg_color.'}#add-comment input#submit:hover{background:'.$mc_hover_color.'; color:'.$mc_bg_color.'}';
	$output .= '.blog_related_post .more-link{border:1px solid '.$mc_heading_color.'; color:'.$mc_heading_color.'; background:'.$mc_bg_color.';}.blog_related_post .more-link:hover{color:'.$mc_bg_color.'; background:'.$mc_heading_color.';}';
	
	

/*-----------------------------------------------------------------------------------*/

/* Set Blog carousel

/*-----------------------------------------------------------------------------------*/
	
	
	$output .= '.cbp_type03 .rp_left,.cbp_type03 .rp_right{background:'.$mc_heading_color.'}.cbp_type03 .rp_left:hover,.cbp_type03 .rp_right:hover{background:'.$mc_hover_color.'}';
	$output .= '.cbp_type03 .blog_related_post .more-link:hover{background:'.$mc_hover_color.'; border-color:'.$mc_hover_color.';}';
	$output .= '.cbp_type05 .rp_left,.cbp_type05 .rp_right,.cbp_type08 .rp_left,.cbp_type08 .rp_right{background:'.$mc_hl_color.'}.cbp_type05 .rp_left:hover,.cbp_type05 .rp_right:hover,.cbp_type08 .rp_left:hover,.cbp_type08 .rp_right:hover{background:'.$mc_light_hover_color.'}';
	$output .= '.cbp_type05 .carousel_recent_post .blog_box_content,.cbp_type08 .carousel_recent_post .blog_box_content{color:'.$mc_text_color.'}.cbp_type05 .carousel_recent_post h5.widget_post_title a,.cbp_type08 .carousel_recent_post h5.widget_post_title a{color:'.$mc_heading_color.'}';
	$output .= '.cbp_type05 .carousel_recent_post:hover .blog_box_content,.cbp_type05 .blog_post_link_ctn,.cbp_type08 .carousel_recent_post:hover .blog_box_content,.cbp_type08 .blog_post_link_ctn{background:'.$mc_heading_color.'; color:#a1b1bc;}.cbp_type05 .carousel_recent_post:hover h5.widget_post_title a,.cbp_type08 .carousel_recent_post:hover h5.widget_post_title a{color:'.$mc_bg_color.'}';
	$output .= '.cbp_type06 .rp_left,.cbp_type06 .rp_right{background:'.$mc_text_color.'}.cbp_type06 .rp_left:hover,.cbp_type06 .rp_right:hover{background:'.$mc_heading_color.'}';
	$output .= '.cbp_type06 .carousel_recent_post .blog_box_content{color:'.$mc_text_color.'}.cbp_type06 .carousel_recent_post h5.widget_post_title a{color:'.$mc_heading_color.'}';
	$output .= '.cbp_type06 a.more-link{background:'.$mc_text_color.'; color:#fff;}.cbp_type06 a.more-link:after{background:'.$mc_heading_color.'; color:#fff;}.cbp_type06 a.more-link:hover{background:'.$mc_hl_color.'; color:#fff;}.cbp_type06 a.more-link:hover:after{
background: rgba(0, 0, 0, 0.21); color:#fff;}';
	$output .= '.sp_left:hover,.sp_right:hover{background:'.$mc_hl_color.'; border-color:'.$mc_hl_color.';}';

	


/*-----------------------------------------------------------------------------------*/

/* Set Sidebar

/*-----------------------------------------------------------------------------------*/

	$output .= '.sb_widget h3{color:'.$mc_heading_color.'}.sb_widget > h3:before{border-top:7px solid '.$mc_hl_color.'; border-bottom:7px solid '.$mc_alt_hover_color.';}';
	$output .= '#sidebar #lang_sel a,.wpb_widgetised_column #lang_sel a{color:'.$mc_text_color.'; background:'.$mc_bg_color.'; border:1px solid '.$mc_border_color.'}#sidebar #lang_sel a:hover,.wpb_widgetised_column #lang_sel a:hover{color:'.$mc_heading_color.';}';
	$output .= '#sidebar .widget_recent_entries ul li,.wpb_widgetised_column .widget_recent_entries ul li{border-bottom:1px solid '.$mc_border_color.'}#sidebar .widget_recent_entries ul li a,.wpb_widgetised_column .widget_recent_entries ul li a{color:'.$mc_text_color.'}#sidebar .widget_recent_entries ul li a:hover,.wpb_widgetised_column .widget_recent_entries ul li a:hover{color:'.$mc_hl_color.'}';
	$output .= '#sidebar #recentcomments li,.wpb_widgetised_column #recentcomments li{border-bottom:1px solid '.$mc_border_color.'}#sidebar #recentcomments li a,.wpb_widgetised_column #recentcomments li a,#sidebar .tweets li a,.wpb_widgetised_column .tweets li a{color:'.$mc_heading_color.';}#sidebar #recentcomments li a:hover,.wpb_widgetised_column  #recentcomments li a:hover{color:'.$mc_hover_color.';}';
	$output .= '#sidebar .rd_widget_recent_entries li,.wpb_widgetised_column .rd_widget_recent_entries li,#sidebar  .tweets li,.wpb_widgetised_column .tweets li{border-bottom:1px solid '.$mc_border_color.'}';
	$output .= '#sidebar .tagcloud a ,.wpb_widgetised_column .tagcloud a {border:1px solid '.$mc_border_color.'; color:'.$mc_text_color.'}#sidebar .tagcloud a:hover,.wpb_widgetised_column .tagcloud a:hover{background:'.$mc_alt_hl_color.'; border-color:'.$mc_alt_hl_color.'; color:#ffffff;}';
	$output .= '#sidebar .w_comment a,.wpb_widgetised_column .w_comment a{color:'.$mc_text_color.';}#sidebar .w_comment a:hover,.wpb_widgetised_column .w_comment a:hover{color:'.$mc_hl_color.';}';
	$output .= '#sidebar .widget_recent_entry h4 a,.wpb_widgetised_column .widget_recent_entry h4 a{color:'.$mc_heading_color.';}#sidebar .widget_recent_entry h4 a:hover,.wpb_widgetised_column .widget_recent_entry h4 a:hover{color:'.$mc_hl_color.';}';
	$output .= '#sidebar .widget_archive ul li,#sidebar .widget_meta ul li,.wpb_widgetised_column .widget_archive ul li,.wpb_widgetised_column .widget_meta ul li{border-bottom:1px solid '.$mc_border_color.'}#sidebar .widget_archive ul li a,#sidebar .widget_meta ul li a,.wpb_widgetised_column  .widget_archive ul li a,.wpb_widgetised_column .widget_meta ul li a{color:'.$mc_text_color.';}#sidebar .widget_archive ul li a:hover,#sidebar .widget_meta ul li a:hover,.wpb_widgetised_column .widget_archive ul li a:hover,.wpb_widgetised_column .widget_meta ul li a:hover{color:'.$mc_hl_color.';}';
	$output .= '#sidebar .page_item a, #sidebar .menu-item a,.wpb_widgetised_column .page_item a,.wpb_widgetised_column .menu-item a{border-bottom:1px solid '.$mc_border_color.'; color:'.$mc_text_color.';}#sidebar .page_item a:hover, #sidebar .menu-item a:hover,#sidebar .current_page_item a,#sidebar .current_page_item a,.wpb_widgetised_column .page_item a:hover,.wpb_widgetised_column .menu-item a:hover,.wpb_widgetised_column .current_page_item a{color:'.$mc_hl_color.'; }#sidebar .page_item a:before, #sidebar .menu-item a:before,.wpb_widgetised_column .page_item a:before,.wpb_widgetised_column .menu-item a:before{ color:'.$mc_alt_hl_color.';}';
	$output .= '#wp-calendar caption{background:'.$mc_heading_color.'; color:'.$mc_bg_color.'}#wp-calendar{border:1px solid '.$mc_border_color.'}#wp-calendar th{color:'.$mc_alt_hl_color.';}#wp-calendar tbody td a{color:#fff; background:'.$mc_alt_hl_color.';}#wp-calendar tbody td a:hover{color:#fff; background:'.$mc_hl_color.';}#wp-calendar td#next a:hover:after,#wp-calendar td#prev a:hover:after{background:'.$mc_hl_color.';}';
	$output .= '.rd_widget_recent_entries .thumbnail a:before,.port_tn a:before,.rd_widget_recent_entries_f .thumbnail a:before{background:'.$mc_alt_hl_color.';}';
 	
	


/*-----------------------------------------------------------------------------------*/

/* Set Portfolio Details

/*-----------------------------------------------------------------------------------*/

	$output .= '.single_port_navigation,.port_details_full_information .item_details_info{border-bottom:1px solid '.$mc_border_color.';}';
	$output .= '.all_projects_btn{color:'.$mc_text_color.';}';
	$output .= '.next_project{border:1px solid '.$mc_border_color.'; background:'.$mc_border_color.'; color:'.$mc_heading_color.';}.next_project:hover{border:1px solid '.$mc_light_hover_color.'; background:'.$mc_light_hover_color.'; color:#fff;}';
	$output .= '.previous_project{border:1px solid '.$mc_text_color.'; background:'.$mc_bg_color.'; color:'.$mc_text_color.';}.previous_project:hover{border:1px solid '.$mc_hover_color.'; background:'.$mc_hover_color.'; color:#fff;}';
	$output .= '.port_details_subtitle{color:'.$mc_hl_color.';}';
	$output .= '.port_meta{border-bottom:1px solid '.$mc_border_color.';}';
	$output .= '.next_project{border-bottom:1px solid '.$mc_border_color.';}';
	$output .= '.port_vp a{background:'.$mc_heading_color.';}.port_vp a:hover{background:'.$mc_hover_color.'; color:#fff;}';



/*-----------------------------------------------------------------------------------*/

/* Set Staff Details

/*-----------------------------------------------------------------------------------*/

	$output .= '.single_staff_meta{border-top:1px solid '.$mc_border_color.';}';
	$output .= '#member_email a:hover, .sc-share-box #member_email a, .single_staff_social #member_email a{background:'.$mc_hl_color.';}';


/*-----------------------------------------------------------------------------------*/

/* Set Shop

/*-----------------------------------------------------------------------------------*/
	//shop filter
	$output .= '.product_filtering {border-bottom:1px solid '.$mc_border_color.'}';
	$output .= '.filter_param,.filter_param li ul{background:'.$mc_alt_bg_color.'; border:1px solid '.$mc_alt_border_color.'; color:'.$mc_alt_text_color.';}.filter_param strong{color:'.$mc_alt_heading_color.';}';
	$output .= '.current_li:after{border-left:1px solid '.$mc_alt_border_color.';}';
	$output .= '.filter_param.filter_param_sort{background:'.$mc_alt_text_color.'; border:1px solid '.$mc_alt_text_color.';}.filter_param.filter_param_sort a{color:'.$mc_alt_bg_color.'}';
	$output .= '.filter_param.filter_param_order a,.filter_param.filter_param_count a{color:'.$mc_alt_text_color.'}.filter_param.filter_param_order a:hover,.filter_param.filter_param_count a:hover{color:'.$mc_alt_light_hover_color.'}';
	//shop page, shop item container
	$output .= '.shop_two_col,.shop_three_col,.shop_four_col,.caroufredsel_wrapper .inner_product,.woocommerce .products li{color:'.$mc_alt_text_color.'; background:'.$mc_alt_bg_color.'; border:1px solid '.$mc_alt_border_color.';}';
	$output .= '.custom_cart_button a{color:'.$mc_alt_text_color.';}.custom_cart_button a:hover{color:'.$mc_alt_light_hover_color.';}';
	$output .= '.product_box {border-top:1px solid '.$mc_alt_border_color.'; border-bottom:1px solid '.$mc_alt_border_color.';}';
	$output .= '.product_box h3{color:'.$mc_alt_heading_color.';}.product_box h3:hover{color:'.$mc_alt_hl_color.';}';
	$output .= '.product_box .price{color:'.$mc_alt_text_color.';}';
	$output .= '.product_box .price del{color:'.$mc_alt_text_color.' !important;}';
	$output .= '.product_box .price ins{color:'.$mc_alt_hl_color.';}';
	$output .= '.adding_to_cart_working .icon_status_inner:before{color:'.$mc_hl_color.';}.adding_to_cart_completed .icon_status_inner:before{color:'.$mc_hover_color.';}';

	//Shop single item page
	$output .= '.single_product_main_image div,.single_products_thumbnails img,.single_product_navigation .previous_product,.single_product_navigation .next_product {border:1px solid '.$mc_border_color.' }';
	$output .= '.single_product_navigation .previous_product:hover,.single_product_navigation .next_product:hover{border:1px solid '.$mc_light_hover_color.'; background:'.$mc_light_hover_color.'; color:'.$mc_bg_color.' }';
	$output .= '.single_products_thumbnails img.selected{border:1px solid '.$mc_hl_color.' }';
	$output .= '.product_nav_left:hover,.product_nav_right:hover{background:'.$mc_hl_color.' }';
	
	$output .= '.product_title.entry-title,.woocommerce-tabs ul li a,.related h2,.single_product_navigation .previous_product,.single_product_navigation .next_product,.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta strong, .woocommerce-page #reviews #comments h2,.show_review_form.button {color:'.$mc_heading_color.' }';
	$output .= '.summary.entry-summary .price,.summary.entry-summary .price del,.show_review_form.button,.woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta{color:'.$mc_text_color.' }';
	$output .= '.summary.entry-summary .price ins,.woocommerce-product-rating .woocommerce-review-link,.custom_cart_button .button.add_to_cart_button.product_type_simple.added{color:'.$mc_hl_color.' }.woocommerce-product-rating .woocommerce-review-link:hover{color:'.$mc_hover_color.' }';
	$output .= 'button.single_add_to_cart_button.button.alt{color:'.$mc_heading_color.'; background:'.$mc_bg_color.'; border:2px solid '.$mc_heading_color.'; }button.single_add_to_cart_button.button.alt:hover{color:'.$mc_bg_color.'; background:'.$mc_hover_color.'; border:2px solid '.$mc_hover_color.'; }';
	$output .= '.single_product_navigation{border-top:1px solid '.$mc_border_color.' }';
	$output .= '.related_left, .related_right,.upsells_left, .upsells_right{border:1px solid '.$mc_alt_border_color.'; color:'.$mc_alt_text_color.' ; background:'.$mc_alt_bg_color.';}';
	$output .= '.related_left:hover, .related_right:hover,.upsells_left:hover, .upsells_right:hover{border:1px solid '.$mc_alt_hover_color.'; color:'.$mc_alt_bg_color.' ; background:'.$mc_alt_hover_color.';}';
	$output .= '.woo-share-box ul li a,.woo_img_next,.woo_img_prev{background:'.$mc_border_color.'; color:'.$mc_text_color.' ;}.woo_img_next:hover,.woo_img_prev:hover{background:'.$mc_light_hover_color.'; color:'.$mc_bg_color.' ;}';
	$output .= '.woocommerce-tabs .tabs li a{border-right:1px solid '.$mc_border_color.' }.woocommerce-tabs,.woocommerce-tabs li.active{border-left:1px solid '.$mc_border_color.' }.woocommerce-tabs li.active{border-bottom:1px solid '.$mc_bg_color.' }.woocommerce-tabs .tabs li a{border-top:1px solid '.$mc_border_color.' }';
	$output .= '.woocommerce-tabs .panel{border:1px solid '.$mc_border_color.' }';	
	$output .= '.woocommerce-page #reviews #comments h2,#reviews #comments ol.commentlist li{border-bottom:1px solid '.$mc_border_color.' !important; }';
	

	//Shop cart / checkout page
	
	$output .= '.chosen-container-single .chosen-single,#rd_login_form .inline,.product-description a,.shipping td:last-child{color:'.$mc_text_color.'}';
	$output .= '.chosen-container-single .chosen-single,.select2-drop{background:'.$mc_bg_color.'}';
	$output .= '.woocommerce-cart .cart_totals h2, .woocommerce-cart form h2, .woocommerce-checkout .woocommerce h2,.woocommerce form .form-row label, .woocommerce-page form .form-row label,.checkout_steps .active_step,.product-qty,.rd_order_total,.country_to_state,.cross-sells h2,.woocommerce-cart .cart_totals,.shop_table.order_details tfoot,.woocommerce .order_details li strong, .woocommerce-page .order_details li strong{color:'.$mc_heading_color.'}';
	$output .= '.woocommerce-cart .cart_totals strong, .rd_order_total .total strong,.shop_table.order_details tfoot .amount,.order_complete_ctn h3,.customer_details dd{color:'.$mc_hl_color.';}';
	$output .= '.woocommerce-checkout input[type=text],.woocommerce-checkout input[type=email],.woocommerce-checkout input[type=password],.woocommerce-checkout textarea,.form-row .chosen-container-single .chosen-single,.woocommerce-checkout .product-name img,.order_and_total_wrapper,.user_current_cart,.woocommerce-page table.cart img,.woocommerce-message, .woocommerce-error, .woocommerce-info,.country_to_state,.shop_table.order_details,.woocommerce .order_details, .woocommerce-page .order_details,#calc_shipping_state,.woocommerce-cart #coupon_code,.woocommerce form .form-row input.input-text,.country_to_state .select2-choice,.state_select .select2-choice,#calc_shipping_state .select2-choice,.select2-drop-active{border:1px solid '.$mc_border_color.'; color: '.$mc_text_color.';}';
	$output .= '.woocommerce-page input[type=submit],.customer_details_next,.rd_create_acc,#place_order,.rd_coupon_form .alt2,.coupon input.button.alt2,#review_form  input[type=submit],.woocommerce .addresses .title .edit, .woocommerce-page .addresses .title .edit {background:'.$mc_hl_color.'; color:'.$mc_bg_color.';}';
	$output .= '.cart_details_back,.customer_details_back,#rd_login_form input[type=submit],.rd_guest_acc,.update_cart input.checkout-button.button,.cart-collaterals .shipping_calculator .button,.create_acc_done,.wc-backward{background:'.$mc_text_color.'; color:'.$mc_bg_color.';}';	
	$output .= '.shop_table thead{background:'.$mc_border_color.'; color:'.$mc_heading_color.';}';
	$output .= 'ul.payment_methods.methods li{border-bottom:1px solid '.$mc_border_color.';}';
	$output .= '.woocommerce-page .order_details li{border-right:1px solid '.$mc_border_color.';}';
	$output .= '.cart_totals tr td,.cart_totals tr th{border:1px solid '.$mc_border_color.' !important;}.cart_totals tr td{border-left:none!important;}.cart_totals tr:first-child td,.cart_totals tr:first-child th{border-bottom:none!important;}.cart_totals tr:last-child td,.cart_totals tr:last-child th{border-top:none!important;}';
	$output .= '.show_review_form.button:hover{color:'.$mc_light_hover_color.';}';
	$output .= '.woocommerce-page input[type=submit]:hover,.customer_details_next:hover,.rd_create_acc:hover,#place_order:hover,.rd_coupon_form .alt2:hover,.coupon input.button.alt2:hover,#review_form input[type=submit]:hover,.woocommerce .addresses .title .edit:hover, .woocommerce-page .addresses .title .edit:hover{background:'.$mc_hover_color.'; color:'.$mc_bg_color.';}';
	$output .= '.cart_details_back:hover,.customer_details_back:hover,.rd_guest_acc:hover,#rd_login_form input[type=submit]:hover,.update_cart input.checkout-button.button:hover,.cart-collaterals .shipping_calculator .button:hover,.wc-backward:hover{background:'.$mc_light_hover_color.'; color:'.$mc_bg_color.';}';
	
	
	//My account page
	
	$output .= '.my_account_orders{border:1px solid '.$mc_border_color.';}';
	

	//Shop widget config

	// Search
	$output .= '#sidebar #searchform div #s,.wpb_widgetised_column #searchform div #s{background:'.$mc_alt_bg_color.' !important; border:1px solid '.$mc_alt_border_color.'; color:'.$mc_alt_text_color.'}';
	$output .= '#s::-webkit-input-placeholder{color:'.$mc_alt_text_color.'}#s:-moz-placeholder{color:'.$mc_alt_text_color.'}#s::-moz-placeholder{color:'.$mc_alt_text_color.'}#s:-ms-input-placeholder{color:'.$mc_alt_text_color.'}';
	$output .= '.widget_product_search input[type=submit]{background:none!important; color:'.$mc_alt_text_color.'}.widget_product_search input[type=submit]:hover{background:none!important; color:'.$mc_alt_hover_color.'}';
	// Price filter
	$output .= '.ui-slider-handle.ui-state-default.ui-corner-all{background:'.$mc_hl_color.'}';
	$output .= '.ui-slider-range.ui-widget-header.ui-corner-all{background:'.$mc_border_color.'}';
	$output .= '.price_slider.ui-slider.ui-slider-horizontal.ui-widget.ui-widget-content.ui-corner-all{border:1px solid '.$mc_border_color.'}';
	$output .= '.price_slider_amount button.button{color:'.$mc_bg_color.'; background:'.$mc_text_color.';}';
	$output .= '#sidebar .price_label,.wpb_widgetised_column .price_label{color:'.$mc_text_color.'}.price_label .to,.price_label .from{color:'.$mc_heading_color.'}';
	$output .= '#sidebar .widget_price_filter .price_slider_amount .button:hover,.wpb_widgetised_column .widget_price_filter .price_slider_amount .button:hover{background:'.$mc_light_hover_color.'; color:'.$mc_bg_color.';}';
	
	// Recent Products | Rated products
	$output .= '.product_list_widget a{color:'.$mc_heading_color.'}';
	$output .= 'ul.product_list_widget li{border-bottom:1px solid '.$mc_border_color.'}';
	$output .= '.product_list_widget span.amount{color:'.$mc_text_color.'}';
	$output .= '.product_list_widget ins span.amount{color:'.$mc_hl_color.'}';
	// Category
	$output .= '#sidebar .cat-item a,.wpb_widgetised_column .cat-item a{color:'.$mc_heading_color.'}#sidebar .cat-item a:hover,.wpb_widgetised_column .cat-item a:hover{color:'.$mc_hover_color.'}';
	$output .= '#sidebar .cat-item,.wpb_widgetised_column .cat-item,#sidebar .cat-item .children,.wpb_widgetised_column .cat-item .children{border-top:1px solid '.$mc_border_color.'}';
	$output .= '#sidebar .cat-item .children .children a,.wpb_widgetised_column .cat-item .children .children a{color:'.$mc_text_color.'}#sidebar .cat-item .children .children a:hover,.wpb_widgetised_column .cat-item .children .children a:hover{color:'.$mc_light_hover_color.'}';
	$output .= '#sidebar .cat-got-children:after,.wpb_widgetised_column .cat-got-children:after{border-color:'.$mc_text_color.'; color:'.$mc_text_color.';}';
	$output .= '#sidebar .product_list_widget span.amount,.wpb_widgetised_column .product_list_widget span.amount{color:'.$mc_text_color.'}';
	$output .= '#sidebar .product_list_widget ins span.amount,.wpb_widgetised_column .product_list_widget ins span.amount{color:'.$mc_hl_color.'}';
	
	//added to cart
	

	$output .= '#header_container .cart-notification{background:'.$mc_light_hover_color.'; border-left:5px solid '.$mc_hl_color.';  }';
	$output .= '#header_container .cart-notification{color:'.$mc_text_color.'; }';
	$output .= '#header_container .cart-notification span{color:'.$mc_bg_color.'; }';




/*-----------------------------------------------------------------------------------*/

/* Tabs shortcodes

/*-----------------------------------------------------------------------------------*/


	$output .= '.rd_tabs li,.rd_tabs.horizontal .tabs-container{background:'.$mc_bg_color.'; }';
	$output .= '.rd_tabs.horizontal .tabs li,.rd_tabs.horizontal .tabs-container{border:1px solid '.$mc_border_color.'; }.rd_tabs.horizontal .tabs li:last-child{border-right:1px solid '.$mc_border_color.' !important; }.rd_tabs.horizontal .active{border-bottom:1px solid '.$mc_bg_color.' !important; }';
	
	$output .= '.rd_tabs.horizontal.rd_tab_1 li a,.rd_tabs.horizontal.rd_tab_2 li a,.rd_tabs.horizontal.rd_tab_4 li a{color:'.$mc_text_color.'; }.rd_tabs.horizontal.rd_tab_1 li a:hover,.rd_tabs.horizontal.rd_tab_2 li a:hover,.rd_tabs.horizontal.rd_tab_4 li a:hover{color:'.$mc_heading_color.'; }';
	$output .= '.rd_tabs.horizontal.rd_tab_1 .active {border-top:3px solid '.$mc_hl_color.'; }.rd_tabs.horizontal.rd_tab_1 .active a,.rd_tabs.horizontal.rd_tab_2 .active a,.rd_tabs.horizontal.rd_tab_1 .active a:hover,.rd_tabs.horizontal.rd_tab_2 .active a:hover{color:'.$mc_hl_color.'; }';
	$output .= '.rd_tabs.horizontal.rd_tab_2 .active {border-top:4px solid '.$mc_hl_color.'; }';

	$output .= '.rd_tabs.horizontal.rd_tab_3 .tabs li{background:'.$mc_text_color.'; }.rd_tabs.horizontal.rd_tab_3 .tabs li a{color:'.$mc_bg_color.'; }';
	$output .= '.rd_tabs.horizontal.rd_tab_3 .tabs li.active {background:'.$mc_bg_color.'; }.rd_tabs.horizontal.rd_tab_3 .tabs li.active a{color:'.$mc_heading_color.'; }';
	$output .= '.rd_tabs.horizontal.rd_tab_4 li.active a{color:'.$mc_heading_color.'; }';
	
	
//vertical tabs

	$output .= '.rd_tabs.rd_vtab_1 #tabs{border-top:1px solid '.$mc_border_color.'; }';
	$output .= '.rd_tabs.rd_vtab_1 li,.rd_tabs.rd_vtab_1 .tab_content{border:1px solid '.$mc_border_color.'; }';	
	$output .= '.rd_tabs.rd_vtab_1 li{background:'.$mc_grey_color.'; }';
	$output .= '.rd_tabs.rd_vtab_1 li.active,.rd_tabs.rd_vtab_1 .tabs-container{background:'.$mc_bg_color.'; }';
	$output .= '.rd_tabs.rd_vtab_1.rd_vtab_left li.active {border-left:1px solid rgba(0,0,0,0); border-right:1px solid '.$mc_bg_color.';}.rd_tabs.rd_vtab_1.rd_vtab_right li.active {border-right:1px solid rgba(0,0,0,0); border-left:1px solid '.$mc_bg_color.';}';
	$output .= '.rd_tabs.vertical li a{color:'.$mc_text_color.';}.rd_tabs.rd_vtab_1.vertical.rd_vtab_left li a{border-left:5px solid'.$mc_grey_color.';}.rd_tabs.rd_vtab_1.vertical.rd_vtab_right li a{border-right:5px solid'.$mc_grey_color.';}';
	$output .= '.rd_tabs.rd_vtab_1.vertical.rd_vtab_left li.active a{color:'.$mc_hover_color.'; border-left:5px solid'.$mc_hl_color.';}.rd_tabs.rd_vtab_1.vertical.rd_vtab_right li.active a{color:'.$mc_hover_color.'; border-right:5px solid'.$mc_hl_color.';}';

	$output .= '.rd_tabs.rd_vtab_2 li{border-bottom:1px solid '.$mc_border_color.'; }';
	$output .= '.rd_tabs.rd_vtab_2 li.active a{color:'.$mc_hl_color.'; }';
	$output .= '.rd_tabs.rd_vtab_2 li{border-bottom:1px solid '.$mc_border_color.'; }';	
	$output .= '.rd_tabs.rd_vtab_2.rd_vtab_left .tabs-container{border-left:1px solid '.$mc_border_color.'; }';
	$output .= '.rd_tabs.rd_vtab_2.rd_vtab_left .tab_content{border-left:1px solid '.$mc_border_color.'; background:'.$mc_bg_color.';}.rd_tabs.rd_vtab_2.rd_vtab_right .tab_content{border-right:1px solid '.$mc_border_color.'; background:'.$mc_bg_color.';}';	
	


/*-----------------------------------------------------------------------------------*/

/* Alert shortcodes

/*-----------------------------------------------------------------------------------*/

	$output .= '.rd_clear_alert{border:1px solid '.$mc_border_color.'; }';	
	
	

/*-----------------------------------------------------------------------------------*/

/* Set Coming Soon Page and Loader

/*-----------------------------------------------------------------------------------*/	
//Set variables


	$csp_fc = $rd_data['rd_csp_first_color'];
	$csp_sc = $rd_data['rd_csp_second_color'];
	$rgba_sc = rd_hex_to_rgb_array($csp_sc);
	$csp_tc = $rd_data['rd_csp_third_color'];	
	$rgba_tc = rd_hex_to_rgb_array($csp_tc);
	$csp_bc = $rd_data['rd_csp_ball_color'];


	$lb_fc = $rd_data['rd_loader_bar_first_color'];
	$lb_sc = $rd_data['rd_loader_bar_second_color'];
	
	
	$lbs_fc = $rd_data['rd_loader_sb_first_color'];
	$lbs_sc = $rd_data['rd_loader_sb_second_color'];
	$rgba_scl = rd_hex_to_rgb_array($lbs_sc);
	$lbs_tc = $rd_data['rd_loader_sb_third_color'];	
	$rgba_tcl = rd_hex_to_rgb_array($lbs_tc);
	$lbs_bc = $rd_data['rd_loader_sb_ball_color'];
	

	$output .= '.thefox_bigloader .loader_button{background:'.$csp_bc.'; }';
	$output .= '#coming_soon_form input[type=button]{background:'.$csp_fc.'; }#coming_soon_form input[type=button]:hover{background:'.$csp_bc.'; }';
	$output .= '.thefox_bigloader .loader_tophalf{background: -moz-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 0%, '.$csp_fc.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5)) color-stop(100%,'.$csp_fc.')); background: -webkit-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 0%,'.$csp_fc.' 100%); background: -o-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 0%,'.$csp_fc.' 100%); background: -ms-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 0%,'.$csp_fc.' 100%); background: linear-gradient(to right, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 0%,'.$csp_fc.' 100%);}';
	$output .= '.thefox_bigloader .loader_bottomhalf{background: -moz-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 1%, rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(1%,rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5)), color-stop(100%,rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0))); background: -webkit-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 1%,rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0) 100%); background: -o-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 1%,rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0) 100%); background: -ms-linear-gradient(left, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 1%,rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0) 100%); background: linear-gradient(to right, rgba('.$rgba_sc[0].', '.$rgba_sc[1].', '.$rgba_sc[2].', 0.5) 1%,rgba('.$rgba_tc[0].', '.$rgba_tc[1].', '.$rgba_tc[2].', 0)  100%);}';
	
	
		$output .= '#jpreOverlay .thefox_bigloader .loader_button{background:'.$lbs_bc.'; }';
		$output .= '#jpreOverlay .thefox_bigloader .loader_tophalf{background: -moz-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 0%, '.$lbs_fc.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5)) color-stop(100%,'.$lbs_fc.')); background: -webkit-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 0%,'.$lbs_fc.' 100%); background: -o-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 0%,'.$lbs_fc.' 100%); background: -ms-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 0%,'.$lbs_fc.' 100%); background: linear-gradient(to right, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 0%,'.$lbs_fc.' 100%);}';
	$output .= '#jpreOverlay .thefox_bigloader .loader_bottomhalf{background: -moz-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 1%, rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(1%,rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5)), color-stop(100%,rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0))); background: -webkit-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 1%,rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0) 100%); background: -o-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 1%,rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0) 100%); background: -ms-linear-gradient(left, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 1%,rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0) 100%); background: linear-gradient(to right, rgba('.$rgba_scl[0].', '.$rgba_scl[1].', '.$rgba_scl[2].', 0.5) 1%,rgba('.$rgba_tcl[0].', '.$rgba_tcl[1].', '.$rgba_tcl[2].', 0)  100%);}';
	

	$output .= '#jpreBar {background: '.$lb_fc.'; background: -moz-linear-gradient(left,  '.$lb_fc.' 0%, '.$lb_sc.' 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$lb_fc.'), color-stop(100%,'.$lb_sc.')); background: -webkit-linear-gradient(left,  '.$lb_fc.' 0%,'.$lb_sc.' 100%); background: -o-linear-gradient(left,  '.$lb_fc.' 0%,'.$lb_sc.' 100%); background: -ms-linear-gradient(left,  '.$lb_fc.' 0%,'.$lb_sc.' 100%); background: linear-gradient(to right,  '.$lb_fc.' 0%,'.$lb_sc.' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$lb_fc.'", endColorstr="'.$lb_sc.'",GradientType=1 );} ';
	
	$output .= '#preloader_3:before{background:'.$mc_hl_color.'}#preloader_3:after{background:'.$mc_alt_hl_color.'}@-webkit-keyframes preloader_3_before { 0% {transform: translateX(0px) rotate(0deg)}  50% {transform: translateX(50px) scale(1.2) rotate(260deg); background:'.$mc_alt_hl_color.';border-radius:0px;}  100% {transform: translateX(0px) rotate(0deg)}} @keyframes preloader_3_before {  0% {transform: translateX(0px) rotate(0deg)}   50% {transform: translateX(50px) scale(1.2) rotate(260deg); background:'.$mc_alt_hl_color.';border-radius:0px;}      100% {transform: translateX(0px) rotate(0deg)}} @-webkit-keyframes preloader_3_after {  0% {transform: translateX(0px)}   50% {transform: translateX(-50px) scale(1.2) rotate(-260deg); background:'.$mc_hl_color.'; border-radius:0px;}    100% {transform: translateX(0px)}} @keyframes preloader_3_after {    0% {transform: translateX(0px)}    50% {transform: translateX(-50px) scale(1.2) rotate(-260deg);background:'.$mc_hl_color.';border-radius:0px;}   100% {transform: translateX(0px)}}';	
	

/*-----------------------------------------------------------------------------------*/

/* Set Footer

/*-----------------------------------------------------------------------------------*/
//Set variables

	$footer_bg_color = $rd_data['rd_footer_bg_color'];
	$footer_heading_color = $rd_data['rd_footer_heading_color'];
	$footer_text_color = $rd_data['rd_footer_text_color'];
	$footer_hl_color = $rd_data['rd_footer_hl_color'];
	$footer_hover_color = $rd_data['rd_footer_hover_color'];
	$footer_border_color = $rd_data['rd_footer_border_color'];
	
	
	$output .= '#footer_bg,#footer{background:'.$footer_bg_color.'; }';
	$output .= '#footer,#footer .cat-item a{color:'.$footer_text_color.'; }';
	$output .= '#footer .widget h2,#footer .widget_recent_entry h4 a{color:'.$footer_heading_color.'; }';
	$output .= '.footer_type_3 .widget h2,.footer_type_8 .widget h2{border-left:5px solid '.$footer_hl_color.'; }';
	$output .= '#footer a{color:'.$footer_hl_color.'; }';
	$output .= '#footer a:hover{color:'.$footer_hover_color.'; }';
	$output .= '#footer .tagcloud a{border:1px solid '.$footer_text_color.'; color:'.$footer_text_color.'; }#footer .tagcloud a:hover{border:1px solid '.$footer_hl_color.'; background:'.$footer_hl_color.' !important;  color:#ffffff;}';
	$output .= '#footer .cat-item a,#footer .children .cat-item a{border-top:1px solid '.$footer_border_color.'; border-color:'.$footer_border_color.' !important;}';
	$output .= '#footer .widget_recent_entries li{border-bottom:1px solid '.$footer_border_color.'; border-color:'.$footer_border_color.' !important;}';
	$output .= '.footer_type_9{border-top:1px solid '.$footer_border_color.';}';
	$output .= '.footer_type_5{border-top:10px solid '.$footer_border_color.';}';
	$output .= '.footer_type_10 .widget_line .small_l_left{border-top:3px solid '.$footer_hover_color.';}';
	
//widget 

	$output .= '#footer .widget_recent_entries ul li{border-bottom:1px solid '.$footer_border_color.'}#footer .widget_recent_entries ul li a{color:'.$footer_text_color.'}#footer .widget_recent_entries ul li a:hover{color:'.$footer_hl_color.'}';
	$output .= '#footer #recentcomments li{border-bottom:1px solid '.$footer_border_color.'}#footer #recentcomments li a{color:'.$footer_heading_color.';}#footer #recentcomments li a:hover{color:'.$footer_hover_color.';}';
	$output .= '#footer .rd_widget_recent_entries li,#footer .rd_widget_recent_entries_f li{border-bottom:1px solid '.$footer_border_color.'}';
	$output .= '#footer .w_comment a{color:'.$footer_text_color.';}#footer .w_comment a:hover{color:'.$footer_hl_color.';}';
	$output .= '#footer .widget_recent_entry h4 a{color:'.$footer_heading_color.';}#footer .widget_recent_entry h4 a:hover{color:'.$footer_hl_color.';}';
	$output .= '#footer .widget_archive ul li,#footer .widget_meta ul li{border-bottom:1px solid '.$footer_border_color.'}#footer .widget_archive ul li a,#footer .widget_meta ul li a{color:'.$footer_text_color.';}#footer .widget_archive ul li a:hover,#footer .widget_meta ul li a:hover{color:'.$mc_hl_color.';}';
	$output .= '#footer .page_item a, #footer .menu-item a{border-bottom:1px solid '.$footer_border_color.'; color:'.$footer_text_color.';}#footer .page_item a:hover, #footer .menu-item a:hover,#footer .current_page_item a,#footer .current_page_item a{color:'.$footer_hl_color.'; }#footer .page_item a:before, #footer .menu-item a:before { color:'.$footer_hl_color.';}';
	$output .= '#footer #wp-calendar caption{background:'.$footer_heading_color.'; color:'.$footer_bg_color.';}#footer #wp-calendar{border:1px solid '.$footer_border_color.'}#footer #wp-calendar th{color:'.$footer_hl_color.';}#footer #wp-calendar tbody td a{color:#fff; background:'.$footer_hl_color.';}#footer #wp-calendar tbody td a:hover{color:#fff; background:'.$footer_hl_color.';}#footer #wp-calendar td#next a:hover:after,#footer #wp-calendar td#prev a:hover:after{background:'.$footer_hl_color.';}';
	$output .= '#footer #lang_sel a{color:'.$footer_text_color.'; background:'.$footer_bg_color.'; border:1px solid '.$footer_text_color.'}#footer #lang_sel a:hover{color:'.$footer_heading_color.'}';	


	$fb_bg_color = $rd_data['rd_footer_bar_bg_color'];
	$fb_heading_color = $rd_data['rd_footer_bar_heading_color'];
	$fb_text_color = $rd_data['rd_footer_bar_text_color'];
	$fb_hl_color = $rd_data['rd_footer_bar_hl_color'];
	$fb_hover_color = $rd_data['rd_footer_bar_hover_color'];
	$fb_border_color = $rd_data['rd_footer_bar_border_color'];	


	$output .= '#footer_coms {background:'.$fb_bg_color.'; }';
	$output .= '#footer_coms a{color:'.$fb_hl_color.'; }';
	$output .= '#footer_coms a:hover,#footer_coms .menu a:hover,.f_si_type1 a:hover,#footer_coms #to_top_img:hover{color:'.$fb_hover_color.'; }';
	$output .= '#footer_coms,#footer_coms .menu a,#f_social_icons a,#footer_coms #to_top_img{color:'.$fb_text_color.'; }';
	$output .= '#footer_coms{border-top:1px solid '.$fb_border_color.';}';
	$output .= '#footer_coms .f_si_type2 #to_top_img{background:'.$fb_hl_color.'!important;};';






	
/*-----------------------------------------------------------------------------------*/

/* Final Output

/*-----------------------------------------------------------------------------------*/
		


		if ($output <> '') {



			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";

			echo !empty( $output ) ? $output : '';	



		}

}

add_action('wp_head', 'rd_head_css');



/////----------------------////////* Custom Font Background *////////----------------------/////




?>