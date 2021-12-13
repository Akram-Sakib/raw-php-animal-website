<?php require "inc/header.php";?>
<?php 
if (Session::get('userRole') == '2' || Session::get('userRole') == '3') {
    echo "<script>window.location = 'catlist.php'</script>" ;
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
                                        <h1>Add New Category</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Category Option</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="addcat.php">Addcat</a></li>
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

    $name = $fm->validation($_POST["name"]);
    $name = mysqli_real_escape_string($db->link, $name);
    ?>
<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
    <?php
    if (empty($name)) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {
        $sql = "INSERT INTO tbl_category(name) VALUES('$name')";
        $catinsert = $db->insert($sql);

        if ($catinsert) {
        $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Category has inserted.</div> ";
        echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Category not inserted.</div> ";
            echo $msg;
        }
    } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Category</h4>
                                        </div>
                                    </div>
                                    <form action="" method="POST" style="width: 100%;">
                                    <div class="card-body">
                                        <input type="text" name="name" class="form-control" autofocus placeholder="Enter Category Name Here">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" type="submit" value="Add" />
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
<?php require "inc/footer.php";?>