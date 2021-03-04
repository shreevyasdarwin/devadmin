<?php
include('../global/config.php');
include('../global/function.php');

//flight cancellation refund paid 
if(isset($_POST['accpetVisa']) && $_POST['accpetVisa']=='1' && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    // echo "update flight_cancellation_refund set status='1' where id='$id'";exit;
    $stmt = $pdo->prepare("update visa set status='2' where id=?");
    if($stmt->execute([$id])){
        echo "1";
    }else{
        var_dump($stmt->errorInfo());
        exit;
    }
}
?>