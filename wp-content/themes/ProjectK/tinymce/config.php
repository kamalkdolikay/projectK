<?php
$rd_shortcodes['dropcap'] = array(
'params' => array(
'style' => array(
'type' => 'select',
'label' => __('Style', 'thefoxwp'),
'desc' => __('Select the Dropcap Style', 'thefoxwp'),
'options' => array(
'a' => 'Letter only',
'dc_rounded' => 'Rounded',
'dc_squared' => 'Squared',
'dc_rectangle' => 'Rectangle',
)
),
'color' => array(
'std' => '#222222',
'type' => 'color',
'label' => __('Background color for the rounded Dropcap', 'thefoxwp'),
'desc' => __('IMPORTANT enter the color THEN change the letter', 'thefoxwp'),
),
'content' => array(
'std' => 'A',
'type' => 'text',
'label' => __('Letter for the Dropcap', 'thefoxwp'),
'desc' => __('Enter a Letter or Number', 'thefoxwp'),
)
),
'shortcode' => '[dropcap style={{style}} color={{color}}]{{content}}[/dropcap]',
'popup_title' => __('DropCap Letter', 'thefoxwp')
);

$rd_shortcodes['highlight'] = array(
'params' => array(
'content' => array(
'std' => 'your hightlight text',
'type' => 'text',
'label' => __('Text', 'thefoxwp'),
'desc' => __('Text to High Light', 'thefoxwp'),
),
'bg_color' => array(
'std' => '#21c2f8',
'type' => 'color',
'label' => __('High light background color', 'thefoxwp'),
'desc' => __('Select the highlight background color', 'thefoxwp'),
),
'text_color' => array(
'std' => '#ffffff',
'type' => 'color',
'label' => __('High light text color', 'thefoxwp'),
'desc' => __('Select the highlight text color', 'thefoxwp'),
),
'border_color' => array(
'std' => '',
'type' => 'color',
'label' => __('High light border color (optional)', 'thefoxwp'),
'desc' => __('Select the highlight border color if you want to add a border', 'thefoxwp'),
),


),
'shortcode' => '[highlight_sc bg_color={{bg_color}} text_color={{text_color}} border_color={{border_color}}]{{content}}[/highlight_sc]',
'popup_title' => __('Highlight', 'thefoxwp')
);

$rd_shortcodes['tooltip'] = array(
'params' => array(
'content' => array(
'std' => 'Text you want to asign a tooltip',
'type' => 'text',
'label' => __('Text', 'thefoxwp'),
'desc' => __('Text to asign a tooltip', 'thefoxwp'),
),
'tip_text' => array(
'std' => 'Text that appear in tool tip',
'type' => 'text',
'label' => __('Text', 'thefoxwp'),
'desc' => __('Text that will appear in the tool tip', 'thefoxwp'),
),

),
'shortcode' => '[tooltip_sc tip_text="{{tip_text}}"]{{content}}[/tooltip_sc]',
'popup_title' => __('Tool-tip', 'thefoxwp')
);




?>