<?php

require('../../../includes/files/define.php'); // Definition File

// Get Search Results from Request
$searchterm = '';
$searchProducts = '';
$searchPages = '';
$searchOrders = '';
$hasResults = false;
if(isset($_REQUEST['searchTerm'])) { $searchterm = $_REQUEST['searchTerm']; }
if(isset($_REQUEST['searchProducts'])) { $searchProducts = $_REQUEST['searchProducts']; }
if(isset($_REQUEST['searchPages'])) { $searchPages = $_REQUEST['searchPages']; }
if(isset($_REQUEST['searchCustomers'])) { $searchCustomers = $_REQUEST['searchCustomers']; }
if(isset($_REQUEST['searchOrders'])) { $searchOrders = $_REQUEST['searchOrders']; }

if($conn) {
	if((!empty($searchterm)) && (strlen($searchterm) > 3)) {
	
		// Check Products Database
		if($searchProducts == '1') {
			
			$sql = "SELECT `TITLE`,`PRODUCT-CODE`,`DESCRIPTION` FROM `PRODUCTS` 
					WHERE `TITLE` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `DESCRIPTION` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `PRODUCT-CODE` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `PRODUCT-CATEGORY` LIKE '%".mysql_real_escape_string($searchterm)."%'
					OR `PRODUCT-GROUP` LIKE '%".mysql_real_escape_string($searchterm)."%'
					OR `PRODUCT-SUBGROUP` LIKE '%".mysql_real_escape_string($searchterm)."%'
					LIMIT 10";
			
			if($res = mysql_query($sql,$conn)) {
				if(mysql_num_rows($res) > 0) {
					echo "<span class=\"searchHeading\">Product Results</span>\n";
					while($r = mysql_fetch_array($res)) {
						echo "<a href=\"module.php?module=product-management&PRODUCT-CODE=".urlencode($r['PRODUCT-CODE'])."\" title=\"".$r['TITLE']."\">".$r['PRODUCT-CODE']." - ".$r['TITLE']."</a><br />\n";
					}
					$hasResults = true;	
				}
			}		
		}
		
		// Check Pages Database
		if($searchPages == '1') {
			
			$sql = "SELECT `ID`,`TITLE`,`HTML-CONTENT`,`SEO-URL` FROM `CONTENT` 
					WHERE `TITLE` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `HTML-CONTENT` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `SEO-URL` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					LIMIT 10";
			if($res = mysql_query($sql,$conn)) {
				if(mysql_num_rows($res) > 0) {
					echo "<span class=\"searchHeading\">Pages Results</span>\n";
					while($r = mysql_fetch_array($res)) {
						echo "<a href=\"module.php?module=page-management&ID=".urlencode($r['ID'])."\" title=\"".$r['TITLE']."\">".$r['TITLE']." - ".BASE_URL.$r['SEO-URL']."/</a><br />\n";
					}
					$hasResults = true;	
				}
			}	
		}
		
		// Check Customers Database
		if($searchCustomers == '1') {
			$sql = "SELECT `ID`,`FIRST-NAME`,`LAST-NAME`,`USERNAME` FROM `CONTENT` 
					WHERE `FIRST-NAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `LAST-NAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `USERNAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `EMAIL` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					LIMIT 10";
			if($res = mysql_query($sql,$conn)) {
				if(mysql_num_rows($res) > 0) {
					echo "<span class=\"searchHeading\">Customer Results</span>\n";
					while($r = mysql_fetch_array($res)) {
						echo "<a href=\"module.php?module=customer-management&ID=".urlencode($r['ID'])."\" title=\"".$r['FIRST-NAME']." ".$r['LAST-NAME']."\">".$r['FIRST-NAME']." ".$r['LAST-NAME']." (".$r['EMAIL'].")</a><br />\n";
					}	
					$hasResults = true;	
				}
			}	
		}

		// Check Orders Database
		if($searchOrders == '1') {		
			$sql = "SELECT `ORDERS`.`ORDER-ID`,`CUSTOMERS`.`CUSTOMER-ID`,`CUSTOMERS`.`FIRST-NAME`,`CUSTOMERS`.`LAST-NAME`,`CUSTOMERS`.`EMAIL` FROM `ORDERS`,`CUSTOMERS`
					WHERE ( `ORDERS`.`ORDER-ID` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `CUSTOMERS`.`FIRST-NAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `CUSTOMERS`.`LAST-NAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `CUSTOMERS`.`USERNAME` LIKE '%".mysql_real_escape_string($searchterm)."%' 
					OR `CUSTOMERS`.`EMAIL` LIKE '%".mysql_real_escape_string($searchterm)."%' )
					AND `ORDERS`.`CUSTOMER-ID` = `CUSTOMERS`.`ID`
					LIMIT 10";
			if($res = mysql_query($sql,$conn)) {
				if(mysql_num_rows($res) > 0) {
					echo "<span class=\"searchHeading\">Order Results</span>\n";
					while($r = mysql_fetch_array($res)) {
						echo "<a href=\"module.php?module=order-management&ORDER-ID=".urlencode($r['ID'])."\" title=\"".$r['ORDER-ID']." - ".$r['FIRST-NAME']." ".$r['LAST-NAME']." (".$r['EMAIL'].") \">".$r['ORDER-ID']." - ".$r['FIRST-NAME']." ".$r['LAST-NAME']." (".$r['EMAIL'].")</a><br />\n";
					}	
					$hasResults = true;	
				}
			}	
		}
		
		// Check if has results
		if(!$hasResults) {
			echo "No Results Found.";	
		}
			
	} else {
		echo "No Results Found.";	
	}
} else {
	echo "Database currently unavailable.";	// No Database	
}


?>