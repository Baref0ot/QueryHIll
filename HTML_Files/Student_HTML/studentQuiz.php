<?php
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

  // get all the session students information.
  $student->viewStudentProfile($_SESSION['username'], $_SESSION['id']);

  // get the value of the selected chapter from the previous form, and find the question based on that chapter id.
  $selectedChapter = $_POST['chapter'];
  if(isset($selectedChapter)){
    $quiz->setCatid($selectedChapter);
    $chapterQuestions = $quiz->findBychapterid();

    $_SESSION['quizID'] = $selectedChapter;

    foreach($chapterQuestions as $question){
      $chapterNumber = "<b>Chapter " . $question['chapterid'] . " Quiz: </b><br/>";
    }// end foreach
  }// end if

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

    h4{
      display: inline-block;
      text-align: center;
    }

    .questionsForm{
      margin-left: 25%;
      margin-right: 25%;
      padding: 50px;
      border-radius: 50px;
      background-color: #0C9BEC;
      color: white;
    }

    input[type=radio]{
      margin-left: 10%;
    }

    .footer {
      width: 100%;
      padding: 30px;
      text-align: center;
      background-color: #0C9BEC;
    }
  </style>
</head>

<body>
  <header>
    <div class="header">
      <nav id="header" class="navbar navbar-default bg-primary">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand">Student: <?php echo $student->getStudentUserID(); ?></a>
            </div>
        </nav>
        <h4>  <?php echo $chapterNumber;?> </h4>
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
  <!--<div id="quizContainer" class="col-sm-6 offset-sm-3 text-center">-->

    <form action="quizCheck.php" class="questionsForm" method="post">

      <?php
        $questionNumber = 1;  
        foreach($chapterQuestions as $question){
      ?>  
              <!-- Question -->
              <p> <b>Question <?php echo $questionNumber  ?>: <?php echo $question['question'] ?> </b></p>

              <?php if(isset($question['ans1']) && !($question['ans1'] == null)){ ?>
                <!--answer 1-->
                <input type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans1']; ?>"> <label for="question1answer1"> <?php echo $question['ans1']; ?> </label><br/> 
              <?php }else{ ?>
                <input type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans1']; ?>"> <label for="question1answer1"> <?php echo $question['ans1']; ?> </label><br/> 
              <?php }// end else ?>

              <?php if(isset($question['ans2']) && !($question['ans2'] == null)){ ?>
                <!--answer 2-->
                <input type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans2']; ?>"> <label for="question1answer1"> <?php echo $question['ans2']; ?> </label> <br/>
              <?php }else{ ?>
                <input type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans2']; ?>"> <label for="question1answer1"> <?php echo $question['ans2']; ?> </label> <br/>
              <?php }// end else ?>

              <?php if(isset($question['ans3']) && !($question['ans3'] == null)){ ?>
                <!--answer 3-->
                <input  type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans3']; ?>"> <label for="question1answer1"> <?php echo $question['ans3']; ?> </label> <br/>
              <?php }else{ ?>
                <input style="display: none;" type="radio"  id="question1answer1" name="question<?php echo $questionNumber; ?> " value="<?php echo $question['ans3']; ?>"> <label for="question1answer1"> <?php echo $question['ans3']; ?> </label> <br/>
              <?php }// end else ?>

              <?php if(isset($question['ans4']) && !($question['ans4'] == null)){ ?>
                <!--answer 4-->
                <input type="radio" id="question1answer1" name="question<?php echo $questionNumber; ?>" value="<?php echo $question['ans4']; ?>"> <label for="question1answer1"> <?php echo $question['ans4']; ?> </label> <br/>
                <?php }else{ ?>
                  <input style="display:none;" type="radio" id="question1answer1" name="question<?php echo$questionNumber; ?>" value="<?php echo $question['ans4']; ?>"> <label for="question1answer1"> <?php echo $question['ans4']; ?> </label> <br/>
                <?php }// end else ?>
              <br/>
            <?php 
              $questionNumber++;
            ?>

            
          
      <?php 
          }// end foreach

          // for use in the next form
          $_SESSION['questionNumber'] = $questionNumber - 1;
      ?>

      <br><br>
      <button type="submit" name="quizSubmit" class="btn btn-primary">Submit</button>
    </form>
  

  <br><br>
  <div class="footer">
    <footer class="footer-area footer--light bg-primary ">
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