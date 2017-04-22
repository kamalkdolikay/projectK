<?php 


/*-----------------------------------------------------------------------------------*/



/* Tabs shortcode



/*-----------------------------------------------------------------------------------*/


add_shortcode( 'tabgroup', 'Tabs' );


function tabs( $atts, $content ){

extract( shortcode_atts( array(
        'type' => 'vertical',
	), $atts ) );


$return = "\n".'<!-- the tabs --><div class="tab-holder '.$type.'"><div class="tab-hold tabs-wrapper"><ul id="tabs" class="tabs"></ul>'."\n".'<!-- tab "panes" --><div class="tab-box tabs-container"></div>'.do_shortcode($content).'</div></div>

<!-- the tabs END-->'."\n";




return $return;


}


function tab($atts, $content = null) {
	extract( shortcode_atts( array(
        'title' => 'Title',
	), $atts ) );
	
		return '<li class="tabli"><a>'.$title.'</a></li><div class="tab tab_content">'.do_shortcode($content).'</div>';
	}
add_shortcode('tab', 'tab');

?>