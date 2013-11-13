<?php
// Make MySQL Database Connection
if(!$conn = mysql_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD)){
	// Error, no database connection
	echo ERROR_MESSAGE;
	exit;
} else {
	if(!mysql_select_db(MYSQL_TABLE)){
		// Error, no database table
		echo ERROR_MESSAGE;
		exit;
	}
}
?>