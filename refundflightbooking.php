<?php
session_start();
error_reporting(0);
include('global/config.php');
include('global/function.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$book = mysqli_query($con,"SELECT CONCAT(u.fname,' ',u.lname) as fullname,p.* FROM payment_refund AS p INNER JOIN user_details AS u ON u.user_id=p.user_id WHERE p.service = 'flight' AND p.status='0' ORDER BY id DESC");

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php include("global/head.php") ?>
    <script src="js/vendor/modernizr.min.js"></script>
    <style>
        td{
            height: 40px !important;
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
        <!-- Main Sidebar -->
        <?php include("global/sidebar.php") ?>
        <!-- END Main Sidebar -->
        <div id="main-container">
            <?php include("global/nav.php") ?>
            <!-- END Header -->

            <!-- Page content -->
            <div id="page-content">
                <!-- Datatables Header -->
                <div class="content-header">
                    <div class="header-section">
                        <h1>
                            <i class="fa fa-table"></i>Pending Flight Booking's
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Dashboard</li>
                    <li><a href="">Pending Flight Booking's</a></li>
                </ul>
                <!-- Datatables Content -->
                <div class="block full" id="reload">
                    <?= flash() ?>
                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered text-center">
                            <thead>
                            <tr>
                                <th class="text-center">SR NO</th>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Transaction ID</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            while($row=mysqli_fetch_array($book))
                            {
                                $original_date = $row['created_date'];
                                $timestamp = strtotime($original_date);
                                $new_date = date("d-m-Y", $timestamp);
                                ?>
                                <tr>
                                    <td><?php echo $cnt++; ?></td>
                                    <td class="text-capitalize"><?php echo $row['fullname']; ?></td>
                                    <td>&#x20B9;<?php echo money($row['amount']); ?></td>
                                    <td><?php echo $row['transaction_id']; ?></td>
                                    <td><?php echo $new_date; ?></td>
                                    <td>

                                        <?php
                                        echo"<button class='btn btn-sm btn-primary' id='paid' name='paid' value='".$row['id']."'>Paid</button>";
                                        echo "|";
                                        echo"<button class='btn btn-sm btn-danger' id='reject' name='reject' value='".$row['id']."'>Reject</button>";
                                        ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $('#paid').click(function () {
        var  id = $('#paid').val();
        console.log(id);
        $.ajax({
            url: "ajax.php",
            method: "POST",
            data: {action: 'paid', id: id},
            success: function (data) {
                location.reload();
            }
        });
    })
</script>

<script>
    $('#reject').click(function () {
        var  id = $('#reject').val();
        console.log(id);
        $.ajax({
            url: "ajax.php",
            method: "POST",
            data: {action: 'reject', id: id},
            success: function (data) {
                location.reload();
            }
        });
    })
</script>
</body>
</html>