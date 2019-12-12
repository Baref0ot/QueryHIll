<?php
  session_start();

  // if the session variables are not set. Prevent access from this page, and go back to login page
  if(!(isset($_SESSION['id']) || isset($_SESSION['username']) || isset($_SESSION['password']) || isset($_SESSION['role']))){
    header('Location: ../../index.php');
  }// end if

  // check to see if the directory path to the needed file exist, if so the require it.
  $sPath = dirname(__File__, 3) . '/includes/AdminStudentManip.inc.php';
  $tPath = dirname(__FILE__, 3) . '/includes/AdminTeacherManip.inc.php';
  if($sPath && $tPath) { 
        require_once $sPath; 
        require_once $tPath;
  }// end if

  // property Object Globals
  global $student;
  global $teacher;
  // TextBox value property Globals
  global $theUniqueKey; $theUniqueKey = 0;
  global $theUserId; $theUserId = "";
  global $thePassword; $thePassword = "";
  global $theFirstName; $theFirstName = "";
  global $theMiddleName; $theMiddleName = "";
  global $theLastName; $theLastName = "";
  global $theSchoolName; $theSchoolName = "";
  global $theEmail; $theEmail = "";
  global $theRole; $theRole = "";
  // display Comfirmation Messages
  global $theMessage; $theMessage = "";



/*------------------------------------------------- The Students Manipulation ------------------------------------*/

  /** Selects a students information **/
  if(isset($_POST['StudentID_Textbox']) && isset($_POST['studentDB_Checkbox'])){ // check if the studentID_Text box has a value entered and the cooresponding checkbox is checked.
    if(isset($_POST['select_Submit_Button'])){
      // get the users input
      $entered_StudentUserID = $_POST['StudentID_Textbox'];
      // get view the student profile cooresponding with the entered student userID.
      $admin = new AdminStudentManip();
      if($student = $admin->viewStudentProfile($entered_StudentUserID)){
        // display the student data colected from the database and store them in variables
        $theUniqueKey = $student->getUnique_studentKey(); 
        $theUserId = $student->getStudentUserID();
        $thePassword = $student->getStudentPassword();
        $theFirstName = $student->getFirstName();
        $theMiddleName = $student->getMiddleName();
        $theLastName = $student->getLastName();
        $theSchoolName = $student->getSchoolName();
        $theEmail = $student->getEmail();
        $theRole = $student->getRole();
        // storing the uniqueID and the Username in session variables so that they stick around on after the search submit button is clicked.
        $_SESSION['theStudentUserID'] = $theUserId;
        $_SESSION['theStudentUniqueKey'] = $theUniqueKey;
        // display the message of what was done
        $theMessage = "A Student Was Selected";
      }// end if data was returned
      else{
        $theMessage = "<p style='color: red;'>No Student Was Found</p>";
      }// end else
    }// end if submit button was clicked
  }// end if student user Id input box and associated check box was checked


  /** Creates a new student **/
  if(isset($_POST['userID']) && isset($_POST['password']) && isset($_POST['first_Name']) && isset($_POST['middle_Name']) && isset($_POST['last_Name']) && isset($_POST['schoolName']) && isset($_POST['email']) && isset($_POST['role']) && $_POST['role'] == 'student'){
    if(isset($_POST['create_Button'])){
      // get the users Admin Input
      $theUserId = $_POST['userID'];
      $thePassword = md5($_POST['password']);
      $theFirstName = $_POST['first_Name'];
      $theMiddleName = $_POST['middle_Name'];
      $theLastName = $_POST['last_Name'];
      $theSchoolName = $_POST['schoolName'];
      $theEmail = $_POST['email'];
      $theMarks = 0.0;
      $theRole = $_POST['role'];
      // Add the entered information into the database.
      $admin = new AdminStudentManip();
      if($admin->addStudent($theUserId, $thePassword, $theFirstName, $theMiddleName, $theLastName, $theSchoolName, $theEmail, $theMarks, $theRole)){
        $theMessage = "<p style='color: Blue;'>New Student Successfully Created</p>";
      }// end if a student was successfully added to the databse.
      else{
        $theMessage = "<p style='color: Red;'>Student Not Created</p>";
      }// end else
    }// if the create button was clicked
  }// end if textboxes are set


  /** Updates the selected student **/
  if(isset($_POST['userID']) && isset($_POST['password']) && isset($_POST['first_Name']) && isset($_POST['middle_Name']) && isset($_POST['last_Name']) && isset($_POST['schoolName']) && isset($_POST['email']) && isset($_POST['role']) && $_POST['role'] == 'student'){
    if(isset($_POST['update_Button'])){
      $admin = new AdminStudentManip();
      // use the session variables to automatically access the same student that was originally selected so that the Admin can even update the students username if desired.
      $admin->viewStudentProfile($_SESSION['theStudentUserID'], $_SESSION['theStudentUniqueKey']);
      // The Desired updated data will be stored here until the Admin clicks the update button
      $student->setStudentUserID($_POST['userID']);
      $student->setStudentPassword(md5($_POST['password']));
      $student->setFirstName($_POST['first_Name']); 
      $student->setMiddleName($_POST['middle_Name']);
      $student->setLastName($_POST['last_Name']);
      $student->setSchoolName($_POST['schoolName']);
      $student->setEmail($_POST['email']); 
      $student->setGrade(0.0); 
      $student->setRole($_POST['role']); 
      //// Update the the database with altered information.
      if($admin->editStudentProfile()){
        $theMessage = "<p style='color: Blue;'>Student Updated Successfully</p>";
      }// end if a student was successfully added to the databse.
      else{
        $theMessage = "<p style='color: Red;'>Student Update Failed</p>";
      }// end else
    }// if the update button was clicked
  }// end if textboxes are set


  /** deletes a selected students information **/
  if(isset($_POST['userID']) && $_POST['role'] == 'student'){
    if(isset($_POST['delete_Button'])){
      $admin = new AdminStudentManip();
      // use the session variables to automatically access the same teacher that was originally selected so that the Admin can even update the teachers username if desired.
      $admin->viewStudentProfile($_SESSION['theStudentUserID'], $_SESSION['theStudentUniqueKey']);
      if($admin->deleteStudent()){
        $theMessage = "<p style='color: Blue;'>Student Successfully Deleted</p>";
      }// end if 
      else{
        $theMessage = "<p style='color: Red;'>Student Was Not Deleted</p>";
      }// end else
    }// end if delete button clicked
  }// end if



