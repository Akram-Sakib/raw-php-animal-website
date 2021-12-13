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
if (Session::get('userRole') == '2' || Session::get('userRole') == '3') {
    echo "<script>window.location = 'catlist.php'</script>" ;
}
?>

<?php if (Session::get('userRole') == '1') { ?>

<?php
if (!isset($_GET["delmsgid"]) || $_GET["delmsgid"] == null) {
    echo "<script>window.location = '404.php'; </script>";
} else {

    $delmsgid = mysqli_real_escape_string($db->link, $_GET["delmsgid"]);

    /* Role */
    $sql = "SELECT * FROM tbl_contact WHERE id = '$delmsgid' ";
    $post = $db->select($sql);
    if ($post) {
    $result = $post->fetch_assoc();
    if ((Session::get('userRole') == 1)) {

    $delquery = "DELETE FROM tbl_contact WHERE id = '$delmsgid' ";
    $deleteMsg = $db->delete($delquery);
    if ($deleteMsg) {
        echo "<script>alert('Data Deleted Successfully');</script>";
        echo "<script>window.location = 'inbox.php'; </script>";
    } else {
        $msg = "<div class='alert alert-danger'><Strong>Error ! </Strong>Data not Deleted.</div> ";
        echo $msg;
    }
}else {
        echo "<script>window.location = '404.php'</script>" ;
    }
    
    }
}
?>

<?php } ?>