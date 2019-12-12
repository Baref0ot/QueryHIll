<?php
    session_start();

    // load the appropriate files needed for functionality
    $studentPath = dirname(__File__, 3) . '/includes/AdminStudentManip.inc.php';
    $quizPath = dirname(__FILE__, 3) . '/classes/Quiz.php';
    // check to see if the directory path to the needed files exist, if so then require it.
    if ($studentPath && $quizPath) {
        require_once $studentPath;
        require_once $quizPath;
    } // end if

    // get the student and quiz ID
    $quizID           = $_SESSION['quizID'];
    $numQuizQuestions = $_SESSION['questionNumber'];
    $studentsID       = $_SESSION['id'];
    $studentsUsername = $_SESSION['username'];

    // variables needed to calculate the score
    $totalPossiblePoints = 100;
    $pointsPerQuestion = $totalPossiblePoints / $numQuizQuestions;
    global $studentsTotalScore;
    


    // instantiate the appropriate objects necessary to complete the objective
    $studentAccess = new AdminStudentManip();
    $student = $studentAccess->viewStudentProfile($studentsUsername);
    $quiz = new Quiz();

    // get all the session students information.
    $studentAccess->viewStudentProfile($_SESSION['username'], $_SESSION['id']);

    // get the quiz based on the quizID and select the quiz that was taken by the student
    $quiz->setCatid($quizID);
    $chapterQuestions = $quiz->findBychapterid();

    foreach($chapterQuestions as $question){
        $chapterHeader = "<b>Chapter " . $question['chapterid'] . " Quiz Results </b><br/>";
    }// end foreach


    // get the chosen answers to the quiz questions
    $questionNumber = 1;
    foreach($chapterQuestions as $question){
        // get the answers from the user and the correct answers from the database and convert them into html entities.
        $selectedAnswer = $_POST["question" . $questionNumber];
        $theCorrectAnswer = $question['correctanswer'];
        $convertedHTMLSelectedAnswer = htmlentities($selectedAnswer);
        $convertedHTMLCorrectAnswer = htmlentities($theCorrectAnswer);
        // check if the $converted HTML Selected Answer matches the answer to the question in the databasae
        if($convertedHTMLSelectedAnswer == $convertedHTMLCorrectAnswer){
            $studentsTotalScore += $pointsPerQuestion;
        }// end if
        // add 1 to the question number for each next question
        $questionNumber++;
    }// end foreach

    // Update the students Grade to their calculated quiz score
    $student->setGrade($studentsTotalScore);
    $studentAccess->editStudentProfile();

    // Send the student an email
    // variables required to send email
    $from = "queryhill@mlwjavapro.com";
    $email = $student->getEmail();
    $firstName = $student->getFirstName();
    // send email to the user
    $to = $email;
    $subject = "QueryHill Chapter " . $question['chapterid'] . " Quiz Results!";
    $txt = "Hello " . $firstName . "!\r\n You submitted your quiz on " . date("m/d/Y") . ". \r\n Your Score: " .$studentsTotalScore. "\r\n";
    $headers = "From:" . $from;
    mail($to,$subject,$txt,$headers);
    
    // display a message to the student in this form
    $theMessage = "<h5 style='text-align: center;'>Your Grade has been Submitted and Saved! Check your email!</h5>"; 
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

    .main{
      margin-left: 25%;
      margin-right: 20%;
      margin-top: 10%;
      margin-bottom: 10%;
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
              <a class="navbar-brand">Student: <?php echo $studentsUsername; ?></a>
            </div>
        </nav>
        <h4>  <?php echo $chapterHeader;?> </h4>
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
  
    <div class="main">
        <?php echo $theMessage; ?>
        <h6 style=" text-align: center;"> Your Score - <?php echo $studentsTotalScore; ?></h6>

        <form action="studentHome.php" style="margin-left:auto; margin-right: auto;">
          <button type="submit" class="btn btn-warning btn-lg form-control mr-sm-2" style="width: 40%; margin-left: 30%; margin-top: 3%;">Take Another Quiz</button>
        </form>
    </div>
      
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
