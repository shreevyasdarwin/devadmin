<?php
session_start();
include('global/config.php');
include('global/function.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$user = mysqli_query($con,"SELECT * FROM coupons");
// deactivate expired coupon
while($expired=mysqli_fetch_array($user)){
    $date=date('y-m-d');
    if($date>$expired['expiry_date']){
        mysqli_query($con,"update coupons set status='0' WHERE id='".$expired['id']."'");
        //echo " in";
    }

}
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php include("global/head.php"); ?>

    <!-- Modernizr (browser feature detection library) -->
    <script src="js/vendor/modernizr.min.js"></script>
    
    <style>
        .text-wrap
        {
            display: inline-block;
            width: 180px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
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
                            <i class="fa fa-table"></i>Manage<br><small> Coupons</small>
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Coupons</li>

                    <li><a href="">Manage Coupons</a></li>
                </ul>
                <!-- END Datatables Header -->

                <!-- Datatables Content -->
                <div class="block full">
                    <div class="block-title">
                        <h2><strong>Manage Coupons</strong></h2>
                    </div>
                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Sr No</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Image</th>
<!--                                <th class="text-center">Description</th>-->
                                <th class="text-center">Coupon code</th>
                                <th class="text-center">Discount amount</th>
                                <th class="text-center">Expiry date</th>
                                <th class="text-center">Updated date</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Deactivate / Activate</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            $sql1 =mysqli_query($con,"SELECT * FROM coupons ORDER BY created_date DESC");
                            while($row=mysqli_fetch_array($sql1))
                            {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $cnt++; ?></td>
                                    <td class="text-center"><?php echo $row['title']; ?></td>
                                    <td class="text-center"><img src="offer_img/<?php echo $row['image']; ?>" style="height: 50px; width: 50px;" class="" alt=""></td>
<!--                                    <td class="text-center"><a href="edit_offer.php?id=--><?php //echo $row['id']; ?><!--" class="btn btn-info btn-sm">show description</a></td>-->
                                    <td class="text-center"><?php echo $row['coupon_code']; ?></td>
                                    <td class="text-center">&#8377;<?php echo money($row['discount_amt']); ?></td>
                                    <td class="text-center"><?php echo $row['expiry_date']; ?></td>
                                    <td class="text-center"><?php echo $row['updated_date']; ?></td>
                                    <td class="text-center">
                                        <a href="edit_offer.php?id=<?php echo $row['id']; ?>" class="btn btn-link btn-md"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                    <td class="text-center">
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
            <?php include("global/footer.php"); ?>
            <!-- END Footer -->
        </div>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</div>
<!-- END Page Wrapper -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
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

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Swal Notification-->
<script>
        $('input[type="checkbox"]').change(function() {
            var id = $(this).val();

            if ($(this).is(":checked")) {
                //if checked it is activated
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'activatecoupons', id: id},
                    success: function (data) {
                        swal("Coupon has been Activated", {
                            icon: "success",
                        }).then(function(){
                            window.location.reload();
                        console.log(id);
                            });
                    }
                });
            } else {
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'deactivatecoupons', id: id},
                    success: function (data) {
                        swal("Coupon has been deactivated", {
                            icon: "success",
                        }).then(function () {
                            window.location.reload();
                            console.log(id);
                        });
                    }
                });
            }
        });
</script>
</body>
</html>