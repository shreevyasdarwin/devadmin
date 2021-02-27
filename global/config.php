<?php
$con=mysqli_connect('162.241.87.23:3306','darwintr_darwintrip','9,j(u*[[(G@q','darwintr_dev');
try {
    $pdo = new PDO("mysql:host=162.241.87.23:3306;dbname=darwintr_dev", "darwintr_darwintrip", "9,j(u*[[(G@q");
} catch (Exception $e) {
    var_dump($e);
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function pre()
{
    echo (php_sapi_name() !== 'cli') ? '<pre>' : '';
    foreach(func_get_args() as $arg){
        echo preg_replace('#\n{2,}#', "\n", print_r($arg, true));
    }
    echo (php_sapi_name() !== 'cli') ? '</pre>' : '';exit();
}

function get_num_rows($table_name,$column_need,$column_have,$column_value)
{
    $sql = "SELECT `$column_need` FROM `$table_name` WHERE `$column_have` = '$column_value'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    
    return mysqli_num_rows($result);
}


function get_direct_value($table_name,$column_need,$column_have,$column_value)
{
    $sql = "SELECT `$column_need` FROM `$table_name` WHERE `$column_have` = '$column_value' LIMIT 1 ";
    $result = mysqli_query($GLOBALS['con'], $sql);
    if (mysqli_num_rows($result) > 0){
        $row =  mysqli_fetch_assoc($result);
        return $row[$column_need];
    }else{
        return null;
    }
}

// Flash Message 
function set_flash($type,$message){
    $_SESSION['flash']['type'] = $type;
    $_SESSION['flash']['msg'] = $message;
}


function flash(){
    if ($_SESSION['flash'] != '') {
        $type = $_SESSION['flash']['type'];
        $msg = $_SESSION['flash']['msg'];
        
        echo  
        '<div class="alert alert-'.$type.' text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            '.$msg.'
        </div>';
        unset($_SESSION['flash']);
        
    }
}

?>