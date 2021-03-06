<?php
class Order {
    //database declarations
    public $conn;

    //Order properties
    public $order_id;
    public $user_id;
    public $product_id;
    public $quantity;
    public $date_placed;
    public $amount_due;
    public $id;

     //constructor with db connection
     public function __construct($db) {
        $this->conn = $db;
    }
    
    //create order function
    public function createOrder() {
        $orderQuery = 'INSERT INTO orders SET  user_id = :user_id, date_placed = :date_placed, amount_due = :amount_due';
        //prepare statement
        $stmt = $this->conn->prepare($orderQuery);

        //clean data
        // $this->id           =htmlspecialchars(strip_tags($this-> conn->lastInsertId()));
        $this->user_id           =htmlspecialchars(strip_tags($this-> user_id));
        $this->date_placed       =htmlspecialchars(strip_tags($this-> date_placed));
        $this->amount_due        =htmlspecialchars(strip_tags($this-> amount_due));

         //binding of paramters
       // $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':user_id',$this->user_id);
        $stmt->bindParam(':date_placed',$this->date_placed);
        $stmt->bindParam(':amount_due',$this->amount_due);

       // $last = conn->insert_id;
    
        //execute the query
         if($stmt->execute()) {
             return true;
         }
        //print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
            return false;
        
    }

    //Create order details function
    public function createOrderDetails() {
        $orderDetailsQuery = 'INSERT INTO orders_details SET order_id = :order_id, product_id = :product_id, quantity = :quantity';
        //prepare statement
        $stmt = $this->conn->prepare($orderDetailsQuery);

        //clean data
        $this->order_id           =htmlspecialchars(strip_tags($this-> order_id));
        $this->product_id         =htmlspecialchars(strip_tags($this-> product_id));
        $this->quantity           =htmlspecialchars(strip_tags($this-> quantity));

         //binding of paramters
        $stmt->bindParam(':order_id',$this->order_id);
        $stmt->bindParam(':product_id',$this->product_id);
        $stmt->bindParam(':quantity',$this->quantity);
    
        //execute the query
         if($stmt->execute()) {
             return true;
         }
        //print error if something goes wrong
        printf("Error %s. \n", $stmt->error);
            return false;
        
    }

    public function read_orders_details() {
 //create query
    $productQuery ="SELECT
           o.id,
           od.product_id, 
           p.title as name,
           p.description,
           p.price,
           p.image,
           od.quantity
           FROM
           orders o
           JOIN
           orders_details od ON od.order_id = o.id 
           JOIN 
           products p ON p.id = od.product_id 

           WHERE o.id = ?";

          //prepare statement
          $stmt = $this->conn->prepare($productQuery);
          //binding param
          $stmt->bindParam(1, $this->id);
           //execute query
           $stmt->execute();

           return $stmt;

}

 public function read_user_orders() {
 //create query
    $productQuery ="SELECT
           id,
           user_id,
           date_placed,
           date_served,
           amount_due, 
           amount_paid,
           status
           FROM orders 
           WHERE user_id = ?";

          //prepare statement
          $stmt = $this->conn->prepare($productQuery);
          //binding param
          $stmt->bindParam(1, $this->user_id);
           //execute query
           $stmt->execute();

           return $stmt;

}

public function read_all_orders() {
    //create query
       $productQuery ="SELECT
              id,
              user_id,
              date_placed,
              date_served,
              amount_due, 
              amount_paid,
              status
              FROM orders";
   
             //prepare statement
             $stmt = $this->conn->prepare($productQuery);
             //binding param
            // $stmt->bindParam(1, $this->user_id);
              //execute query
              $stmt->execute();
   
              return $stmt;
   
   }

   //Read unopen/new orders
   public function read_new_orders() {
    //create query
       $productQuery ="SELECT
              id,
              user_id,
              date_placed,
              date_served,
              amount_due, 
              amount_paid,
              status
              FROM orders WHERE status=0";
   
             //prepare statement
             $stmt = $this->conn->prepare($productQuery);
             //binding param
            // $stmt->bindParam(1, $this->user_id);
              //execute query
              $stmt->execute();
   
              return $stmt;
   
   }

   //Read open orders
   public function read_open_orders() {
    //create query
       $productQuery ="SELECT
              id,
              user_id,
              date_placed,
              date_served,
              amount_due, 
              amount_paid,
              status
              FROM orders WHERE status=1";
   
             //prepare statement
             $stmt = $this->conn->prepare($productQuery);
             //binding param
            // $stmt->bindParam(1, $this->user_id);
              //execute query
              $stmt->execute();
   
              return $stmt;
   
   }

   //Read closed orders
   public function read_closed_orders() {
    //create query
       $productQuery ="SELECT
              id,
              user_id,
              date_placed,
              date_served,
              amount_due, 
              amount_paid,
              status
              FROM orders WHERE status=2";
   
             //prepare statement
             $stmt = $this->conn->prepare($productQuery);
             //binding param
            // $stmt->bindParam(1, $this->user_id);
              //execute query
              $stmt->execute();
   
              return $stmt;
   
   }
   


}
?>