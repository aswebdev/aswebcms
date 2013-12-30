<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['product-category-management']['TITLE'] = 'Product Category Manager';
$adminVariables['PAGE-LIST']['product-category-management']['ICON'] = 'list';

// Fields for Product Group Management
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['PAGE-TITLE'] = 'Product Category Management';
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['PAGE-FILE'] = 'product-category-management';
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['LABELER'] = 'Product Category';
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-FIELDS'] = array('TITLE','PRODUCT-CATEGORY');
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-QUALIFIER'] = "";
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['FORM-ELEMENTS'] = array(
														'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Category Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Category Title'),
														);
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['TABLE'] = 'PRODUCT-CATEGORIES'; // Table to Update
$adminVariables['PRODUCT-CATEGORY-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page

?>