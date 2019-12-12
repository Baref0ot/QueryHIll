<?php



 class Database {

 	 private $hostdb = "127.0.0.1";//"localhost" //for webserver "gator4207.hostgator.com"

 	 private $userdb = "root";//"root" //for webserver "baref0ot_65"

 	 private $passdb = "";//"" //for webserver "php2project"

 	 private $namedb = "php2_project";//"php2_project" //for web server "baref0ot_php2_project"

 	 public $pdo; 



 	public function __construct(){

 		 if (!isset($this->pdo)) {

 		 	try{

                $link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb, $this->userdb, $this->passdb);

                // to make error messages visible on the page

                //error reporting and throw exceptions

                  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $link->exec("SET CHARACTER SET utf8");

                  $this->pdo = $link; // assigned pdo into the link 



 		 	} catch(PDOException $e){

            die("Failed to connect with Database".$e->getMessage());

 		 	}

 		 }

 	}

 }
