<?php require "inc/header.php";?>
<?php 
if (Session::get('userRole') == '2' || Session::get('userRole') == '3') {
    echo "<script>window.location = 'index.php'</script>" ;
}
?>
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <?php require "inc/sidebar.php";?>
                <!-- end app-navbar -->
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Add New User</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">User</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="adduser.php">Adduser</a></li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- begin row -->
                        <div class="row">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $email    = $_POST["email"];
    $role     = $_POST["role"];

    $username = mysqli_real_escape_string($db->link, $username);
    $password = mysqli_real_escape_string($db->link, $password);
    $email    = mysqli_real_escape_string($db->link, $email);
    $role     = mysqli_real_escape_string($db->link, $role);
;?>

<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
    <?php

    if (empty($username) || empty($password) || empty($email) || empty($role)) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {

        $query = "INSERT INTO tbl_user(username,password,email,role) VALUES('$username','$password','$email','$role') ";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>User Added successfully.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>User not inserted successfully.</div> ";
            echo $msg;
        }
    }?>
        </div>
    </div>
</div>
<?php }?>

                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Username*</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="username" class="form-control" autofocus placeholder="Enter Username">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Password*</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="password" class="form-control" placeholder="Enter Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Email*</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">User Role*</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <select name="role" class="custom-select">
                                        <option selected>Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Editor</option>
                                        <option value="3">Author</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="SUBMIT" />
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->

<!-- Load TinyMCE -->
    <script>
      tinymce.init({
        selector: '#tinymce'
      });
    </script>
<!-- Load TinyMCE -->
<?php require "inc/footer.php";?>