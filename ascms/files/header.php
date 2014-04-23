<!DOCTYPE html>
<html>
<head>
<title><?php echo SITE_NAME; ?> - Administration</title>
<meta http-equiv="cache-control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="msapplication-TileColor" content="#5bc0de">
<meta name="msapplication-TileImage" content="assets/img/metis-tile.png">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/style.css" />
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/main.css">
<script src="<?php echo BASE_URL_CMS_ASSETS; ?>js/modernizr.js"></script>
</head>
<body>
<div id="wrap">
<div id="top">
  <nav class="navbar navbar-inverse navbar-static-top"> 
    
    <!-- /.topnav -->
    <div class="collapse navbar-collapse navbar-ex1-collapse"> 
  
  <!-- header.head -->
  <header class="head">
    
    <!-- ."main-bar -->
    <div class="main-bar">
      <h3><i class="fa fa-home"></i> <?php echo SITE_NAME; ?></h3>
    </div>
    <!-- /.main-bar --> 
  </header>
  
  <!-- end header.head --> 
</div>
<div id="left">
  <!-- #menu -->
   <?php require( BASE_PATH_CMS . "files/menu.php" ); // Include the Main Nav Menu ?>
  <!-- /#menu --> 
</div>

<div id="content">
	<div class="outer">
    	<div class="inner">