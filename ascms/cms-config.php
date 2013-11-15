<?php 

// This is the global configuration file for all of the cms configuration. Determines which pages are available within the CMS

// Include the Definition File
require('../includes/files/define.php');

if($conn) {

	$adminVariables = array(); // Set all the entries for Site and Page variables in the database
	
	// Page List Array. This is an array of the Sections that will be associated with the CMS
	// Initially, page-management, product-management and banner-management are available sections
	$sectionsArray = array(
		'page-management',
		'product-management',
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
	
	// Fields for Product Category Management
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['PAGE-TITLE'] = 'Product Category Management';
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['PAGE-FILE'] = 'product-category-management';
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['LABELER'] = 'Product Category';
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-FIELDS'] = array('TITLE','BACKGROUND-IMAGE','HERO-PRODUCT');
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'PRODUCT-CATEGORY-TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Category Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Category Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Category Title'),
															'HERO-PRODUCT' => array('TYPE' => 'select', 'LABEL' => 'Hero Product', 'VALIDATION-MESSAGE' => 'Select a Hero Product', 'DATABASE-FIELD' => 'HERO-PRODUCT', 'DESCRIPTION' => 'Hero Product (will show image in boxes)', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'IMAGE-FILENAME', 'WHERE' => '`IMAGE-FILENAME` != "" AND `ACTIVE` = "1"')),
															'BACKGROUND-IMAGE' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/backgrounds/', 'LABEL' => 'Background Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BACKGROUND-IMAGE', 'DESCRIPTION' => 'Category Background Image', 'FILE-TYPES' => array('png','jpg','jpeg','gif'))
													);
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['TABLE'] = 'PRODUCT-CATEGORIES'; // Table to Update
	$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page	

	// Fields for Product Sub Group Management
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['PAGE-TITLE'] = 'Product Sub-Group Management';
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['PAGE-FILE'] = 'product-subgroup-management';
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['LABELER'] = 'Product Sub-Group';
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['DB-FIELDS'] = array('TITLE','BACKGROUND-IMAGE','HERO-PRODUCT');
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'PRODUCT-SUB-GROUP-TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Sub-Group Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Sub-Group Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Sub-Group Title'),
															'HERO-PRODUCT' => array('TYPE' => 'select', 'LABEL' => 'Hero Product', 'VALIDATION-MESSAGE' => 'Select a Hero Product', 'DATABASE-FIELD' => 'HERO-PRODUCT', 'DESCRIPTION' => 'Hero Product (will show image in boxes)', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE', 'WHERE' => '`IMAGE-FILENAME` != "" AND `ACTIVE` = "1"')),
															'BACKGROUND-IMAGE' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/backgrounds/', 'LABEL' => 'Background Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BACKGROUND-IMAGE', 'DESCRIPTION' => 'Category Background Image', 'FILE-TYPES' => array('png','jpg','jpeg','gif'))
													);
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['TABLE'] = 'PRODUCT-SUBGROUP'; // Table to Update
	$adminVariables['PRODUCT-SUBGROUP-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page	
	
	// Fields for Banner Management
	$adminVariables['BANNER-MANAGEMENT']['PAGE-TITLE'] = 'Banner Management';
	$adminVariables['BANNER-MANAGEMENT']['PAGE-FILE'] = 'banner-management';
	$adminVariables['BANNER-MANAGEMENT']['LABELER'] = 'Banner';
	$adminVariables['BANNER-MANAGEMENT']['CUSTOM-SCRIPT-ON-LOAD'] = 'true';
	$adminVariables['BANNER-MANAGEMENT']['DB-FIELDS'] = array('TITLE','TYPE','CLICK-THROUGH-URL','HTML-CONTENT','COLOR-CODE','ACTIVE');
	$adminVariables['BANNER-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['BANNER-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
	$adminVariables['BANNER-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['BANNER-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;
	$adminVariables['BANNER-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Banner Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Banner Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Banner Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Banner Title'),
															'TYPE' => array('TYPE' => 'select', 'LABEL' => 'Banner Type', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Select a Banner Type', 'DATABASE-FIELD' => 'TYPE', 'DESCRIPTION' => 'Type of Banner', 'DB-SELECT' => array('TABLE' => 'BANNER-TYPES', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID')),
															'COLOR-CODE' => array('TYPE' => 'text', 'LABEL' => 'Background Color Code', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'COLOR-CODE', 'DESCRIPTION' => 'Color Code'),
															'CLICK-THROUGH-URL' => array('TYPE' => 'text', 'LABEL' => 'Click through URL', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'CLICK-THROUGH-URL', 'DESCRIPTION' => 'Click Through URL', 'INITIAL-HIDE' => 'true'),
															'HTML-CONTENT' => array('TYPE' => 'wysiwyg', 'LABEL' => 'Banner Content', 'SETTINGS' => array('WIDTH' => 800, 'HEIGHT' => '160'), 'DATABASE-FIELD' => 'HTML-CONTENT', 'DESCRIPTION' => 'HTML Content of the Banner', 'INITIAL-HIDE' => 'true'),
															'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/banners/', 'LABEL' => 'Banner Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'INITIAL-HIDE' => 'true'),
															'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Banner', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Banner Active or Hidden from Website'));
	$adminVariables['BANNER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['BANNER-MANAGEMENT']['TABLE'] = 'BANNERS'; // Table to Update
	$adminVariables['BANNER-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page
	$adminVariables['BANNER-MANAGEMENT']['INCLUDE-FILES'] = array(
															array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS')
															 );	

	// Fields for Promo Codes Management
	$adminVariables['PROMO-MANAGEMENT']['PAGE-TITLE'] = 'Promo Code Management';
	$adminVariables['PROMO-MANAGEMENT']['PAGE-FILE'] = 'promo-management';
	$adminVariables['PROMO-MANAGEMENT']['LABELER'] = 'Promo Code';
	$adminVariables['PROMO-MANAGEMENT']['DB-FIELDS'] = array('TITLE','CODE','START-DATE','END-DATE','DISCOUNT-PERCENTAGE','FREE-TRANSPORT','ACTIVE','ONCE-ONLY');
	$adminVariables['PROMO-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['PROMO-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `START-DATE` "; // Ordering
	$adminVariables['PROMO-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['PROMO-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;
	$adminVariables['PROMO-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Promo Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Promo Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Promo Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Promo Title'),
															'CODE' => array('TYPE' => 'text', 'LABEL' => 'Promo Code', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Select a Promo Code', 'DATABASE-FIELD' => 'CODE', 'DESCRIPTION' => 'Promo Code', 'PLACEHOLDER' => 'Enter the Promo Code'),
															'START-DATE' => array('TYPE' => 'text', 'LABEL' => 'Start Date', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'START-DATE', 'DESCRIPTION' => 'Promo Start Date', 'PLACEHOLDER' => 'dd-mm-yyyy'),
															'END-DATE' => array('TYPE' => 'text', 'LABEL' => 'End Date', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'END-DATE', 'DESCRIPTION' => 'Promo End Date', 'PLACEHOLDER' => 'dd-mm-yyyy'),
															'DISCOUNT-PERCENTAGE' => array('TYPE' => 'text', 'LABEL' => 'Discount %', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DISCOUNT-PERCENTAGE', 'DESCRIPTION' => 'Discount %', 'PLACEHOLDER' => '%', 'STYLES' => array('width' => '100px')),
															'FREE-TRANSPORT' => array('TYPE' => 'checkbox', 'LABEL' => 'Free Transport', 'DATABASE-FIELD' => 'FREE-TRANSPORT', 'DESCRIPTION' => 'Free Transport'),
															'ONCE-ONLY' => array('TYPE' => 'checkbox', 'LABEL' => 'Once Only', 'DATABASE-FIELD' => 'ONCE-ONLY', 'DESCRIPTION' => 'Once Only'),
															'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Promo', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Promo Active or Hidden'));
	$adminVariables['PROMO-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['PROMO-MANAGEMENT']['TABLE'] = 'PROMO-CODES'; // Table to Update
	$adminVariables['PROMO-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page


	// Fields for Shipping Code Management
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['PAGE-TITLE'] = 'Shipping Code Management';
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['PAGE-FILE'] = 'shipping-code-management';
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['LABELER'] = 'Shipping Code';
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['DB-FIELDS'] = array('TITLE','CODE','VALUE');
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `CODE` "; // Ordering
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Shipping Code Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Shipping Code Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Shipping Code Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Shipping Code Title'),
															'CODE' => array('TYPE' => 'text', 'LABEL' => 'Shipping Code', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Shipping Code', 'DATABASE-FIELD' => 'CODE', 'DESCRIPTION' => 'Shipping Code', 'PLACEHOLDER' => 'Enter the Shipping Code'),
															'VALUE' => array('TYPE' => 'text', 'LABEL' => 'Shipping Value', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Shipping Value', 'DATABASE-FIELD' => 'VALUE', 'DESCRIPTION' => 'Shipping Value', 'PLACEHOLDER' => 'Enter the Shipping Value $'));
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['TABLE'] = 'SHIPPING-CODES'; // Table to Update
	$adminVariables['SHIPPING-CODE-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page

	
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