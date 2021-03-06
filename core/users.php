<?php
class User {
	//database declarations
    public $conn;

    //User properties
    public $id;
    public $password;
    public $email;
    public $fname;
    public $lname;
    public $role;
    public $photoUrl;
    public $phoneNumber; 
    public $country;
    public $county; 
    public $sub_county;
    public $city;
    public $postal_address;

    //constructor with db connection
     public function __construct($db) {
        $this->conn = $db;
    }

    // getting user from database
 public function read_single_user() {
    //create query
    $userQuery ='SELECT id, password, email, fname,lname, phoneNumber, country, county, sub_county, city, postal_address,role, photoUrl FROM users WHERE email= :email';

          //prepare statemen
          $stmt = $this->conn->prepare($userQuery);
          //binding param
          $stmt->bindParam(1, $this->email);
           //execute query
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
           $this->id = $row['id'];
           $this->password = $row['password'];
           $this->email = $row['email'];
           $this->fname = $row['fname'];
           $this->lname = $row['lname'];
           $this->phoneNumber = $row['phoneNumber'];
           $this->country = $row['country'];
           $this->county = $row['county'];
           $this->sub_county = $row['sub_county'];
           $this->city = $row['city'];
           $this->postal_address = $row['postal_address'];
           $this->role = $row['role'];
           $this->photoUrl = $row['photoUrl'];
}

 //Register new user
 public function registerNewUser() {
     //create query
    $userQuery = 'INSERT INTO users SET password = :password, email = :email, fname = :fname, lname = :lname, phoneNumber = :phoneNumber, country = :country, county = :county, sub_county = :sub_county, city = :city, postal_address = :postal_address';
        //prepare statement
        $stmt = $this->conn->prepare($userQuery);

        //clean data
        $this->password        =htmlspecialchars(strip_tags($this->password ));
        $this->email           =htmlspecialchars(strip_tags($this->email ));
        $this->fname           =htmlspecialchars(strip_tags($this->fname ));
        $this->lname           =htmlspecialchars(strip_tags($this->lname ));
        $this->phoneNumber     =htmlspecialchars(strip_tags($this->phoneNumber ));
        $this->country         =htmlspecialchars(strip_tags($this->country ));
        $this->county          =htmlspecialchars(strip_tags($this->county ));
        $this->sub_county      =htmlspecialchars(strip_tags($this->sub_county ));
        $this->city            =htmlspecialchars(strip_tags($this->city ));
        $this->postal_address  =htmlspecialchars(strip_tags($this->postal_address ));
        

         //binding of paramters
        $stmt->bindParam(':password',$this->password);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':fname',$this->fname);
        $stmt->bindParam(':lname',$this->lname);
        $stmt->bindParam(':phoneNumber',$this->phoneNumber);
        $stmt->bindParam(':country',$this->country);
        $stmt->bindParam(':county',$this->county);
        $stmt->bindParam(':sub_county',$this->sub_county);
        $stmt->bindParam(':city',$this->city);
        $stmt->bindParam(':postal_address',$this->postal_address);
        
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