<?php
/**
 * Page builder support
 *
 * @package domestication
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function domestication_theme_widgets($widgets) {
	$theme_widgets = array(
		'domestication_Services_Type_A',
		'domestication_Services_Type_B',
		'domestication_List',
		'domestication_Facts',
		'domestication_Clients',
		'domestication_Testimonials',
		'domestication_Skills',
		'domestication_Action',
		'domestication_Video_Widget',
		'domestication_Social_Profile',
		'domestication_Employees',
		'domestication_Latest_News',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('domestication-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'domestication_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function domestication_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('domestication Theme Widgets', 'domestication'),
		'filter' => array(
			'groups' => array('domestication-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'domestication_theme_widgets_tab', 20);

/* Replace default row options */
function domestication_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'domestication'),
		'type' => 'color',
		'priority' => 3,		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'domestication'),
		'type' => 'measurement',
		'description' => __('Top and bottom padding for this row [default: 100px]', 'domestication'),
		'priority' => 4,
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'domestication'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'domestication'),
		'priority' => 5,
	);		
	$fields['background'] = array(
		'name' => __('Background Color', 'domestication'),
		'type' => 'color',
		'description' => __('Background color of the row.', 'domestication'),
		'priority' => 6,
	);
	$fields['color'] = array(
		'name' => __('Color', 'domestication'),
		'type' => 'color',
		'description' => __('Color of the row.', 'domestication'),
		'priority' => 7,
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'domestication'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'domestication'),
		'priority' => 8,
	);
	$fields['row_stretch'] = array(
		'name' 		=> __('Row Layout', 'domestication'),
		'type' 		=> 'select',
		'options' 	=> array(
			'' 				 => __('Standard', 'domestication'),
			'full' 			 => __('Full Width', 'domestication'),
			'full-stretched' => __('Full Width Stretched', 'domestication'),
		),
		'priority' => 9,
	);
	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'domestication'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'domestication'),		
		'options' 	  => array(
			'' 				=> __('Default', 'domestication'),
			'mob-pad-0' 	=> __('0', 'domestication'),
			'mob-pad-15'    => __('15px', 'domestication'),
			'mob-pad-30'    => __('30px', 'domestication'),
			'mob-pad-45'    => __('45px', 'domestication'),
		),
		'priority'    => 10,
	);
	$fields['class'] = array(
		'name' => __('Row Class', 'domestication'),
		'type' => 'text',
		'description' => __('Add your own class for this row', 'domestication'),
		'priority' => 11,
	);
	$fields['column_padding'] = array(
		'name'        => __('Columns padding', 'domestication'),
		'type'        => 'checkbox',
		'description' => __('Remove padding between columns for this row?', 'domestication'),
		'priority'    => 12,
	);	

	return $fields;
}
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'domestication_row_styles');

/* Filter for the styles */
function domestication_row_styles_output($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: ' . esc_attr($style['background']) . ';';
	
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['data-hasbg'] = 'hasbg';
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}
	if( !empty( $style['row_stretch'] ) ) {
		$attr['class'][] = 'domestication-stretch';
		$attr['data-stretch-type'] = esc_attr($style['row_stretch']);
	}
	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'domestication_row_styles_output', 10, 2);