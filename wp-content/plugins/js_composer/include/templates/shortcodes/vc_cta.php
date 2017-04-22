<?php
/**
 * @var $this WPBakeryShortCode_VC_Cta
 */
/*
$defaults = array_merge(
	array(
		'h2' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
		'use_custom_fonts_h2' => '',
	),
	vc_map_integrate_get_atts( $this->shortcode, 'vc_custom_heading', 'h2_' ),
	array(
		'h4' => '',
		'use_custom_fonts_h4' => '',
	),
	vc_map_integrate_get_atts( $this->shortcode, 'vc_custom_heading', 'h4_' ),
	array(
		'style' => 'classic', // default style
		'shape' => 'square',
		'color' => 'blue', // default color for cta
		'txt_align' => 'left',
		'add_button' => '',
	),
	vc_map_integrate_get_atts( $this->shortcode, 'vc_btn', 'btn_' ),
	array(
		'add_icon' => '',
	),
	vc_map_integrate_get_atts( $this->shortcode, 'vc_icon', 'i_' ),
	array(
		'el_class' => '',
		'css_animation' => '',
	)
);*/
$defaults = array(
	'h2' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
	'use_custom_fonts_h2' => '',
	'h2_font_container' => '',
	'h2_google_fonts' => 'font_family:Abril%20Fatface%3A400|font_style:400%20regular%3A400%3Anormal',
	'h2_el_class' => '',
	'h4' => '',
	'use_custom_fonts_h4' => '',
	'h4_font_container' => '',
	'h4_google_fonts' => 'font_family:Abril%20Fatface%3A400|font_style:400%20regular%3A400%3Anormal',
	'h4_el_class' => '',
	'style' => 'classic',
	'shape' => 'square',
	'color' => 'classic',
	'custom_background' => '',
	'custom_text' => '',
	'txt_align' => 'left',
	'add_button' => '',
	'btn_title' => __( 'Text on the Button', 'js_composer' ),
	'btn_link' => '',
	'btn_style' => 'modern',
	'btn_shape' => 'rounded',
	'btn_color' => 'default',
	'btn_custom_background' => '',
	'btn_custom_text' => '',
	'btn_size' => 'md',
	'btn_align' => 'inline',
	'btn_add_icon' => '',
	'btn_i_align' => 'left',
	'btn_i_type' => 'fontawesome',
	'btn_i_icon_fontawesome' => 'fa fa-adjust',
	'btn_i_icon_openiconic' => 'vc-oi vc-oi-dial',
	'btn_i_icon_typicons' => 'typcn typcn-adjust-brightness',
	'btn_i_icon_entypo' => 'entypo-icon entypo-icon-note',
	'btn_i_icon_linecons' => 'vc_li vc_li-heart',
	'btn_i_icon_pixelicons' => '',
	'btn_css_animation' => '',
	'btn_button_block' => '',
	'btn_el_class' => '',
	'add_icon' => '',
	'i_type' => 'fontawesome',
	'i_icon_fontawesome' => 'fa fa-adjust',
	'i_icon_openiconic' => 'vc-oi vc-oi-dial',
	'i_icon_typicons' => 'typcn typcn-adjust-brightness',
	'i_icon_entypo' => 'entypo-icon entypo-icon-note',
	'i_icon_linecons' => 'vc_li vc_li-heart',
	'i_color' => 'blue',
	'i_custom_color' => '',
	'i_background_style' => '',
	'i_background_color' => 'grey',
	'i_size' => 'md',
	'i_align' => 'left',
	'i_link' => '',
	'i_css_animation' => '',
	'i_on_border' => '',
	'i_el_class' => '',
	'el_width' => '',
	'el_class' => '',
	'css_animation' => '',
);
/** @var array $atts - shortcode attributes */
/** @var string $content - shortcode content */

$atts = shortcode_atts( $defaults, $atts );

$this->buildTemplate( $atts, $content );


?>
<section
	class="vc_cta3-container <?php echo esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ); ?>">
	<div class="vc_general <?php echo esc_attr( implode( ' ', $this->getTemplateVariable( 'css-class' ) ) ); ?>"<?php
	if ( $this->getTemplateVariable( 'inline-css' ) ) {
		echo ' style="' . esc_attr( implode( ' ', $this->getTemplateVariable( 'inline-css' ) ) ) . '"';
	}
	?>>
		<?php echo $this->getTemplateVariable( 'icons-top' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-left' ); ?>
		<div class="vc_cta3_content-container">
			<?php echo $this->getTemplateVariable( 'actions-top' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-left' ); ?>
			<div class="vc_cta3-content">
				<header class="vc_cta3-content-header">
					<?php echo $this->getTemplateVariable( 'heading1' ); ?>
					<?php echo $this->getTemplateVariable( 'heading2' ); ?>
				</header>
				<?php echo $this->getTemplateVariable( 'content' ); ?>
			</div>
			<?php echo $this->getTemplateVariable( 'actions-bottom' ); ?>
			<?php echo $this->getTemplateVariable( 'actions-right' ); ?>
		</div>
		<?php echo $this->getTemplateVariable( 'icons-bottom' ); ?>
		<?php echo $this->getTemplateVariable( 'icons-right' ); ?>
	</div>
</section>
