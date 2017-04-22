<?php

global $rd_data;


// Redefine rd_woocommerce_output_related_products()


function rd_woocommerce_output_related_products() {
	$args = array(12,1);
woocommerce_related_products($args); // Display 12 products in rows of 1
}


if (get_option( 'woo_first_activation' ) == false ){ 
add_option( 'woo_first_activation', 'hotcake', '', 'no' ); 
}

if ( rd_check_woo_status() == true && get_option( 'woo_first_activation' ) !== 'activated' ) add_action( 'init', 'rd_woocommerce_defaults', 1 );
 
/**
 * Define image sizes
 */
function rd_woocommerce_defaults() {
  	$catalog = array(
		'width' 	=> '535',	// px
		'height'	=> '696',	// px
		'crop'		=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '535',	// px
		'height'	=> '950',	// px
		'crop'		=> 0 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '165',	// px
		'height'	=> '165',	// px
		'crop'		=> 1 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	update_option('woocommerce_frontend_css' , false);
	update_option('woocommerce_enable_lightbox' , false);
	update_option('woocommerce_single_image_crop', 'no'); 
	
	update_option('woo_first_activation', 'activated' ); 

	
}


//Change checkout coupon position
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'rd_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//Change rating position


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

		
		
//Change Wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//Remove Breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
 
//Get Rid of Stupid Tabs


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); 



//Remove Product Reviews
 
//Remove Sidebar from WooCommerce
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			
		
		
// Set the shop layout

add_filter('loop_shop_columns', 'rd_wc_product_columns_frontend');
	function rd_wc_product_columns_frontend() {
    	global $woocommerce;
 		global $rd_data;
        	    // Default Value also used for categories and sub_categories
                $columns = $rd_data['rd_shop_columns'];
 
                // Product List
                if ( is_product_category() ) :
                    $columns = $rd_data['rd_shop_columns'];
                endif;
 
                //Related Products
                if ( is_product() ) :
                    $columns = $rd_data['rd_shop_columns'];
                endif;
 
                //Cross Sells
                if ( is_checkout() ) :
                    $columns = $rd_data['rd_shop_columns'];
                endif;
 
		return $columns;
 
 
            }


// Set the number of item to show per page


add_filter( 'loop_shop_per_page', 'rd_wc_product_perpage');

	function rd_wc_product_perpage() {
		global $rd_data;
		if(!isset($rd_data["rd_newshop_item_per_page"])){
		$rd_data["rd_newshop_item_per_page"] = $rd_data["rd_shop_item_per_page"];
		return $rd_data["rd_newshop_item_per_page"];
		}
		else{
			return $rd_data["rd_newshop_item_per_page"];
		}


	}





#
# add ajax cart / options buttons to the product
#

add_action( 'woocommerce_after_shop_loop_item', 'rd_add_cart_button', 16);
function rd_add_cart_button()
{
	global $product, $rd_config;

	if ($product->product_type == 'bundle' ){
		$product = new WC_Product_Bundle($product->id);
	}

	$extraClass  = "";

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$output = ob_get_clean();

	if(!empty($output))
	{
		$pos = strpos($output, ">");

		if ($pos !== false) {
		    $output = substr_replace($output,"> ", $pos , strlen(1));
		}
	}


	if($product->product_type == 'variable' && empty($output))
	{
		$output = '<a class="add_to_cart_button button product_type_variable" href="'.get_permalink($product->id).'"> '.__("Select options","rd_framework").'</a>';
	}

	if(in_array($product->product_type, array('subscription', 'simple', 'bundle')))
	{
		$output .= '<a class="button show_details_button" href="'.get_permalink($product->id).'">  '.__("Show Details","rd_framework").'</a>';
	}
	if (!$product->is_in_stock()) {
		
	$output =  '<a href="'.get_permalink().'" rel="nofollow" class="button add_to_cart_button more_info_button out_stock_button"> '.__("Out of Stock","rd_framework").'</a>';
	}
	else
	{
		$extraClass  = "single_button";
	}

	if(empty($extraClass)) $output .= " <span class='button-mini-delimiter'></span>";


	if($output && !post_password_required()) echo "<div class='custom_cart_button $extraClass'>$output</div>";
}





