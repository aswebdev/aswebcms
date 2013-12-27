<?php 
ini_set('session.gc_maxlifetime', 1200); // Session Lifetime in seconds
//ini_set('display_errors','On');
//ini_set('error_reporting',E_ALL);

session_start(); // Start a new Session

// Site Constants
/*
define('BASE_PATH',''); // Website Base Path /home2/somesite/public_html/ 
define('BASE_PATH_CMS',BASE_PATH.'ascms/'); // CMS Base Path /home2/somesite/public_html/xcms/
define('SITE_NAME',''); // Used in Meta Titles and Misc places on the website 
define('SITE_DESCRIPTION',''); // Used in Meta Descriptions on the website 
define('ERROR_MESSAGE','Sorry, we are having problems at the moment. Please come back later.'); // General Site Error Message
define('TECH_EMAIL',''); // Used for Database errors and debugging
define('BCC_EMAIL',''); // Used for Sending Emails to particular email addresses
define('MYSQL_USERNAME',''); // The MySQL Username
define('MYSQL_PASSWORD',''); // The MySQL Password
define('MYSQL_DB',''); // The MySQL Table
define('MYSQL_HOST',''); // The MySQL Host (usually 'localhost')
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
define('BASE_URL',PROTOCOL.'');
define('BASE_URL_CMS',PROTOCOL.'');
*/


require('define-local.php'); // Include / Exclude This for local testing. Constants may need to be updated for local locations
require('database.php'); // Include Database
require('functions.php'); // Include Functions
require('classes.php'); // Include Classes

?>