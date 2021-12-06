<?php
/*
GET http://localhost/php/TemplatePhp/api/products/read_one.php?id=1
*/
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/products.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$products = new Products($db);
 
// set ID property of record to read
$products->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of products to be edited
//$products->readOne();

// query productss
$stmt = $products->readOne();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // productss array
    //$productss_arr=array();
    $productss_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $products_item=array(
            "name" => $name,
            "price" => $date_mod,
            "status" => $status,
            "location" => $location
        );
 
        array_push($productss_arr["records"], $products_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show productss data in json format
    echo json_encode($productss_arr);
}
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No product found.")
    );
}


/*
// read the details of profilesapp to be edited
$profilesapp->readOne();

if($profilesapp->name!=null){
    // create array
    $profilesapp_arr = array(
         "apps_id" => $profilesapp->apps_id,
         "name" => $profilesapp->name
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($profilesapp_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user profilesapp does not exist
    echo json_encode(array("message" => "Profilesapp does not exist."));
}*/
?>