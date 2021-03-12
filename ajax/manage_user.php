<?php 
include('../global/config.php');
include('../global/function.php');

//add wallet amount
if(isset($_POST['addWalletAmount']) && $_POST['addWalletAmount'] == '1'){
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

function check_num($value){
    return !!preg_match('/^([0-9]+)$/', $value);
}

//minus wallet amount
if(isset($_POST['minusWalletAmount']) && $_POST['minusWalletAmount'] == '1'){
    $id = $_POST['id'];
    $amount = $_POST['amount'];

    $wallet = get_direct_value('','wallet','id',$id);
    if(!check_num($id) || !check_num($walletAmt) || !check_num($amount)){
        set_flash('danger', 'Invalid type of Number..');
        echo "1";
        exit;
    }
    if($amount > $walletAmt){
        set_flash('danger', 'Dedcution Amount cannot be greater than Wallet Amount');
        echo "1";
        exit;
    }
    $amt = $walletAmt - $amount;
    $stmt = $pdo->prepare('update user_register set wallet=? where id=?');
    if($stmt->execute([$amt,$id])){
        set_flash('success', 'Amount Deducted Successfully');
        echo "1";
    } else{
        set_flash('danger', 'Something went wrong');
        var_dump($pdo->errorInfo());
    }
}


//Update User Status
if (isset($_POST['changeStatus']) && $_POST['changeStatus'] == '1' && isset($_SESSION['admin']) ){
    $id = $_POST['id'];
    $value = $_POST['value'];
    $sql = mysqli_query($con,"UPDATE user_register SET status='$value' WHERE id='$id'");
    if ($sql)   
        echo 1;
    else
        echo 0;
}
?>