#
# wrap products on overview pages into an extra div for improved styling options. adds "product_on_sale" class if prodct is on sale
#

add_action( 'woocommerce_before_shop_loop_item', 'rd_shop_overview_extra_div', 5);
function rd_shop_overview_extra_div()
{
	global $product;
	$product_class = $product->is_on_sale() ? "product_on_sale" : "";

	echo "<div class='inner_product $product_class'>";
}

add_action( 'woocommerce_after_shop_loop_item',  'rd_close_div', 1000);
function rd_close_div()
{
	echo "</div>";
}


#
# wrap product titles and sale number on overview pages into an extra div for improved styling options
#

add_action( 'woocommerce_before_shop_loop_item_title', 'rd_shop_overview_extra_header_div', 20);
function rd_shop_overview_extra_header_div()
{
	echo "<div class='product_box'>";
}

add_action( 'woocommerce_after_shop_loop_item_title',  'rd_close_div', 1000);


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 19);




function rd_woo_thumbnail($asdf)
{
	global $product;
	$rating = $product->get_rating_html(); //get rating
	
	$id = get_the_ID();
	$size = 'shop_catalog';
	
	echo "<div class='thumbnail_container'>";
	echo rd_woo_gallery_first_thumb( $id , $size);
	echo get_the_post_thumbnail( $id , $size );
	if($product->product_type == 'simple') echo "<div class='item_current_status'><i class='icon_status_inner'></i></div>";
	echo "</div>";
}


function rd_woo_gallery_first_thumb($id, $size)
{
	$active_hover = get_post_meta( $id, 'rd_product_hover', true );

	if($active_hover == 'yes')
	{
		$product_gallery = get_post_meta( $id, '_product_image_gallery', true );
		
		if(!empty($product_gallery))
		{
			$gallery	= explode(',',$product_gallery);
			$image_id 	= $gallery[0];
			$image 		= wp_get_attachment_image( $image_id, $size, false, array( 'class' => "attachment-$size woo_product_hover" ));
			
			if(!empty($image)) return $image;
		}
	}
}


add_action( 'woocommerce_before_shop_loop_item_title', 'rd_woo_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);





//Header dropdown

add_filter('add_to_cart_fragments', 'rd_woocommerce_header_add_to_cart_fragment');
 
function rd_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
<a class="cart-content" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" ></a>
  <?php

	
	$fragments['a.cart-content'] = ob_get_clean();
	
	return $fragments;
	
	
}


add_filter('add_to_cart_fragments', 'rd_woocommerce_header_dropdown_cart_fragment');
 
function rd_woocommerce_header_dropdown_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();?>
  <div class="current_item_number"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div>
  <?php $fragments['div.current_item_number'] = ob_get_clean();
	
	return $fragments;
	
}


remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); /*remove woocommerce ordering dropdown*/



