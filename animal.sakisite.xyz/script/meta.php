<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  if (isset($_GET['pageid'])) {
    $pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
    $sql = "SELECT * FROM tbl_page WHERE id = '$pageid' ";
    $page = $db->select($sql);
    if ($page) {
        while ($result = $page->fetch_assoc()) { ?>
    <title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>
    <?php } } }elseif (isset($_GET['category'])) {
    $category = mysqli_real_escape_string($db->link, $_GET['category']);
    $sql = "SELECT * FROM tbl_category WHERE id = '$category' ";
    $categories = $db->select($sql);
    if ($categories) {
        while ($result = $categories->fetch_assoc()) { ?>
    <title><?php echo $result['name']; ?> - <?php echo TITLE; ?></title>
   <?php } } }elseif (isset($_GET['postid'])) {
    $postid = mysqli_real_escape_string($db->link, $_GET['postid']);
    $sql = "SELECT * FROM tbl_post WHERE id = '$postid' ";
    $post = $db->select($sql);
    if ($post) {
        while ($result = $post->fetch_assoc()) { ?>
    <title><?php echo $result['title']; ?> - <?php echo TITLE; ?></title>
   <?php } } }else { ?>
     <title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>
  <?php } ?>
  <meta name="language" content="English">
	<meta name="description" content="It is a website about Animal">
  <?php
  if (isset($_GET['postid'])) {
    $postid = mysqli_real_escape_string($db->link, $_GET['postid']);
    $sql = "SELECT * FROM tbl_post WHERE id = '$postid' ";
    $post = $db->select($sql);
    if ($post) {
        while ($result = $post->fetch_assoc()) { ?>
  <meta name="keywords" content="<?php echo $result['tags']; ?>">
    <?php } } }else { ?>
      <meta name="keywords" content="<?php echo KEYWORDS; ?>">
   <?php } ?>