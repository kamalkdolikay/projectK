<?php
	/**
	 * The template for the panel header area.
	 *
	 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
	 *
	 * @author 	Redux Framework
	 * @package 	ReduxFramework/Templates
	 * @version     3.4.4
	 */

$tip_title  = __('Developer Mode Enabled', 'redux-framework');

if ($this->parent->dev_mode_forced) {
    $is_debug       = false;
    $is_localhost   = false;
    
    $debug_bit = '';
    if (Redux_Helpers::isWpDebug ()) {
        $is_debug = true;
        $debug_bit = __('WP_DEBUG is enabled', 'redux-framework');
    }
    
    $localhost_bit = '';
    if (Redux_Helpers::isLocalHost ()) {
        $is_localhost = true;
        $localhost_bit = __('you are working in a localhost environment', 'redux-framework');
    }
    
    $conjunction_bit = '';
    if ($is_localhost && $is_debug) {
        $conjunction_bit = ' ' . __('and', 'redux-framework') . ' ';
    }
    
    $tip_msg    = __('Redux has enabled developer mode because', 'redux-framework') . ' ' . $debug_bit . $conjunction_bit . $localhost_bit . '.';
} else {
    $tip_msg    = __('If you are not a developer, your theme/plugin author shipped with developer mode enabled. Contact them directly to fix it.', 'redux-framework');
}

?>
<div id="redux-header">
	<?php if ( ! empty( $this->parent->args['display_name'] ) ) : ?>
		<div class="display_header">

			<?php if ( isset( $this->parent->args['dev_mode'] ) && $this->parent->args['dev_mode'] ) { ?>
                            <div class="redux-dev-mode-notice-container redux-dev-qtip" qtip-title="<?php echo $tip_title; ?>" qtip-content="<?php echo $tip_msg; ?>">
				<span class="redux-dev-mode-notice"><?php _e( 'Developer Mode Enabled', 'redux-framework' ); ?></span>
                            </div>
                        <?php } ?>
                        
                        
			<h2 class="to_logo"></h2>
<div id="redux-sticky">
	<div id="info_bar">

		<a href="javascript:void(0);"
		   class="expand_options<?php echo ( $this->parent->args['open_expanded'] ) ? ' expanded' : ''; ?>"<?php echo $this->parent->args['hide_expand'] ? ' style="display: none;"' : '' ?>><?php _e( 'Expand', 'redux-framework' ); ?></a>

		<div class="redux-action_bar">
			<span class="spinner"></span>
			<?php submit_button( __( 'Save Changes', 'redux-framework' ), 'primary', 'redux_save', false  ); ?>
			<?php if ( false === $this->parent->args['hide_reset'] ) : ?>
				<?php submit_button( __( 'Reset Section', 'redux-framework' ), 'secondary reset_btn', $this->parent->args['opt_name'] . '[defaults-section]', false ); ?>
				<?php submit_button( __( 'Reset All', 'redux-framework' ), 'secondary reset_all_btn', $this->parent->args['opt_name'] . '[defaults]', false ); ?>
			<?php endif; ?>
		</div>
		<div class="redux-ajax-loading" alt="<?php _e( 'Working...', 'redux-framework' ) ?>">&nbsp;</div>
		<div class="clear"></div>
	</div>

	<!-- Notification bar -->
	<div id="redux_notification_bar">
		<?php $this->notification_bar(); ?>
	</div>


</div>
			<?php if ( ! empty( $this->parent->args['display_version'] ) ) : ?>
				<span><?php echo $this->parent->args['display_version']; ?></span>
			<?php endif; ?>

		</div>
	<?php endif; ?>

	<div class="clear"></div>
</div>