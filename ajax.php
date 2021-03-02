<?php
include('global/config.php');
include('global/function.php');

// update admin password
if(isset($_POST['action']) && $_POST['action'] == 'changepassword'){
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    if(!$npass){
        echo "1";
        exit;
    }
    if(!$cpass){
        echo "2";
        exit;
    }
    $stmt = $pdo->prepare("update admin set password='$cpass'");
    if($stmt->execute([$cpass])){
        echo "3";
    }else{
        var_dump($pdo->errorInfo());
    }
}
//to deactivate user
if (isset($_POST['deactivate'])){
    $id=$_POST['id'];
    $deactivate = mysqli_query($con,"UPDATE user_register SET status='0' WHERE id=$id");
    if ($deactivate) {
        echo"success";
    }
    else{
        echo"error";
    }
}
//to activate user
if (isset($_POST['action']) && $_POST['action'] == 'activate') {
    $id=$_POST['id'];
    $activate = mysqli_query($con,"UPDATE user_register SET status='1' WHERE id=$id");
    if ($activate) {
        echo"success";
    }
    else{
        echo"error";
    }
}
//update margin
if(isset($_POST['action']) && $_POST['action'] == 'marginupdate')
{
    $amount = $_POST['amount'];
    $sql = mysqli_query($con,"update margin set margin='$amount'");
    if($sql) {
        $row = mysqli_fetch_array(mysqli_query($con, "select margin from margin"));
        $date = date('j F, Y');
        if ($row)
        {
            require "PHPMailer/PHPMailerAutoload.php";
            //mailer start
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            // $mail->SMTPDebug = 2;
            $mail->Host = 'mail.darwintrip.com';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Username = 'info@darwintrip.com';
            $mail->Password = 'Darwin@2020';
            //   $path = 'reseller.pdf';
            //   $mail->AddAttachment($path); NameSizeLast ModifiedTypePermissions
            $mail->IsHTML(true);
            $mail->From = "info@darwintrip.com";
            $mail->FromName = 'DarwinTrip';
            $mail->Sender = 'info@darwintrip.com';
            $mail->AddReplyTo('info@darwintrip.com', 'DarwinTrip');
            $mail->Subject = 'Margin set by Admin';
            $mail->Body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
            <tr>
                <td align="center" bgcolor="#f0f0f0" style=" color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                    <img src="https://darwintrip.com/admin/img/logo.png" alt="darwintrip logo" width="auto" height="152" style="display:block;" />
                </td>
            </tr>
            <tr>
                <td bgcolor="#f9f9f9" style="padding: 20px 20px 30px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                    <p align="center"> Hello, Margin has been changed, below is the margin set by Admin.</p>
        
                    <b>Margin:</b> ₹' .$amount.'<br>
                    <b>date:</b>' .$date.'
                    </br>
                    <br>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px 15px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                                &copy; <a href="https://darwintrip.com/admin" style="color: #148e81;">DarwinTrip Admin</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>';
            $mail->AddAddress('zaeemansari87@gmail.com');
            if($mail->send()){
                set_flash('success','Margin Updated Successfully');
                echo 1;
            }
        }
        else{
            echo 0;
            set_flash('danger','Something went wrong');
        }
    }
    else
    {
        echo "error";
    }
}
//Forgot password code
if(isset($_POST['action']) && $_POST['action'] == 'forgotpass')
{
    $sql = mysqli_query($con,"select * from admin where id=1");
    $row=mysqli_fetch_array($sql);
    $pass=$row['password'];
    $user=$row['username'];
    // Mailer
    require "PHPMailer/PHPMailerAutoload.php";
    //mailer start
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
// $mail->SMTPDebug = 2;
    $mail->Host = 'mail.darwintrip.com';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Username = 'info@darwintrip.com';
    $mail->Password = 'Darwin@2020';
//   $path = 'reseller.pdf';
//   $mail->AddAttachment($path); NameSizeLast ModifiedTypePermissions
    $mail->IsHTML(true);
    $mail->From = "info@darwintrip.com";
    $mail->FromName = 'DarwinTrip';
    $mail->Sender = 'info@darwintrip.com';
    $mail->AddReplyTo('info@darwintrip.com', 'DarwinTrip');
    $mail->Subject = 'Username and password of admin panel';
    $mail->Body = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;" class="content">
        <tr>
            <td align="center" bgcolor="#f0f0f0" style=" color: #ffffff; font-family: Arial, sans-serif; font-size: 36px; font-weight: bold;">
                <img src="https://darwintrip.com/admin/img/logo.png" alt="darwintrip logo" width="auto" height="152" style="display:block;" />
            </td>
        </tr>
        <tr>
            <td bgcolor="#f9f9f9" style="padding: 20px 20px 30px 20px; color: #555555; font-family: Arial, sans-serif; font-size: 20px; line-height: 30px;">
                <p align="center"> Hello Admin, your request for login credentials are given below.</p>
                <b>Username:</b>'.$user.' <br>
                <b>Password:</b>'.$pass.'
                </br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="padding: 15px 10px 15px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" width="100%" style="color: #999999; font-family: Arial, sans-serif; font-size: 12px;">
                            &copy; <a href="https://darwintrip.com/admin" style="color: #148e81;">DarwinTrip Admin</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';
    $mail->AddAddress('zaeemansari87@gmail.com');
    if($mail->send())
    {
        echo "success";
    }
}

