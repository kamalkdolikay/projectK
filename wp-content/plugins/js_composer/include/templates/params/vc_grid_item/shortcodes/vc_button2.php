<?php
$wrapper_css_class = 'vc_button-2-wrapper';
extract( shortcode_atts( array(
	'link' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'color' => '',
	'icon' => '',
	'size' => '',
	'style' => '',
	'el_class' => '',
	'align' => ''
), $atts ) );

$class = 'vc_btn';
//parse link

$class .= ( $color != '' ) ? ( ' vc_btn_' . $color . ' vc_btn-' . $color ) : '';
$class .= ( $size != '' ) ? ( ' vc_btn_' . $size . ' vc_btn-' . $size ) : '';
$class .= ( $style != '' ) ? ' vc_btn_' . $style : '';

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . $class . $el_class, $this->settings['base'], $atts );

$link = 'class="' . esc_attr( $css_class ) . '"';
$target = '';
if ( isset( $atts['link'] ) ) {
	$css_class .= ' vc_gitem-link';
	if ( 'custom' === $atts['link'] && ! empty( $atts['url'] ) ) {
		$vc_link = vc_build_link( $atts['url'] );
		if ( strlen( $vc_link['target'] ) ) {
			$target = ' target="' . esc_attr( $vc_link['target'] ) . '"';
		}
		$link = 'href="' . esc_attr( $vc_link['url'] ) . '" class="' . esc_attr( $css_class ) . '"';
	} elseif ( 'post_link' === $atts['link'] ) {
		$link = 'href="{{ post_link_url }}" class="' . esc_attr( $css_class ) . '"';
	} elseif ( 'image' === $atts['link'] ) {
		$link = '{{ post_image_url_href }} class="' . esc_attr( $css_class ) . '"';
	} elseif ( 'image_lightbox' === $atts['link'] ) {
		$link = '{{ post_image_url_attr_prettyphoto:' . $css_class . ' }}';
	}
}

$link = apply_filters( 'vc_gitem_post_data_get_link_link', 'a ' . $link, $atts, $css_class )
        . apply_filters( 'vc_gitem_post_data_get_link_target', $target, $atts );

if ( $align ) {
	$wrapper_css_class .= ' vc_button-2-align-' . $align;
}
?>
	<div class="<?php echo esc_attr( $wrapper_css_class ) ?>">
		<<?php echo $link ?>
		<?php $target ?>>
		<?php echo $title; ?>
		</a>
	</div>
<?php echo $this->endBlockComment( 'vc_button' ) . "\n";