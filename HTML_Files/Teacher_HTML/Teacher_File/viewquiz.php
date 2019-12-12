<?php
session_start();
include_once'../../../classes/TeacherControls.php';

//include_once "lib/Teacher.php";
include_once'../../../classes/Quiz.php';


?>
<?php include_once 'inc/header.php'; 
      TeacherControls::checkSession();

/*echo*/ $_SESSION['chapter']; //got the session when the teacher enter the chapter number in the text box
$chapid = $_SESSION['chapter'];
/*echo */$chapid;
?>
<!DOCTYPE html>
<html>

<body>
     <!-- //need the session above so that in the go back button  we can acces the same page!-->

    <form method="post" action="SearchHandler.php?chapter=<?php echo $chapid; ?>">
 <input type="submit" value="Go Back">

</form>
   
       


<!-- the update part !-->
    <?php
    $update = new Quiz();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        //setters 
        $qid =$update->setQuestionid($_POST['id']);
        $q =$update->setQuestion($_POST['qus']);
        $op1 =$update->setanswerA($_POST['op1']);
        $op2 =$update->setanswerB($_POST['op2']);
        $op3 =$update->setanswerC($_POST['op3']);
        $op4 =$update->setanswerD($_POST['op4']);
        $correctop =$update->setcorrectAns($_POST['ans']);
        //$chap =$createquiz->setCatid($_POST['chapter']);    
       
       //caling function to update these parameters from the setters
       $updateques = $update->updateQuestionData($qid,$q, $op1, $op2,$op3,$op4,$correctop);
       
      
    }
    ?>
    <form action="" method="POST">
	 
        <div>
	 		<label for="email"> Enter question ID: </label>
	 		<input type="text" id="email" name="id" />
        </div>
         
         <div>
	 		<label for="password">Update  Question  </label>
	 		<input type="text" id="password" name="qus" />
	 	 </div>

         <div>
	 		<label for="password">Update  answer 1  </label>
	 		<input type="text" id="password" name="op1" />
	 	 </div>
         <div>
	 		<label for="password">Update  answer 2  </label>
	 		<input type="text" id="password" name="op2" />
	 	 </div>
         <div>
	 		<label for="password">Update  answer 3  </label>
	 		<input type="text" id="password" name="op3" />
	 	 </div>
         <div>
	 		<label for="password">Update  answer 4  </label>
	 		<input type="text" id="password" name="op4" />
	 	 </div>
         <div>
	 		<label for="password">Update  correct answer  </label>
	 		<input type="text" id="password" name="ans" />
	 	 </div>

        <button type="submit" name="update" > Update </button>
<?php  if (isset($updateques)){
	               echo $updateques;} ?>
	 </form>
    
    
    <!-- the Update part true/false !-->
    
    <?php      
             $updatetruefalse = new Quiz();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trueandfalse'])){
        //setters 
        $qid =$updatetruefalse->setQuestionid($_POST['id']);
        $q =$updatetruefalse->setQuestion($_POST['qus']);
        $op1 =$updatetruefalse->setanswerA($_POST['op1']);
        $op2 =$updatetruefalse->setanswerB($_POST['op2']);
        $correctop =$updatetruefalse->setcorrectAns($_POST['ans']);
       
       //caling function to update these parameters from the setters
       $updateques2 = $updatetruefalse->updateTrueFalseData($qid,$q, $op1, $op2,$correctop);
       
      
    }
?>
    
    
    
    <br/>
            
             <form method="POST" action="">
                    
                    <div>
                        <label for="email"> Enter question ID: </label>
                        <input type="text" id="email" name="id" />
                    </div>
					<div>
					  <label for="text">Update Question</label>
					  <input type="text" name="qus"  >
					</div>

					<div >
					  <label for="text" > Update True or False for answer A:</label>
					 <input type="text"   name="op1">
					</div>
                 
                    <div >
					  <label for="text" > Update True or False for answer B:</label>
					  <input type="text"  name="op2" >
					</div>
					
					<div >
					  <label for="text">Update correct answer</label>
					  <input type="text" name="ans" >
					</div>
				    
        
					<button type="submit" name="trueandfalse"  >Update</button><br>
				<?php  if (isset($updateques2)){
	               echo $updateques2;} ?>
                       
                </form>
    <br />
    
    
    
    
    
    <!-- the Delete part !-->
    <?php
    $delete = new Quiz();
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
        //setters 
        $qid =$delete->setQuestionid($_POST['id']);
         
       
       //caling function to delete these parameters from the setters
       $deleteques = $delete->deleteQuestionData($qid);
       
      
    }
    ?>
    <form action="" method="POST">
	 
        <div>
	 		<label for="email"> Enter question ID: </label>
	 		<input type="text" id="email" name="id" />
        </div>
         
        
        <button type="submit" name="delete" > Delete </button>
<?php  if (isset($deleteques)){
	               echo $deleteques;} ?>
	 </form>

</body>
</html>
