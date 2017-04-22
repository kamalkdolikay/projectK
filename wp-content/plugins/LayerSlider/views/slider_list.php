<?php

	if(!defined('LS_ROOT_FILE')) {
		header('HTTP/1.0 403 Forbidden');
		exit;
	}

	// Get screen options
	$lsScreenOptions = get_option('ls-screen-options', '0');
	$lsScreenOptions = ($lsScreenOptions == 0) ? array() : $lsScreenOptions;
	$lsScreenOptions = is_array($lsScreenOptions) ? $lsScreenOptions : unserialize($lsScreenOptions);

	// Defaults
	if(!isset($lsScreenOptions['showTooltips'])) { $lsScreenOptions['showTooltips'] = 'true'; }
	if(!isset($lsScreenOptions['showRemovedSliders'])) { $lsScreenOptions['showRemovedSliders'] = 'false'; }
	if(!isset($lsScreenOptions['numberOfSliders'])) { $lsScreenOptions['numberOfSliders'] = '10'; }

	// Get current page
	$curPage = (!empty($_GET['paged']) && is_numeric($_GET['paged'])) ? (int) $_GET['paged'] : 1;
	// $curPage = ($curPage >= $maxPage) ? $maxPage : $curPage;

	// Set filters
	$filters = array('page' => $curPage, 'limit' => (int) $lsScreenOptions['numberOfSliders']);
	if($lsScreenOptions['showRemovedSliders'] == 'true') {
		$filters['exclude'] = array('hidden'); }

	// Find sliders
	$sliders = LS_Sliders::find($filters);

	// Pager
	$maxItem = LS_Sliders::$count;
	$maxPage = ceil($maxItem / (int) $lsScreenOptions['numberOfSliders']);
	$maxPage = $maxPage ? $maxPage : 1;

	// Custom capability
	$custom_capability = $custom_role = get_option('layerslider_custom_capability', 'manage_options');
	$default_capabilities = array('manage_network', 'manage_options', 'publish_pages', 'publish_posts', 'edit_posts');

	if(in_array($custom_capability, $default_capabilities)) {
		$custom_capability = '';
	} else {
		$custom_role = 'custom';
	}

	// Auto-updates
	$code = get_option('layerslider-purchase-code', '');
	if(!empty($code)) {
		$start = substr($code, 0, -6);
		$end = substr($code, -6);
		$code = preg_replace("/[a-zA-Z0-9]/", '●', $start) . $end;
		$code = str_replace('-', ' ', $code);
	}

	$validity = get_option('layerslider-authorized-site', '0');
	$channel = get_option('layerslider-release-channel', 'stable');

	// Google Fonts
	$googleFonts = get_option('ls-google-fonts', array());
	$googleFontScripts = get_option('ls-google-font-scripts', array('latin', 'latin-ext'));

	// Box toggles
	$lsBoxToggles = get_option('ls-collapsed-boxes', array());
	$lsAdvSettingsToggle = isset($lsBoxToggles['ls-advanced-settings-toggle']) ? $lsBoxToggles['ls-advanced-settings-toggle'] : true;
	$lsGoogleFontsToggle = isset($lsBoxToggles['ls-google-fonts-toggle']) ? $lsBoxToggles['ls-google-fonts-toggle'] : true;

	// Notification messages
	$notifications = array(
		'removeSelectError' => __('No sliders were selected to remove.', 'LayerSlider'),
		'removeSuccess' => __('The selected sliders were removed.', 'LayerSlider'),
		'deleteSelectError' => __('No sliders were selected.', 'LayerSlider'),
		'deleteSuccess' => __('The selected sliders were permanently deleted.', 'LayerSlider'),
		'mergeSelectError' => __('You need to select at least 2 sliders to merge them.', 'LayerSlider'),
		'mergeSuccess' => __('The selected items were merged together as a new slider.', 'LayerSlider'),
		'restoreSelectError' => __('No sliders were selected.', 'LayerSlider'),
		'restoreSuccess' => __('The selected sliders were restored.', 'LayerSlider'),

		'exportNotFound' => __('No sliders were found to export.', 'LayerSlider'),
		'exportSelectError' => __('No sliders were selected to export.', 'LayerSlider'),
		'exportZipError' => __('The PHP ZipArchive extension is required to import .zip files.', 'LayerSlider'),

		'importSelectError' => __('Choose a file to import sliders.', 'LayerSlider'),
		'importFailed' => __('The import file seems to be invalid or corrupted.', 'LayerSlider'),
		'importSuccess' => __('Your slider has been imported.', 'LayerSlider'),
		'permissionError' => __('Your account does not have the necessary permission you have chosen, and your settings have not been saved in order to prevent locking yourself out of the plugin.', 'LayerSlider'),
		'permissionSuccess' => __('Permission changes has been updated.', 'LayerSlider'),
		'googleFontsUpdated' => __('Your Google Fonts library has been updated.', 'LayerSlider'),
		'generalUpdated' => __('Your settings has been updated.', 'LayerSlider')
	);
