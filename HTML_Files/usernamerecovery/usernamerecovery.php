<?php
  
 //echo $_SESSION['email']=$_POST['email'];
 //echo $_SESSION['email'];
  // if the session variables are not set. Prevent access from this page, and go back to login page
 //if(!isset($_SESSION['email'])){
   // header('Location: ../../index.php');
  //}// end if

?>


<?php 
include '../classes/LoginRecoveryCredentials.php';
$requestingChange = new LoginRecoveryCredentials();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trueandfalse'])){

    
    $updateusr2 = $requestingChange->sendingusernamebyemail();
 echo $updateusr2;
}
?>