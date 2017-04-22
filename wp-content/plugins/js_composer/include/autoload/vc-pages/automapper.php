<?php
/**
 * Build and enqueue js/css for automapper settings tab.
 * @since 4.5
 */
function vc_automapper_init() {
	vc_automapper()->build();
}

/**
 * Returns automapper template.
 *
 * @since 4.5
 * @return string
 */
function vc_page_automapper_build() {
	return 'pages/vc-settings/vc-automapper.php';
}

// @todo move to separate file in autoload
add_filter( 'vc_settings-render-tab-vc-automapper', 'vc_page_automapper_build' );
is_admin() && 'vc-automapper' === vc_get_param( 'page' ) && add_action( 'admin_enqueue_scripts', 'vc_automapper_init' );