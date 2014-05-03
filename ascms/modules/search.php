<div class="col-lg-12">
	<?php

	// Get the requested searchterm
	if(isset($_REQUEST['searchterm'])) {
		
		// Check if searchterm has multiple words
		if(!isset($_REQUEST['searchterm'])) { $_REQUEST['searchterm'] = ''; }
		if(stristr($_REQUEST['searchterm'],' ')) {
			$searchArr = explode(' ',strtolower($_REQUEST['searchterm']));
		} else {
			$searchArr[] = strtolower($_REQUEST['searchterm']);	
		}
		
		// Results Found Flag
		$resultsFound = '';
		$resultsContent = '';
		
		// get all the search results
		if(is_array($pageListVariables)) {
			foreach($pageListVariables as $pageId => $pageSettings) {
				
				$pageVariables = getPageVariables($pageId);
				if(is_array($pageVariables)) {
					foreach($pageVariables as $pk => $pv) {
						$VARS[$pk] = $pv;
					}
				}
				
				// Find the Searchable items and add to query
				if(!isset($VARS['SEARCH-FIELDS'])) { $VARS['SEARCH-FIELDS'] = ''; }
				if(!empty($VARS['SEARCH-FIELDS']) && is_array($VARS['SEARCH-FIELDS'])) {
					$sql = "SELECT * FROM `".$VARS['TABLE']."` WHERE (";
					foreach($VARS['SEARCH-FIELDS'] as $sf) {
						foreach($searchArr as $sa) {
							$sql .= "`".$sf."` LIKE '%".mysql_real_escape_string($sa)."%' OR ";
						}
					}
					$sql = substr($sql,0,-3).")";
					
					if($res = mysql_query($sql,$conn)) {
						if(mysql_num_rows($res) > 0) {
							// Results Found
							$resultsFound++;
							
							// Echo The Page Title
							$resultsContent .= "<div class=\"box dark\">";
							$resultsContent .= "<header>";
							$resultsContent .= "<h5>Results found in ".$VARS['LABELER']."</h5>\n";	
							$resultsContent .= "</header>";				
							$resultsContent .= "<div id=\"stripedTable\" class=\"body collapse in\">";
							$resultsContent .= "<table class=\"table table-striped responsive-table\">";
							$resultsContent .= "<thead><tr>";
							if(!isset($VARS['LIST-ITEMS'])) { $VARS['LIST-ITEMS'] = ''; }
							foreach($VARS['LIST-ITEMS'] as $li) {
								$resultsContent .= "<th>".$VARS['FORM-ELEMENTS'][$li]['LABEL']."</th>";
							}
							$resultsContent .= "</tr></thead>";				
							$content = '';
							$count = 0;
							while($content = mysql_fetch_array($res)) {
								if($count %2 == 0) { $class = 'even'; } else { $class = 'odd'; } // Row Class
								if(!isset($r[$VARS['DB-KEY']])) { $r[$VARS['DB-KEY']] = ''; }
								if(!isset($VARS['DISPLAY-KEY-IN-LABEL'])) { $VARS['DISPLAY-KEY-IN-LABEL'] = ''; }
								$resultsContent .= "<tr>";
								foreach($VARS['LIST-ITEMS'] as $li) {
									$resultsContent .= "<td><a href=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&".$VARS['DB-KEY']."=".urlencode($content[$VARS['DB-KEY']])."\">".$content[$li]."</a></td>";
								}
								$resultsContent .= "</tr>";
							}
							$resultsContent .= "</table>";
							$resultsContent .= "</div>";
							$resultsContent .= "</div>";
						}
					}
				}
			}
		}					
	}

	if(!$resultsFound) { 
		echo "<div class=\"alert alert-danger\" style=\"margin-top:10px;\">Sorry but no results have been found in the search</div>"; 
	} else {
		echo "<div class=\"alert alert-success\" style=\"margin-top:10px;\">Results have been found in $resultsFound section(s)</div>"; 
		echo $resultsContent;	
	}
	
	?>      
</div>