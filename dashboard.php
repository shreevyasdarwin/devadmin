<?php
error_reporting(0);
include('global/config.php');
include('global/function.php');
if($_SESSION['admin'] == ""){
    header('location:index.php');
}

$users = mysqli_query($con,'SELECT * FROM user_register ORDER BY created_date DESC LIMIT 5');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <?php include("global/head.php") ?>
        <script src="js/vendor/modernizr.min.js"></script>
    </head>
    <body>
        <div id="page-wrapper">
            <!-- Preloader -->
            <div class="preloader themed-background">
                <h1 class="push-top-bottom text-light text-center"><strong>Darwin</strong>Trip</h1>
                <div class="inner">
                    <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
                    <div class="preloader-spinner hidden-lt-ie10"></div>
                </div>
            </div>
            <!-- END Preloader -->

            <!-- Page Container -->

            <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
                <!-- Main Sidebar -->
                    <?php include("global/sidebar.php");?>
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    <?php include("global/nav.php");?>
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        <div class="row">
                        <!-- Mini Top Stats Row -->
                        <?= flash() ?>
                        <!--flight section-->
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-extra themed-background-dark">
                                    <h3 class="widget-content-light"><strong>Flight <i class="fa fa-plane"></i></strong>
                                        <small><a href="page_ready_pricing_tables.html"></a></small>
                                    </h3>
                                </div>
                                <div class="widget-extra-full">
                                    <div class="row text-center">

                                        <!--Today's bookings details-->
                                        <div class="col-sm-4">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Today Flight</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong><span id="todayflight"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Today's booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="todayflightamt"></span><br>
                                                                <small><i class="fa fa-plane"></i> Today's income</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

