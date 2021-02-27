<?php
function margin($con)
{
    if($row = mysqli_fetch_array(mysqli_query($con,"select * from margin")))
    {
        $response = $row['margin'];
    }
    else
    {
        $response = mysqli_error($con);
    }
    return $response;
}


function coupons($con)
{
    if($row = mysqli_fetch_array(mysqli_query($con,"select count(id) as id from coupons")))
    {
        $response = $row['id'];
    }
    else
    {
        $response = mysqli_error($con);
    }
    return $response;
}
//to display amount in indian format
function money($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
?>