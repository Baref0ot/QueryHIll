<?php
include_once(dirname(__FILE__, 2) . '/classes/Admin.class.php');//AutoClassLoader.inc.php
    class UserSignIn extends Admin{

        // properties
        private $id = 0;
        private $username = "";
        private $password = "";
        private $role = "";

        // setters and getters
        public function setID($id){
            $this->id = $id;
        }// end setID
        public function getID(){
            return $this->id;
        }// end getID

        public function setUserName($username){
            $this->username = $username;
        }// end setUsername
        public function getUserName(){
            return $this->username;
        }// end getUsername

        public function setPassword($password){
            $this->password = $password;
        }// end setPassord
        public function getPassword(){
            return $this->password;
        }// end getPassword

        public function setRole($role){
            $this->role = $role;
        }// end setRole
        public function getRole(){
            return $this->role;
        }// end getRole


        /** Allows the client to easily view all the teachers in the browser given that they are an administrator **/
        function checkUserLogin(){
            // get all the users from the appropriate table
            $listOfUsers = $this->getAllUsers();

            // get the input from the user and trim it
            $enteredUsername = trim($_POST["username"]);
            $enteredPassword = trim($_POST["password"]);
            // dump the userinput for testing 
            //////echo "Entered Username: " . var_dump($enteredUsername) . "<br/>";
            //////echo "Entered Password: " . var_dump($enteredPassword) . "<br/>";

            foreach($listOfUsers as $user){

                $this->setID($user['id']);
                $this->setUserName($user['username']);
                $this->setPassword($user['password']);
                $this->setRole($user['role']);

	            //////$message = "Invalid Username or Password";
                $role = "";
                    
                    // get input from the database and trim it
                    $db_username = trim($this->getUserName());
                    $db_password = trim($this->getPassword());
                    
                    // dump the database input for testing
                    ////echo "Database Username: " . var_dump($db_username) . "<br/>";
                    ////echo "Database Password: " . var_dump($db_password) . "<br/>";

                    // check if there is a username and password match
                    if(($enteredUsername === $db_username) && (md5($enteredPassword) === $db_password)){
                        //////echo "<br/>";
                        //////echo "the if statement was entered";
                    

                        // check the role of the user that has correctly entered a correct username and password.
                        $userRole = trim($this->getRole());
				        switch($userRole){
                            case 'admin':
                                // store this users data in session variables
                                $_SESSION['id'] = $this->getID();
                                $_SESSION['username'] = $enteredUsername;
                                $_SESSION['password'] = $enteredPassword;
                                $_SESSION['role'] = $userRole;
				        	    header('Location: ../HTML_Files/Admin_HTML/adminmainpage.php'); // place your student files inside the "Admin_HTML" folder and place the main student page at the end of this path.
                                return true;
                            break;
                            case 'student':
                                // store this users data in session variables
				        	    $_SESSION['id'] = $this->getID();
                                $_SESSION['username'] = $enteredUsername;
                                $_SESSION['password'] = $enteredPassword;
                                $_SESSION['role'] = $userRole;
                                header('Location: ../HTML_Files/Student_HTML/studentHome.php'); // place your student files inside the "Student_HTML" folder and place the main student page at the end of this path.
                                return true;
                            break;
                            case 'teacher':
                                // store this users data in session variables
				        	    $_SESSION['id'] = $this->getID();
                                $_SESSION['username'] = $enteredUsername;
                                $_SESSION['password'] = $enteredPassword;
                                $_SESSION['role'] = $userRole;
                                header('Location: ../HTML_Files/Teacher_HTML/Teacher_File/teacher.php'); // place your student files inside the "Teacher_HTML" folder and place the main student page at the end of this path.
                                return true;
                            break; 
                        }// end switch 
                    }// end if correct credentials
            }// end foreach user
        }// end checkUserLogin

        // display method for testing
        function display(){
            echo "<br/>";
            echo "Id: " . $this->getID() . "<br/>";
            echo "Username: " . $this->getUserName() . "<br/>";
            echo "Password: " . $this->getPassword() . "<br/>";
            echo "Role: " . $this->getRole() . "<br/>";
        }// end display
    }// end class
    
    // check that submit button to login has been clicked
    if(isset($_POST["btnLogin"])){
        //echo "submit button was clicked. <br/><br/>";
        // test case 1 - check that the a database connection was made and all users from the users table can be accessed
        $userSignIn = new UserSignIn();
        // start a session
        session_start();
        if(!$userSignIn->checkUserLogin()){
            header('Location: ../index_signIn_Failed.php');
        }// end if
    }// end if submit clicked

?>