<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['page-management']['TITLE'] = 'Page Management';

// Fields for Page Management
$adminVariables['PAGE-MANAGEMENT']['PAGE-TITLE'] = 'Pages Management'; // Title of the Admin Section
$adminVariables['PAGE-MANAGEMENT']['PAGE-FILE'] = 'page-management'; // The Module Filename of the Section
$adminVariables['PAGE-MANAGEMENT']['LABELER'] = 'Page'; // Labeler of Section 'Save Page', 'Update Page'
$adminVariables['PAGE-MANAGEMENT']['DB-FIELDS'] = array('TITLE','HTML-CONTENT','SEO-URL','DATE-MODIFIED','ACTIVE'); // Fields to save in the database
$adminVariables['PAGE-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
$adminVariables['PAGE-MANAGEMENT']['LABEL-FIELD'] = 'TITLE'; // Which Section 'Label' to show in the heading
$adminVariables['PAGE-MANAGEMENT']['FORM-ELEMENTS'] = array(
	'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Page Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Page Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'Page Title', 'STYLES' => array('width' => '370px'), 'PLACEHOLDER' => 'Enter a Page Title'),
	'DECRIPTION' => array('TYPE' => 'textarea', 'LABEL' => 'Description', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Page Description', 'DATABASE-FIELD' => 'DESCRIPTION', 'PLACEHOLDER' => 'Enter a Description'),
	'SEO-URL' => array('TYPE' => 'text-url', 'LABEL' => 'SEO URL', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter an SEO URL', 'DATABASE-FIELD' => 'SEO-URL', 'PLACEHOLDER' => 'page-name'),
	'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Page', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Page Active or Hidden from Website'),
	'HTML-CONTENT' => array('TYPE' => 'wysiwyg', 'LABEL' => 'Page Content', 'SETTINGS' => array('WIDTH' => 900, 'HEIGHT' => '550'), 'DATABASE-FIELD' => 'HTML-CONTENT', 'DESCRIPTION' => 'HTML Content of the Page')
);
$adminVariables['PAGE-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['PAGE-MANAGEMENT']['TABLE'] = 'CONTENT'; // Table to Update
$adminVariables['PAGE-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page
$adminVariables['PAGE-MANAGEMENT']['INCLUDE-FILES'] = array(
	array('TYPE' => 'JS', 'LOCATION' => 'includes/packages/ckeditor/ckeditor.js', 'BASE' => 'CMS')
);

?>