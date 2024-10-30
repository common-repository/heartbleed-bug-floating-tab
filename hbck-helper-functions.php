<?php
// STEP 3

/**
 * Helper function: Check for pages and return the current page name
 * 
 * @return string
 */
function hbck_get_admin_page() {
	global $pagenow;
	
	// read the current page
	$current_page = trim($_GET['page']);
	
	// use a different way to read the current page name when the form submits
	if ($pagenow == 'options.php') {
		// get the page name
		$parts 	= explode('page=', $_POST['_wp_http_referer']); // http://codex.wordpress.org/Function_Reference/wp_referer_field
		$page  	= $parts[1]; 

		// account for the use of tabs (we do not want the tab name to be part of our return value!)
		$t 		= strpos($page,"&");
		
		if($t !== FALSE) {			 
			$page  = substr($parts[1],0,$t); 
		}
		
		$current_page = trim($page);
	}
	
return $current_page;
}

/**
 * Helper function: Set default tab
 * 
 * @return string
 */
function hbck_default_tab() {
	// find current page
	$current_page = hbck_get_admin_page();
	
	// There may be times when the first tab has a different slug from page to page. Here is where you can override the $default_tab = 'general'; Gives you more control :)
	// if our current page is the 'hbck-settings-page-two' page then set the default tab to 'social-media'
	if ($current_page == 'hbck-settings') {
		$default_tab = 'info';
		
	// if you have more settings pages with a first tab slug other than "general" continue with an 
	//}elseif($current_page == 'your-page-slug'){ 
	//conditional here.
		
	// else fallback to the "general" tab.
	} else {
		$default_tab = 'general';
	}
return $default_tab;
}

/**
 * Helper function: Check for tabs and return the current tab name
 * 
 * @return string
 */
function hbck_get_the_tab() {
	global $pagenow;
	
	// set default tab
	$default_tab 	= hbck_default_tab();
	
	// read the current tab when on our settings page
	$current_tab 	= (isset($_GET['tab']) ? $_GET['tab'] : $default_tab);
	
	//use a different way to read the tab when the form submits
	if ($pagenow == 'options.php') {
		// need to read the tab name so we explode()!
		$parts 	= explode('&tab=', $_POST['_wp_http_referer']); // http://codex.wordpress.org/Function_Reference/wp_referer_field
		// count the "exploded" parts
		$partsNum = count($parts);
		
		// account for "&settings-updated=true" (we do not want that to be part of our return value!)
			// is it "&settings-updated=true" there? - check for the "&"
			$settings_updated = strpos($parts[1],"&");
			
			// filter it out and get the tab name
			$tab_name = ($settings_updated !== FALSE ? substr($parts[1],0,$settings_updated) : $parts[1]);
		
		// use if found, otherwise pass the default tab name
		$current_tab = ($partsNum == 2 ? trim($tab_name) : $default_tab);
	}
	
return $current_tab;
} 

/**
 * Helper function: Creates settings page title and tabs (if needed)
 *
 * @return echos output
 */
function hbck_settings_page_header() {
	
    // get the tabs
    $settings_output 	= hbck_get_settings();
	$tabs 				= $settings_output['hbck_page_tabs'];
	
	// get the current tab
	$current_tab 		= hbck_get_the_tab();
	
	// display the icon and page title
	echo '<div id="icon-options-general" class="icon32"><br /></div>';
	echo '<h2>' . $settings_output['hbck_page_title'] . '</h2>';
    
	// check for tabs
	if ($tabs !='') {
		// wrap each in anchor html tags
		$links = array();
		foreach( $tabs as $tab => $name ) {
			// set anchor class
			$class 		= ($tab == $current_tab ? 'nav-tab nav-tab-active' : 'nav-tab');
			$page 		= $_GET['page'];
			// the link
			$links[] 	= "<a class='$class' href='?page=$page&tab=$tab'>$name</a>";
		}
		
		echo '<h3 class="nav-tab-wrapper">';
			foreach ( $links as $link ) {
				echo $link;
			}
		echo '</h3>';
	}  
} ?>