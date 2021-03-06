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

$order = new Order($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$order->user_id = $data->user_id;
$order->date_placed = $data->date_placed;
$order->amount_due = $data->amount_due;


//create order
if($order->createOrder()) {
    echo json_encode(
        array('message' =>'Success', 'order_id' =>$order->conn->lastInsertId())
    );
} else {
    echo json_encode(
        array('message' =>'Fail')
    );
}

?>