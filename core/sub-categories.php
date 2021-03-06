<?php
class sub_category {
  //database declarations
    public $conn;
    
    //Category properties
    public $id;
    public $cat_id;
    public $sub_category;
    public $category;
    public $title;
    public $description;
    public $price;
    public $quantity;
    public $image;

    //constructor with db connection
     public function __construct($db) {
         $this->conn = $db;
     }

 public function read_filter_subcategories() {
    //create query
    $catQuery ="SELECT id, cat_id,name FROM sub_categories WHERE cat_id = :id";

          //prepare statement
          $stmt = $this->conn->prepare($catQuery);
          //binding param
          $stmt->bindParam(1, $this->id);
           //execute query
           $stmt->execute();

           return $stmt;

}

public function read_products_from_subcategory() {
	 $productQuery ="SELECT 
           c.title as category,
           sc.name as sub_category,
           p.title as name,
           p.description,
           p.price,
           p.quantity,
           p.image,
           p.id
           FROM
           products p
           JOIN
           sub_categories sc ON p.sub_id = sc.id 
           JOIN
           categories c ON sc.cat_id = c.id
           WHERE sc.name LIKE  '%$this->subcat%'";

          //prepare statement
          $stmt = $this->conn->prepare($productQuery);
          //binding param
          $stmt->bindParam(1, $this->subcat);
           //execute query
           $stmt->execute();

           return $stmt;
}
}
?>