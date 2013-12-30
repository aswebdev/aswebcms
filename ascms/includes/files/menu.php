<ul id="menu" class="collapse">

<?php
if($userLoggedIn == true) {
	// CMS Modules
	// Loop Modules Array
	
	echo "<li><a href=\"".BASE_URL_CMS."module.php?id=main\" title=\"Home\"><i class=\"fa fa-home\"></i>&nbsp;Home</a></li>";
	
	if(is_array($pageListVariables)) {
		foreach($pageListVariables as $pageId => $pageSettings) {
			$pageMatch = false; // Check if the loop matches the request. Bold the text and show the submenu
			$subItemsHtml = '';
			// Current Pages Matches Menu
			if($pageId == $moduleRequest) {
				$pageMatch = true;
				if(!isset($pageSettings['SHOW-SUBITEMS'])) { $pageSettings['SHOW-SUBITEMS'] = false; }
				if($pageSettings['SHOW-SUBITEMS'] == 'true') {				
					// Loop Pages
					$sql = "SELECT `".$VARS['DB-KEY']."`,`".$VARS['LABEL-FIELD']."` FROM `".$VARS['TABLE']."`";
					if(!empty($VARS['DB-QUALIFIER'])) {
						$sql .= $VARS['DB-QUALIFIER'];
					}
					if(!empty($VARS['DB-ORDERBY'])) {
						$sql .= $VARS['DB-ORDERBY'];
					}	
					if($res = mysql_query($sql,$conn)) {
						if(mysql_num_rows($res) > 0) {
							$subItemsHtml .= "<ul class=\"in\">\n";
							while($content = mysql_fetch_array($res)) {
								$subItemsHtml .= "<a href=\"".BASE_URL_CMS."module.php?module=".$VARS['PAGE-FILE']."&".$VARS['DB-KEY']."=".$content[$VARS['DB-KEY']]."\"><i class=\"fa\"></i>&nbsp;".$content[$VARS['LABEL-FIELD']]."</a>";
								if($content[$VARS['DB-KEY']] == $r[$VARS['DB-KEY']]) { 

								}								
							}
							$subItemsHtml .= "</ul>\n";
						}
					}
				}				
			}
			echo "<li ";
			if($pageMatch) {
				echo "class=\"active\"";
			}
			echo "><a href=\"".BASE_URL_CMS."module.php?module=".urlencode($pageId)."\" title=\"".htmlspecialchars($pageSettings['TITLE'])."\"><i class=\"fa\"></i>&nbsp;".$pageSettings['TITLE']."<span class=\"fa arrow\"></span> </a>";
			if(!empty($subItemsHtml)) { echo $subItemsHtml; }
			echo "</li>";
		}
	}
}
?>
</ul>