<div class='rd_metabox'>
<?php
$this->select(	'slider_type',
'Page Slider',
array('no' => "Don't Use Slider", 'layer' => 'Revolution Slider' ),
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
$this->select(	'slider_position',
				'Slider Position',
				array('under' => 'Under The Header','above' => 'Above The Header'),
				''
);
?>
<?php
$this->h_sidebar();
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
$this->select(	'thumb',
				'Select Thumbnail size for Random Layout Portfolio',
				array('portfolio_small_squared' => 'Small Squared','portfolio_squared' => 'Big Squared', 'portfolio_landscape' => 'Landscape', 'portfolio_portrait' => 'Portrait'),
				''
);
?>

<?php
$this->select(	'width',
				'Project layout',
				array('full' => 'Full Width', 'half' => 'Half Width', 'page' => 'Page'),
				''
);
?>

<?php
$this->text(	'subtitle',
				'Project Subtitle'
);
?>
<?php
$this->text(	'client',
				'Client name'
);
?>

<?php
$this->text(	'p_url',
				'Project url'
);
?>

<?php
$this->select(	'share_buttons',
				'Show Share buttons',
				array('yes' => 'Yes', 'no' => 'No'),
				''
);
?>
<?php
$this->select(	'author_bio',
				'Show Author biography?',
				array('yes' => 'Yes', 'no' => 'No'),
				''
);
?>
<?php
$this->select(	'related_post',
				'Show Related post?',
				array('yes' => 'Yes', 'no' => 'No'),
				''
			);
?>

<?php
$this->textarea(	'video',
				'Video Embed Code'
);
?>

</div>