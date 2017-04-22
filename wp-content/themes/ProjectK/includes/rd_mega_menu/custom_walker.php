<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class rd_megamenu_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
      {
           global $wp_query;
		   global $rd_data;
		   $h_style = $rd_data['rd_nav_type'];
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		   $heading = '';
		   $widget = '';
           $class_names = $value = '';
		   
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;	   
		      
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		if($h_style == 'style 1'){
			
$megamenu = ! empty( $item->megamenu )     ? 'rd_megamenu h1_mega mega-col-' . esc_attr( $item->megamenu_col     ) .'' : '';
		}elseif($h_style == 'nav_type_19' || $h_style == 'nav_type_19_f' ){
			$megamenu = "";
		}else{
		   $megamenu = ! empty( $item->megamenu )     ? 'rd_megamenu mega-col-' . esc_attr( $item->megamenu_col     ) .'' : '';
		}
		if( !empty  ( $item->megamenu_heading )){
           $heading = 'mega_no_heading';  
		}
	   if( $item->megamenu_widgetarea && is_active_sidebar( $item->megamenu_widgetarea )){
		   $widget = 'mm_widget_area';
		
		}
           $class_names = ' class="'. $megamenu .' '. $heading .' '. $widget .' '. esc_attr( $class_names ).' "';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
	           $description = $append = $prepend = "";
           }
		   
			if( !empty  ( $item->menu_icon )){
				$prepend .= '<span class="' . esc_attr( $item->menu_icon ) .' rd_menu_icon"></span>';
				
			}
		
		   $item_output = '';
		   if( $item->megamenu_widgetarea &&
					is_active_sidebar( $item->megamenu_widgetarea )
				) {
					$item_output .= '<div class="rd_megamenu_widget_area">';
					ob_start();
						dynamic_sidebar( $item->megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}else{
	   
		   if(isset($args->before)){
            
            $item_output = $args->before; 
		   }
            $item_output .= '<a'. $attributes .'>';
			if(isset($args->link_before)){
            $item_output .= $args->link_before.$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			}

			if(isset($args->link_after)){
            $item_output .= $description.$args->link_after;
		   }
		   
            $item_output .= '</a>';
				

		   if(isset($args->before)){
            $item_output .= $args->after;
		   }
		   
	  }
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
            }
}