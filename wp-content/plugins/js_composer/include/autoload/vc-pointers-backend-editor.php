<?php

/**
 * Add WP ui pointers to backend editor.
 */
if ( is_admin() ) {
	foreach ( vc_editor_post_types() as $post_type ) {
		add_filter( 'vc_ui-pointers-' . $post_type, 'vc_backend_editor_register_pointer' );
	}
}

function vc_backend_editor_register_pointer( $p ) {
	$screen = get_current_screen();
	if ( 'add' === $screen->action ) {
		$p['vc_pointers_backend_editor'] = array(
			'name' => 'vcPointerController',
			'messages' => array(
				array(
					'target' => '.composer-switch',
					'options' => array(
						'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
							__( 'Welcome to Visual Composer', 'js_composer' ),
							__( 'Choose Backend or Frontend editor.', 'js_composer' )
						),
						'position' => array(
							'edge' => 'left',
							'align' => 'center'
						),
						'buttonsEvent' => 'vcPointersEditorsTourEvents',
					)
				),
				array(
					'target' => '#vc_templates-editor-button, #vc-templatera-editor-button',
					'options' => array(
						'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
							__( 'Add Elements', 'js_composer' ),
							__( 'Add new element or start with a template.', 'js_composer' )
						),
						'position' => array(
							'edge' => 'left',
							'align' => 'center'
						),
						'buttonsEvent' => 'vcPointersEditorsTourEvents',
					),
					'closeEvent' => 'shortcodes:vc_row:add',
					// 'closeEvent' => 'click #vc_templates-editor-button, #vc_add-new-element, #vc_no-content-add-element, #vc_no-content-add-text-block',
					'showEvent' => 'backendEditor.show',
				),
				array(
					'target' => '[data-vc-control="add"]:first',
					'options' => array(
						'content' => sprintf( '<h3> %s </h3> <p> %s </p>',
							__( 'Rows and Columns', 'js_composer' ),
							__( 'This is a row container. Divide it into columns and style it. You can add elements into columns.', 'js_composer' )
						),
						'position' => array(
							'edge' => 'left',
							'align' => 'center'
						),
						'buttonsEvent' => 'vcPointersEditorsTourEvents',
					),
					'closeEvent' => 'click #wpb_visual_composer',
					'showEvent' => 'shortcodeView:ready',
				),
				array(
					'target' => '.wpb_column_container:first .wpb_content_element:first .vc_controls-cc',
					'options' => array(
						'content' => sprintf( '<h3> %s </h3> <p> %s <br/><br/> %s</p>',
							__( 'Control Elements', 'js_composer' ),
							__( 'You can edit your element at any time and drag it around your layout.', 'js_composer' ),
							sprintf( __( 'P.S. Learn more at our <a href="%s" target="_blank">Knowledge Base</a>.', 'js_composer' )
								, 'http://kb.wpbakery.com' )
						),
						'position' => array(
							'edge' => 'left',
							'align' => 'center'
						),
						'buttonsEvent' => 'vcPointersEditorsTourEvents',
					),
					'showCallback' => 'vcPointersShowOnContentElementControls',
					'closeEvent' => 'click #wpb_visual_composer',
				)
			),
		);
		/*
		$p[ 'showEvent_pointers_backend_editor' ] = array(
			'name' => 'vcEventPointerController',
			'type' => 'map_on_event',
			'messages' => array(
				array(
					'target'  => '.vc_control.column_add.vc_column-add:first',
					'options' => array(
						'content'  => sprintf( '<h3> %s </h3> <p> %s </p>',
							__( 'Ha ha this is third', 'js_composer' ),
							__( '3 Ps use predefined template as a starting point and modify it.', 'js_composer' )
						),
						'position' => array( 'edge' => 'left', 'align' => 'center' ),
						'buttons' => 'vcPointersEditorsTourEvents',
						'closeEvent' => 'click #poststuff',
						'showEvent' => 'shortcodes:vc_column',
					)
				),
				array(
					'target'  => '.wpb_column_container:first .wpb_content_element:first .vc_controls-cc',
					'options' => array(
						'content'  => sprintf( '<h3> %s </h3> <p> %s </p>',
							__( 'Ha ha this is the last one!', 'js_composer' ),
							__( '4 Ps use predefined template as a starting point and modify it.', 'js_composer' )
						),
						'position' => array( 'edge' => 'left', 'align' => 'center' ),
						'buttons' => 'vcPointersEditorsTourEvents',
						'closeEvent' => 'click #poststuff',
					)
				),
			)
		);
		*/
	}

	return $p;
}