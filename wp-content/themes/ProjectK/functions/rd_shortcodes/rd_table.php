<?php 


/*-----------------------------------------------------------------------------------*/



/* Table shortcode



/*-----------------------------------------------------------------------------------*/


add_shortcode( 'table_ctn', 'table_ctn' );


function table_ctn( $atts, $content ){

extract( shortcode_atts( array(
        'col_nb' => '',
        'text_color' => '',
        'bg_color' => '',
        'border_color' => '',
	), $atts ) );
ob_start();

global $rd_data;
$table_id = RandomString(20);	

if($text_color == ''){
	$text_color =  $rd_data['rd_content_text_color'];
}
if($bg_color == ''){
	$bg_color  = $rd_data['rd_content_bg_color'];	
}
if($border_color == ''){
	$border_color  = $rd_data['rd_content_border_color']; 
}

$output = '<style>#t_'.$table_id.' .table_col {color:'.$text_color.'; background:'.$bg_color.';}#t_'.$table_id.' .table_col .table_line_ctn {border:1px solid '.$border_color.';}#t_'.$table_id.' .table_col .table_line {border-bottom:1px solid '.$border_color.';} </style>  ';

$output .= "\n".'<!-- Table --><div class="rd_table_ctn '.$col_nb.'" id="t_'.$table_id.'">'.do_shortcode($content).'</div>

<!-- Table END-->'."\n";

echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}


function table_sc($atts, $content = null) {
	extract( shortcode_atts( array(
        'title' => 'Title',
        'title_color' => '',
        'title_bg_color' => '',
        'values' => '',
	), $atts ) );


ob_start();
global $rd_data;
if($title_color == ''){
	$title_color = $rd_data['rd_content_bg_color'];	
}
if($title_bg_color == ''){
	$title_bg_color  = $rd_data['rd_content_hl_color']; 
}



$table_lines = explode( ",", $values );	

	
	$output = '<div class="table_col"><h3 style="background:'.$title_bg_color.'; color:'.$title_color.'">'.$title.'</h3><div class="table_line_ctn">';
	
	foreach ( $table_lines as $line ) {
	$output .= '<div class="table_line"><p>'.$line.'</p></div>';
}


	$output .= '</div></div>';
	
echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;
	
	
	}
add_shortcode('table_sc', 'table_sc');

?>