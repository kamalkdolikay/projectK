<?php 

/*-----------------------------------------------------------------------------------*/

/*  Portfolio shortcode

/*-----------------------------------------------------------------------------------*/

function portfolio_sc($atts, $content = null)
        {
			global $rd_data;
			
            extract(shortcode_atts(array(
                'heading_size' => '' ,
                'heading_color' => '',
                'heading_text' => '',
				'port_start' => '4',
				'port_click' => '4',
                'port_layout' => '4 columns',
				'port_type' => 'normal',
				
				
				'port_bg_color' => '',
				'port_title_color' => '',
				'port_text_color' => '',
				'port_button_color' => '',
				'port_border_color' => '',
				'port_hover_bg_color' => '',
				'port_hover_title_color' => '',
				'port_hover_text_color' => '',
				'port_hover_button_color' => '',
				'port_hover_border_color' => '',
				'port_thumbnail' => '',
							
				
				
				
				'filter' => '',
				'filter_type' => '',
				'desc_border' => '',
				'icon' => '',
				'port_navigation' => '',
				
				'nav_bg' => '',
				'nav_color' => '',
				'nav_border' => '',
				'nav_hover_color' => '',
				'nav_hover_bg' => '',
				
				'button_bg' => '',
				'button_title' => '',
				'button_border' => '',
				'button_hover_title' => '',
				'button_hover_bg' => '',
				'desc_bg' => '',
				'desc_title' => '',
				'desc_cat' => '',
				'title_pos' => '',
				'filter_text_color' => '',
				'filter_background_color' => '',
				'selected_filter_bg_color' => '',
				'filter_border_color' => '',
                'category' => 'all',
                'tags' => 'all',
				'overlay' => '',
				'overlay_color' => '',
				'overlay_color_2' => '',
            ), $atts));
ob_start();
global $rd_data;
$portfolio_rand_class = RandomString(20);
$items_on_start = $port_start; 
$items_per_click = $port_click;
$view_type = $port_layout;    
$tags = $tags;             
       
if($items_on_start<1){
		$items_on_start = 4;
	}
if($items_per_click<1){
		$items_per_click = 4;
	}
echo '<script>jQuery.noConflict(); var $ = jQuery; </script>';

wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting', get_template_directory_uri() . '/js/sorting.js');



if($port_bg_color== '' ){

	$port_bg_color = $rd_data['rd_content_bg_color'];
}
				if($port_title_color== '' ){

	$port_title_color = $rd_data['rd_content_heading_color'];
}
				if($port_text_color== '' ){

	$port_text_color = $rd_data['rd_content_text_color'];
}
				if($port_button_color== '' ){

	$port_button_color = $rd_data['rd_content_heading_color'];
}
				if($port_border_color== '' ){

	$port_border_color = $rd_data['rd_content_border_color'];
}
				if($port_hover_bg_color== '' ){

	$port_hover_bg_color = $rd_data['rd_content_heading_color'];
}
				if($port_hover_title_color== '' ){

	$port_hover_title_color = $rd_data['rd_content_bg_color'];
}
				if($port_hover_text_color== '' ){

	$port_hover_text_color = $rd_data['rd_content_text_color'];
}
				if($port_hover_button_color== '' ){

	$port_hover_button_color = $rd_data['rd_content_hl_color'];					

}
				if($port_hover_border_color== '' ){
					
	$port_hover_border_color = $rd_data['rd_content_heading_color'];

}


				if($filter_background_color== '' ){

	$filter_background_color = $rd_data['rd_content_bg_color'];
}
				if($filter_text_color== '' ){

	$filter_text_color = $rd_data['rd_content_text_color'];
}
				if($selected_filter_bg_color== '' ){

	$selected_filter_bg_color = $rd_data['rd_content_hl_color'];					

}
				if($filter_border_color== '' ){
					
	$filter_border_color = $rd_data['rd_content_border_color'];

}




				if($nav_bg== '' ){

	$nav_bg = $rd_data['rd_content_bg_color'];
}
				if($nav_color== '' ){

	$nav_color = $rd_data['rd_content_text_color'];
}
				if($button_hover_bg== '' ){

	$button_hover_bg = $rd_data['rd_content_hl_color'];					

}
				if($nav_hover_color== '' ){

	$nav_hover_color = $rd_data['rd_content_bg_color'];
}
				if($nav_border== '' ){
					
	$nav_border = $rd_data['rd_content_border_color'];

}

				if($button_bg== '' ){

	$button_bg = $rd_data['rd_content_bg_color'];
}
				if($button_title== '' ){

	$button_title = $rd_data['rd_content_heading_color'];
}
				if($button_hover_bg== '' ){

	$button_hover_bg = $rd_data['rd_content_hl_color'];					

}
				if($button_hover_title== '' ){

	$button_hover_title = $rd_data['rd_content_bg_color'];
}
				if($button_border== '' ){
					
	$button_border = $rd_data['rd_content_border_color'];

}




////////////////////////////////////////////
////                                    ///
///        Set Portfolio Container     ///
//                                    ///
////////////////////////////////////////


echo '<div id="random'.$portfolio_rand_class.'_port" class="portfolio">';


////////////////////////////////////////////
////                                    ///
///              Filter                ///
//                                    ///
////////////////////////////////////////

/// Type 1
if($filter_type == 'filter_type_1' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a:hover{background:'.$selected_filter_bg_color.'; border:1px solid '.$selected_filter_bg_color.'; color:#fff;}';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{border:1px solid '.$filter_border_color.'}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:'.$filter_background_color.'}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 2
if($filter_type == 'filter_type_2' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a:hover{color:'.$selected_filter_bg_color.'; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{border:1px solid '.$filter_border_color.'; border-right:none;}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:'.$filter_background_color.'}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 3
if($filter_type == 'filter_type_3' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts .is-checked{color:'.$selected_filter_bg_color.' !important; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options ,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{border:1px solid '.$filter_border_color.';}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options{background:'.$filter_background_color.'}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 4
if($filter_type == 'filter_type_4' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts .is-checked{color:'.$selected_filter_bg_color.' !important; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{border:1px solid '.$filter_border_color.';}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{background:'.$filter_background_color.'}#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:none!important;}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 5
if($filter_type == 'filter_type_5' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts .is-checked{color:'.$selected_filter_bg_color.' !important; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{border:1px solid '.$filter_border_color.';}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{background:'.$filter_background_color.'}#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:none!important;}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 6
if($filter_type == 'filter_type_6' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts .is-checked{color:'.$selected_filter_bg_color.' !important; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{border:1px solid '.$filter_border_color.';}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{background:'.$filter_background_color.'}#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:none!important;}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}
/// Type 7
if($filter_type == 'filter_type_7' ){
	
$output = '<style>';
if($selected_filter_bg_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options .selected a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts .is-checked{color:'.$selected_filter_bg_color.' !important; }';
}
if($filter_border_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{border:1px solid '.$filter_border_color.';}#random'.$portfolio_rand_class.'_port .'.$filter_type.'{border-top:1px solid '.$filter_border_color.'; border-bottom:double 3px '.$filter_border_color.';}';
}
if($filter_background_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a{background:rgba(255,255,255,0);}#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts,#random'.$portfolio_rand_class.'_port .'.$filter_type.' .portfolio_sorts a{background:'.$filter_background_color.' !important;}';
}
if($filter_text_color !== '' ){
$output .= '#random'.$portfolio_rand_class.'_port .'.$filter_type.' #options a,#random'.$portfolio_rand_class.'_port .'.$filter_type.' #sorts{color:'.$filter_text_color.'}';
}
$output .= '</style>';
echo !empty( $output ) ? $output : '';
}





////////////////////////////////////////////
////                                    ///
///             Set Overlay effect     ///
//                                    ///
////////////////////////////////////////



if ( $overlay == 'rd_hover_white' || $overlay == 'rd_hover_whiteic' || $overlay == 'rd_hover_gradient' ){
echo '<style>#random'.$portfolio_rand_class.'_port .portfolio_desc{ position:absolute; bottom:10%; width:100%; height:40px; padding:0; border:none!important; background:none!important; text-align:center; z-index:3; opacity:0;}#random'.$portfolio_rand_class.'_port .element:hover .portfolio_desc{opacity:1; bottom:50%;}#random'.$portfolio_rand_class.'_port  .element:hover .img_link{left:4px;  opacity:1;}#random'.$portfolio_rand_class.'_port  .element:hover .post_link{right:4px; opacity:1;}';
	
	if ( $overlay == 'rd_hover_white'){
	
	echo '#random'.$portfolio_rand_class.'_port .element:hover .port_overlay{ background:#fff; opacity:1;}';
	
	}
	if ( $overlay == 'rd_hover_whiteic'){
	
	echo '#random'.$portfolio_rand_class.'_port .element:hover .port_overlay{ background:#fff; opacity:1; }#random'.$portfolio_rand_class.'_port .post_link{background:#444;}#random'.$portfolio_rand_class.'_port .post_link:before{color:#fff;}#random'.$portfolio_rand_class.'_port .img_link{border:1px solid #444;}#random'.$portfolio_rand_class.'_port .img_link:before{color:#444;}';
	
	}
	if ( $overlay == 'rd_hover_gradient'){
			if ($overlay_color_2 == '' ){
			echo '#random'.$portfolio_rand_class.'_port .element:hover .port_overlay,.portfolio_desc:hover .port_overlay{ background:'.$overlay_color.'; opacity:1; }#random'.$portfolio_rand_class.'_port .portfolio_desc h2 a,#random'.$portfolio_rand_class.'_port .portfolio_desc h3{color:#ffffff !important}';	
			}
			else {
			echo '#random'.$portfolio_rand_class.'_port .element:hover .port_overlay,.portfolio_desc:hover .port_overlay{ opacity:1; background: '.$overlay_color.';  background: -moz-linear-gradient(left, '.$overlay_color.' 0%, '.$overlay_color_2.' 100%);  background: -webkit-gradient(linear, left top, right top, color-stop(0%,'.$overlay_color.'), color-stop(100%,'.$overlay_color_2.')); background: -webkit-linear-gradient(left, '.$overlay_color.' 0%,'.$overlay_color_2.' 100%);  background: -o-linear-gradient(left, '.$overlay_color.' 0%,'.$overlay_color_2.' 100%); /* Opera 11.10+ */ background: -ms-linear-gradient(left, '.$overlay_color.' 0%,'.$overlay_color_2.' 100%);  background: linear-gradient(to right, '.$overlay_color.' 0%,'.$overlay_color_2.' 100%);  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$overlay_color.'", endColorstr="'.$overlay_color_2.'",GradientType=1 );  }#random'.$portfolio_rand_class.'_port .portfolio_desc h2 a,#random'.$portfolio_rand_class.'_port .portfolio_desc h3{color:#ffffff !important}';	
			}
	}
	if($overlay == 'rd_hover_whiteic' || $overlay == 'rd_hover_gradient'){
		echo '#random'.$portfolio_rand_class.'_port .portfolio_desc{margin-bottom:-55px;}.img_link,.post_link{margin-top:-55px;}</style>';
	}
	else{
		echo '#random'.$portfolio_rand_class.'_port .portfolio_desc{margin-bottom:-20px;}.img_link,.post_link{display:none;}</style>';
	}
	if($desc_cat !== ''){
		echo '<style>#random'.$portfolio_rand_class.'_port .portfolio_desc h3{color:'.$desc_cat.'}</style>';
	}
}
if ( $overlay == 'rd_hover_lily' ||  $overlay == 'rd_hover_goliath' ||  $overlay == 'rd_hover_steve'){
	
	echo '<style>#random'.$portfolio_rand_class.'_port figcaption h2{color:'.$desc_title.';}#random'.$portfolio_rand_class.'_port figcaption p{color:'.$desc_cat.';}#random'.$portfolio_rand_class.'_port .ico_link{background:'.$overlay_color.'!important;}</style>';
}
if ( $overlay == 'rd_hover_sadie'){
	
	echo '<style>#random'.$portfolio_rand_class.'_port figcaption h2{color:'.$desc_title.';}#random'.$portfolio_rand_class.'_port figcaption p{color:'.$desc_cat.';}#random'.$portfolio_rand_class.'_port figcaption::before{background: -webkit-linear-gradient(top, rgba(72,76,97,0) 0%, '.$overlay_color.' 75%); background: linear-gradient(to bottom, rgba(72,76,97,0) 0%, '.$overlay_color.' 75%);</style>';
}
if ( $overlay == 'rd_hover_bubba' || $overlay == 'rd_hover_chico' ||  $overlay == 'rd_hover_roxy' ||  $overlay == 'rd_hover_layla'  ){
	
	echo '<style>#random'.$portfolio_rand_class.'_port .ico_link{background:'.$overlay_color.'!important;}</style>';
}
if ( $overlay == 'rd_hover_trending'){
	
	echo '<style>#random'.$portfolio_rand_class.'_port .port_overlay{background:'.$overlay_color.'!important;}</style>';
}


////////////////////////////////////////////
////                                    ///
///        Portfolio  Desing           ///
//                                    ///
////////////////////////////////////////



if ( $port_type == 'port_type_2'  ){

	$output = '<style>';	

	if($port_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border:1px solid '.$port_border_color.'; border-bottom:none;}';
	}

	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}

if ( $port_type == 'port_type_4'  ){

	$output = '<style>';

	if($port_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border:1px solid '.$port_border_color.';}';
	}
	if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .portfolio_desc {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .portfolio_desc a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .portfolio_desc h3{color:'.$port_text_color.'}';
	}
	if($port_hover_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .filter_img{border:1px solid '.$port_hover_border_color.';}';
	}

	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}

if ( $port_type == 'port_type_5'  ){

	$output = '<style>';
	
	if($port_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border:1px solid '.$port_border_color.'; border-bottom:none;}#random'.$portfolio_rand_class.'_port .port_item_details{border:1px solid '.$port_border_color.'; border-top:none;}';
	}
	if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details h3{color:'.$port_text_color.'}';
	}
	if($port_hover_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .filter_img{border:1px solid '.$port_hover_border_color.'; border-bottom:none;}#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{border:1px solid '.$port_hover_border_color.'; border-top:none;}';
	}
		if($port_hover_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{background:'.$port_hover_bg_color.'}';
	}
	if($port_hover_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details a h2{color:'.$port_hover_title_color.'}';
	}
	if($port_hover_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details h3{color:'.$port_hover_text_color.'}';
	}
	$output .='</style>';
	echo !empty( $output ) ? $output : '';		

}
if ( $port_type == 'port_type_6'  ){
	
	$output = '<style>';
	
	if($port_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border:1px solid '.$port_border_color.'; border-top:none;}#random'.$portfolio_rand_class.'_port .port_item_details{border:1px solid '.$port_border_color.'; border-bottom:none;}';
	}
		if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details h3{color:'.$port_text_color.'}';
	}
	if($port_hover_border_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .filter_img{border:1px solid '.$port_hover_border_color.'; border-top:none;}#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{border:1px solid '.$port_hover_border_color.'; border-bottom:none;}';
	}
		if($port_hover_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{background:'.$port_hover_bg_color.'}';
	}
	if($port_hover_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details a h2{color:'.$port_hover_title_color.'}';
	}
	if($port_hover_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details h3{color:'.$port_hover_text_color.'}';
	}
	
	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}
if ( $port_type == 'port_type_7'  ){

	$output = '<style>';
	
	if($port_border_color !== ''){
 		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border-right:1px solid '.$port_border_color.';}#random'.$portfolio_rand_class.'_port .item_details_info{border-top:1px solid '.$port_border_color.'; border-bottom:1px solid '.$port_border_color.'; }';
	}
	if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details h3,#random'.$portfolio_rand_class.'_port .port_item_details{color:'.$port_text_color.'}';
	}
	if($port_button_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .view-portfolio-item{color:'.$port_button_color.'; border:1px solid '.$port_button_color.'; background:'.$port_bg_color.';}#random'.$portfolio_rand_class.'_port .view-portfolio-pp{color:'.$port_bg_color.'; border:1px solid '.$port_title_color.'; background:'.$port_title_color.';}';
	}
	if($port_hover_border_color !== ''){
 		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .filter_img{border-right:1px solid '.$port_hover_border_color.';}#random'.$portfolio_rand_class.'_port .element:hover .item_details_info{border-top:1px solid '.$port_hover_border_color.'; border-bottom:1px solid '.$port_hover_border_color.'; }';
	}
	if($port_hover_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details {background:'.$port_hover_bg_color.'}';
	}
	if($port_hover_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details a h2{color:'.$port_hover_title_color.'}';
	}
	if($port_hover_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details h3,#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{color:'.$port_hover_text_color.'}';
	}
	if($port_hover_button_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .view-portfolio-item{color:'.$port_hover_title_color.'; border:1px solid '.$port_hover_button_color.'; background:'.$port_hover_button_color.';}#random'.$portfolio_rand_class.'_port .element:hover .view-portfolio-pp{color:'.$port_hover_bg_color.'; border:1px solid '.$port_hover_title_color.'; background:'.$port_hover_title_color.';}';
	}
	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}

if ( $port_type == 'port_type_7' || $port_type == 'port_type_8' ){

	$output = '<style>';


	if($port_border_color !== ''){
 		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border-right:1px solid '.$port_border_color.';}#random'.$portfolio_rand_class.'_port .item_details_info{border-top:1px solid '.$port_border_color.'; border-bottom:1px solid '.$port_border_color.'; }#random'.$portfolio_rand_class.'_port .port_item_details{border-right:1px solid '.$port_border_color.'; border-bottom:1px solid '.$port_border_color.'; }#random'.$portfolio_rand_class.'_port .element:first-child .port_item_details {border-top:1px solid '.$port_border_color.';}';
	}
	if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details h3,#random'.$portfolio_rand_class.'_port .port_item_details{color:'.$port_text_color.'}';
	}
	if($port_button_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .view-portfolio-item{color:'.$port_button_color.'; border:1px solid '.$port_button_color.'; background:'.$port_bg_color.';}#random'.$portfolio_rand_class.'_port .view-portfolio-pp{color:'.$port_bg_color.'; border:1px solid '.$port_title_color.'; background:'.$port_title_color.';}';
	}
	if($port_hover_border_color !== ''){
 		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .filter_img{border-right:1px solid '.$port_hover_border_color.';}#random'.$portfolio_rand_class.'_port .element:hover .item_details_info{border-top:1px solid '.$port_hover_border_color.'; border-bottom:1px solid '.$port_hover_border_color.'; }';
	}
	if($port_hover_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details {background:'.$port_hover_bg_color.'}';
	}
	if($port_hover_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details a h2{color:'.$port_hover_title_color.'}';
	}
	if($port_hover_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .port_item_details h3,#random'.$portfolio_rand_class.'_port .element:hover .port_item_details{color:'.$port_hover_text_color.'}';
	}
	if($port_hover_button_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .element:hover .view-portfolio-item{color:'.$port_hover_title_color.'; border:1px solid '.$port_hover_button_color.'; background:'.$port_hover_button_color.';}#random'.$portfolio_rand_class.'_port .element:hover .view-portfolio-pp{color:'.$port_hover_bg_color.'; border:1px solid '.$port_hover_title_color.'; background:'.$port_hover_title_color.';}';
	}
	
if ( $port_type == 'port_type_8'  ){
		
	$output .= '#random'.$portfolio_rand_class.'_port .element:nth-child(even) .filter_img{float:right; border-left:1px solid '.$port_border_color.';  border-right:none!important;}#random'.$portfolio_rand_class.'_port .element:nth-child(even) .port_item_details{float:left; border-left:1px solid '.$port_border_color.';  border-right:none!important;}#random'.$portfolio_rand_class.'_port .element:hover:nth-child(even) .filter_img{border-left:1px solid '.$port_hover_border_color.'; border-right:none!important;}';
}
	
	
	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}

if ( $port_type == 'port_type_9' ){

	$output = '<style>#random'.$portfolio_rand_class.'_port .element{margin-bottom:30px;}';


	if($port_border_color !== ''){
 		$output .= '#random'.$portfolio_rand_class.'_port .filter_img{border-right:1px solid '.$port_border_color.';}';
	}
	if($port_bg_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details {background:'.$port_bg_color.'}';
	}
	if($port_title_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details a h2{color:'.$port_title_color.'}';
	}
	if($port_text_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .port_item_details h3,#random'.$portfolio_rand_class.'_port .port_item_details{color:'.$port_text_color.'}';
	}
	if($port_button_color !== ''){
		$output .= '#random'.$portfolio_rand_class.'_port .view-portfolio-item{color:#ffffff; border:1px solid '.$port_button_color.'; background:'.$port_button_color.';}#random'.$portfolio_rand_class.'_port .view-portfolio-pp{color:#ffffff; border:1px solid '.$port_title_color.'; background:'.$port_title_color.';}';
	}

	$output .='</style>';
	echo !empty( $output ) ? $output : '';	

}



////////////////////////////////////////////
////                                    ///
///        Creating Portfolio          ///
//                                    ///
////////////////////////////////////////

if ( $filter !== ''){
		if ($tags == "all" || $tags=="") {
			echo '
				<div id="portfolio-tags" class="'.$filter_type.'">
				<ul class="splitter" id="options">';
			if($filter_type == 'filter_type_2' ){
            	    echo '<li style="border-right:1px solid '.$filter_border_color.'">';
			}else{
				echo '<li>';
			}
			
			rd_showPortCategory();
            echo '      </li>';
			if($filter_type == 'filter_type_3' ||$filter_type == 'filter_type_4' || $filter_type == 'filter_type_5' || $filter_type == 'filter_type_6'  || $filter_type == 'filter_type_7' ){?>
        		<li class="portfolio_sorts"><a>Sort by</a><ul id="sorts"  class="button-group"><li data-sort-by="">default</li><li data-sort-by="date">date</li><li data-sort-by="name">name</li></ul></li>
			<?php }
        
			echo '</ul></div>';
		
		}
}


if($port_type !== 'port_type_7' && $port_type !== 'port_type_8' && $port_type !== 'port_type_9' ){
            switch ($view_type) {
                case "1 column":
                    $view_type_class="columns1";
                    BREAK;
                case "2 columns":
                    $view_type_class="columns2";
                    BREAK;
                case "3 columns":
                    $view_type_class="columns3";
                    BREAK;
                case "4 columns":
                    $view_type_class="columns4";
                    BREAK;
                case "5 columns":
                    $view_type_class="columns5";
                    BREAK;
                case "6 columns":
                    $view_type_class="columns6";
                    BREAK;
              }
}else{
	$view_type_class="columns1"; }




//START PORTFOLIO


echo '<div class="portfolio_block image-grid '.$view_type_class.' '.$port_type.' '.$overlay.' '.$port_thumbnail.'" id="list">';
			
	if($port_navigation == 'classic_nav'){
		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
		else { $paged = 1; }
			$args = array(
	'posts_per_page'      => $port_start,
	'post_type'           => "Portfolio",
   	'post_status' => 'publish',
	'paged' => $paged
	);
        if ($category !== '' && $category !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'catportfolio',
                    'field' => 'slug',
                    'terms' => $category
                )
            );
        }

        if ($tags !== '' && $tags !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'tagportfolio',
                    'field' => 'slug',
                    'terms' => $tags
                )
            );
        }

        if ($category !== '' && $category !== "all" && $tags !== '' && $tags !== "all") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'catportfolio',
                    'field' => 'slug',
                    'terms' => $category
                ),
				array(
                    'taxonomy' => 'tagportfolio',
                    'field' => 'slug',
                    'terms' => $tags
                )
            );
        }
	
		$port_query = new WP_Query($args);
		
		
	global $more,$post;

	$more = 0;




 while ($port_query->have_posts()) : $port_query->the_post();

	if (!isset($echoallterm)) {$echoallterm = ''; $showterm = '';}
		$new_term_list = get_the_terms(get_the_id(), "tagportfolio");
		if (is_array($new_term_list)) {
			foreach ($new_term_list as $term) {
                    $tempname = strtr($term->name, array(
                    ' ' => '-',
                    ));
                    $echoallterm .= strtolower($tempname) . " ";
                    $echoterm = $term->name;
		}
		
		foreach ($new_term_list as $term) {
                    $showterm .= strtolower($term->name) . " ";
    	}
	}
    $i = 1;
    $pf = get_post_format();
	$project_url = get_post_meta($post->ID, 'rd_p_url', true);
			$project_thumb = get_post_meta($post->ID, 'rd_thumb', true);
    $linkToTheWork = get_permalink();
    $target = "";
	$current = $port_query->query_vars['paged'];
	$maxpages = $port_query->max_num_pages;
	
