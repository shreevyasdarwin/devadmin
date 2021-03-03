<?php
//update margin
if(isset($_POST['marginupdate']) && $_POST['marginupdate'] == '1' && isset($_SESSION['admin']))
{
    $amount = $_POST['amount'];
    $sql = $pdo->prepare('update margin set margin=?');
    if($sql->execute([$amount])) {
        $res = $pdo->prepare("select margin from margin");
        $res->execute();
        $row->fetch(PDO::FETCH_ASSOC); 
        $date = date('j F, Y');
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
?>