<?php
session_start();
include_once 'inc/header.php';
//include_once ('Teacher.class.php'); Old stuff
//include_once'../../../classes/Database.php';
include_once '../../../classes/TeacherControls.php';

?>

<?php
if (isset($_SESSION['username'])) {
$userid = $_SESSION['username']; //(int)$_GET['id'];
	//echo $_SESSION['id']."<br />";
} // end if

$user = new TeacherControls();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
	//$updateusr = $user->updateTeacherData($userid, $_POST);
	$c = $user->setuserName($_POST['username']);
	$d = $user->setPassword(md5(($_POST['password'])));
	$updateusr = $user->updateTeacherData($c, $d);
} // end if
?>
<html>

<body>
	<div>
		<div>
			<h2>My Profile <span><a href="teacher.php">Back</a></span></h2>
		</div>

		
			
				<?php
				if ($userid) {
					?>
					<form action="" method="POST">
						<div>
							<label for="email"> Update username </label>
							<input type="text" id="email" name="username" value="<?php //echo $userdata->username; 
																						?>" />
						</div>

						<div>
							<label for="password">Update password </label>
							<input type="text" id="password" name="password" />
						</div>

						<button type="submit" name="update"> Save </button>
                        <div >
				<?php
				if (isset($updateusr)) {
					echo $updateusr;
				} // end if
				?>
            </div>
			
			</form>
		<?php } ?>
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