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
                                        <h1>Edit Post</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Widgets</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Footer Top</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="footer_column_3.php">Footer Column 3</a></li>
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

    $title = $_POST["title"];

    $fb_link = $_POST["fb_link"];
    $tw_link = $_POST["tw_link"];
    $gp_link = $_POST["gp_link"];
    $ln_link = $_POST["ln_link"];

    $fb_link = mysqli_real_escape_string($db->link, $fb_link);
    $tw_link = mysqli_real_escape_string($db->link, $tw_link);
    $gp_link = mysqli_real_escape_string($db->link, $gp_link);
    $ln_link = mysqli_real_escape_string($db->link, $ln_link);

    ?>

<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
    <?php
if (empty($fb_link) || empty($tw_link) || empty($gp_link) || empty($ln_link) ) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {

        $query = "UPDATE tbl_footer_top_column_3 SET fb_link = '$fb_link', tw_link = '$tw_link', gp_link = '$gp_link', ln_link = '$ln_link ' WHERE id = '1' ";
        $upd = $db->update($query);
        if ($upd) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
            echo $msg;
        }
    }
    ?>
        </div>
    </div>
</div>
<?php }?>

<?php
$sql = "SELECT * FROM tbl_footer_top_column_3 ";
$tbl_footer_top_column_3 = $db->select($sql);
if ($tbl_footer_top_column_3) {
    while ($result = $tbl_footer_top_column_3->fetch_assoc()) {
        ?>
                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Title</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="title" class="form-control" autofocus value="<?php echo $result['title']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Facebook Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="fb_link" class="form-control"  value="<?php echo $result['fb_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Twitter Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="tw_link" class="form-control" value="<?php echo $result['tw_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Google+ Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="gp_link" class="form-control"  value="<?php echo $result['gp_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Linked In Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="ln_link" class="form-control" value="<?php echo $result['ln_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="Save & Update" />
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php }}?>
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