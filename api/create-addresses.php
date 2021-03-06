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

$address = new Address($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$address->phone_number = $data->phone_number;
$address->county_to_send = $data->county_to_send;
$address->sub_county = $data->sub_county;
$address->city = $data->city;
$address->postal_address = $data->postal_address;
$address->description = $data->description;
$address->order_id = $data->order_id;



//create order
if($address->createAddress()) {
    echo json_encode(
        array('message' =>'Success', 'address_id' =>$address->conn->lastInsertId())
    );
} else {
    echo json_encode(
        array('message' =>'Fail')
    );
}

?>