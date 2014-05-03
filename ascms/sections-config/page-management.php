<?php

// Page Management Section File
$adminVariables['PAGE-LIST']['page-management']['TITLE'] = 'Page Manager';
$adminVariables['PAGE-LIST']['page-management']['ICON'] = 'file';


// Fields for Page Management
$adminVariables['PAGE-MANAGEMENT']['PAGE-TITLE'] = 'Pages Management'; // Title of the Admin Section
$adminVariables['PAGE-MANAGEMENT']['PAGE-FILE'] = 'page-management'; // The Module Filename of the Section
$adminVariables['PAGE-MANAGEMENT']['LABELER'] = 'Page'; // Labeler of Section 'Save Page', 'Update Page'
$adminVariables['PAGE-MANAGEMENT']['DB-FIELDS'] = array('TITLE','DESCRIPTION','HTML-CONTENT','SEO-URL','ACTIVE'); // Fields to save in the database
$adminVariables['PAGE-MANAGEMENT']['DB-ORDERBY'] = " ORDER BY `TITLE` "; // Ordering
$adminVariables['PAGE-MANAGEMENT']['LABEL-FIELD'] = 'TITLE'; // Which Section 'Label' to show in the heading
$adminVariables['PAGE-MANAGEMENT']['FORM-ELEMENTS'] = array(
	'TITLE' => array('TYPE' => 'text', 'LABEL' => 'Page Title', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter the Page Title', 'DATABASE-FIELD' => 'TITLE', 'DESCRIPTION' => 'The Title of the Page (use between 100-200 Characters)', 'PLACEHOLDER' => 'Enter a Page Title'),
	'DECRIPTION' => array('TYPE' => 'textarea', 'LABEL' => 'Description', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter a Page Description', 'DATABASE-FIELD' => 'DESCRIPTION', 'PLACEHOLDER' => 'Enter a Description', 'DESCRIPTION' => 'The Description of the Page (use between 300-400 characters)'),
	'SEO-URL' => array('TYPE' => 'text-url', 'LABEL' => 'SEO URL', 'REQUIRED' => 'true', 'VALIDATION-MESSAGE' => 'Enter an SEO URL', 'DATABASE-FIELD' => 'SEO-URL', 'DESCRIPTION' => 'Enter the Search Engine safe URL that will be displayed (E.g /product-list/ or /about-us/)', 'PLACEHOLDER' => 'Enter a URL. Please have slashes at either end.'),
	'ACTIVE' => array('TYPE' => 'checkbox', 'LABEL' => 'Active Page', 'DATABASE-FIELD' => 'ACTIVE', 'DESCRIPTION' => 'Is the Page Active or Hidden from the website? Can be used to Show or Hide Promotional Pages'),
	'HTML-CONTENT' => array('TYPE' => 'wysiwyg', 'LABEL' => 'Page Content', 'SETTINGS' => array('WIDTH' => 600, 'HEIGHT' => '550'), 'DATABASE-FIELD' => 'HTML-CONTENT', 'DESCRIPTION' => 'HTML Content of the Page. This is the actual content which will be displayed on the Page.')
);
$adminVariables['PAGE-MANAGEMENT']['DB-KEY'] = "ID"; // The Database Primary Key
$adminVariables['PAGE-MANAGEMENT']['TABLE'] = 'CONTENT'; // Table to Update
$adminVariables['PAGE-MANAGEMENT']['FUNCTIONALITY'] = array('UPDATE','ADD','DELETE'); // Functionality for Page
$adminVariables['PAGE-MANAGEMENT']['INCLUDE-FILES'] = array(
	array('TYPE' => 'JS', 'LOCATION' => 'packages/ckeditor/ckeditor.js', 'BASE' => 'CMS'),
    array('TYPE' => 'JS', 'LOCATION' => 'packages/ckfinder/ckfinder.js', 'BASE' => 'CMS')
);



?>