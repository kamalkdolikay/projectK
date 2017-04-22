<?php 



/*-----------------------------------------------------------------------------------*/



/*  Woocomerce module shortcode



/*-----------------------------------------------------------------------------------*/




function wooc_module($atts, $content = null) {  






    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',

		'to_show' => '1000',
		
		'per_line' => '4',
		
		'pro_type' => 'recent'
				
    ), $atts));

	ob_start();

$wc_rp_rs = RandomString(20);
			
		echo '
		<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {
		j$(".'.$wc_rp_rs.'.rp_sc ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".'.$wc_rp_rs.'.rp_left",
					next: ".'.$wc_rp_rs.'.rp_right",
					auto: false,
					items: {
						width: 330,
						height: "100%",
					//	height: "30%",	//	optionally resize item-height
						visible: {
							min: 1,
							max: '.$per_line.'
						}
					}
				});
				
				
				j$(".products").css("opacity","1");
				});
	</script>
	
	<div class="tf_woo_carousel">
	<div class="rp_nav">
  <p class="'.$wc_rp_rs.' rp_left"></p>
  <p class="'.$wc_rp_rs.' rp_right"></p>
</div>
	<div class="'.$wc_rp_rs.' rp_sc">
';
echo do_shortcode('['.$pro_type.'_products per_page="'.$to_show.'" ]');

?>




  </div>
  </div>

<?php

$output_string = ob_get_contents();
ob_end_clean();

	return '<div class="clearfix" style="padding-top:'.$margin_top.'px"></div>'.$output_string.'<div class="clearfix" style="padding-top:'.$margin_bottom.'px"></div>';
}
add_shortcode( 'wooc_module', 'wooc_module' );



?>