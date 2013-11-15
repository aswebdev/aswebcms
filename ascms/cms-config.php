<?php 

// This is the global configuration file for all of the cms configuration. Determines which pages are available within the CMS

// Include the Definition File
require('../includes/files/define.php');

if($conn) {

	$adminVariables = array(); // Set all the entries for Site and Page variables in the database
	
	// Page List Array. This is an array of the Sections that will be associated with the CMS
	// Initially, page-management, product-management and banner-management are available sections
	$sectionsArray = array(
		'page-management'
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
	
	
	
	
	// Fields for General Admin Pages
	/*
	$adminVariables['PAGE-LIST'] = array(
									'page-management' => array('TITLE' => 'Page Management', 'SHOW-SUBITEMS' => 'true'),
									'banner-management' => array('TITLE' => 'Banner Management', 'SHOW-SUBITEMS' => 'true'),
									'product-management' => array('TITLE' => 'Products Management'),
									'order-management' => array('TITLE' => 'Orders Management'),
									'customer-management' => array('TITLE' => 'Customer Management'),
									'product-category-management' => array('TITLE' => 'Product Category Management', 'SHOW-SUBITEMS' => 'true'),
									'product-group-management' => array('TITLE' => 'Product Group Management', 'SHOW-SUBITEMS' => 'true'),
									'product-subgroup-management' => array('TITLE' => 'Product Sub-Group Management', 'SHOW-SUBITEMS' => 'true'),
									'promo-management' => array('TITLE' => 'Promo Code Management', 'SHOW-SUBITEMS' => 'true'),
									'shipping-code-management' => array('TITLE' => 'Shipping Code Management', 'SHOW-SUBITEMS' => 'true')
									);
	*/

	// Fields for Products Management
	$adminVariables['PRODUCT-MANAGEMENT']['PAGE-TITLE'] = 'Products Management';
	$adminVariables['PRODUCT-MANAGEMENT']['PAGE-FILE'] = 'product-management';
	$adminVariables['PRODUCT-MANAGEMENT']['LABELER'] = 'Product';
	$adminVariables['PRODUCT-MANAGEMENT']['DB-FIELDS'] = array('TITLE','DESCRIPTION','GIFT-WRAPPING','NEW-PRODUCT','SELL-POINTS','YOUTUBE-LINK','PRODUCT-CATEGORY','PRODUCT-GROUP','PRODUCT-SUBGROUP','ACTIVE','MALE','FEMALE','RELATED-PRODUCT-1','RELATED-PRODUCT-2','RELATED-PRODUCT-3','RELATED-PRODUCT-4','UNAVAILABLE-FOR-PURCHASE','COMING-SOON','METRO-ONLY','IMAGE-FILENAME-CAPTION','IMAGE-FILENAME-CAPTION-2','IMAGE-FILENAME-CAPTION-3','IMAGE-FILENAME-CAPTION-4','IMAGE-FILENAME-CAPTION-5','IMAGE-FILENAME-CAPTION-6','IMAGE-FILENAME-CAPTION-7','IMAGE-FILENAME-CAPTION-8',);
	$adminVariables['PRODUCT-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['PRODUCT-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
	$adminVariables['PRODUCT-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['PRODUCT-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = true;
	$adminVariables['PRODUCT-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Product Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Product Title'),
															'NEW-PRODUCT' => array('TYPE' => 'checkbox', 'LABEL' => 'New Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'NEW-PRODUCT', 'DESCRIPTION' => 'Is a New Product?'),
															'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Is Active on the Site?'),
															'GIFT-WRAPPING' => array('TYPE' => 'checkbox', 'LABEL' => 'Gift Wrapping', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'GIFT-WRAPPING', 'DESCRIPTION' => 'Is the Product Gift Wrapped?'),
															'FEMALE' => array('TYPE' => 'checkbox', 'LABEL' => 'For Females', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'FEMALE', 'DESCRIPTION' => 'For Females?'),
															'MALE' => array('TYPE' => 'checkbox', 'LABEL' => 'For Males', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'MALE', 'DESCRIPTION' => 'For Males?'),														
															'UNAVAILABLE-FOR-PURCHASE' => array('TYPE' => 'checkbox', 'LABEL' => 'Unavailable for Purchase', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'UNAVAILABLE-FOR-PURCHASE', 'DESCRIPTION' => 'Product Unavailable for Purchase'),
															'COMING-SOON' => array('TYPE' => 'checkbox', 'LABEL' => 'Coming Soon', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'COMING-SOON', 'DESCRIPTION' => 'Product Coming Soon'),	
															'METRO-ONLY' => array('TYPE' => 'checkbox', 'LABEL' => 'Metro Only?', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'METRO-ONLY', 'DESCRIPTION' => 'Metro Only Product'),	
															'PRODUCT-CATEGORY' => array('TYPE' => 'select', 'LABEL' => 'Product Category', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Category', 'DATABASE-FIELD' => 'PRODUCT-CATEGORY', 'DESCRIPTION' => 'Product Category', 'DB-SELECT' => array('TABLE' => 'PRODUCT-CATEGORIES', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
															'PRODUCT-GROUP' => array('TYPE' => 'select', 'LABEL' => 'Product Group', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Group', 'DATABASE-FIELD' => 'PRODUCT-GROUP', 'DESCRIPTION' => 'Product Group', 'DB-SELECT' => array('TABLE' => 'PRODUCT-GROUPS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
															'PRODUCT-SUBGROUP' => array('TYPE' => 'select', 'LABEL' => 'Product Sub-Group', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Product Sub-Group', 'DATABASE-FIELD' => 'PRODUCT-SUBGROUP', 'DESCRIPTION' => 'Product Sub-Group', 'DB-SELECT' => array('TABLE' => 'PRODUCT-SUBGROUP', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'ID')),
															'YOUTUBE-LINK' => array('TYPE' => 'text', 'LABEL' => 'You Tube URL', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'YOUTUBE-LINK', 'DESCRIPTION' => 'YouTube URL Link', 'PLACEHOLDER' => 'Enter the YouTube URL', 'STYLES' => array('width' => '400px')),
															'PDF-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'guides/products/', 'LABEL' => 'PDF Instructions', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'PDF-FILENAME', 'DESCRIPTION' => 'PDF Instructions', 'FILE-TYPES' => array('pdf')),
															'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500')),
															'IMAGE-FILENAME-CAPTION' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION', 'DESCRIPTION' => 'Image Caption', 'PLACEHOLDER' => 'Image Caption', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-2' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 1)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-2', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_A'),
															'IMAGE-FILENAME-CAPTION-2' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 2', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-2', 'DESCRIPTION' => 'Image Caption 2', 'PLACEHOLDER' => 'Image Caption 2', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-3' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 2)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-3', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_B'),
															'IMAGE-FILENAME-CAPTION-3' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 3', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-3', 'DESCRIPTION' => 'Image Caption 3', 'PLACEHOLDER' => 'Image Caption 3', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-4' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 3)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-4', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_C'),
															'IMAGE-FILENAME-CAPTION-4' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 4', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-4', 'DESCRIPTION' => 'Image Caption 4', 'PLACEHOLDER' => 'Image Caption 4', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-5' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 4)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-5', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_D'),
															'IMAGE-FILENAME-CAPTION-5' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 5', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-5', 'DESCRIPTION' => 'Image Caption 5', 'PLACEHOLDER' => 'Image Caption 5', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-6' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 5)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-6', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_E'),
															'IMAGE-FILENAME-CAPTION-6' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 6', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-6', 'DESCRIPTION' => 'Image Caption 6', 'PLACEHOLDER' => 'Image Caption 6', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-7' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 6)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-7', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_F'),
															'IMAGE-FILENAME-CAPTION-7' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 7', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-7', 'DESCRIPTION' => 'Image Caption 7', 'PLACEHOLDER' => 'Image Caption 7', 'STYLES' => array('width' => '400px')),
															'IMAGE-FILENAME-8' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/products/', 'LABEL' => 'Product Image Upload (Alt 7)', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-8', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'ALTERNATE-UPLOAD-SIZES' => array('100x100','195x157','400x350','700x500'), 'FILE-APPEND' => '_G'),
															'IMAGE-FILENAME-CAPTION-8' => array('TYPE' => 'text', 'LABEL' => 'Image Popup Caption 8', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME-CAPTION-8', 'DESCRIPTION' => 'Image Caption 8', 'PLACEHOLDER' => 'Image Caption 8', 'STYLES' => array('width' => '400px')),
															'RELATED-PRODUCT-1' => array('TYPE' => 'select', 'LABEL' => 'Related Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Related Product', 'DATABASE-FIELD' => 'RELATED-PRODUCT-1', 'DESCRIPTION' => 'Related Product', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE')),
															'RELATED-PRODUCT-2' => array('TYPE' => 'select', 'LABEL' => 'Related Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Related Product', 'DATABASE-FIELD' => 'RELATED-PRODUCT-2', 'DESCRIPTION' => 'Related Product', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE')),
															'RELATED-PRODUCT-3' => array('TYPE' => 'select', 'LABEL' => 'Related Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Related Product', 'DATABASE-FIELD' => 'RELATED-PRODUCT-3', 'DESCRIPTION' => 'Related Product', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE')),
															'RELATED-PRODUCT-4' => array('TYPE' => 'select', 'LABEL' => 'Related Product', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => 'Select a Related Product', 'DATABASE-FIELD' => 'RELATED-PRODUCT-4', 'DESCRIPTION' => 'Related Product', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE')),
															'SELL-POINTS' => array('TYPE' => 'wysiwyg', 'SETTINGS' => array('WIDTH' => 600, 'HEIGHT' => '300'), 'LABEL' => 'Selling Points', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'SELL-POINTS', 'DESCRIPTION' => 'Product Selling Points'),
															'DESCRIPTION' => array('TYPE' => 'wysiwyg', 'SETTINGS' => array('WIDTH' => 600, 'HEIGHT' => '300'), 'LABEL' => 'Product Description', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DESCRIPTION', 'DESCRIPTION' => 'Product Description'),														
															'PRICE-INC' => array('TYPE' => 'readonly', 'LABEL' => 'Price Inc GST', 'DATABASE-FIELD' => 'PRICE-INC', 'DESCRIPTION' => 'Price Inc GST', 'PRE-PEND-FIELD' => "$"),
															'PRICE-EX' => array('TYPE' => 'readonly', 'LABEL' => 'Price Ex GST', 'DATABASE-FIELD' => 'PRICE-EX', 'DESCRIPTION' => 'Price Ex GST', 'PRE-PEND-FIELD' => "$"),
															'CUBIC-VOL' => array('TYPE' => 'readonly', 'LABEL' => 'Cubic Volume', 'DATABASE-FIELD' => 'CUBIC-VOL', 'DESCRIPTION' => 'Cubic Volume')
															);
	$adminVariables['PRODUCT-MANAGEMENT']['DB-KEY'] = "PRODUCT-CODE"; // The Database Primary Key
	$adminVariables['PRODUCT-MANAGEMENT']['TABLE'] = 'PRODUCTS'; // Table to Update
	$adminVariables['PRODUCT-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE'); // Functionality for Page
	$adminVariables['PRODUCT-MANAGEMENT']['INCLUDE-FILES'] = array(
															array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS')
															 );


	// Fields for Customers Management
	$adminVariables['CUSTOMER-MANAGEMENT']['PAGE-TITLE'] = 'Customers Management';
	$adminVariables['CUSTOMER-MANAGEMENT']['PAGE-FILE'] = 'customer-management';
	$adminVariables['CUSTOMER-MANAGEMENT']['LABELER'] = 'Customer';
	$adminVariables['CUSTOMER-MANAGEMENT']['DB-FIELDS'] = array('FIRST-NAME','LAST-NAME','EMAIL','CONTACT-PHONE','BILLING-ADDRESS-1','BILLING-ADDRESS-2','BILLING-SUBURB','BILLING-STATE','BILLING-POSTCODE','DELIVERY-ADDRESS-1','DELIVERY-ADDRESS-2','DELIVERY-INSTRUCTIONS','DELIVERY-SUBURB','DELIVERY-STATE','DELIVERY-POSTCODE','PROMO-EMAILS','ACTIVE');
	$adminVariables['CUSTOMER-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['CUSTOMER-MANAGEMENT']['LABEL-FIELD'] = 'EMAIL';
	$adminVariables['CUSTOMER-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'FIRST-NAME' => array('TYPE' => 'text', 'LABEL' => 'First Name', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a First Name', 'DATABASE-FIELD' => 'FIRST-NAME', 'DESCRIPTION' => 'Customer First Name'),
															'LAST-NAME' => array('TYPE' => 'text', 'LABEL' => 'Last Name', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Last Name', 'DATABASE-FIELD' => 'LAST-NAME', 'DESCRIPTION' => 'Customer Last Name'),
															'EMAIL' => array('TYPE' => 'text', 'LABEL' => 'Email Address', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter an Email Address', 'DATABASE-FIELD' => 'EMAIL', 'DESCRIPTION' => 'Customer Email Address'),
															'PASSWORD' => array('TYPE' => 'password', 'LABEL' => 'Password', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'PASSWORD', 'DESCRIPTION' => 'Customer Login Password'),
															'CONTACT-PHONE' => array('TYPE' => 'text', 'LABEL' => 'Contact Phone Number', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Contact Phone Number', 'DATABASE-FIELD' => 'CONTACT-PHONE', 'DESCRIPTION' => 'Contact Phone Number'),
															'SEPARATOR1' => array('TYPE' => 'separator'),
															'BILLING-ADDRESS-1' => array('TYPE' => 'text', 'LABEL' => 'Billing Address 1', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Address', 'DATABASE-FIELD' => 'BILLING-ADDRESS-1', 'DESCRIPTION' => 'Customer Billing Address 1'),
															'BILLING-ADDRESS-2' => array('TYPE' => 'text', 'LABEL' => 'Billing Address 2', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BILLING-ADDRESS-2', 'DESCRIPTION' => 'Customer Billing Address 2'),
															'BILLING-SUBURB' => array('TYPE' => 'text', 'LABEL' => 'Billing Suburb', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Suburb', 'DATABASE-FIELD' => 'BILLING-SUBURB', 'DESCRIPTION' => 'Customer Billing Suburb'),
															'BILLING-STATE' => array('TYPE' => 'select', 'LABEL' => 'Billing State', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Select a Billing State', 'DATABASE-FIELD' => 'BILLING-STATE', 'DESCRIPTION' => 'Customer Billing State', 'DB-SELECT' => array('TABLE' => 'STATES', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID')),
															'BILLING-POSTCODE' => array('TYPE' => 'text', 'LABEL' => 'Billing Postcode', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Postcode', 'DATABASE-FIELD' => 'BILLING-POSTCODE', 'DESCRIPTION' => 'Customer Billing Postcode'),
															'SEPARATOR2' => array('TYPE' => 'separator'),
															'DELIVERY-ADDRESS-1' => array('TYPE' => 'text', 'LABEL' => 'Delivery Address 1', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Address', 'DATABASE-FIELD' => 'DELIVERY-ADDRESS-1', 'DESCRIPTION' => 'Customer Delivery Address 1'),
															'DELIVERY-ADDRESS-2' => array('TYPE' => 'text', 'LABEL' => 'Delivery Address 2', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DELIVERY-ADDRESS-2', 'DESCRIPTION' => 'Customer Delivery Address 2'),
															'DELIVERY-INSTRUCTIONS' => array('TYPE' => 'text', 'LABEL' => 'Delivery Instructions', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DELIVERY-INSTRUCTIONS', 'DESCRIPTION' => 'Delivery Instructions'),
															'DELIVERY-SUBURB' => array('TYPE' => 'text', 'LABEL' => 'Delivery Suburb', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Suburb', 'DATABASE-FIELD' => 'DELIVERY-SUBURB', 'DESCRIPTION' => 'Customer Delivery Suburb'),
															'DELIVERY-STATE' => array('TYPE' => 'select', 'LABEL' => 'Delivery State', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Select a Delivery State', 'DATABASE-FIELD' => 'DELIVERY-STATE', 'DESCRIPTION' => 'Customer Delivery State', 'DB-SELECT' => array('TABLE' => 'STATES', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID')),
															'DELIVERY-POSTCODE' => array('TYPE' => 'text', 'LABEL' => 'Delivery Postcode', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Postcode', 'DATABASE-FIELD' => 'DELIVERY-POSTCODE', 'DESCRIPTION' => 'Customer Delivery Postcode'),
															'SEPARATOR3' => array('TYPE' => 'separator'),
															'PROMO-EMAILS' => array('TYPE' => 'checkbox', 'LABEL' => 'Send Promotional Emails', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'PROMO-EMAILS', 'DESCRIPTION' => 'Sends the Customer Promotional Emails'),
															'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Active Customer')															
															);
	$adminVariables['CUSTOMER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['CUSTOMER-MANAGEMENT']['TABLE'] = 'CUSTOMERS'; // Table to Update
	$adminVariables['CUSTOMER-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page

	// Fields for Orders Management
	$adminVariables['ORDER-MANAGEMENT']['PAGE-TITLE'] = 'Order Management';
	$adminVariables['ORDER-MANAGEMENT']['PAGE-FILE'] = 'order-management';
	$adminVariables['ORDER-MANAGEMENT']['LABELER'] = 'Customer Reference';
	$adminVariables['ORDER-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['ORDER-MANAGEMENT']['CUSTOM-SCRIPT-ON-LOAD'] = 'true';
	$adminVariables['ORDER-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `DATE-SUBMITTED` "; // Ordering
	$adminVariables['ORDER-MANAGEMENT']['LABEL-FIELD'] = 'PICKING-SLIP';
	$adminVariables['ORDER-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'AUDIT-ID' => array('TYPE' => 'readonly', 'LABEL' => 'Payment Reference', 'DATABASE-FIELD' => 'AUDIT-ID', 'DESCRIPTION' => 'Payment Reference'),
															'PICKING-SLIP' => array('TYPE' => 'readonly', 'LABEL' => 'Customer Reference', 'DATABASE-FIELD' => 'PICKING-SLIP', 'DESCRIPTION' => 'Customer Reference')
															);
	$adminVariables['ORDER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['ORDER-MANAGEMENT']['TABLE'] = 'ORDERS'; // Table to Update
	//$adminVariables['ORDER-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE'); // Functionality for Page

	
	// Fields for Product Group Management
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-TITLE'] = 'Product Group Management';
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-FILE'] = 'product-group-management';
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABELER'] = 'Product Group';
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-FIELDS'] = array('TITLE','BACKGROUND-IMAGE','HERO-PRODUCT','ORDER');
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-QUALIFIER'] = "";
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FORM-ELEMENTS'] = array(
															'PRODUCT-GROUP-TITLE' => array('TYPE' => 'text', 'LABEL' => 'Product Group Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Group Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Group Title'),
															'HERO-PRODUCT' => array('TYPE' => 'select', 'LABEL' => 'Hero Product', 'VALIDATION-MESSAGE' => 'Select a Hero Product', 'DATABASE-FIELD' => 'HERO-PRODUCT', 'DESCRIPTION' => 'Hero Product (will show image in boxes)', 'DB-SELECT' => array('TABLE' => 'PRODUCTS', 'LABEL' => 'TITLE', 'IDENTIFIER' => 'PRODUCT-CODE', 'WHERE' => '`IMAGE-FILENAME` != "" AND `ACTIVE` = "1"')),
															'ORDER' => array('TYPE' => 'select', 'LABEL' => 'Order', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ORDER', 'DESCRIPTION' => 'Ordering', 'DB-SELECT' => array('TABLE' => 'ORDERING', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID', 'ORDERBY' => 'ID')),
															'BACKGROUND-IMAGE' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/backgrounds/', 'LABEL' => 'Background Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BACKGROUND-IMAGE', 'DESCRIPTION' => 'Category Background Image', 'FILE-TYPES' => array('png','jpg','jpeg','gif'))
													);
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['TABLE'] = 'PRODUCT-GROUPS'; // Table to Update
	$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page
	
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