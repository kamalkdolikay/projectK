<?php  global $rd_data; 


$footer_col = $rd_data['rd_footer_col'];
$footer_type = $rd_data['rd_footer_type'];
$rd_footer = $rd_data['rd_footer'];
$footer_coms = $rd_data['rd_footer_bar'];

$footer_menu = $rd_data['rd_footer_menu'];
$footer_menu_pos = $rd_data['rd_footer_menu_pos'];
$footer_menu_type = $rd_data['rd_footer_menu_type'];

$footer_social = $rd_data['rd_footer_social'];
$footer_social_pos = $rd_data['rd_footer_social_pos'];
$footer_social_type = $rd_data['rd_footer_social_type'];

$footer_html = $rd_data['rd_footer_html'];
$footer_html_pos = $rd_data['rd_footer_html_pos'];
$footer_message = $rd_data['rd_footer_message'];


?>
<?php  if($rd_footer == 'no'){ ?>

<div id="footer_bg">
<?php }else { ?>

<div id="footer_bg"  class="<?php echo esc_attr($footer_col.' '.$footer_type) ; ?>">
  <div class="wrapper">
    <div id="footer">
	  <div class="widget_wrap">
      <?php if ( is_active_sidebar( 'thefox_fs_col1' ) ) {if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 1 column')) : ?>
      <?php endif; }?>
      </div>
      <?php if($footer_col == 'footer_4_col' || $footer_col == 'footer_3_col' || $footer_col == 'footer_2_col' ){ ?>
      <div class="widget_wrap">
      <?php if ( is_active_sidebar( 'thefox_fs_col2' ) ) { if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 2 column')) : ?>
      <?php endif; }?>
      </div>
      <?php } if($footer_col == 'footer_4_col' || $footer_col == 'footer_3_col' ){ ?>
      <div class="widget_wrap">
      <?php if ( is_active_sidebar( 'thefox_fs_col3' ) ) { if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 3 column')) : ?>
      <?php endif; }?>
      </div>
      <?php } if($footer_col == 'footer_4_col'){ ?>
      <div class="widget_wrap">
      <?php if ( is_active_sidebar( 'thefox_fs_col4' ) ) { if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 4 column')) : ?>
      <?php endif; } ?>
      </div>
      <?php } ?>
    </div>
    </div>

<?php } if($footer_coms == 'yes'){ ?>
    <div id="footer_coms">
      <div class="wrapper">

<?php  if($footer_menu == 'yes'){ ?>
		<div class="<?php echo esc_attr($footer_menu_pos.' '.$footer_menu_type); ?>">	
            <?php wp_nav_menu( array(
	  
		    'theme_location' => 'footer-menu',

			'container' => '', 

            'before' => '',
			
			'fallback_cb' => false

                    ) ); 
 ?>
</div>
<?php } if($footer_social == 'yes'){ ?>
 <div class="footer_si_ctn <?php echo esc_attr($footer_social_pos.' '.$footer_social_type); ?>" >
      <div id="f_social_icons">
 <?php rd_social_icon(); ?>
  </div>
  </div>
<?php } if($footer_html == 'yes'){ ?>
 <div class="footer_message <?php echo esc_attr($footer_html_pos); ?>" >
   
 <?php echo !empty( $footer_message ) ? $footer_message : ''; // accept HTML ?>
  </div>
<?php } ?>


</div>
</div>
<?php if($rd_data['rd_boxed']==true) { ?>
</div>
<?php } ?>
</div>
<?php } ?>
</div>
<a id="to_top"><i class="fa-angle-up"></i></a>
</div>
<div id="mobile-menu">

    <?php wp_nav_menu( array(

		    'theme_location' => 'main-menu',

			'container' => '', 

            'before' => ''

                    ) ); 

          ?>
          <div id="mobile_menu_search">
<div id="search">

				<form method="get" action="<?php echo home_url(''); ?>/"><input type="text" name="s" placeholder="<?php echo __('Search','thefoxwp'); ?>" class="search"  value="<?php the_search_query(); ?>"/><input type="submit" id="searchsubmit" value=""></form>

			</div></div>
</div>
<div class="menu_slide mt_menu sticky_header" >
            <div class="wrapper tf_o_visible">

<?php 
	if ($rd_data['rd_logo']['url'] !== '' && $rd_data['rd_mobile_logo']['url'] !== '') { ?>
<div id="logo_img"><a href="<?php echo home_url(''); ?>"><img class="dark_logo mobile_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_mobile_white_logo']['url']);}else{echo esc_url($rd_data['rd_mobile_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a></div>



<?php }elseif($rd_data['rd_logo']['url'] !== '' ) { ?>
<div id="logo_img"><a href="<?php echo home_url(''); ?>"><img class="dark_logo mobile_logo" src="<?php if ($rd_data['rd_logo_color'] == 'light_logo_selected' ){echo esc_url($rd_data['rd_white_logo']['url']);}else{echo esc_url($rd_data['rd_logo']['url']);} ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a></div>


<?php }else { ?>
<div class="logo_text"><a href="<?php echo home_url(''); ?>">
  <p>
    <?php bloginfo('name'); ?>
  </p>
  </a></div>
<?php } ?>

                
<div id="nav_button_alt"></div>
    </div>          
 <?php if(rd_check_woo_status() == true && $rd_data['rd_header_cart'] == 'yes' ){ global $woocommerce; ?>
 
<ul class="header_current_cart">
<div class="current_item_number"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></div><li><a class="cart-content" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
</a>
<ul class="header_cart_dropdown cdp_2">
<div class="widget_shopping_cart_content"></div>
</ul>
</li>
</ul>
<?php }  ?>          
</div>
<?php wp_footer(); ?>

</body></html>