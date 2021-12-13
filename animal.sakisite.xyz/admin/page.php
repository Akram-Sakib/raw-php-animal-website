<?php require "inc/header.php";?>
<?php
$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pageid) || $pageid == null) {
    echo "<script>window.location = '404.php'; </script>";
} else {
    $pageid = $pageid;
}
?>
<?php 
if (Session::get('userRole') == '3') {
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
                                                    <a href="index.php">Pages</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Page Details</li>
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
    $body  = $_POST["body"];

    $title = mysqli_real_escape_string($db->link, $title);
    $body  = mysqli_real_escape_string($db->link, $body);

    ?>

<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
    <?php
if (empty($title) || empty($body)) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {
        $query = "UPDATE tbl_page SET title = '$title', body = '$body' WHERE id = '$pageid' ";
        $upd = $db->update($query);
        if ($upd) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Page Updated successfully.</div> ";
            echo $msg;
        } else {
            $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Page not Updated.</div> ";
            echo $msg;
        }
    }
    ?>
        </div>
    </div>
</div>
<?php }?>

<?php
$sql = "SELECT * FROM tbl_page WHERE id = '$pageid' ";
$page = $db->select($sql);
if ($page) {
    while ($result = $page->fetch_assoc()) {
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
                                            <h4 class="card-title">Content</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <textarea id="tinymce" name="body" ><?php echo $result['body']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                        <a href="delpage.php?delpageid=<?php echo $result['id']; ?>" class="btn btn-primary" onclick="return confirm('Are you sure to Delete Data!'); ">Delete</a>
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

<!-- Load TinyMCE -->
    <script>
      tinymce.init({
        selector: '#tinymce'
      });
    </script>
<!-- Load TinyMCE -->
<?php require "inc/footer.php";?>