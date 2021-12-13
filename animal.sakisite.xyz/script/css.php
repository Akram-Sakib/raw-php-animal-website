<link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <?php
$query  = "SELECT * FROM tbl_theme";
$themes = $db->select($query);
    while ($result = $themes->fetch_assoc()) { ?>
<?php if ($result['theme'] == "default") { ?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php } ?>
<?php if ($result['theme'] == "dark") {?>
<link rel="stylesheet" type="text/css" href="theme/dark.css">
<?php }?>
<?php } ?>
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<?php
$get_url = $_SERVER['SCRIPT_FILENAME'];
$get_url_base = basename($get_url);
if ($get_url_base == "contact.php") {?>
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/maindark.css">
  <?php
$query = "SELECT * FROM tbl_theme";
$themes = $db->select($query);
while ($result = $themes->fetch_assoc()) {?>
<?php if ($result['theme'] == "default") {?>
<link rel="stylesheet" type="text/css" href="css/main.css">
<?php }?>
<?php if ($result['theme'] == "dark") {?>
<link rel="stylesheet" type="text/css" href="theme/maindark.css">
<?php }?>

<?php }?>
  
<?php }?>