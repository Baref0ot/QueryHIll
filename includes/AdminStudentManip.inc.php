<?php
include_once(dirname(__FILE__,2) . "/classes/Admin.class.php");
include_once(dirname(__FILE__,2) . "/classes/Student.class.php");
class AdminStudentManip extends Admin{
    // global student object variable reference
    public $student;

    /******************************************************************* Student Database Display *******************************************************************/

        /** Allows the client to easily create a new student and add them to the database given that are an adminstrator **/
        function addStudent($theStudentUserID, $theStudentPassword, $theFirst_Name, $theMiddle_Name, $theLast_Name, $theSchoolName, $theEmail, $theMarks, $theRole){
            // data must (will) go through the global validateInput objects setMethod security checks (has not yet been created as of 11/07/2019).
            if($this->createNewStudent($theStudentUserID, $theStudentPassword, $theFirst_Name, $theMiddle_Name, $theLast_Name, $theSchoolName, $theEmail, $theMarks, $theRole)){
                return true;
            }// end if 
            else{
                return false;
            }// end else
        }// end addStudent


        /** Allows the client to easily view all the students in the browser given that they are an administrator **/
        function selectAllStudents(){
            $listOfStudents = $this->getAllStudents();
            echo "<br/>";
            echo "---------List Of Students---------";
            foreach($listOfStudents as $student){
                echo "<br/>";
                echo $student['student_ID']." ";
                echo $student['studentUserID']." ";
                echo $student['studentPassword']." ";
                echo $student['first_Name']." ";
                echo $student['middle_Name']." ";
                echo $student['last_Name']." ";
                echo $student['schoolName']." ";
                echo $student['email']." ";
                echo $student['marks']." ";
                echo $student['role']." ";
                echo "<br/>";
            }// end foreach
        }// end selectAllStudents


        /** Allows the client to easily view a student in the browser by their username given that they are an administrator.7 **/
        function viewStudentProfile($aUsername, $aUniqueRowKey = null){
            if($this->getAStudent($aUsername, $aUniqueRowKey)){
                $listOfThisStudent = $this->getAStudent($aUsername, $aUniqueRowKey);
                foreach($listOfThisStudent as $studentRow){
                    // assigning the database data to the student objects constructor to instanciate a student object.
                    $someUniqueStudentKey = $studentRow['student_ID'];
                    $someStudentId = $studentRow['studentUserID'];
                    $someStudentPassword = $studentRow['studentPassword'];
                    $someFirstName = $studentRow['first_Name'];
                    $someMiddleName = $studentRow['middle_Name'];
                    $someLastName = $studentRow['last_Name'];
                    $someSchoolName = $studentRow['schoolName'];
                    $someEmail = $studentRow['email'];
                    $someGrade = $studentRow['marks'];
                    $someRole = $studentRow['role'] ;
                    //echo "<br/>";
                    // create a global student object and set it's properties based on database values.
                    global $student;
                    return $student = new Student($someUniqueStudentKey, $someStudentId, $someStudentPassword, $someFirstName, $someMiddleName, $someLastName, $someSchoolName, $someEmail, $someGrade, $someRole);
                    //$student->display();
                }// end foreach
            }// end if a student was found in the database
            else{
                return false;
            }// end else
        }// end viewStudentProfile 


        /** Allows the client to easily update a students profile.**/
        function editStudentProfile(){
            global $student;
            $someUniqueStudentKey = $student->getUnique_studentKey();
            $someStudentId = $student->getStudentUserID();
            $someStudentPassword = $student->getStudentPassword();
            $someFirstName = $student->getFirstName();
            $someMiddleName = $student->getMiddleName();
            $someLastName = $student->getLastName();
            $someSchoolName = $student->getSchoolName();
            $someEmail = $student->getEmail();
            $someGrade = $student->getGrade();
            $someRole = $student->getRole();
            if($this->updateAStudent($someUniqueStudentKey, $someStudentId, $someStudentPassword, $someFirstName, $someMiddleName, $someLastName, $someSchoolName, $someEmail, $someGrade, $someRole)){
                return true;
            }// end if
            else{
                return false;
            }// end else
        }// end editStudentProgile


        /** Allows the client to easily delete a student in the browser by their username given that they are an administrator. **/
        function deleteStudent(){
            global $student;
            $studentUserName = $student->getStudentUserID();
            $student_ID = $student->getUnique_studentKey();
            if($this->deleteAStudent($studentUserName, $student_ID)){
                return true;
            }// end if
            else{
                return false;
            }// end else
        }// end deleteStudent

