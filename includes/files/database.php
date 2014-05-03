<?php

// Make MySQL Database Connection

if( !$conn = mysql_connect( MYSQL_HOST , MYSQL_USERNAME , MYSQL_PASSWORD ) ) {
    
    header( 'Location:' . ERROR_PAGE  );

} else {
	
    if( !mysql_select_db( MYSQL_DB ) ) {
        
		header( 'Location:' . ERROR_PAGE  );
	
    }

}