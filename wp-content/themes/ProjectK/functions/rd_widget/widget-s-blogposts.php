<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Custom Blog Widget

	Description: A widget that allows the display of blog posts.

-----------------------------------------------------------------------------------*/


add_action( 'widgets_init', 'rd_s_blog_widgets' );

function rd_s_blog_widgets() {
	register_widget( 'rd_s_Blog_Widget' );
}

class rd_s_blog_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/


function rd_s_Blog_Widget() {
		$widget_ops = array( 'classname' => 'rd_s_blog_widget', 'description' => __('Sidebar or Footer widget that displays your latest posts with a thumbnail and a short excerpt.', 'thefoxwp') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rd_s_blog_widget' );
		$this->WP_Widget( 'rd_s_blog_widget', __('TheFox Recent Posts Widget (Sidebar)', 'thefoxwp'), $widget_ops, $control_ops );
}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/


function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		echo !empty( $before_widget ) ? $before_widget : '';
		
		?> 
	    <?php 
				if ( $title )
				echo !empty( $before_title ) ? $before_title : '';
echo !empty( $title ) ? $title : '';
echo !empty( $after_title ) ? $after_title : '';
				?>          
                <ul class="rd_widget_recent_entries">
  					<?php 
                    $query = new WP_Query();
                    $query->query( array(
                        'posts_per_page' => $number,
                        'ignore_sticky_posts' => 1,
                        ));
                    ?>
                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li>                        
                    <?php
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
					<div class="thumbnail">
					<a title="<?php get_the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(200,160) );?></a>
					</div>

					<?php }else{ ?>
					<div class="thumbnail">
					</div>

					<?php } ?>
					<div class="widget_recent_entry">
                    <div class="w_date"><?php the_time('j F, Y') ?></div><div class="w_comment"><?php comments_popup_link(__('0','thefoxwp'),__('1','thefoxwp'),__('%','thefoxwp'),'comments-link'); ?></div>	             			
					<h4>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php get_the_title(); ?>"> 
					<?php the_title(); ?>
					</a>
					</h4>
                    </div>
	                </li>
                    <?php endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
		<?php
		echo !empty( $after_widget ) ? $after_widget : '';
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/

	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Posts',
		'number' => 4
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'thefoxwp') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e('Amount to show:', 'thefoxwp') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>

	<?php


	}


}



add_action( 'widgets_init', 'rd_f_blog_widgets' );

function rd_f_blog_widgets() {
	register_widget( 'rd_f_Blog_Widget' );
}

class rd_f_blog_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/


function rd_f_Blog_Widget() {
		$widget_ops = array( 'classname' => 'rd_f_blog_widget', 'description' => __('Footer widget that displays your latest posts with a thumbnail and a short excerpt.', 'thefoxwp') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rd_f_blog_widget' );
		$this->WP_Widget( 'rd_f_blog_widget', __('TheFox Recent Posts Widget (Footer)', 'thefoxwp'), $widget_ops, $control_ops );
}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/


function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];
		echo !empty( $before_widget ) ? $before_widget : '';
		
		?> 
	    <?php 
				if ( $title )
				echo !empty( $before_title ) ? $before_title : '';
echo !empty( $title ) ? $title : '';
echo !empty( $after_title ) ? $after_title : '';
				?>          
                <ul class="rd_widget_recent_entries_f">
  					<?php 
                    $query = new WP_Query();
                    $query->query( array(
                        'posts_per_page' => $number,
                        'ignore_sticky_posts' => 1,
                        ));
                    ?>
                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <li>                        
                    <?php
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
					<div class="thumbnail">
					<a title="<?php get_the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(  'staff_tn' );?></a>
					</div>

					<?php }else{ ?>
					<div class="thumbnail">
					</div>

					<?php } ?>
					<div class="widget_recent_entry">
					<h4>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php get_the_title(); ?>"> 
					<?php the_title(); ?>
					</a>
					</h4>
                    <div class="w_excerpt"><?php  rd_custom_excerpt('rd_widget_excerpt','rd_port_more'); ?></div>
                    <div class="w_date"><?php the_time('j F, Y') ?></div>	             			
                    </div>
	                </li>
                    <?php endwhile; endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
		<?php
		echo !empty( $after_widget ) ? $after_widget : '';
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/

	function form( $instance ) {
		$defaults = array(
		'title' => 'Recent Posts',
		'number' => 4
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'thefoxwp') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e('Amount to show:', 'thefoxwp') ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>

	<?php


	}


}


?>