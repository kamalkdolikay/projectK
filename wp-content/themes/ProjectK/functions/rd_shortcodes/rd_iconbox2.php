<?php 


/*-----------------------------------------------------------------------------------*/



/*	Icons Box 2



/*-----------------------------------------------------------------------------------*/
function rd_iconbox2( $atts, $content = null ) {

		global $rd_data;

	extract(shortcode_atts(array(
	
		'type'   => '',

		'title'   => 'Title',

		't_color' => '',
		
		'subtitle'   => '',

		'st_color' => '',
		
		'target' => '',

		'i_color' => '',
		
		'i_alt_color' => '',		
		
		'target' => '',
		
		'content_color' => '',		
		
		'boxbg_color' => '',

		'boxb_color' => '',
		
		'button_color' => '',

		'button_text' => '',
	
		'button_t_color' => '',		
		
		'button_b_color' => '',

		'link' => '#',

		'icon'	=> 'cog',
		
		'hover_t_color' => '',
		
		'hover_i_color' => '',
				
		'hover_boxbg_color' => '',

		'hover_boxb_color' => '',
		
		'hover_button_color' => '',

		'hover_button_t_color' => '',		
		
		'hover_button_b_color' => '',
		
		'hover_text_color' => '',
		
		'change_hover' => '',
		
		'mt' => '',
		
		'mb' => '',
		'animation' => '',
		
		 
		

    ), $atts));
$output = "";

$box_id = RandomString(20);


$output .='<style>#rand_'.$box_id.' {margin-top:'.$mt.'px; margin-bottom:'.$mb.'px; }</style>';


/// Set default value if none

		// Enqueue the CSS
		if ( ! empty( $atts['icon'] ) ) {
            // Don't load the CSS files to trim loading time, include the specific styles via PHP
            // wp_enqueue_style( '4k-icon-' . $cssFile, plugins_url( 'icons/css/' . $cssFile . '.css', __FILE__ ) );
			$cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );
			wp_enqueue_style( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/css/icon-styles.css' , null, VERSION_GAMBIT_VC_4K_ICONS );
			wp_enqueue_script( '4k-icons',  RD_DIRECTORY . '/includes/4k-icons/js/script-ck.js', array( 'jquery' ), VERSION_GAMBIT_VC_4K_ICONS, true );
		}
  global $iconContents;

        include('icon-contents.php' );

		// Normal styles used for everything
        $cssFile = substr( $atts['icon'], 0, stripos( $atts['icon'], '-' ) );

        $iconFile =  RD_DIRECTORY . '/includes/4k-icons/icons/fonts/' . $cssFile;
		$iconFile = apply_filters( '4k_icon_font_pack_path', $iconFile, $cssFile );

		// Fix ligature icons (these are icons that use more than 1 symbol e.g. mono social icons)
		$ligatureStyle = '';
        if ( $cssFile == 'mn' ) {
            $ligatureStyle = '-webkit-font-feature-settings:"liga","dlig";-moz-font-feature-settings:"liga=1, dlig=1";-moz-font-feature-settings:"liga","dlig";-ms-font-feature-settings:"liga","dlig";-o-font-feature-settings:"liga","dlig";
                         	 font-feature-settings:"liga","dlig";
                        	 text-rendering:optimizeLegibility;';
        }

		$iconCode = '';
		if ( ! empty( $atts['icon'] ) ) {
			$iconCode = $iconContents[ $atts['icon'] ];
		}

		$ret = "<style>
            @font-face {
            	font-family: '" . $cssFile . "';
            	src:url('" . $iconFile . ".eot');
            	src:url('" . $iconFile . ".eot?#iefix') format('embedded-opentype'),
            		url('" . $iconFile . ".woff') format('woff'),
            		url('" . $iconFile . ".ttf') format('truetype'),
            		url('" . $iconFile . ".svg#oi') format('svg');
            	font-weight: normal;
            	font-style: normal;
            }
            #rand_".$box_id." ." . $atts['icon'] . ":before { font-family: '" . $cssFile . "'; font-weight: normal; font-style: normal; }
            #rand_".$box_id." .". $atts['icon'] . ":before { content: \"" . $iconCode . "\"; $ligatureStyle }
";

		$ret .= "</style>";

		// Compress styles a bit for readability
		$ret = preg_replace( "/\s?(\{|\})\s?/", "$1",
			preg_replace( "/\s+/", " ",
			str_replace( "\n", "", $ret ) ) )
			. "\n";


if($i_color == ''){
	$i_color = $rd_data['rd_content_hl_color'];
}

if($boxbg_color == '' && $boxb_color == ''){

$output .= '<style>#rand_'.$box_id.' {padding-left:0; padding-right:0; }</style>';

}

if($boxbg_color == ''){
	$boxbg_color = 'rgba(0,0,0,0)';	
	
}

if($boxb_color == ''){
$boxb_color = 'rgba(0,0,0,0)';
}

if($hover_t_color == '' ){ $hover_t_color = '#2d3e50';}
if($hover_i_color == '' ){ $hover_i_color = $rd_data['rd_content_hl_color'];}
if($hover_boxbg_color == '' ){ $hover_boxbg_color = $rd_data['rd_content_bg_color'];}
if($hover_boxb_color == '' ){ $hover_boxb_color = $rd_data['rd_content_border_color'];}
if($hover_button_color == '' ){ $hover_button_color = $rd_data['rd_content_hl_color'];}
if($hover_button_t_color == '' ){ $hover_button_t_color = '#fff';}		
if($hover_button_b_color == '' ){ $hover_button_b_color = $rd_data['rd_content_hl_color'];}
if($hover_text_color == '' ){ $hover_text_color = '';}



if($button_color == ''){
$button_color = 'rgba(0,0,0,0)';	
}
if($button_t_color == ''){
$button_t_color = '#999999';	
}

if($button_b_color == ''){
$button_b_color = 'rgba(0,0,0,0)';	
}	

/////// TYPE 1  /////////

if($type == 'default') {
	
	
if($button_text == ''){
   
	$output .='<style>#rand_'.$box_id.':hover .icon_circle i{color:'.$i_color.' !important;}#rand_'.$box_id.':hover .icon_circle{background:#2d3e50 !important; border:4px solid '.$i_color.'!important;}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){


	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle{background:'.$hover_t_color.' !important; border:4px solid '.$hover_i_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}</style> ';
	
}
   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_alt '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.'; "><div class="icon_circle" style="background-color:'.$i_color.';"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p></div>';
   
   
   
return $output;

}
else
{
 
	$output .='<style>#rand_'.$box_id.':hover .icon_circle i{color:'.$i_color.' !important;}#rand_'.$box_id.':hover .icon_circle{background:#2d3e50 !important; border:4px solid '.$i_color.'!important;}</style> ';
		$output .= $ret;

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$i_color.' !important; color:#fff!important; border:1px solid '.$i_color.' !important;  }</style>';
	
	
}

if($change_hover !== ''){

	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle{background:'.$hover_t_color.' !important; border:4px solid '.$hover_i_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important; border:1px solid '.$hover_button_b_color.' !important;  }</style> ';
	
}


   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_alt '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.'; padding:65px 30px 50px 30px;"><div class="icon_circle" style="background-color:'.$i_color.';"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="padding:2px 0 10px 0">'. do_shortcode($content) .'</p><a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.'; border:1px solid '.$button_b_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a></div>';

return $output;

}


/////// TYPE 2  /////////

}elseif($type == 'simple') {
	
	
if($button_text == ''){
   
		$output .='<style>#rand_'.$box_id.':hover .simple_sub_circle{background:#2d3e50 !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important; }#rand_'.$box_id.':hover h3{color:'.$i_color.'!important;}#rand_'.$box_id.':hover {border-bottom:3px solid '.$i_color.'!important; padding:43px 30px 18px 30px!important;}</style> ';
		$output .= $ret;

if($change_hover !== ''){



	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle{background:'.$hover_t_color.' !important; border:4px solid '.$hover_i_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}</style> ';
	
}
   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_simple '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle" style="background-color:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="simple_sub_circle" style="background:'.$i_color.';"></div><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p></div>';
   
   
   
return $output;

}
else
{

   
	$output .='<style>#rand_'.$box_id.':hover .simple_sub_circle{background:#2d3e50 !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important; }#rand_'.$box_id.':hover .box_btn{color:'.$t_color.'!important;}#rand_'.$box_id.':hover h3{color:'.$i_color.'!important;}#rand_'.$box_id.':hover {border-bottom:3px solid '.$i_color.'!important; padding:43px 30px 18px 30px!important;}</style> ';
	$output .= $ret;
	

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$i_color.' !important; color:#fff!important; border:1px solid '.$i_color.' !important;  }</style>';
	
	
}

if($change_hover !== ''){


	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important; border-bottom:3px solid '.$hover_i_color.' !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$hover_i_color.' !important; border:1px solid '.$hover_boxb_color.'!important;}#rand_'.$box_id.':hover .simple_sub_circle{background:#2d3e50 !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover .box_btn{color:'.$hover_button_t_color.'!important; }</style> ';
	
}


   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_simple '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle" style="background-color:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="simple_sub_circle" style="background:'.$i_color.';"></div><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="padding:10px 0 10px 0">'. do_shortcode($content) .'</p><a class="box_btn" style="color:'.$button_t_color.'; background:none!important; border:none!important;" href="'.$link.'" '.$target.'>'.$button_text.'</a></div>';

return $output;

}


/////// TYPE 3  /////////

	
}elseif($type == 'super_simple') {
if($button_text == ''){
	
	$output .='';
   $output .= '<div id="rand_'.$box_id.'" class="icon_box2 '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle" style="border:1px solid '.$i_color.';"><div class="sub_circle"></div><i class="'.$icon.'" style="color:'.$i_color.';"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p></div>';
   $output .= $ret;

return $output;
}

else

{
	

$output ='';
$output .= $ret;

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#'.$box_id.':hover .box_btn { background:'.$i_color.' !important; color:#fff; }</style>';
	
	
}


if($change_hover !== ''){

	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle,#rand_'.$box_id.':hover .sub_circle{border:1px solid '.$hover_i_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important;   }</style> ';
	
}


    $output .= '<div id="rand_'.$box_id.'" class="icon_box2 '.$animation.'" style="padding: 43px 30px 27px 30px; background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle" style="border:1px solid '.$i_color.';"><div class="sub_circle"></div><i class="'.$icon.'" style="color:'.$i_color.';"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p><a class="box_btn" style="color:'.$button_t_color.'; " href="'.$link.'" '.$target.'>'.$button_text.'</a></div>';


return $output;

}
/////// TYPE 13  /////////

	
}elseif($type == 'trending_box') {
if($button_text == ''){
	
	$output .='';
   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_trending '.$animation.'" style="background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle"><i class="'.$icon.'" style="color:'.$i_color.';"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p></div>';
   $output .= $ret;


if($change_hover !== ''){

	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important;   }</style> ';
	
}

return $output;
}

