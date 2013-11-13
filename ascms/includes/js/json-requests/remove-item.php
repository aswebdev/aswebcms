<?php

header('Content-type: application/json');
require('../../../../includes/files/define.php'); // Definition File

// Get Search Results from Request
$fileItem = '';
$fileDetails = '';

if(isset($_REQUEST['fileItem'])) { $fileItem = $_REQUEST['fileItem']; }
if(isset($_REQUEST['fileDetails'])) { $fileDetails = $_REQUEST['fileDetails']; }

if($conn) {
	$imageBaseFile = basename($fileItem);
	$fullPathFile = str_replace(BASE_URL,BASE_PATH,$arr['FILE']); // Make Full Path from URL
	$fullPath = str_replace($imageBaseFile,'',$fullPathFile); // Make Full Path from URL
	
	$arr['FULL_PATH'] = $fullPath;
	
	if(is_file($fullPathFile)) {
		
		// Explode Details
		$detailsArray = explode('|',$fileDetails);
		$table = $detailsArray[0];
		$row = $detailsArray[1];
		$identifier = $detailsArray[2];
		$key = $detailsArray[3];
		
		// Remove Main Image
		unlink($fullPathFile);
		
		// Do Query
		$sql = "UPDATE `{$table}` SET `{$row}` = '' WHERE `{$key}` = '".mysql_real_escape_string($identifier)."' ";
		if(mysql_query($sql,$conn)) {
			$arr['RETURN'] = "VALID";
		}
	}
}

// Encode and Do Output
$json = json_encode($arr);
echo $json;
exit;

?>