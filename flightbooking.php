<?php
session_start();
include('global/config.php');
include('global/function.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$book = mysqli_query($con,"SELECT u.fname,u.lname,b.* FROM booking_details AS b INNER JOIN user_details AS u ON u.user_id=b.user_id WHERE b.type='1' ORDER BY b.id DESC");
$url = 'https://contribute.geeksforgeeks.org/wp-content/uploads/gfg-40.png';

// Use basename() function to return the base name of file
$file_name = basename($url);
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php include("global/head.php"); ?>
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="js/vendor/modernizr.min.js"></script>
    <style>
        td{
            height: 40px; !important;
        }
    </style>
</head>
<body>
<div id="page-wrapper">
    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
        <div class="inner">
            <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
            <div class="preloader-spinner hidden-lt-ie10"></div>
        </div>
    </div>
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
        <?php include("global/sidebar.php"); ?>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
            <?php include("global/nav.php") ?>
            <!-- END Header -->

            <!-- Page content -->
            <div id="page-content">
                <!-- Datatables Header -->
                <div class="content-header">
                    <div class="header-section">
                        <h1>
                            <i class="fa fa-table"></i>Manage Flight Booking
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Tables</li>
                    <li><a href="">Manage Flight Booking</a></li>
                </ul>
                <!-- END Datatables Header -->

                <!-- Datatables Content -->
                <div class="block full">
<!--                    <button type="button" id="btnExport" class="btn btn-primary btn-sm">Export to excel</button>-->
                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">SR NO</th>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">App refrence</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Airline</th>
                                <th class="text-center">Flight No</th>
                                <th class="text-center">Cabin class</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">Booking date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            while($row=mysqli_fetch_array($book))
                            {
                                $name = $row['fname'].' '.$row['lname'];
                                $original_date = $row['booking_date'];
                                $timestamp = strtotime($original_date);
                                $new_date = date("d-m-Y", $timestamp);
                                $url = "../invoice/".$row['invoice']."";
                                // Use basename() function to return the base name of file
                                $file_name = basename($url);
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $cnt++; ?></td>
                                    <td class="text-capitalize text-center"><?php echo $name; ?></td>
                                    <td class="text-center text-center"><?php echo $row['appReference']; ?></td>
                                    <td class="text-center">₹<?php echo money($row['amount']); ?></td>
                                    <td class="text-center"><?php echo $row['airline']; ?></td>
                                    <td class="text-center"><?php echo $row['flight_no']; ?></td>
                                    <td class="text-center"><?php echo $row['cabinclass']; ?></td>
                                    <td class="text-center"><a class="btn btn-link" href="admin-invoice.php?id=<?php echo $row['id'];?>" target="_blank">View invoice</a></td>
                                    <td class="text-center"><?php echo $new_date; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Datatables Content -->
            </div>
            <!-- END Page Content -->

            <!-- Footer -->
            <?php include("global/footer.php") ?>
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
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="index.html" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                    <fieldset>
                        <legend>Vital Info</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Username</label>
                            <div class="col-md-8">
                                <p class="form-control-static">Admin</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                            <div class="col-md-8">
                                <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                            <div class="col-md-8">
                                <label class="switch switch-primary">
                                    <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Password Update</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example-datatable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>
</body>
</html>