#
# displays a front end interface for modifying the shoplist query parameters like sorting order, product count etc
#
if(!function_exists('rd_woocommerce_frontend_search_params'))
{
	add_action( 'woocommerce_before_shop_loop', 'rd_woocommerce_frontend_search_params', 20);

	function rd_woocommerce_frontend_search_params()
	{

		global $rd_config;
		global $rd_data;
		$product_order['default'] 	= __("Default Order",'rd_framework');
		$product_order['title'] 	= __("Name",'rd_framework');
		$product_order['price'] 	= __("Price",'rd_framework');
		$product_order['date'] 		= __("Date",'rd_framework');
		$product_order['popularity'] = __("Popularity",'rd_framework');

		$product_sort['asc'] 		= __("Click to order products ascending",  'rd_framework');
		$product_sort['desc'] 		= __("Click to order products descending",  'rd_framework');

		$per_page_string 		 	= __("Products per page",'rd_framework');

	
		$per_page = $rd_data["rd_shop_item_per_page"];		

		parse_str($_SERVER['QUERY_STRING'], $params);

		$po_key = !empty($rd_config['woocommerce']['product_order']) ? $rd_config['woocommerce']['product_order'] : 'default';
		$ps_key = !empty($rd_config['woocommerce']['product_sort'])  ? $rd_config['woocommerce']['product_sort'] : 'asc';
		$pc_key = !empty($rd_config['woocommerce']['product_count']) ? $rd_config['woocommerce']['product_count'] : $per_page;

		$ps_key = strtolower($ps_key);

		//generate markup
		$output  = "";
		$output .= "<div class='product_filtering clearfix'>";
		$output .= "    <ul class='filter_param filter_param_order' onclick=''>";
		$output .= "    	<li><span class='current_li'>".__("Sort by:",'rd_framework')." <strong>".$product_order[$po_key]."</strong></span>";
		$output .= "    	<ul>";
		$output .= "    	<li".rd_woo_active_class($po_key, 'default')."><a href='".rd_woo_build_query_string($params, 'product_order', 'default')."'>	".$product_order['default']."</a></li>";
		$output .= "    	<li".rd_woo_active_class($po_key, 'title')."><a href='".rd_woo_build_query_string($params, 'product_order', 'title')."'>	".$product_order['title']."</a></li>";
		$output .= "    	<li".rd_woo_active_class($po_key, 'price')."><a href='".rd_woo_build_query_string($params, 'product_order', 'price')."'>	".$product_order['price']."</a></li>";
		$output .= "    	<li".rd_woo_active_class($po_key, 'date')."><a href='".rd_woo_build_query_string($params, 'product_order', 'date')."'>	".$product_order['date']."</a></li>";
		$output .= "    	<li".rd_woo_active_class($po_key, 'popularity')."><a href='".rd_woo_build_query_string($params, 'product_order', 'popularity')."'>	".$product_order['popularity']."</a></li>";
		$output .= "    	</ul>";
		$output .= "    	</li>";
		$output .= "    </ul>";

		$output .= "    <ul class='filter_param filter_param_sort' onclick=''>";
		$output .= "    	<li>";
		if($ps_key == 'desc') 	$output .= "    		<a title='".$product_sort['asc']."' class='filter_param_asc fa-arrow-down'  href='".rd_woo_build_query_string($params, 'product_sort', 'asc')."'></a>";
		if($ps_key == 'asc') 	$output .= "    		<a title='".$product_sort['desc']."' class='filter_param_desc fa-arrow-up' href='".rd_woo_build_query_string($params, 'product_sort', 'desc')."'></a>";
		$output .= "    	</li>";
		$output .= "    </ul>";
 
		$output .= "    <ul class='filter_param filter_param_count' onclick=''>";
		$output .= "    	<li><span class='current_li'>".__("Show:",'rd_framework')." <strong>".$pc_key." ".$per_page_string."</strong></span>";
		$output .= "    	<ul>";
		$output .= "    	<li".rd_woo_active_class($pc_key, $per_page).">  <a href='".rd_woo_build_query_string($params, 'product_count', $per_page)."'>		".$per_page." ".$per_page_string."</a></li>";
		$output .= "    	<li".rd_woo_active_class($pc_key, $per_page*2)."><a href='".rd_woo_build_query_string($params, 'product_count', $per_page * 2)."'>	".($per_page * 2)." ".$per_page_string."</a></li>";
		$output .= "    	<li".rd_woo_active_class($pc_key, $per_page*3)."><a href='".rd_woo_build_query_string($params, 'product_count', $per_page * 3)."'>	".($per_page * 3)." ".$per_page_string."</a></li>";
		$output .= "    	</ul>";
		$output .= "    	</li>";
		$output .= "	</ul>";



		$output .= "</div>";
		echo !empty( $output ) ? $output : '';
	}
}

//helper function to create the active list class
if(!function_exists('rd_woo_active_class'))
{
	function rd_woo_active_class($key1, $key2)
	{
		if($key1 == $key2) return " class='current_option'";
	}
}

//add custom search form

add_filter( 'get_product_search_form' , 'rd_woo_custom_product_searchform' );
 

function rd_woo_custom_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'thefoxwp' ) . '</label>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'thefoxwp' ) . '" />
			<input type="submit" id="searchsubmit" value="" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	
	return $form;
	
}


