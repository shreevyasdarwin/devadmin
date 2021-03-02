<?php
include('../global/config.php');
include('../global/function.php');

//login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!$username) {
        echo "1";
        exit;
    }
    if(!$password) {
        echo "2";
        exit;
    }
    $stmt = $pdo->prepare("select * from admin where username=? and password=?");
    $stmt->execute([$username, $password]);
    if($stmt->rowCount() > 0){
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "3"; //login successful
            $_SESSION['admin'] = $res['username'];
    }
        else{
            set_flash('danger','Oops! Invalid Credentials');
            echo "4"; //invalid credentials
            exit;
        }
}

?>