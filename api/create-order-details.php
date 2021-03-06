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

$orderDetail = new Order($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$orderDetail->order_id = $data->order_id;
$orderDetail->product_id = $data->product_id;
$orderDetail->quantity = $data->quantity;


//create order
if($orderDetail->createOrderDetails()) {
    echo json_encode(
        array('message' =>'Order Details Created.')
    );
} else {
    echo json_encode(
        array('message' =>'Order Details not Created.')
    );
}

?>