    /******************************************************************* END Student Database View *******************************************************************/
}// end class


//// check if the studentID_Text box has a value entered and the cooresponding checkbox is checked.
//if(isset($_POST['StudentID_Textbox']) && isset($_POST['studentDB_Checkbox'])){
//    if(isset($_POST['select_Submit_Button'])){
//    // get the users input
//    $entered_StudentUserID = $_POST['StudentID_Textbox'];
//
//    // get view the student profile cooresponding with the entered student userID.
//    $admin = new AdminStudentManip();
//    $admin->viewStudentProfile($entered_StudentUserID);
//
//    // display the student data colected from the database and store them in variables
//    global $student;
//    $theStudentId = $student->getStudentUserID();
//    $theStudentPassword = $student->getStudentPassword();
//    $theFirstName = $student->getFirstName();
//    $theMiddleName = $student->getMiddleName();
//    $theLastName = $student->getLastName();
//    $theSchoolName = $student->getSchoolName();
//    $theEmail = $student->getEmail();
//    $theRole = $student->getRole();
//
//    // display the student data variables in the corresponding form text boxes.
//    $_POST['userID']->value = $theStudentId;
//    header('Location: ../HTML_Files/Admin_HTML/adminmainpage.php');
//    }// end if submit button was clicked
//}// end if student user Id input box and associated check box was checked








/*************************************************************************** TESTING CASES ***************************************************************************/
//// test case (testing inheritance - passing of arguments via constructor of parent and this child class - instanciation of parent and child objects - and setters and getters.)
//$admin = new AdminStudentManip();
//echo $admin->getUsername() . "<br/>";
//echo $admin->getPassword() . "<br/>";
//$admin->setUsername("Matthew");
//$admin->setPassword("MonkeyBoy65");
//echo $admin->getUsername() . "<br/>";
//echo $admin->getPassword() . "<br/>";
//$admin->display();
//// test
//$admin2 = new Admin("Fred Rogers", "Bossman445");
//$admin2->display();
//// test
//$admin3 = new AdminStudentManip("Mark Ruffalo", "Strong Boy");
//$admin3->display();

// test case 5 - from Admin.php (testing select all students)
//$admin = new AdminStudentManip();
//$admin->display();
//$admin->selectAllStudents();

// test case 6 (testing select a student - potentially multiple rows - based on the username)
//$admin = new AdminStudentManip();
//$admin->viewStudentProfile('JacobIsMaBud');
//$admin->editStudentProfile();

// test case 7 (testing select a specific row of student data based on username and unique row key)
//$admin = new AdminStudentManip();
//$admin->viewStudentProfile('Baref0ot', 16);
//$student->display();

// test case 8 (testing select a specific row of student data based on username and unique row key - 2)
//$admin = new AdminStudentManip();
//$admin->viewStudentProfile('Baref0ot', 16);
//$student->display();

//// test case 9 (testing delete a specific row of student data based on username and unique row key)
//$admin = new AdminStudentManip();
//$admin->display();
//$admin->viewStudentProfile('Baref0ot' , 14);
//$admin->deleteStudent();

//// test case 9 (testing delete a specific row of student data based on username and unique row key - 2)
//$admin = new AdminStudentManip();
//$admin->display();
//$admin->viewStudentProfile('FatLard', 30);
//$admin->deleteStudent();

// test case 10 (testing create a student in the database)
//$admin = new AdminStudentManip();
//$admin->addStudent('Baref0ot', 'Monkeyboy89', 'Matthew', 'Lee', 'Wright', 'MLW@gmail.com', 'CTC', 101, 'student');
//$admin->addStudent('FatLard', 'BiggerThanYourMom3000', 'Suzie', 'Burtha', 'Lue', 'SBL@gmail.com', 'CTC', 104, 'student');

//// test case 11 (testing the "editStudentProfile" method which works in conjuction with the "viewStudentProfile" method to update an existing student.)
//$admin1 = new AdminStudentManip();
//$admin1->viewStudentProfile('MonkeyMan', 29);
//$student->setStudentUserID('Baref0ot');
//$student->setFirstName('Matthew');
//$student->setStudentPassword('MonkeyBoy75');
//$student->setEmail('OldSoul@CodeEvergreenllc.com');
//echo "<br/>";
//$student->display();
//$admin1->editStudentProfile();

//// test case 11 - 2
//$admin = new AdminStudentManip();
//$admin->viewStudentProfile('BuckWheat', 25);
//$student->setStudentUserID('JacobIsMaBud');
//echo "<br/>";
//$student->display();
//$admin->editStudentProfile();
?>