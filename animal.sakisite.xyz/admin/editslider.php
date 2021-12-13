<?php require "inc/header.php";?>

<?php
$sliderid = mysqli_real_escape_string($db->link, $_GET['sliderid']);
if (!isset($sliderid) || $sliderid == null) {
    echo "<script>window.location = 'sliderlist.php'; </script>";
} else {
    $sliderid = $sliderid;
}
?>
<?php 
if (Session::get('userRole') == '3') {
    echo "<script>window.location = 'sliderlist.php'</script>" ;
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
                                                    <a href="index.php">Slider Option</a>
                                                </li>
                                                <li class="breadcrumb-item text-primary" aria-current="page"><a href="sliderlist.php">Sliderlist</a></li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="editslider.php">Editslider</a></li>
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
    $title = mysqli_real_escape_string($db->link, $title);

    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;
    ?>

<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
    <?php
if (empty($title)) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {

        if (!empty($file_name)) {

            if ($file_size > 3048567) {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Image size should be less then 3 MB.</div> ";
                echo $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>You can upload only:-" . implode(', ', $permited) . "</div>";
                echo $msg;
            } else {
                $sql = "SELECT * FROM tbl_slider WHERE id = '$sliderid' ";
                $get_img = $db->select($sql);
                $del_img = $get_img->fetch_assoc();
                $unlink = "uploads/" . $del_img['slider'];

                unlink($unlink);

                move_uploaded_file($file_temp, "uploads/" . $unique_image);

                $query = "UPDATE tbl_slider SET title = '$title', slider = '$unique_image' WHERE id = '$sliderid' ";
                $sliderupdate = $db->update($query);
                if ($sliderupdate) {
                    $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
                    echo $msg;
                } else {
                    $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
                    echo $msg;
                }
            }

        } else {
            $query = "UPDATE tbl_slider SET title = '$title' WHERE id = '$sliderid' ";
            $sliderupdate = $db->update($query);
            if ($sliderupdate) {
                $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
                echo $msg;
            } else {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
                echo $msg;
            }
        }

    }?>
        </div>
    </div>
</div>
<?php }?>

<?php
$sql = "SELECT * FROM tbl_slider WHERE id = '$sliderid' ";
$slider = $db->select($sql);
if ($slider) {
    while ($result = $slider->fetch_assoc()) {
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
                                            <h4 class="card-title">Update Image</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="uploads/<?php echo $result["slider"]; ?>" width="150px" height="100px" class="mb-2" >
                                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 clearfix">
                                <div class="card card-statistics float-left">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="Save" />
                                    </div>
                                </div>
                                <?php 
                                if (Session::get('userRole') == '1') {
                                ?>
                                <div class="card card-statistics float-left">
                                    <div class="card-body">
                                        <a href="delslider.php?delsliderid=<?php echo $result['id']; ?>" class="btn btn-primary" onclick="return confirm('Are you sure to Delete Data!'); ">Delete</a>
                                    </div>
                                </div>
                                <?php } ?>
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

<?php require "inc/footer.php";?>