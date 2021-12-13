<?php require 'inc/header.php';?>

<?php
    $category = mysqli_real_escape_string($db->link, $_GET['category']);
    if (!isset($category) || $category == NULL) {
        echo "<script> window.location = '404.php' ;</script>";
    }else {
        $category = $category;
    }
?>
  <!--======================= Main Section Start =======================  -->
  <section class="main_section">
    <div class="mainsection_bfr_container">
      <div class="container">
        <div class="main_section_aftr_row clearfix">
          <div class="row">
            <div class="col-md-8 left_main_Content col-sm-12">
            <!-- Pagination -->
              <?php
                $per_page = 3;
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = 1;
                }
                $start_form = ($page - 1) * $per_page;
                ?>
		    <!-- Pagination -->
            <?php
            $query = "SELECT * FROM tbl_post WHERE cat = '$category' LIMIT $start_form,$per_page";
            $categories = $db->select($query);
            if ($categories) {
                while ($result = $categories->fetch_assoc()) { ?>
              <div class="my_card my_card_post clearfix">
                <a href="post.php?postid=<?php echo $result['id']; ?>"><h2><?php echo $result["title"]; ?></h2></a>
                <h5><?php echo $fm->date($result['date']); ?></h5>
                <div class="fakeimg height_img">
                  <a href="post.php?postid=<?php echo $result['id']; ?>"><img src="admin/uploads/<?php echo $result["image"]; ?>" alt=""></a>
                </div>
                <h6 class="remove_cls">Author: <a href=""><?php echo $result["author"]; ?></a></h6>
                <?php echo $fm->textShorten($result["body"], 270); ?><a href="post.php?postid=<?php echo $result['id']; ?>" class="read_more">Read More <i class="fa fa-angle-double-right"></i></a>
              </div>
            <?php } }else{ ?>
                <div class="my_card">
                    <h2 class="mt-1">No Post Available in this Category</h2>
                </div>
              <?php } ?>

                <?php
                $row_query = "SELECT * FROM tbl_post WHERE cat = '$category' ";
                $row_categories = $db->select($row_query);
                if ($row_categories == true) { ?>
              <!-- Pagination -->
              <div class="my_card my_card_post clearfix">
                <div class="pagination">
                <?php
                $pagination_query = "SELECT * FROM tbl_post WHERE cat = '$category' ";
                $pagination_result = $db->select($pagination_query);
                $total_rows = mysqli_num_rows($pagination_result);
                $total_pages = ceil($total_rows / $per_page);

                echo "<a href='posts.php?category=$category'>First Page</a>";

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='posts.php?category=$category&page=$i'>" . $i . "</a>";
                }
                echo "<a href='posts.php?category=$category&page=$total_pages'>Last Page</a>";
                ?>
                </div>
              </div>
              <?php } ?>
              <!-- Pagination -->
            </div>
            <?php require 'inc/sidebar.php'?>
          </div>
        </div>
      </div>
    </div>


  </section>
  <!--======================= Main Section End========================  -->
<?php require 'inc/footer.php'?>
  <!--======================= Header Script Start========================  -->
  <script>
    /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>

  <script>
    /* Open when someone clicks on the span element */
    function openNav() {
      document.getElementById("myNav").style.width = "100%";
    }

    /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
  </script>

  <!--======================= Header Script Start========================  -->

  <!--===================== Hero Section Script Start====================  -->
  <script>
    var slideIndex = 1;
    showSlides_one(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      showSlides_one(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
      showSlides_one(slideIndex = n);
    }

    function showSlides_one(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      if (n > slides.length) { slideIndex = 1 }
      if (n < 1) { slideIndex = slides.length }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }

    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) { slideIndex = 1 }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      setTimeout(showSlides, 5000); // Change image every 2 seconds
    }


  </script>
  <!--===================== Hero Section Script End======================  -->

  <!--=================== Sticy Header ====================  -->
  <script>
    window.onscroll = function () { myFunction() };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  </script>
  <!--=================== Sticy Header ====================  -->

  <!--=================== Scroll To Top ====================  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/scrolltop.js"></script>
  <!--=================== Scroll To Top====================  -->


</body>

</html>