else

{
	

$output ='';
$output .= $ret;

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#'.$box_id.':hover .box_btn { background:'.$i_color.' !important; color:#fff; }</style>';
	
	
}


if($change_hover !== ''){

	$output .='<style>#rand_'.$box_id.':hover {background:'.$hover_boxbg_color.' !important; border:1px solid '.$hover_boxb_color.' !important; color:'.$hover_text_color.'!important;}#rand_'.$box_id.':hover .icon_circle i{color:'.$hover_i_color.' !important;}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important;   }</style> ';
	
}


    $output .= '<div id="rand_'.$box_id.'" class="icon_box2_trending '.$animation.'" style="padding: 43px 30px 27px 30px; background:'.$boxbg_color.'; border:1px solid '.$boxb_color.';"><div class="icon_circle"><i class="'.$icon.'" style="color:'.$i_color.';"></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p><a class="box_btn" style="color:'.$button_t_color.'; " href="'.$link.'" '.$target.'>'.$button_text.'</a></div>';


return $output;

}


/////// TYPE 4  /////////

}elseif($type == 'big_circle') {
	
	
if($button_text == ''){
   
	$output .='<style>#rand_'.$box_id.' .icon_circle{color:'.$i_color.'; }#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important; }</style> ';
	
	$output .= $ret;

if($change_hover !== ''){


	$output .='<style>#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important;}#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.':hover .icon_circle i:before{background:'.$hover_i_color.';}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}</style> ';
	
}
   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_bc '.$animation.'"><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p></div>';
   
   
   
return $output;

}
else
{

	
   
	$output .='<style>#rand_'.$box_id.' .icon_circle{color:'.$i_color.'; }#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important; }</style> ';
		$output .= $ret;

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$i_color.' !important; color:#fff!important; border:1px solid '.$i_color.' !important;  }</style>';
	
	
}

