<?php
//admin session
session_start();
include('global/config.php');
if($_SESSION['admin'] == ""){
    header('location:index.php');
}
// new changes(demo)
//user details
$users = mysqli_query($con,'SELECT * FROM user_register ORDER BY created_date DESC LIMIT 5');
include('global/function.php');
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <?php include("global/head.php") ?>
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
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
                <!-- Alternative Sidebar -->
                <div id="sidebar-alt">
                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-alt-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Chat -->
                            <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                            <a href="page_ready_chat.html" class="sidebar-title">
                                <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                            </a>
                            <!-- Chat Users -->
                            <ul class="chat-users clearfix">
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar12.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar15.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar10.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-online">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar4.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-away">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar7.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-away">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar9.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="chat-user-busy">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar16.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar1.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar4.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar3.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar13.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <span></span>
                                        <img src="img/placeholders/avatars/avatar5.jpg" alt="avatar" class="img-circle">
                                    </a>
                                </li>
                            </ul>
                            <!-- END Chat Users -->

                            <!-- Chat Talk -->
                            <div class="chat-talk display-none">
                                <!-- Chat Info -->
                                <div class="chat-talk-info sidebar-section">
                                    <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <img src="img/placeholders/avatars/avatar5.jpg" alt="avatar" class="img-circle pull-left">
                                    <strong>John</strong> Doe
                                </div>
                                <!-- END Chat Info -->

                                <!-- Chat Messages -->
                                <ul class="chat-talk-messages">
                                    <li class="text-center"><small>Yesterday, 18:35</small></li>
                                    <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                                    <li class="chat-talk-msg animation-slideRight">How are you?</li>
                                    <li class="text-center"><small>Today, 7:10</small></li>
                                    <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                                </ul>
                                <!-- END Chat Messages -->

                                <!-- Chat Input -->
                                <form action="index.html" method="post" id="sidebar-chat-form" class="chat-form">
                                    <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                                </form>
                                <!-- END Chat Input -->
                            </div>
                            <!--  END Chat Talk -->
                            <!-- END Chat -->

                            <!-- Activity -->
                            <a href="javascript:void(0)" class="sidebar-title">
                                <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
                            </a>
                            <div class="sidebar-section">
                                <div class="alert alert-danger alert-alt">
                                    <small>just now</small><br>
                                    <i class="fa fa-thumbs-up fa-fw"></i> Upgraded to Pro plan
                                </div>
                                <div class="alert alert-info alert-alt">
                                    <small>2 hours ago</small><br>
                                    <i class="gi gi-coins fa-fw"></i> You had a new sale!
                                </div>
                                <div class="alert alert-success alert-alt">
                                    <small>3 hours ago</small><br>
                                    <i class="fa fa-plus fa-fw"></i> <a href="page_ready_user_profile.html"><strong>John Doe</strong></a> would like to become friends!<br>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Accept</a>
                                    <a href="javascript:void(0)" class="btn btn-xs btn-default"><i class="fa fa-times"></i> Ignore</a>
                                </div>
                                <div class="alert alert-warning alert-alt">
                                    <small>2 days ago</small><br>
                                    Running low on space<br><strong>18GB in use</strong> 2GB left<br>
                                    <a href="page_ready_pricing_tables.html" class="btn btn-xs btn-primary"><i class="fa fa-arrow-up"></i> Upgrade Plan</a>
                                </div>
                            </div>
                            <!-- END Activity -->

                            <!-- Messages -->
                            <a href="page_ready_inbox.html" class="sidebar-title">
                                <i class="fa fa-envelope pull-right"></i> <strong>Messages</strong>UI (5)
                            </a>
                            <div class="sidebar-section">
                                <div class="alert alert-alt">
                                    Debra Stanley<small class="pull-right">just now</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>New Follower</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Sarah Cole<small class="pull-right">2 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>Your subscription was updated</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Bryan Porter<small class="pull-right">10 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>A great opportunity</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Jose Duncan<small class="pull-right">30 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>Account Activation</strong></a>
                                </div>
                                <div class="alert alert-alt">
                                    Henry Ellis<small class="pull-right">40 min ago</small><br>
                                    <a href="page_ready_inbox_message.html"><strong>You reached 10.000 Followers!</strong></a>
                                </div>
                            </div>
                            <!-- END Messages -->
                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->
                </div>
                <!-- END Alternative Sidebar -->

                <!-- Main Sidebar -->
                    <?php include("global/sidebar.php");?>
                <!-- END Main Sidebar -->

                <!-- Main Container -->
                <div id="main-container">
                    <!-- Header -->
                    <!-- In the PHP version you can set the following options from inc/config file -->

                    <?php include("global/nav.php");?>
                    <!-- END Header -->

                    <!-- Page content -->
                    <div id="page-content">
                        <!-- Dashboard Header -->
                        <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
                        <!-- END Dashboard Header -->
                        <div class="row">
                        <!-- Mini Top Stats Row -->
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
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong><span id="todayflight"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Today's booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="todayflightamt"></span><br>
                                                                <small><i class="fa fa-plane"></i> Today's income</small>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

