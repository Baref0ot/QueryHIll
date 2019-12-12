<?php
//require_once(realpath(dirname(__FILE__) . '../classes/Admin.class.php'));//AutoClassLoader.inc.php
include_once(dirname(__FILE__,2) . "/classes/Admin.class.php");
include_once(dirname(__FILE__,2) . "/classes/Teacher.class.php");
class AdminTeacherManip extends Admin{
    // global teacher object variable reference
    public $teacher;
    /******************************************************************* Teacher Database Access *******************************************************************/
        /** Allows the client to easily create a new teacher and add them to the database given that are an adminstrator **/
        function addTeacher($theTeacherUserID, $theTeacherFirstName, $theTeacherMiddleName, $theTeacherLastName, $theTeacherEmail, $theTeacherPassword, $theSchoolName, $theTeacherRole){
            // data must (will) go through the global validateInput objects setMethod security checks (has not yet been created as of 11/07/2019).
            if($this->createNewTeacher($theTeacherUserID, $theTeacherFirstName, $theTeacherMiddleName, $theTeacherLastName, $theTeacherEmail, $theTeacherPassword, $theSchoolName, $theTeacherRole)){
                return true;
            }// end if
            else{
                return false;
            }// end else
        }// end addTeacher

        /** Allows the client to easily view all the teachers in the browser given that they are an administrator **/
        function selectAllTeachers(){
            $listOfTeachers = $this->getAllTeachers();
            echo "<br/>";
            echo "---------List Of Teachers---------" . "<br/>";
            foreach($listOfTeachers as $teacher){
                echo "<br/>";
                echo $teacher['id']." ";
                echo $teacher['firstName']." ";
                echo $teacher['middleName']." ";
                echo $teacher['lastName']." ";
                echo $teacher['username']." ";
                echo $teacher['password']." ";
                echo $teacher['email']." ";
                echo $teacher['schoolName']." ";
                echo $teacher['role']." ";
                echo "<br/>";
            }// end foreach
        }// end selectAllTeachers


        /** Allows the client to easily view a teacher in the browser by their username given that they are an administrator.7 **/
        function viewTeacherProfile($aTeacherUserID, $aUniqueRowKey = null){
            if($this->getATeacher($aTeacherUserID, $aUniqueRowKey)){
                $listOfThisTeacher = $this->getATeacher($aTeacherUserID, $aUniqueRowKey);
                //echo "<br/>";
                //echo "<b>---------A Teacher was Selected---------</b>";
                foreach($listOfThisTeacher as $teacherRow){
                    // assigning the database data to the teacher objects constructor to instanciate a student object.
                    $aUniqueID = $teacherRow['id'];
                    $aUsername = $teacherRow['username'];
                    $aPassword = $teacherRow['password'];
                    $aFirstName = $teacherRow['firstName'];
                    $aMiddleName = $teacherRow['middleName'];
                    $aLastName = $teacherRow['lastName'];
                    $aEmail = $teacherRow['email'];
                    $aSchoolName = $teacherRow['schoolName'];
                    $theRole = $teacherRow['role'];
                    //echo "<br/>";
                    // create a global teacher object and set it's properties based on database values.
                    global $teacher;
                    return $teacher = new Teacher($aUniqueID, $aUsername, $aPassword, $aFirstName, $aMiddleName, $aLastName, $aEmail, $aSchoolName, $theRole);
                    //$teacher->display();
                }// end foreach
            }// end if data was returned
            else{
                return false;
            }// end else
        }// end viewTeacherProfile


        /** Works in conjection with "ViewTeacherProfile()" method and Allows the client to easily update a teachers profile. **/
        function editTeacherProfile(){
            global $teacher;
            $someUniqueTeacherKey = $teacher->getUniqueID();
            $someTeacherUserId = $teacher->getuserName();
            $someTeacherPassword = $teacher->getPassword();
            $someTeacherFirstName = $teacher->getFirstName();
            $someTeacherMiddleName = $teacher->getMiddleName();
            $someTeacherLastName = $teacher->getLastName();
            $someTeacherEmail = $teacher->getEmail();
            $someTeacherSchoolName = $teacher->getSchoolName();
            $someTeacherRole = $teacher->getRole();
            if($this->updateATeacher($someUniqueTeacherKey, $someTeacherUserId, $someTeacherPassword, $someTeacherFirstName, $someTeacherMiddleName, $someTeacherLastName, $someTeacherEmail, $someTeacherSchoolName, $someTeacherRole)){
                return true;
            }// end if
            else{
                return false;
            }// end else
        }// end editTeacherProfile

