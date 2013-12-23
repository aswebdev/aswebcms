<?php

$adminVariables['PAGE-LIST']['banner-management']['TITLE'] = 'Banner Management'; // Page Management Section File

// Fields for Banner Management
$adminVariables['BANNER-MANAGEMENT']['PAGE-TITLE'] = 'Banner Management';
$adminVariables['BANNER-MANAGEMENT']['PAGE-FILE'] = 'banner-management';
$adminVariables['BANNER-MANAGEMENT']['LABELER'] = 'Banner';
$adminVariables['BANNER-MANAGEMENT']['CUSTOM-SCRIPT-ON-LOAD'] = 'true';
$adminVariables['BANNER-MANAGEMENT']['DB-FIELDS'] = array('TITLE','CLICK-THROUGH-URL','ACTIVE');
$adminVariables['BANNER-MANAGEMENT']['DB-QUALIFIER'] = "";
$adminVariables['BANNER-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
$adminVariables['BANNER-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['BANNER-MANAGEMENT']['DISPLAY-KEY-IN-LABEL'] = false;
$adminVariables['BANNER-MANAGEMENT']['FORM-ELEMENTS'] = array(
														'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Banner Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Banner Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Banner Title', 'STYLES' => array('width' => '400px'), 'PLACEHOLDER' => 'Enter the Banner Title'),
														'CLICK-THROUGH-URL' => array('TYPE' => 'text', 'LABEL' => 'Click through URL', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'CLICK-THROUGH-URL', 'DESCRIPTION' => 'Click Through URL', 'INITIAL-HIDE' => 'true'),
														'IMAGE-FILENAME' => array('TYPE' => 'upload', 'SAVE-DIRECTORY' => 'images/banners/', 'LABEL' => 'Banner Image Upload', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'IMAGE-FILENAME', 'DESCRIPTION' => 'Product Image File (JPEG, PNG or GIF file)', 'FILE-TYPES' => array('png','jpg','jpeg','gif'), 'INITIAL-HIDE' => 'true'),
														'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Banner', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Banner Active or Hidden from Website'));
$adminVariables['BANNER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['BANNER-MANAGEMENT']['TABLE'] = 'BANNERS'; // Table to Update
$adminVariables['BANNER-MANAGEMENT']['FUNCTIONALITY'] = array('ADD','UPDATE','DELETE'); // Functionality for Page
$adminVariables['BANNER-MANAGEMENT']['INCLUDE-FILES'] = array( array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS') );	


?>