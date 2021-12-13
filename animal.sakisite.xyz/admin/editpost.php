<?php require "inc/header.php";?>

<?php
    $editpostid = mysqli_real_escape_string($db->link, $_GET['editpostid']);
    if (!isset($editpostid) || $editpostid == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>" ;
    }else {
        $editpostid = $editpostid;
    }
?>
<?php
$sql = "SELECT * FROM tbl_post WHERE id = '$editpostid' ";
$post = $db->select($sql);
if ($post) {
$result = $post->fetch_assoc();

if (Session::get('userRole') != 1) {
    if (Session::get('userid') != $result['userid']) {
    echo "<script>window.location = 'postlist.php'; </script>";
}
}

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
                                                    <a href="index.html"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Post</a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="postlist.php">Postlist</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="">Editpost</a></li>
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

    $title  = $_POST["title"];
    $cat    = $_POST["cat"];
    $body   = $_POST["body"];
    $tags   = $_POST["tags"];
    $author = $fm->validation($_POST["author"]);
    $userid = $_POST["userid"];

    $title  = mysqli_real_escape_string($db->link, $title);
    $cat    = mysqli_real_escape_string($db->link, $cat);
    $body   = mysqli_real_escape_string($db->link, $body);
    $tags   = mysqli_real_escape_string($db->link, $tags);
    $author = mysqli_real_escape_string($db->link, $author);
    $userid = mysqli_real_escape_string($db->link, $userid);

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
    if (empty($title) || empty($cat) || empty($body) || empty($tags) || empty($author)) {
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
    }else{
        $sql = "SELECT * FROM tbl_post WHERE id = '$editpostid' ";
        $get_img = $db->select($sql);
        $del_img = $get_img->fetch_assoc();
        $unlink  = "uploads/".$del_img['image'];

        unlink($unlink);

        move_uploaded_file($file_temp, "uploads/" . $unique_image);

        $query = "UPDATE tbl_post SET title = '$title', cat = '$cat', body = '$body', image = '$unique_image', author = '$author', tags = '$tags',userid = '$userid' WHERE id = '$editpostid' ";
        $post_update = $db->update($query);
        if ($post_update) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Data Updated successfully.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Updated.</div> ";
            echo $msg;
        }
    }

    }else {
        $query = "UPDATE tbl_post SET title = '$title', cat = '$cat', body = '$body', author = '$author', tags = '$tags', userid = '$userid' WHERE id = '$editpostid' ";
        $post_update = $db->update($query);
        if ($post_update) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Post Updated successfully.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Post not Updated.</div> ";
            echo $msg;
        }
    }

} ?>
        </div>
    </div>
</div>
<?php } ?>

<?php
$sql = "SELECT * FROM tbl_post WHERE id = '$editpostid' ";
$category = $db->select($sql);
if ($category) {
while ($result = $category->fetch_assoc()) {
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
                                            <h4 class="card-title">Category</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <select name="cat" class="custom-select">
                                        <option>Select Category</option>
                                        <?php
                                            $sql = "SELECT * FROM tbl_category ";
                                            $category = $db->select($sql);
                                            if ($category) {
                                            while ($catresult = $category->fetch_assoc()) {
                                                ?>
                                            <option
                                            <?php
                                            if ($catresult['id'] == $result['cat']) {
                                                echo "selected";
                                            }
                                            ?>
                                             value="<?php echo $catresult["id"]; ?>"><?php echo $catresult["name"]; ?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Upload Image</h4>
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
                                            <h4 class="card-title">Content</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <textarea id="tinymce" name="body" ><?php echo $result['body']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Tags</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="tags" class="form-control" value="<?php echo $result['tags']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Author</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" readonly class="form-control" name="author" value="<?php echo $result['author']; ?>">
                                        <input type="hidden" name="userid" value="<?php echo Session::get('userid'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="Save" />
                                    </div>
                                </div>
                            </div>
                            </form>
                            <?php } } ?>
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
<?php require "inc/footer.php"; ?>