<?php require "config/config.php"; ?>
<?php require "lib/Database.php"; ?>
<?php require "lib/format.php"; ?>

<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require "script/meta.php"; ?>
  <?php require "script/css.php"; ?>
  <?php require "script/js.php"; ?>
</head>

<body>
  <!--======================= Header Code Start========================  -->
  <header>
    <div class="equal_margin">
      <div class="container topnav_container">
        <div class="top_bar">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 clearfix">
            <?php
              $sql = "SELECT * FROM tbl_logotitle WHERE id = '1' ";
              $logotitle = $db->select($sql);
              if ($logotitle) {
              $result = $logotitle->fetch_array();
              ?>
              <div class="left_logo">
                <img src="admin/uploads/<?php echo $result["logo"]; ?>" alt="Logo">
              </div>
              <div class="right_text">
                <h2><?php echo $result["title"]; ?></h2>
                <p><?php echo $result["subtitle"]; ?></p>
              </div>
            </div>
            <?php } ?>
            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
              <div class="search">
                <form class="example" action="search.php" method="GET">
                  <input type="text" required placeholder="Search.." name="search">
                  <button type="submit" name="submit" value="Submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="nav_bg_color" id="myHeader">
      <nav class="bottomnav container clearfix max_width_nav">
        <!-- Top Navigation Menu -->
        <div class="topnav" id="myTopnav">
          <span><a href="index.php" <?php $path  = $_SERVER['SCRIPT_FILENAME']; $title = basename($path, ".php"); if ($title == 'index') { ?> class="active" <?php } ?> >Home</a></span>
          <span class="display_hide"><a href="blog.php" <?php $path  = $_SERVER['SCRIPT_FILENAME']; $title = basename($path, ".php"); if ($title == 'blog') { ?> class="active" <?php } ?> >Blog</a></span>
         <div class="dropdownHover"> 
          <span class="for_dropdown 
          <?php 
          if ($get_url_base == "contact.php") {?>
           contact_dropdown <?php } ?>"><a href="" <?php	if (isset($_GET['category'])) { ?>	class="active" <?php } ?> >Categories <i class="fa fa-caret-down"></i></a>
          <ul>
          <?php
              $query = "SELECT * FROM tbl_category";
              $categories = $db->select($query);
              if ($categories) {
                while ($result = $categories->fetch_assoc()) { ?>
            <li><a href="posts.php?category=<?php echo $result["id"]; ?>"><?php echo $result["name"] ?></a></li>
            <?php } } ?>
          </ul>
        </span>
          </div>
          <?php 
          $sql = "SELECT * FROM tbl_page ";
          $page = $db->select($sql);
          if ($page) {
              while ($result = $page->fetch_assoc()) { ?>
          </span><a href="page.php?pageid=<?php echo $result['id']; ?>" <?php	if (isset($_GET['pageid']) && $_GET['pageid'] == $result['id']) { ?>	class="active" <?php } ?>
           ><?php echo $result['title']; ?></a></span>
          <?php } } ?>
          </span><a href="about.php" <?php $path  = $_SERVER['SCRIPT_FILENAME']; $title = basename($path, ".php"); if ($title == 'about') { ?> class="active" <?php } ?> >About</a></span>
          </span><a href="contact.php" <?php $path  = $_SERVER['SCRIPT_FILENAME']; $title = basename($path, ".php"); if ($title == 'contact') { ?> class="active" <?php } ?> >Contact</a></span>
          <a href="javascript:void(0);" class="icon" onclick="openNav()">
            <i class="fa fa-bars"></i>
          </a>
        </div>
      </nav>
    </div>
  </header>
  <!-- The overlay -->
  <div id="myNav" class="overlay">

    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <!-- Overlay content -->
    <div class="overlay-content">
      <a href="index.php">Home</a>
      <span class="for_dropdown mobile_cat_dropdown"><a href="#">Categories <i class="fa fa-caret-down"></i></a>
        <ul>
        <?php
          $query = "SELECT * FROM tbl_category";
          $categories = $db->select($query);
          if ($categories) {
            while ($result = $categories->fetch_assoc()) { ?>
          <li><a href="posts.php?category=<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></a></li>
          <?php } } ?>
        </ul>
      </span>
      <a href="blog.php">Blog</a>
      <?php 
          $sql = "SELECT * FROM tbl_page ";
          $page = $db->select($sql);
          if ($page) {
              while ($result = $page->fetch_assoc()) { ?>
      <a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a>
      <?php } }?>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
    </div>

  </div>

  <!--======================= Header Code End========================  -->