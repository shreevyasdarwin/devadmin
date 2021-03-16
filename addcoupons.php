<?php
session_start();
include('global/config.php');
if($_SESSION['admin']==""){
    header('location:index.php');
}
//compress image function
function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);
    return $destination;
}

if(isset($_POST['create'])) {
    $title = $_POST['title'];
    $img = $_FILES['img']['name'];
    $target = "offer_img/" . basename($img);
    $description = $_POST['description'];
    $code = $_POST['code'];
    $amt = $_POST['amt'];
    $expdate = $_POST['expdate'];
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
        $add = mysqli_query($con, "insert into coupons (title,image,description,coupon_code,discount_amt,expiry_date,created_date,status) 
        values('$title','$img','$description','$code','$amt','$expdate',CURDATE(),'1')");
        if ($add) {
            $notify = true;
        } else {
            echo mysqli_error($con);
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php include("global/head.php") ?>
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
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
    <!-- END Preloader -->

    <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
        <!-- Alternative Sidebar -->

        <!-- Main Sidebar -->
        <?php include("global/sidebar.php") ?>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
            <?php include("global/nav.php") ?>
            <!-- END Header -->

            <!-- Page content -->
            <div id="page-content">
                <!-- Forms General Header -->
                <div class="content-header">
                    <div class="header-section">
                        <h1>
                            Add Coupons
                        </h1>
                    </div>
                </div>
                <!-- END Forms General Header -->

                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Form Elements Block -->
                        <div class="block">
                            <!-- Basic Form Elements Title -->
                            <div class="block-title">
                                <div class="block-options pull-right">
                                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default toggle-bordered enable-tooltip" data-toggle="button" title="Toggles .form-bordered class">No Borders</a>
                                </div>
                                <h2><strong>Add Coupon</strong> Form</h2>
                            </div>
                            <!-- END Form Elements Title -->

                            <!-- Basic Form Elements Content -->
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-email-input">Enter offer title</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" placeholder="Offer title..." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-text-input">Uplodad offer image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="img" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-email-input">Enter offer description</label>
                                    <div class="col-md-9">
                                        <textarea id="textarea-ckeditor" name="description" class="ckeditor" placeholder="Content goes here..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-text-input">Enter Offer Code</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" name="code" class="form-control" placeholder="eg: HAPPYSUNDAY4000" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-email-input">Enter Discount Amount</label>
                                    <div class="col-md-9">
                                        <input type="text" id="discount" name="amt" class="form-control" placeholder="eg: 4000" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="example-text-input">Offer validity</label>
                                    <div class="col-md-9">
                                        <input type="date" name="expdate" class="form-control" value="<?php echo date("d/m/y"); ?>">
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button name="create" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Add coupon</button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Basic Form Elements Content -->
                        </div>
                        <!-- END Basic Form Elements Block -->
                    </div>
                </div>
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
<script src="js/pages/formsGeneral.js"></script>
<script>$(function(){ FormsGeneral.init(); });</script>
<!--sweetalert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- ckeditor.js, load it only in the page you would like to use CKEditor (it's a heavy plugin to include it with the others!) -->
<script src="js/helpers/ckeditor/ckeditor.js"></script>
<?php if (isset($notify)) {
    if ($notify==true) { ?>
        <script type="text/javascript">
            swal({
                title: "Success",
                text: "Coupon Created successfully.",
                icon: "success",
                button: "Ok",
            });

        </script>
    <?php }
    else if($notify==false){?>
        <script type="text/javascript">
            swal({
                title: "Error",
                text: "Something went wrong",
                icon: "error",
                button: "Ok",
            });

        </script>

        <?php
    }
}
unset($notify);
?>
</body>
</html>