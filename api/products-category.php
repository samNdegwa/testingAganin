<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$product = new Product($db);

$product->cat = isset($_GET['cat']) ? $_GET['cat'] : die();
$result = $product->read_product_category();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $product_arr = array();
    $product_arr['products'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            'id'               =>$id,
            'category'         =>$category,
            'sub_category'     =>$sub_category,
            'name'             =>$name,
            'description'      =>$description,
            'price'            =>$price,
            'quantity'         =>$quantity,
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