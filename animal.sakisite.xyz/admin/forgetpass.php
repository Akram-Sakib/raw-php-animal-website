<?php require "../lib/Session.php";?>

<?php require "../config/config.php";?>
<?php require "../lib/Database.php";?>
<?php require "../lib/format.php";?>

<?php
$db = new Database();
$fm = new format();
?>

<?php Session::checkLogin();?>
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
    $email    = $fm->validation($_POST["email"]);

    $username = mysqli_real_escape_string($db->link, $username);
    $email    = mysqli_real_escape_string($db->link, $email);

    $mailQuery = "SELECT `email` FROM `tbl_user` WHERE `email` = '$email' LIMIT 1 ";
    $mailcheck = $db->select($mailQuery);
    if ($mailcheck != false) {

    $query = "SELECT * FROM tbl_user WHERE username = '$username' AND email = '$email' LIMIT 1 ";
    $result = $db->select($query);
    if ($result != false) {
        while ($value = $result->fetch_assoc()) {
           $userid   = $value["id"];
           $username = $value["username"];
        }
        $text    = substr($email, 0 , 4);
        $rand    = rand(00000, 99999);
        $newpass = "$text$rand";
        $newpassmd5 = md5($newpass);

        $updQuery = "UPDATE tbl_user SET password = '$newpassmd5' WHERE id = '$userid' ";
        $upd = $db->update($updQuery);

        $to = $email;
        $subject = "Forgotten Passowrd";
        $txt     = "Here is your new password".$newpass."\n";
        $headers = "From: " .$email. "\r\n";

        mail($to, $subject, $txt, $headers);

        $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Please check your Email.!</div> ";
        echo $msg;
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Username or Email not matched.!</div> ";
        echo $msg;
    }

}else {
    $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Invalid Email Address.!</div> ";
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
                                                        <label class="control-label">Email*</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Email" />
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
                                                        <a href="login.php" class="ml-auto">Login !</a>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary text-uppercase" />
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