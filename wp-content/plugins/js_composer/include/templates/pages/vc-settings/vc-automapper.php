<form action="options.php" method="post" id="vc_settings-automapper"
      class="vc_settings-tab-content vc_settings-tab-content-active"<?php echo apply_filters( 'vc_setting-tab-form-automapper', '' ) ?>>
	<?php vc_automapper()->renderHtml(); ?>
</form>