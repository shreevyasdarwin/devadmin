<?php
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="dashboard.php" class="sidebar-brand">
                <span class="sidebar-nav-mini-hide"><strong>DarwinTrip</strong> Admin</span>
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-avatar">
                    <a href="dashboard.php">
                        <img src="img/placeholders/avatars/darwin.png" alt="avatar">
                    </a>
                </div>
            </div>
            <!-- END User Info -->
            <div class="sidebar-section sidebar-user-links clearfix sidebar-nav-mini-hide">
                <div class="sidebar-user-links">
                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="change password" onclick="$('#modal-user-settings').modal('show');"><i class="gi gi-cogwheel"></i></a>
                    <a href="logout.php" class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- Theme Colors -->
            <!-- Change Color Theme functionality can be found in js/app.js - templateOptions() -->
<!--            <ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-night themed-border-night" data-theme="css/themes/night.css" data-toggle="tooltip" title="Night"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-amethyst themed-border-amethyst" data-theme="css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-modern themed-border-modern" data-theme="css/themes/modern.css" data-toggle="tooltip" title="Modern"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-autumn themed-border-autumn" data-theme="css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-flatie themed-border-flatie" data-theme="css/themes/flatie.css" data-toggle="tooltip" title="Flatie"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-spring themed-border-spring" data-theme="css/themes/spring.css" data-toggle="tooltip" title="Spring"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-fancy themed-border-fancy" data-theme="css/themes/fancy.css" data-toggle="tooltip" title="Fancy"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-fire themed-border-fire" data-theme="css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-coral themed-border-coral" data-theme="css/themes/coral.css" data-toggle="tooltip" title="Coral"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-lake themed-border-lake" data-theme="css/themes/lake.css" data-toggle="tooltip" title="Lake"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-forest themed-border-forest" data-theme="css/themes/forest.css" data-toggle="tooltip" title="Forest"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-waterlily themed-border-waterlily" data-theme="css/themes/waterlily.css" data-toggle="tooltip" title="Waterlily"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-emerald themed-border-emerald" data-theme="css/themes/emerald.css" data-toggle="tooltip" title="Emerald"></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="javascript:void(0)" class="themed-background-dark-blackberry themed-border-blackberry" data-theme="css/themes/blackberry.css" data-toggle="tooltip" title="Blackberry"></a>-->
<!--                </li>-->
<!--            </ul>-->
            <!-- END Theme Colors -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="dashboard.php" class="<?= ($activePage == 'dashboard') ? 'active':''; ?>"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                </li>
                <li>
                    <a href="manageuser.php" class="<?= ($activePage == 'manageuser') ? 'active':''; ?>"><i class="fa fa-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage User</span></a>
                </li>
                <li>
                    <a href="charted_enq.php" class="<?= ($activePage == 'charted_enq') ? 'active':''; ?>"><i class="fa fa-question-circle sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Charter enquiry</span></a>
                </li>
                <li>
                    <a href="contact.php" class="<?= ($activePage == 'contact') ? 'active':''; ?>"><i class="fa fa-phone sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Contact</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Flight"><i class="fa fa-plane"></i></a></span>
                    <span class="sidebar-header-title">FLight</span>
                </li>
                <li>
                    <a href="flightbooking.php" class="<?= ($activePage == 'flightbooking') ? 'active':''; ?>"><i class="fa fa-plane sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">View Flight Booking</span></a>
                </li>
                <li>
                    <a href="flight-cancellation-pending-refund.php" class="<?= ($activePage == 'flight-cancellation-pending-refund') ? 'active':''; ?>"><i class="fa fa-plane sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">View Cancelled Booking</span></a>
                </li>
                <li>
                    <a href="refundflightbooking.php" class="<?= ($activePage == 'refundflightbooking') ? 'active':''; ?>"><i class="fa fa-plane sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Refundable Booking</span></a>
                </li>
                <li>
                    <a <?php if($activePage == 'reject' || $activePage == 'pending' || $activePage == 'paid')
                        echo "class='sidebar-nav-menu open'";
                    else
                        echo "class='sidebar-nav-menu'";
                    ?> href="#" ><i class="fa fa-angle-right sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-plane sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Flight Refund History</span></a>
                    <ul <?php if($activePage == 'reject' || $activePage == 'pending' || $activePage == 'paid')
                                echo "style='display:block;'";
                              else
                                echo "style='display:none;'";
                        ?>>
                        <li>
                            <a class="<?= ($activePage == 'reject') ? 'active':''; ?>" href="reject.php">Rejected refund</a>
                        </li>
