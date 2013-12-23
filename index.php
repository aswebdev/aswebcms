<?php
include('includes/files/define.php'); // Include Definition File
include('includes/files/header.php'); // Include The Header
$module = '';
if(isset($_REQUEST['module'])) { $module = $_REQUEST['module']; } 
if(!empty($_REQUEST['module'])) {
	if(is_file('includes/modules/'.$module.'.php')) {
		include('includes/modules/'.$module.'.php'); // Include the Module
	} else {
		include('includes/modules/home.php'); // Error, Include the Home Module
	}
} else {
	include('includes/modules/home.php'); // Include the Home Module
}
include('includes/files/footer.php'); // Include Footer
?>