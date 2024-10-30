<?php
/**
 * Define page tabs
 * $tabs['tab-slug'] 	= __('Tab Name', 'settings');
 */
function hbck_options_two_page_tabs() {
	
	$tabs = array();
	
	$tabs['info'] 	= __('Info', 'hbck');
	$tabs['settings'] 	= __('Settings', 'hbck');	
	
	return $tabs;
}

/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function hbck_options_two_page_sections() {
	// we change the output based on open tab
	
	// get the current tab
	$tab = hbck_get_the_tab();

	// switch sections array according to tab
	switch ($tab) {
		//Info
		case 'info':
			$sections = array();
			$sections['txt_section'] 		= __('Info', 'hbck_textdomain');
		break;
		
		//Settings
		case 'settings':
			$sections = array();
			$sections['settings_section'] 		= __('Settings', 'hbck_textdomain');
		break;
		
	}
	
return $sections;	
} 

/**
 * Define our form fields (options) 
 *
 * @return array
 */
function hbck_options_two_page_fields() {

	// get the current tab
	$tab = hbck_get_the_tab();
	
	// setting fields according to tab
	switch ($tab) {
		case 'settings':
		//Settings	 
	$options[] = array(
		"section" => "settings_section",
		"id"      => HBCK_SHORTNAME . "_enable",
		"title"   => __( 'Enable?', 'hbck_textdomain' ),
		"desc"    => __( '', 'hbck_textdomain' ),
		"type"    => "checkbox",
		"std"     => 0
	
	);
	
	$options[] = array(
		"section" => "settings_section",
		"id"      => HBCK_SHORTNAME . "_side",
		"title"   => __( 'Side:', 'hbck_textdomain' ),
		"desc"    => __( 'Which side do you want it displayed?', 'hbck_textdomain' ),
		"type"    => "select",
		"std"    => "Right",
		"choices" => array( "Right", "Left")
	);
	
	$options[] = array(
		"section" => "settings_section",
		"id"      => HBCK_SHORTNAME . "_from_top",
		"title"   => __( 'From Top', 'hbck_textdomain' ),
		"desc"    => __( 'How many pixels from the top?', 'hbck_textdomain' ),
		"type"    => "text",
		"std"     => __('130px','hbck_textdomain')
	);
	
	$options[] = array(
		"section" => "settings_section",
		"id"      => HBCK_SHORTNAME . "_image",
		"title"   => __( 'Image:', 'hbck_textdomain' ),
		"desc"    => __( 'Which image do you want to display?', 'hbck_textdomain' ),
		"type"    => "select",
		"std"    => "Green Shield",
		"choices" => array( "Green Tick", "Green Shield")
	);
		break;
	
	}
	
	return $options;	
}
/**
 * Contextual Help
 */
function hbck_options_two_page_contextual_help() {
	// get the current tab
	$tab = hbck_get_the_tab();
	
	$text 	= "<h3>" . __('Contextual Help','scd_textdomain') . "</h3>";
	
	// contextual help according to tab
	switch ($tab) {
		// Settings
		case 'settings':
			$text 	.= "<p>" . __('','scd_textdomain') . "</p>";
		break;
	}
	// must return text! NOT echo
	return $text;
} ?>