<!--                                        Total booking Details -->
                                        <div class="col-sm-4">
                                            <div class="block full">
                                                <div class="block-title">
                                                    <h2><strong>Total Flight</strong> Details</h2>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong><span id="totalflight"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Total booking</small>
                                                        </h3>
                                                    </div>
                                                    
                                                    <div class="col-xs-6 col-lg-6">
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
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong>&#x20B9;<span id="cancelrefund"></span></strong><br>
                                                            <small><i class="fa fa-plane"></i> Cancellation refund</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6">
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
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong><span id="todayhotel"></span></strong><br>
                                                            <small><i class="fa fa-hotel"></i> Today's booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6">
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
                                                    <div class="col-xs-6 col-lg-6">
                                                        <h3>
                                                            <strong> <span id="totalhotel"></span> </strong><br>
                                                            <small><i class="fa fa-hotel"></i> Total booking</small>
                                                        </h3>
                                                    </div>
                                                    <div class="col-xs-6 col-lg-6">
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
                                                        <div class="col-xs-6 col-lg-6">
                                                            <h3>
                                                                <strong><span id="users"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Total user</small>
                                                            </h3>
                                                        </div>
                                                        <div class="col-xs-6 col-lg-6">
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
                                                        <div class="col-xs-6 col-lg-6">
                                                            <h3>
                                                                <strong><span id="activeusers"></span></strong><br>
                                                                <small><i class="fa fa-user"></i> Active user</small>
                                                            </h3>
                                                        </div>
                                                        <div class="col-xs-6 col-lg-6">
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
                                            <div class="col-xs-6 col-lg-3">
                                                <h3>
                                                    <strong><span id="visa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Total application's</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-6 col-lg-3">
                                                <h3>
                                                    <strong><span id="todayvisa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Today's VISA applications</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-6 col-lg-3">
                                                <h3>
                                                    <strong><span id="a_visa"></span></strong> <br>
                                                    <small><i class="fa fa-cc-visa"></i> Approved</small>
                                                </h3>
                                            </div>
                                            <div class="col-xs-6 col-lg-3">
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
        <!-- END Page Wrapper -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->

        <!-- END User Settings -->

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <?php include("global/script.php");?>

        <!--sweetalert-->
        <script>
            $(document).ready(function(){
                // alert('IN');
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'businesswallet'},

                success: function (data) {
                        // var json =  $.parseJSON(data);
                    // document.getElementById('businesswallet').value=data;
                    $("#businesswallet").html(data);
                }
            });
            });
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--        set margin -->
        <script type="text/javascript">
                $("#updatemargin").click(function() {
                    var amount = $("#marginamt").val();
                    // console.log(amount);
                    $.ajax({
                        url: "ajax.php",
                        method: "POST",
                        data: {action: 'marginupdate', amt: amount},
                        success: function (data) {
                            swal("Margin has been updated", {
                                icon: "success",
                            });
                            document.getElementById('marginamt').value=data;
                        }
                    });
                });
        </script>


        <!--fetch all Dashboard data with ajax-->
        <script type="text/javascript">

            function autoRefresh_div() {
                // console.log('111');
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'dashboard'},
                    success: function (response) {
                        // console.log(response);
                        var json =  JSON.parse(response);
                        //today's flight booking
                        $('#todayflight').text(json.todayflight);
                        //total flight booking
                        $('#totalflight').text(json.totalflight);
                        //total flight amount
                        $('#totalflightamt').text(parseInt(json.totalflightamt));
                        //total Income
                        $('#totalincome').text(parseInt(json.totalincome));
                        //total flight income
                        $('#todayflightamt').text(parseInt(json.todayflightamt));
                        //total registered users
                        $('#users').text(json.users);
                        //total hotel booking
                        $('#totalhotel').text(json.totalhotel);
                        //todays hotel booking
                        $('#todayhotel').text(json.todayhotel);
                        //total hotel income
                        $('#totalhotelamt').text(parseInt(json.totalhotelamt));
                        //today's hotel income
                        $('#todayhotelamount').text(parseInt(json.todayhotelamount));
                        //total visa applications
                        $('#visa').text(json.visa);
                        //today's visa application
                        $('#todayvisa').text(json.todayvisa);
                        //rejected visa
                        $('#r_visa').text(json.r_visa);
                        //approved visa
                        $('#a_visa').text(json.a_visa);
                        //fetch coupons
                        $('#coupons').text(json.coupons);
                        //fetch margins
                        $('#margins').text(json.margin);
                        //business wallet
                        $('#businesswallet').text(json.balance);
                        //today registered users
                        $('#todayusers').text(json.todayusers);
                        //active users
                        $('#activeusers').text(json.activeusers);
                        //deactive users
                        $('#deactiveusers').text(json.deactiveusers);
                        //cancellation refund
                        $('#cancelrefund').text(json.cancelrefund);
                        //failed refund
                        $('#failedrefund').text(json.failedrefund);
                        //charter enq
                        $('#charter').text(json.charter);
                        //console.clear();
                    }
                });
                setTimeout(autoRefresh_div, 2000);
            }
            // AUTO LOAD DATA
            autoRefresh_div();
        </script>
    </body>
</html>