<?php require "inc/header.php";?>

<?php
$replyid = mysqli_real_escape_string($db->link, $_GET['replyid']);
if (!isset($replyid) || $replyid == null) {
    echo "<script>window.location = 'inbox.php'; </script>";
} else {
    $replyid = $replyid;
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
                                                    <a href="inbox.php">Mail</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="">Replymsg</a></li>
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

    $to      = $fm->validation($_POST["to"]);
    $subject = $fm->validation($_POST["subject"]);
    $message = $fm->validation(mysqli_real_escape_string($db->link, $_POST["body"]));
    $from    = $fm->validation("From: " . $_POST["from"]); 
    ?>
<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
<?php
    $sendMail = mail($to, $subject, $message, $from);
    if ($sendMail) {
        $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Message Sent Successfully.</div> ";
        echo $msg;
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Message not Sent.</div> ";
        echo $msg;
    }
?>
        </div>
    </div>
</div>
<?php } ?>

<?php
$query = "SELECT * FROM tbl_contact WHERE id = '$replyid' ";
$inbox = $db->select($query);
if ($inbox) {
    $i = 0;
    while ($result = $inbox->fetch_assoc()) {
        $i++;
        ?>
                            <form action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">To</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="to" class="form-control" readonly value="<?php echo $result['email']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">From</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="from" class="form-control" value="" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Subject</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="subject" value="">
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
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <input class="btn btn-primary" name="Submit" type="submit" value="Send" />
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