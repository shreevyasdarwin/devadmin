<?php 
include('global/config.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>| DarwinTrip - Login |</title>
        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"> 
        <link rel="shortcut icon" href="img/favicon.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="js/vendor/modernizr.min.js"></script>
        <style>
            body
            {
                background-color: whitesmoke;
                /* background-image: url("img/UAE.jpg"); */
                background-repeat: no-repeat;
                background-size: cover;
            }
            #login-container .login-title {
                padding: 20px 10px !important;
                background: #444444 !important;
                background: rgb(0, 18, 70) !important;
            }
            
        </style>
    </head>
    <body >
        <!-- Login Full Background -->
        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <!-- Login Title -->
            <div class="login-title text-center">
                <img src="img/placeholders/backgrounds/darwin.png" alt="Login Full Background"  height="110px" width="150px">
                <h1><strong>DarwinTrip</strong><br><small>Please <strong>Login</small></h1>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                <div id="form-login" class="form-horizontal form-bordered form-control-borderless">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div id="name_err"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input type="text" id="username" name="username" class="form-control input-lg" placeholder="Enter username">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div id="pass_err"></div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div id="msg">
                        <?= flash() ?>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-7 text-right">
                            <button type="button" name="login" id="login" class="btn btn-sm btn-primary">Login <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <div id="forgot_msg"><span class="btn btn-link pull-left"  id="forgotpass">Forgot Password?</span></div>
                        </div>
                    </div>
                </div>
                <!-- END Register Form -->
            </div>
            <!-- END Login Block -->
        </div>
        <!-- END Login Container -->
        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>
        <script src="js/ajax_pages/login.js"></script>
        <!-- Load and execute javascript code used only in this page -->
        
    </body>
</html>