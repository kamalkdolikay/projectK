<?php

/*-----------------------------------------------------------------------------------

Plugin Name: Custom Google Maps Widget

Description: A widget that allows the display of Google map.

-----------------------------------------------------------------------------------*/

function widget_gmaps_init() {

if ( !function_exists('wp_register_sidebar_widget') || !function_exists('wp_register_widget_control') )

return;

function widget_gmaps_control() {

$options = $newoptions = get_option('widget_gmaps');

if ( isset($_POST['gmaps-submit']) ) {

$newoptions['text'] = strip_tags(stripslashes($_POST['gmaps-text']));

$newoptions['lat'] = (float) $_POST['gmaps-lat'];

$newoptions['lng'] = (float) $_POST['gmaps-lng'];

$newoptions['zoom'] = (int) $_POST['gmaps-zoom'];


}

if ( $options != $newoptions ) {

$options = $newoptions;

update_option('widget_gmaps', $options);

}

?>
<p>
<label for="gmaps-text">

<?php _e('Text which appears on marker mouse over:', 'widgets'); ?>

<input class="widefat" type="text" id="gmaps-text" name="gmaps-text" value="<?php echo esc_html($options['text'], true); ?>" />

</label>
</p>
<p>
<label for="gmaps-lat">

<?php _e('Lat:', 'widgets'); ?>

<input class="widefat" type="text" id="gmaps-lat" name="gmaps-lat" value="<?php echo esc_attr($options['lat']); ?>" />

</label>
</p>
<p>
<label for="gmaps-lng">

<?php _e('Lng:', 'widgets'); ?>

<input class="widefat" type="text" id="gmaps-lng" name="gmaps-lng" value="<?php echo esc_attr($options['lng']); ?>" />

</label>
</p>
<p>
<label for="gmaps-zoom">

<?php _e('Zoom:', 'widgets'); ?>

<input class="widefat" type="text" id="gmaps-zoom" name="gmaps-zoom" value="<?php echo esc_attr($options['zoom']); ?>" />

</label>
</p>
<input type="hidden" name="gmaps-submit" id="gmaps-submit" value="1" />


<?php

}

function widget_gmaps($args) {

extract($args);

$defaults = array('text' => 'You can find us here!', 'lat' => 40.741924698522055, 'lng' => -73.99343490600586, 'zoom' => 13, 'width' => '100%', 'height' => 600);

$options = (array) get_option('widget_gmaps');

?>

<?php echo !empty( $before_widget ) ? $before_widget : ''; ?>

</script><script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
"use strict";
function initialize() {

var latlng = new google.maps.LatLng(<?php echo esc_js($options['lat']." , ".$options['lng']) ?>);

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

panControl : false,  zoom : <?php echo esc_js($options['zoom']) ?> 
 

};

var map = new google.maps.Map(document.getElementById("map_canvas"), options);

var marker = new google.maps.Marker({

position: latlng, 

map: map,

title:"<?php echo esc_js($options['text']) ?>"

});   

}

</script>
<body onLoad="initialize()" class="map_canvas_body">
<div id="map_canvas"></div>
</div>
</body>

<?php echo !empty( $after_widget ) ? $after_widget : ''; ?>

<?php

}

wp_register_sidebar_widget(

'gmaps',        // your unique widget id

'Custom Google Maps',          // widget name

'widget_gmaps',  // callback function

array(                  // options

'description' => 'Custom google map widget'

)

);	

wp_register_widget_control(

'gmaps', // your unique widget id

'Custom Google Maps', // widget name

'widget_gmaps_control' // Callback function

);

}

add_action('widgets_init', 'widget_gmaps_init');



?>