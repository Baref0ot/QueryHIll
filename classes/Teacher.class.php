<?php
class Teacher {//change this to Teacher class later
    private $uniqueID = 0;
    private $username = "";
    private $password = "";
    private $firstName = "";
    private $middleName = "";
    private $lastName = "";
    private $schoolName = "";
    private $email = "";
    private $roll = "teacher";

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

    function setSchoolName($schoolName){
        $this->schoolName = $schoolName;
    }// end setSchoolName
    function getSchoolName(){
        return $this->schoolName;
    }// end getSchoolName

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
     
    // The Constructor
 	public function __construct($aUniqueID = null, $aUsername, $aPassword, $aFirstName, $aMiddleName, $aLastName, $aEmail, $aSchoolName, $aRole){
         $this->setUniqueID($aUniqueID);
         $this->setuserName($aUsername);
         $this->setPassword($aPassword);
         $this->setFirstName($aFirstName);
         $this->setMiddleName($aMiddleName);
         $this->setLastName($aLastName);
         $this->setEmail($aEmail);
         $this->setSchoolName($aSchoolName);
         $this->setRole($aRole);
    }// end constructor
     
    // display for testing
    public function display(){
        echo "Unique Row Id: " . $this->getUniqueID() . "<br/>";
        echo "User Id: " . $this->getuserName() . "<br/>";
        echo "Password: " . $this->getPassword() . "<br/>";
        echo "First Name: " . $this->getFirstName() . "<br/>";
        echo "Middle Name: " . $this->getMiddleName() . "<br/>";
        echo "Last Name: " . $this->getLastName() . "<br/>";
        echo "Email: " . $this->getEmail() . "<br/>";  
        echo "School Name: " . $this->getSchoolName() . "<br/>";
        echo "Role: " . $this->getRole() . "<br/>";
    }// end display
}// end class
?>