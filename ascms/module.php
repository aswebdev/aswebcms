<?php 

require( "../includes/files/define.php" ); // Definition File 

require( BASE_PATH_CMS . "files/validate.php" );  // CMS Validation File

// Get all of the Pages Associated with the Administration

$pageListVariables = getPageVariables( 'PAGE-LIST' );

// Check if we have a module

$moduleRequest = '';

if( isset( $_REQUEST['module'] ) ) { 
    
    $moduleRequest = $_REQUEST['module']; 

}

if( !empty( $moduleRequest ) ) {

    $pageVariables = getPageVariables( $moduleRequest ); // Get the ID of the Variables Configuration and Output 
	
	$isValidPage = false;

	if( is_array( $pageVariables ) ) {
        
		foreach( $pageVariables as $pk => $pv ) {
            
			$VARS[ $pk ] = $pv;
		
        }
        
		$isValidPage = true;
	
    }

}

require( BASE_PATH_CMS . "files/header.php" );  // CMS Header File

if( !empty( $moduleRequest ) ) {
    
	// Check has a module in the Query String
    
	if( is_file( BASE_PATH_CMS . 'modules/manager.php' ) ) {
	
        require( BASE_PATH_CMS . 'modules/manager.php' ); 
	
    }

} else {

    require( BASE_PATH_CMS . 'modules/main.php' ); // Go to Main

}

require( BASE_PATH_CMS . "files/footer.php" );  // CMS Footer File