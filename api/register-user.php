<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//initializing our api
include_once('../core/init.php');

//instantiate post

$user = new User($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$user->password = md5($data->password);
$user->email = $data->email;
$user->fname = $data->fname;
$user->lname = $data->lname;
$user->phoneNumber  = $data->phoneNumber;
$user->country = $data->country;
$user->county = $data->county;
$user->sub_county = $data->sub_county;
$user->city = $data->city;
$user->postal_address = $data->postal_address;



//create order
if($user->registerNewUser()) {
    echo json_encode(
        array('message' =>'Success', 'user_id' =>$user->conn->lastInsertId())
    );
} else {
    echo json_encode(
        array('message' =>'Fail')
    );
}

?>