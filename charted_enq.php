<?php
session_start();
error_reporting(0);

include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
$user = mysqli_query($con,"select c.*,CONCAT(u.fname,' ',u.lname) as fullname,u.phone,u.email from user_details as u inner join charter_enq as c on c.user_id=u.user_id ORDER BY id DESC");

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php include("global/head.php"); ?>
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
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
                            <i class="fa fa-table"></i>Manage Charted Enquiry
                        </h1>
                    </div>
                </div>
                <ul class="breadcrumb breadcrumb-top">
                    <li>Tables</li>
                    <li><a href="">Manage Charted Enquiry</a></li>
                </ul>
                <!-- END Datatables Header -->
                <?=  flash() ?>
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
                                <th class="text-center">Source</th>
                                <th class="text-center">Destination</th>
                                <th class="text-center">Departure date</th>
                                <th class="text-center">Return date</th>
                                <th class="text-center">No of passengers</th>
                                <th class="text-center">Enquiry Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $cnt = 1;
                            while($row=mysqli_fetch_array($user))
                            {
                                $new_date = date("d-m-Y", strtotime($row['created_date']));
                                $d_date = date("d-m-Y", strtotime($row['d_date']));
                                $r_date = date("d-m-Y", strtotime($row['r_date']));
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $cnt++; ?></td>
                                    <td class="text-center text-capitalize"><?php echo $row['fullname']; ?></td>
                                    <td class="text-center"><?php echo $row['phone']; ?></td>
                                    <td class="text-center"><?php echo $row['email']; ?></td>
                                    <td class="text-center"><?php echo $row['source']; ?></td>
                                    <td class="text-center"><?php echo $row['destination']; ?></td>
                                    <td class="text-center"><?php echo $row['d_date']; ?></td>
                                    <td class="text-center"><?php echo $row['r_date']; ?></td>
                                    <td class="text-center"><?php echo $row['passenger']; ?></td>
                                    <td class="text-center"><?php echo $new_date; ?></td>
                                    <td class="text-center"><?php if($row['status']=='1'){ echo "<p class='label label-success'>Query resolved</p>"; } else{ ?><button class="btn btn-xs btn-primary" onclick="feedback(<?php echo $row['id'] ?>)" name="feedback" id="feedback" value="<?php echo $row['id']; ?>">Send Feedback</button><?php } ?></td>
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
<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>
<!--sweetalert2-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--activate / deactivate user with ajax-->
<script>
    function feedback(id){
        $.ajax({
            url: "ajax.php",
            method: "POST",
            data: {feedback:'1', id: id},
            success: function (data) {
                location.reload();
            }
        });
    }
</script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
</body>
</html>