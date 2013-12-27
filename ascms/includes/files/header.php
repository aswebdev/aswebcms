<!DOCTYPE html>
<html>
<head>
<title><?php echo SITE_NAME; ?>- Administration</title>
<meta http-equiv="cache-control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="msapplication-TileColor" content="#5bc0de">
<meta name="msapplication-TileImage" content="assets/img/metis-tile.png">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_CMS; ?>includes/css/style.min.css" />
<link rel="stylesheet" href="<?php echo BASE_URL_CMS; ?>includes/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS; ?>includes/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS; ?>includes/css/main.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS; ?>includes/css/theme.css">
<script src="<?php echo BASE_URL_CMS; ?>includes/js/modernizr-build.min.js"></script>
</head>
<body>
<div id="wrap">
<div id="top">
  <nav class="navbar navbar-inverse navbar-static-top"> 
    
    <!-- Brand and toggle get grouped for better mobile display -->
    <header class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </header>
    <!-- /.topnav -->
    <div class="collapse navbar-collapse navbar-ex1-collapse"> 
      
      <!-- .nav -->
      <ul class="nav navbar-nav">
        <li> <a href="dashboard.html">Dashboard</a> </li>
        <li> <a href="table.html">Tables</a> </li>
        <li> <a href="file.html">File Manager</a> </li>
        <li class="dropdown "> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Form Elements <b class="caret"></b> </a>
          <ul class="dropdown-menu">
            <li> <a href="form-general.html">General</a> </li>
            <li> <a href="form-validation.html">Validation</a> </li>
            <li> <a href="form-wysiwyg.html">WYSIWYG</a> </li>
            <li> <a href="form-wizard.html">Wizard &amp; File Upload</a> </li>
          </ul>
        </li>
      </ul>
      <!-- /.nav --> 
    </div>
  </nav>
  <!-- /.navbar --> 
  
  <!-- header.head -->
  <header class="head">
    <div class="search-bar"> <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle"> <i class="fa fa-expand"></i> </a>
      <form class="main-search">
        <div class="input-group">
          <input type="text" class="input-small form-control" placeholder="Live Search ...">
          <span class="input-group-btn">
          <button class="btn btn-primary btn-sm text-muted" type="button"><i class="fa fa-search"></i></button>
          </span> </div>
      </form>
    </div>
    
    <!-- ."main-bar -->
    <div class="main-bar">
      <h3> <i class="fa fa-home"></i>Metis</h3>
    </div>
    <!-- /.main-bar --> 
  </header>
  
  <!-- end header.head --> 
</div>
<div id="left">
 
  <!-- #menu -->
   <?php require(BASE_PATH_CMS."includes/files/menu.php"); // Include the Main Nav Menu ?>
  <!-- /#menu --> 
</div>

<div id="content">
	<div class="outer">
    	<div class="inner">

<!--
<div id="searchPopup"> 
    <div id="searchContent">
    <span class="searchHeading">Search <?php echo SITE_NAME; ?> Administration</span>
    <input type="text" name="search" class="searchTerm" value="" placeholder="Enter a Search Term" autocomplete="off" /><br /><br />
	<input type="checkbox" name="searchProducts" id="searchProducts" value="1" checked="checked" />&nbsp;Search Products<br />
	<input type="checkbox" name="searchPages" id="searchPages" value="1" checked="checked" />&nbsp;Search Pages<br />
    <input type="checkbox" name="searchCustomers" id="searchCustomers" value="1" checked="checked" />&nbsp;Search Customers<br />
    <input type="checkbox" name="searchOrders" id="searchOrders" value="1" checked="checked" />&nbsp;Search Orders<br />
    <br />
	<div id="searchResults"></div>
    </div>
</div>

<div id="toPopup"> 
    <div id="popupContent"></div>
</div>
<div id="backgroundPopup"></div>



<div id="topNavigationBar">
	<div id="siteNameHeading"><?php echo SITE_NAME; ?> <span id="siteNameSubheading">Website Administration</span></div>
   	<?php if($userLoggedIn == true) { ?>
    <div id="searchIcon"><a href="<?php echo BASE_URL_CMS ?>includes/modules/search.php" class="searchButton" title="Search"><img src="<?php echo BASE_URL_CMS; ?>includes/img/dest/search-icon.png" border="0" /></a></div>
    <div id="logoutIcon"><a href="<?php echo BASE_URL_CMS ?>index.php?action=logout" class="logoutButton" title="Logout"><img src="<?php echo BASE_URL_CMS; ?>includes/img/dest/logout-icon.png" border="0" /></a></div>
	<div id="searchText">Search for Products &amp; Pages</div>
    <?php } ?>
    <div id="logoutText">Logout of Administration</div>
</div>
-->

