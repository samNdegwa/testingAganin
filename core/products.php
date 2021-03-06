<?php
class Product {
    //database declarations
    public $conn;

    //product properties
    public $category;
    public $sub_category;
    public $title;
    public $description;
    public $price;
    public $quantity;
    public $image;
    public $id;

    //constructor with db connection
     public function __construct($db) {
         $this->conn = $db;
     }

     // getting products from db
     public function getAllProducts(){
         // query
        $productsQuery ='SELECT 
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
            LIMIT 18';

           //prepare statement
           $stmt = $this->conn->prepare($productsQuery);
           //execute query
           $stmt->execute();

           return $stmt;
     }

     // getting single product from database
 public function read_single_product() {
    //create query
    $productQuery ='SELECT 
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
           categories c ON sc.cat_id = c.id WHERE p.id= ? ';

          //prepare statement
          $stmt = $this->conn->prepare($productQuery);
          //binding param
          $stmt->bindParam(1, $this->id);
           //execute query
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           $this->name = $row['name'];
           $this->category = $row['category'];
           $this->sub_category = $row['sub_category'];
           $this->description = $row['description'];
           $this->quantity = $row['quantity'];
           $this->price = $row['price'];
           $this->image = $row['image'];
}

// getting single product from database
public function read_product_category() {
    //create query
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
           categories c ON sc.cat_id = c.id WHERE c.title LIKE  '%$this->cat%'";

          //prepare statement
          $stmt = $this->conn->prepare($productQuery);
          //binding param
          $stmt->bindParam(1, $this->cat);
           //execute query
           $stmt->execute();

           return $stmt;

}

// function to update product quantity
public function updateQuantity() {
    //create query
    $query = 'UPDATE products SET quantity = :quantity WHERE id = :id';
    //prepare statement
    $stmt = $this->conn->prepare($query);
    //clean data 
    $this->id                =htmlspecialchars(strip_tags($this->id));
    $this->quantity          =htmlspecialchars(strip_tags($this->quantity));
    
    //binding of paramters
    $stmt->bindParam(':id',$this->id);
    $stmt->bindParam(':quantity',$this->quantity);
    
    //execute the query
    if($stmt->execute()) {
        return true;
    }
    //print error if something goes wrong
    printf("Error %s. \n", $stmt->error);
    return false;
}
}
?>