/*------------------------------------------------- The Teachers Manipulation ------------------------------------*/

/** Selects a teachers information **/
if(isset($_POST['TeacherID_Textbox']) && isset($_POST['teacherDB_Checkbox'])){ // check if the teacherID_Text box has a value entered and the cooresponding checkbox is checked.
    if(isset($_POST['select_Submit_Button'])){
      // get the users input
      $entered_TeacherUserID = $_POST['TeacherID_Textbox'];
      // get view the teacher profile cooresponding with the entered student userID.
      $admin = new AdminTeacherManip();
      if($teacher = $admin->viewTeacherProfile($entered_TeacherUserID)){
        // display the student data colected from the database and store them in variables
        $theUniqueKey = $teacher->getUniqueID();
        $theUserId = $teacher->getuserName();
        $thePassword = $teacher->getPassword();
        $theFirstName = $teacher->getFirstName();
        $theMiddleName = $teacher->getMiddleName();
        $theLastName = $teacher->getLastName();
        $theSchoolName = $teacher->getSchoolName();
        $theEmail = $teacher->getEmail();
        $theRole = $teacher->getRole();
        // storing the uniqueID and the Username in session variables so that they stick around on after the search submit button is clicked.
        $_SESSION['theTeacherUserID'] = $theUserId;
        $_SESSION['theTeacherUniqueKey'] = $theUniqueKey;
        // display the message of what was done
        $theMessage = "An Instructor Was Selected";
      }// end if data was returned
      else{
        $theMessage = "<p style='color: red;'>No Instructor Was Found</p>";
      }// end else
    }// end if submit button was clicked
  }// end if user Id input box and associated check box was checked


  /** Creates a new teacher **/
  if(isset($_POST['userID']) && isset($_POST['password']) && isset($_POST['first_Name']) && isset($_POST['middle_Name']) && isset($_POST['last_Name']) && isset($_POST['schoolName']) && isset($_POST['email']) && isset($_POST['role']) && $_POST['role'] == 'teacher'){
    if(isset($_POST['create_Button'])){
      // get the users Admin Input
      $theUserId = $_POST['userID'];
      $theFirstName = $_POST['first_Name'];
      $theMiddleName = $_POST['middle_Name'];
      $theLastName = $_POST['last_Name'];
      $theEmail = $_POST['email'];
      $thePassword = md5($_POST['password']);
      $theSchoolName = $_POST['schoolName'];
      $theRole = $_POST['role'];
      // Add the entered information into the database.
      $admin = new AdminTeacherManip();
      if($admin->addTeacher($theUserId, $theFirstName, $theMiddleName, $theLastName, $theEmail, $thePassword, $theSchoolName, $theRole)){
        $theMessage = "<p style='color: Blue;'>New Instructor Successfully Created</p>";
      }// end if a student was successfully added to the databse.
      else{
        $theMessage = "<p style='color: Red;'>Instructor Not Created</p>";
      }// end else
    }// if the create button was clicked
  }// end if textboxes are set

    /** Updates the selected teacher **/
    if(isset($_POST['userID']) && isset($_POST['password']) && isset($_POST['first_Name']) && isset($_POST['middle_Name']) && isset($_POST['last_Name']) && isset($_POST['schoolName']) && isset($_POST['email']) && isset($_POST['role']) && $_POST['role'] == 'teacher'){
      if(isset($_POST['update_Button'])){
        $admin = new AdminTeacherManip();
        // use the session variables to automatically access the same teacher that was originally selected so that the Admin can even update the teachers username if desired.
        $admin->viewTeacherProfile($_SESSION['theTeacherUserID'], $_SESSION['theTeacherUniqueKey']);
        // The Desired updated data will be stored here until the Admin clicks the update button
        $teacher->setuserName($_POST['userID']);
        $teacher->setPassword(md5($_POST['password'])); 
        $teacher->setFirstName($_POST['first_Name']); 
        $teacher->setMiddleName($_POST['middle_Name']);
        $teacher->setLastName($_POST['last_Name']);
        $teacher->setSchoolName($_POST['schoolName']);
        $teacher->setEmail($_POST['email']);  
        $teacher->setRole($_POST['role']); 
        //// Update the the database with altered information.
        if($admin->editTeacherProfile()){
          $theMessage = "<p style='color: Blue;'>Instructor Updated Successfully</p>";
        }// end if a student was successfully added to the databse.
        else{
          $theMessage = "<p style='color: Red;'>Instructor Update Failed</p>";
        }// end else
      }// if the update button was clicked
    }// end if textboxes are set

