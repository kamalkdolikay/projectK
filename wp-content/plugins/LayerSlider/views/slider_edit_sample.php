<?php 
	if(!defined('LS_ROOT_FILE')) { 
		header('HTTP/1.0 403 Forbidden');
		exit;
	}
?>
<div id="ls-sample">
	<div class="ls-box ls-layer-box">
		<input type="hidden" name="layerkey" value="0">
		<table>
			<thead class="ls-layer-options-thead">
				<tr>
					<td colspan="3">
						<i class="dashicons dashicons-welcome-write-blog"></i>
						<h4><?php _e('Slide Options', 'LayerSlider') ?></h4>
					</td>
				</tr>
			</thead>
			<tbody class="ls-slide-options">
				<input type="hidden" name="post_offset" value="-1">
				<input type="hidden" name="3d_transitions">
				<input type="hidden" name="2d_transitions">
				<input type="hidden" name="custom_3d_transitions">
				<input type="hidden" name="custom_2d_transitions">
				<tr>
					<td valign="top">
						<h3 class="subheader">Slide image &amp; thumbnail</h3>
						<div class="inner slide-image">
							<input type="hidden" name="backgroundId">
							<input type="hidden" name="background">
							<div class="ls-image ls-upload" data-help="<?php echo $lsDefaults['slides']['image']['tooltip'] ?>">
								<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
								<a href="#" class="dashicons dashicons-dismiss"></a>
							</div>
							<?php _e('or', 'LayerSlider') ?> <a href="#" class="ls-url-prompt"><?php _e('enter URL', 'LayerSlider') ?></a> <br>
							<?php _e('or', 'LayerSlider') ?> <a href="#" class="ls-post-image"><?php _e('use post image', 'LayerSlider') ?></a>
						</div>
						<div class="hsep"></div>
						<div class="inner slide-image">
							<input type="hidden" name="thumbnailId">
							<input type="hidden" name="thumbnail">
							<div class="ls-image ls-upload" data-help="<?php echo $lsDefaults['slides']['thumbnail']['tooltip'] ?>">
								<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
								<a href="#" class="dashicons dashicons-dismiss"></a>
							</div>
							<?php _e('or', 'LayerSlider') ?> <a href="#" class="ls-url-prompt"><?php _e('enter URL', 'LayerSlider') ?></a>
						</div>
					</td>
					<td valign="top" class="second">
						<h3 class="subheader">Duration</h3>
						<?php lsGetInput($lsDefaults['slides']['delay'], null, array('class' => 'layerprop')) ?> ms
						<h3 class="subheader">
							Transition
						</h3>
						<button type="button" class="button ls-select-transitions new" data-help="<?php _e('You can select your desired slide transitions by clicking on this button.', 'LayerSlider') ?>">Select transitions</button><br><br>
						<?php echo $lsDefaults['slides']['timeshift']['name'] ?><br>
						<?php lsGetInput($lsDefaults['slides']['timeshift'], null, array('class' => 'layerprop')) ?> ms
					</td>
					<td valign="top">
						<h3 class="subheader">Linking</h3>
						<div class="ls-slide-link">
							<?php lsGetInput($lsDefaults['slides']['linkUrl'], null, array('placeholder' => $lsDefaults['slides']['linkUrl']['name'] )) ?>
							<br> <?php lsGetSelect($lsDefaults['slides']['linkTarget'], null) ?>
							<span> or <a href="#"><?php _e('use post URL', 'LayerSlider') ?></a></span>
						</div>
						<h3 class="subheader">Misc</h3>
						<table class="noborder">
							<tr>
								<td>
									<?php echo $lsDefaults['slides']['ID']['name'] ?>
									<?php lsGetInput($lsDefaults['slides']['ID'], null) ?>
								</td>
								<td>
									<?php echo $lsDefaults['slides']['deeplink']['name'] ?>
									<?php lsGetInput($lsDefaults['slides']['deeplink'], null) ?>
								</td>
								<td>
									<?php _e('Hidden', 'LayerSlider') ?>
									<input type="checkbox" name="skip" class="checkbox" data-help="<?php _e("If you don't want to use this slide in your front-page, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<button type="button" class="button ls-configure-posts"><span class="dashicons dashicons-admin-post"></span><?php _e('Configure post options', 'LayerSlider') ?></button>
									<button type="button" class="button ls-layer-duplicate"><span class="dashicons dashicons-admin-page"></span><?php _e('Duplicate this slide', 'LayerSlider') ?></button>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<td>
						<i class="dashicons dashicons-editor-video ls-preview-icon"></i>
						<h4>
							<span><?php _e('Preview', 'LayerSlider') ?></span>
							<div class="ls-editor-zoom">
								<span class="ls-editor-slider-text">Size:</span>
								<div class="ls-editor-slider"></div>
								<span class="ls-editor-slider-val">100%</span>
							</div>
						</h4>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="ls-preview-td">
						<div class="ls-preview-wrapper">
							<div class="ls-preview">
								<div class="draggable ls-layer"></div>
							</div>
							<div class="ls-real-time-preview"></div>
						</div>
						<button type="button" class="button ls-preview-button"><?php _e('Enter Preview', 'LayerSlider') ?></button>
					</td>
				</tr>
			</tbody>
		</table>
		<table>
			<thead>
				<tr>
					<td>
						<div class="dashicons dashicons-images-alt ls-layers-icon"></div>
						<h4><?php _e('Layers', 'LayerSlider') ?><a href="#" class="ls-tl-toggle">[ <?php _e('timeline view', 'LayerSlider') ?> ]</a></h4>
					</td>
				</tr>
			</thead>
			<tbody class="ls-sublayers ls-sublayer-sortable">
				<tr class="active">
					<td>
						<div class="ls-sublayer-wrapper">
							<span class="ls-sublayer-sortable-handle dashicons dashicons-menu"></span>
							<span class="ls-sublayer-number">1</span>
							<input type="text" name="subtitle" class="ls-sublayer-title" value="Layer #1">

							<div class="ls-tl">
								<table>
									<tr>
										<td data-help="Delay in: " class="ls-tl-delayin"></td>
										<td data-help="Duration in: " class="ls-tl-durationin"></td>
										<td data-help="Show Until: " class="ls-tl-showuntil"></td>
										<td data-help="Duration out: " class="ls-tl-durationout"></td>
									</tr>
								</table>
							</div>

							<span class="ls-sublayer-controls">
								<span class="ls-highlight dashicons dashicons-lightbulb" data-help="<?php _e('Highlight layer in the editor.', 'LayerSlider') ?>"></span>
								<span class="ls-icon-lock dashicons dashicons-lock" data-help="<?php _e('Prevent layer from dragging in the editor.', 'LayerSlider') ?>"></span>
								<span class="ls-icon-eye dashicons dashicons-visibility" data-help="<?php _e('Hide layer in the editor.', 'LayerSlider') ?>"></span>
							</span>
							<div class="clear"></div>
							<div class="ls-sublayer-nav">
								<a href="#" class="active"><?php _e('Content', 'LayerSlider') ?></a>
								<a href="#"><?php _e('Transition', 'LayerSlider') ?></a>
								<a href="#"><?php _e('Link', 'LayerSlider') ?></a>
								<a href="#"><?php _e('Styles', 'LayerSlider') ?></a>
								<a href="#"><?php _e('Attributes', 'LayerSlider') ?></a>
								<a href="#" title="<?php _e('Remove this layer', 'LayerSlider') ?>" class="dashicons dashicons-dismiss remove"></a>
							</div>
							<div class="ls-sublayer-pages">
								<div class="ls-sublayer-page ls-sublayer-basic active">

									<input type="hidden" name="media" value="img">
									<div class="ls-layer-kind">
										<ul>
											<li data-section="img" class="active"><span class="dashicons dashicons-format-image"></span><?php _e('Image', 'LayerSlider') ?></li>
											<li data-section="text"><span class="dashicons dashicons-text"></span><?php _e('Text', 'LayerSlider') ?></li>
											<li data-section="html"><span class="dashicons dashicons-video-alt3"></span><?php _e('HTML / Video / Audio', 'LayerSlider') ?></li>
											<li data-section="post"><span class="dashicons dashicons-admin-post"></span><?php _e('Dynamic content from posts', 'LayerSlider') ?></li>
										</ul>
									</div>
									<!-- End of Layer Media Type -->

									<!-- Layer Element Type -->
									<input type="hidden" name="type" value="p">
									<ul class="ls-sublayer-element ls-hidden">
										<li class="ls-type active" data-element="p"><?php _e('Paragraph', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h1"><?php _e('H1', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h2"><?php _e('H2', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h3"><?php _e('H3', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h4"><?php _e('H4', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h5"><?php _e('H5', 'LayerSlider') ?></li>
										<li class="ls-type" data-element="h6"><?php _e('H6', 'LayerSlider') ?></li>
									</ul>
									<!-- End of Layer Element Type -->

									<div class="ls-layer-sections">

										<!-- Image Layer -->
										<div class="ls-image-uploader slide-image clearfix">
											<input type="hidden" name="imageId">
											<input type="hidden" name="image">
											<div class="ls-image ls-upload <?php echo $uploadClass ?>">
												<div><img src="<?php echo LS_ROOT_URL.'/static/img/not_set.png' ?>" alt=""></div>
												<a href="#" class="dashicons dashicons-dismiss"></a>
											</div>
											<p>
												<?php _e('Click on the image preview to open WordPress Media Library or', 'LayerSlider') ?>
												<a href="#" class="ls-url-prompt"><?php _e('insert from URL', 'LayerSlider') ?></a> or
												<a href="#" class="ls-post-image"><?php _e('use post image', 'LayerSlider') ?></a>.
											</p>
										</div>

										<!-- Text/HTML Layer -->
										<div class="ls-html-code ls-hidden">
											<textarea name="html" cols="50" rows="5" placeholder="Enter layer content here" data-help="<?php _e('Type here the contents of your layer. You can use any HTML codes in this field to insert content others then text. This field is also shortcode-aware, so you can insert content from other plugins as well as video embed codes.', 'LayerSlider') ?>"></textarea>
											<p class="ls-hidden">
												<button type="button" class="button ls-upload ls-insert-media">
													<span class="dashicons dashicons-admin-media"></span>
													<?php _e('Add Media', 'LayerSlider') ?>
												</button>
												<?php _e('Insert self-hosted video or audio', 'LayerSlider') ?>
											</p>
										</div>

										<!-- Dynamic Layer -->
										<div class="ls-post-section ls-hidden">
											<div class="ls-posts-configured">
												<ul class="ls-post-placeholders clearfix">
													<li><span>[post-id]</span></li>
													<li><span>[post-slug]</span></li>
													<li><span>[post-url]</span></li>
													<li><span>[date-published]</span></li>
													<li><span>[date-modified]</span></li>
													<li><span>[image]</span></li>
													<li><span>[image-url]</span></li>
													<li><span>[title]</span></li>
													<li><span>[content]</span></li>
													<li><span>[excerpt]</span></li>
													<li data-placeholder="<a href=&quot;[post-url]&quot;>Read more</a>"><span>[link]</span></li>
													<li><span>[author]</span></li>
													<li><span>[author-id]</span></li>
													<li><span>[categories]</span></li>
													<li><span>[tags]</span></li>
													<li><span>[comments]</span></li>
													<li><span>[meta:&lt;fieldname&gt;]</span></li>
												</ul>
												<p>
													<?php _e("Click on one or more post placeholders to insert them into your layer's content. Post placeholders act like shortcodes in WP, and they will be filled with the actual content from your posts.", "LayerSlider") ?><br>
													<?php _e('Limit text length (if any)', 'LayerSlider') ?>
													<input type="number" name="post_text_length">
													<button type="button" class="button ls-configure-posts"><span class="dashicons dashicons-admin-post"></span><?php _e('Configure post options', 'LayerSlider') ?></button>
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="ls-sublayer-page ls-sublayer-options">
									<input type="hidden" name="transition">
									<table>
										<tbody>
											<tr>
												<td rowspan="3"><?php _e('Transition in', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInDelay']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInDelay'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionInEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionInEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInFade']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['transitionInFade'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['transitionInTransformOrigin']['name'] ?><br>
													<?php lsGetInput($lsDefaults['layers']['transitionInTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>

											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionInScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionInScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td rowspan="3"><?php _e('Transition out', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutOffsetY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutOffsetY'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutDuration']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutDuration'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><?php echo $lsDefaults['layers']['showUntil']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['showUntil'], null, array('class' => 'sublayerprop')) ?> ms</td>
												<td class="right"><a href="http://easings.net/" target="_blank"><?php echo $lsDefaults['layers']['transitionOutEasing']['name'] ?></a></td>
												<td><?php lsGetSelect($lsDefaults['layers']['transitionOutEasing'], null, array('class' => 'sublayerprop', 'options' => $lsDefaults['easings'])) ?></td>
											</tr>
											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutFade']['name'] ?></td>
												<td><?php lsGetCheckbox($lsDefaults['layers']['transitionOutFade'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotate']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotate'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutRotateY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutRotateY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td colspan="2" rowspan="2" class="center">
													<?php echo $lsDefaults['layers']['transitionOutTransformOrigin']['name'] ?><br>
													<?php lsGetInput($lsDefaults['layers']['transitionOutTransformOrigin'], null, array('class' => 'sublayerprop')) ?>
												</td>
											</tr>

											<tr>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewX'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutSkewY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutSkewY'], null, array('class' => 'sublayerprop')) ?> &deg;</td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleX']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleX'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionOutScaleY']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionOutScaleY'], null, array('class' => 'sublayerprop')) ?></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td rowspan="3"><?php _e('Other options', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['transitionParallaxLevel']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['transitionParallaxLevel'], null, array('class' => 'sublayerprop')) ?></td>
												<td class="right"><?php _e('Hidden', 'LayerSlider') ?></td>
												<td><input type="checkbox" name="skip" class="checkbox" data-help="<?php _e("If you don't want to use this layer, but you want to keep it, you can hide it with this switch.", "LayerSlider") ?>"></td>
												<td colspan="6"><button type="button" class="button duplicate" data-help="<?php _e('If you would like to use similar settings for other layers or to experiment on a copy, you can duplicate this layer.', 'LayerSlider') ?>"><?php _e('Duplicate this layer', 'LayerSlider') ?></button></td>
											</tr>
									</table>
								</div>
								<div class="ls-sublayer-page ls-sublayer-link">
									<table>
										<tbody>
											<tr>
												<td>
													<div class="ls-slide-link">
														<?php lsGetInput($lsDefaults['layers']['linkURL'], null, array('placeholder' => $lsDefaults['layers']['linkURL']['name'] )) ?>
														<br> <?php lsGetSelect($lsDefaults['layers']['linkTarget'], null) ?>
														<span> or <a href="#"><?php _e('use post URL', 'LayerSlider') ?></a></span>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="ls-sublayer-page ls-sublayer-style">
									<input type="hidden" name="styles">
									<table>
										<tbody>
											<tr>
												<td><?php _e('Layout & Positions', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['width']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['width'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['height']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['height'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['top']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['top'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['left']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['left'], null) ?></td>
											</tr>
											<tr>
												<td><?php _e('Padding', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingTop']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingTop'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingRight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingRight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingBottom']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingBottom'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['paddingLeft']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['paddingLeft'], null, array('class' => 'auto')) ?></td>
											</tr>
											<tr>
												<td><?php _e('Border', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderTop']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderTop'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderRight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderRight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderBottom']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderBottom'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderLeft']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderLeft'], null, array('class' => 'auto')) ?></td>
											</tr>
											<tr>
												<td><?php _e('Font', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['fontFamily']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['fontFamily'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['fontSize']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['fontSize'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['lineHeight']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['lineHeight'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['color']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['color'], null, array('class' => 'auto ls-colorpicker')) ?></td>
											</tr>
											<tr>
												<td><?php _e('Misc', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['background']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['background'], null, array('class' => 'auto ls-colorpicker')) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['borderRadius']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['borderRadius'], null, array('class' => 'auto')) ?></td>
												<td class="right"><?php _e('Word-wrap', 'LayerSlider') ?></td>
												<td colspan="3"><input type="checkbox" name="wordwrap" data-help="<?php _e('If you use custom sized layers, you have to enable this setting to wrap your text.', 'LayerSlider') ?>" class="checkbox"></td>
											</tr>
											<tr class="ls-separator"><td colspan="11"></td></tr>
											<tr>
												<td><?php _e('Custom CSS', 'LayerSlider') ?></td>
												<td colspan="8"><textarea rows="5" cols="50" name="style" class="style" data-help="<?php _e('If you want to set style settings other then above, you can use here any CSS codes. Please make sure to write valid markup.', 'LayerSlider') ?>"></textarea></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="ls-sublayer-page ls-sublayer-attributes">
									<table>
										<tbody>
											<tr>
												<td><?php _e('Attributes', 'LayerSlider') ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['ID']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['ID'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['class']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['class'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['title']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['title'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['alt']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['alt'], null) ?></td>
												<td class="right"><?php echo $lsDefaults['layers']['rel']['name'] ?></td>
												<td><?php lsGetInput($lsDefaults['layers']['rel'], null) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<a href="#" class="ls-add-sublayer">
			<i class="dashicons dashicons-plus"></i> <?php _e('Add new layer', 'LayerSlider') ?>
		</a>
	</div>
</div>
