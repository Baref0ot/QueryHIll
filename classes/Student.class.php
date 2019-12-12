<?php
class Student extends DatabaseConnect{

    // Student Properties
    private $uniqueStudentKey = 0;
    private $studentUserID = "";
    private $studentPassword = "";
    private $firstName = "";
    private $middleName = "";
    private $lastName = "";
    private $schoolName = "";
    private $email = "";
    private $grade = "";
    private $role = "student";

    // Student setters and getters
    public function setUnique_studentKey($theUniqueKey){
        $this->uniqueStudentKey = $theUniqueKey;
    }// end setUnique_studentKey
    public function getUnique_studentKey(){
        return $this->uniqueStudentKey;
    }// end getUnique_studentKey

    public function setStudentUserID($theStudentUserID){
        $this->studentUserID = $theStudentUserID;
    }// end setStudentId
    public function getStudentUserID(){    
        return $this->studentUserID;
    }// end getStudentUserID

    public function setStudentPassword($theStudentPassword){
        $this->studentPassword = $theStudentPassword;
    }// end setStudentPassword()
    public function getStudentPassword(){
        return $this->studentPassword;
    }// end getStudentPassword

    public function setFirstName($theFirstName){
        $this->firstName = $theFirstName;
    }// end setFirstName
    public function getFirstName(){
        return $this->firstName;
    }// end getFirstName

    public function setMiddleName($theMiddleName){
        $this->middleName = $theMiddleName;
    }// end setMiddleName
    public function getMiddleName(){
        return $this->middleName;
    }// end getMiddleName

    public function setLastName($theLastName){
        $this->lastName = $theLastName;
    }// end setLastName
    public function getLastName(){
        return $this->lastName;
    }// end getLastName

    public function setSchoolName($theSchoolName){
        $this->schoolName = $theSchoolName;
    }// end setSchoolName
    public function getSchoolName(){
        return $this->schoolName;
    }// end getSchoolName

    public function setEmail($theEmail){
        $this->email = $theEmail;
    }// end setEmail
    public function getEmail(){
        return $this->email;
    }// end getEmail

    public function setGrade($theGrade){
        $this->grade = $theGrade;
    }// end setGrade
    public function getGrade(){
        return $this->grade;
    }// end getGrade

    public function setRole($role){
        $this->role = $role;
    }// end setRole
    public function getRole(){
        return $this->role;
    }// end getRole
                                                            
    public function __construct($someUniqueStudentKey = null, $someStudentId, $someStudentPassword, $someFirstName, $someMiddleName, $someLastName, $someSchoolName, $someEmail, $someGrade, $someRole){
        $this->setUnique_studentKey($someUniqueStudentKey);
        $this->setStudentUserID($someStudentId);
        $this->setStudentPassword($someStudentPassword);
        $this->setFirstName($someFirstName);
        $this->setMiddleName($someMiddleName);
        $this->setLastName($someLastName);
        $this->setSchoolName($someSchoolName);
        $this->setEmail($someEmail);
        $this->setGrade($someGrade);  
        $this->setRole($someRole);    
    }// paramaterized __construct

    // display for testing
    public function display(){
        echo "Unique Row Id: " . $this->getUnique_studentKey() . "<br/>";
        echo "User Id: " . $this->getStudentUserID() . "<br/>";
        echo "Password: " . $this->getStudentPassword() . "<br/>";
        echo "First Name: " . $this->getFirstName() . "<br/>";
        echo "Middle Name: " . $this->getMiddleName() . "<br/>";
        echo "Last Name: " . $this->getLastName() . "<br/>";
        echo "Email: " . $this->getEmail() . "<br/>";  
        echo "School Name: " . $this->getSchoolName() . "<br/>";   
        echo "Grade: " . $this->getGrade() . "<br/>";
        echo "Role: " . $this->getRole() . "<br/>";
    }// end display

}// end class

// testing
//$s1 = new Student('30000456', 'Monkey123', 'Matthew', 'Lee', 'Wright', 'Mattwright@gmail.com', 'CTC', 4.0);
//$s1->display();
?>
