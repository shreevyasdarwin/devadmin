<?php
//$con=mysqli_connect('localhost:3306','darwintr_darwintrip','9,j(u*[[(G@q','darwintr_dev');
$con=mysqli_connect('localhost:3306','darwintr_darwintrip','9,j(u*[[(G@q','darwintr_trip');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=darwintr_trip", "darwintr_darwintrip", "9,j(u*[[(G@q");
} catch (Exception $e) {
    var_dump($e);
}
?>