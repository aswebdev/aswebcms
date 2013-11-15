<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['product-management']['TITLE'] = 'Product Group Management';

// Fields for Product Group Management
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-TITLE'] = 'Product Group Management';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['PAGE-FILE'] = 'product-group-management';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABELER'] = 'Product Group';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-FIELDS'] = array('TITLE');
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-QUALIFIER'] = "";
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['LABEL-FIELD'] = 'TITLE';
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FORM-ELEMENTS'] = array(
														'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Product Group Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Product Group Title')
														);
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['TABLE'] = 'PRODUCT-GROUPS'; // Table to Update
$adminVariables['PRODUCT-GROUP-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page

?>