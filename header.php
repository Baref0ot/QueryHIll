<?php
  //session_start(); //dont include
  if (!(isset($_SESSION['username']) || isset($_SESSION['role']) || isset($_SESSION['password']) || isset($_SESSION['id']))) {
   
    header("location: ../../../index.php ");
  } 
  include_once "../../../classes/TeacherControls.php";
 
?>

<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="teacherlog.css">

  <?php 
    //DONT need this comment code but keep in case
    
 /*if (isset($_GET['action']) && $_GET['action'] == "logout"){// if I get that 'action' from the form and if it = to "logout" from the form 
           header ("location: ../../../HTML_Files/logout.php");//calling from Teacher class the destory()
 }*/

?>




<body>

<div class="header">
<embed src="../../Pictures/Logo.svg" width="100" height="100" style="float:left"
type="image/svg+xml"
pluginspage="http://www.adobe.com/svg/viewer/install/" />
  <h1>The Quiz</h1>
  
</div>
    


<div class="topnav">
<!-- this is where if a user signs in from the teacher table !-->
    <?php
 $id =  $_SESSION['id'];
    

if ($id == true) {//if this is true he will display  the href links below
  
?>

    <li style="float:right"><a  href="../../logout.php">Logout </a></li>
     <a href="indextable.php">Student Info</a>
  <a href="createquestions.php">Create Quiz</a>
  <a href="choosechapter.php">View/Edit Quiz</a>
    <a href="profile.php?id=<?php //echo $id; ?>">Edit Profile </a>

  	
           <?php } if ($id == false) { echo "not logged in";} ?>
    </div>   
 


    </body>
</html>