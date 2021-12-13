<?php require "inc/header.php";?>

<?php
$viewpostid = mysqli_real_escape_string($db->link, $_GET['viewpostid']);
if (!isset($viewpostid) || $viewpostid == null) {
    echo "<script>window.location = 'postlist.php'; </script>";
} else {
    $viewpostid = $viewpostid;
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
                                        <h1>Post</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="postlist.php">Postlist</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="">Viewpost</a></li>
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
echo "<script>window.location = 'postlist.php'</script>";
}
 ?>

<?php
$sql = "SELECT * FROM tbl_post WHERE id = '$viewpostid' ";
$viewpost = $db->select($sql);
if ($viewpost) {
    while ($result = $viewpost->fetch_assoc()) {
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
                                        <input type="text" name="title" readonly class="form-control" autofocus value="<?php echo $result['title']; ?>" >
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
                                            <option readonly 
                                            <?php
if ($catresult['id'] == $result['cat']) {
                    echo "selected";
                }
                ?>
                                             value="<?php echo $catresult["id"]; ?>"><?php echo $catresult["name"]; ?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Post Image</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <img src="uploads/<?php echo $result["image"]; ?>" width="150px" height="100px" class="mb-2" >
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
                                        <input type="text" readonly name="tags" class="form-control" value="<?php echo $result['tags']; ?>" >
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
                                        <input type="hidden" name="author" value="<?php echo Session::get('userid'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="Ok" />
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
<?php require "inc/footer.php";?>