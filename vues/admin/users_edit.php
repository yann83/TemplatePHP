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

$id=$_POST['id'];

$sql = "SELECT * FROM ".$db.".users WHERE ".$db.".users.id = '" . $id . "'";
$stmt= $pdo->prepare($sql);
if ($stmt->execute()) {
    $result = json_encode($stmt->fetchAll());
    //error_log(print_r($result), 3, $logFile);
    echo $result;
} else {
    echo "error";
} 



?>