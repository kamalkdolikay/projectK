<?php
/**
 * @var $vc_btn WPBakeryShortCode_VC_Btn
 * @var $post WP_Post
 * @var $atts
 *
 * @var $style
 * @var $shape
 * @var $color
 * @var $custom_background
 * @var $size
 * @var $align
 * @var $link
 * @var $url
 * @var $title
 * @var $button_block
 * @var $el_class
 *
 * @var $add_icon
 * @var $i_align
 * @var $i_type
 */
$atts = array();
parse_str( $data, $atts );
require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-btn.php' );

$vc_btn = new WPBakeryShortCode_VC_Btn( array( 'base' => 'vc_btn' ) );

$defaults = array(
	'style' => 'classic',
	'shape' => 'rounded',
	'color' => 'grey',
	'custom_background' => '',
	'custom_text' => '',
	'size' => 'md',
	'align' => 'inline',
	'link' => '',
	'url' => '',
	'title' => '',
	'button_block' => '',
	'el_class' => '',
	'add_icon' => '',
	'add_icon' => '',
	'i_align' => 'left',
	'i_icon_pixelicons' => '',
	'i_type' => 'fontawesome',
	'i_icon_fontawesome' => 'fa fa-adjust',
	'i_icon_openiconic' => 'vc-oi vc-oi-dial',
	'i_icon_typicons' => 'typcn typcn-adjust-brightness',
	'i_icon_entypo' => 'entypo-icon entypo-icon-note',
	'i_icon_linecons' => 'vc_li vc_li-heart',
	'css_animation' => '',
);
$inline_css = '';
$icon_wrapper = false;
$icon_html = false;

$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );
//parse link

$el_class = $vc_btn->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' vc_btn3-container ' . $el_class, $vc_btn->settings( 'base' ), $atts );
$css_class .= $vc_btn->getCSSAnimation( $css_animation );
$button_class = ' vc_btn3-size-' . $size . ' vc_btn3-shape-' . $shape . ' vc_btn3-style-' . $style;
$button_html = $title;

if ( '' == trim( $title ) ) {
	$button_class .= ' vc_btn3-o-empty';
	$button_html = '<span class="vc_btn3-placeholder">&nbsp;</span>';
}
if ( 'true' === $button_block && 'inline' != $align ) {
	$button_class .= ' vc_btn3-block';
}
if ( 'true' === $add_icon ) {
	$button_class .= ' vc_btn3-icon-' . $i_align;
	vc_icon_element_fonts_enqueue( $i_type );

	if ( isset( ${"i_icon_" . $i_type} ) ) {
		switch ( $i_type ) {
			case 'pixelicons':
				$icon_wrapper = true;
				break;
		}
		$iconClass = ${"i_icon_" . $i_type};
	} else {
		$iconClass = 'fa fa-info';
	}

	if ( $icon_wrapper ) {
		$icon_html = '<i class="vc_btn3-icon"><span class="vc_btn3-icon-inner ' . esc_attr( $iconClass ) . '"></span></i>';
	} else {
		$icon_html = '<i class="vc_btn3-icon ' . esc_attr( $iconClass ) . '"></i>';
	}


	if ( 'left' === $i_align ) {
		$button_html = $icon_html . ' ' . $button_html;
	} else {
		$button_html .= ' ' . $icon_html;
	}
}

if ( 'custom' === $style ) {
	$inline_css = vc_get_css_color( 'background-color', $custom_background ) . vc_get_css_color( 'color', $custom_text );
} else {
	$button_class .= ' vc_btn3-color-' . $color . ' ';
}

if ( '' != $inline_css ) {
	$inline_css = ' style="' . $inline_css . '"';
}
// Add link
$use_link = strlen( $link ) > 0 && 'none' !== $link;
$link_output = '';
if ( $use_link ) {
	$link_output = vc_gitem_create_link_real( $atts, $post, 'vc_general vc_btn3 ' . trim( $button_class ), $title, false );
}
$output = '<div class="'
          . esc_attr( trim( $css_class ) )
          . ' vc_btn3-' . esc_attr( $align ) . '">';
if ( preg_match( '/href=\"[^\"]+/', $link_output ) ):
	$output .= '<' . $link_output . $inline_css . '>' . $button_html . '</a>';
else:
	$output .= '<button class="vc_general vc_btn3 ' . esc_attr( $button_class ) . '"' . $inline_css . '>' .
	           $button_html . '</button>';
endif;
$output .= '</div>' . $vc_btn->endBlockComment( 'vc_btn3' ) . "\n";
return $output;