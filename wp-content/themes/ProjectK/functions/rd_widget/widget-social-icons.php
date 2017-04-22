<?php

/*-----------------------------------------------------------------------------------
	Plugin Name: Social Icon Widget
	Description: A widget that allows the display of text and social icon.

-----------------------------------------------------------------------------------*/
// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'rd_social_widgets' );
// Register widget.
function rd_social_widgets() {
	register_widget( 'RD_Social_Widget' );
}
// Widget class.
class rd_social_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function RD_Social_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'rd_social_widget', 'description' => __('A widget that displays your Social Icon and text (optional).', 'thefoxwp') );
		/* Widget control settings. */

		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rd_social_widget' );

		/* Create the widget. */

		$this->WP_Widget( 'rd_social_widget', __('TheFox Social Icons Widget', 'thefoxwp'), $widget_ops, $control_ops );

	}
	
	

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		global $rd_data;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$text = apply_filters('widget_text', $instance['text'] );
		/* Our variables from the widget settings. */
		/* Before widget (defined by themes). */
		echo !empty( $before_widget ) ? $before_widget : '';
		/* Display Widget */
		?>
<?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo !empty( $before_title ) ? $before_title : '';
					echo !empty( $title ) ? $title : '';
					echo !empty( $after_title ) ? $after_title : '';
				
				$content = "<div class='thefox_social_widget'>";
				if($text !== ''){
				$content .= "<div class='thefox_social_widget_text'>";
				$content .= !empty( $instance['filter'] ) ? wpautop( $text ) : $text;
				$content .= "</div>";
				}
				echo do_shortcode( $content );
				
				echo "<div class='thefox_social_widget_icons clearfix'>";
				echo rd_social_icon()."</div></div>";	


		/* After widget (defined by themes). */

		echo !empty( $after_widget ) ? $after_widget : '';

	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		/* No need to strip tags for.. */
		return $instance;
	}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/


	function form( $instance ) {
		/* Set up some default widget settings. */

		$defaults = array(
		'title' => 'Social Icons',
		'text' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
				$text = esc_textarea($instance['text']); ?>
        
<!-- Widget Title: Text Input -->
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
    <?php _e('Title:', 'thefoxwp') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
<!-- Widget Title: Text Input -->
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>">
    <?php _e('Text (optional):', 'thefoxwp') ?>
  </label>
<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo !empty( $text ) ? $text : ''; ?></textarea>
</p>
<p>
	<input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php _e('Automatically add paragraphs','thefoxwp'); ?></label></p>

<?php

	}
}

?>
