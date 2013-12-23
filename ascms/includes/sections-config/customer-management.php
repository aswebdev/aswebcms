<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['customer-management']['TITLE'] = 'Customer Management';

// Fields for Customers Management
$adminVariables['CUSTOMER-MANAGEMENT']['PAGE-TITLE'] = 'Customers Management';
$adminVariables['CUSTOMER-MANAGEMENT']['PAGE-FILE'] = 'customer-management';
$adminVariables['CUSTOMER-MANAGEMENT']['LABELER'] = 'Customer';
$adminVariables['CUSTOMER-MANAGEMENT']['DB-FIELDS'] = array('FIRST-NAME','LAST-NAME','EMAIL','CONTACT-PHONE','BILLING-ADDRESS-1','BILLING-ADDRESS-2','BILLING-SUBURB','BILLING-STATE','BILLING-POSTCODE','DELIVERY-ADDRESS-1','DELIVERY-ADDRESS-2','DELIVERY-INSTRUCTIONS','DELIVERY-SUBURB','DELIVERY-STATE','DELIVERY-POSTCODE','ACTIVE');
$adminVariables['CUSTOMER-MANAGEMENT']['DB-QUALIFIER'] = "";
$adminVariables['CUSTOMER-MANAGEMENT']['LABEL-FIELD'] = 'EMAIL';
$adminVariables['CUSTOMER-MANAGEMENT']['FORM-ELEMENTS'] = array(
														'FIRST-NAME' => array('TYPE' => 'text', 'LABEL' => 'First Name', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a First Name', 'DATABASE-FIELD' => 'FIRST-NAME', 'DESCRIPTION' => 'Customer First Name'),
														'LAST-NAME' => array('TYPE' => 'text', 'LABEL' => 'Last Name', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Last Name', 'DATABASE-FIELD' => 'LAST-NAME', 'DESCRIPTION' => 'Customer Last Name'),
														'EMAIL' => array('TYPE' => 'text', 'LABEL' => 'Email Address', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter an Email Address', 'DATABASE-FIELD' => 'EMAIL', 'DESCRIPTION' => 'Customer Email Address'),
														'PASSWORD' => array('TYPE' => 'password', 'LABEL' => 'Password', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'PASSWORD', 'DESCRIPTION' => 'Customer Login Password'),
														'CONTACT-PHONE' => array('TYPE' => 'text', 'LABEL' => 'Contact Phone Number', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Contact Phone Number', 'DATABASE-FIELD' => 'CONTACT-PHONE', 'DESCRIPTION' => 'Contact Phone Number'),
														'BILLING-ADDRESS-1' => array('TYPE' => 'text', 'LABEL' => 'Billing Address 1', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Address', 'DATABASE-FIELD' => 'BILLING-ADDRESS-1', 'DESCRIPTION' => 'Customer Billing Address 1'),
														'BILLING-ADDRESS-2' => array('TYPE' => 'text', 'LABEL' => 'Billing Address 2', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BILLING-ADDRESS-2', 'DESCRIPTION' => 'Customer Billing Address 2'),
														'BILLING-SUBURB' => array('TYPE' => 'text', 'LABEL' => 'Billing Suburb', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Suburb', 'DATABASE-FIELD' => 'BILLING-SUBURB', 'DESCRIPTION' => 'Customer Billing Suburb'),
														'BILLING-STATE' => array('TYPE' => 'select', 'LABEL' => 'Billing State', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Select a Billing State', 'DATABASE-FIELD' => 'BILLING-STATE', 'DESCRIPTION' => 'Customer Billing State', 'DB-SELECT' => array('TABLE' => 'STATES', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID')),
														'BILLING-POSTCODE' => array('TYPE' => 'text', 'LABEL' => 'Billing Postcode', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Billing Postcode', 'DATABASE-FIELD' => 'BILLING-POSTCODE', 'DESCRIPTION' => 'Customer Billing Postcode'),
														'BILLING-SAME-DELIVERY' => array('TYPE' => 'checkbox', 'LABEL' => 'Billing Same as Delivery', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'BILLING-AS-DELIVERY', 'DESCRIPTION' => 'Billing Same as Delivery'),															
														'DELIVERY-ADDRESS-1' => array('TYPE' => 'text', 'LABEL' => 'Delivery Address 1', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Address', 'DATABASE-FIELD' => 'DELIVERY-ADDRESS-1', 'DESCRIPTION' => 'Customer Delivery Address 1'),
														'DELIVERY-ADDRESS-2' => array('TYPE' => 'text', 'LABEL' => 'Delivery Address 2', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DELIVERY-ADDRESS-2', 'DESCRIPTION' => 'Customer Delivery Address 2'),
														'DELIVERY-INSTRUCTIONS' => array('TYPE' => 'text', 'LABEL' => 'Delivery Instructions', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'DELIVERY-INSTRUCTIONS', 'DESCRIPTION' => 'Delivery Instructions'),
														'DELIVERY-SUBURB' => array('TYPE' => 'text', 'LABEL' => 'Delivery Suburb', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Suburb', 'DATABASE-FIELD' => 'DELIVERY-SUBURB', 'DESCRIPTION' => 'Customer Delivery Suburb'),
														'DELIVERY-STATE' => array('TYPE' => 'select', 'LABEL' => 'Delivery State', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Select a Delivery State', 'DATABASE-FIELD' => 'DELIVERY-STATE', 'DESCRIPTION' => 'Customer Delivery State', 'DB-SELECT' => array('TABLE' => 'STATES', 'LABEL' => 'LABEL', 'IDENTIFIER' => 'ID')),
														'DELIVERY-POSTCODE' => array('TYPE' => 'text', 'LABEL' => 'Delivery Postcode', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Please Enter a Delivery Postcode', 'DATABASE-FIELD' => 'DELIVERY-POSTCODE', 'DESCRIPTION' => 'Customer Delivery Postcode'),
														'NEWSLETTER' => array('TYPE' => 'checkbox', 'LABEL' => 'Send Newsletter Emails', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'NEWSLETTER-EMAILS', 'DESCRIPTION' => 'Opt in for Newsletter Emails'),
														'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active', 'REQUIRED' => '', 'VALIDATION-MESSAGE' => '', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Active Customer')															
														);
$adminVariables['CUSTOMER-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['CUSTOMER-MANAGEMENT']['TABLE'] = 'CUSTOMERS'; // Table to Update
$adminVariables['CUSTOMER-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page


?>