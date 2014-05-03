<?php

$adminVariables['PAGE-LIST']['banner-management']['TITLE'] = 'Banner Manager'; // Page Management Section File

$adminVariables['PAGE-LIST']['banner-management']['ICON'] = 'puzzle-piece'; // Page Management Icon

// Fields for Banner Management

$adminVariables['BANNER-MANAGEMENT']['PAGE-TITLE'] = 'Banner Manager';

$adminVariables['BANNER-MANAGEMENT']['PAGE-FILE'] = 'banner-management';

$adminVariables['BANNER-MANAGEMENT']['LABELER'] = 'Banner';

$adminVariables['BANNER-MANAGEMENT']['CUSTOM-SCRIPT-ON-LOAD'] = 'false';

$adminVariables['BANNER-MANAGEMENT']['DB-FIELDS'] = array('TITLE','CLICK-THROUGH-URL','ACTIVE');

$adminVariables['BANNER-MANAGEMENT']['DB-QUALIFIER'] = "";

$adminVariables['BANNER-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering

$adminVariables['BANNER-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';

$adminVariables['BANNER-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;

$adminVariables['BANNER-MANAGEMENT']['SEARCH-FIELDS'] = array('TITLE','IMAGE-FILENAME');

$adminVariables['BANNER-MANAGEMENT']['FORM-ELEMENTS'] = array(
    'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Banner Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Banner Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Banner Title. Will be used to identify the banner', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Banner Title'), 
    'CLICK-THROUGH-URL' => array('TYPE' => 'text', 'LABEL' => 'Banner Link', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'CLICK-THROUGH-URL', 'DESCRIPTION' => 'The URL where the banner will click through to. Use a full URL (e.g http://www.google.com/)', 'PLACEHOLDER' => 'Enter URL'),
    'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'dev/img/', 'LABEL' => 'Banner Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'FILE-APPEND' => '_BANNER') ,
    'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Banner', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Banner Active or Hidden from Website')
);

$adminVariables['BANNER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key

$adminVariables['BANNER-MANAGEMENT']['TABLE'] = 'BANNERS'; // Table to Update

$adminVariables['BANNER-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page

$adminVariables['BANNER-MANAGEMENT']['INCLUDE-FILES'] = array( array('TYPE' => 'JS', 'LOCATION' => 'packages/ckeditor/ckeditor.js', 'BASE' => 'CMS') );	

$adminVariables['BANNER-MANAGEMENT']['INCLUDE-FILES'] = array( 
    
	array('TYPE' => 'JS', 'LOCATION' => 'dist/packages/fancybox/jquery.fancybox.pack.js'),
    
	array('TYPE' => 'CSS', 'LOCATION' => 'dist/packages/fancybox/jquery.fancybox.css')
);  

$adminVariables['BANNER-MANAGEMENT']['LIST-VIEW'] = true; // Enables a complete list of Items at bottom

$adminVariables['BANNER-MANAGEMENT']['LIST-ITEMS'] = array('TITLE','IMAGE-FILENAME'); // The Structure of the List Table at the bottom