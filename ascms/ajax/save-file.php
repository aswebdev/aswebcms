<?php

header('Content-type: application/json');

require('../../includes/files/define.php'); // Definition File

if( $_REQUEST['data'] ) {
    
    // Save the Data to the server
    
    file_put_contents( BASE_PATH . 'dev/img/' . $_REQUEST['filename'] , base64_decode( $_REQUEST['data'] ) );
     
} else {
    
    $arr['return']  = "No Data!"; 
    
}

// Encode and Do Output

$json = json_encode( $arr );

echo $json;

exit;