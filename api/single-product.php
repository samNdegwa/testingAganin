<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$product = new Product($db);

$product->id = isset($_GET['id']) ? $_GET['id'] : die();
$product->read_single_product();

$product_arr = array(
    'id'                 =>$product->id,
    'name'               =>$product->name,
    'category'           =>$product->category,
    'sub_category'       =>$product->sub_category,
    'description'        =>$product->description,
    'quantity'           =>$product->quantity,
    'image'              =>$product->image,
    'price'              =>$product->price
);

print_r(json_encode($product_arr));
?>