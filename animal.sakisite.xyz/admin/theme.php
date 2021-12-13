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
                            <h1>Website Theme</h1>
                        </div>
                        <div class="ml-auto d-flex align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.php"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item text-primary active">
                                        <a href="theme.php">Theme</a>
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
    $theme = strtolower($_POST['theme']);
    ?>
<div class="col-md-12">
    <div class="card card-statistics">
        <div class="card-body">
<?php
    $query = "UPDATE tbl_theme SET theme = '$theme' WHERE id = '1' ";
    $updated_row = $db->update($query);
    if ($updated_row) {
        echo "<div class='alert alert-success'><Strong>Success ! </Strong>Theme Changed successfully.</div> ";
    } else {
        echo "<div class='alert alert-danger'><Strong>Error ! </Strong>Theme not Changed.</div> ";
    }
?>
        </div>
    </div>
</div>
<?php } ?>
<?php
$query    = "SELECT * FROM tbl_theme";
$themes = $db->select($query);
    while ($result = $themes->fetch_assoc()) {
?>
                            <form action="" method="POST" style="width: 100%;">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Choose Theme</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="theme" id="exampleRadios1" value="default" <?php if ($result['theme'] == 'default') { echo 'checked'; }?> >
                                            <label class="form-check-label" for="exampleRadios1">
                                                Default
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="theme" id="exampleRadios2" value="dark" <?php if ($result['theme'] == 'dark') { echo 'checked'; }?> >
                                            <label class="form-check-label" for="exampleRadios2">
                                                Dark
                                            </label>
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
                            <?php } ?>
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