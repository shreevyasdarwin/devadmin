<?php
error_reporting(0);
session_start();
include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$visa = mysqli_query($con,"SELECT * FROM visa ORDER BY apply_date DESC");
?>
<!DOCTYPE html>
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php include("global/head.php") ?>
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
        <!-- Alternative Sidebar -->
        <div id="sidebar-alt">
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
                        <?= flash(); ?>
                        <h1>
                            <i class="fa fa-table"></i>View visa applications
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Dashboard</li>
                    <li><a href="">View visa applications</a></li>
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
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Country name</th>
                                <th class="text-center">Visa type</th>
                                <th class="text-center">Passport(front)</th>
                                <th class="text-center">Passport(back)</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center" style="width: 100px;">Applied date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt=1;
                            while($row=mysqli_fetch_array($visa))
                            {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $cnt++; ?></td>
                                    <td class="text-center"><?php echo $row['name']; ?></td>
                                    <td class="text-center"><?php echo $row['email']; ?></td>
                                    <td class="text-center"><?php echo $row['mobile']; ?></td>
                                    <td class="text-center"><?php echo $row['country_name']; ?></td>
                                    <td class="text-center"><?php echo $row['visa_type']; ?></td>
                                    <td class="text-center"><img src="../visadocs/<?php echo $row['pass_front']; ?>" style="height:70px; width:70px;"></td>
                                    <td class="text-center"><img src="../visadocs/<?php echo $row['pass_back']; ?>" style="height:70px; width:70px;"></td>
                                    <td class="text-center"><img src="../visadocs/<?php echo $row['photo']; ?>" style="height:70px; width:70px;"></td>
                                    <td class="text-center"><?php echo date('d-m-Y',strtotime($row['apply_date'])); ?></td>
                                    <td>
                                        <?php if($row['status'] == 0){ ?>
                                            <button class="btn btn-success" name="acceptVisa" id="acceptVisa" onclick="accpetVisa(this)" data-id="<?= $row['id'] ?>">Approve</button>
                                            <button class="btn btn-danger" name="acceptVisa" id="rejectVisa" onclick="rejectVisa(this)" data-id="<?= $row['id'] ?>">Reject</button>
                                        <?php }else{ echo '---'; }?>
                                    </td>
                                    <td>
                                        <h4 class="text-<?= $row['status'] == 0 ? 'warning' : ($row['status'] == 1 ? 'success' : 'danger') ?>" disabled><?= $row['status'] == 0 ? 'Application Pending' : ($row['status'] == 1 ? 'Application Approved' : 'Application Rejected')  ?></h4>
                                    </td>
                                </tr
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
<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
<!--sweetalert2-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/ajax_pages/visa.js"></script>
</body>
</html>