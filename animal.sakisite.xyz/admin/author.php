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
                                        <h1>Update Logo or Title</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i>Page Option</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="author.php">Author Details</a>
                                                </li>
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

    $description  = $_POST["description"];
    $fb           = $_POST["fb"];
    $tw           = $_POST["tw"];
    $ln           = $_POST["ln"];
    $yt           = $_POST["yt"];
    $ig           = $_POST["ig"];
    $pn           = $_POST["pn"];

    $description = mysqli_real_escape_string($db->link, $description);
    $fb = mysqli_real_escape_string($db->link, $fb);
    $tw = mysqli_real_escape_string($db->link, $tw);
    $ln = mysqli_real_escape_string($db->link, $ln);
    $yt = mysqli_real_escape_string($db->link, $yt);
    $ig = mysqli_real_escape_string($db->link, $ig);
    $pn = mysqli_real_escape_string($db->link, $pn);

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
if (empty($description) || empty($fb) || empty($tw) || empty($ln) || empty($yt) || empty($ig) || empty($pn) ) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {

        if (!empty($file_name)) {

            if ($file_size > 3048567) {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Image size should be less then 3 MB.</div> ";
                echo $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>You can upload only:- " . implode(', ', $permited) . " file</div>";
                echo $msg;
            } else {
                $sql = "SELECT * FROM tbl_author_details WHERE id = '1' ";
                $get_img = $db->select($sql);
                $del_img = $get_img->fetch_assoc();
                $unlink = "uploads/" . $del_img['image'];

                unlink($unlink);

                move_uploaded_file($file_temp, "uploads/" . $unique_image);

                $query = "UPDATE tbl_author_details SET image = '$unique_image', description = '$description', fb = '$fb' , tw = '$tw' , ln = '$ln' , yt = '$yt' , ig = '$ig' , pn = '$pn' WHERE id = '1' ";
                $author_update = $db->update($query);
                if ($author_update) {
                    $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
                    echo $msg;
                } else {
                    $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
                    echo $msg;
                }
            }

        } else {
            $query = "UPDATE tbl_author_details SET description = '$description', fb = '$fb' , tw = '$tw' , ln = '$ln' , yt = '$yt' , ig = '$ig' , pn = '$pn' WHERE id = '1' ";

            $author_update = $db->update($query);
            if ($author_update) {
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
$sql = "SELECT * FROM tbl_author_details WHERE id = '1' ";
$author_details = $db->select($sql);
if ($author_details) {
    while ($result = $author_details->fetch_assoc()) {
        ?>
                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Author Image</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="uploads/<?php echo $result["image"]; ?>" width="150px" height="100px" class="mb-2" >
                                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Author Description</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <textarea id="tinymce" name="description" ><?php echo $result['description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Author Social</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="fb">Facebook URL:</label>
                                            <input type="text" name="fb" class="form-control" id="fb" value="<?php echo $result['fb']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tr">Twitter URL:</label>
                                            <input type="text" name="tw" class="form-control" id="tr" value="<?php echo $result['tw']; ?>">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="br">Linked In URL:</label>
                                            <input type="text" name="ln" class="form-control" id="br" value="<?php echo $result['ln']; ?>">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="go">Youtube URL:</label>
                                            <input type="text" name="yt" class="form-control" id="go" value="<?php echo $result['yt']; ?>">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="li">Instagram URL:</label>
                                            <input type="text" name="ig" class="form-control" id="li" value="<?php echo $result['ig']; ?>">
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="we">Pinterst URL:</label>
                                            <input type="text" name="pn" class="form-control" id="we" value="<?php echo $result['pn']; ?>">
                                        </div>
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
                            <?php }} ?>
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