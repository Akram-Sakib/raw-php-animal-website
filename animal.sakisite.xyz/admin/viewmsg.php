<?php require "inc/header.php";?>

<?php
$msgid = mysqli_real_escape_string($db->link, $_GET['msgid']);
if (!isset($msgid) || $msgid == null) {
    echo "<script>window.location = 'postlist.php'; </script>";
} else {
    $msgid = $msgid;
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
                                            <a href="index.php">Inbox</a>
                                        </li>
                                        </li>
                                        <li class="breadcrumb-item active text-primary" aria-current=""><a href="viewmsg.php">View Message</a></li>
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
    echo "<script>window.location = 'inbox.php'; </script>";
}
?>

<?php
$sql = "SELECT * FROM tbl_contact WHERE id = '$msgid' ";
$viewmsg = $db->select($sql);
if ($viewmsg) {
    while ($result = $viewmsg->fetch_assoc()) {
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
                                        <input type="text" name="name" readonly class="form-control" autofocus value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Email Address</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" readonly name="email" class="form-control"  value="<?php echo $result['email']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Date</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" readonly name="date" class="form-control" value="<?php echo $fm->date($result['date']); ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Message</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <textarea readonly id="tinymce" name="body" ><?php echo $result['body']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="OK" />
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