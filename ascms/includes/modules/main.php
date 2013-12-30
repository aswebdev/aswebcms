<div class="box dark">
  <header>
    <h5>Welcome <i><?php echo htmlspecialchars($_SESSION['USERNAME']); ?></i></h5>
  </header>
  <div id="div-1" class="accordion-body collapse in body">
  
    <div class="text-center">
    <div class="alert alert-warning">Select from the Admin sections below or from the menu on the left</div>
    <a class="quick-btn" href="module.php?module=page-management" style="width:200px;"><i class="fa fa-file fa-2x"></i> <span>Page Manager</span></a>
    <a class="quick-btn" href="module.php?module=product-management" style="width:200px;"><i class="fa fa-headphones fa-2x"></i> <span>Products Manager</span></a>
    <a class="quick-btn" href="module.php?module=product-category-management" style="width:200px;"><i class="fa fa-list fa-2x"></i> <span>Product Category Manager</span></a>
    <a class="quick-btn" href="module.php?module=product-group-management" style="width:200px;"><i class="fa fa-list-alt fa-2x"></i> <span>Product Group Manager</span></a>
    <a class="quick-btn" href="module.php?module=customer-management" style="width:200px;"><i class="fa fa-group fa-2x"></i> <span>Customer Manager</span></a>
    <a class="quick-btn" href="module.php?module=banner-management" style="width:200px;"><i class="fa fa-puzzle-piece fa-2x"></i> <span>Banner Manager</span></a>
    </div>
  </div>
</div>