//Generating new items
if($port_thumbnail == 'thumbnail_type_5' || $port_thumbnail == 'thumbnail_type_6' ){
	echo '<div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element rd_'.$project_thumb.'">';
}else{
	echo '<div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element">';
}
	if ($port_type == "port_type_6") {
		echo '
		<div class="port_item_details"><a href="' . get_permalink( $post->ID ) . '"><h2>' . get_the_title() . '</h2></a><h3>'.$showterm.'</h3>
		<div class="item_details_info"><div class="item_details_date">' . get_the_date() . '</div>'.lip_love_it_link($post_id = null, '', '', $echo = true).'
		</div></div><div class="portfolio_sub_info"><div class="isotope_portfolio_name">' . get_the_title() . '</div><div class="isotope_portfolio_date">' . get_the_date('Y-m-d') . '</div></div>';
	}
	echo '
		<div class="filter_img">
		<div class="port_thumb_ctn">
		<div class="port_overlay"></div>
        <a '.$target.' href="' . $linkToTheWork . '" class="ico_link">';
					 
//Set thumbnail depending on portfolio design					 
	if( $port_type == 'port_type_7' || $port_type == 'port_type_8' || $port_type == 'port_type_9'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_classic"); }
	elseif($port_thumbnail == 'thumbnail_type_1'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_tn");
}elseif($port_thumbnail == 'thumbnail_type_2'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_squared");
}elseif($port_thumbnail == 'thumbnail_type_3'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_landscape");
}elseif($port_thumbnail == 'thumbnail_type_4'){
		echo get_the_post_thumbnail(get_the_id(), "portfolio_portrait");
}elseif($port_thumbnail == 'thumbnail_type_5'){
	if($project_thumb == 'portfolio_small_squared' || $project_thumb == 'portfolio_squared'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_squared');
	}if($project_thumb == 'portfolio_portrait'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_portrait');
	}if($project_thumb == 'portfolio_landscape'){
		echo get_the_post_thumbnail(get_the_id(), 'portfolio_landscape');
	}
}elseif($port_thumbnail == 'thumbnail_type_6'){
	if($project_thumb == 'portfolio_small_squared' || $project_thumb == 'portfolio_squared'){
		echo get_the_post_thumbnail(get_the_id(), array(960, 600));
	}if($project_thumb == 'portfolio_portrait'){
		echo get_the_post_thumbnail(get_the_id(), array (480, 600));
	}if($project_thumb == 'portfolio_landscape'){
		echo get_the_post_thumbnail(get_the_id(), array(960, 300));
	}
}elseif($port_thumbnail == 'thumbnail_type_7'){
	echo get_the_post_thumbnail(get_the_id(), 'full');
}
	echo   '
		</a><figcaption><div>
		<h2>' . get_the_title() . '</h2>
		<p>'.$showterm.'</p>
		</div>
		<a href="' . $linkToTheWork . '">View more</a>
		</figcaption>';
				
	if ('' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
	echo '<a href="'.$url. '" class="prettyPhoto port_img_link">';
    echo "<span class='img_link'>";
    echo '';
	echo "</span></a><a href='" . get_permalink( $post->ID ) . "' class='port_post_link'>";
    echo "<span class='post_link'><h2 class='fw_port_link'>" . get_the_title() . "</h2><h3 class='fw_port_tag'>".$showterm."</h3>";
    echo '';
	echo "</span></a>";
	echo ""; 
	
	}

	echo
        '<div class="portfolio_desc">
		<h2><a href="' . $linkToTheWork . '">' . get_the_title() . '</a></h2>
		<h3>'.$showterm.'</h3>
        </div>
		</div><!-- port_thumb_ctn END -->
		</div><!-- Filter img END -->';
	
	if ($port_type == "port_type_5" || $port_type == "port_type_7" || $port_type == "port_type_8" || $port_type == "port_type_9"   ) {
		echo '
		<div class="port_item_details"><a href="' . get_permalink( $post->ID ) . '"><h2>' . get_the_title() . '</h2></a><h3>'.$showterm.'</h3>
		<div class="item_details_info"><div class="item_details_date">' . get_the_date() . '</div>';
		if( function_exists('zilla_likes') ){
			echo do_shortcode('[zilla_likes]');
			
		}
		echo '</div><div class="port_small_excerpt">';
	if ( $port_type == "port_type_7" || $port_type == "port_type_8" ) {
		echo rd_custom_excerpt('rd_port_excerpt','rd_port_more');
	}
	if ( $port_type == "port_type_9" ) {
		echo rd_custom_excerpt('rd_port_long_excerpt','rd_port_more');
	}	
		echo '<div class="port_project_buttons">'; if($project_url !== '' ){ echo'<a href="'.$project_url.'" target="_blank" class="view-portfolio-pp">' . __('Launch Project', 'thefoxwp') . '</a>'; }
		echo '<a class="view-portfolio-item" href="' . get_permalink($post->ID) . '">' . __('View More', 'thefoxwp') . '</a></div></div>
		</div>';
	}

	echo'<div class="portfolio_sub_info"><div class="isotope_portfolio_name">' . get_the_title() . '</div><div class="isotope_portfolio_date">' . get_the_date('Y-m-d') . '</div></div></div><!-- element END -->';


#END Portfolio 



	$i++;
	unset($echoallterm, $pf);
	endwhile;	
	
	
}
     echo '

                </div><!-- .portfolio_block -->

                <div class="rd_clear"><!-- ClearFix --></div>';

