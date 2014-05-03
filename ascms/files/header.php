<!DOCTYPE html>
<html>
<head>
<title><?php echo SITE_NAME; ?> - Administration</title>
<meta http-equiv="cache-control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/style.css" />
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo BASE_URL_CMS_ASSETS; ?>css/main.css">
<?php

if(!isset($VARS['INCLUDE-FILES'])) { $VARS['INCLUDE-FILES'] = ''; }

if(is_array($VARS['INCLUDE-FILES'])) {
	
	foreach($VARS['INCLUDE-FILES'] as $includesArray) {
        
        
        
        if( !isset( $includesArray['BASE'] ) ) { $includesArray['BASE'] = ''; }
		
        if( $includesArray['BASE'] == 'CMS' ) { $baseURL = BASE_URL_CMS; } else { $baseURL = BASE_URL; }
		
        switch( $includesArray['TYPE'] ) {
		
            case 'CSS':
            
				echo "<link rel='stylesheet' href='" . $baseURL . $includesArray['LOCATION'] . "?" . rand(1000,5000) . "'>";
			
            break;
		
        }
	
    }

}


?>  
<script src="<?php echo BASE_URL_CMS_ASSETS; ?>js/modernizr.js"></script>
</head>
<body>
<div id="wrap">
<div id="top">
<nav class="navbar">
<!-- /.topnav -->
<div class="collapse navbar-collapse navbar-ex1-collapse"> 

  <!-- header.head -->
  <header class="head"> 
    <?php if( $userLoggedIn == true ) { ?>
    <div class="search-bar">
		<a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle"><i class="fa fa-expand"></i></a>
		<form class="main-search" action="<?php echo BASE_URL_CMS; ?>module.php?module=search" method="post">
		<div class="input-group">
			<input type="text" name="searchterm" class="input-small form-control" placeholder="Search">
			<span class="input-group-btn"><button class="btn btn-primary btn-sm text-muted" type="submit"><i class="fa fa-search"></i></button></span>
		</div>
		</form>
	</div>
    <?php } ?>
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
  <?php require( BASE_PATH_CMS . "files/menu.php"); // Include the Main Nav Menu ?>
  <!-- /#menu --> 
</div>
<div id="content">
<div class="outer">
<div class="inner">