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
if (!isset($_GET["del_team_id"]) || $_GET["del_team_id"] == NULL) {
    echo "<script>window.location = 'memberlist.php'; </script>" ;
}else {

    $del_team_id = mysqli_real_escape_string($db->link, $_GET["del_team_id"]);

    /* Role */
    $sql = "SELECT * FROM tbl_team WHERE id = '$del_team_id' ";
    $post = $db->select($sql);
    if ($post) {
    $result = $post->fetch_assoc();
    if (Session::get('userRole') == 1) {

    $del_team_id = $_GET["del_team_id"];

    $query = "SELECT * FROM tbl_team WHERE id = '$del_team_id' ";
    $getData = $db->select($query);
    if ($getData) {
        $result = $getData->fetch_array();
        $unlink  = "uploads/".$result["image"];
        unlink($unlink);
    }

    $delquery = "DELETE FROM tbl_team WHERE id = '$del_team_id' ";
    $delteam = $db->delete($delquery);
    if ($delteam) {
        echo "<script>alert('Team Member Deleted Successfully');</script>";
        echo "<script>window.location = 'memberlist.php'; </script>";
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