//fetch dashboard details
if(isset($_POST['action']) && $_POST['action'] == 'dashboard')
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
    $rows['totalflightamt'] = $amt['totalflightamt'];
    //today flight amount
    $rows['todayflightamt'] =$totalamt['todayflightamt'];
    // totalincome
    $rows['totalincome'] = $totalincome['totalearning'];
    //total users
    $rows['users'] =$users['users'];
    //total hotel booking
    $rows['totalhotel'] =$h_booking['totalhotel'];
    //today hotel booking
    $rows['todayhotel'] =$t_h_booking['todayhotel'];
    //total hotel booking amount
    $rows['totalhotelamt'] =$book['totalhotelamt'];
    //today hotel booking amount
    $rows['todayhotelamount'] =$h_tamt['todayhotelamount'];
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
    $rows['cancelrefund'] = $cancelrefund['cancelrefund'];
    //failed refund
    $rows['failedrefund'] = $failedrefund['failedrefund'];
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
    $rows['balance']= $datas->balance;
    echo json_encode($rows);
}
//add holiday package
if(isset($_POST['action']) && $_POST['action'] == 'addpackage')
{
    $name = $_POST['name'];
    $img = $_FILES['img']['name'];
    $target = "uploads/" . basename($img);
    $state = $_POST['state'];
    $country = $_POST['country'];
    $price = $_POST['price'];
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target))
    {
        $sql= "INSERT INTO package (p_name,p_img,p_state,p_country,p_price,status) VALUES ('$name','$img','$state','$country','$price','1')";
        echo $sql;
        $add = mysqli_query($con, $sql);
        if($add) {
            echo 'success';
        }
        else
            echo mysqli_error($con);
    }
    else{
        echo "fail";
    }
//    echo json_encode($response);
}

//add coupons
if(isset($_POST['action']) && $_POST['action'] == 'createcoupons')
{
    $name = $_POST['name'];
    $amt = $_POST['discount'];
    $date = $_POST['date'];
    if(mysqli_query($con,"insert into coupons (coupon_code,discount_amt,expiry_date,created_date,status) VALUES ('$name','$amt','$date',CURDATE(),'1')"))
    {
        echo 'success';
    }
    else
    {
        echo mysqli_error($con);
    }
}

//activatecoupons

if (isset($_POST['action']) && $_POST['action'] == 'activatecoupons') {
    $id=$_POST['id'];
    if (mysqli_query($con,"update coupons set status='1' WHERE id='$id'")) {
        echo "success";
    }
    else{
        echo mysqli_error($con);
    }
}

