<?php 


/*-----------------------------------------------------------------------------------*/



/*	Icons Shortcodes



/*-----------------------------------------------------------------------------------*/


function rd_icon( $atts, $content = null ) {


	$src = get_stylesheet_directory_uri();


	extract(shortcode_atts(array(


		'pos'   => 'left;',

		'color' => '',

		'size' => '40',

		'border' => '',

		'margin_top' => '',

		'margin_bottom' => '',

		'icon'	=> 'cog'
		
		


    ), $atts));

if($color == '' && $border == 'none'){

	return '<div class="icon_sc" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; text-align:'.$pos.'"><i class="fa-'.$icon.'" style="font-size:'.$size.'px;" ></i></div>';

}
elseif ($border == 'none'){	return '<div class="icon_sc" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; text-align:'.$pos.'"><i class="fa-'.$icon.'" style="font-size:'.$size.'px; color:'.$color.'; text-align:'.$pos.'" ></i></div>';
}
	
	elseif($pos !=="center"){
if($border == 'sr'){return '<div class="single_icon_ctn sr" style="float:'.$pos.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>'; }

elseif($border == 'ss'){return '<div class="single_icon_ctn ss" style="float:'.$pos.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>';}

elseif($border == 'dr'){return '<div class="single_icon_ctn dr" style="float:'.$pos.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>';}

elseif($border == 'ds'){return '<div class="single_icon_ctn ds" style="float:'.$pos.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.'; " ></i></div>';}

	}else{

if($border == 'sr'){return '<div class="single_icon_ctn sr icn_centered" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>'; }

elseif($border == 'ss'){return '<div class="single_icon_ctn ss icn_centered" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>';}

elseif($border == 'dr'){return '<div class="single_icon_ctn dr icn_centered" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.';" ></i></div>';}

elseif($border == 'ds'){return '<div class="single_icon_ctn ds icn_centered" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"><i class="fa-'.$icon.'" style="color:'.$color.'; " ></i></div>';}

	}
		
		
		


}


add_shortcode('icon', 'rd_icon');


?>