 <?php
require "../lib/Session.php";
Session::checkSession();
?>
<?php require "../config/config.php"; ?>
<?php require "../lib/Database.php"; ?>
<?php
$db = new Database();
?>

<?php
if (!isset($_GET["delpostid"]) || $_GET["delpostid"] == NULL) {
    echo "<script>window.location = 'postlist.php'; </script>" ;
}else {

    $delpostid = mysqli_real_escape_string($db->link, $_GET["delpostid"]);

    /* Role */
    $sql = "SELECT * FROM tbl_post WHERE id = '$delpostid' ";
    $post = $db->select($sql);
    if ($post) {
    $result = $post->fetch_assoc();
    if ((Session::get('userRole') == 1) || (Session::get('userid') == $result['userid'])) {

    $query = "SELECT * FROM tbl_post WHERE id = '$delpostid' ";
    $getData = $db->select($query);
    if ($getData) {
        $result = $getData->fetch_array();
        $unlink  = "uploads/".$result["image"];
        unlink($unlink);
    }

    $delquery = "DELETE FROM tbl_post WHERE id = '$delpostid' ";
    $deletepost = $db->delete($delquery);
    if ($deletepost) {
        echo "<script>alert('Post Deleted Successfully');</script>";
        echo "<script>window.location = 'postlist.php'; </script>";
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