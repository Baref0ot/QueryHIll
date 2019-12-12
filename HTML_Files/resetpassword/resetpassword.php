<?php
 
  session_start();
  


?>
<?php 
include '../../classes/LoginRecoveryCredentials.php';
$resetpassword = new LoginRecoveryCredentials();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ResetPasswordForm'])){
    $updateusr2 = $resetpassword->resetPassword();
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Main page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
 
<body>

<div class="header">
<embed src="/HTML_Files/Pictures/Logo.svg" width="100" height="100" style="float:left"
	type="image/svg+xml"
	pluginspage="http://www.adobe.com/svg/viewer/install/" />
  <h1>Reset Password</h1>
  
</div>

<div class="topnav">
                   <a  href="../../index.php">Login </a>
</div>

<div class="row">
  
    <form action="" method="post">
     
     
 
		
	<!--<hr>!-->
	<div class="container" style= "margin-left:25%;"><!--style="width:100%;margin-left:25%;margin-right:39%;flex-direction:column"-->
 
		<label> Please provide your </label>
	    <label for="email"><b>Email Address:</b></label>
		<input type="text" name="email" size="80" /><br /><br />
        
        <label> Please provide your </label>
	    <label for="email"><b>New Password:</b></label>                                 
        <input type="password" name="password" size="80" /><br /> 
                                                        
        <label> Please provide your </label>
	    <label for="email"><b>Confirm Password:</b></label>                            
        <input type="password" name="confirmpassword" size="80" /><br />    
        <input type="hidden" name="q" value="<?php if (isset($_GET["q"])) {
	echo $_GET["q"];
}?>        "/>                                
                                                 
                                                 
                                                 
 
	
	</div>
 <div style="width:100%;margin-left:40%;margin-right:30%">
    <input type="submit" class="button" name="ResetPasswordForm" value=" Submit " />                                                     
	
 </div>
  <p><?php  if (isset($updateusr2)){echo $updateusr2;} ?></p>
 </form>
	<div class="w3-container">

	<div class="footer">
		<h2></h2>
	</div>

    </div>
</div>
</body>
</html>