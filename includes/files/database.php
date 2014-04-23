<?php

// Make MySQL Database Connection

if( !$conn = mysql_connect( MYSQL_HOST , MYSQL_USERNAME , MYSQL_PASSWORD ) ) {
    
    echo ERROR_MESSAGE;

    exit;

} else {
	
    if( !mysql_select_db( MYSQL_DB ) ) {
        
		echo ERROR_MESSAGE;

        exit;
	
    }

}