<div class="wrap vc-page-welcome about-wrap">
	<h1><?php echo sprintf( __( 'Welcome to Visual Composer %s', 'js_composer' ), preg_replace( '/^(\d+)(\.\d+)?(\.\d)?/', '$1$2', WPB_VC_VERSION ) ) ?></h1>

	<div class="about-text">
		<?php _e( 'Congratulations! You are about to use most powerful time saver for WordPress ever - page builder plugin with Frontend and Backend editors by WPBakery.', 'js_composer' ) ?>
	</div>
	<div class="wp-badge vc-page-logo">
		<?php echo sprintf( __( 'Version %s', 'js_composer' ), WPB_VC_VERSION ) ?>
	</div>
	<p class="vc-page-actions">
		<a href="<?php echo esc_attr( admin_url( 'admin.php?page=vc-general' ) ) ?>"
		   class="button button-primary"><?php _e( 'Settings', 'js_composer' ) ?></a>
		<a href="https://twitter.com/share" class="twitter-share-button"
		   data-text="Take full control over your WordPress site with Visual Composer page builder by @WPBakery"
		   data-url="http://vc.wpbakery.com" data-size="large">Tweet</a>
		<script>! function ( d, s, id ) {
				var js, fjs = d.getElementsByTagName( s )[ 0 ], p = /^http:/.test( d.location ) ? 'http' : 'https';
				if ( ! d.getElementById( id ) ) {
					js = d.createElement( s );
					js.id = id;
					js.src = p + '://platform.twitter.com/widgets.js';
					fjs.parentNode.insertBefore( js, fjs );
				}
			}( document, 'script', 'twitter-wjs' );</script>
	</p>
	<?php vc_include_template( '/pages/partials/_tabs.php',
		array(
			'slug' => $page->getSlug(),
			'active_tab' => $active_page->getSlug(),
			'tabs' => $pages
		) );
	?>
	<?php echo $active_page->render(); ?>
</div>