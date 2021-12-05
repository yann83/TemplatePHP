<?php
/*
POST http://localhost/php/TemplatePhp/api/products/create.php
{
 "name" : "tournevis",
 "price" : "23.20",
 "status" : "on sale",
 "location" : "france"
}
bearer token jwt
*/
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate products object
include_once '../objects/products.php';

// jwt restricted access +++ begin
require __DIR__ .'/../vendor\autoload.php';
use \Firebase\JWT\JWT;

$secret_key="sasi831!";
$jwt=null;
$granted = false;
// jwt restricted access +++ end

$database = new Database();
$db = $database->getConnection();

// jwt restricted access +++ begin
$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
$arr = explode(" ", $authHeader);

if(!$jwt){ 
    http_response_code(401);

    echo json_encode(array(
        "message" => "You need a token."
    ));
} else {
    $jwt = $arr[1];
}

if($jwt){

    try {

        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        $granted = true;

    }catch (Exception $e){

    http_response_code(401);

    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
    }

}

if ($granted) {
// jwt restricted access +++ end
    $products = new Products($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // make sure data is not empty
    if(
        !empty($data->name) &&
        !empty($data->price) &&
        !empty($data->status) &&
        !empty($data->location)
    ){
    
        // set products property values
        $products->name = $data->name;
        $products->price = $data->price;
        $products->status = $data->status;
        $products->location = $data->location;
    
        // create the products
        if($products->create()){
    
            // set response code - 201 created
            http_response_code(201);
    
            // tell the user
            echo json_encode(array("message" => "products was created."));
        }
    
        // if unable to create the products, tell the user
        else{
    
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create products."));
        }
    }
    
    // tell the user data is incomplete
    else{
    
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("message" => "Unable to create products. Data is incomplete."));
    }
}
?>