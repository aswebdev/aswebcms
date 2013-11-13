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
<p><?php echo SITE_NAME; ?> Administration</p>
<?php

if(isset($_REQUEST['errorMsg'])) {
	echo "<p class=\"errorMsgRed\">".urldecode($_REQUEST['errorMsg'])."</p>";
}

?>
<p>Please login with your <strong>Username</strong> &amp; <strong>Password</strong></p>
<form action="module.php?id=main" method="post" name="formLogin">
<input type="hidden" name="formAction" value="login" />
<table border="0" cellspacing="5">
<tr align="left" valign="middle">
<td width="50%" align="right" valign="middle" class="pageHeader"><strong>Username:</strong></td>
<td width="50%" align="left" valign="middle"><input name="usernameGiftplayground" type="text" class="formText" id="username" /></td>
</tr>
<tr valign="middle">
<td width="50%" align="right" valign="middle" class="pageHeader"><strong>Password:</strong></td>
<td width="50%" align="left" valign="middle"><input name="password" type="password" class="formText" id="password" /></td>
</tr>
<tr>
<td width="50%" align="right" valign="middle">&nbsp;</td>
<td width="50%" align="left" valign="middle">
<input name="Submit" type="submit" class="formButton" value="Login" title="Login" />
</td>
</tr>
</table>
</form>
<?php
require(BASE_PATH_CMS."includes/files/footer.php");  // CMS Footer File
?>