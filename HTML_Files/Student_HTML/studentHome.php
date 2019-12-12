<?php
/*****************************
 * 
 * FrontEnd Developer: Alex Maddox
 *  BackEnd Developer: Matthew Wright (implamented some objects that Edrey Torres created).
 * 
 *****************************/
session_start();
// if the session variables are not set. Prevent access from this page, and go back to login page
if (!(isset($_SESSION['id']) || isset($_SESSION['username']) || isset($_SESSION['password']) || isset($_SESSION['role']))) {
  header('Location: ../../index.php');
} // end if

// get the appropropreiate files that include the objects needed to complete the functionality for this page.
$studentPath = dirname(__File__, 3) . '/includes/AdminStudentManip.inc.php';
$quizPath = dirname(__FILE__, 3) . '/classes/Quiz.php';

// check to see if the directory path to the needed files exist, if so then require it.
if ($studentPath && $quizPath) {
  require_once $studentPath;
  require_once $quizPath;
} // end if

// Session Variables
$_SESSION['id'];
$_SESSION['username'];

// get the object that can access the students informtaion with the appropreiate method.
$student = new AdminStudentManip();
$quiz = new Quiz();

// get all the session students information using the session variables that created on sign-in.
$student->viewStudentProfile($_SESSION['username'], $_SESSION['id']);
$listOfChapters = $quiz->getAllchapters();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Quiz Application</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="HTML_Files/style.css">
  <style>
    .header {
      padding: 30px;
      text-align: center;
      background: #0C9BEC;
      color: white;
    }

    .footer {
      width: 100%;
      padding: 20px;
      text-align: center;
      background: #0C9BEC;
      position: absolute; /* added by Matthew Wright to allow footer to stick to the bottom of the page. */
      bottom: 0; /* added by Matthew Wright to allow footer to stick to the bottom of the page. */
    }
  </style>
</head>

<body>
  <header>
    <div class="header">
      <nav id="header" class="navbar navbar-default">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand">Student: <?php echo $student->getStudentUserID(); ?></a>

            </div>

        </nav>
        <nav class="navbar navbar-right">
          <div class="md-form my-0">
            <form action="../logout.php" class="form-inline"><button type="submit" class="btn btn-warning btn-lg form-control mr-sm-2">LOG OUT</button></form>
          </div>
    </div>
    </nav>

    </nav>
    </div>
  </header>
  <br><br>
  <div id="quizContainer" class="col-sm-6 offset-sm-3 text-center">
    <p>Please choose which chapter you would like to take a quiz on:</p>

    <form action="studentQuiz.php" method="POST"> <!--studentQuiz.php-->
      <select class="form-control" name="chapter">
        <!-- display the chapters from the database in the select box for the user to choose from -->
        <?php 
          foreach($listOfChapters as $row){ 
            ?>
            <option value="<?php echo $row['chapterid'];?>"> Chapter <?php echo $row['chapterid'];?></option>
            <?php 
          }// end foreach
        ?>
      </select>
      <br><br>
      <button type="submit" name="chapterSubmitButton" class="btn btn-primary">Submit</button>
    </form>

  </div>
  <br><br>
  <div class="footer">
    <footer class="footer-area footer--light fixed-bottom">
      <div class="mini-footer">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-text">
                <p style="color:white;">&copy; <?php echo date("Y"); ?> QueryHill.com</p>
              </div>

              <div class="go_top">
                <span class="icon-arrow-up"></span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </footer>
  </div>
  <script src="js/jquery-3.4.1.js"></script>
</body>

</html>