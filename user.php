<?php
include "connection.php";


if(isset($_GET['login'])){
    $username = filter('username');
    $password = filter('password');

    $stmt = $connect->prepare("SELECT * FROM `accounts` WHERE `username` =? AND `password` = ?");
    $stmt->execute(array($username,$password));
    $count = $stmt->rowCount();
    if($count > 0){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $arr = array('status' => 1, 'data' => $user);
        echo json_encode($arr);
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['update'])){
    $acc_id = filter('acc_id');
    $username = filter('username');
    $password = filter('password');

    $stmt = $connect->prepare("UPDATE `accounts` SET `username` = ? , `password` = ? WHERE `acc_id` = ? ");
    $stmt->execute(array($username,$password,$acc_id));
    $count = $stmt->rowCount();
    if($count > 0){
        echo json_encode(array('status' => 1));
    }
    else{
        echo json_encode(array('status' => 0));
    }
}



?>