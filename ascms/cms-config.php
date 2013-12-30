<?php 

// This is the global configuration file for all of the cms configuration. Determines which pages are available within the CMS

// Include the Definition File
require('../includes/files/define.php');

if($conn) {

	$adminVariables = array(); // Set all the entries for Site and Page variables in the database
	
	// Page List Array. This is an array of the Sections that will be associated with the CMS
	// Initially, page-management, product-management and banner-management are available sections
	$sectionsArray = array(
		'banner-management',
		'page-management',
		'product-management',
		'product-category-management',
		'product-group-management',
		'customer-management'
	);
	
	// Loop the Array and include the CMS sections
	if(is_array($sectionsArray)) {
		foreach($sectionsArray as $sa) {
			$sectionFile = BASE_PATH_CMS.'includes/sections-config/'.$sa.'.php';
			if(is_file($sectionFile)) {
				include_once($sectionFile); // Include the Section File
			}
		}
	}
	
	// Run a Loop and send to the Database 
	if(is_array($adminVariables)) {
		foreach($adminVariables as $pageName => $variables) {
			$jsonString = json_encode($variables);
			$sql = "REPLACE INTO `SITE-CONFIG` SET `PAGE-NAME` = '".mysql_real_escape_string($pageName)."', `VALUES` = '".mysql_real_escape_string($jsonString)."' ";	
			if(mysql_query($sql,$conn)) {
				echo "<strong>".$pageName."</strong> has updated variables.<br />";
			}
		}
	}
}

?>