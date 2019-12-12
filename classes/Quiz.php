<?php
include_once 'Database.php';
class Quiz extends Database
{
      private $db;
      private $questionid;
      private $question;
      private $answera;
      private $answerb;
      private $answerc;
      private $answerd;
      private $correctans;
      private $catID;

      function setQuestionid($questionid)
      {
            $this->questionid = $questionid;
      }
      function getQuestionid()
      {
            return $this->questionid;
      }

      function setCatid($catID)
      {
            $this->catID = $catID;
      }
      function getCatid()
      {
            return $this->catID;
      }

      function setQuestion($question)
      {
            $this->question = $question;
      }
      function getQuestion()
      {
            return $this->question;
      }

      function setanswerA($answera)
      {
            $this->answera = $answera;
      }
      function getanswerA()
      {
            return $this->answera;
      }

      function setanswerB($answerb)
      {
            $this->answerb = $answerb;
      }
      function getanswerB()
      {
            return $this->answerb;
      }

      function setanswerC($answerc)
      {
            $this->answerc = $answerc;
      }
      function getanswerC()
      {
            return $this->answerc;
      }

      function setanswerD($answerd)
      {
            $this->answerd = $answerd;
      }
      function getanswerD()
      {
            return $this->answerd;
      }

      function setcorrectAns($correctans)
      {
            $this->correctans = $correctans;
      }
      function getcorrectAns()
      {
            return $this->correctans;
      }

      public function __construct()
      {
            $this->db = new Database(); //created object for the database
      }


      public function insertQuestions()
      {
            //getters are being used
            // htmlentities used to encode user input so that users cannot insert harmful HTML codes into a site.
            $q = htmlentities($this->getQuestion());
            $op1 = htmlentities($this->getanswerA());
            $op2 = htmlentities($this->getanswerB());
            $op3 = htmlentities($this->getanswerC());
            $op4 = htmlentities($this->getanswerD());
            $correctop = htmlentities($this->getcorrectAns());
            $chap = $this->getCatid();


            if ($q == "" or $op1 == "" or $op2 == "" or $op3 == "" or $op4 == "" or $correctop == "" or $chap == "") {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  All fields must be completed </div>";
                  return $msg;
            }
            if (!is_numeric($chap)) {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  chapter must be a number </div>";
                  return $msg;
            }
           if (is_numeric($q) ) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question must not be a number </div>";
                  return $msg;
            }


            $sql = "INSERT INTO questions (question, ans1, ans2, ans3, ans4, correctanswer, chapterid) VALUES (:question, :ans1, :ans2, :ans3, :ans4, :correctanswer, :chapterid)";




            $query = $this->db->pdo->prepare($sql);

            $query->bindValue(':question', $q);
            $query->bindValue(':ans1', $op1);
            $query->bindValue(':ans2', $op2);
            $query->bindValue(':ans3', $op3);
            $query->bindValue(':ans4', $op4);
            $query->bindValue(':correctanswer', $correctop);
            $query->bindValue(':chapterid', $chap);

            $result = $query->execute();

