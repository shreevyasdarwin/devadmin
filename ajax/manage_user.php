<?php 


//add wallet amount
if(isset($_POST['action']) && $_POST['action'] == 'addWalletAmount'){
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $stmt = $pdo->prepare('update user_register set wallet=wallet+? where id=?');
    if($stmt->execute([$amount,$id])){
        set_flash('success', 'Amount credited');
        echo "1";
    } else{
        set_flash('danger', 'Something went wrong');
        var_dump($pdo->errorInfo());
    }
}

//to deactivate user
if (isset($_POST['deactivate']) && $_POST['deactivate'] == '1' && isset($_SESSION['admin']) ){
    $id=$_POST['id'];
    $deactivate = mysqli_query($con,"UPDATE user_register SET status='0' WHERE id=$id");
    if ($deactivate) {
        echo"success";
        set_flash('success', 'User Deactivated');
    }
    else{
        echo "error";    
        set_flash('danger', 'Something went wrong');
    }
}
//to activate user
if (isset($_POST['activate']) && $_POST['activate'] == '1' && isset($_SESSION['admin'])){
    $id=$_POST['id'];
    $activate = mysqli_query($con,"UPDATE user_register SET status='1' WHERE id=$id");
    if ($activate) {
        echo"success";
        set_flash('success', 'User Activated');
    }
    else{
        echo"error";
        set_flash('danger', 'Something went wrong');
    }
}
?>