        /** Allows the client to easily delete a teachers profile. **/
        function deleteTeacher(){
            global $teacher;
            $teacherUserName = $teacher->getuserName();
            $teacherID = $teacher->getUniqueID();
            if($this->deleteATeacher($teacherUserName, $teacherID)){
                return true;
            }// end if
            else{
                return false;
            }// end else      
        }// end deleteTeacher
    /******************************************************************* END Teacher Database Access *******************************************************************/
}// end class











/*************************************************************************** TESTING CASES ***************************************************************************/
// test case (testing inheritance - passing of arguments via constructor of parent and this child class - instanciation of parent and child objects - and setters and getters.)
//$admin = new AdminTeacherManip();
//echo $admin->getUsername() . "<br/>";
//echo $admin->getPassword() . "<br/>";
//$admin->setUsername("Matthew");
//$admin->setPassword("MonkeyBoy65");
////echo $admin->getUsername() . "<br/>";
////echo $admin->getPassword() . "<br/>";
//$admin->display();

//// test case 1
//$admin2 = new Admin("Fred Rogers", "Bossman445");
//$admin2->display();
//// test
//$admin3 = new AdminTeacherManip("Mark Ruffalo", "Strong Boy");
//$admin3->display();

// test case 2 (testing create a student in the database)
//$admin = new AdminTeacherManip();
//$admin->addTeacher('Jerry&Tom124', 'Jerry', '', 'Mamo', 'JerryIsAwesome@gmail.com', 'JerryPassword123', 'teacher');
//$admin->addTeacher('JerrySpringerShow124', 'Jerry', 'Norman', 'Springer', 'JerrySpringer@Yahoo.com', 'JerrySpringBoi321', 'teacher');
//$admin->addTeacher('GaryisAwesome', 'Gary Barfield', 'GaryB@gmail.com', 'GaryB543', 'teacher');
//$admin->addTeacher('Barefoot', 'Matthew Wright', 'MattWasHere@gmail.com', 'Monkeysman56', 'teacher');

// test case 3 (testing the selection of all teachers from the database.)
//$admin = new AdminTeacherManip();
//$admin->selectAllTeachers();

// test case 4 (testing the selection of a potential multiple rows with the same username from the database)
//$admin1 = new AdminTeacherManip();
//$admin1->viewTeacherProfile("JerrySpringerShow124");
//$admin1->editTeacherProfile();

// test case 5 (testing the selection of a specific teacher based off of username and unique database ID.)
//$admin = new AdminTeacherManip();
//$admin->viewTeacherProfile("Jerry&Tom124");

// test case 6 (testing the "editTeacherProfile" method which works in conjuction with the "viewTeacherProfile" method to update a selected teacher in the database.)
//$admin = new AdminTeacherManip();
//$admin->viewTeacherProfile("JerrySpringerShow124"); // the username was already changed and will show an error
//$teacher->setPassword("Rocky123");
//$teacher->setSchoolName("Harvard University");
//echo "<br/><br/>";
//$teacher->display();
//$admin->editTeacherProfile();
//// test case 6 - 2
//$admin = new AdminTeacherManip();
//$admin->viewTeacherProfile("JerrySpringerShow124", 17); // the username was already changed and will show an error
//$teacher->setuserName("JerrysYourDaddy");
//$teacher->setEmail("JerryDrama@JerrySpringerShow.com");
//$teacher->setPassword("YouAreNotTheFather");
//echo "<br/><br/>";
//$teacher->display();
//$admin->editTeacherProfile();


// test case 7 (testing the "deleteTeacher" method which works in conjuntion with the "viewTeacherProfile" method to delete a selected teacher in the database.)
//$admin = new AdminTeacherManip();
//$admin->viewTeacherProfile("Jerry&Tom124");
//$admin->deleteTeacher();
?>