<?php
/*
POST http://localhost/php/TemplatePhp/api/products/delete.php
{
    "id": "4",
}
*/
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/products.php';

// jwt restricted access +++ begin
require __DIR__ .'/../vendor\autoload.php';
use \Firebase\JWT\JWT;

$secret_key="secretpassword";
$jwt=null;
$granted = false;
// jwt restricted access +++ end

// get database connection
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
    // prepare products object
    $products = new Products($db);

    // get products id
    $data = json_decode(file_get_contents("php://input"));

    // set products id to be deleted
    $products->id = $data->id;

    // delete the products
    if ($products->delete()) {

        if ($products->rows_affected > 0) {
            // set response code - 200 ok
            http_response_code(200);

            // tell the user
            echo json_encode(array("message" => "product was deleted."));
        } else {
            // set response code - 400 ok
            http_response_code(400);

            // tell the user
            echo json_encode(array("message" => "product not found."));
        }
    }

    // if unable to delete the products
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to delete product."));
    }
}
?>