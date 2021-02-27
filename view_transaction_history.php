<?php
session_start();
include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$user = mysqli_query($con,"select w.*,CONCAT(u.title,' ',u.fname,' ',u.lname) as fullname from wallet_history w inner join user_details u on w.user_id=u.id order by w.created_date desc");
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
            height: 40px;
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
                            <i class="fa fa-table"></i>User's Transaction History
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Tables</li>
                    <li><a href="">User's Transaction History</a></li>
                </ul>
                <!-- END Datatables Header -->

                <!-- Datatables Content -->
                <div class="block full">

                    <div class="table-responsive">
                        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">SR NO</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Message</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Pay Id</th>
                                <th class="text-center">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $cnt = 1;
                                while($row=mysqli_fetch_array($user))
                                {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $cnt++; ?></td>
                                    <td class="text-center"><?= $row['fullname']; ?></td>
                                    <td class="text-center"><?= $row['msg']; ?></td>
                                    <td class="text-center">&#8377;<?= $row['amount']; ?></td>
                                    <td class="text-center"><?= ($row['type']=='1') ? "<p class='label label-success'>Credit</p>" : "<p class='label label-danger'>Debit</p>"; ?></td>
                                    <td class="text-center"><?= $row['pay_id']; ?></td>
                                    <td class="text-center"><?= date("d-m-Y", strtotime($row['created_date'])); ?></td>
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