//deactivate coupons
if (isset($_POST['action']) && $_POST['action'] == 'deactivatecoupons') {
    $id=$_POST['id'];
    if (mysqli_query($con,"update coupons set status='0' WHERE id='$id'")) {
        echo "success";
    }
    else{
        echo mysqli_error($con);
    }
}

//paid payment
if(isset($_POST['action']) && $_POST['action'] == 'paid'){
    $id=$_POST['id'];
    if(mysqli_query($con,"update payment_refund set status='1' where id='$id'")){
        set_flash('success','Amount Paid Successfully');
    }
    else{
        set_flash('danger','Something went wrong');
        echo mysqli_error($con);
    }
}

//reject payment
if(isset($_POST['action']) && $_POST['action'] == 'reject'){
    $id=$_POST['id'];
    if(mysqli_query($con,"update payment_refund set status='2' where id='$id'")){
        set_flash('success','Amount Rejected Successfully');
    }
    else{
        set_flash('danger','Something went wrong');
    }
}

//accept visa
if(isset($_POST['action']) && $_POST['action'] == 'approvevisa'){
    $id=$_POST['id'];
    $approve = mysqli_query($con,"update visa set status='1' where id='$id'");
    if($approve){
        echo "success";
        // Mailer
        require "PHPMailer/PHPMailerAutoload.php";
        //mailer start
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
// $mail->SMTPDebug = 2;
        $mail->Host = 'mail.darwintrip.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = 'info@darwintrip.com';
        $mail->Password = 'Darwin@2020';
//   $path = 'reseller.pdf';
//   $mail->AddAttachment($path); NameSizeLast ModifiedTypePermissions
        $mail->IsHTML(true);
        $mail->From = "info@darwintrip.com";
        $mail->FromName = 'DarwinTrip';
        $mail->Sender = 'info@darwintrip.com';
        $mail->AddReplyTo('info@darwintrip.com', 'DarwinTrip');
        $mail->Subject = 'Status of visa application';
        $mail->Body = 'Dear customer your application for visa is approved';
        $mail->AddAddress('zaeemansari87@gmail.com');
        $mail->send();
    }
    else{
        echo mysqli_error($con);
    }
}

//reject visa
if(isset($_POST['action']) && $_POST['action'] == 'rejectvisa'){
    $id=$_POST['id'];
    $reject = mysqli_query($con,"update visa set status='0' where id='$id'");
    if($reject){
        echo "success";
        require "PHPMailer/PHPMailerAutoload.php";
        //mailer start
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
// $mail->SMTPDebug = 2;
        $mail->Host = 'mail.darwintrip.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = 'info@darwintrip.com';
        $mail->Password = 'Darwin@2020';
//   $path = 'reseller.pdf';
//   $mail->AddAttachment($path); NameSizeLast ModifiedTypePermissions

        $mail->IsHTML(true);
        $mail->From = "info@darwintrip.com";
        $mail->FromName = 'DarwinTrip';
        $mail->Sender = 'info@darwintrip.com';
        $mail->AddReplyTo('info@darwintrip.com', 'DarwinTrip');
        $mail->Subject = 'Status of visa application';
        $mail->Body = 'Dear customer your application for visa is rejected';
        $mail->AddAddress('zaeemansari87@gmail.com');
        $mail->send();
    }
    else{
        echo mysqli_error($con);
    }
}
//hotel paid
if(isset($_POST['action']) && $_POST['action'] == 'hotelpaid'){
    $id=$_POST['paid'];
    if(mysqli_query($con,"update payment_refund set refund_date=CURDATE(), status='1' where id='$id'")){
        set_flash('success','Paid Successfully.');
    }
    else{
        echo mysqli_error($con);
        set_flash('danger','Something went wrong');
    }
}
//hotel reject
if(isset($_POST['action']) && $_POST['action'] == 'hotelreject'){
    $id=$_POST['reject'];
    if(mysqli_query($con,"update payment_refund set refund_date=CURDATE(), status='2' where id='$id'")){
        set_flash('success','Rejected Successfully.');
    }
    else{
        echo mysqli_error($con);
        set_flash('danger','Something went wrong');
    }
}
// cancel hotel paid
if(isset($_POST['action']) && $_POST['action'] == 'cancelpaid'){
    $id=$_POST['id'];
    if(mysqli_query($con,"update hotel_cancel_booking set  status='1' where id='$id'")){
        echo "success";
    }
    else{
        echo mysqli_error($con);
    }
}
// cancel hotel reject
if(isset($_POST['action']) && $_POST['action'] == 'cancelreject'){
    $id=$_POST['id'];
    if(mysqli_query($con,"update hotel_cancel_booking set status='2' where id='$id'")){
        echo "success";
    }
    else{
        echo mysqli_error($con);
    }
}
//to deactivate blog
if (isset($_POST['action']) && $_POST['action'] == 'deactivateblog'){
    $id=$_POST['id'];
    $deactivate = mysqli_query($con,"UPDATE blog SET status='0' WHERE id='$id'");
    if ($deactivate) {
        echo"success";
    }
    else{
        echo"error";
    }
}

