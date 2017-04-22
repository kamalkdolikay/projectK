<?php 

/*-----------------------------------------------------------------------------------*/



/* Pricing Tables



/*-----------------------------------------------------------------------------------*/

function pricetable_sc($atts, $content = null) {  
    extract(shortcode_atts(array(  
		'margin_top'   => '0',

		'margin_bottom' => '0',
		
		'pt_style' => '',
	
		'id' => '',
		'mt' => '',
		'mb' => '',
		
		'color_1' => '',
		'color_2' => '',
		'color_3' => '',
		'color_4' => '',
		'color_5' => '',
		'color_rec' => '',
		'animation' => '',

   ), $atts));


global $rd_data;

if($color_1 == '' ){
	$color_1 = $rd_data['rd_content_hl_color'];
}
if($color_2 == '' ){
	$color_2 = $rd_data['rd_content_hl_color'];
}
if($color_3 == '' ){
	$color_3 = $rd_data['rd_content_hl_color'];
}
if($color_4 == '' ){
	$color_4 = $rd_data['rd_content_hl_color'];
}
if($color_5 == '' ){
	$color_5 = $rd_data['rd_content_hl_color'];
}
if($color_rec == '' ){
	$color_rec = $rd_data['rd_content_hover_color'];
}

$pt_id = RandomString(20);

$output = '<style>';

if ($mt !== '' ){
	$output .= '#pt_'.$pt_id.'{margin-top:'.$mt.'px;}';
}
if ($mb !== '' ){
	$output .= '#pt_'.$pt_id.'{margin-bottom:'.$mb.'px;}';
}


if ($pt_style == 'rd_pt_1'){
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0 h3.pricetable-name{background:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{border-color:'.$color_1.';}';	
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_1 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_1 h3.pricetable-name{background:'.$color_2.'; }#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_1.pricetable-featured .pricetable-column-inner{border-color:'.$color_2.';}';		
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_2 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_2 h3.pricetable-name{background:'.$color_3.'; }#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_2.pricetable-featured .pricetable-column-inner{border-color:'.$color_3.';}';		
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_3 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_3 h3.pricetable-name{background:'.$color_4.'; }#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_3.pricetable-featured .pricetable-column-inner{border-color:'.$color_4.';}';	
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_4 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_4 h3.pricetable-name{background:'.$color_5.'; }#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_4.pricetable-featured .pricetable-column-inner{border-color:'.$color_5.';}';		
	$output .= '#pt_'.$pt_id.'.rd_pt_1 .pricetable-featured h4.pricetable-price{background:'.$color_rec.'; color:#fff; }#pt_'.$pt_id.'.rd_pt_1 .pricetable-featured  .pricetable-button-container a:hover{background:'.$color_rec.' !important;}';

}


if ($pt_style == 'rd_pt_2'){
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_0 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_0 h3.pricetable-name{background:'.$color_1.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_1 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_1 h3.pricetable-name{background:'.$color_2.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_2 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_2 h3.pricetable-name{background:'.$color_3.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_3 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_3 h3.pricetable-name{background:'.$color_4.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_4 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_2 .pt_col_nb_4 h3.pricetable-name{background:'.$color_5.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_2 .pricetable-featured h4.pricetable-price{background:'.$color_rec.'; color:#fff; }#pt_'.$pt_id.'.rd_pt_2 .pricetable-featured  .pricetable-button-container a:hover{background:'.$color_rec.' !important;}';

}



if ($pt_style == 'rd_pt_3'){
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_0 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_0 h3.pricetable-name{background:'.$color_1.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_1 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_1 h3.pricetable-name{background:'.$color_2.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_2 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_2 h3.pricetable-name{background:'.$color_3.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_3 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_3 h3.pricetable-name{background:'.$color_4.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_4 .pricetable-button-container a,#pt_'.$pt_id.'.rd_pt_3 .pt_col_nb_4 h3.pricetable-name{background:'.$color_5.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_3 .pricetable-featured  .pricetable-button-container a:hover{background:'.$color_rec.' !important;}';

}

if ($pt_style == 'rd_pt_4'){
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pt_col_nb_0 .pricetable-button-container a{background:'.$color_1.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pt_col_nb_1 .pricetable-button-container a{background:'.$color_2.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pt_col_nb_2 .pricetable-button-container a{background:'.$color_3.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pt_col_nb_3 .pricetable-button-container a{background:'.$color_4.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pt_col_nb_4 .pricetable-button-container a{background:'.$color_5.'; }';	
	$output .= '#pt_'.$pt_id.'.rd_pt_4 .pricetable-featured  .pricetable-button-container a:hover{background:'.$color_rec.' !important;}';

}


if ($pt_style == 'rd_pt_5'){
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_0 .pricetable-button-container a:hover{background:'.$color_1.'; color:#fff;}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_0 h4.pricetable-price{background:'.$color_1.'; box-shadow:0 0 0 2px '.$color_1.';}#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{background:'.$color_1.'; border-color:'.$color_1.';}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_0.pricetable-featured .pricetable-button-container a{background:'.$color_1.'; color:#fff;}';
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_1 .pricetable-button-container a:hover{background:'.$color_2.'; color:#fff;}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_1 h4.pricetable-price{background:'.$color_2.'; box-shadow:0 0 0 2px '.$color_2.';}#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{background:'.$color_2.'; border-color:'.$color_2.';}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_1.pricetable-featured .pricetable-button-container a{background:'.$color_2.'; color:#fff;}';
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_2 .pricetable-button-container a:hover{background:'.$color_3.'; color:#fff;}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_2 h4.pricetable-price{background:'.$color_3.'; box-shadow:0 0 0 2px '.$color_3.';}#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{background:'.$color_3.'; border-color:'.$color_3.';}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_2.pricetable-featured .pricetable-button-container a{background:'.$color_3.'; color:#fff;}';
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_3 .pricetable-button-container a:hover{background:'.$color_4.'; color:#fff;}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_3 h4.pricetable-price{background:'.$color_4.'; box-shadow:0 0 0 2px '.$color_4.';}#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{background:'.$color_4.'; border-color:'.$color_4.';}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_3.pricetable-featured .pricetable-button-container a{background:'.$color_4.'; color:#fff;}';
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_4 .pricetable-button-container a:hover{background:'.$color_5.'; color:#fff;}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_4 h4.pricetable-price{background:'.$color_5.'; box-shadow:0 0 0 2px '.$color_5.';}#pt_'.$pt_id.'.rd_pt_1 .pt_col_nb_0.pricetable-featured .pricetable-column-inner{background:'.$color_5.'; border-color:'.$color_5.';}#pt_'.$pt_id.'.rd_pt_5 .pt_col_nb_4.pricetable-featured .pricetable-button-container a{background:'.$color_5.'; color:#fff;}';
	$output .= '#pt_'.$pt_id.'.rd_pt_5 .pricetable-featured .pricetable-button-container a:hover{background:'.$color_rec.' !important;}';

}



if ($pt_style == 'rd_pt_6'){
	$output .= '#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_0 .pricetable-button-container a{background-color:'.$color_1.';  }#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_0  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_0 .pt_price{color:'.$color_1.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_1 .pricetable-button-container a{background-color:'.$color_2.';  ;}#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_1 h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_1 .pt_price{color:'.$color_2.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_2 .pricetable-button-container a{background-color:'.$color_3.' ; }#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_2  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_2 .pt_price{color:'.$color_3.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_3 .pricetable-button-container a{background-color:'.$color_4.' ;  }#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_3  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_3 .pt_price{color:'.$color_4.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_4 .pricetable-button-container a{background-color:'.$color_5.'; }#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_4 h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_6 .pt_col_nb_4 .pt_price{color:'.$color_5.';}';


}


if ($pt_style == 'rd_pt_7'){
	$output .= '#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_0  h4.pricetable-price{background-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_0.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_1  h4.pricetable-price{background-color:'.$color_2.'; }#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_1.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_2  h4.pricetable-price{background-color:'.$color_3.'; }#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_2.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_3  h4.pricetable-price{background-color:'.$color_4.'; }#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_3.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_4  h4.pricetable-price{background-color:'.$color_5.'; }#pt_'.$pt_id.'.rd_pt_7 .pt_col_nb_4.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';

}

if ($pt_style == 'rd_pt_8'){
	$output .= '#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_0:hover   .pricetable-column-inner {background-color:'.$color_1.' !important; }#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_0.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_1:hover   .pricetable-column-inner {background-color:'.$color_2.' !important; }#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_1.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_2:hover   .pricetable-column-inner {background-color:'.$color_3.' !important; }#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_2.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_3:hover   .pricetable-column-inner {background-color:'.$color_4.' !important; }#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_3.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_4:hover   .pricetable-column-inner {background-color:'.$color_5.' !important; }#pt_'.$pt_id.'.rd_pt_8 .pt_col_nb_4.pricetable-featured  .pricetable-column-inner {background:'.$color_rec.';}';


}


if ($pt_style == 'rd_pt_9'){
	$output .= '#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_0 .pricetable-button-container a{background-color:'.$color_1.'; border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_0 .pricetable-button-container a:hover{background-color:none; color:'.$color_1.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_0  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_0 .pt_price{color:'.$color_1.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_1 .pricetable-button-container a{background-color:'.$color_2.';  border-color:'.$color_1.'; ;}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_1 .pricetable-button-container a:hover{background-color:none; color:'.$color_2.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_1 h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_1 .pt_price{color:'.$color_2.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_2 .pricetable-button-container a{background-color:'.$color_3.' ;  border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_2 .pricetable-button-container a:hover{background-color:none; color:'.$color_3.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_2  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_2 .pt_price{color:'.$color_3.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_3 .pricetable-button-container a{background-color:'.$color_4.' ;  border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_3 .pricetable-button-container a:hover{background-color:none; color:'.$color_4.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_3  h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_3 .pt_price{color:'.$color_4.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_4 .pricetable-button-container a{background-color:'.$color_5.';  border-color:'.$color_1.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_4 .pricetable-button-container a:hover{background-color:none; color:'.$color_5.';}#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_4 h3.pricetable-name,#pt_'.$pt_id.'.rd_pt_9 .pt_col_nb_4 .pt_price{color:'.$color_5.';}';


}



if ($pt_style == 'rd_pt_10'){
	$output .= '#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_0  .pricetable-button-container a:hover{background-color:'.$color_1.' !important; border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_0  h3.pricetable-name{background:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_0 .pt_price{color:'.$color_1.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_1 .pricetable-button-container a:hover{background-color:'.$color_2.' !important;  border-color:'.$color_2.';}#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_1 h3.pricetable-name{background:'.$color_2.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_1 .pt_price{color:'.$color_2.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_2 .pricetable-button-container a:hover{background-color:'.$color_3.' !important;  border-color:'.$color_3.';}#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_2  h3.pricetable-name{background:'.$color_3.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_2 .pt_price{color:'.$color_3.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_3 .pricetable-button-container a:hover{background-color:'.$color_4.' !important;  border-color:'.$color_4.';}#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_3  h3.pricetable-name{background:'.$color_4.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_3 .pt_price{color:'.$color_4.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_4 .pricetable-button-container a:hover{background-color:'.$color_5.' !important;  border-color:'.$color_5.';}#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_4 h3.pricetable-name{background:'.$color_5.'; }#pt_'.$pt_id.'.rd_pt_10 .pt_col_nb_4 .pt_price{color:'.$color_5.';}';


}

if ($pt_style == 'rd_pt_11'){
	$output .= '#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_0  .pricetable-button-container a:hover{background-color:'.$color_1.' !important; border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_0  h3.pricetable-name{background:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_0 .pt_price{color:'.$color_1.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_1 .pricetable-button-container a:hover{background-color:'.$color_2.' !important;  border-color:'.$color_2.';}#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_1 h3.pricetable-name{background:'.$color_2.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_1 .pt_price{color:'.$color_2.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_2 .pricetable-button-container a:hover{background-color:'.$color_3.' !important;  border-color:'.$color_3.';}#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_2  h3.pricetable-name{background:'.$color_3.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_2 .pt_price{color:'.$color_3.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_3 .pricetable-button-container a:hover{background-color:'.$color_4.' !important;  border-color:'.$color_4.';}#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_3  h3.pricetable-name{background:'.$color_4.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_3 .pt_price{color:'.$color_4.';}';
	$output .= '#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_4 .pricetable-button-container a:hover{background-color:'.$color_5.' !important;  border-color:'.$color_5.';}#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_4 h3.pricetable-name{background:'.$color_5.'; }#pt_'.$pt_id.'.rd_pt_11 .pt_col_nb_4 .pt_price{color:'.$color_5.';}';


}
if ($pt_style == 'rd_pt_12'){
	$output .= '#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_0  .pricetable-button-container a:hover{background-color:'.$color_1.' !important; border-color:'.$color_1.'; }#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_0  h3.pricetable-name:before{background:'.$color_1.'; }';
	$output .= '#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_1 .pricetable-button-container a:hover{background-color:'.$color_2.' !important;  border-color:'.$color_2.';}#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_1 h3.pricetable-name:before{background:'.$color_2.'; }';
	$output .= '#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_2 .pricetable-button-container a:hover{background-color:'.$color_3.' !important;  border-color:'.$color_3.';}#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_2  h3.pricetable-name:before{background:'.$color_3.'; }';
	$output .= '#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_3 .pricetable-button-container a:hover{background-color:'.$color_4.' !important;  border-color:'.$color_4.';}#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_3  h3.pricetable-name:before{background:'.$color_4.'; }';
	$output .= '#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_4 .pricetable-button-container a:hover{background-color:'.$color_5.' !important;  border-color:'.$color_5.';}#pt_'.$pt_id.'.rd_pt_12 .pt_col_nb_4 h3.pricetable-name:before{background:'.$color_5.'; }';


}


$output .= '</style>';


$output .= '<div class="'.$pt_style.' '.$animation.'" id="pt_'.$pt_id.'">' . do_shortcode('[price_table id='.$id.']') . '</div>';

return $output;
}

add_shortcode("pricetable_sc", "pricetable_sc");


?>