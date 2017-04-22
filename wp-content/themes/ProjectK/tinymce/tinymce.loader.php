<?php
/*-----------------------------------------------------------------------------------*/
/*	Paths Defenitions
/*-----------------------------------------------------------------------------------*/
define('RD_TINYMCE_PATH', RD_FILEPATH . '/tinymce');
define('RD_TINYMCE_URI', RD_DIRECTORY . '/tinymce');
/*-----------------------------------------------------------------------------------*/
/*	Load TinyMCE dialog
/*-----------------------------------------------------------------------------------*/
require_once( RD_TINYMCE_PATH . '/tinymce.class.php' );		// TinyMCE wrapper class
new rd_tinymce();											// do the magic

?>