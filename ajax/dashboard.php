<?php 

include('../global/config.php');
include('../global/function.php');

//fetch dashboard details
if(isset($_POST['dashboard']) && $_POST['dashboard'] == '1' && isset($_SESSION['admin']))
{
    //total flight booking
    $res = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as totalflight FROM `booking_details` WHERE type=1"));
    //today flight booking
    $fbook = mysqli_fetch_array(mysqli_query($con,"select COUNT(id)as todayflight from `booking_details` WHERE booking_date = CURDATE() AND type=1"));
    //total flight amount
    $amt = mysqli_fetch_array(mysqli_query($con,"SELECT(IFNULL((SELECT SUM(IFNULL(amount,0)) FROM `booking_details` WHERE type=1),0))  as totalflightamt"));
    //today flight amount
    $totalamt = mysqli_fetch_array(mysqli_query($con,"SELECT(IFNULL((SELECT SUM(IFNULL(amount,0)) FROM `booking_details` WHERE booking_date = CURDATE() AND type=1),0))  as todayflightamt"));
    //today flight amount
    $totalincome = mysqli_fetch_array(mysqli_query($con,"SELECT sum(profit) as totalearning FROM booking_details"));
    //total users
    $users = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as users FROM `user_register`"));
    //total hotel booking
    $h_booking = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(IFNULL(id,0)) as totalhotel FROM `hotel_booking`"));
    //today hotel booking
    $t_h_booking = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(IFNULL(id,0)) as todayhotel FROM `hotel_booking` WHERE created_date  = CURDATE()"));
    //total hotel booking amount
    $book = mysqli_fetch_array(mysqli_query($con,"SELECT(IFNULL((SELECT SUM(booking_amt) FROM hotel_booking),0)) as totalhotelamt"));
    //today hotel booking amount
    $h_tamt = mysqli_fetch_array(mysqli_query($con,"SELECT(IFNULL((SELECT SUM(booking_amt) FROM hotel_booking WHERE created_date  = CURDATE()),0))  as todayhotelamount "));
    //total visa applications
    $visa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as visa FROM visa"));
    //today's visa application
    $todayvisa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as todayvisa FROM visa"));
    //total approved visa
    $r_visa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as r_visa FROM visa WHERE status=0"));
    //total rejected visa
    $a_visa = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as a_visa FROM visa WHERE status=1"));
    //total coupons
    $coupons = mysqli_fetch_array(mysqli_query($con,"select count(id) as coupons from coupons"));
    //margin amount
    $margin = mysqli_fetch_array(mysqli_query($con,"select * from margin"));
    //today users
    $todayusers = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as todayusers FROM `user_register` where created_date = CURDATE()"));
    //active users
    $activeusers = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as activeusers FROM `user_register` where status = '1'"));
    //deactive users
    $deactiveusers = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(id) as deactiveusers FROM `user_register` where status = '0'"));
    //cancellation refund
    $cancelrefund = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(refund_amount) as cancelrefund FROM flight_cancellation_refund WHERE status='0'"));
    //failed refund
    $failedrefund = mysqli_fetch_array(mysqli_query($con,"SELECT SUM(ceiling(round(amount))) as failedrefund FROM payment_refund WHERE service='flight' AND status='0'"));
    //charter enq
    $charter = mysqli_fetch_array(mysqli_query($con,"select COUNT(IFNULL(id,0)) as charter FROM charter_enq"));
    //total contact 

    //total flight booking
    $rows['totalflight'] = $res['totalflight'];
    //today flight booking
    $rows['todayflight'] = $fbook['todayflight'];
    //total flight amount
    $rows['totalflightamt'] = IND_money_format($amt['totalflightamt']);
    //today flight amount
    $rows['todayflightamt'] = IND_money_format($totalamt['todayflightamt']);
    // totalincome
    $rows['totalincome'] = IND_money_format($totalincome['totalearning']);
    //total users
    $rows['users'] = $users['users'];
    //total hotel booking
    $rows['totalhotel'] = $h_booking['totalhotel'];
    //today hotel booking
    $rows['todayhotel'] = $t_h_booking['todayhotel'];
    //total hotel booking amount
    $rows['totalhotelamt'] = IND_money_format($book['totalhotelamt']);
    //today hotel booking amount
    $rows['todayhotelamount'] = IND_money_format($h_tamt['todayhotelamount']);
    //total visa applications
    $rows['visa'] =$visa['visa'];
    //today's visa application
    $rows['todayvisa']=$todayvisa['todayvisa'];
    //total approved visa
    $rows['r_visa'] = $r_visa['r_visa'];
    //total rejected visa
    $rows['a_visa'] = $a_visa['a_visa'];
    //total coupons
    $rows['coupons'] = $coupons['coupons'];
    //margin amount
    $rows['margin'] = $margin['margin'];
    //today users
    $rows['todayusers'] = $todayusers['todayusers'];
    //activeusers
    $rows['activeusers'] = $activeusers['activeusers'];
    //deactive users
    $rows['deactiveusers'] = $deactiveusers['deactiveusers'];
    //cancellation refund
    $rows['cancelrefund'] = IND_money_format($cancelrefund['cancelrefund']);
    //failed refund
    $rows['failedrefund'] = IND_money_format($failedrefund['failedrefund']);
    //charter enq
    $rows['charter'] = $charter['charter'];

    // admin travelomatix wallet
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://prod.services.travelomatix.com/webservices/index.php/rest/domain_balance?=TMX9513861584428885&username=TMX386255&password=TMX@861386&system=live",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('domain_key' => 'TMX9513861584428885','username' => 'TMX386255','password' => 'TMX@861386','system' => 'live'),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $datas= json_decode($response);
    $rows['balance']= IND_money_format($datas->balance);
    echo json_encode($rows);
}
?>