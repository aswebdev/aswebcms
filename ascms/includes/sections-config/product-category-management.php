<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['product-management']['TITLE'] = 'Product Category Management';

// Fields for Product Group Management
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-TITLE'] = 'Product Category Management';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-FILE'] = 'product-category-management';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABELER'] = 'Product Category';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-FIELDS'] = array('TITLE','PRODUCT-GROUP');
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-QUALIFIER'] = "";
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FORM-ELEMENTS'] = array(
														'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Group Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Group Title'),
														);
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['TABLE'] = 'PRODUCT-GROUPS'; // Table to Update
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page

?>