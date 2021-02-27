<?php
session_start();
include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$user = mysqli_query($con,"select u.id,u.mobile,u.email,u.created_date,u.status,u.wallet, CONCAT(d.title,' ',d.fname,' ',d.lname) as fullname from user_register u inner join user_details d on u.id=d.user_id order by u.created_date desc");
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php include("global/head.php"); ?>
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="js/vendor/modernizr.min.js"></script>
</head>
<body>
<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
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
        <?php include("global/sidebar.php") ?>
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
                            <i class="fa fa-table"></i>Manage User's
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Tables</li>
                    <li><a href="">Manage User's</a></li>
                </ul>
                <!-- END Datatables Header -->

                <!-- Datatables Content -->
                <div class="block full">

                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">SR NO</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Registered Date</th>
                                <th class="text-center">Wallet amount</th>
                                <th class="text-center">Transaction history</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            while($row=mysqli_fetch_array($user))
                            {
                                $new_date = date("d-m-Y", strtotime($row['created_date']));
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $cnt++; ?></td>
                                    <td class="text-center"><?php echo $row['fullname']; ?></td>
                                    <td class="text-center"><?php echo $row['mobile']; ?></td>
                                    <td class="text-center"><?php echo $row['email']; ?></td>
                                    <td class="text-center"><?php echo $new_date; ?></td>
                                    <td class="text-center">&#8377;<?php echo $row['wallet']; ?></td>
                                    <td class="text-center"><a class="btn btn-link" href="view_transaction_history.php?id=<?php echo $row['id']; ?>" target="_blank">View details</a></td>
                                    <td class="text-center">

                                        <div class="col-md-8">
                                            <label class="switch switch-primary">
                                                <?php
                                                if($row['status']=='1') {
                                                    echo "<input type='checkbox' id='mycheck".$row['id']."' name='user-settings-notifications' value='".$row['id']."' checked>";
                                                    echo "<span></span>";
                                                }
                                                else{
                                                    echo "<input type='checkbox' id='mycheck".$row['id']."' name='user-settings-notifications' value='".$row['id']."'>";
                                                    echo "<span></span>";
                                                }
                                                ?>
                                            </label>
                                        </div>

                                    </td>
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

<!-- END User Settings -->

<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>
<!--sweetalert2-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--activate / deactivate user with ajax-->
<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            var id = $(this).val();

            if ($(this).is(":checked")) {
                //if checked it is activated
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'activate', id: id},
                    success: function (result) {
                        swal("User has been Activated", {
                            icon: "success",
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'deactivate', id: id},
                    success: function (data) {
                        swal("User has been deactivated", {
                            icon: "success",
                        });
                    }
                });

            }
        });
    });
</script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
</body>
</html>