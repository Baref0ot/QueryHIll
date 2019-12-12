<?php
session_start();
include_once 'inc/header.php';

//include_once 'includes/'
TeacherControls::checkSession();
$user = new TeacherControls();
$_SESSION['username'] . "<br />";
$_SESSION['role'] . "<br />";
$_SESSION['password'] . "<br />";
$_SESSION['id'] . "<br />";
?>


<?php
$id = $_SESSION['id'];

if ($id == true) { //if this correct login is true based on their login data the DB will Welcome the teacher

     ?>
     <html>

     <body>
          <div>
               <div>
                    <h2 style="color:white;"><span>Welcome
                              <strong>

                                   <?php $name = $_SESSION['username'];
                                        if (isset($name)) {
                                             echo $name;
                                        }
                                        ?> </strong>

                         </span></h2>
               </div>

               <div>

                    <!--<form method="post" action="indextable.php">
     
     <input type="submit" value="Students Info">
        
</form>
    
<form method="post" action="createquestions.php">
     
     <input type="submit" value="Create Quiz">
        
</form>
    
<form method="post" action="choosechapter.php">
     
     <input type="submit" value="View/Edit Quiz">
        
</form> !-->
               </div>



               <!-- this will be used on another page!
<form method="post" action="viewquiz.php">
     
     <input type="submit" value="View/Edit Quiz">
        
</form>
    -->

          <?php }  ?>




          </div>

          <div class="footer">
               <p style="color:white;">&copy; <?php echo date("Y"); ?> QueryHill.com</p>
               <!--
                <p>&copy;<? //php echo date("Y");
                         ?>
                    Student Quiz Application -  A project created by Alex Maddox, Prachi Khare, Rachel Perry, Edri Torres and Matthew Wright.
                </p>
                -->
          </div>

     </body>



     </html>