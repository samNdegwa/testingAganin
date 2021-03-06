<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$product = new Order($db);

$product->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
$result = $product->read_user_orders();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $product_arr = array();
    $product_arr['orders'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            'id'               =>$id,
            'user_id'          =>$user_id,
            'date_placed'      =>$date_placed,
            'amount_due'       =>$amount_due,
            'amount_paid'      =>$amount_paid,
            'status'           =>$status
            
        );
        array_push($product_arr['orders'], $product_item);
    }
    // convert to JSON and output
    echo json_encode($product_arr);


} else {

    echo json_encode(array('message' =>'No order found'));

}
?>