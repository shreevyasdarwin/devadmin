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