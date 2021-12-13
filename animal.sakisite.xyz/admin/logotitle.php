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
                                        <h1>Update Logo or Title</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Page Option</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="logotitle.php">Logo & Title</a></li>
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
    $subtitle = $_POST["subtitle"];

    $title = mysqli_real_escape_string($db->link, $title);
    $subtitle = mysqli_real_escape_string($db->link, $subtitle);

    $permited = array('png');
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
if (empty($title) || empty($subtitle)) {
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
                $sql = "SELECT * FROM tbl_logotitle WHERE id = '1' ";
                $get_img = $db->select($sql);
                $del_img = $get_img->fetch_assoc();
                $unlink = "uploads/" . $del_img['image'];

                unlink($unlink);

                move_uploaded_file($file_temp, "uploads/" . $unique_image);

                $query = "UPDATE tbl_logotitle SET logo = '$unique_image', title = '$title', subtitle = '$subtitle' WHERE id = '1' ";
                $logo_title = $db->update($query);
                if ($logo_title) {
                    $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
                    echo $msg;
                } else {
                    $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
                    echo $msg;
                }
            }

        } else {
            $query = "UPDATE tbl_logotitle SET title = '$title', subtitle = '$subtitle' WHERE id = '1' ";

            $logo_title = $db->update($query);
            if ($logo_title) {
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
$sql = "SELECT * FROM tbl_logotitle WHERE id = '1' ";
$author_details = $db->select($sql);
if ($author_details) {
    while ($result = $author_details->fetch_assoc()) {
        ?>
                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Change Logo</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="uploads/<?php echo $result["logo"]; ?>" width="150px" height="100px" class="mb-2" >
                                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Title</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="title" class="form-control" autofocus placeholder="Enter Website Title Here" value="<?php echo $result['title']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Subtitle</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="subtitle" class="form-control" autofocus placeholder="Enter Website Subtitle Here" value="<?php echo $result['subtitle']; ?>" >
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