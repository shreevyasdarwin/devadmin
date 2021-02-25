<?php
include("global/config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $del=mysqli_query($con,"delete from package where id=$id");
    if($del)
        echo "success";
    else
        echo "error";
}
?>