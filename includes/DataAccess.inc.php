<?php
include(dirname(__FILE__,2) . "/classes/DatabaseConnect.class.php");
class DataAccess extends DatabaseConnect{
    private $theDatabase = "php2_project"; // for localhost php2_project  // for server baref0ot_php2_project
    // global database getter
    public function getTheDatabase(){
        return $this->theDatabase;
    }// end getThe Database

    /******************************************************************* Student Database Access *******************************************************************/
        /** This method will create a new student **/
        public function createNewStudent($theStudentUserID, $theStudentPassword, $theFirst_Name, $theMiddle_Name, $theLast_Name, $theSchoolName, $theEmail, $theMarks, $theStudentRole){
            if(!(isset($theStudentUserID) || isset($theStudentPassword) || isset($theFirst_Name) || isset($theMiddle_Name) || isset($theLast_Name) || isset($theSchoolName) || isset($theEmail) || isset($theMarks) || isset($theStudentRole))){
                return $theMessage = "All Text fields Must be filled out";
            }else{
                try{
                    $sql = "INSERT INTO students (studentUserID, studentPassword, first_Name, middle_Name, last_Name, schoolName, email, marks, role) VALUES('$theStudentUserID', '$theStudentPassword', '$theFirst_Name', '$theMiddle_Name', '$theLast_Name', '$theSchoolName', '$theEmail', $theMarks, '$theStudentRole')";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);

                    // Was a result successfully added to the database, if so, insert the appreate variables to the user table.
                    if($result === TRUE){
                        // get all of this newly created users' data by the username back out of the database table.
                        $theStudentArray = $this->getAStudent($theStudentUserID);
                        // interate through the array of data returned by the 'getAStudent' method to retrieve the value of the uniqueID and store it in the variable '$theNewTeacherID'
                        $theStudentArray;
                        foreach($theStudentArray as $student){
                            $theNewStudentID = $student['student_ID'];
                        }// end foreach
                        // let the unique id of the inserted object be the same as the parent table and insert the values in the 'users' table.
                        $userssql = "INSERT INTO users (id, username, password, email, role) VALUES($theNewStudentID, '$theStudentUserID', '$theStudentPassword', '$theEmail', '$theStudentRole')";
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch  
            }// end else
        }// end createNewStudent()


        /** This method gets all the student data from the students database **/
        public function getAllStudents(){
            $sql = "SELECT DISTINCT student_ID, studentUserID, studentPassword, first_Name, middle_Name, last_Name, schoolName, email, marks, role FROM students";
            // get a connection to the database.
            $result = $this->dBConnect($this->getTheDatabase())->query($sql);
            // gets the number of rows return from the db results using the built in php property 'num_rows'.
            $numRows = $result->num_rows;
            if($numRows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }// end while
                return $data;
                $result->close();
            }// end if
        }// end getAllStudents


        /** This method gets a specific students data based on their unique username (called studentUserID in the database) **/
        public function getAStudent($theUsername, $theUniqueKey = null){
            if(!isset($theUsername)){
                return $theMessage = "Invalid search criteria.";
            }else{
                try{
                    if($theUniqueKey !== null){
                        $sql = "SELECT DISTINCT student_ID, studentUserID, studentPassword, first_Name, middle_Name, last_Name, schoolName, email, marks, role FROM students WHERE studentUserID = '$theUsername' AND student_ID = $theUniqueKey";
                        //echo "It went through if."; //(was used for testing.)
                    }else{
                        $sql = "SELECT DISTINCT student_ID, studentUserID, studentPassword, first_Name, middle_Name, last_Name, schoolName, email, marks, role FROM students WHERE studentUserID = '$theUsername'";
                        //echo "It went through else."; //(was used for testing.)
                    }// end else
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    // gets the number of rows return from the db results using the built in php property 'num_rows'.
                    $numRows = $result->num_rows;
                    if($numRows > 0){
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                        }// end while
                        return $data;
                        $result->close();
                    }// end if
                    else{
                        return false;
                    }// end else
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch  
            }// end else
        }// end getAStudent()


