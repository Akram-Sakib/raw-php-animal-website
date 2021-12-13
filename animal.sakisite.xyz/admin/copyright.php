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
                                        <h1>Edit Category</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.html"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Page Option</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="copyright.php">Copyright</a></li>
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

    $copyright = $_POST["copyright"];
    $copyright = mysqli_real_escape_string($db->link, $copyright);
    ?>
<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-header">
            <div class="card-heading">
    <?php

    if (empty($copyright)) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {
        $sql = "UPDATE tbl_footer SET copyright = '$copyright' WHERE id = '1' ";
        $footer_update = $db->update($sql);

        if ($footer_update) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Footer has Updated.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Footer not Updated.</div> ";
            echo $msg;
        }
    }?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Copyright Text</h4>
                                        </div>
                                    </div>
                                    <form action="" method="POST" style="width: 100%;">
                                    <?php
$sql = "SELECT * FROM tbl_footer WHERE id = '1' ";
$footer_update = $db->select($sql);
if ($footer_update) {
    while ($result = $footer_update->fetch_assoc()) {
        ?>
                                    <div class="card-body">
                                        <input type="text" name="copyright" class="form-control" autofocus value="<?php echo $result['copyright']; ?>">
                                    </div>
                                    <?php } }?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" type="submit" value="Save" />
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