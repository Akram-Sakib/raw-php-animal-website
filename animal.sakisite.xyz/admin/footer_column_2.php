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
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="footer_column_2.php">Footer Column 2</a></li>
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

    $title      = $_POST["title"];

    $home               = $_POST["home"];
    $about              = $_POST["about"];
    $privacypolicy      = $_POST["privacy"];
    $contact            = $_POST["contact"];
    $home_link          = $_POST["home_link"];
    $about_link         = $_POST["about_link"];
    $privacypolicy_link = $_POST["privacy_link"];
    $contact_link       = $_POST["contact_link"];

    $home               = mysqli_real_escape_string($db->link, $home);
    $about              = mysqli_real_escape_string($db->link, $about);
    $privacypolicy      = mysqli_real_escape_string($db->link, $privacypolicy);
    $contact            = mysqli_real_escape_string($db->link, $contact);
    $home_link          = mysqli_real_escape_string($db->link, $home_link);
    $about_link         = mysqli_real_escape_string($db->link, $about_link);
    $privacypolicy_link = mysqli_real_escape_string($db->link, $privacypolicy_link);
    $contact_link       = mysqli_real_escape_string($db->link, $contact_link);

    ?>

<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
    <?php
if (empty($title) || empty($home) || empty($about) || empty($privacypolicy) || empty($contact) || empty($home_link) || empty($about_link) || empty($privacypolicy_link) || empty($contact_link) ) {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field must be not empty.</div> ";
        echo $msg;
    } else {

        $query = "UPDATE tbl_footer_top_column_2 SET title = '$title', Home = '$home', About = '$about', `Privacy Policy` = '$privacypolicy ', Contact = '$contact ' , home_link = '$home_link', about_link = '$about_link', privacy_link = '$privacypolicy_link', contact_link = '$contact_link' WHERE id = '1' ";
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
$sql = "SELECT * FROM tbl_footer_top_column_2 ";
$tbl_footer_top_column_2 = $db->select($sql);
if ($tbl_footer_top_column_2) {
    while ($result = $tbl_footer_top_column_2->fetch_assoc()) {
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
                                            <h4 class="card-title">Menu Home</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="home" class="form-control" value="<?php echo $result['Home']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu Home Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="home_link" class="form-control"  value="<?php echo $result['home_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu About</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="about" class="form-control" value="<?php echo $result['About']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu About Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="about_link" class="form-control"  value="<?php echo $result['about_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu Privacy Policy</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="privacy" class="form-control" value="<?php echo $result['Privacy Policy']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu Privacy Policy Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="privacy_link" class="form-control"  value="<?php echo $result['privacy_link']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu Contact</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="contact" class="form-control" value="<?php echo $result['Contact']; ?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Menu Contact Link</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" name="contact_link" class="form-control"  value="<?php echo $result['contact_link']; ?>" >
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