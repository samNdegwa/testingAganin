<?php
class Address {
	//database declarations
    public $conn;

    //Adderss properties
    public $id;
    public $phone_number;
    public $county_to_send;
    public $sub_county;
    public $city;
    public $postal_address;
    public $description;
    public $order_id;

    //constructor with db connection
     public function __construct($db) {
        $this->conn = $db;
    }

    //create addres function
    public function createAddress() {
        $orderQuery = 'INSERT INTO addresses SET phone_number = :phone_number, county_to_send = :county_to_send, sub_county = :sub_county, city = :city, postal_address = :postal_address, description = :description, order_id = :order_id';
        //prepare statement
        $stmt = $this->conn->prepare($orderQuery);

        //clean data
        $this->phone_number           =htmlspecialchars(strip_tags($this-> phone_number));
        $this->county_to_send         =htmlspecialchars(strip_tags($this-> county_to_send));
        $this->sub_county             =htmlspecialchars(strip_tags($this-> sub_county));
        $this->city                   =htmlspecialchars(strip_tags($this-> city));
        $this->postal_address         =htmlspecialchars(strip_tags($this-> postal_address));
        $this->description            =htmlspecialchars(strip_tags($this-> description));
        $this->order_id               =htmlspecialchars(strip_tags($this-> order_id));

         //binding of paramters
        $stmt->bindParam(':phone_number',$this->phone_number);
        $stmt->bindParam(':county_to_send',$this->county_to_send);
        $stmt->bindParam(':sub_county',$this->sub_county);
        $stmt->bindParam(':city',$this->city);
        $stmt->bindParam(':postal_address',$this->postal_address);
        $stmt->bindParam(':description',$this->description);
        $stmt->bindParam(':order_id',$this->order_id);

       // $last = conn->insert_id;
    
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