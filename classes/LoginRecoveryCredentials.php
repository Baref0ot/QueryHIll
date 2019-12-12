<?php
 include_once 'Database.php';


class LoginRecoveryCredentials {
    
     	private $db;

    public function __construct(){
 		 $this->db = new Database(); //created object for the database
 	}
    

// this is sending a request to changd password by using teacher's email and sending a link by email with an encrypted key.
     public function requestPasswordReset(){
         
    
// Was the form submitted?
if (isset($_POST["ForgotPassword"])) {
	
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST["email"];
		
	}else{
		return "email is not valid";
		exit;
	}

	// Check to see if a user exists with this e-mail
	$query = $this->db->pdo->prepare('SELECT * FROM users WHERE email= :email LIMIT 1');
	$query->bindParam(':email', $email);
	$query->execute();
	$userExists = $query->fetch(PDO::FETCH_ASSOC);
	$conn = null;
	
	if ($userExists["email"])
	{
        
        
		// Create a unique salt. This will never leave PHP unencrypted.
		$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

		// this $keypassword will be later be macth with the other $resetkey from the resetPassword() method below this one
		 $keypassword = hash('sha512', $salt.$userExists["email"]);

         $link = "http://queryhill.com/HTML_Files/resetpassword/resetpassword.php?q=".$keypassword;
        
        
	
        
        $from = "queryhill@mlwjavapro.com";
       
        // send email to the user
        $to = $email;
        $subject = "Please copy and paste the link in your url: ".$link;
        $txt = "Please copy and paste the link in your url: ".$link."\r\n";
        $txt = wordwrap($msg,70);
        $headers = "From:" . $from;
        mail($to,$subject,$txt,$headers);
        
        return("An email Message has been  sent! Please copy and paste the link that has been sent to your email to the URL\n"."<br />");
            exit();
        //this is required from XAMMP its built inside so email can work
        /*require_once "Mail.php";
        // Create a url which we will direct them to reset their password
        $link = "127.0.0.1/projects/PHP_project/HTML_Files/resetpassword/resetpassword.php?q=".$keypassword;
        $from = ("torresedrey@gmail.com");
        $to = $email;
        
        $host = "smtp.gmail.com";
        $port = "587";
        $username = 'torresedrey@gmail.com';
        $password = 'serrotE1996';
        
        $subject = "Recovery Password";
         
        // Mail them their key
        $body = "Please copy and paste the link in your url: ".$link;

        $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
        $smtp = Mail::factory('smtp',
        array ('host' => $host,
        'port' => $port,
        'auth' => true,
        'username' => $username,
        'password' => $password));

        $mail = $smtp->send($to, $headers, $body,"-f your@email.here");

        if (PEAR::isError($mail)) {
        echo($mail->getMessage());
        }   else {
              return("An email Message has been  sent! Please copy and paste the link that has been sent to your email to the URL\n"."<br />");
            exit();
        }
        
        */
          
        
	}
	}
	else
		return "No user with that e-mail address exists.";
       // echo "<div>";
        // echo   "<a href='forgot_password.php'>Go Back</a>";
             
           //echo "</div>";
        
     }	     


         
         
     

    
 //this is taking action by resetting the teachers's password and then added  to the DB
     public function resetPassword(){
  


	// Gather the post data
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirmpassword"];
	 $hash = $_GET["q"]; //we get this hash key from the above method to compare later

	// Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	// Generate the reset key
	$resetkey = hash('sha512', $salt.$email);// this is generating a new key

	// Does the new reset key match the old one?
	if ($resetkey == $hash)//so we compare the key generated from the form with this new $resetkey.
	{
        //nothing happens
    }
	else{
		return "We haven't had anyone log in with this email before.";}
		
    if ($password == $confirmpassword)//the comparison passwords in the reset_password.php
        
		{//nothing happens
    }
		else{
			return "Your password's do not match.";}
			//then make the new password md5 for now..can later be changed
			$newpassword = md5($password);

			// Update the user's password
            $sql = 'UPDATE users SET password = :password WHERE email = :email';
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':password', $newpassword);
				$query->bindValue(':email', $email);
				$result2 = $query->execute();
				
			
            
                if ($result2) {            
                
                
                    // if the result workrs from the first sql statememnt then the code below runs too.
                $sql = 'UPDATE teacher SET password = :password WHERE email = :email';
				$query = $this->db->pdo->prepare($sql);
				$query->bindValue(':password', $newpassword);
				$query->bindValue(':email', $email);
				$result = $query->execute();
                
                return "Your password has been successfully reset.";
                    
                }
		
	

         
     }
    
    
     //this method is use for recovering the teacher's username by email
     public function sendingusernamebyemail(){
         

// Was the form submitted?
if (isset($_POST["ForgotPassword"])) {
	//checks  proper user input validation for an email
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST["email"];
		
	}else{
		return "email is not valid";
		exit;
	}

	// Check to see if a user exists with this e-mail
	$query = $this->db->pdo->prepare('SELECT * FROM users WHERE email= :email ');
	$query->bindParam(':email', $email);
	$query->execute();
	$userExists = $query->fetch(PDO::FETCH_ASSOC);
	$conn = null;
    
    


	if ($userExists["email"])
	{      //pulling out data from db to find the username
        
      
      
             $recoveryusername = $userExists['username'];
         
        
        //Wont work for host only localserver XAMMP
        /*
		// Create a unique salt. This will never leave PHP unencrypted.
		//$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

		// this $keypassword will be later be macth with the other $resetkey from the reset.php
		// $keypassword = hash('sha512', $salt.$userExists["email"]);

		
        //this is required from XAMMP its built inside so email can work
        require_once "Mail.php";
        // Create a url which we will direct them to reset their password
        //$link = "127.0.0.1/projects/PHP_project/resetpassword/reset_password.php?q=".$keypassword;
        $from = ("torresedrey@gmail.com");
        $to = $email;
        
        $host = "smtp.gmail.com";
        $port = "587";
        $username = 'torresedrey@gmail.com';
        $password = 'serrotE1996';
        
        $subject = "Recovery Password";
         
        // Mail them their key
        $body = "Your forgotten username is: ".$recoveryusername;

        $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
        $smtp = Mail::factory('smtp',
        array ('host' => $host,
        'port' => $port,
        'auth' => true,
        'username' => $username,
        'password' => $password));

        $mail = $smtp->send($to, $headers, $body,"-f your@email.here");

        if (PEAR::isError($mail)) {
        echo($mail->getMessage());
        }   else {
              return("Your username has been recovered, please check your email\n"."<br />");
            
        echo "<div>";
        // echo   "<a href='../HTML_Files/logout.php'>Back to Login</a>";
             
           echo "</div>";
            exit();
        }
        
        
        */
        //
        $from = "queryhill@mlwjavapro.com";
       
        // send email to the user
        $to = $email;
        $subject = "Your forgotten username is: ".$recoveryusername;
        $txt = "Your forgotten username is: ".$recoveryusername."\r\n";
        $txt = wordwrap($msg,70);
        $headers = "From:" . $from;
        mail($to,$subject,$txt,$headers);
        
       return("Your username has been recovered, please check your email\n"."<br />");
	} 
	else
		return "No user with that e-mail address exists.";
        //return "<div>";
        // return   "<a href='forgot_password.php'>Go Back</a>";
             
          // return "</div>";
        
     }	     

         
     }


}