        /** This method works in conjuction with the "getAStudent" mehode to update the selected student from the database.**/
        public function updateAStudent($theUniqueKey = null, $theStudentUserID = null, $theStudentPassword, $theFirst_Name, $theMiddle_Name, $theLast_Name, $theSchoolName, $theEmail, $theMarks, $aRole){
            if(!isset($theStudentUserID) || !isset($theUniqueKey)){
                return $theMessage = "Invalid search criteria. You must select a student to update.";
            }else{
                try{
                    $sql = "UPDATE students SET studentUserID = '$theStudentUserID', studentPassword = '$theStudentPassword', first_Name = '$theFirst_Name', middle_Name = '$theMiddle_Name', last_Name = '$theLast_Name', schoolName = '$theSchoolName', email = '$theEmail', marks = $theMarks, role = '$aRole' where student_ID = $theUniqueKey";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    if($result === TRUE){
                        $userssql = "UPDATE users SET id = $theUniqueKey, username = '$theStudentUserID', password = '$theStudentPassword', email = '$theEmail', role = '$aRole' where id = $theUniqueKey"; 
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                    $result->close();
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch
            }// end else
        }// end updateAStudent


        /** This method to delete the selected student data from the students database based on their unique unsername (called studentUserID in the database) **/
        public function deleteAStudent($theUsername, $theUniqueKey){
            if(!isset($theUsername)){
                return false;
            }else{
                try{
                    $sql = "DELETE FROM students WHERE studentUserID = '$theUsername' AND student_ID = '$theUniqueKey'";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    if($result === TRUE){
                        // delete data from users table
                        $userssql = "DELETE FROM users WHERE username = '$theUsername' AND id = $theUniqueKey";
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                    $result->close();
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch
            }// end else
        }// end getAllStudents
    /******************************************************************* END Student Database Access *******************************************************************/


    /******************************************************************* Teacher Database Access *******************************************************************/
        /** This method will create a new student **/
        public function createNewTeacher($theTeacherUserID, $theTeacherFirstName, $theTeacherMiddleName, $theTeacherLastName, $theTeacherEmail, $theTeacherPassword, $theSchoolName, $theTeacherRole){
            if(!(isset($theTeacherUserID) || isset($theTeacherFirstName) || isset($theTeacherMiddleName) || isset($theTeacherLastName) || isset($theTeacherEmail) || isset($theTeacherPassword) || isset($theSchoolName) || isset($theTeacherRole))){
                return $theMessage = "All Text fields Must be filled out";
            }else{
                try{
                    $sql = "INSERT INTO teacher (firstName, middleName, lastName, username, password, email, schoolName, role) VALUES('$theTeacherFirstName', '$theTeacherMiddleName', '$theTeacherLastName', '$theTeacherUserID', '$theTeacherPassword', '$theTeacherEmail', '$theSchoolName', '$theTeacherRole')";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    // Was a result successfully added to the database, if so, insert the appreate variables to the user table.
                    if($result === TRUE){
                        // get all of this newly created users' data by the username back out of the database table.
                        $theTeacherArray = $this->getATeacher($theTeacherUserID);
                        // interate through the array of data returned by the 'getATeacher' method to retrieve the value of the uniqueID and store it in the variable '$theNewTeacherID'
                        $theNewTeacherID = 0;
                        foreach($theTeacherArray as $teacher){
                            $theNewTeacherID = $teacher['id'];
                        }// end foreach
                        // let the unique id of the inserted object be the same as the parent table and insert the values in the 'users' table.
                        $userssql = "INSERT INTO users (id, username, password, email, role) VALUES($theNewTeacherID, '$theTeacherUserID', '$theTeacherPassword', '$theTeacherEmail', '$theTeacherRole')";
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch  
            }// end else
        }// end createNewTeacher()


        /** This method gets all the Teacher data from the students database **/
        public function getAllTeachers(){
            $sql = "SELECT DISTINCT id, firstName, middleName, lastName, username, password, email, schoolName, role FROM teacher";
            // get a connection to the database.
            $result = $this->dBConnect($this->getTheDatabase())->query($sql);
            // gets the number of rows return from the db results using the built in php property 'num_rows'.
            $numRows = $result->num_rows;
            if($numRows > 0){
                while($row = $result->fetch_assoc()){
                    $data[] = $row;
                }// end while
                return $data;
                $result->close();
            }// end if
        }// end getAllTeachers


        /** This method gets a specific teachers data based on their unique username (called studentUserID in the database) **/
        public function getATeacher($aUsername, $aUniqueID = null){
            if(!isset($aUsername)){
                echo "Invalid search criteria.";
            }else{
                try{
                    if($aUniqueID !== null){
                        $sql = "SELECT DISTINCT id, username, password, firstName, middleName, lastName, email, schoolName, role FROM teacher WHERE username = '$aUsername' AND id = $aUniqueID";
                        //echo "It went through if."; //(was used for testing.)
                    }else{
                        $sql = "SELECT DISTINCT id, username, password, firstName, middleName, lastName, email, schoolName, role FROM teacher WHERE username = '$aUsername'";
                        //echo "It went through else."; //(was used for testing.)
                    }// end else
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    // gets the number of rows return from the db results using the built in php property 'num_rows'.
                    $numRows = $result->num_rows;
                    if($numRows > 0){
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                        }// end while
                        $result->close();
                        return $data;
                    }// end if
                    else{
                        return false;
                    }// end else
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch  
            }// end else
        }// end getATeacher()


        /** This method works in conjuction with the "getATeacher" method to update the selected teacher from the database. **/
        public function updateATeacher($aUniqueID, $aUsername, $aPassword, $aFirstName, $aMiddleName, $aLastName, $aEmail, $aSchoolName, $aRole){
            if(!isset($aUsername) || !isset($aUniqueID)){
                return $theMessage = "Invalid search criteria. You must select a teacher to update.";
            }else{
                try{
                    $sql = "UPDATE teacher SET firstName = '$aFirstName', middleName = '$aMiddleName', lastName = '$aLastName', username = '$aUsername', password = '$aPassword', email = '$aEmail', schoolName = '$aSchoolName', role = '$aRole' where id = $aUniqueID";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    if($result === TRUE){
                        $userssql = "UPDATE users SET id = $aUniqueID, username = '$aUsername', password = '$aPassword', email = '$aEmail', role = '$aRole' where id = $aUniqueID"; 
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                    $result->close();
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch
            }// end else
        }// end updateATeacher


        /** This method works in conjuction with the "getATeacher" method to delete the selected teacher from the database. **/
        function deleteATeacher($aUsername, $aUniqueID){
            if(!isset($aUsername)){
                return $theMessage = "Invalid search criteria.";
            }else{
                try{
                    $sql = "DELETE FROM teacher WHERE username = '$aUsername' AND id = $aUniqueID";
                    // get a connection to the database.
                    $result = $this->dBConnect($this->getTheDatabase())->query($sql);
                    if($result === TRUE){
                        $wasSuccessfulDelete = "One row of data has been deleted.";
                        // delete data from users table
                        $userssql = "DELETE FROM users WHERE username = '$aUsername' AND id = $aUniqueID";
                        // get a connection to the database.
                        $result = $this->dBConnect($this->getTheDatabase())->query($userssql);
                        return true;
                    }else{
                        return false;
                    }// end else
                    $result->close();
                }// end try
                catch(mysqli_sql_exception $e){
                    echo $e->errorMessage();
                }// end catch
            }// end else
        }// end deleteATeacher

    /******************************************************************* END Teacher Database Access *******************************************************************/


    /******************************************************************* Users Database Access *******************************************************************/
    /** This method gets all the student data from the students database **/
    public function getAllUsers(){
        $sql = "SELECT DISTINCT id, username, password, email, role FROM users";
        // get a connection to the database.
        $result = $this->dBConnect($this->getTheDatabase())->query($sql);
        // gets the number of rows return from the db results using the built in php property 'num_rows'.
        $numRows = $result->num_rows;
        if($numRows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }// end while
            return $data;
            $result->close();
        }// end if
    }// end getAllUsers
}// end class 

/******************************************************************* END Users Database Access *******************************************************************/
?>