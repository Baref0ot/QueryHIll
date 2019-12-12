<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="HTML_Files/style.css">
</head>

<body>
<h1 style="z-index: 1; text-align: center; color: White; font-size: 70px; font-family: Lucida Console; margin-top: 10px; background-color: ">Query HiLL Quizzes</h1>
  <div class="contain row">
    <div class="loginForm">
      <div class="loginHeader">
        <div class="logo">
          <embed src="Logo.svg" width="100" height="100" style="float:left" type="image/svg+xml" pluginspage="http://www.adobe.com/svg/viewer/install/" />
        </div>
        <h1>Login</h1>
        <hr />
        <form action="includes/UniversalSignIn.inc.php" method="POST">
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
		  </div>

		  <p class="text-center" style="color:red;">Login Failed: Please try again.</p>

          <p class="text-center" style="color:red;">

          </p>
          <div class="form-group">
            
              <input type="submit" name="btnLogin" class="loginSubmitBtn" value="Login"><br>
            
            <span class="password"><a href="/HTML_Files/ResetpagesHTML/resetpassword.html">Forgot password?</a></span>&nbsp; &nbsp; &nbsp;
            <span class="username"><a href="/HTML_Files/ResetpagesHTML/resetusername.html">Forgot username?</a></span>
            <script>
              type = "text/javascript"
              src = "js.jquery.min.js"
            </script>
            <script>
              type = "text/javascript"
              src = "js.bootstrap.min.js"
            </script>
            <script>
              type = "text/javascript"
              src = "js.popper.min.js"
            </script>

          </div>
      </div>
    </div>

    <script>
      type = "text/javascript"
      src = "js.jquery.min.js"
    </script>
    <script>
      type = "text/javascript"
      src = "js.bootstrap.min.js"
    </script>
    <script>
      type = "text/javascript"
      src = "js.popper.min.js"
    </script>
    </form>
</body>

</html>