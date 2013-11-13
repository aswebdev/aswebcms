<?php
if($userLoggedIn == true) {
	// CMS Modules
	// Loop Modules Array
	
	if(is_array($pageListVariables)) {
		foreach($pageListVariables as $pageId => $pageSettings) {
			$pageMatch = false; // Check if the loop matches the request. Bold the text and show the submenu
			$subItemsHtml = '';
			// Current Pages Matches Menu
			if($pageId == $moduleRequest) {
				$pageMatch = true;
				if($pageSettings['SHOW-SUBITEMS'] == 'true') {				
					// Loop Pages
					$sql = "SELECT `".$VARS['DB-KEY']."`,`".$VARS['LABEL-FIELD']."` FROM `".$VARS['TABLE']."`";
					if(!empty($VARS['DB-QUALIFIER'])) {
						$sql .= $VARS['DB-QUALIFIER'];
					}
					if(!empty($VARS['DB-ORDERBY'])) {
						$sql .= $VARS['DB-ORDERBY'];
					}
					// Check if allowed to 'Add New Item'
					if(in_array('ADD',$VARS['FUNCTIONALITY'])) {
						$subItemsHtml .= "<div class=\"menuSubItem\">&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&add=true\"";
						if(isset($_REQUEST['add'])) { $setAdd = $_REQUEST['add']; }
						if($setAdd == 'true') { 
							$subItemsHtml .= " style=\"font-weight:bold;\" "; 
						}
						$subItemsHtml .= ">Add New ".$VARS['LABELER']."...</a>&nbsp;<span class=\"menusubIcon\">&gt;&gt;</span></div>\n";
					}		
					if($res = mysql_query($sql,$conn)) {
						while($content = mysql_fetch_array($res)) {
							$subItemsHtml .= "<div class=\"menuSubItem\">&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&".$VARS['DB-KEY']."=".$content[$VARS['DB-KEY']]."\"";
							if($content[$VARS['DB-KEY']] == $r[$VARS['DB-KEY']]) { 
								$subItemsHtml .= " style=\"font-weight:bold;\" "; 
							}
							$subItemsHtml .= ">".$content[$VARS['LABEL-FIELD']]."</a>&nbsp;<span class=\"menusubIcon\">&gt;&gt;</span></div>\n";
						}
					}
				}				
			}
			echo "<div class=\"menuItem\"><a href=\"".BASE_URL_CMS."module.php?module=".urlencode($pageId)."\" title=\"".htmlspecialchars($pageSettings['TITLE'])."\"";
			if($pageMatch) {
				echo "style=\"font-weight:bold;\"";
			}
			echo ">".$pageSettings['TITLE']."</a>&nbsp;<span class=\"menuIcon\">&gt;&gt;</span></div>\n";
			if(!empty($subItemsHtml)) { echo $subItemsHtml; }
		}
	}
}
?>