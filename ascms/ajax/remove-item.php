<?php

header('Content-type: application/json');
require('../../includes/files/define.php'); // Definition File

// Get Search Results from Request
$fileItem = '';
$fileDetails = '';

if(isset($_REQUEST['fileItem'])) { $fileItem = $_REQUEST['fileItem']; }
if(isset($_REQUEST['fileDetails'])) { $fileDetails = $_REQUEST['fileDetails']; }

if($conn) {
	$arr['FILE'] = $fileItem;
	
	$imageBaseFile = basename($fileItem);
	$fullPathFile = str_replace(BASE_URL,BASE_PATH,$arr['FILE']); // Make Full Path from URL
	$fullPath = str_replace($imageBaseFile,'',$fullPathFile); // Make Full Path from URL
	
	$arr['FULL_PATH'] = $fullPath;
	
	if(is_file($fullPathFile)) {
		$arr['RETURN'] = "VALID";
		
		// Explode Details
		$detailsArray = explode('|',$fileDetails);
		$table = $detailsArray[0];
		$row = $detailsArray[1];
		$identifier = $detailsArray[2];
		$key = $detailsArray[3];
		
		// Remove Main Image
		
		// Check for sizes and remove if exist
		$imageArray = explode('.',$imageBaseFile);
		if(defined(IMAGE_THUMB_SIZE)) {
			$imageFile = $imageArray[0].'-'.IMAGE_THUMB_SIZE.'.'.strtolower($imageArray[1]);		
			if(is_file($fullPath.$imageFile)) {
				unlink($fullPath.$imageFile);
			}
		}
		
		// Do Query
		$sql = "UPDATE `{$table}` SET `{$row}` = '' WHERE `{$key}` = '" . mysql_real_escape_string( $identifier ) . "' ";
		if(mysql_query($sql)) {
			
		}
	}
}

// Encode and Do Output
$json = json_encode($arr);
echo $json;
exit;