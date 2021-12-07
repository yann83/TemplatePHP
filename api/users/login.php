<?php
/*
GET URL/api/users/login.php
Body->raw(JSON)
{
    "username": "user",
    "password": "user"
}
renvoie
{
    "message": "Successful login.",
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJUSEVfSVNTVUVSIiwiYXVkIjoiVEhFX0FVRElFTkNFIiwiaWF0IjoxNjM3ODQ3ODkwLCJuYmYiOjE2Mzc4NDc5MDAsImV4cCI6MTYzNzg0Nzk1MCwiZGF0YSI6eyJpZCI6IjIiLCJ1c2VybmFtZSI6InVzZXIiLCJlbWFpbCI6InVzZXJAdXNlci5mciJ9fQ.0Mn6ZcAdreI3AEKK2CgrMkAFIusSJpfz5dQpusiNP3o",
    "email": "user@user.fr",
    "expireAt": 1637847950
}
*/
include_once '../config/database.php';
require '../vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$username = '';
$password = '';

$databaseService = new Database();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

$table_name = 'php_templatephp.users';

//$query = "SELECT id, first_name, last_name, password FROM " . $table_name . " WHERE email = ? LIMIT 0,1";
$query = "SELECT ".$table_name.".id,
            ".$table_name.".username,
            ".$table_name.".email,
            ".$table_name.".password 
            FROM ".$table_name." 
            WHERE ".$table_name.".username = ? LIMIT 0,1";

$stmt = $conn->prepare( $query );
$stmt->bindParam(1, $username);
$stmt->execute();
$num = $stmt->rowCount();

if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];
    $password2 = $row['password'];

    //echo json_encode($password);
    //echo json_encode($password2);

    if(password_verify($password, $password2))
    {
        $secret_key = "secretpassword";
        $issuer_claim = "THE_ISSUER"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + 86400; // expire time in seconds here 24 h
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "username" => $username,
                "email" => $email
        ));

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
                "expireAt" => $expire_claim
            ));
    }
    else{

        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
}
?>