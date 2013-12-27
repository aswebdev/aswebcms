<!DOCTYPE html>
<html>
<head>
<title><?php echo SITE_NAME; ?> - Administration</title>
<meta http-equiv="cache-control" content="no-cache" />
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL_CMS; ?>includes/css/style.min.css" />
<script type="text/javascript" src="<?php echo BASE_URL_CMS; ?>includes/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL_CMS; ?>includes/js/scripts.min.js?<?php echo rand(0,5000); ?>"></script>
</head>
<body>

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

<div class="colmask leftmenu">
    <div class="colright">
        <div class="col1wrap">
            <div class="col1">