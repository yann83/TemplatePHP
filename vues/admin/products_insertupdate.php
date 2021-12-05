<?php
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}

//$logFile = "./errors.log"; 

//include "layout/layout_functions.php";
//echo_header("Login");

include "../../config/pdo-connection.php";

if(count($_POST)>0) { 
    $name = $_POST['formName'];
    $price = $_POST['formPrice'];
    $status = $_POST['formStatus'];
    $location = $_POST['formLocation'];

    if (empty($_POST['id'])){
        $query = "INSERT INTO ".$db.".products (name,price,status,location) VALUE ('$name','$price','$status','$location')";
    } else {
        $query = "UPDATE ".$db.".products set ".$db.".products.id='" . $_POST['id'] . "', 
                                           ".$db.".products.name='" . $_POST['formName'] . "', 
                                           ".$db.".products.price='" . $_POST['formPrice'] . "', 
                                           ".$db.".products.status='" . $_POST['formStatus'] . "', 
                                           ".$db.".products.location='" . $_POST['formLocation'] . "' 
                                           WHERE ".$db.".products.id='" . $_POST['id'] . "'"; 
    }
    error_log($query, 3, $logFile);    

    $sql = $query;
    $stmt= $pdo->prepare($sql);
    if ($stmt->execute()) {
        $result = json_encode($stmt->fetchAll());
        error_log(print_r($result), 3, $logFile);
        echo $result;
    } else {
        echo "error";
    } 
}



?>