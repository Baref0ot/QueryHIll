<?php
  // automatically unset the session if the user lands on this page. This causes the user to resign in if the hit the back button to "sign out".
  session_start();
  //session_unset();



?>
<?php 
include '../../classes/LoginRecoveryCredentials.php';
$requestingChange = new LoginRecoveryCredentials();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])){
    $updateusr2 = $requestingChange->sendingusernamebyemail();
 
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
  <h1>Recover Username</h1>
  
</div>

<div class="topnav">
                   <a  href="../../index.php">Login </a>
</div>

<div class="row">
  
    <form action="" method="POST">
     
     
 
		
	<!--<hr>!-->
	<div class="container" style= "margin-left:25%;"><!--style="width:100%;margin-left:25%;margin-right:39%;flex-direction:column"-->
 
		<label> Please provide your </label>
	<label for="email"><b>Email Address:</b></label>
		<input type="text" name="email" size="20" /><br>
 
	
	</div>
 <div style="width:100%;margin-left:40%;margin-right:30%">
    <input type="submit" class="button" name="ForgotPassword" value=" Submit " />                                                     
	
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