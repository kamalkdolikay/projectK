<?php 


/*-----------------------------------------------------------------------------------*/



/*  Google Maps shortcode



/*-----------------------------------------------------------------------------------*/




function rd_gmaps($atts, $content = null) {  






    extract(shortcode_atts(array(  
		'zoom'   => '14',

		'height' => '400',

		'title' => 'our headquarters',
		
		'lat' => '',
		
		'lng' => '',
		
		'image' => '',
				
    ), $atts));

	ob_start();

$wc_rp_rs = RandomString(20);
			
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">

"use strict";
function initialize() {

var latlng = new google.maps.LatLng(<?php echo esc_js($lat." , ".$lng) ?>);

var grayStyles = [
        {
          featureType: "all",
          stylers: [
            { saturation: -10 },
            { lightness: 10 }
          ]
        },
      ];

var options = {

center : latlng,

scrollwheel :  false,

<?php echo(isMobile()) ? 'draggable: false,' : ''; ?>

mapTypeId: google.maps.MapTypeId.ROADMAP,

zoomControl : true,

styles: grayStyles,

zoomControlOptions :

{

style: google.maps.ZoomControlStyle.SMALL,

position: google.maps.ControlPosition.TOP_LEFT

},

mapTypeControl : true,

mapTypeControlOptions :

{

style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,

position: google.maps.ControlPosition.TOP_RIGHT

},

scaleControl : true,

scaleControlOptions :

{

position: google.maps.ControlPosition.TOP_LEFT

},

streetViewControl : true,

streetViewControlOptions :

{

position: google.maps.ControlPosition.TOP_LEFT

},

panControl : false,  zoom : <?php echo esc_js($zoom); ?> 
 

};

var map = new google.maps.Map(document.getElementById("map_canvas"), options);

var marker = new google.maps.Marker({

position: latlng, 

<?php if($image !== ''){

$bg_id = preg_replace( '/[^\d]/', '', $image );
$bg_img = wp_get_attachment_image_src( $bg_id, 'full'  );

	
	 ?>

icon: '<?php echo $bg_img[0]; ?>',

<?php } ?>

map: map,

title:"<?php echo esc_js($title); ?>"

});   

}

</script>
<body onLoad="initialize()" class="map_canvas_body">
<div id="map_canvas" style="height:<?php echo esc_attr($height);?>;"></div>
</body>

<?php

$output_string = ob_get_contents();
ob_end_clean();

	return $output_string;
}
add_shortcode( 'rd_gmaps', 'rd_gmaps' );

?>