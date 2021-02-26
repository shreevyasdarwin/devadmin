<?php
$con=mysqli_connect('162.241.87.23:3306','darwintr_darwintrip','9,j(u*[[(G@q','darwintr_dev');
try {
    $pdo = new PDO("mysql:host=162.241.87.23:3306;dbname=darwintr_dev", "darwintr_darwintrip", "9,j(u*[[(G@q");
} catch (Exception $e) {
    var_dump($e);
}
?>