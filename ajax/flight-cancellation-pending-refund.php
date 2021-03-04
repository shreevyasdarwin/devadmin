<?php
include('../global/config.php');
include('../global/function.php');

//flight cancellation refund paid 
if(isset($_POST['paid']) && $_POST['paid']=='1' && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    // echo "update flight_cancellation_refund set status='1' where id='$id'";exit;
    $stmt = $pdo->prepare("update flight_cancellation_refund set status='1' where id=?");
    if($stmt->execute([$id])){
        echo "1";
    }else{
        var_dump($stmt->errorInfo());
        exit;
    }
}

//flight cancellation refund reject 
if(isset($_POST['reject']) && $_POST['reject']=='1' && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    // echo "update flight_cancellation_refund set status='1' where id='$id'";exit;
    $stmt = $pdo->prepare("update flight_cancellation_refund set status='2' where id=?");
    if($stmt->execute([$id])){
        echo "1";
    }else{
        var_dump($stmt->errorInfo());
        exit;
    }
}

?>