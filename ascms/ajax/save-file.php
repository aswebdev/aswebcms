<?php

header('Content-type: application/json');

require('../../includes/files/define.php'); // Definition File

$arr = array();

$data = $_REQUEST['data'];

$filename = urldecode( $_REQUEST['filename'] );

$parts = explode( ',' , $data ); 

$arr['return'] = $parts[1];

$data = base64_decode( $parts[1] );

if( $data ) {
    
    // Save the Data to the server
    
    $file_dir = BASE_PATH . 'dev/img/' . $filename;
    
    file_put_contents( $file_dir , $data );
    
    // $arr['return'] = $file_dir;
    
} else {
    
    $arr['return']  = "No Data!"; 
    
}

// Encode and Do Output

$json = json_encode( $arr );

echo $json;

exit;