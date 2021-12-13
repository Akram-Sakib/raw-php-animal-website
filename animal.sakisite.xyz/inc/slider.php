  <!--======================= Hero Section Start========================  -->
  <!-- Slideshow container -->
  <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
<?php
$sql = "SELECT * FROM tbl_slider ORDER BY id DESC LIMIT 5 ";
$slider = $db->select($sql);
$row_count = mysqli_num_rows($slider);

if ($slider) {
  $i = 0;
    while ($result = $slider->fetch_assoc()) {
      $i++;
        ?>
    <div class="mySlides">
      <div class="numbertext"><?php echo $i; ?> / <?php echo $row_count; ?></div>
      <img src="admin/uploads/<?php echo $result['slider']; ?>" style="width:100%; height: 600px;">
      <div class="text"><?php echo $result['title']; ?></div>
    </div>
<?php } } ?>
    <!-- The dots/circles -->

    <div class="text-center pos_top">
  <?php
$sql = "SELECT * FROM tbl_slider ORDER BY id DESC LIMIT 5 ";
$slider = $db->select($sql);
$row_count = mysqli_num_rows($slider);

if ($slider) {
  $x=0;
  while ( $x < $row_count) { 
    $x++;
      ?>
      <span class="dot" onclick="currentSlide(<?php echo $x; ?>)"></span>
      <?php } } ?>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>


  <!--======================= Hero Section End========================  -->