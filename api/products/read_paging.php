<?php
/*
GET http://localhost/php/TemplatePhp/api/products/read_paging.php
*/
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/products.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and products object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$products = new Products($db);
 
// query productss
$stmt = $products->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // productss array
    $productss_arr=array();
    $productss_arr["records"]=array();
    $productss_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $products_item=array(
            "id" => $id,
            "name" => $name,
            "price" => $price,
            "status" => $status,
            "location" => $location
        );
 
        array_push($productss_arr["records"], $products_item);
    }
 
 
    // include paging
    $total_rows=$products->count();
    $page_url="{$home_url}products/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $productss_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($productss_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user productss does not exist
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>