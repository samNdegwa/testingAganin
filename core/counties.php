<?php
class County {
	//database declarations
    public $conn;

    // County properties
    public $id;
    public $name;

    //constructor with db connection
     public function __construct($db) {
         $this->conn = $db;
     }

     // getting products from db
     public function getAllProducts(){
         // query
        $countyQuery ='SELECT id,name FROM counties';

           //prepare statement
           $stmt = $this->conn->prepare($countyQuery);
           //execute query
           $stmt->execute();

           return $stmt;
     }
}

?>