<?php


session_start();
include('global/config.php');
//refund flight booking code

$book = mysqli_query($con,"SELECT CONCAT(u.fname,' ',u.lname) as fullname,p.* FROM payment_refund AS p 
INNER JOIN user_details AS u ON u.user_id=p.user_id WHERE p.service = 'flight'");
$cnt = 1;
while ($row = mysqli_fetch_array($book)) {
    $new_date = date("d-m-Y", strtotime($row['created_date']));
    $row['srno'] = $cnt;
    $row['new_date'] = $new_date;
    $results['data'][]= $row;
    $cnt++;
}
echo json_encode($results);
exit;