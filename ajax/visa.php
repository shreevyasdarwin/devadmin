<?php
include('../global/config.php');
include('../global/function.php');

//Accept Visa Application 
if(isset($_POST['accpetVisa']) && $_POST['accpetVisa']=='1' && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("update visa set status='1' where id=?");
    if($stmt->execute([$id])){
        set_flash('success','Visa Status Updated');
        exit;
    }else{
        set_flash('error','Something went wrong');
        exit;
    }
}

// Reject Visa Application
if(isset($_POST['rejectVisa']) && $_POST['rejectVisa']=='1' && isset($_SESSION['admin'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("update visa set status='2' where id=?");
    if($stmt->execute([$id])){
        set_flash('success','Visa Status Updated');
        exit;
    }else{
        set_flash('error','Something went wrong');
        exit;
    }
}
?>