if ( $port_navigation == 'loadmore_nav' ){ 
$output = '';
$output .= '<style>#random'.$portfolio_rand_class.'_port .btn_load_more{background:'.$button_bg.'; color:'.$button_title.'; border:1px solid '.$button_border.';}#random'.$portfolio_rand_class.'_port .refresh_icn:before{color:'.$button_title.';}#random'.$portfolio_rand_class.'_port .btn_load_more:hover{background:'.$button_hover_bg.'; color:'.$button_hover_title.'; border:1px solid '.$button_hover_bg.';}#random'.$portfolio_rand_class.'_port .btn_load_more:hover .refresh_icn:before{color:'.$button_hover_title.';}</style>';
$output .= '<div class="load_more_cont"><a class="btn_load_more get_portfolio_works_btn" href="#"><span class="fa-plus refresh_icn"></span>'.__('Load More','thefoxwp').'<span></span></a></div>';
echo !empty( $output ) ? $output : ''; }
			if($port_navigation == 'classic_nav'){ 
			
echo '<style>#random'.$portfolio_rand_class.'_port .navigation .pagination span,#random'.$portfolio_rand_class.'_port .navigation .pagination a{border:1px solid '.$nav_border.'; color:'.$nav_color.'; background:'.$nav_bg.';}#random'.$portfolio_rand_class.'_port .navigation .pagination .current,#random'.$portfolio_rand_class.'_port .navigation .pagination span:hover,#random'.$portfolio_rand_class.'_port .navigation .pagination a:hover{ color:'.$nav_hover_color.' !important; background:'.$nav_hover_bg.'; border:1px solid '.$nav_hover_bg.'; }#random'.$portfolio_rand_class.'_port .navigation{border-top:1px solid '.$nav_border.';}#random'.$portfolio_rand_class.'_port .pagination_current_position{color:'.$nav_color.';}</style>';			
		
        if(isset($maxpages)){ ?>    
            
     <div class="navigation">

        <?php kriesi_pagination($maxpages); echo "<span class='pagination_current_position'>". __("Page", "rdesign").' '.$current."/".$maxpages."</span>"; ?>

      </div>			
		<?php }}

						echo '</div>';

            ?>
  <script>
  


