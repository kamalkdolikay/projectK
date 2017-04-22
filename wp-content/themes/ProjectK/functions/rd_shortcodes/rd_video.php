<?php 

/*-----------------------------------------------------------------------------------*/



/* Video



/*-----------------------------------------------------------------------------------*/

function video_sc($atts, $content = null) { 
if (!isset($compile)) {$compile='';} 
    extract(shortcode_atts(array(  


    ), $atts));
	
	$youtube = substr_count($content, "youtu");
            if ($youtube > 0) {
                $videoid = substr(strstr($content, "="), 1);
                $compile .= "
            <iframe width='500' height='281' src='http://www.youtube.com/embed/" . $videoid . "' frameborder='0' allowfullscreen></iframe>
        ";
            }

    $vimeo = substr_count($content, "vimeo");
            if ($vimeo > 0) {
                $videoid = substr(strstr($content, "m/"), 2);
                $compile .= "
            <iframe src='http://player.vimeo.com/video/" . $videoid . "' width='500' height='281' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
            }

	
			return '<div class="video_sc">'.$compile.'</div>';

}

add_shortcode("video_sc", "video_sc");

?>