//helper function to build the query strings for the catalog ordering menu
if(!function_exists('rd_woo_build_query_string'))
{
	function rd_woo_build_query_string($params = array(), $overwrite_key, $overwrite_value)
	{
		$params[$overwrite_key] = $overwrite_value;
		return "?". http_build_query($params);
	}
}

//function that actually overwrites the query parameters
if(!function_exists('rd_woocommerce_overwrite_catalog_ordering'))
{
	add_action( 'woocommerce_get_catalog_ordering_args', 'rd_woocommerce_overwrite_catalog_ordering', 20);

	function rd_woocommerce_overwrite_catalog_ordering($args)
	{
		global $rd_config;
		global $rd_data;
		
		if(!empty($rd_config['woocommerce']['disable_sorting_options'])) return $args;

		//check the folllowing get parameters and session vars. if they are set overwrite the defaults
		$check = array('product_order', 'product_count', 'product_sort');
		if(empty($rd_config['woocommerce'])) $rd_config['woocommerce'] = array();
	
		foreach($check as $key)
		{
			if(isset($_GET[$key]) ) $_SESSION['rd_woocommerce'][$key] = esc_attr($_GET[$key]);
			if(isset($_SESSION['rd_woocommerce'][$key]) ) $rd_config['woocommerce'][$key] = $_SESSION['rd_woocommerce'][$key];
		}
		
		
		// is user wants to use new product order remove the old sorting parameter
		if(isset($_GET['product_order']) && !isset($_GET['product_sort']) && isset($_SESSION['rd_woocommerce']['product_sort']))
		{
			unset($_SESSION['rd_woocommerce']['product_sort'], $rd_config['woocommerce']['product_sort']);
		}

		extract($rd_config['woocommerce']);

		// set the product order
		if(!empty($product_order))
		{
			switch ( $product_order ) {
				case 'date'  : $orderby = 'date'; $order = 'desc'; $meta_key = '';  break;
				case 'price' : $orderby = 'meta_value_num'; $order = 'asc'; $meta_key = '_price'; break;
				case 'popularity' : $orderby = 'meta_value_num'; $order = 'desc'; $meta_key = 'total_sales'; break;
				case 'title' : $orderby = 'title'; $order = 'asc'; $meta_key = ''; break;
				case 'default':
				default : $orderby = 'menu_order title'; $order = 'asc'; $meta_key = ''; break;
			}
		}

		// set the product count
		if(!empty($product_count) && is_numeric($product_count))
		{
			$rd_data["rd_newshop_item_per_page"] = (int) $product_count;
		}

		//set the product sorting
		if(!empty($product_sort))
		{
			switch ( $product_sort ) {
				case 'desc' : $order = 'desc'; break;
				case 'asc' : $order = 'asc'; break;
				default : $order = 'asc'; break;
			}
		}


		if(isset($orderby)) $args['orderby'] = $orderby;
		if(isset($order)) 	$args['order'] = $order;
		if (!empty($meta_key))
		{
			$args['meta_key'] = $meta_key;
		}
	

		$rd_config['woocommerce']['product_sort'] = $args['order'];
		
		return $args;
	}

}

// check for empty-cart get param to clear the cart
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;
	
	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart(); 
	}
}


add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_navigation_link', 10 );


function woocommerce_output_navigation_link(){
	
	
	ob_start();?>



<div class="single_product_navigation"><?php $next = get_permalink(get_adjacent_post(false,'',true)); if ($next != get_permalink()) { ?><a href="<?php echo esc_url($next); ?>" class="previous_product"><?php echo __('Previous', 'thefoxwp'); ?></a><?php } ?><?php $prev = get_permalink(get_adjacent_post(false,'',false)); if ($prev != get_permalink()) { ?><a href="<?php echo esc_url($prev); ?>" class="next_product"><?php echo __('Next', 'thefoxwp'); ?></a><?php } ?></div>

<?php
$output = ob_get_clean();
echo !empty( $output ) ? $output : '';
		
}

#
# move cross sells below the shipping
#

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' , 10);




?>
