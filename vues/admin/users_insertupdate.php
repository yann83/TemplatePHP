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
    $user = $_POST['formUser'];
    $email = $_POST['formEmail'];
    $role = $_POST['formRole'];
    $password = password_hash($_POST['formPassword'], PASSWORD_DEFAULT);
    //$passwordCheck = $_POST['formPasswordCheck'];

    if (empty($_POST['id'])){
        $query = "INSERT INTO ".$db.".users (username,password,email,role) VALUE ('$user','$password','$email','$role')";
    } else {
        $query = "UPDATE ".$db.".users set ".$db.".users.id='" . $_POST['id'] . "', 
                                           ".$db.".users.username='" . $_POST['formUser'] . "', 
                                           ".$db.".users.password='" . password_hash($_POST['formPassword'], PASSWORD_DEFAULT) . "', 
                                           ".$db.".users.email='" . $_POST['formEmail'] . "', 
                                           ".$db.".users.role='" . $_POST['formRole'] . "' 
                                           WHERE ".$db.".users.id='" . $_POST['id'] . "'"; 
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