?>
<div id="ls-screen-options" class="metabox-prefs hidden">
	<div id="screen-options-wrap" class="hidden">
		<form id="ls-screen-options-form" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
			<h5><?php _e('Show on screen', 'LayerSlider') ?></h5>
			<label><input type="checkbox" name="showTooltips"<?php echo $lsScreenOptions['showTooltips'] == 'true' ? ' checked="checked"' : ''?>> <?php _e('Tooltips', 'LayerSlider') ?></label>
			<label><input type="checkbox" name="showRemovedSliders" class="reload"<?php echo $lsScreenOptions['showRemovedSliders'] == 'true' ? ' checked="checked"' : ''?>> <?php _e('Removed sliders', 'LayerSlider') ?></label><br><br>

			<input type="number" name="numberOfSliders" min="3" step="1" value="<?php echo $lsScreenOptions['numberOfSliders'] ?>"> <?php _e('Sliders', 'LayerSlider') ?>
			<button class="button"><?php _e('Apply', 'LayerSlider') ?></button>
		</form>
	</div>
	<div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle">
		<a href="#screen-options-wrap" id="show-settings-link" class="show-settings"><?php _e('Screen Options', 'LayerSlider') ?></a>
	</div>
</div>
<div class="wrap" id="ls-list-page">
	<h2>
		<?php _e('LayerSlider sliders', 'LayerSlider') ?>
		<a href="#" id="ls-add-slider-button" class="add-new-h2"><?php _e('Add New', 'LayerSlider') ?></a>
		<a href="#" id="ls-import-samples-button" class="add-new-h2"><?php _e('Import sample sliders', 'LayerSlider') ?></a>
	</h2>

	<!-- Error messages -->
	<?php if(isset($_GET['message'])) : ?>
	<div class="ls-notification <?php echo isset($_GET['error']) ? 'error' : 'updated' ?>">
		<div><?php echo $notifications[ $_GET['message'] ] ?></div>
	</div>
	<?php endif; ?>
	<!-- End of error messages -->

	<!-- Version number -->
	<?php if(strpos(LS_PLUGIN_VERSION, 'b') !== false) : ?>
	<div class="ls-version-number">
		<?php _e('Using beta version', 'LayerSlider') ?> (<?php echo LS_PLUGIN_VERSION ?>)
		<a href="mailto:support@kreaturamedia.com?subject=LayerSlider WP Beta Feedback"><?php _e('Send feedback', 'LayerSlider') ?></a>
	</div>
	<?php endif; ?>
	<!-- End of version number -->

	<!-- Add slider template -->
	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="ls-add-slider-template" class="ls-pointer ls-box">
		<?php wp_nonce_field('add-slider'); ?>
		<input type="hidden" name="ls-add-new-slider" value="1">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php _e('Name your new slider', 'LayerSlider') ?></h3>
		<div class="inner">
			<input type="text" name="title" placeholder="<?php _e('e.g. Homepage slider', 'LayerSlider') ?>">
			<button class="button"><?php _e('Add slider', 'LayerSlider') ?></button>
		</div>
	</form>
	<!-- End of Add slider template -->


	<!-- Import sample sliders template -->
	<?php $demoSliders = LS_Sources::getDemoSliders(); ?>
	<div id="ls-import-samples-template" class="ls-pointer ls-box">
		<span class="ls-mce-arrow"></span>
		<h3 class="header"><?php _e('Choose a demo slider to import', 'LayerSlider') ?></h3>
		<ul class="inner">
			<?php foreach($demoSliders as $item) : ?>
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider='.$item['handle'].'', 'import-sample-sliders') ?>">
					<div class="preview"><img src="<?php echo $item['preview'] ?>"></div>
					<div class="title"><?php echo $item['name'] ?></div>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
		<ul class="inner sep">
			<li>
				<a href="<?php echo wp_nonce_url('?page=layerslider&action=import_sample&slider=all', 'import-sample-sliders') ?>">
					Import all demo sliders (might be slow)
				</a>
			</li>
		</ul>
		<div class="inner">
			More demo content can be found in the downloaded package from CodeCanyon. You can import them in the usual way in the "Import and Export Sliders" section below.
		</div>
	</div>
	<!-- End of Import sample sliders template -->


	<!-- Share sheet template -->
	<?php
		$time = time();
		$installed = get_option('ls-date-installed', 0);
		$level = get_option('ls-share-displayed', 1);

		switch($level){
			case 1:
				$time = $time-60*60*24*14;
				$odds = 100;
				break;

			case 2:
				$time = $time-60*60*24*30*2;
				$odds = 200;
				break;

			case 3:
				$time = $time-60*60*24*30*6;
				$odds = 300;
				break;

			default:
				$time = $time-60*60*24*14;
				$odds = 100;
				break;
		}

		if($installed && $time > $installed) {
			if(mt_rand(1, $odds) == 3) {
				update_option('ls-share-displayed', ++$level);
	?>
	<div class="ls-overlay" data-manualclose="true"></div>
	<link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
	<div id="ls-share-template" class="ls-modal ls-box">
		<h3>
			<?php _e('Enjoy using LayerSlider?', 'LayerSlider') ?>
			<a href="#" class="dashicons dashicons-no-alt"></a>
		</h3>
		<div class="inner desc">
			<?php _e("If so, please consider recommending it to your friends on your favorite social network!", "LayerSlider"); ?>
		</div>
		<div class="inner">
			<a href="https://www.facebook.com/sharer/sharer.php?u=http://kreaturamedia.com/layerslider-responsive-wordpress-slider-plugin/" target="_blank">
				<i class="dashicons dashicons-facebook-alt"></i> Share
			</a>

			<a href="http://www.twitter.com/share?url=http%3A%2F%2Fkreaturamedia.com%2Flayerslider-responsive-wordpress-slider-plugin%2F&amp;text=Check%20out%20LayerSlider%20WP%2C%20an%20awesome%20%23slider%20%23plugin%20for%20%23WordPress&amp;via=kreaturamedia" target="_blank">
				<i class="dashicons dashicons-twitter"></i> Tweet
			</a>

			<a href="https://plus.google.com/share?url=http://kreaturamedia.com/layerslider-responsive-wordpress-slider-plugin/" target="_blank">
				<i class="dashicons dashicons-googleplus"></i> +1
			</a>
		</div>
	</div>
	<?php } } ?>
	<!-- End of Share sheet template -->


	<!-- Auto-update revalidation -->
	<?php if(
		get_option('layerslider-validated', null) === '1' &&
		get_option('layerslider-authorized-site', null) === null &&
		get_option('ls-show-revalidation-notice', 1)
	) : ?>
	<div class="ls-overlay" data-manualclose="true"></div>
	<div id="ls-autoupdate-popup" class="ls-box">
		<h3 class="header">Auto-update revalidation required</h3>
		<div class="inner">
			<h4>What's changed?</h4>
			<p>Due to changes in our auto-update solution you need to re-validate the plugin to receive automatic updates again. From now on a purchase code can be used to enable automatic updates on 2 websites only. The domain name of your site will be recorded on re-activation.</p>
			<h4>What do I have to do?</h4>
			<p>Since you've already entered your purchase code you just need to click on the "Update" button in the auto-update box. Please keep in mind that now you can only activate 2 websites with a key at the same time.</p>
			<h4>Why is it necessary?</h4>
			<p>Item purchase codes have many applications besides the auto-update feature. We feel it's important to minimize the impact of leaked/shared codes on the web in order to improve user experience and our products and support services.</p>
			<h4>Should I be worried?</h4>
			<p>The plugin will remain functioning without any restriction, but you need to re-validate your purchase to receive updates again. If you've got LayerSlider by a theme purchase you can receive the latest versions with theme updates, unless you purchase a license directly for LayerSlider on <a href="http://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin-/1362246" target="_blank">CodeCanyon</a>.</p>
			<p>For more details about licensing, please read our <a href="http://support.kreaturamedia.com/faq/4/layerslider-for-wordpress/#group-3" target="_blank">FAQ entries</a> or check the relevant <a href="http://codecanyon.net/licenses/standard" target="_blank">marketplace pages<a>.</p>
			<p class="signature">Please accept our sincerest apologies for any inconvenience may caused. <br> Kreatura Media Team</p>
			<a href="<?php echo wp_nonce_url('?page=layerslider&action=hide-revalidation-notice', 'hide-revalidation-notice') ?>" class="button button-primary">I understand</a>
		</div>
	</div>
	<?php endif ?>
	<!-- End of Auto-update revalidation template -->

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
		<input type="hidden" name="ls-bulk-action" value="1">
		<?php wp_nonce_field('bulk-action'); ?>
		<div class="ls-box ls-sliders-list">
			<table>
				<thead class="header">
					<tr>
						<td></td>
						<td><?php _e('ID', 'LayerSlider') ?></td>
						<td class="preview"><?php _e('Slider preview', 'LayerSlider') ?></td>
						<td><?php _e('Name', 'LayerSlider') ?></td>
						<td><?php _e('Shortcode', 'LayerSlider') ?></td>
						<td><?php _e('Slides', 'LayerSlider') ?></td>
						<td><?php _e('Created', 'LayerSlider') ?></td>
						<td><?php _e('Modified', 'LayerSlider') ?></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($sliders)) : ?>
					<?php foreach($sliders as $key => $item) : ?>
					<?php $class = ($item['flag_deleted'] == '1') ? ' class="faded"' : '' ?>
					<tr<?php echo $class ?>>
						<td><input type="checkbox" name="sliders[]" value="<?php echo $item['id'] ?>"></td>
						<td><?php echo $item['id'] ?></td>
						<td class="preview">
							<div>
								<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
									<img src="<?php echo apply_filters('ls_get_preview_for_slider', $item ) ?>" alt="Slider preview">
								</a>
							</div>
						</td>
						<td class="name">
							<a href="?page=layerslider&action=edit&id=<?php echo $item['id'] ?>">
								<?php echo apply_filters('ls_slider_title', $item['name'], 40) ?>
							</a>
						</td>
						<td><input type="text" class="ls-shortcode" value="[layerslider id=&quot;<?php echo !empty($item['slug']) ? $item['slug'] : $item['id'] ?>&quot;]" readonly></td>
						<td><?php echo isset($item['data']['layers']) ? count($item['data']['layers']) : 0 ?></td>
						<td><?php echo date('d/m/y', $item['date_c']) ?></td>
						<td><?php echo human_time_diff($item['date_m']) ?> <?php _e('ago', 'LayerSlider') ?></td>
						<td>
							<?php if(!$item['flag_deleted']) : ?>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=duplicate&id='.$item['id'], 'duplicate_'.$item['id']) ?>">
								<span class="dashicons dashicons-admin-page" data-help="<?php _e('Duplicate this slider', 'LayerSlider') ?>"></span>
							</a>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=remove&id='.$item['id'], 'remove_'.$item['id']) ?>" class="remove">
								<span class="dashicons dashicons-trash" data-help="<?php _e('Remove this slider', 'LayerSlider') ?>"></span>
							</a>
							<?php else : ?>
							<a href="<?php echo wp_nonce_url('?page=layerslider&action=restore&id='.$item['id'], 'restore_'.$item['id']) ?>">
								<span class="dashicons dashicons-backup" data-help="<?php _e('Restore removed slider', 'LayerSlider') ?>"></span>
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if(empty($sliders)) : ?>
					<tr>
						<td colspan="9"><?php _e('You haven\'t created any slider yet. Click on the "Add New" button above to add one.', 'LayerSlider') ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<div class="ls-bulk-actions">
			<select name="action">
				<option value="0"><?php _e('Bulk Actions', 'LayerSlider') ?></option>
				<option value="remove"><?php _e('Remove selected', 'LayerSlider') ?></option>
				<option value="delete"><?php _e('Delete permanently', 'LayerSlider') ?></option>
				<?php if($lsScreenOptions['showRemovedSliders'] == 'true') : ?>
				<option value="restore"><?php _e('Restore removed', 'LayerSlider') ?></option>
				<?php endif; ?>
				<option value="merge"><?php _e('Merge selected as new', 'LayerSlider') ?></option>
			</select>
			<button class="button"><?php _e('Apply', 'LayerSlider') ?></button>
		</div>
		</div>
	</form>
	<div class="ls-pagination tablenav bottom">
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo $maxItem ?> <?php _e('items', 'LayerSlider') ?></span>
			<span class="pagination-links">
				<a class="first-page<?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the first page" href="admin.php?page=layerslider">«</a>
				<a class="prev-page <?php echo ($curPage <= 1) ? ' disabled' : ''; ?>" title="Go to the previous page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage-1) ?>">‹</a>
				<form action="admin.php" method="get" class="paging-input">
					<input type="hidden" name="page" value="layerslider">
					<input class="current-page" title="Current page" type="text" name="paged" value="<?php echo $curPage ?>" size="1"> of
					<span class="total-pages"><?php echo $maxPage ?></span>
				</form>
				<a class="next-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the next page" href="admin.php?page=layerslider&amp;paged=<?php echo ($curPage+1) ?>">›</a>
				<a class="last-page <?php echo ($curPage >= $maxPage) ? ' disabled' : ''; ?>" title="Go to the last page" href="admin.php?page=layerslider&amp;paged=<?php echo $maxPage ?>">»</a>
			</span>
		</div>
	</div>


	<div class="ls-export-wrapper columns clearfix">
		<div class="half">
			<div class="ls-import-export-box ls-box">
				<h3 class="header medium"><?php _e('Import Sliders', 'LayerSlider') ?></h3>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data" class="ls-import-box">
					<?php wp_nonce_field('import-sliders'); ?>
					<input type="hidden" name="ls-import" value="1">
					<table data-help="<?php _e('Choose a LayerSlider export file downloaded previously to import your sliders. In order to import from outdated versions, you need to create a file and paste the export code into it. The file needs to have a .json extension.', 'LayerSlider') ?>">
						<tbody>
							<tr>
								<td>
									<input type="file" name="import_file" class="ls-import-file">
									<label><input type="checkbox" name="import_images" class="checkbox" checked="checked"> <?php _e('Import images (if available)', 'LayerSlider') ?></label>
									<button class="button"><?php _e('Import', 'LayerSlider') ?></button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="ls-import-export-box ls-box">
				<h3 class="header medium"><?php _e('Export Sliders', 'LayerSlider') ?></h3>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-export-form">
					<?php wp_nonce_field('export-sliders'); ?>
					<input type="hidden" name="ls-export" value="1">
					<table>
						<tbody>
							<tr>
								<td>
									<select name="sliders[]" multiple="multiple" data-help="<?php _e('Downloads an export file that contains your selected sliders to import on your new site. You can select multiple sliders by holding the Ctrl/Cmd button while clicking.', 'LayerSlider') ?>">
										<option value="-1" selected> <?php _e('All Sliders', 'LayerSlider') ?></option>
										<?php foreach($sliders as $slider) : ?>
										<option value="<?php echo $slider['id'] ?>">
											#<?php echo str_replace(' ', '&nbsp;', str_pad($slider['id'], 3, " ")) ?> -
											<?php echo apply_filters('ls_slider_title', $slider['name'], 30) ?>
										</option>
										<?php endforeach; ?>
									</select>

									<label>
										<input type="checkbox"  class="checkbox" name="exportWithImages" checked> Export images
									</label>
									<button class="button"><?php _e('Export', 'LayerSlider') ?></button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr data-help="The PHP ZipArchive extension is needed for exporting/importing images. The plugin will only copy your slider settings if it's not available. In that case please contact with your hosting provider.">
								<td class="<?php echo class_exists('ZipArchive') ? 'available' : 'notavailable' ?>">
									<?php echo class_exists('ZipArchive') ?
										'ZipArchive is available to import/export images' :
										'ZipArchive isn\'t avilable'
									?>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>

		<div class="half">
			<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-import-export-box" id="ls-permission-form">
				<?php wp_nonce_field('save-access-permissions'); ?>
				<input type="hidden" name="ls-access-permission" value="1">
				<h3 class="header medium">
					<?php _e('Allow LayerSlider access to users with ...', 'LayerSlider') ?>
				</h3>
				<table>
					<tbody>
						<tr>
							<td><?php _e('Role', 'LayerSlider') ?></td>
							<td>
								<select name="custom_role">
									<?php if(is_multisite()) : ?>
									<option value="manage_network" <?php echo ($custom_role == 'manage_network') ? 'selected="selected"' : '' ?>> <?php _e('Super Admin', 'LayerSlider') ?></option>
									<?php endif; ?>
									<option value="manage_options" <?php echo ($custom_role == 'manage_options') ? 'selected="selected"' : '' ?>> <?php _e('Admin', 'LayerSlider') ?></option>
									<option value="publish_pages" <?php echo ($custom_role == 'publish_pages') ? 'selected="selected"' : '' ?>> <?php _e('Editor, Admin', 'LayerSlider') ?></option>
									<option value="publish_posts" <?php echo ($custom_role == 'publish_posts') ? 'selected="selected"' : '' ?>> <?php _e('Author, Editor, Admin', 'LayerSlider') ?></option>
									<option value="edit_posts" <?php echo ($custom_role == 'edit_posts') ? 'selected="selected"' : '' ?>> <?php _e('Contributor, Author, Editor, Admin', 'LayerSlider') ?></option>
									<option value="custom" <?php echo ($custom_role == 'custom') ? 'selected="selected"' : '' ?>> <?php _e('Custom', 'LayerSlider') ?></option>
								</select>
							</td>
							<td><button class="button"><?php _e('Update', 'LayerSlider') ?></button></td>
							<!-- <td class="desc"><?php _e('If you want to give access for other users than admins to this page, you can specify a custom capability. You can find all the available capabilities on', 'LayerSlider') ?> <a href="http://codex.wordpress.org/Roles_and_Capabilities#Capabilities" target="_blank"><?php _e('this page', 'LayerSlider') ?></a>.</td> -->
						</tr>
						<tr>
							<td><?php _e('Capability', 'LayerSlider') ?></td>
							<td><input type="text" name="custom_capability" value="<?php echo $custom_capability ?>" placeholder="Enter custom capability"></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>

		<div class="half">
			<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-settings ls-auto-update">
				<input type="hidden" name="action" value="layerslider_authorize_site">
				<h3 class="header medium blue">
					<?php _e('Automatic updates & Premium support', 'LayerSlider') ?>
					<i class="dashicons dashicons-editor-help" data-help="Receive update notifications and install new versions with just a click. For instructions to set up this feature, please hover over the individual option fields with your mouse cursor and read the tooltip messages. <br><br>Please note, the auto-update feature can be activated on two WordPress installations with a purchase code at the same time. We will store the domain name of your site upon activation, and an option to deauthorize installations will be provided."></i>
				</h3>
				<?php if($GLOBALS['lsAutoUpdateBox'] == false) : ?>
					<div class="inner" style="border-bottom: 1px solid #e3e3e3;">
						<?php _e("It seems you've received LayerSlider by a theme. Please note that the auto-update feature only works if you've purchased the plugin directly from us on <a href=\"http://codecanyon.net/item/layerslider-responsive-wordpress-slider-plugin-/1362246\" target=\"_blank\">CodeCanyon</a>.", "LayerSlider"); ?>
					</div>
				<?php endif ?>
				<table>
					<tbody>
						<tr>
							<td><?php _e('Purchase code', 'LayerSlider') ?></td>
							<td>
								<input type="text" name="purchase_code" value="<?php echo $code ?>"  class="key" placeholder="e.g. bc8e2b24-3f8c-4b21-8b4b-90d57a38e3c7" data-help="<?php _e('To receive automatic updates, you need to enter your item purchase code. Click on the Download button next to LayerSlider WP on your CodeCanyon downloads page and choose the &quot;License certificate & purchase code&quot; option. This will download a text file that contains your purchase code.', 'LayerSlider') ?>">
							</td>
						</tr>
						<tr>
							<td><?php _e('Release channel', 'LayerSlider') ?></td>
							<td>
								<label><input type="radio" name="channel" value="stable" <?php echo ($channel === 'stable') ? 'checked="checked"' : ''?>> <?php _e('Stable', 'LayerSlider') ?></label>
								<label data-help="<?php _e('Although pre-release versions meant to work properly, they might contain unknown issues, and are not recommended for sites in production.', 'LayerSlider') ?>">
									<input type="radio" name="channel" value="beta" <?php echo ($channel === 'beta') ? 'checked="checked"' : ''?>> <?php _e('Beta', 'LayerSlider') ?>
								</label>
							</td>
						</tr>
						<tr>
							<td><?php _e('Status', 'LayerSlider'); ?></td>
							<td>
								<span class="status" style="<?php echo ($validity == '1') ? 'color: #4b982f;' : 'color: #c33219'?>">
								<?php
									if($validity == '1') {
										_e('This site is authorized to receive automatic updates.', 'LayerSlider');

									} else {
										_e("This site is not yet authorized to receive plugin updates.", "LayerSlider");
									}
								?>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="footer">
					<button class="button"><?php _e('Update', 'LayerSlider') ?></button>
					<a href="#" class="ls-deauthorize<?php echo ($validity == '1') ? '' : ' ls-hidden' ?>"><?php _e('Deauthorize this site', 'LayerSlider') ?></a>
					<a href="update-core.php" class="<?php echo ($validity == '1') ? '' : 'ls-hidden' ?>"><?php _e('Check for update', 'LayerSlider') ?></a>
				</div>
			</form>
		</div>
	</div>


	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-global-settings<?php echo ($lsAdvSettingsToggle) ? ' collapsed' : '' ?>">
		<?php wp_nonce_field('save-advanced-settings'); ?>
		<input type="hidden" name="ls-save-advanced-settings">
		<h2 class="header medium">
			<?php _e('Troubleshooting & Advanced Settings', 'LayerSlider') ?>
			<figure><span>|</span><?php _e("Don't change these settings without experience. LayerSlider will let you know when it encounters a problem.", "LayerSlider") ?></figure>
			<span id="ls-advanced-settings-toggle" class="dashicons dashicons-arrow-<?php echo $lsAdvSettingsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>
		<div class="inner">
			<table>
				<tr>
					<td><?php _e('Use Google CDN version of jQuery', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="use_custom_jquery" <?php echo get_option('ls_use_custom_jquery', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e('This option will likely solve "Old jQuery" issues.', 'LayerSlider') ?></td>
				</tr>
				<tr>
					<td><?php _e("Include scripts in the footer", "LayerSlider") ?></td>
					<td><input type="checkbox" name="include_at_footer" <?php echo get_option('ls_include_at_footer', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Including resources in the footer could decrease load times, and solve other type of issues, but your theme might not support this method.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e("Conditional script loading", "LayerSlider") ?></td>
					<td><input type="checkbox" name="conditional_script_loading" <?php echo get_option('ls_conditional_script_loading', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Increase your site's performance by loading resources only when necessary. Outdated themes might not support this method.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e('Concatenate output', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="concatenate_output" <?php echo get_option('ls_concatenate_output', true) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e("Concatenating the plugin's output could solve issues caused by custom filters your theme might use.", "LayerSlider") ?></td>
				</tr>
				<tr>
					<td><?php _e('Put JS includes to body', 'LayerSlider') ?></td>
					<td><input type="checkbox" name="put_js_to_body" <?php echo get_option('ls_put_js_to_body', false) ? 'checked="checked"' : '' ?>></td>
					<td class="desc"><?php _e('This is the most common workaround for jQuery related issues, and is recommended when you experience problems with jQuery.', 'LayerSlider') ?></td>
				</tr>
			</table>
			<div class="footer">
				<button type="submit" class="button"><?php _e('Save changes', 'LayerSlider') ?></button>
			</div>
		</div>
	</form>

	<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="ls-box ls-google-fonts<?php echo $lsGoogleFontsToggle ? ' collapsed' : '' ?>">
		<?php wp_nonce_field('save-google-fonts'); ?>
		<input type="hidden" name="ls-save-google-fonts" value="1">

		<!-- Google Fonts Header -->
		<h2 class="header medium">
			<?php _e('Load Google Fonts', 'LayerSlider') ?>
			<span id="ls-google-fonts-toggle" class="dashicons dashicons-arrow-<?php echo $lsGoogleFontsToggle ? 'right' : 'down' ?> ls-ficon ls-box-toggle"></span>
		</h2>

		<!-- Google Fonts list -->
		<div class="inner">
			<ul class="ls-font-list">
				<li class="ls-hidden">
					<a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
					<input type="text" name="urlParams[]" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[]">
					<?php _e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php if(is_array($googleFonts) && !empty($googleFonts)) : ?>
				<?php foreach($googleFonts as $item) : ?>
				<li>
					<a href="#" class="remove dashicons dashicons-dismiss" title="Remove this font"></a>
					<input type="text" name="urlParams[]" value="<?php echo $item['param'] ?>" readonly="readonly">
					<input type="checkbox" name="onlyOnAdmin[]" <?php echo $item['admin'] ? ' checked="checked"' : '' ?>>
					<?php _e('Load only on admin interface', 'LayerSlider') ?>
				</li>
				<?php endforeach ?>
				<?php else : ?>
				<li class="ls-notice"><?php _e("You didn't add any Google font to your library yet.", "LayerSlider") ?></li>
				<?php endif ?>
			</ul>
		</div>
		<div class="inner ls-font-search">

			<input type="text" placeholder="<?php _e('Enter a font name to add to your collection', 'LayerSlider') ?>">
			<button class="button"><?php _e('Search', 'LayerSlider') ?></button>

			<!-- Google Fonts search pointer -->
			<div class="ls-box ls-pointer">
				<h3 class="header"><?php _e('Choose a font family', 'LayerSlider') ?></h3>
				<div class="fonts">
					<ul class="inner"></ul>
				</div>
				<div class="variants">
					<ul class="inner"></ul>
					<div class="inner">
						<button class="button add-font"><?php _e('Add font', 'LayerSlider') ?></button>
						<button class="button right"><?php _e('Back to results', 'LayerSlider') ?></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Google Fonts search bar -->
		<div class="inner footer">
			<button type="submit" class="button"><?php _e('Save changes', 'LayerSlider') ?></button>
			<?php
				$scripts = array(
					'cyrillic' => __('Cyrillic', 'LayerSlider'),
					'cyrillic-ext' => __('Cyrillic Extended', 'LayerSlider'),
					'devanagari' => __('Devanagari', 'LayerSlider'),
					'greek' => __('Greek', 'LayerSlider'),
					'greek-ext' => __('Greek Extended', 'LayerSlider'),
					'khmer' => __('Khmer', 'LayerSlider'),
					'latin' => __('Latin', 'LayerSlider'),
					'latin-ext' => __('Latin Extended', 'LayerSlider'),
					'vietnamese' => __('Vietnamese', 'LayerSlider')
				);
			?>
			<div class="right">
				<div>
					<select>
						<option><?php _e('Select new', 'LayerSlider') ?></option>
						<?php foreach($scripts as $key => $val) : ?>
						<option value="<?php echo $key ?>"><?php echo $val ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<ul class="ls-google-font-scripts">
					<li class="ls-hidden">
						<span></span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php _e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="">
					</li>
					<?php if(!empty($googleFontScripts) && is_array($googleFontScripts)) : ?>
					<?php foreach($googleFontScripts as $item) : ?>
					<li>
						<span><?php echo $scripts[$item] ?></span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php _e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="<?php echo $item ?>">
					</li>
					<?php endforeach ?>
					<?php else : ?>
					<li>
						<span>Latin</span>
						<a href="#" class="dashicons dashicons-dismiss" title="<?php _e('Remove character set', 'LayerSlider') ?>"></a>
						<input type="hidden" name="scripts[]" value="latin">
					</li>
					<?php endif ?>
				</ul>
				<div><?php _e('Use character sets:', 'LayerSlider') ?></div>
			</div>
		</div>

	</form>

	<div class="ls-box ls-news">
		<div class="header medium">
			<h2><?php _e('LayerSlider News', 'LayerSlider') ?></h2>
			<div class="filters">
				<span><?php _e('Filter:', 'LayerSlider') ?></span>
				<ul>
					<li class="active" data-page="all"><?php _e('All', 'LayerSlider') ?></li>
					<li data-page="announcements"><?php _e('Announcements', 'LayerSlider') ?></li>
					<li data-page="changes"><?php _e('Release log', 'LayerSlider') ?></li>
					<li data-page="betas"><?php _e('Beta versions', 'LayerSlider') ?></li>
				</ul>
			</div>
			<div class="ls-version"<?php _e('>You have version', 'LayerSlider') ?> <?php echo LS_PLUGIN_VERSION ?> <?php _e('installed', 'LayerSlider') ?></div>
		</div>
		<div>
			<iframe src="http://news.kreaturamedia.com/layerslider/"></iframe>
		</div>
	</div>
</div>

<!-- Help menu WP Pointer -->
<?php
if(get_user_meta(get_current_user_id(), 'layerslider_help_wp_pointer', true) != '1') {
add_user_meta(get_current_user_id(), 'layerslider_help_wp_pointer', '1'); ?>
<script type="text/javascript">

	// Help
	jQuery(document).ready(function() {
		jQuery('#contextual-help-link-wrap').pointer({
			pointerClass : 'ls-help-pointer',
			pointerWidth : 320,
			content: '<h3><?php _e('The documentation is here', 'LayerSlider') ?></h3><div class="inner"><?php _e('Open this help menu to quickly access to our online documentation.', 'LayerSlider') ?></div>',
			position: {
				edge : 'top',
				align : 'right'
			}
		}).pointer('open');
	});
</script>
<?php } ?>
<script type="text/javascript">
	var lsScreenOptions = <?php echo json_encode($lsScreenOptions) ?>;
</script>