jQuery.noConflict();
var $ = jQuery;
"use strict";
            <?php 
			 if($port_navigation !== 'classic_nav'){ ?> 
			   /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
                var html_template = "<?php echo esc_js($port_type); ?>";
				var thumbnail = "<?php echo esc_js($port_thumbnail); ?>";
                var now_open_works = 0;
                var first_load = true;

                /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/



                function get_portfolio_works (this_obj) {

                    if(typeof(this_obj)=="undefined") {data_option_value="*";}

                    else {var data_option_value = this_obj.attr("data-option-value");}



                    if (first_load == true) {

                        works_per_load = <?php echo esc_js($items_on_start); ?>;

                        first_load = false;

                    } else {

                        works_per_load = <?php echo esc_js($items_per_click); ?>;

                    }



                    $.ajax({

                        type: "POST",

                        url: mixajaxurl,

                        data: "html_template="+html_template+"&now_open_works="+now_open_works+"&action=get_portfolio_works"+"&works_per_load="+works_per_load+"&thumbnail="+thumbnail+"&tags=<?php echo esc_js($tags); ?>&category=<?php echo esc_js($category); ?>",

                        success: function(result){

		                            if(result.length<1){

                                $("#random<?php echo esc_js($portfolio_rand_class);?>_port .load_more_cont").hide("fast");

                            }




                            now_open_works = now_open_works + works_per_load;

                            var $newItems = $(result);
                            $("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope( 'insert', $newItems, function() {



                                $("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").ready(function(){
                                    $("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');
                                    //Portfolio
                                    $('#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_content').each(function(){
                                    $(this).css('margin-top', Math.floor(-1*($(this).height()/2))+'px');
                                    });
	                                });

                               $("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');
							   
							   $(window).trigger('resize');


    							
    						
									
                            });
	$("#random<?php echo esc_js($portfolio_rand_class);?>_port .optionset li a").each(function() {
									
								var filter_class = $(this).attr('data-option-value');
								 if ($('#random<?php echo esc_js($portfolio_rand_class);?>_port').find(filter_class).length) { // implies *not* zero
								$(this).parent('li').show();
								 }else{
								$(this).parent('li').hide();
								 }
								
								
								
								});
								
								
                            $('a.prettyPhoto').prettyPhoto();
							
					$(window).trigger('resize');



							$(".refresh_icn").removeClass("fa-spin");

							$(".refresh_icn").removeClass("fa-refresh");
					
							$("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');

							$(".refresh_icn").addClass("fa-plus");
								


                        }   
						
						

                    });

                }



                $("#random<?php echo esc_js($portfolio_rand_class);?>_port .get_portfolio_works_btn").click(function(){

					$(".refresh_icn").removeClass("fa-plus");

					$(".refresh_icn").addClass("fa-refresh");

                    $(".refresh_icn").addClass("fa-spin");

					get_portfolio_works();


					$(window).trigger('resize');							
					$("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');

					return false;

					

                });

               /* load at start */
                $(window).load(function(){
                    get_portfolio_works();
		
	
					$(window).trigger('resize');					
					$("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');
<?php }else { ?>

 $(window).load(function(){
<?php } ?>

	$("#random<?php echo esc_js($portfolio_rand_class);?>_port .optionset li a").each(function() {
									
								var filter_class = $(this).attr('data-option-value');
								 if ($('#random<?php echo esc_js($portfolio_rand_class);?>_port').find(filter_class).length){ // implies *not* zero
								$(this).parent('li').show();
								 }else{
								$(this).parent('li').hide();
								 }
								
								
								});
								
function watchport() {

$("#random<?php echo esc_js($portfolio_rand_class);?>_port .portfolio_block").isotope('layout');
			<?php if($port_type == 'port_type_7' || $port_type == 'port_type_8' || $port_type == 'port_type_9'  ){ ?>		

			<?php } ?>		
					
}

setInterval(watchport, 100);


		   
                });
            </script>
  <?php
  

			 
            wp_reset_postdata();
		
$output_string = ob_get_contents();
ob_end_clean();
return $output_string; } 
       
add_shortcode('portfolio', 'portfolio_sc');
		
?>