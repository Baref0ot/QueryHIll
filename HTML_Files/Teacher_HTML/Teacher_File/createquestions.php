<?php
session_start();
include_once '../../../classes/Quiz.php';


$createquiz = new Quiz();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
	//setters 
	$q = $createquiz->setQuestion($_POST['qus']);
	$op1 = $createquiz->setanswerA($_POST['op1']);
	$op2 = $createquiz->setanswerB($_POST['op2']);
	$op3 = $createquiz->setanswerC($_POST['op3']);
	$op4 = $createquiz->setanswerD($_POST['op4']);
	$correctop = $createquiz->setcorrectAns($_POST['ans']);
	$chap = $createquiz->setCatid($_POST['chapter']);

	//caling function to insert these parameters from the setters
	$updateusr = $createquiz->insertQuestions($q, $op1, $op2, $op3, $op4, $correctop, $chap);
}
?>
<?php include_once 'inc/header.php'; //calling header instead of redoing it again
//TeacherControls::checkSession();
?>


<!DOCTYPE html>
<html lang="en">




<body>






	<form method="POST" action="">
		<div>
			<label for="text">Enter Question</label>
			<input type="text" name="qus">
		</div>

		<div>
			<label for="text">Enter answer A:</label>
			<input type="text" name="op1">
		</div>
		<div>
			<label for="text">Enter answer B:</label>
			<input type="text" name="op2">
		</div>

		<div>
			<label for="text">Enter answer C:</label>
			<input type="text" name="op3">
		</div>

		<div>
			<label for="text">Enter answer D:</label>
			<input type="text" name="op4">
		</div>
		<div class="form-group">
			<label for="text">Enter correct answer</label>
			<input type="text" name="ans">
		</div>

		<div class="form-group">
			<label for="text">Enter chapter's number:</label>
			<input type="text" name="chapter">
		</div>
		<button type="submit" name="update">Save</button><br>
		<?php if (isset($updateusr)) {
			echo $updateusr; //   returns the messages I have in that method.
		} ?>

	</form>


	<!-- The true false create questions!-->

	<?php
	$createtruefalse = new Quiz();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trueandfalse'])) {
		//setters 
		$q = $createtruefalse->setQuestion($_POST['qus']);
		$op1 = $createtruefalse->setanswerA($_POST['op1']);
		$op2 = $createtruefalse->setanswerB($_POST['op2']);
		$correctop = $createtruefalse->setcorrectAns($_POST['ans']);
		$chap = $createtruefalse->setCatid($_POST['chapter']);

		//caling function to insert these parameters from the setters
		$updateusr2 = $createtruefalse->insertTrueFalse($q, $op1, $op2, $correctop, $chap);
	}
	?>




	<br />

	<form method="POST" action="">
		<div>
			<label for="text">Enter a True/False Question</label>
			<input type="text" name="qus">
		</div>

		<div>
			<label for="text"> Enter True or False for answer A:</label>
			<input type="text" name="op1">
		</div>

		<div>
			<label for="text"> Enter True or False for answer B:</label>
			<input type="text" name="op2">
		</div>

		<div>
			<label for="text">Enter correct answer</label>
			<input type="text" name="ans">
		</div>

		<div class="form-group">
			<label for="text">Enter chapter's number:</label>
			<input type="text" name="chapter">
		</div>
		<button type="submit" name="trueandfalse">Save</button><br>
		<?php if (isset($updateusr2)) {
			echo $updateusr2;
		} ?>

	</form>







	<div class="footer">
		<p style="color:white;">&copy; <?php echo date("Y");?> QueryHill.com</p>
        <!--
        <p>&copy;<?//php echo date("Y");?>
                Student Quiz Application -  A project created by Alex Maddox, Prachi Khare, Rachel Perry, Edri Torres and Matthew Wright.
        </p>
        -->
	</div>

</body>

</html>