<?php

header( 'Content-type: application/json' );

require( '../../includes/files/define.php' ); // Definition File

$file_details = '';

if( isset( $_REQUEST['fileDetails'] ) ) { $file_details = $_REQUEST['fileDetails']; }

if( $conn ) {
	
    // Explode Details

    $details_array = explode( '|' , $file_details );

    $field = $details_array[0];
    
    $id = $details_array[1];
    
    $section = $details_array[2];
    
    $page_vars = getPageVariables( $section ); // Get the ID of the Variables Configuration and Output 
    
    if( is_array( $page_vars ) ) {
	
        foreach( $page_vars as $pk => $pv ) {
		
            $VARS[ $pk ] = $pv;
		
        }
        
        if( is_array( $VARS['FORM-ELEMENTS'][ $field ] ) ) {
		  
            $save_dir = $VARS['FORM-ELEMENTS'][ $field ]['SAVE-DIRECTORY'];
            
            $db_field = $VARS['FORM-ELEMENTS'][ $field ]['DATABASE-FIELD'];
            
            $file_append = $VARS['FORM-ELEMENTS'][ $field ]['FILE-APPEND'];
            
            $file_path = BASE_PATH . $save_dir . $id . $file_append;
            
            $arr['DIR-RET'] = $VARS['FORM-ELEMENTS'][ $field ]['SAVE-DIRECTORY-DIST'];
            
            if( isset ( $VARS['FORM-ELEMENTS'][ $field ]['SAVE-DIRECTORY-DIST']  ) ) {
                
                // Has a distribution folder to remove items
                
                $file_path_dist = BASE_PATH . $VARS['FORM-ELEMENTS'][ $field ]['SAVE-DIRECTORY-DIST'] . $id . $file_append;
                
            }
            
            // Loop to find the correct image extenstion
            
            foreach( $image_file_upload_types as $im_file ) {
                
                if( is_file( $file_path . '.' . $im_file ) ) {
                    
                    unlink( $file_path . '.' . $im_file );
                    
                    if( isset( $file_path_dist ) ) {
                        
                        $arr['DIST-FILE'] = $file_path_dist . '.' . $im_file;
                        
                        unlink( $file_path_dist . '.' . $im_file );
                        
                    }
                    
                    $arr['RETURN'] = 'VALID';
                    
                    // Remove Alternate File Sizes
                    
                    if( is_array( $VARS['FORM-ELEMENTS'][ $field ]['ALTERNATE-UPLOAD-SIZES'] ) ) {
             
                        foreach( $VARS['FORM-ELEMENTS'][ $field ]['ALTERNATE-UPLOAD-SIZES'] as $alt_sizes ) {
                    
                            if( is_file( $file_path . '-' . $alt_sizes . '.' . $im_file ) ) {
                                
                                unlink( $file_path . '-' . $alt_sizes . '.' . $im_file );
                                
                                if( isset( $file_path_dist ) ) {
                        
                                    unlink( $file_path_dist . '-' . $alt_sizes . '.' . $im_file );
                        
                                }
                                
                            }
                    
                        }
                
                    }
                    
                }
                
            }

            
        }
        
        
        
    }
    
    
    
    // Do Query
    
    $sql = "UPDATE `{$VARS['TABLE']}` SET `{$db_field}` = '' WHERE `{$VARS['DB-KEY']}` = '" . mysql_real_escape_string( $id ) . "' ";
    
    if( mysql_query( $sql ) ) {

    }
}

// Encode and Do Output

$json = json_encode( $arr );

echo $json;

exit;