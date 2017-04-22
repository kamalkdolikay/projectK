<?php

/*-----------------------------------------------------------------------------------

Plugin Name: Custom Portfolio Widget

Description: A widget that allows the display of your recent projects.

-----------------------------------------------------------------------------------*/

// Add function to widgets_init

add_action( 'widgets_init', 'rd_portfolio_widgets' );

// Register widget

function rd_portfolio_widgets() {

register_widget( 'RD_Portfolio_Widget' );

}

// Widget class

class rd_portfolio_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/

/*	Widget Setup

/*-----------------------------------------------------------------------------------*/

function RD_Portfolio_Widget() {

/* Widget settings. */

$widget_ops = array( 'classname' => 'rd_portfolio_widget', 'description' => __('A widget that displays your latest projects in a carousel.', 'thefoxwp') );

/* Widget control settings. */

$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rd_portfolio_widget' );

/* Create the widget. */

$this->WP_Widget( 'rd_portfolio_widget', __('Carousel Recent Portfolio Widget', 'thefoxwp'), $widget_ops, $control_ops );

}

/*-----------------------------------------------------------------------------------*/

/*	Display Widget

/*-----------------------------------------------------------------------------------*/

function widget( $args, $instance ) {

extract( $args );

$title = apply_filters('widget_title', $instance['title'] );

/* Our variables from the widget settings. */

$number = $instance['number'];


/* Before widget (defined by themes). */

echo !empty( $before_widget ) ? $before_widget : '';

/* Display Widget */

?>
<?php /* Display the widget title if one was input (before and after defined by themes). */

if ( $title )

echo !empty( $before_title ) ? $before_title : '';
echo !empty( $title ) ? $title : '';
echo !empty( $after_title ) ? $after_title : '';

	$content = "<div class='sidebarcarousel'>[recent_port_sc posts_per_line='1' to_show='".$number."' category='all'][/recent_port_sc]</div>";
				
				echo do_shortcode( $content );

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

$instance['number'] = strip_tags( $new_instance['number'] );


/* No need to strip tags for.. */

return $instance;

}

/*-----------------------------------------------------------------------------------*/

/*	Widget Settings

/*-----------------------------------------------------------------------------------*/

function form( $instance ) {

/* Set up some default widget settings. */

$defaults = array(

'title' => 'Latest Projects.',

'number' => 4,


);

$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title: Text Input -->

<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
    <?php _e('Title:', 'thefoxwp') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<!-- Number of post to show : Text Input -->

<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
    <?php _e('Amount to show:', 'thefoxwp') ?>
  </label>
  <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
</p>


<?php

}

}

?>
