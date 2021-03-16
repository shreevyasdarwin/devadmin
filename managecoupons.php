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
<html class="no-js" lang="en"> <!--<![endif]-->
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
                               <th class="text-center">Description</th>
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
                            $sql1 =mysqli_query($con,"SELECT * FROM promo_code ORDER BY created_date DESC");
                            while($row=mysqli_fetch_array($sql1))
                            {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $cnt++; ?></td>
                                    <td class="text-center"><?= $row['code']; ?></td>
                                    <td class="text-center"><img src="offer_img/<?= $row['image']; ?>" style="height: 50px; width: 50px;" class="" alt=""></td>
<!--                                    <td class="text-center"><a href="edit_offer.php?id=--><?php //echo $row['id']; ?><!--" class="btn btn-info btn-sm">show description</a></td>-->
                                    <td class="text-center"><?= $row['coupon_code']; ?></td>
                                    <td class="text-center">&#8377;<?= money($row['discount_amt']); ?></td>
                                    <td class="text-center"><?= $row['expiry_date']; ?></td>
                                    <td class="text-center"><?= $row['updated_date']; ?></td>
                                    <td class="text-center">
                                        <a href="edit_offer.php?id=<?= $row['id']; ?>" class="btn btn-link btn-md"><i class="fa fa-pencil-square-o"></i></a>
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