if($change_hover !== ''){



	$output .='<style>#rand_'.$box_id.':hover .icon_circle{background:'.$i_color.' !important;}#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.':hover .icon_circle i:before{background:'.$hover_i_color.';}#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important; border:1px solid '.$hover_button_b_color.' !important;  }</style> ';
	
}


   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_bc '.$animation.'" ><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';">'. do_shortcode($title) .'</h3></a><p style="padding:2px 0 10px 0">'. do_shortcode($content) .'</p><a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.'; border:1px solid '.$button_b_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a></div>';

return $output;

}


/////// TYPE 5  /////////
}elseif($type == 'hex') {
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle,#rand_'.$box_id.' .icon_circle:after,#rand_'.$box_id.' .icon_circle:before{color:#fff; background:'.$i_color.';}#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.' h3:after{background:'.$content_color.'}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_sub_ctn,#rand_'.$box_id.':hover .icon_sub_ctn:before,#rand_'.$box_id.':hover .icon_sub_ctn:after{background:'.$hover_i_color.'; }</style> ';

	
}
if($i_alt_color !== '' ){ 
	$output .='<style>#rand_'.$box_id.' .icon_circle{ background: '.$i_color.'; background: -moz-linear-gradient(135deg, '.$i_color.' 0%, '.$i_alt_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$i_color.'), color-stop(100%,'.$i_alt_color.')); background: -webkit-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -o-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -ms-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%);}#rand_'.$box_id.' .icon_circle:before,#rand_'.$box_id.' .icon_circle:after{ background: '.$i_color.'; background: -moz-linear-gradient(45deg, '.$i_color.' 0%, '.$i_alt_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$i_color.'), color-stop(100%,'.$i_alt_color.')); background: -webkit-linear-gradient(45deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -o-linear-gradient(45deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -ms-linear-gradient(45deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: linear-gradient(45deg, '.$i_color.' 0%,'.$i_alt_color.' 100%);}</style>';
		}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important; border:2px solid '.$hover_button_b_color.' !important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_hex '.$animation.'"><div class="icon_circle"><div class="icon_sub_ctn"><i class="'.$icon.'" ></i></div></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.'; border:2px solid '.$button_b_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}
