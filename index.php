<?php

include( 'includes/files/define.php' );

include( 'includes/files/header.php' );

$module = '';

if( isset( $_REQUEST['module'] ) ) { 
    
    $module = $_REQUEST['module']; 

} 

if( !empty( $_REQUEST['module'] ) ) {
    
	if( is_file( 'includes/modules/' . $module . '.php' ) ) {
        
		include( 'includes/modules/' . $module . '.php' );
	
    } else {
		
        include( 'includes/modules/home.php' ); //

    }
} else {
	
    include( 'includes/modules/home.php' ); 

}

include( 'includes/files/footer.php' );