<?php
include_once 'Database.php';
class TeacherControls extends Database {
    private $uniqueID = 0;
    private $username = "";
    private $password = "";
    private $firstName = "";
    private $middleName = "";
    private $lastName = "";
    private $email = "";
    private $roll = "teacher";
    private $db;

     // Setters and Getters (used for userRegistration() method AND Admin Data Manipulation)
    function setUniqueID($uniqueID){
        $this->uniqueID = $uniqueID;
    }// setUniqueID
    function getUniqueID(){
        return $this->uniqueID;
    }// end getUniqueID

    function setuserName($username) { 
        $this->username = $username; 
    }// end setuserName
    function getuserName() { 
        return $this->username; 
    }// end getuserName

    function setPassword($password) { 
        $this->password = $password; 
    }// end setPassword
    function getPassword() { 
        return $this->password; 
    }// end getPassword

    function setFirstName($firstName) { 
          $this->firstName = $firstName; 
    }// end setFirstName
    function getFirstName() {  
          return $this->firstName; 
    }// end getFirstName

    function setMiddleName($middleName) { 
        $this->middleName = $middleName; 
    }// end setMiddleName
    function getMiddleName() {  
          return $this->middleName; 
    }// end getMiddleName

    function setLastName($lastName) { 
        $this->lastName = $lastName; 
    }// end setLastName
    function getLastName() {  
          return $this->lastName; 
    }// end getLastName

    function setEmail($email) { 
          $this->email = $email; 
    }// end setEmail
    function getEmail() { 
          return $this->email; 
    }// end getEmail

    public function setRole($role){
        $this->role = $role;
    }// end setRole
    public function getRole(){
        return $this->role;
    }// end getRole
    
    public function __construct(){
 		 $this->db = new Database(); //created object for the database
 	}
     
    
    public function updateTeacherData(){
          
            $username = $this->getuserName();
            $password = $this->getPassword();  
            $id = $_SESSION['id'];
            
     if ($username == "" || $password == "" ){
         	$msg = "<div style='color:red;'> <strong> Error: </strong>  Fields must not be empty </div>";
         	return $msg;
         }
       
    $query = $this->db->pdo->prepare('SELECT * FROM users where id = :id');
	$query->bindParam(':id', $id);
	$query->execute();
	$userExists = $query->fetch(PDO::FETCH_ASSOC);
	$conn = null;
     
            $sql = "UPDATE teacher set
                    username  = :username, 
                    password  = :password
                    WHERE id = :id";
        
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':username' , $username);
            $query->bindValue(':id' , $id);
            $query->bindValue(':password' , /*$password*/$password);

            $result = $query->execute();
          
            if ($result) {
            	    //This adds the same data but to the users table
                $msg = "<div style='color:green;'>  Success ! </strong> User data Updated Successfully   </div>";
           
                // if the result workrs from the first sql statememnt then the code below runs too.
                $sql3 = "UPDATE users set
                        username = :username, 
                        password = :password
                        WHERE id = :id";
        
                $query3 = $this->db->pdo->prepare($sql3);   
                $query3->bindValue(':username' , $username);
                $query3->bindValue(':id' , $id);
                $query3->bindValue(':password' , /*$password*/$password);

                $result3 = $query3->execute();
               // echo $id;//it echoes the id 2
              //  echo "<br />".$id;//it echoes id 2 also
         	  return $msg;
            }
        else{
            	    $msg = "<div style='color:red;'><strong> Error ! </strong> User data not Updated.   </div>";
         	return $msg;
            }

         }
     
    
    public static function checkSession(){
           	if ($_SESSION['id'] == false){
                $this->destroy();
           		header("Location: ../../../index.php");}
             
           	}
    
    public function getStudentData(){
    $sql = "SELECT * FROM students ORDER BY studentUserID ";
            $query = $this->db->pdo->prepare($sql);
             $query->execute();
             $result = $query->fetchAll();
             return $result;

       }
    
    
    //
    
    
    
    
    
    
    
    
}// end class
?>