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
                        <li>
                            <a class="<?= ($activePage == 'hotel_paid') ? 'active':''; ?>" href="hotel_paid.php">Paid refund</a>
                        </li>
                    </ul>
                </li>
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
            <div class="modal-body">
                <div class="form-horizontal form-bordered">
                    <fieldset>
                        <legend class="text-center"><div id="response">Password Update</div></legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                            <div id="npass_err"></div>
                            <div class="col-md-8">
                                <input type="password" id="npass" name="npass" class="form-control" placeholder="Enter new password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div id="cpass_err"></div>
                            <div class="col-md-8">
                                <input type="password" id="cpass" name="cpass" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="button" name="changepassword" id="changepassword" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<script>
    document.getElementById("changepassword").addEventListener("click", function(){
        var npass = document.getElementById("npass").value
        var cpass = document.getElementById("cpass").value
        if(!npass){
            document.getElementById("npass_err").innerHTML="<p class='text-danger'>Please fillout this field</p>"
            return
        } 
        if(!cpass){
            document.getElementById("cpass_err").innerHTML="<p class='text-danger'>Please fillout this field</p>"
            return
        } 
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: { action: 'changepassword', npass: npass, cpass: cpass },
            success: function(response){
                console.log(response);
                if(response=='3'){ 
                    document.getElementById("response").innerHTML="<div class='alert alert-success' role='alert'>Password updated successfully!</div>"
                    setTimeout(() => {
                        window.location.reload()
                    }, 1000);
                }
            }
        })
    })
</script>