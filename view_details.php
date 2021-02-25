<?php
include("global/config.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $row = mysqli_fetch_array(mysqli_query($con,"select * from visa where id = $id"));
}
?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <?php include("global/head.php"); ?>

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
    <!-- Preloader -->
    <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
    <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
        <div class="inner">
            <h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
            <div class="preloader-spinner hidden-lt-ie10"></div>
        </div>
    </div>
    <!-- END Preloader -->

    <!-- Page Container -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available #page-container classes:

        '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

        'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
        'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
        'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)
        'sidebar-mini sidebar-visible-lg-mini'          for a mini main sidebar with a flyout menu, enabled by default (> 991px + Best with static layout)
        'sidebar-mini sidebar-visible-lg'               for a mini main sidebar with a flyout menu, disabled by default (> 991px + Best with static layout)

        'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
        'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
        'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

        'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

        'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

        'style-alt'                                     for an alternative main style (without it: the default style)
        'footer-fixed'                                  for a fixed footer (without it: a static footer)

        'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

        'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
        'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

        'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links
    -->
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
        <?php include("global/sidebar.php") ?>
        <!-- END Main Sidebar -->

        <!-- Main Container -->
        <div id="main-container">
            <!-- Header -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available header.navbar classes:

                'navbar-default'            for the default light header
                'navbar-inverse'            for an alternative dark header

                'navbar-fixed-top'          for a top fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
                    'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

                'navbar-fixed-bottom'       for a bottom fixed header (fixed sidebars with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
                    'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
            -->
            <?php include("global/nav.php"); ?>
            <!-- END Header -->

            <!-- Page content -->
            <div id="page-content">
                <!-- Forms General Header -->
                <div class="content-header">
                    <div class="header-section">
                        <h1>
                            <i class="gi gi-notes_2"></i>User details
                        </h1>
                    </div>
                </div>
                <!-- END Forms General Header -->

                <div class="row">
                    <div class="col-md-6">
                        <!-- Basic Form Elements Block -->
                        <div class="block">

                            <!-- Basic Form Elements Content -->
                            <div class="form-horizontal form-bordered">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['name'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Surname</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['surname'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['mobile'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['gender'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Marital status</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['marital_status'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Religion</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['religion'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date of birth</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['dob'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country of birth</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['cob'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Place of birth</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['pob'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nationality</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['nationality'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Destination</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['destination'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Visa type</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['visa_type'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Departure date</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['departure_date'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Return date</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['return_date'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Passport Front</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['visa_type'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Passport back</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['visa_type'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Photo</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['visa_type'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Passport number</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['pass_no'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Passport issue date</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['issue_date'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Passport expiry date</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['expiry_date'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Profession</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['profession'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Father name</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['father_name'] ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mother name</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php echo $row['mother_name'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- END Basic Form Elements Content -->
                        </div>
                        <!-- END Basic Form Elements Block -->
                    </div>
                </div>
                <!-- END Form Example with Blocks in the Grid -->
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
</body>
</html>