<!--Total booking Details -->
                                        <div class="col-sm-4">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Total Flight</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong><span id="totalflight"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Total booking</small>
                                                        </h3>
                                                    </div>
                                                    
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="totalflightamt"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Total booking</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <!--Refund details-->
                                        <div class="col-sm-4">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Refund</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="cancelrefund"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Cancellation refund</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="failedrefund"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Failed refund</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <!--Hotel section-->
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="widget-extra themed-background-dark">
                                    <h3 class="widget-content-light"><strong>Hotel <i class="fa fa-hotel"></i></strong>
                                        <small><a href="page_ready_pricing_tables.html"></a></small>
                                    </h3>
                                </div>
                                <div class="widget-extra-full">
                                    <div class="row text-center">

                                        <!-- Today's bookings details-->
                                        <div class="col-sm-6">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Today Hotel</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong><span id="todayhotel"></span></strong><br>
                                                            <small><i class="fa fa-hotel"></i> Today's booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="todayhotelamount"></span><br>
                                                                <small><i class="fa fa-hotel"></i> Today's income</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Total booking Details -->
                                        <div class="col-sm-6">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Total Hotel</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong> <span id="totalhotel"></span> </strong><br>
                                                            <small><i class="fa fa-hotel"></i> Total booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-12 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="totalhotelamt"></span></strong><br>
                                                            <small><i class="fa fa-hotel"></i> Total income</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light"><strong>User details <i class="fa fa-plane"></i></strong>
                                            <small><a href="page_ready_pricing_tables.html"></a></small>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">

                                            <!--User details-->
                                            <div class="col-sm-6">
                                                <div class="block full">
                                                    <div class="block-title">
                                                        <h2><strong>User</strong> Count</h2>
                                                    </div>
                                                    <div class="row text-center">
                                                        <div class="col-xs-12 col-lg-6">
                                                            <h3>
                                                                <strong><span id="users"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Total user</small>
                                                            </h3>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-6">
                                                            <h3>
                                                                <strong><span id="todayusers"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Registered today</small>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Active / deactive users -->
                                            <div class="col-sm-6">
                                                <div class="block full">
                                                    <div class="block-title">
                                                        <h2><strong>Active / Deactive</strong> User's</h2>
                                                    </div>
                                                    <div class="row text-center">
                                                        <div class="col-xs-12 col-lg-6">
                                                            <h3>
                                                                <strong><span id="activeusers"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Active user</small>
                                                            </h3>
                                                        </div>
                                                        <div class="col-xs-12 col-lg-6">
                                                            <h3>
                                                                <strong><span id="deactiveusers"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Deactive today</small>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--margin-->
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light"><strong>Margin</strong>
                                            <small><a href="page_ready_pricing_tables.html"></a></small>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-lg-12">
                                                <h3><strong><span id="margins"></span>&#37; </strong></h3><br>
                                                <small><i class="fa fa-credit-card"></i> Our Margin Cost</small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            Couopns-->
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light"><strong>Coupons</strong>
                                            <small><a href="page_ready_pricing_tables.html"></a></small>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-lg-12">
                                                <h3><strong>Total: <span id="coupons"></span></strong></h3><br>
                                                <small><i class="fa fa-gift"></i> Our Coupon Count</small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            Wallet balance-->
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light"><strong>Wallet balance</strong>
                                            <small><a href="page_ready_pricing_tables.html"></a></small>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-lg-12">
                                                <h3><strong>&#x20B9;<span id="businesswallet"></span></strong></h3>
                                                <br>
                                                <small><i class="fa fa-credit-card"></i> Business wallet</small>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Total Income-->
                            <div class="col-md-3">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light"><strong>Total Income</strong>
                                            <small><a href="page_ready_pricing_tables.html"></a></small>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-lg-12">
                                                <h3><strong>&#x20B9;<span id="totalincome"></span></strong></h3>
                                                <br>
                                                <small><i class="fa fa-credit-card"></i> total Earning</small>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!--visa application-->
                            <div class="col-md-8">
                                <div class="widget">
                                    <div class="widget-extra themed-background-dark">
                                        <h3 class="widget-content-light">
                                            <strong>VISA application's</strong>
                                        </h3>
                                    </div>
                                    <div class="widget-extra-full">
                                        <div class="row text-center">
                                            <div class="col-xs-12 col-lg-3">
                                                <h3>
                                                    <strong><span id="visa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Total application's</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-12 col-lg-3">
                                                <h3>
                                                    <strong><span id="todayvisa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Today's VISA applications</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-12 col-lg-3">
                                                <h3>
                                                    <strong><span id="a_visa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Approved</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-12 col-lg-3">
                                                <h3>
                                                    <strong><span id="r_visa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Rejected</small>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="widget">
                                <div class="widget-extra themed-background-dark">
                                    <h3 class="widget-content-light">
                                        <strong>Edit Your Margin Cost</strong>
                                    </h3>
                                </div>
                                <div class="widget-extra-full">
                                    <div class="form-horizontal form-bordered">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-hf-email">Enter Amount</label>
                                            <div class="col-md-9">
                                                <input type="text" id="marginamt" name="amount" class="form-control" value="<?php echo margin($con); ?>" required>
                                                <span class="help-block">Please enter margin</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button id="updatemargin" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-money"></i> Update margin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        user table-->
                        <div class="col-md-8">
                            <div class="widget">
                                <div class="widget-extra themed-background-dark">
                                    <h3 class="widget-content-light">
                                        <strong>Registered User's</strong>
                                        <a href="manageuser.php" class="btn btn-alt btn-sm btn-default pull-right" data-toggle="tooltip" title="" data-original-title="Show All"><i class="fa fa-eye"></i></a>
                                    </h3>

                                </div>
                                <div class="widget-extra-full">
                                    <div class="block full">
                                        <div class="table-responsive">
                                            <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">SR NO</th>
                                                    <th class="text-center">Mobile</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Registered Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $cnt = 1;
                                                while($rows=mysqli_fetch_array($users))
                                                {
                                                    $new_date = date("d-m-Y", strtotime($rows['created_date']));
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $cnt++; ?></td>
                                                        <td class="text-center"><?php echo $rows['mobile']; ?></td>
                                                        <td class="text-center"><?php echo $rows['email']; ?></td>
                                                        <td class="text-center"><?php echo $new_date; ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END Mini Top Stats Row -->
                        </div>
                        <!-- Widgets Row -->
                        <?php include("global/footer.php"); ?>
                        <!-- END Widgets Row -->
                    </div>
                    <!-- END Page Content -->

                    <!-- Footer -->

                    <!-- END Footer -->
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
        <?php include("global/script.php");?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="js/ajax_pages/dashboard.js"></script>
        <script src="js/ajax_pages/updatemargin.js"></script>
    </body>
</html>