 <?php
require "../lib/Session.php";
Session::checkSession();
?>
<?php require "../config/config.php";?>
<?php require "../lib/Database.php";?>
<?php
$db = new Database();
?>

<?php
if (!isset($_GET["delsliderid"]) || $_GET["delsliderid"] == null) {
    echo "<script>window.location = 'sliderlist.php'; </script>";
} else {

    $delsliderid = mysqli_real_escape_string($db->link, $_GET["delsliderid"]);

    /* Role */
    $sql = "SELECT * FROM tbl_slider WHERE id = '$delsliderid' ";
    $post = $db->select($sql);
    if ($post) {
    $result = $post->fetch_assoc();
    if ((Session::get('userRole') == 1)) {

    $query = "SELECT * FROM tbl_slider WHERE id = '$delsliderid' ";
    $getData = $db->select($query);
    if ($getData) {
        $result = $getData->fetch_array();
        $unlink  = "uploads/".$result["slider"];
        unlink($unlink);
    }

    $delquery = "DELETE FROM tbl_slider WHERE id = '$delsliderid' ";
    $deleteslider = $db->delete($delquery);
    if ($deleteslider) {
        echo "<script>alert('Slider Deleted Successfully');</script>";
        echo "<script>window.location = 'sliderlist.php'; </script>";
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Slider not Deleted.</div> ";
        echo $msg;
    }
}else {
        echo "<script>window.location = '404.php'</script>" ;
    }

    }
}
?>