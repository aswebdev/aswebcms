<?php
if($_POST['formAction'] == "login") { 
	if($conn) {
		$sql = "SELECT `USERNAME`,`PASSWORD`,`ID`,`EMAIL-ADDRESS` FROM `ADMIN-USERS` WHERE `USERNAME`=\"".mysql_real_escape_string($_POST['username'])."\" AND `PASSWORD`=\"".md5($_POST['password'])."\" AND `ACTIVE` = '1'";
		if($res = mysql_query($sql,$conn)) {
			if($res && mysql_num_rows($res) == 1) {
				$row = mysql_fetch_array($res); // Log In
				$_SESSION['USERNAME'] = $row['USERNAME'];
				$_SESSION['PASSWORD'] = $row['PASSWORD'];
				$_SESSION['EMAIL-ADDRESS'] = $row['EMAIL-ADDRESS'];
				$_SESSION['ID'] = $row['ID'];
				$userLoggedIn = true; // Set Logged In Variable to True
			} else {
				failedLogin('Login Does not Exist. Please try another login.'); // Fail, No Login
			}
		}
	} else {
		failedLogin('There is currently a problem accessing the database. Please try again later.');
	}
} elseif(isset($_SESSION['USERNAME']) && isset($_SESSION['PASSWORD'])) {
	if($conn) {
		$sql = "SELECT `ID` FROM `ADMIN-USERS` WHERE `USERNAME`=\"".mysql_real_escape_string($_SESSION['USERNAME'])."\" AND `PASSWORD`=\"".mysql_real_escape_string($_SESSION['PASSWORD'])."\" AND ACTIVE = '1'";
		if($res = mysql_query($sql,$conn)) {
			if($res && mysql_num_rows($res) == 1) {
				// logged in
				$row = mysql_fetch_array($res);
				$userLoggedIn = true; // Set Logged In Variable to True
			} else {
				failedLogin('Login Does not Exist. Please try another login.'); // Fail, No Login
			}			
		}
	} else {
		failedLogin('There is currently a problem accessing the database. Please try again later.'); // Fail, No Database
	}
} else {
	failedLogin();	
}
?>