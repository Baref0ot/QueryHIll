<?php
class DatabaseConnect{

    //--------------------variables for database-------------------
    private $host = "";
    private $user = "";
    private $password = "";
    private $dBName = "";
    private $tableName = "";
    
    //--------------------setters and getters-----------------------
    public function setDBHost($theHostName){
        $this->host = $theHostName;
    }// end setHost()
    public function getDBHost(){
        return $this->host;
    }// end getHost()

    public function setDBUsername($theUserName){
        $this->user = $theUserName;
    }// end setDBUsername()
    public function getDBUsername(){
        return $this->user;
    }// end getDBUsername()

    public function setDBPassword($thePassword){
        $this->password = $thePassword;
    }// end setDBPassword()
    public function getDBPassword(){
        return $this->password;
    }// end getDBPassword()

    public function setDBName($theDatabaseName){
        $this->name = $theDatabaseName;
    }// end setDBName()
    public function getDBName(){
        return $this->name;
    }// end getDBName()

    public function setTableName($theTableName){
        $this->tableName = $theTableName;
    }// end setTableName
    public function getTableName(){
        return $this->tableName;
    }// end getTableName

    /** Change these values within this method based on your phpMyAdmin credentials. **/
    protected function dBConnect(string $theDatabaseName){
        $this->setDBHost("127.0.0.1"); // for webserver gator4207.hostgator.com
        $this->setDBUsername("root"); // for webserver baref0ot_65
        $this->setDBPassword(""); // for webserver php2project
        $this->setDBName($theDatabaseName);
        
        // Database connection variable
        $theConnectionLink = new mysqli($this->getDBHost(), $this->getDBUsername(), $this->getDBPassword(), $this->getDBName());

        // if there is a connection error do not connect and display error else connect to the database.
        if ($theConnectionLink->connect_error) {
            die("Connection failed: It looks like you failed to connect to a database. See the issue below. <br/>" . $theConnectionLink->connect_error);
        }// end if
        else{
            return $theConnectionLink;
        }// end else
    }// end getConnection

}// end class

?>