<?php
  session_start();
  // if the session variables are not set. Prevent access from this page, and go back to login page
  if(!(isset($_SESSION['id']) || isset($_SESSION['username']) || isset($_SESSION['password']) || isset($_SESSION['role']))){
    header('Location: ../../index.php');
  }// end if
?>
<!DOCTYPE html>
<html>
	<head>
		<title>teacher login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="com-md-6">
					<div class="jumbotron">
						<h2 class="text-center">
							Welcome <?php echo $_SESSION['username']; ?>
							<a href="../logout.php" style="float:right">Log out</a>
						</h2>
					</div>
				</div>

			</div>
		</div>

		<script> type="text/javascript" src="js.jquery.min.js"</script>
		<script> type="text/javascript" src="js.bootstrap.min.js"</script>
		<script> type="text/javascript" src="js.popper.min.js"</script>
	</body>
</html>