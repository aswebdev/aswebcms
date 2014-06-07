<?php

header('Content-type: application/json');

require('../../includes/files/define.php'); // Definition File

// Get Search Results from Request

$file_details = '';

if( isset( $_REQUEST['fileDetails'] ) ) { $file_details = $_REQUEST['fileDetails']; }

if($conn) {
	
    // Explode Details

    $details_array = explode( '|' , $file_details );

    $field = $details_array[0];
    
    $id = $details_array[1];
    
    $section = $details_array[1];
    
    $page_vars = getPageVariables( $section ); // Get the ID of the Variables Configuration and Output 
	
    if( is_array( $page_vars ) ) {
	
        foreach( $page_vars as $pk => $pv ) {
		
            $VARS[ $pk ] = $pv;
		
        }
		
        if(is_array($VARS['FORM-ELEMENTS'][ $field ])) {
		  
            var save_dir = $VARS['FORM-ELEMENTS'][ $field ]['SAVE-DIRECTORY'];
            
            var db_field = $VARS['FORM-ELEMENTS'][ $field ]['DATABASE-FIELD'];
            
            var file_append = $VARS['FORM-ELEMENTS'][ $field ]['FILE-APPEND'];
            
            if( is_array( $VARS['FORM-ELEMENTS'][ $field ]['ALTERNATE-UPLOAD-SIZES'] ) ) {
             
                foreach( $VARS['FORM-ELEMENTS'][ $field ]['ALTERNATE-UPLOAD-SIZES'] ) {
                    
                    
                    
                }
                
            }
            
        }
    }
    
    // Do Query
    
    $sql = "UPDATE `{$table}` SET `{$row}` = '' WHERE `{$key}` = '" . mysql_real_escape_string( $identifier ) . "' ";
    
    if(mysql_query($sql)) {

    }
}

// Encode and Do Output
$json = json_encode($arr);
echo $json;
exit;