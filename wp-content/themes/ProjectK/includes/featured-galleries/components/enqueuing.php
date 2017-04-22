<?php

function fg_enqueue_stuff() {

	wp_enqueue_media();

	wp_enqueue_script( 'fg-admin-script', get_template_directory_uri().'/includes/featured-galleries/js/admin.js' );

	wp_localize_script( 'fg-admin-script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	wp_enqueue_style( 'fg-admin-style',get_template_directory_uri().'/includes/featured-galleries/css/admin.css' );

}