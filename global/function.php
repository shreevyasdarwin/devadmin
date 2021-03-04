<?php
function margin($con)
{
    if($row = mysqli_fetch_array(mysqli_query($con,"select * from margin")))
        $response = $row['margin'];
    else
        $response = mysqli_error($con);

    return $response;
}


function coupons($con)
{
    if($row = mysqli_fetch_array(mysqli_query($con,"select count(id) as id from coupons")))
        $response = $row['id'];
    else
        $response = mysqli_error($con);

    return $response;
}

function IND_money_format($number){
    $decimal = (string)($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for($i=0;$i<$length;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
            $delimiter .=',';
        }
        $delimiter .=$money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);

    if( $decimal != '0'){
        $result = $result.$decimal;
    }

    return $result;
}

?>