elseif($type == 'hex_box') {
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle,#rand_'.$box_id.' .icon_circle:after,#rand_'.$box_id.' .icon_circle:before{background:#f2f2f2; color:#fff;}#rand_'.$box_id.' .icon_sub_ctn,#rand_'.$box_id.' .icon_sub_ctn:before,#rand_'.$box_id.' .icon_sub_ctn:after{background:'.$i_color.'; }#rand_'.$box_id.' h3:after{background:'.$content_color.'} #rand_'.$box_id.' {border:1px solid '.$boxb_color.'; background:'.$boxbg_color.'; box-shadow: 0 0px 0px rgba(255, 255, 255, 1), 0 4px 0 -1px '.$boxbg_color.', 0 0px 0px 0px '.$boxbg_color.',0 0px 0px '.$boxbg_color.', 0 4px 0 0px '.$boxb_color.', 0px 7px 0px 0px '.$boxbg_color.',0px 8px 0px 0px '.$boxb_color.';}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_circle,#rand_'.$box_id.':hover .icon_circle:after,#rand_'.$box_id.':hover .icon_circle:before{background:'.$hover_button_color.'; color:#fff;}#rand_'.$box_id.':hover .icon_sub_ctn,#rand_'.$box_id.':hover .icon_sub_ctn:before,#rand_'.$box_id.':hover .icon_sub_ctn:after{background:'.$hover_i_color.'; } #rand_'.$box_id.':hover {border:1px solid '.$hover_boxb_color.'; background:'.$hover_boxbg_color.'; box-shadow: 0 0px 0px rgba(255, 255, 255, 1), 0 4px 0 -1px '.$hover_boxbg_color.', 0 0px 0px 0px '.$hover_boxbg_color.',0 0px 0px '.$hover_boxbg_color.', 0 4px 0 0px '.$hover_boxb_color.', 0px 7px 0px 0px '.$hover_boxbg_color.',0px 8px 0px 0px '.$hover_boxb_color.';}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_hexbox '.$animation.'"><div class="icon_circle"><div class="icon_sub_ctn"><i class="'.$icon.'" ></i></div></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}elseif($type == 'br') {
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle{background:'.$i_color.'; color:'.$content_color.'; border:2px solid '.$boxb_color.';}#rand_'.$box_id.' h3:after{background:'.$button_color.'} #rand_'.$box_id.' {border:1px solid '.$boxb_color.'; background:'.$boxbg_color.';}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_circle{background:'.$hover_i_color.'; border-color:'.$hover_i_color.'; color:#ffffff;} #rand_'.$box_id.':hover {border:1px solid '.$hover_boxb_color.'; background:'.$hover_boxbg_color.';}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_br '.$animation.'"><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}

elseif($type == 'left_b') {
	

	if($boxb_color == 'rgba(0,0,0,0)'	){
	
$boxb_color = $rd_data['rd_content_border_color'];
}

if($boxbg_color == 'rgba(0,0,0,0)'){



$boxbg_color = $rd_data['rd_content_bg_color'];

}	
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle{background:'.$i_color.'; color:#fff; }#rand_'.$box_id.' {border:1px solid '.$boxb_color.'; background:'.$boxbg_color.';}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_circle,#rand_'.$box_id.':hover .icon_circle:after,#rand_'.$box_id.':hover .icon_circle:before{background:'.$hover_i_color.'; color:#fff;}#rand_'.$box_id.':hover {border:1px solid '.$hover_boxb_color.'; background:'.$hover_boxbg_color.';}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_left_b '.$animation.'"><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="color:'.$button_t_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}elseif($type == 'big_cg') {
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle{color:#fff; background:'.$i_color.';}#rand_'.$box_id.':hover .icon_circle i{color:#fff !important;}#rand_'.$box_id.' h3:after{background:'.$content_color.'}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_sub_ctn{background:'.$hover_i_color.'; }</style> ';

	
}
if($i_alt_color !== '' ){ 
	$output .='<style>#rand_'.$box_id.' .icon_circle{ background: '.$i_color.'; background: -moz-linear-gradient(135deg, '.$i_color.' 0%, '.$i_alt_color.' 100%); background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,'.$i_color.'), color-stop(100%,'.$i_alt_color.')); background: -webkit-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -o-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: -ms-linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%); background: linear-gradient(135deg, '.$i_color.' 0%,'.$i_alt_color.' 100%);}</style>';
		}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important; border:2px solid '.$hover_button_b_color.' !important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_big_cg '.$animation.'"><div class="icon_circle"><div class="icon_sub_ctn"><i class="'.$icon.'" ></i></div></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.'; border:2px solid '.$button_b_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}elseif($type == 'big_cg_trending') {
	
	
	

	$output .='<style>#rand_'.$box_id.' .icon_circle{color:'.$i_color.'; background:'.$i_alt_color.';}#rand_'.$box_id.' h3:after{background:'.$content_color.'}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover h3:after{background:'.$hover_boxb_color.';}#rand_'.$box_id.':hover .icon_circle{color:#fff!important;}#rand_'.$box_id.':hover .icon_circle{ background:'.$hover_i_color.';}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ background:'.$hover_button_color.' !important; color:'.$hover_button_t_color.'!important; border:2px solid '.$hover_button_b_color.' !important;  }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_big_cg_trending '.$animation.'"><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h4 style="color:'.$st_color.';" >'. do_shortcode($subtitle) .'</h4><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="background-color:'.$button_color.'; color:'.$button_t_color.'; border:2px solid '.$button_b_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}elseif($type == 'st') {
if($boxb_color == 'rgba(0,0,0,0)'	){
	
$boxb_color = $rd_data['rd_content_border_color'];
}

if($boxbg_color == 'rgba(0,0,0,0)'){


$boxbg_color = $rd_data['rd_content_bg_color'];

}		
	

	$output ='<style>#rand_'.$box_id.'{border:1px solid '.$boxb_color.'; background:'.$boxbg_color.'; }#rand_'.$box_id.' .icon_circle{border:1px solid '.$boxb_color.'; background:'.$boxbg_color.'; color:'.$i_color.';}#rand_'.$box_id.' .icon_sub_ctn{border:1px solid '.$boxb_color.'; background:'.$boxbg_color.'; }</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover,#rand_'.$box_id.':hover .icon_circle,#rand_'.$box_id.':hover .icon_sub_ctn{background:'.$hover_boxbg_color.' ; border:1px solid '.$hover_boxb_color.'; }#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_sub_ctn{background:'.$hover_i_color.'; color:#fff;}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important; }</style>';
	
}




   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_st '.$animation.'"><div class="icon_circle"><div class="icon_sub_ctn"><i class="'.$icon.'" ></i></div></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){
	

	
   
 $output .= '<a class="box_btn" style="color:'.$button_t_color.';" href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}elseif($type == 'sc') {
	


	$output ='<style>#rand_'.$box_id.' .icon_circle{background-color:'.$i_color.'; color:#fff;}</style> ';
	
	$output .= $ret;

if($change_hover !== ''){
	
		$output .='<style>#rand_'.$box_id.':hover h3{color:'.$hover_t_color.' !important;}#rand_'.$box_id.':hover p{color:'.$hover_text_color.' !important;}#rand_'.$box_id.':hover .icon_circle{background-color:'.$hover_i_color.'; color:#fff;}</style> ';

	
}

if ($button_color !== 'rgba(0,0,0,0)' || $button_b_color !== 'rgba(0,0,0,0)' ){
	
	$output .= '<style>#rand_'.$box_id.':hover .box_btn{ color:'.$hover_button_t_color.'!important; }</style>';
	
}


   $output .= '<div id="rand_'.$box_id.'" class="icon_box2_sc '.$animation.'"><div class="icon_circle"><i class="'.$icon.'" ></i></div><a href="'.$link.'" target="'.$target.'" ><h3 style="color:'.$t_color.';" >'. do_shortcode($title) .'</h3></a><p>'. do_shortcode($content) .'</p>';
   
if($button_text !== ''){

   
 $output .= '<a class="box_btn" style="color:'.$button_t_color.'; " href="'.$link.'" '.$target.'>'.$button_text.'</a> '; 
   
}
   
  $output .= '</div>';
   
   
   
return $output;




}

}


add_shortcode('iconbox2', 'rd_iconbox2');
?>