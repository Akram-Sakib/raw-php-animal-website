<?php require "../lib/Session.php";?>

<?php require "../config/config.php";?>
<?php require "../lib/Database.php";?>
<?php require "../lib/format.php";?>

<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
?>
<?php
$db = new Database();
$fm = new format();
?>
<?php 
Session::checkSession();
?>

<?php
if (isset($_GET["action"]) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <title>Admin - Animal Blog Site Control</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Og Meta -->
    <!--FACEBOOK-->
    <meta property="og:image" content="http://animal.sakisite.xyz/admin/assets/img/adminlogo-removebg-preview.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://animal.sakisite.xyz/admin/"/>
    <meta property="og:title" content="Website title" />
    <meta property="og:description" content="Website description." />
    <!-- app favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <!-- DataTable -->
    <link href="assets/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="assets/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/js/setup.js" type="text/javascript"></script>

    <!-- Tiny Mce -->
    <script src="assets/js/tinymce.js" ></script>
    
</head>

<body>
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="assets/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->
            <!-- begin app-header -->
            <header class="app-header top-bar">
                <!-- begin navbar -->
                <nav class="navbar navbar-expand-md">

                    <!-- begin navbar-header -->
                    <div class="navbar-header d-flex align-items-center">
                        <a href="javascript:void:(0)" class="mobile-toggle"><i class="ti ti-align-right"></i></a>
                        <a class="navbar-brand" href="index.php">
                            <img src="assets/img/adminlogo-removebg-preview.png" class="img-fluid logo-desktop" style="width: 70px; height: auto;" alt="logo" />
                            <img src="assets/img/adminlogo-removebg-preview.png" class="img-fluid logo-mobile" alt="logo" />
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-align-left"></i>
                    </button>
                    <!-- end navbar-header -->
                    <!-- begin navigation -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navigation d-flex">
                            <ul class="navbar-nav nav-left">
                                <li class="nav-item">
                                    <a href="javascript:void(0)" class="nav-link sidebar-toggle">
                                        <i class="ti ti-align-right"></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="theme.php" class="nav-link " id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">Theme
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="javascript:void(0)" class="nav-link " id="navbarDropdown1" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">User <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu animated fadeIn" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link" href="profile.php">User Profile</a>
                                        <?php if (Session::get('userRole') == '1') { ?>
                                        <a class="dropdown-item nav-link" href="adduser.php">Add User</a>
                                        <?php } ?>
                                        <a class="dropdown-item nav-link" href="userlist.php">User List</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="changepassword.php" class="nav-link " id="navbarDropdown1" role="button" >Change Password
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav nav-right ml-auto">
                           <?php if (Session::get('userRole') == '1') { ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="inbox.php" id="navbarDropdown2" role="button" >
                                        <i class="ti ti-email"></i>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item dropdown user-profile">
                                    <a href="profile.php" class="nav-link dropdown-toggle " id="navbarDropdown4" role="button"  aria-haspopup="true" aria-expanded="false">
                                        <img src="uploads/<?php
                            if (Session::get('image')) {
                                echo Session::get('image');
                            }else {
                                echo 'avatar.jpg';
                            } ?>
                                        " >
                                        <span class="bg-success user-status"></span>
                                    </a>
                                </li>
                                
                                <li class="nav-item" style="margin-left: 10px;">
                                    <a class="nav-link dropdown-toggle" style="font-size: 14px;" href="?action=logout" id="navbarDropdown2" role="button" >Log Out</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- end navigation -->
                </nav>
                <!-- end navbar -->
            </header>
<!-- end app-header -->