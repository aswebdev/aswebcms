<div class="box dark">
  <header>
    <h5>Welcome <i><?php echo htmlspecialchars($_SESSION['USERNAME']); ?></i></h5>
  </header>
  <div id="div-1" class="accordion-body collapse in body">
    <div class="text-center">
    <div class="alert alert-warning">Select from the Admin sections below or from the menu on the left</div>
    <?php
	if(is_array($pageListVariables)) {
		foreach($pageListVariables as $pageId => $pageSettings) {
			echo "<a class=\"quick-btn\" href=\"module.php?module=".urlencode($pageId)."\" style=\"width:200px;\"><i class=\"fa fa-".$pageSettings['ICON']." fa-2x\"></i> <span>".htmlspecialchars($pageSettings['TITLE'])."</span></a>";
		}
	}
	?>
    </div>
  </div>
</div>
