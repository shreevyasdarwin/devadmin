<?php
require("config.php");
$sql=mysqli_query($con,"select id,amount from booking_details");
while($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
    $profit=$row['amount']*14/100;
    mysqli_query($con,"UPDATE booking_details set profit='$profit' where id='".$row['id']."' ");
}
echo "done";