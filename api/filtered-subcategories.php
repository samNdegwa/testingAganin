<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//instantiate post

$sub_category = new sub_category($db);

$sub_category->id = isset($_GET['id']) ? $_GET['id'] : die();
$result = $sub_category->read_filter_subcategories();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $cat_arr = array();
    $cat_arr['sub_categories'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $cat_item = array(
            'id'            =>$id,
            'cat_id'        =>$cat_id,
            'name'          =>$name
        );
        array_push($cat_arr['sub_categories'], $cat_item);
    }
    // convert to JSON and output
    echo json_encode($cat_arr);


} else {

    echo json_encode(array('message' =>'No sub categories found'));

}
?>