<!--                        <li>-->
<!--                            <a class="--><?//= ($activePage == 'pending') ? 'active':''; ?><!--" href="pending.php">Pending refund</a>-->
<!--                        </li>-->
                        <li>
                            <a class="<?= ($activePage == 'paid') ? 'active':''; ?>" href="paid.php">Paid refund</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Hotel"><i class="fa fa-building"></i></a></span>
                    <span class="sidebar-header-title">Hotel</span>
                </li>
                <li>
                <li>
                    <a href="hotelbooking.php" class="<?= ($activePage == 'hotelbooking') ? 'active':''; ?>"><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">View Hotel Booking</span></a>
                </li>
                <li>
                    <a href="hotel_cancelled_booking.php" class="<?= ($activePage == 'hotel_cancelled_booking') ? 'active':''; ?>"><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">View Cancelled Booking</span></a>
                </li>
                <li>
                    <a href="refund_hotel_booking.php" class="<?= ($activePage == 'refund_hotel_booking') ? 'active':''; ?>"><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Refundable Booking</span></a>
                </li>
                <li>
                    <a <?php if($activePage == 'hotel_reject' || $activePage == 'hotel_pending' || $activePage == 'hotel_paid')
                        echo "class='sidebar-nav-menu open'";
                    else
                        echo "class='sidebar-nav-menu'";
                    ?> href="#" ><i class="fa fa-angle-right sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Hotel Refund History</span></a>
                    <ul <?php if($activePage == 'hotel_reject' || $activePage == 'hotel_pending' || $activePage == 'hotel_paid')
                        echo "style='display:block;'";
                    else
                        echo "style='display:none;'";
                    ?>>
                        <li>
                            <a class="<?= ($activePage == 'hotel_reject') ? 'active':''; ?>" href="hotel_reject.php">Rejected refund</a>
                        </li>
<!--                        <li>-->
<!--                            <a class="--><?//= ($activePage == 'hotel_pending') ? 'active':''; ?><!--" href="hotel_pending.php">Pending refund</a>-->
<!--                        </li>-->
                        <li>
                            <a class="<?= ($activePage == 'hotel_paid') ? 'active':''; ?>" href="hotel_paid.php">Paid refund</a>
                        </li>
                    </ul>
                </li>
<!--                <li class="sidebar-header">-->
<!--                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Hotel"><i class="fa fa-building"></i></a></span>-->
<!--                    <span class="sidebar-header-title">Hotel Holiday Package</span>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="addpackage.php" class="--><?//= ($activePage == 'addpackage') ? 'active':''; ?><!--"><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Add Top Offers</span></a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="managepackage.php" class="--><?//= ($activePage == 'managepackage') ? 'active':''; ?><!--"><i class="fa fa-building sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Top Offers</span></a>-->
<!--                </li>-->
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Visa"><i class="fa fa-cc-visa"></i></a></span>
                    <span class="sidebar-header-title">Visa</span>
                </li>
                <li>
                    <a href="visa.php" class="<?= ($activePage == 'visa') ? 'active':''; ?>"><i class="fa fa-cc-visa sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">View Visa Applications</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Coupons"><i class="fa fa-gift"></i></a></span>
                    <span class="sidebar-header-title">Coupons</span>
                </li>
                <li>
                    <a href="addcoupons.php" class="<?= ($activePage == 'addcoupons') ? 'active':''; ?>"><i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Add Coupons</span></a>
                </li>
                <li>
                    <a href="managecoupons.php" class="<?= ($activePage == 'managecoupons') ? 'active':''; ?>"><i class="fa fa-gift sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Coupons</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Margin"><i class="fa fa-money"></i></a></span>
                    <span class="sidebar-header-title">Margin</span>
                </li>
                <li>
                    <a href="margin.php" class="<?= ($activePage == 'margin') ? 'active':''; ?>"><i class="fa fa-money sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Set Margin</span></a>
                </li>
                <li class="sidebar-header">
                    <span class="sidebar-header-options clearfix"><a href="javascript:void(0)" data-toggle="tooltip" title="Blog"><i class="fa fa-newspaper-o"></i></a></span>
                    <span class="sidebar-header-title">Blog</span>
                </li>
                <li>
                    <a href="add_blog.php" class="<?= ($activePage == 'add_blog') ? 'active':''; ?>"><i class="fa fa-newspaper-o sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Add blog</span></a>
                </li>
                <li>
                    <a href="manage_blog.php" class="<?= ($activePage == 'manage_blog') ? 'active':''; ?>"><i class="fa fa-newspaper-o sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage blog</span></a>
                </li>
            </ul>

        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!--modal body-->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-cogs"></i> Settings</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend class="text-center">Password Update</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-password" name="npass" class="form-control" placeholder="Enter new password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-repassword" name="cpass" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <?php if(isset($msg)){
                        echo $msg;
                    } ?>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>