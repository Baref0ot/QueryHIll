<?php

// check to see if the directory path to the needed file exist, if so the require it.
include_once(dirname(__FILE__,2) . "/includes/DataAccess.inc.php");
////$sPath = realpath( __DIR__ . '/../includes/DataAccess.inc.php');
////if($sPath) { 
////    require_once $sPath; 
////}// end if

class Admin extends DataAccess{
    /**Properties**/
    private $adminID = 0;
    private $username = "";
    private $password = "";
    private $role = "admin";

    /** Setter/Getter Methods **/
    public function setAdminID(int $theAdminID){
        $this->adminID = $theAdminID;
    }// end setAdminID
    public function getAdminID(){
        return $this->adminID;
    }// end getAdminID

    public function setAdminUsername(string $theUsername){
        $this->username = $theUsername;
    }// end setAdminUsername
    public function getAdminUsername(){
        return $this->username;
    }// end getAdminUsername

    public function setAdminPassword(string $thePassword){
        $this->password = $thePassword;
    }// end setAdminPassword
    public function getAdminPassword(){
        return $this->password;
    }// end getAdminPassword

    public function setRole($role){
        $this->role = $role;
    }// end setRole
    public function getRole(){
        return $this->role;
    }// end getRole

    /** Constructor - with optional parameters**/
    public function __construct(string $aUsername = null, string $aPassword = null, string $aRole = "admin"){
        // checks if the passed parameter value is null, if yes then default values are stored in the passed parameter which is stored into the left most variable.
        $aUsernameThatsSet = $aUsername ?? "Admin123";
        $aPasswordThatsSet = $aPassword ?? "Password";
        if($aUsernameThatsSet == "" || $aPasswordThatsSet == ""){
            echo "Credentials can not be empty. They have been set to the system defaults." . "<br/>";
            $this->setAdminUsername("Admin123"); // "Admin123"
            $this->setAdminPassword("Password"); // "Password"
            $this->setRole("admin");
        }// end if
        else{
            $this->setAdminUsername($aUsernameThatsSet);
            $this->setAdminPassword($aPasswordThatsSet);
            $this->setRole($aRole);       
        }// end else
    }// end parameterized __construct

    /** This Method allows the Administrator to check their username and/or password credentials**/
    public function checkUsernameOrPassword(){
        echo "<br/>";
        echo "---------Admin Credetials---------" . "<br/>";
        echo "Admin id: Auto-generated in database" . "<br/>";
        echo "Admin Username: " . $this->getAdminUsername() . "<br/>";
        echo "Admin Password: " . $this->getAdminPassword() . "<br/>";
        echo "Role: " . $this->getRole() . "<br/>";
        echo "<br/>";
    }// end checkUsernameOrPassword

    /** Display Method - for testing**/
    public function display(){
        echo "<br/>";
        echo "---------Admin Credetials---------" . "<br/>";
        echo "Admin id: Auto-generated in database" . "<br/>";
        echo "Admin Username: " . $this->getAdminUsername() . "<br/>";
        echo "Admin Password: " . $this->getAdminPassword() . "<br/>";
        echo "<br/>";
    }// end display

}// end class

// test case 1
//$admin = new Admin();
//$admin->display();

// test case 2
//$admin = new Admin("", "");
//$admin->display();

// test case 3
//$admin = new Admin(null, null);
//$admin->display();

// test case 4
//$admin = new Admin("Matthew", "Monkey");
//$admin->display();

// test case 5 - testing access to the extended class
//-- Test cases involving database are displayed on "ViewUsers.inc.php" page

?>