<?php 

ini_set( 'session.gc_maxlifetime' , 1200 );

ini_set( 'display_errors' , 1 );

ini_set( 'error_reporting' , 'E_ALL' );

session_start();

// Definition of the site constants

define( 'DEV_MODE' , true ); // will work from the /dev/ folder rather than the /dist/ folder

define( 'BASE_PATH' , dirname(dirname(dirname(__FILE__))) . '/' );

define( 'BASE_PATH_CMS' , BASE_PATH . 'ascms/' ); // CMS Base Path

if( !isset( $_SESSION['BASE_PATH'] ) ) {
    
    // Used for external packages such as ckeditor & ckfinder

    $_SESSION['BASE_PATH'] = BASE_PATH; 
    
    $_SESSION['BASE_PATH_CMS'] = BASE_PATH_CMS;

    
}

if( !isset( $_SERVER['HTTPS'] ) ) { 
    
    $_SERVER['HTTPS'] = 'off'; 

}

if ( $_SERVER['HTTPS'] == "on" ) { 
	
    define( 'PROTOCOL' , 'https://' );
	
    $ssl = true;

} else {
	
    define( 'PROTOCOL' , 'http://' );
	
    $ssl = false;	

}

define( 'BASE_DOMAIN' , '192.168.0.6/~andrew/ASCMS/' );

define( 'BASE_URL' , PROTOCOL . BASE_DOMAIN );

define( 'BASE_URL_CMS' , PROTOCOL . BASE_DOMAIN . 'ascms/' );

if( !isset( $_SESSION['BASE_URL'] ) ) {
 
    // Used for external packages such as ckeditor & ckfinder
    
    $_SESSION['BASE_URL'] = BASE_URL; 
    
    $_SESSION['BASE_URL_CMS'] = BASE_URL_CMS;
    
}


if( DEV_MODE ) {
    
    define( 'BASE_URL_CMS_ASSETS' , PROTOCOL . BASE_DOMAIN . 'ascms/dev/' );
    
} else {
    
    define( 'BASE_URL_CMS_ASSETS' , PROTOCOL . BASE_DOMAIN . 'ascms/dist/' );
    
}

define( 'SITE_NAME' , 'AS WEB' );

define( 'SITE_DESCRIPTION' , 'AS WEB TEST DESCRIPTION');

define( 'ERROR_MESSAGE' , 'Sorry, we are having problems at the moment. Please come back later.' );

define( 'TECH_EMAIL' , 'andrew.schadendorff@gmail.com' ); // Used for Database errors and debugging

define( 'ADMIN_EMAIL' , 'andrew.schadendorff@gmail.com' ); // Used for Sending Emails to particular email addresses

define( 'MYSQL_USERNAME' , 'ascms_user' );

define( 'MYSQL_PASSWORD' , 'ascms_password' );

define( 'MYSQL_DB' , 'ascms' );

define( 'MYSQL_HOST' , '127.0.0.1' );

define( 'DEBUG' , false ); // Debugging of the website

define( 'ERROR_PAGE' , BASE_URL. '/404/' );

// Include the main files

require( 'database.php' ); 

require( 'functions.php' );

require( 'classes.php' );