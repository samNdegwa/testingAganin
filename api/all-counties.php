<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

//initializing our api
include_once('../core/init.php');

//Instatiate product
$county = new County($db);

//products query
$result = $county->getAllProducts();

//get the row count
$num = $result->rowCount();

if($num > 0) {
    $county_arr = array();
    $county_arr['counties'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $county_item = array(
            'id'           =>$id,
            'name'         =>$name
        );
        array_push($county_arr['counties'], $county_item);
    }
    // convert to JSON and output
    echo json_encode($county_arr);


} else {

    echo json_encode(array('message' =>'No county found'));

}
?>