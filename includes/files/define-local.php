<?php
// Site Constants
define('BASE_PATH','C:/Users/Andrew/aswebcms/'); // Website Base Path /home2/somesite/public_html/ 
define('BASE_PATH_CMS',BASE_PATH.'ascms/'); // CMS Base Path /home2/somesite/public_html/xcms/
define('SITE_NAME','AS WEB'); // Used in Meta Titles and Misc places on the website 
define('SITE_DESCRIPTION','AS WEB TEST DESCRIPTION'); // Used in Meta Descriptions on the website 
define('ERROR_MESSAGE','Sorry, we are having problems at the moment. Please come back later.'); // General Site Error Message
define('TECH_EMAIL','andrew.schadendorff@gmail.com'); // Used for Database errors and debugging
define('BCC_EMAIL',''); // Used for Sending Emails to particular email addresses
define('MYSQL_USERNAME','ascms'); // The MySQL Username
define('MYSQL_PASSWORD','rEVm|1T*kgGyrPV'); // The MySQL Password
define('MYSQL_DB','aswebcms'); // The MySQL Table
define('MYSQL_HOST','localhost'); // The MySQL Host (usually 'localhost')
define('DEBUG',false); // Switch on/off debugging during testing

// Check if Requesting Port 443 SSL. If so update the Protocol of the URL used across the website
if(!isset($_SERVER['HTTPS'])) { $_SERVER['HTTPS'] = 'off'; }

if ($_SERVER['HTTPS'] == "on") { 
	define('PROTOCOL','https://');
	$ssl = true;
} else {
	define('PROTOCOL','http://');
	$ssl = false;	
}

// Define the HTTP URLs used for the base URL of the site and the CMS
define('BASE_URL',PROTOCOL.'aswebcms.local/');
define('BASE_URL_CMS',PROTOCOL.'aswebcms.local/ascms/');
?>