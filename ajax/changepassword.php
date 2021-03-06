<?php
include('../global/config.php');
include('../global/function.php');

//change password 
if(isset($_POST['changepassword']) && $_POST['changepassword']=='1' && isset($_SESSION['admin'])) {
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    if(!$npass){
        echo "1";
        exit;
    }
    if(!$cpass){
        echo "2";
        exit;
    }
    $stmt = $pdo->prepare("update admin set password='$cpass'");
    if($stmt->execute([$cpass])){
        echo "3";
    }else{
        var_dump($stmt->errorInfo());
    }
}
?>