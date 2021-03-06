<?php
class Category {
	//database declarations
    public $conn;
    
    //Category properties
    public $id;
    public $title;

    //constructor with db connection
     public function __construct($db) {
         $this->conn = $db;
     }

     // Function to get all categories
     public function getAllCategories(){
     	//create query
    $catQuery ='SELECT id, title FROM categories';

          //prepare statement
          $stmt = $this->conn->prepare($catQuery);
           //execute query
          $stmt->execute();

          return $stmt;
           
     }

     // getting categories in fielter criteria
public function read_filter_categories() {
    //create query
    $catQuery ="SELECT id, title FROM categories WHERE title LIKE '%$this->cat%'";

          //prepare statement
          $stmt = $this->conn->prepare($catQuery);
          //binding param
          $stmt->bindParam(1, $this->cat);
           //execute query
           $stmt->execute();

           return $stmt;

}
}
?>