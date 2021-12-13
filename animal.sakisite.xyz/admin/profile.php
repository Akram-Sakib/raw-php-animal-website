<?php require "inc/header.php";?>
<?php
$userid = Session::get('userid');
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
                                                    <a href="index.html"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">User</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="profile.php">User Profile</a></li>
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

    $name       = $_POST["name"];
    $username   = $fm->validation($_POST["username"]);
    $email      = $_POST["email"];
    $details    = $_POST["details"];

    $name     = mysqli_real_escape_string($db->link, $name);
    $username = mysqli_real_escape_string($db->link, $username);
    $email    = mysqli_real_escape_string($db->link, $email);
    $details  = mysqli_real_escape_string($db->link, $details);

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
if (empty($name) || empty($username) || empty($email) || empty($details)) {
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
                $sql = "SELECT image FROM tbl_user WHERE id = '$userid' ";
                $get_img = $db->select($sql);
                if ($get_img) {
                $del_img = $get_img->fetch_assoc();
                $unlink = "uploads/" . $del_img['image'];
                unlink($unlink);
                }

                move_uploaded_file($file_temp, "uploads/" . $unique_image);
                
                $query = "UPDATE tbl_user SET name = '$name', image = '$unique_image', username = '$username', email = '$email', details = '$details' WHERE id = '$userid' ";

                

                $post_update = $db->update($query);
                if ($post_update) {
                    $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Profile Updated successfully.</div> ";
                    echo $msg;
                } else {
                    $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Profile not Updated.</div> ";
                    echo $msg;
                }
            }

        } else {
            $query = "UPDATE tbl_user SET name = '$name', username = '$username', email = '$email', details = '$details' WHERE id = '$userid' ";
            $post_update = $db->update($query);
            if ($post_update) {
                $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Profile Updated successfully.</div> ";
                echo $msg;
            } else {
                $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Profile not Updated.</div> ";
                echo $msg;
            }
        }

    }?>
        </div>
    </div>
</div>
<?php }?>

<?php
$sql = "SELECT * FROM tbl_user WHERE id = '$userid' ";
$user = $db->select($sql);
if ($user) {
    while ($result = $user->fetch_assoc()) {
        ?>
                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Name</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="name" class="form-control" autofocus value="<?php echo $result['name']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Profile Picture</h4>
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
                                            <h4 class="card-title">Username</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="username" class="form-control" value="<?php echo $result['username']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Email</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="email" class="form-control" value="<?php echo $result['email']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Details</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <textarea id="tinymce" name="details" ><?php echo $result['details']; ?></textarea>
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