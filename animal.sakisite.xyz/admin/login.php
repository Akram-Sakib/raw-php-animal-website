<?php require "../lib/Session.php"; ?>

<?php require "../config/config.php"; ?>
<?php require "../lib/Database.php"; ?>
<?php require "../lib/format.php"; ?>

<?php
    $db = new Database();
    $fm = new format();
?>

<?php Session::checkLogin(); ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <title>Login - Admin Panel Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">


            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
                                        <h1 class="mb-2">We Are Developer</h1>
                                        <p class="mb-4">Welcome back, please login to your account.</p>
                                         <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $fm->validation($_POST["username"]);
    $password = $fm->validation(md5($_POST["password"]));

    $username = mysqli_real_escape_string($db->link, $username);
    $password = mysqli_real_escape_string($db->link, $password);

    $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password' ";
    $login = $db->select($sql);
    if ($login != false) {
        $result = $login->fetch_array();
        Session::set("login", true);
        Session::set("username", $result['username']);
        Session::set("userid", $result['id']);
        Session::set("image", $result['image']);
        Session::set("userRole", $result['role']);
        header("location: index.php");
 
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Username or password not matched.!</div> ";
        echo $msg;
    }

}
?>
                                        <form action="" method="POST" class="mt-3 mt-sm-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">User Name*</label>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Password*</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-block d-sm-flex  align-items-center">
                                                        <!-- <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="gridCheck" name="remember me" >
                                                            <label class="form-check-label" for="gridCheck">
                                                                Remember Me
                                                            </label>
                                                        </div> -->
                                                        <a href="forgetpass.php" class="ml-auto">Forgot Password ?</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <input type="submit" name="submit" value="Login" class="btn btn-primary text-uppercase" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="assets/img/bg/login.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->



    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>
</body>


</html>