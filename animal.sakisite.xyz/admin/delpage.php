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
if (!isset($_GET["delpageid"]) || $_GET["delpageid"] == null) {
    echo "<script>window.location = '404.php'; </script>";
} else {

    $delpageid = mysqli_real_escape_string($db->link, $_GET["delpageid"]);

    /* Role */
    $sql = "SELECT * FROM tbl_page WHERE id = '$delpageid' ";
    $post = $db->select($sql);
    if ($post) {
    $result = $post->fetch_assoc();
    if ((Session::get('userRole') == 1)) {

    $delquery = "DELETE FROM tbl_page WHERE id = '$delpageid' ";
    $deleteslider = $db->delete($delquery);
    if ($deleteslider) {
        echo "<script>alert('Page Deleted Successfully');</script>";
        echo "<script>window.location = 'index.php'; </script>";
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