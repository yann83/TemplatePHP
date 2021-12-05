<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "php_templatephp";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db;charset=utf8", $username, $password);
    
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }