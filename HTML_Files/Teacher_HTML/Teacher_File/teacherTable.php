<?php
session_start();

//$filepath = realpath(dirname(__FILE__));// another way to  for the session.php file that is stored in another folder in your computer
//include_once "lib/Teacher.php";//stick with this one
include_once '../../../classes/TeacherControls.php';

?>
<!DOCTYPE html>
<html>

<head>
	<title>Login and Register System </title>

	<link />
	<script> </script>
	<script> </script>
</head>

<body>
	<?php include_once 'inc/header.php';
	?>


	<div>
		<table>
			<tr>
				<th> student_ID </th>
				<th> studentUserID </th>
				<th> first_Name </th>
				<th> email </th>
				<th> Quiz Grade </th>


				<?php
				$user = new TeacherControls();
				$userdata = $user->getStudentData();
				if ($userdata) {
					$i = 0;
					foreach ($userdata as $sdata) {
						$i++;

						?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $sdata['studentUserID'] ?></td>
				<td><?php echo $sdata['first_Name'] ?></td>
				<td><?php echo $sdata['email'] ?></td>
				<td><?php echo $sdata['marks'] ?></td>
				
			</tr>

		<?php     	}
		} else { ?>

		<tr>
			<td>
				<h2> No user Data Found </h2>
			</td>
		</tr>


	<?php  }  ?>



		</table>

	</div>

	<div class="footer">
		<p style="color:white;">&copy; <?php echo date("Y"); ?> QueryHill.com</p>
		<!--
        <p>&copy;<? //php echo date("Y");?>
                Student Quiz Application -  A project created by Alex Maddox, Prachi Khare, Rachel Perry, Edri Torres and Matthew Wright.
        </p>
        -->
	</div>

</body>

</html>