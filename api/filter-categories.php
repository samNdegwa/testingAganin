<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$categories = new Category($db);

$categories->cat = isset($_GET['cat']) ? $_GET['cat'] : die();
$result = $categories->read_filter_categories();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $cat_arr = array();
    $cat_arr['categories'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cat_item = array(
            'id'            =>$id,
            'title'         =>$title
        );
        array_push($cat_arr['categories'], $cat_item);
    }
    // convert to JSON and output
    echo json_encode($cat_arr);


} else {

    echo json_encode(array('message' =>'No categories found'));

}
?>