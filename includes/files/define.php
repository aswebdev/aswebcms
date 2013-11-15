<?php 
ini_set('session.gc_maxlifetime', 1200); // Session Lifetime in seconds

// Switch on/off for PHP error debugging
// ini_set('display_errors','On');
// ini_set('error_reporting',E_ALL);

session_start(); // Start a new Session

// Site Constants
define('BASE_PATH',''); // Website Base Path /home2/somesite/public_html/ 
define('BASE_PATH_CMS',BASE_PATH.'ascms/'); // CMS Base Path /home2/somesite/public_html/xcms/
define('SITE_NAME',''); // Used in Meta Titles and Misc places on the website 
define('SITE_DESCRIPTION',''); // Used in Meta Descriptions on the website 
define('ERROR_MESSAGE','Sorry, we are having problems at the moment. Please come back later.'); // General Site Error Message
define('TECH_EMAIL',''); // Used for Database errors and debugging
define('BCC_EMAIL',''); // Used for Sending Emails to particular email addresses
define('MYSQL_USERNAME',''); // The MySQL Username
define('MYSQL_PASSWORD',''); // The MySQL Password
define('MYSQL_TABLE',''); // The MySQL Table
define('MYSQL_HOST',''); // The MySQL Host (usually 'localhost')
define('DEBUG',false); // Switch on/off debugging during testing

// Check if Requesting Port 443 SSL. If so update the Protocol of the URL used across the website
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

// Main includes
require(BASE_PATH.'includes/files/database.php');
require(BASE_PATH.'includes/files/functions.php');

?>