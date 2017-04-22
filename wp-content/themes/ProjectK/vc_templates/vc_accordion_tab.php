<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
	'title_color' => '',
	'title_bg_color' => '',
	'title_altbg_color' => '',
	'border_color' => '',
	'content_text_color' => '',
	'content_bg_color' => '',
	'active_title_color' => '',
	'active_bg_color' => '',
	'active_altbg_color' => '',
), $atts));

$tab_id = RandomString(20);
global $rd_data;
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

if($title_color == ''){  $title_color = $mc_text_color ; }
if($title_altbg_color == ''){  $title_altbg_color = $mc_text_color ; } 
if($title_bg_color == ''){  $title_bg_color = $mc_bg_color ; } 
if($border_color == ''){  $border_color = $mc_border_color ; }
if($content_text_color == ''){  $content_text_color = $mc_text_color ; } 
if($content_bg_color == ''){  $content_bg_color = $mc_bg_color ; } 
if($active_title_color == ''){  $active_title_color = $mc_hl_color ; } 
if($active_bg_color == ''){  $active_bg_color = $mc_bg_color ; } 
if($active_altbg_color == ''){  $active_altbg_color = $mc_hover_color ; }

// Create css for each tabs

$output .="<style>";


//style1
$output .='.rd_acc_1 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$border_color.'; }.rd_acc_1 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}.rd_acc_1 #rd_'.$tab_id.' .ui-accordion-header-icon{border-left:1px solid '.$border_color.';}';
$output .='.rd_acc_1 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; border:1px solid '.$border_color.' !important; }.rd_acc_1 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .=' .rd_acc_1 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; background: '.$content_bg_color.'; border:1px solid '.$border_color.'; }';

//style2
$output .='.rd_acc_2 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$border_color.'; }.rd_acc_2 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_2 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; border:1px solid '.$border_color.' !important; }.rd_acc_2 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .=' .rd_acc_2 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; background: '.$content_bg_color.'; border:1px solid '.$border_color.'; }';

//style3 & 4
$output .='.rd_acc_3 #rd_'.$tab_id.' .wpb_accordion_header,.rd_acc_4 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_bg_color.'; }.rd_acc_3 #rd_'.$tab_id.' .wpb_accordion_header a,.rd_acc_4 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_3 #rd_'.$tab_id.' .ui-accordion-header-icon,.rd_acc_4 #rd_'.$tab_id.' .ui-accordion-header-icon{background: '.$title_altbg_color.' !important;}.rd_acc_3 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon,.rd_acc_4 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon{background:'.$active_altbg_color.' !important; }';
$output .=' .rd_acc_3 #rd_'.$tab_id.' .wpb_accordion_content,.rd_acc_4 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; }.rd_acc_3 #rd_'.$tab_id.',.rd_acc_4 #rd_'.$tab_id.'{border-bottom:1px solid '.$border_color.'; }';

//style5
$output .='.rd_acc_5 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$border_color.'; }.rd_acc_5 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}.rd_acc_5 #rd_'.$tab_id.' .ui-accordion-header-icon{color:'.$content_text_color.';}';
$output .='.rd_acc_5 #rd_'.$tab_id.' .ui-accordion-header-active{background:'.$active_bg_color.' !important; border:1px solid '.$active_bg_color.' !important; }.rd_acc_5 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }.rd_acc_5 #rd_'.$tab_id.' .ui-accordion-header-active  .ui-accordion-header-icon{color:'.$active_title_color.'}';
$output .=' .rd_acc_5 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; background: '.$content_bg_color.';}';


//style6
$output .='.rd_acc_6 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$title_bg_color.'; }.rd_acc_6 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_6 #rd_'.$tab_id.' .wpb_accordion_header:hover{color:'.$active_title_color.'; background: '.$content_text_color.'; border:1px solid '.$content_text_color.'; }.rd_acc_6 #rd_'.$tab_id.' .wpb_accordion_header:hover a{color:'.$active_title_color.';}';
$output .='.rd_acc_6 #rd_'.$tab_id.' .ui-accordion-header-active,.rd_acc_6 #rd_'.$tab_id.' .ui-accordion-header-active:hover{background:'.$active_bg_color.' !important; border:1px solid '.$active_bg_color.' !important; }.rd_acc_6 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }.rd_acc_6 #rd_'.$tab_id.' .ui-accordion-header-active  .ui-accordion-header-icon{color:'.$active_title_color.'}';
$output .=' .rd_acc_6 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.';}';

//style7
$output .='.rd_acc_7 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$border_color.'; }.rd_acc_7 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_7 #rd_'.$tab_id.' .ui-accordion-header-active{background:'.$active_bg_color.' !important; border:1px solid '.$active_title_color.' !important; }.rd_acc_7 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }.rd_acc_7 #rd_'.$tab_id.' .ui-accordion-header-active  .ui-accordion-header-icon{color:'.$active_title_color.'}';
$output .=' .rd_acc_7 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.';}';


