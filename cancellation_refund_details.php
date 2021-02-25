<?php

$url = "http://test.services.travelomatix.com/webservices/index.php/flight/service/BookingDetails";



$data= array (
    "AppReference" => $_GET['appreference']
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Accept-Encoding:gzip, deflate',
    'x-Username:test258376', //Remove password later, sending basic/digest auth
    'x-DomainKey:TMX1812581584012945',
    'x-system:test',
    'x-Password:test@258'//Remove password later, sending basic/digest auth
));


$result = curl_exec($curl);
curl_close($curl);
unset($curl);
$datas = json_decode($result);
$bookingId=$datas->BookingDetails->BoookingTransaction[0]->BookingID;
$sequence=$datas->BookingDetails->BoookingTransaction[0]->SequenceNumber;
$reference=$datas->BookingDetails->AppReference;
$PNR=$datas->BookingDetails->BoookingTransaction[0]->PNR;
$TicketId=$datas->BookingDetails->BoookingTransaction[0]->BookingCustomer[0]->TicketId;
//echo json_encode($result);
//exit;

$url1 = "http://test.services.travelomatix.com/webservices/index.php/flight/service/TicketRefundDetails";
$data1= array (
    "AppReference" => $_GET['appreference'],
    "SequenceNumber" => $sequence,
    "BookingId" => $bookingId,
    "PNR" => $PNR,
    "TicketId" =>$TicketId,
    "ChangeRequestId" => "1"

);
$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_ENCODING, "gzip");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data1));
curl_setopt($curl, CURLOPT_URL, $url1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Accept-Encoding:gzip, deflate',
    'x-Username:test258376', //Remove password later, sending basic/digest auth
    'x-DomainKey:TMX1812581584012945',
    'x-system:test',
    'x-Password:test@258'//Remove password later, sending basic/digest auth
));


$result1 = curl_exec($curl);

curl_close($curl);
unset($curl);
//echo json_encode($result1);
//exit;
$refund = json_decode($result1);
$status=$refund->Status; // 1 or 0
$description=$refund->TicketRefundDetails->RefundDetails->StatusDescription; // completed or inprogress
$msg=$refund->TicketRefundDetails->RefundDetails->RefundStatus; // message
$amount=$refund->TicketRefundDetails->RefundDetails->RefundedAmount; // refundable amount
?>
<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <style>
            .filterable {
                margin-top: 15px;
            }
            .filterable .panel-heading .pull-right {
                margin-top: -20px;
            }
            .filterable .filters input[disabled] {
                background-color: transparent;
                border: none;
                cursor: auto;
                box-shadow: none;
                padding: 0;
                height: auto;
            }
            .filterable .filters input[disabled]::-webkit-input-placeholder {
                color: #333;
            }
            .filterable .filters input[disabled]::-moz-placeholder {
                color: #333;
            }
            .filterable .filters input[disabled]:-ms-input-placeholder {
                color: #333;
            }

        </style>
    </head>
    <title>Flight cancellation details</title>
        <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-primary filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Cancelled booking detail's</h3>
                    </div>
                    <table class="table p-5">
                        <tbody>
                        <tr>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Message</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td><?php if($status==1) echo"<p class='text-success'>Successful</p>"; else echo"<p class='text-danger'>Failed</p>"; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $msg; ?></td>
                            <td><?php echo $amount; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>