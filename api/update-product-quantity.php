<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//initializing our api
include_once('../core/init.php');

//instantiate post

$product = new Product($db);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;
$product->quantity = $data->quantity;

//create post
if($product->updateQuantity()) {
    echo json_encode(
        array('message' =>'Quantity Updated.')
    );
} else {
    echo json_encode(
        array('message' =>'Quantity not Updated.')
    );
}

?>