//style8
$output .='.rd_acc_8 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.'; border:1px solid '.$border_color.'; }.rd_acc_8 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}.rd_acc_8 #rd_'.$tab_id.' .ui-accordion-header-icon{border-left:1px solid '.$border_color.'; color:'.$content_text_color.';}';
$output .='.rd_acc_8 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; border:1px solid '.$border_color.' !important; }.rd_acc_8 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .=' .rd_acc_8 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; background: '.$content_bg_color.'; border:1px solid '.$border_color.'; }';


//style9
$output .='.rd_acc_9 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; background: '.$title_bg_color.';  }.rd_acc_9 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}.rd_acc_9 #rd_'.$tab_id.' .ui-accordion-header-icon{background:'.$title_altbg_color.' !important;}';
$output .='.rd_acc_9 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; color:'.$active_title_color.'; }.rd_acc_9 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }.rd_acc_9 #rd_'.$tab_id.'  .ui-accordion-header-active .ui-accordion-header-icon{background:'.$active_altbg_color.' !important;}';
$output .=' .rd_acc_9 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; }';



//style10
$output .='.rd_acc_10 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; border:1px solid '.$border_color.';  background: '.$title_bg_color.';}.rd_acc_10 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_10 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important;}.rd_acc_10 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_10 #rd_'.$tab_id.' .ui-accordion-header-icon{color:'.$title_altbg_color.' !important; border-right:1px solid '.$border_color.';}.rd_acc_10 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon{background:'.$active_altbg_color.' !important; color:'.$active_bg_color.' !important; }';
$output .='.rd_acc_10 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; }';

//style11
$output .='.rd_acc_11 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_color.'; border:1px solid '.$border_color.';  background: '.$title_bg_color.';}.rd_acc_11 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_11 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; }.rd_acc_11 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_11 #rd_'.$tab_id.' .ui-accordion-header-icon{color:'.$title_color.' !important; }.rd_acc_11 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon{ color:'.$active_title_color.' !important; }';
$output .='.rd_acc_11 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border:1px solid '.$border_color.';}';


//style12
$output .='.rd_acc_12 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_altbg_color.'; border-bottom:1px solid '.$border_color.';}.rd_acc_12 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_12 #rd_'.$tab_id.' .ui-accordion-header-active{color:'.$active_altbg_color.';}.rd_acc_12 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_12 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border-bottom:1px solid '.$border_color.';}';

//style13
$output .='.rd_acc_13 #rd_'.$tab_id.' .wpb_accordion_header{color:'.$title_altbg_color.'; border-bottom:1px solid '.$border_color.';}.rd_acc_13 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_13 #rd_'.$tab_id.' .ui-accordion-header-active{color:'.$active_altbg_color.';}.rd_acc_13 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_13 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border-bottom:1px solid '.$border_color.';}';
$output .='.rd_acc_13 #rd_'.$tab_id.' .rd_acc_content{background:'.$content_bg_color.';}';

//style14
$output .='.rd_acc_14 #rd_'.$tab_id.' .wpb_accordion_header{ background: '.$title_bg_color.'; color:'.$content_text_color.'; border:1px solid '.$border_color.';}.rd_acc_14 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_14 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important; }.rd_acc_14 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_14 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon{ color:'.$active_title_color.' !important; }';
$output .='.rd_acc_14 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border:1px solid '.$border_color.'; background:'.$content_bg_color.'; }';

//style15
$output .='.rd_acc_15 #rd_'.$tab_id.' .wpb_accordion_header{ background: '.$title_bg_color.'; color:'.$content_text_color.'; border:1px solid '.$border_color.';}.rd_acc_15 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_15 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important;}.rd_acc_15 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_15 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon:before{}.rd_acc_15 #rd_'.$tab_id.' .ui-accordion-header-icon:before{border:1px solid '.$border_color.'; }';
$output .='.rd_acc_15 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border:1px solid '.$border_color.'; background:'.$content_bg_color.'; }';

//style16
$output .='.rd_acc_16 #rd_'.$tab_id.' .wpb_accordion_header{ background: '.$title_bg_color.'; color:'.$content_text_color.'; border:1px solid '.$border_color.';}.rd_acc_16 #rd_'.$tab_id.' .wpb_accordion_header a{color:'.$title_color.';}';
$output .='.rd_acc_16 #rd_'.$tab_id.' .ui-accordion-header-active{background: '.$active_bg_color.' !important;}.rd_acc_16 #rd_'.$tab_id.' .ui-accordion-header-active a{color:'.$active_title_color.' !important; }';
$output .='.rd_acc_16 #rd_'.$tab_id.' .ui-accordion-header-active .ui-accordion-header-icon:before{border:1px solid '.$active_title_color.'; color:'.$active_title_color.';}.rd_acc_16 #rd_'.$tab_id.' .ui-accordion-header-icon:before{border:1px solid '.$border_color.'; }';
$output .='.rd_acc_16 #rd_'.$tab_id.' .wpb_accordion_content{color:'.$content_text_color.'; border:1px solid '.$border_color.'; background:'.$content_bg_color.'; }';


$output .="</style>";
// end css


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'" id="rd_'.$tab_id.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix"><div class="rd_acc_content">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div></div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo !empty( $output ) ? $output : '';