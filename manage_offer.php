<?php
session_start();
include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$user = mysqli_query($con,"SELECT * FROM coupons ORDER BY created_date DESC");
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php include("global/head.php"); ?>
    <script src="js/vendor/modernizr.min.js"></script>
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

        <!-- Main Container -->
        <div id="main-container">
            <?php include("global/nav.php") ?>
            <div id="page-content">
                <!-- Datatables Header -->
                <div class="content-header">
                    <div class="header-section">
                        <h1>
                            <i class="fa fa-table"></i>Manage blog
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Tables</li>
                    <li><a href="">Manage blog</a></li>
                </ul>
                <!-- END Datatables Header -->

                <!-- Datatables Content -->
                <div class="block full">

                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">SR NO</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Offer validity</th>
                                <th class="text-center">Created date</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            while($row=mysqli_fetch_array($user))
                            {
                                $new_date = date("d/m/Y", strtotime($row['created_date']));
                                ?>
                                <tr>
                                    <td class="text-center"><?=  $cnt++; ?></td>
                                    <td class="text-center"><?=  $row['title']; ?></td>
                                    <td class="text-center"><img src="offer_img/<?= $row['image']; ?>" style="height: 150px; width: 150px;" class="img-circle" alt=""></td>
                                    <td class="text-center"><?= $row['description']; ?></td>
                                    <td class="text-center"><?= $row['validity']; ?></td>
                                    <td class="text-center"><?= $new_date; ?></td>
                                    <td class="text-center"><a href="edit_offer.php?id=<?= $row['id']; ?>"><i class="fa fa-pencil-square-o" style="font-size: 20px;"></i></a></td>
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
                    data: {action: 'activateblog', id: id},
                    success: function (data) {
                        swal("blog has been Activated", {
                            icon: "success",
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {action: 'deactivateblog', id: id},
                    success: function (data) {
                        swal("blog has been deactivated", {
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