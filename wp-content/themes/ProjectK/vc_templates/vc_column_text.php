<?php
$output = $el_class = $css_animation = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'font_size' => '',
    'line_height' => '',
    'css_animation' => '',
    'css' => '',
	'animation' => ''
), $atts));

$ct_id = RandomString(20);
$el_class = $this->getExtraClass($el_class);
if($font_size !== '' || $line_height !== '' ){
$output .= '<style>';
if($font_size !== ''){
$output .=  '#ct_'.$ct_id.' {font-size:'.$font_size.'px;}';	
}
if($line_height !== ''){
$output .=  '#ct_'.$ct_id.' ,#ct_'.$ct_id.' p {line-height:'.$line_height.'px;}';	
}
$output .=  '</style>';
}



$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation($css_animation);
$output .= "\n\t".'<div class="'.esc_attr( $css_class ).' '.$animation.'" >';
$output .= "\n\t\t".'<div class="wpb_wrapper" id="ct_'.$ct_id.'">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content , true );
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo !empty( $output ) ? $output : '';