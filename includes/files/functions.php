<?php

// Write to File Function
function writeToFile($file,$contents) {
	if(!$fh = fopen($file, 'w')) { return false; } // Open File
	if(!fwrite($fh, $contents)) { return false; } // Write File
	if(!fclose($fh)) { return false; } // Close File
	return true;
}

// SEO Friendly Filter Function
function seoUrl($string) {
    $string = strtolower($string); //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);  //Strip any unwanted characters
    $string = preg_replace("/[\s-]+/", " ", $string); // Clean multiple dashes or whitespaces
    $string = preg_replace("/[\s_]/", "-", $string); //Convert whitespaces and underscore to dash
    return $string;
}

// Execute a File
function executeFile($file) {
	$x = exec($file,$r);
	if(is_array($r)) {
		$msg .= "\n\n";				
		foreach($r as $s=>$t) { $msg .= $t."\n"; }
		$msg .= "\n\n";				
	}
	if(!empty($msg)) { return $msg; }
}

function dbSelect($select='`*`',$table=array(),$where=array(),$orderby=false,$limit=false) {
		
	// dbSelect 0.1, Created by AS
	// General Database Selection Function
		
	// initate variables
	$query = ''; // String to Setup query
	$return = ''; // The return array
	$rowsReturned = ''; // The Number of Rows Returned from the query
	$error = false; // Boolean. Has an error.
		
	// Validate Entries
	if(empty($table)) { return false; } // $table var is empty. Cannot complete query
		
	// Initiate Query
	$query = 'SELECT '.mysql_real_escape_string($select).' FROM ';
	if(is_array($table)) {
		foreach($table as $tableName) {
			$query .= '`'.mysql_real_escape_string($tableName).'`,'; // Add Tables Names to Query
		}
		$query = substr($query,0,-1); // Strip the Last Comma
	} else {
		$query .= '`'.mysql_real_escape_string($table).'`'; // Table var is a string. Add to Query
	}
		
	if($where) { $query .= ' WHERE '.$where; } // If has where condition
	if($orderby) { $query .= ' ORDER BY '.mysql_real_escape_string($orderby); } // If order by condition
	if($limit) { $query .= ' LIMIT '.mysql_real_escape_string($limit); } // If order by condition
		
	// Run the Query
	if($resource = mysql_query($query)) {
		$rowsReturned = mysql_num_rows($resource); // Check the Amount of Rows Returned
		if(mysql_num_rows($resource) > 0) {
			$return['rows'] = $rowsReturned;
			if($rowsReturned == 1) {
				$return['results'] = mysql_fetch_array($resource); // Returned Single Row of Results
			} else {
				// Has returned multiple results. Run Query to get them
				$return['results'] = array();
				while($rows = mysql_fetch_assoc($resource)) {
					// Put Rows into an Array
					foreach($rows as $row) {
						$return['results'][] = $row; // Return The Rows into an array
					}
				}
			}
		} else {
			$return['results'] = 0; // Has Return no results	
		}
	} else {
		$error = 'Query Error ('.$query.')'; // Error with MySQL Query
	}
	if(DEBUG == true) { if($error) { echo $error; exit; } } // Check for Error
	return $return; // Return the Array
}

// Get Page Variables from database
function getPageVariables($pageName='') {
	global $conn;
	
	if(empty($pageName)) { return false; } // No Page name
	// Do Select
	$sql = "SELECT `VALUES` FROM `SITE-CONFIG` WHERE `PAGE-NAME` = '".mysql_real_escape_string($pageName)."'";
	if($res = mysql_query($sql,$conn)) {
		if(mysql_num_rows($res) == 1) {
			$r = mysql_fetch_array($res);
			if(!empty($r['VALUES'])) {
				$variablesArray = json_decode($r['VALUES'],true);
				return $variablesArray;
			} else {
				return false; // No Values
			}
		} else {
			return false; // No Row
		}
	}
}

?>