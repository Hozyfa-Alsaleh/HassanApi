<?php

include "connection.php";

if(isset($_GET['insert']))
{
    $device_name = filter('device_name');
    $imei1 = filter('IMEI1');
    $imei2 = filter('IMEI2');
    $color = filter('color');
    $ram = filter('ram');
    $storage = filter('storage');
    $type = filter('type');
    $status = filter('status');
    $describ = filter('describ');
    $seller = filter('seller');
    $buy_date = filter('buy_date');
    $buy_price = filter('buy_price');
    // $customer = filter('customer');
    // $sell_date = filter('sell_date');
    // $sell_price = filter('sell_price');
    
    $stmt = $connect->prepare("INSERT INTO `devices` VALUES(NULL,?,?,?,?,?,?,?,?,?,?,?,?,NULL,NULL,NULL,'1')");
    $stmt->execute(array($device_name,$imei1,$imei2,$color,$ram,$storage,$type,$status,$describ,$seller,$buy_date,$buy_price));
    $count = $stmt->rowCount();
    if($count > 0){
        echo json_encode(array('status' => 1));
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['update']))
{
    $device_id = filter('device_id');
    $device_name = filter('device_name');
    $imei1 = filter('IMEI1');
    $imei2 = filter('IMEI2');
    $color = filter('color');
    $ram = filter('ram');
    $storage = filter('storage');
    $type = filter('type');
    $status = filter('status');
    $describ = filter('describ');
    $seller = filter('seller');
    $buy_date = filter('buy_date');
    $buy_price = filter('buy_price');
    $customer = filter('customer');
    $sell_date = filter('sell_date');
    $sell_price = filter('sell_price');

    $stmt = $connect->prepare("UPDATE `devices` SET `device_name` = ? , `IMEI1` = ? ,`IMEI2` = ? ,`color`= ? , `ram` =? , `storage` =?, `type` = ? , `status` = ? , `describ` = ? , `seller` = ? , `buy_date` = ? , `buy_price` = ? , `customer` = ? , `sell_date` = ? , `sell_price` = ? WHERE `device_id` = ?");
    $stmt->execute(array($device_name,$imei1,$imei2,$color,$ram,$storage,$type,$status,$describ,$seller,$buy_date,$buy_price,$customer,$sell_date,$sell_price,$device_id));
    $count = $stmt->rowCount();
    if($count > 0){
        echo json_encode(array('status' => 1));
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['delete'])){
    $device_id = filter('device_id');
    $stmt = $connect->prepare("DELETE FROM `devices` WHERE `device_id` = ?");
    $stmt->execute(array($device_id));
    $count = $stmt->rowCount();
    if($count > 0){
        echo json_encode(array('status'=>1));
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['fetchAll'])){
    $stmt = $connect->prepare("SELECT * FROM `devices`");
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = array('status' => 1, 'data' => $devices);
        echo json_encode($arr);
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['fetchSold'])){
    $stmt = $connect->prepare("SELECT * FROM `devices` WHERE `isAvailable` = '0'");
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = array('status' => 1, 'data' => $devices);
        echo json_encode($arr);
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['fetchAvailables'])){
    $stmt = $connect->prepare("SELECT * FROM `devices` WHERE `isAvailable` = '1'");
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $arr = array('status' => 1, 'data' => $devices);
        echo json_encode($arr);
    }
    else{
        echo json_encode(array('status' => 0));
    }
}
else if(isset($_GET['sell'])){
    $device_id = filter('device_id');
    $customer = filter('customer');
    $sell_date = filter('sell_date');
    $sell_price = filter('sell_price');

    $stmt = $connect->prepare("UPDATE `devices` SET `isAvailable` = '0' , `customer` = ? , `sell_date` = ? , `sell_price` = ? WHERE `device_id` = ?");
    $stmt->execute(array($customer,$sell_date,$sell_price,$device_id));
    $count = $stmt->rowCount();
    if($count > 0){
        echo json_encode(array('status' => 1));
    }
    else{
        echo json_encode(array('status' => 0));
    }
}


?>