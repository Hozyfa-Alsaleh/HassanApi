<?php
$dbname= "alimobile";
$host = "localhost";
$username = "root";
$password = "";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8");
$dsn = "mysql:host=$host;dbname=$dbname";



try {
    $connect = new PDO($dsn,$username,$password,$options);
    include "functions.php";
} catch (PDOException $ex) {
    echo json_encode($ex -> getMessage());
}


?>