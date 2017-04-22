<div class='rd_metabox'>

<?php
$this->h_sidebar();
?>
<?php
$this->select(	'slider_type',
'Page Slider',
array('no' => 'No Slider', 'layer' => 'Revolution Slider', 'layerslider' => 'LayerSlider' ),
''
);
?>

<?php
if(is_plugin_active('revslider/revslider.php')) {
$slider = new RevSlider();
$arrSliders = $slider->getArrSlidersShort();
$arrSliders[0] = 'Select a slider';
$this->select(	'slider',
'Select Revolution Slider',
$arrSliders,
''
);
}
?>
<?php

if(is_plugin_active('LayerSlider/layerslider.php')) {
		global $wpdb;
		$slides_array[0] = 'Select a slider';
		// Table name
		$table_name = $wpdb->prefix . "layerslider";

		// Get sliders
		$sliders = $wpdb->get_results( "SELECT * FROM $table_name
											WHERE flag_hidden = '0' AND flag_deleted = '0'
											ORDER BY date_c ASC" );

		if(!empty($sliders)):
		foreach($sliders as $key => $item):
			$slides[$item->id] = '';
		endforeach;
		endif;

		if(isset($slides) && $slides){
		foreach($slides as $key => $val){
			$slides_array[$key] = 'LayerSlider #'.($key);
		}
		}
		$this->select(	'layerslider',
						'Select LayerSlider',
						$slides_array,
						''
					);
}
?>

<?php
$this->select(	'slider_position',
				'Slider Position',
				array('under' => 'Under The Header','above' => 'Above The Header'),
				''
);
?>

<?php
$this->select(	'top_bar',
				'Hide Header Top Bar?',
				array('no' => 'No', 'yes' => 'Yes', ),
				''
);
?>
<?php
$this->select(	'header_transparent',
				'Transparent header?',
				array('no' => 'No', 'yes' => 'Yes', ),
				''
);
?>

<?php
$this->select(	'title',
				'Show title?',
				array('yes' => 'Yes', 'no' => 'No'),
				''
);
?>

<?php
$this->text(	'title_height',
'Title height (example 100)'
);
?>



<?php
$this->color(	'title_color',
				'Select title color'
);
?>



<?php
$this->color(	'titlebg_color',
				'Select title background color'
);
?>


<?php
$this->upload(	'ctbg',
'Custom title background'
);
?>

<?php
$this->select(	'bc',
				'Show Breadcrumbs?',
				array('yes' => 'Yes', 'no' => 'No'),
				''
);
?>


<?php
$this->select(	'generated_section',
				'Show Automatically generated content?',
				array('yes' => 'Yes', 'no' => 'No'),
				''
);
?>


<?php
$this->text(	'position',
				'Staff Member Position'
			);
?>
<?php
$this->textarea(	'small_desc',
				'Staff Member Description ( this is the text that will show up in the auto generated section and in shortcodes )'
			);
?>

<?php
$this->text(	'real_name',
				'Staff Member real name'
			);
?>

<?php
$this->text(	'member_url',
				'Staff Member website url ( use http:// )'
			);
?>

<?php
$this->text(	'mail',
				'Staff Member mail adress'
			);
?>

<?php
$this->text(	'phone',
				'Staff Member phone number'
			);
?>

<?php
$this->text(	'skills',
				'Staff Member skills'
			);
?>

<?php
$this->text(	'facebook',
				'Staff Member Facebook id'
			);
?>

<?php
$this->text(	'twitter',
				'Staff Member Twitter id'
			);

?>

<?php
$this->text(	'linkedin',
				'Staff Member linkedin link'
			);

?>

<?php
$this->text(	'tumblr',
				'Staff Member tumblr link'
			);
?>

<?php
$this->text(	'skype',
				'Staff Member Skype link'
			);
?>

<?php
$this->text(	'blogger',
				'Staff Member Blogger link'
			);
?>

<?php
$this->text(	'vimeo',
				'Staff Member Vimeo link'
			);
?>

<?php
$this->text(	'youtube',
				'Staff Member Youtube link'
			);

?>

<?php
$this->text(	'dribbble',
				'Staff Member Dribbble link'
			);
?>

<?php
$this->text(	'deviantart',
				'Staff Member Deviant art link'
			);
?>

<?php
$this->text(	'reddit',
				'Staff Member Reddit link'
			);
?>

<?php
$this->text(	'behance',
				'Staff Member Behance link'
			);
?>

<?php
$this->text(	'digg',
				'Staff Member Digg link'
			);
?>

<?php
$this->text(	'flickr',
				'Staff Member flickr link'
			);
?>

<?php
$this->text(	'instagram',
				'Staff Member instagram link'
			);
?>

<?php
$this->text(	'gplus',
				'Staff Member google plus link'
			);
?>



</div>