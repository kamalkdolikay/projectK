<?php
class RDFrameworkMetaboxes {

	

	public function __construct()

	{

		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

		add_action('save_post', array($this, 'save_meta_boxes'));

		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));

	}
	// Load backend scripts

	function admin_script_loader() {

	global $pagenow;

		if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')) {

	    	wp_register_script('rd_upload', get_template_directory_uri('template_directory').'/js/upload.js');

	    	wp_enqueue_script('rd_upload');

	    	wp_enqueue_script('media-upload');

	    	wp_enqueue_script('thickbox');

	   		wp_enqueue_style('thickbox');
	wp_enqueue_style('color-picker', ADMIN_DIR . 'assets/css/colorpicker.css');
				wp_enqueue_script('jquery-ui-core');

	wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
		wp_enqueue_script('meta-colorpicker', ADMIN_DIR .'assets/js/meta-color.js', array('jquery'));
	
		}

	}

	

	public function add_meta_boxes()

	{

		$this->add_meta_box('post_options', 'Post Options', 'post', 'normal', 'default');

		$this->add_meta_box('page_options', 'Page Options', 'page', 'normal', 'default');

		$this->add_meta_box('sponsors_options', 'Partners Options', 'partners', 'normal', 'default');

		$this->add_meta_box('portfolio_options', 'Portfolio Options', 'portfolio', 'normal', 'default');

		$this->add_meta_box('staff_options', 'Staff Member Options', 'staff', 'normal', 'default');
		
		$this->add_meta_box('woo_options', 'Product hover effect', 'product', 'side', 'low');

	}

	

	public function add_meta_box($id, $label, $post_type, $context, $priority)

	{

	    add_meta_box( 

	        'rd_' . $id,

	        $label,

	        array($this, $id),

	        $post_type,
			
			
			$context,
			
			$priority

	    );

	}

	

	public function save_meta_boxes($post_id)

	{

		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {

			return;

		}

		

		foreach($_POST as $key => $value) {

			if(strstr($key, 'rd_')) {

				update_post_meta($post_id, $key, $value);

			}

		}

	}

	

	public function sponsors_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/sponsors_options.php';

	}

	

	public function post_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/post_options.php';

	}
	public function page_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/page_options.php';

	}
	public function portfolio_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/portfolio_options.php';

	}

	

		public function staff_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/staff_options.php';

	}

	

		public function woo_options()

	{	

		include 'views/metaboxes/style.php';

		include 'views/metaboxes/woo_options.php';

	}

	

	public function text($id, $label, $desc = '')

	{

		global $post;

		

		$html = '';

		$html .= '<div class="rd_metabox_field">';

			$html .= '<label for="rd_' . $id . '">';

			$html .= $label;

			$html .= '</label>';

			$html .= '<div class="field">';

				$html .= '<input type="text" id="rd_' . $id . '" name="rd_' . $id . '" value="' . get_post_meta($post->ID, 'rd_' . $id, true) . '" />';

				if($desc) {

					$html .= '<p>' . $desc . '</p>';

				}

			$html .= '</div>';

		$html .= '</div>';

		

		echo !empty( $html ) ? $html : '';

	}

	

	public function select($id, $label, $options, $desc = '')

	{

		global $post;

		

		$html = '';

		$html .= '<div class="rd_metabox_field">';

			$html .= '<label for="rd_' . $id . '">';

			$html .= $label;

			$html .= '</label>';

			$html .= '<div class="field">';

				$html .= '<select id="rd_' . $id . '" name="rd_' . $id . '">';

				foreach($options as $key => $option) {

					if(get_post_meta($post->ID, 'rd_' . $id, true) == $key) {

						$selected = 'selected="selected"';

					} else {

						$selected = '';

					}

					

					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';

				}

				$html .= '</select>';

				if($desc) {

					$html .= '<p>' . $desc . '</p>';

				}

			$html .= '</div>';

		$html .= '</div>';

		

		echo !empty( $html ) ? $html : '';

	}
	public function textarea($id, $label, $desc = '')

	{

		global $post;
		$html = '';

		$html = '';

		$html .= '<div class="rd_metabox_field">';

			$html .= '<label for="rd_' . $id . '">';

			$html .= $label;

			$html .= '</label>';

			$html .= '<div class="field">';

				$html .= '<textarea cols="120" rows="10" id="rd_' . $id . '" name="rd_' . $id . '">' . get_post_meta($post->ID, 'rd_' . $id, true) . '</textarea>';

				if($desc) {

					$html .= '<p>' . $desc . '</p>';

				}

			$html .= '</div>';

		$html .= '</div>';

		

		echo !empty( $html ) ? $html : '';

	}
	public function upload($id, $label, $desc = '')

	{

		global $post;
		$html = '';

		$html = '';

		$html .= '<div class="rd_metabox_field">';

			$html .= '<label for="rd_' . $id . '">';

			$html .= $label;

			$html .= '</label>';

			$html .= '<div class="field">';

			    $html .= '<input name="rd_' . $id . '" class="upload_field" id="rd_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'rd_' . $id, true) . '" />';

			    $html .= '<input class="upload_button" type="button" value="Browse" />';

				if($desc) {

					$html .= '<p>' . $desc . '</p>';

				}

			$html .= '</div>';

		$html .= '</div>';

		

		echo !empty( $html ) ? $html : '';

	}
	
	
	
	public function color($id, $label, $desc = '')

	{

		global $post;
		$html = '';

		$html = '';

		$html .= '<div class="rd_metabox_field">';

			$html .= '<label for="rd_' . $id . '">';

			$html .= $label;

			$html .= '</label>';

			$html .= '<div class="field">';

			    $html .= '<div id="' . $id . '_picker" class="colorSelector"><div style="background-color:' . get_post_meta($post->ID, 'rd_' . $id, true) . '" ></div></div><input type="text" id="rd_' . $id . '" name="rd_' . $id . '" value="' . get_post_meta($post->ID, 'rd_' . $id, true) . '" /></div>';

			   if($desc) {

					$html .= '<p>' . $desc . '</p>';

				}

			$html .= '</div>';

		

		echo !empty( $html ) ? $html : '';

	}

	

	public function h_sidebar()

	{

		global $post;

		$html = '<style>.us_box_ctn {display:none;}</style>';

		echo !empty( $html ) ? $html : '';

	}
}
$metaboxes = new RDFrameworkMetaboxes;