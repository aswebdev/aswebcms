<?php 

// Set Vars
$userLoggedIn = false;

require("../includes/files/define.php"); // Definition File

// User is Logging Out. Reset Session.
if(isset($_REQUEST['action'])) {
	if($_REQUEST['action'] == 'logout') {
		$_SESSION = ''; // Empty Session
	}
}
 
require(BASE_PATH_CMS."includes/files/header.php");  // CMS Header File

?>
<div class="col-lg-6" style="margin:0 auto;float:none;">
<?php
// Error Message
if(isset($_REQUEST['errorMsg'])) {
	echo "<div class=\"alert alert-danger\" style=\"margin-top:10px;\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>".urldecode($_REQUEST['errorMsg'])."</div>";
}
?>
<div class="box dark">
  <header>
    <h5>Login to the Administration</h5>
  </header>
  <div id="div-1" class="accordion-body collapse in body">
    <form class="form-horizontal" action="module.php?id=main" method="post" name="formLogin" >
      <input type="hidden" name="formAction" value="login" />
      <div class="form-group">
        <label for="text1" class="control-label col-lg-4">Username</label>
        <div class="col-lg-4">
          <input type="text" name="username" placeholder="Enter Your Username Here" class="form-control">
        </div>
      </div>
      <!-- /.form-group -->
      <div class="form-group">
        <label for="pass1" class="control-label col-lg-4">Password</label>
        <div class="col-lg-4">
          <input class="form-control" type="password" id="pass1" data-original-title="Please use your secure password" data-placement="top" placeholder="Enter Your Password Here" name="password">
        </div>
      </div>
      <!-- /.form-group -->
      <!-- /.form-group -->
      <div class="form-group">
        <label for="login" class="control-label col-lg-4">&nbsp;</label>
        <div class="col-lg-8">
          <input type="submit" class="btn btn-primary btn-rect" value="Login" />
        </div>
      </div>
      <!-- /.form-group -->      
      
      
      
    </form>
  </div>
</div>
<?php
require(BASE_PATH_CMS."includes/files/footer.php");  // CMS Footer File
?>
