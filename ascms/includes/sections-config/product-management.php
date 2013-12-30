<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['product-management']['TITLE'] = 'Products Manager';
$adminVariables['PAGE-LIST']['product-management']['ICON'] = 'headphones';

// Fields for Products Management
$adminVariables['PRODUCT-MANAGEMENT']['PAGE-TITLE'] = 'Products Management';
$adminVariables['PRODUCT-MANAGEMENT']['PAGE-FILE'] = 'product-management';
$adminVariables['PRODUCT-MANAGEMENT']['LABELER'] = 'Product';
$adminVariables['PRODUCT-MANAGEMENT']['DB-FIELDS'] = array('TITLE','DESCRIPTION','PRODUCT-CATEGORY','ACTIVE','KEY-FEATURES','PRODUCT-GROUP','PRICE','PRODUCT-CODE');
$adminVariables['PRODUCT-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
$adminVariables['PRODUCT-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['PRODUCT-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;
$adminVariables['PRODUCT-MANAGEMENT']['FORM-ELEMENTS'] = array(
	'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Product Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'The Title of the Product', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Product Title'),
	'PRODUCT-CODE' => array('TYPE' => 'text', 'LABEL' => 'Product SKU', 'REQUIRED' => 'true', 'DATABASE-FIELD' => 'PRODUCT-CODE', 'DESCRIPTION' => 'This identifies Products on the site. Use a Random unique code for each product if not known (e.g PROD001)', 'PLACEHOLDER' => 'Enter the Product SKU Number', 'VALIDATION-MESSAGE' => 'Enter a Product SKU ID'),
	'DESCRIPTION' => array('TYPE' => 'textarea', 'LABEL' => 'Product Description', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DESCRIPTION', 'DESCRIPTION' => 'The Description for the Product'),														
	'KEY-FEATURES' => array('TYPE' => 'textarea', 'LABEL' => 'Key Features', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'KEY-FEATURES', 'DESCRIPTION' => 'Key Features of the Product (Separate Features with a new line)'),														
	'PRODUCT-CATEGORY' => array('TYPE' => 'select', 'LABEL' => 'Product Category', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Category', 'DATABASE-FIELD' => 'PRODUCT-CATEGORY', 'DESCRIPTION' => 'Category of the Product (if applicable)', 'DB-SELECT' => array('TABLE' => 'PRODUCT-CATEGORIES', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
	'PRODUCT-GROUP' => array('TYPE' => 'select', 'LABEL' => 'Product Group', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Group', 'DATABASE-FIELD' => 'PRODUCT-GROUP', 'DESCRIPTION' => 'Group of the Product (if applicable)', 'DB-SELECT' => array('TABLE' => 'PRODUCT-GROUPS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
	'DOCUMENT-UPLOAD' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'uploads/products/', 'LABEL' => 'Document Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DOCUMENT-UPLOAD', 'DESCRIPTION' => 'Document Upload', 'FILE-TYPES' => array('pdf')),
	'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100')),
	'PRICE' => array('TYPE' => 'text', 'LABEL' => 'Price', 'DATABASE-FIELD' => 'PRICE', 'DESCRIPTION' => 'Price of the Product (if appliable)', 'PRE-PEND-FIELD' => "$"),
	'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Is the Product Activate on the Site?')
);
	$adminVariables['PRODUCT-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['PRODUCT-MANAGEMENT']['TABLE'] = 'PRODUCTS'; // Table to Update
	$adminVariables['PRODUCT-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page
	$adminVariables['PRODUCT-MANAGEMENT']['INCLUDE-FILES'] = array( array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS') );

?>