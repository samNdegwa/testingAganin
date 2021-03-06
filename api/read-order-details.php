<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$product = new Order($db);

$product->id = isset($_GET['id']) ? $_GET['id'] : die();
$result = $product->read_orders_details();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $product_arr = array();
    $product_arr['products'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            'id'               =>$id,
            'product_id'       =>$product_id,
            'name'             =>$name,
            'description'      =>$description,
            'price'            =>$price,
            'quantityOrdered'         =>$quantity,
            'image'            =>$image
        );
        array_push($product_arr['products'], $product_item);
    }
    // convert to JSON and output
    echo json_encode($product_arr);


} else {

    echo json_encode(array('message' =>'No product found'));

}
?>