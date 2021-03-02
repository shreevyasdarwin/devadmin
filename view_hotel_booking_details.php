    <?php
    include('global/config.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = mysqli_query($con,"SELECT u.user_id,CONCAT(u.fname,' ', u.lname) as fullname,h.* FROM hotel_booking AS h INNER JOIN user_details AS u ON u.user_id=h.userid WHERE h.id='$id'");
        $row = mysqli_fetch_array($sql);
    }
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
    <title>Hotel booking detail's</title>
    <body>
    <div class="col-md-12" style="padding: 30px;">
        <div class="row">
            <div class="panel panel-primary filterable">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Hotel booking detail's</h3>
                </div>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <?php $x=1; ?>
                        <th>#</th>
                        <th>Full name</th>
                        <th>Room name</th>
                        <th>Hotel image</th>
                        <th>Address</th>
                        <th>App Refrence no</th>
                        <th>Amount</th>
                        <th>Booking ID</th>
                        <th>Booking Refrence no</th>
                        <th>Confirmation no</th>
                        <th>Total guest</th>
                        <th>No Of Rooms</th>
                        <th>Check-in date</th>
                        <th>Check-out date</th>
                        <th>Booking status</th>
                        <th>Booking date</th>
                        <th>Updated date</th>
                    </tr>
                    <tr>
                        <td><?php echo $x++  ?></td>
                        <td><?php echo $row['fullname']  ?></td>
                        <td><?php echo $row['room_name']  ?></td>
                        <td><img src="<?php echo $row['hotel_img']  ?>" alt="" class="img-thumbnail" style="height: 80px;" width="auto;"></td>
                        <td><?php echo $row['hotel_add']  ?></td>
                        <td><?php echo $row['apprefernce_no']  ?></td>
                        <td>&#8377;<?php echo $row['booking_amt']  ?></td>
                        <td><?php echo $row['booking_id']  ?></td>
                        <td><?php echo $row['booking_refno']  ?></td>
                        <td><?php echo $row['confirmation_no']  ?></td>
                        <td><?php echo $row['totalguest']  ?></td>
                        <td><?php echo $row['noofroom']  ?></td>
                        <td><?php echo $row['checkin']  ?></td>
                        <td><?php echo $row['checkout']  ?></td>
                        <td><?php if($row['book_status']=='BOOKING_CONFIRMED'){
                                echo "<span class='label label-success' style='text-transform: uppercase;'>confirmed</span>";
                            }
                            else{
                                echo "<span class='label label-warning' style='text-transform: uppercase;'>on hold</span>";
                            }?></td>
                        <td><?php echo $row['created_date']  ?></td>
                        <td><?php echo $row['updated_date']  ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>
    </html>