            if ($result) {
                  $msg = "<div style='color:green;'>  Success ! </strong>  All changes have been saved.   </div>";
                  return $msg;
            } else {
                  $msg = "<div style='color:red;' ><strong> Error ! </strong> unable to save.   </div>";
                  return $msg;
            }
      }

      public function viewQuiz()
      {
            $sql = "SELECT * FROM questions ORDER BY questionid";
            $query = $this->db->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            return $result;
      }


      public function updateQuestionData()
      {
            //getters, it pull all data from viewquiz.php
            //htmlentities used to convert characters into corresponding HTML entities .  used to encode user input so that users cannot insert harmful HTML codes into a site.
            $qid = $this->getQuestionid();
            $q = htmlentities($this->getQuestion());
            $op1 = htmlentities($this->getanswerA());
            $op2 = htmlentities($this->getanswerB());
            $op3 = htmlentities($this->getanswerC());
            $op4 = htmlentities($this->getanswerD());
            $correctop = htmlentities($this->getcorrectAns());

            //validation
           if (is_numeric($q) ) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question must not be a number </div>";
                  return $msg;
            }

            if ($qid == "" or $q == "" or $op1 == "" or $op2 == "" or $op3 == "" or $op4 == "" or $correctop == "") {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  All fields must be completed </div>";
                  return $msg;
            }

            if (!is_numeric($qid)) {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question Id must be a number </div>";
                  return $msg;
            }

            $sql = "UPDATE questions set
                      
                       question     = :question, 
                       ans1     = :ans1,
                       ans2     = :ans2,
                       ans3     = :ans3,
                       ans4     = :ans4,
                       correctanswer    = :correctanswer
                        WHERE questionid = :questionid";


            $query = $this->db->pdo->prepare($sql);
            //$query->bindValue(':name' , $name);
            //$query->bindValue(':username' , $username);
            $query->bindValue(':question', $q);
            $query->bindValue(':ans1', $op1);
            $query->bindValue(':ans2', /*$password*/ $op2);
            $query->bindValue(':ans3', $op3);
            $query->bindValue(':ans4', $op4);
            $query->bindValue(':correctanswer', /*$password*/ $correctop);
            $query->bindValue(':questionid', $qid);
            $result = $query->execute();

            if ($result) {

                  $msg = "<div style='color:green;'>  Success ! </strong>  data Updated Successfully   </div>";

                  return $msg;
            } else {
                  $msg = "<div style='color:red;' ><strong> Error ! </strong> User data not Updated.   </div>";
                  return $msg;
            }
      }


      public function deleteQuestionData()
      {
            //getters, it pull all data from viewquiz.php
            $qid = $this->getQuestionid();
            //validation 

            if ($qid == "") {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question Id is required </div>";
                  return $msg;
            }


            if (!is_numeric($qid)) {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question Id must be a number </div>";
                  return $msg;
            }



            $sql = "DELETE  FROM questions WHERE
                      
                       questionid     = :questionid LIMIT 1";


            $query = $this->db->pdo->prepare($sql);
            //$query->bindValue(':name' , $name);
            //$query->bindValue(':username' , $username);
            $query->bindValue(':questionid', $qid);
            $result = $query->execute();

            if ($result) {

                  $msg = "<div style='color:green;'>  Success ! </strong> Question data Deleted Successfully   </div>";

                  return $msg;
            } else {
                  $msg = "<div style='color:red;' ><strong> Error ! </strong> User data not Updated.   </div>";
                  return $msg;
            }
      }


      function findBychapterid(){

            $chap = $this->getCatid();

            //$sql = "SELECT * FROM questions ORDER BY questionid";
            $sql = "SELECT * FROM questions where chapterid = :chapterid";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':chapterid', $chap);
            $result = $query->execute();
            $result = $query->fetchAll();
            return $result;
      }
      // You can probably use the method below, with a changed sql statment to select all the chapter Ids to display in the select box of the "studentHome.php" page.
      
      // created by Matthew Wright 11/30/2019
      function getAllchapters(){
            $sql = "SELECT DISTINCT chapterid FROM questions";
            $result = $this->db->pdo->query($sql);
            return $result;
      }// end getAllchapters



      function ChapterValidation()
      {

            $chap = $this->getCatid();


            $sql = "SELECT * FROM questions where chapterid = $chap";
            $query = $this->db->pdo->prepare($sql);
            $result = $query->execute();
            $result = $query->fetchAll();

            if (!$result) {
                  $msg = "<strong> </strong> No questions created yet for chapter " . $chap;
                  return $msg;
            }
      }

      public function insertTrueFalse()
      {
            //getters are being used
            //ucfirst converts user input to first letter capitalize
            $q = $this->getQuestion();
            $op1 = ucfirst($this->getanswerA());
            $op2 = ucfirst($this->getanswerB());
            $correctop = ucfirst($this->getcorrectAns());
            $chap = $this->getCatid();


            if ($q == "" or $op1 == "" or $op2 == "" or $correctop == "" or $chap == "") {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  All fields must be completed </div>";
                  return $msg;
            }
          if (is_numeric($q) ) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question must not be a number </div>";
                  return $msg;
            }
          
      

            if ($op1 === "True" or $op1 === "False") { } else {
                  $msg = "<div  style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers </div>";
                  return $msg;
            }

            if ($op2 === "True" or $op2 ===  "False") { } else {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers  </div>";
                  return $msg;
            }
            if ($correctop === "True" or $correctop === "False") { } else {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers  </div>";
                  return $msg;
            }




            if ($op1 === $op2) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must not have the same answer. </div>";
                  return $msg;
            }
            if (!is_numeric($chap)) {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  chapter must be a number </div>";
                  return $msg;
            }


            $sql = "INSERT INTO questions (question, ans1, ans2, correctanswer, chapterid) VALUES (:question, :ans1, :ans2, :correctanswer, :chapterid)";




            $query = $this->db->pdo->prepare($sql);

            $query->bindValue(':question', $q);
            $query->bindValue(':ans1', $op1);
            $query->bindValue(':ans2', $op2);
            $query->bindValue(':correctanswer', $correctop);
            $query->bindValue(':chapterid', $chap);

            $result = $query->execute();

            if ($result) {
                  $msg = "<div style='color:green;' > Success ! </strong>  All changes have been saved.   </div>";
                  return $msg;
            } else {
                  $msg = "<div style='color:red;'><strong> Error ! </strong> unable to save.   </div>";
                  return $msg;
            }
      }

      public function updateTrueFalseData()
      {
            //getters, it pull all data from viewquiz.php
            $qid = $this->getQuestionid();
            $q = $this->getQuestion();
            $op1 = ucfirst($this->getanswerA());
            $op2 = ucfirst($this->getanswerB());
            $correctop = ucfirst($this->getcorrectAns());

            //validation

            if ($qid == "" or $q == "" or $op1 == "" or $op2 == "" or $correctop == "") {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  All fields must be completed </div>";
                  return $msg;
            }

            if (is_numeric($q) ) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question must not be a number </div>";
                  return $msg;
            }
          
            if ($op1 === "True" or $op1 === "False") { } else {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers </div>";
                  return $msg;
            }

            if ($op2 === "True" or $op2 ===  "False") { } else {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers  </div>";
                  return $msg;
            }
            if ($correctop === "True" or $correctop === "False") { } else {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must have a true or false answer only. No numbers  </div>";
                  return $msg;
            }




            if ($op1 === $op2) {

                  $msg = "<div style='color:red;'><strong> Error: </strong>  Must not have the same answer. </div>";
                  return $msg;
            }


            if (!is_numeric($qid)) {
                  $msg = "<div style='color:red;'><strong> Error: </strong>  Question Id must be a number </div>";
                  return $msg;
            }

            $sql = "UPDATE questions set
                      
                       question     = :question, 
                       ans1     = :ans1,
                       ans2     = :ans2,
                       correctanswer    = :correctanswer
                        WHERE questionid = :questionid";


            $query = $this->db->pdo->prepare($sql);
            //$query->bindValue(':name' , $name);
            //$query->bindValue(':username' , $username);
            $query->bindValue(':question', $q);
            $query->bindValue(':ans1', $op1);
            $query->bindValue(':ans2', /*$password*/ $op2);
            $query->bindValue(':correctanswer', /*$password*/ $correctop);
            $query->bindValue(':questionid', $qid);
            $result = $query->execute();

            if ($result) {

                  $msg = "<div style='color:green;'>  Success ! </strong>  data Updated Successfully   </div>";

                  return $msg;
            } else {
                  $msg = "<div style='color:red;'><strong> Error ! </strong> User data not Updated.   </div>";
                  return $msg;
            }
      }
}