//to activate blog
if (isset($_POST['action']) && $_POST['action'] == 'activateblog') {
    $id=$_POST['id'];
    $activate = mysqli_query($con,"UPDATE blog SET status='1' WHERE id='$id'");
    if ($activate) {
        echo"success";
    }
    else{
        echo"error";
    }
}

//send feedback mail for charter enquiry
if(isset($_POST['action']) && $_POST['action'] == 'feedback'){
    $id=$_POST['id'];
    $feedback = mysqli_query($con,"update charter_enq set status='1' where id='$id'");
    $user = mysqli_query($con,"select c.*,CONCAT(u.fname,' ',u.lname) as fullname,u.phone,u.email from user_details as u inner join charter_enq as c on c.user_id=u.user_id where c.id = '$id'");
    $row = mysqli_fetch_array($user);
    if($feedback){
        require "PHPMailer/PHPMailerAutoload.php";
        //mailer start
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        // $mail->SMTPDebug = 2;
        $mail->Host = 'mail.darwintrip.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->Username = 'info@darwintrip.com';
        $mail->Password = 'Darwin@2020';
        //   $path = 'reseller.pdf';
        //   $mail->AddAttachment($path); NameSizeLast ModifiedTypePermissions
        $mail->IsHTML(true);
        $mail->From = "info@darwintrip.com";
        $mail->FromName = 'DarwinTrip';
        $mail->Sender = 'info@darwintrip.com';
        $mail->AddReplyTo('info@darwintrip.com', 'DarwinTrip');
        $mail->Subject = 'Feedback regarding your charter enquiry';
        $mail->Body = "Dear ".$row['fullname'].", Thank you for submitting your inquiry of our charter flight services.<br>
        Description: of flight details <br>
        From: ".$row['source']." <br>
        To: ".$row['destination']." <br>
        Departure Date: ".$row['d_date']." <br>
        Return Date: ".$row['r_date']." <br>
        Total no of passangers: ".$row['passenger']." <br>        
        We hope that we have solved all your queries regarding our chartered flight services.";
        $mail->AddAddress($row['email']);
        if($mail->send()){
            set_flash('success','Feedback Send Successfully');
        }else{
            set_flash('danger','Somthing went wrong');
        }
    }
    else{
        echo mysqli_error($con);
        set_flash('danger','Something went Wrong');
    }

}

//add wallet amount
if(isset($_POST['action']) && $_POST['action'] == 'addWalletAmount'){
    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $stmt = $pdo->prepare('update user_register set wallet=wallet+? where id=?');
    if($stmt->execute([$amount,$id])){
        echo "1";
    } else{
        var_dump($pdo->errorInfo());
    }
}
?>