/** deletes a selected teachers information **/
if(isset($_POST['userID']) && $_POST['role'] == 'teacher'){
  if(isset($_POST['delete_Button'])){
    $admin = new AdminTeacherManip();
    // use the session variables to automatically access the same teacher that was originally selected so that the Admin can even update the teachers username if desired.
    $admin->viewTeacherProfile($_SESSION['theTeacherUserID'], $_SESSION['theTeacherUniqueKey']);
    if($admin->deleteTeacher()){
      $theMessage = "<p style='color: Blue;'>Instructor Successfully Deleted</p>";
    }// end if 
    else{
      $theMessage = "<p style='color: Red;'>Instructor Was Not Deleted</p>";
    }// end else
  }// end if delete button clicked
}// end if

/*------------------------------------------------- Clear All TextBoxes ------------------------------------*/
  if(isset($_POST['clear_Button'])){
    // get the users Admin Input
    $theUserId = "";
    $theFirstName = "";
    $theMiddleName = "";
    $theLastName = "";
    $theEmail = "";
    $thePassword = "";
    $theSchoolName = "";
    $theRole = "student";
  }// end if
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Main page</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>

  <div class="header">
    <h1>Admin Main Page</h1>
  </div>

  <div class="topnav">
    <a href="../logout.php" title="Click to be logged out" style="float:right;">Log out</a>
  </div>

  <div class="row">

    <form action="" method="post">
      <!-- select Student ID -->
      <input type="text" name="StudentID_Textbox" placeholder="Search Student ID" style="width:20%">
      <input type="checkbox" name="studentDB_Checkbox" value="student"> Student Search<br/>
      <!-- select Teacher ID -->
      <input type="text" name="TeacherID_Textbox" placeholder="Search Teacher ID" style="width:20%">
      <input type="checkbox" name="teacherDB_Checkbox" value="teacher"> Teacher Search<br/>
      <input type="submit" name="select_Submit_Button" class="button" value="Search" title="Click to search for a student or teacher" style="margin-left:5%;margin-right:30%; margin-top:1%; margin-bottom: 1%;">

      <!-- The Input Boxes start here -->
      <hr>
      <h2 style="text-align: center; margin-bottom: -20px; color: green;"> <?php echo $theMessage; ?> </h2>
      <div class="container" style="margin-left:25%;margin-right:39%;flex-direction:column">

        <label for="userID"><b>User ID</b></label>
        <input type="text" placeholder="Enter the Username" name="userID" value="<?php echo $theUserId; ?>" maxlength="40">

        <label for="password"><b>Password</b></label>
        <input type="text" placeholder="Enter the Password" name="password" value="<?php echo $thePassword; ?>" maxlength="40">

        <label for="first_Name"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="first_Name" value="<?php echo $theFirstName; ?>" maxlength="40">

        <label for="middle_Name"><b>Middle Name</b></label>
        <input type="text" placeholder="Enter Middle Name" name="middle_Name" value="<?php echo $theMiddleName; ?>" maxlength="40">

        <label for="last_Name"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="last_Name" value="<?php echo $theLastName; ?>" maxlength="40">

        <label for="schoolName"><b>School Name</b></label>
        <input type="text" placeholder="Enter School Name" name="schoolName" value="<?php echo $theSchoolName; ?>" maxlength="40">

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $theEmail; ?>" maxlength="100">

        <label for="role"><b>Role</b></label>
        <!--<select name="role">-->
        <!--  <option value="</*?php echo $theRole;?*/>" name="studentSelected" selected="</*?php $selected?*/>">student</option>-->
        <!--  <option value="</*?php echo $theRole;?*/>" name="teacherSelected" selected="</*?php $selected?*/>">teacher</option>-->
        <!--</select>-->
        <input type="text" placeholder="Enter the Role" name="role" value="<?php echo $theRole; ?>" maxlength="10">
      </div>

      <div style="margin-left:31%; margin-top:1%;">
        <input type="submit" class="button" name="create_Button" value="Create" title="Fill in all Text Boxes and click to Create a new student or teacher">
        <input type="submit" class="button" name="update_Button" value="Update" title="Search for a student or teacher, update the information, and click to Update">
        <input type="submit" class="button" name="delete_Button" value="Delete" title="Search for a student of teacher and click to delete from the system">
        <input type="submit" class="button" name="clear_Button" value="Clear" title="Click to clear all the text boxes">
      </div>
    </form>
    <div class="w3-container">

      <div class="footer">
        <p style="color:white;">&copy; <?php echo date("Y");?> QueryHill.com</p>
      </div>

</body>

</html>
