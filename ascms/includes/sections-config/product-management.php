<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['product-management']['TITLE'] = 'Products Management';

// Fields for Products Management
$adminVariables['PRODUCT-MANAGEMENT']['PAGE-TITLE'] = 'Products Management';
$adminVariables['PRODUCT-MANAGEMENT']['PAGE-FILE'] = 'product-management';
$adminVariables['PRODUCT-MANAGEMENT']['LABELER'] = 'Product';
$adminVariables['PRODUCT-MANAGEMENT']['DB-FIELDS'] = array('TITLE','DESCRIPTION','PRODUCT-CATEGORY','ACTIVE','KEY-FEATURES','PRODUCT-GROUP','PRICE');
$adminVariables['PRODUCT-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
$adminVariables['PRODUCT-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['PRODUCT-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = true;
$adminVariables['PRODUCT-MANAGEMENT']['FORM-ELEMENTS'] = array(
	'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Product Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Product Title'),
	'PRODUCT-SKU' => array('TYPE' => 'text', 'LABEL' => 'Product SKU', 'DATABASE-FIELD' => 'PRODUCT-SKU', 'DESCRIPTION' => 'Product Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Product Title'),
	'SHORT-DESCRIPTION' => array('TYPE' => 'textarea', 'SETTINGS' => array('WIDTH' => 600, 'HEIGHT' => '300'), 'LABEL' => 'Product Description', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'SHORT-DESCRIPTION', 'DESCRIPTION' => 'Product Description'),														
	'KEY-FEATURES' => array('TYPE' => 'textarea', 'SETTINGS' => array('WIDTH' => 600, 'HEIGHT' => '300'), 'LABEL' => 'Key Features', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'KEY-FEATURES', 'DESCRIPTION' => 'Key Features - Separate with new Line'),														
	'PRODUCT-CATEGORY' => array('TYPE' => 'select', 'LABEL' => 'Product Category', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Category', 'DATABASE-FIELD' => 'PRODUCT-CATEGORY', 'DESCRIPTION' => 'Product Category', 'DB-SELECT' => array('TABLE' => 'PRODUCT-CATEGORIES', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
	'DOCUMENT-UPLOAD' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'uploads/products/', 'LABEL' => 'Document Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DOCUMENT-UPLOAD', 'DESCRIPTION' => 'Document Upload', 'FILE-TYPES' => array('pdf')),
	'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500')),
	'PRICE' => array('TYPE' => 'text', 'LABEL' => 'Price', 'DATABASE-FIELD' => 'PRICE', 'DESCRIPTION' => 'Price', 'PRE-PEND-FIELD' => "$"),
	'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Is Active on the Site?')
);
	$adminVariables['PRODUCT-MANAGEMENT']['DB-KEY'] = "PRODUCT-CODE"; // The Database Primary Key
	$adminVariables['PRODUCT-MANAGEMENT']['TABLE'] = 'PRODUCTS'; // Table to Update
	$adminVariables['PRODUCT-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE'); // Functionality for Page
	$adminVariables['PRODUCT-MANAGEMENT']['INCLUDE-FILES'] = array( array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS') );

?>