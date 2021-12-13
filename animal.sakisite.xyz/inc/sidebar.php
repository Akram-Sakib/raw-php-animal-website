<div class="col-md-4 right_sidebar col-sm-12">
  <?php
  if ($get_url_base != "post.php") {?>
              <div class="my_card author_details">
                <h2>ABOUT THE AUTHOR</h2>
                <?php
                $sql = "SELECT * FROM tbl_author_details WHERE id = '1' ";
                $author_details = $db->select($sql);
                if ($author_details) {
                    $result = $author_details->fetch_assoc();
                        ?>
                <div class="fakeimg">
                  <img src="admin/uploads/<?php echo $result['image']; ?>" alt="">
                </div>
                <?php echo $result['description']; ?>
              </div>
              <div class="my_card following_social">
                <h3>Follow Me</h3>
                <a target="_blank" href="<?php echo $result['fb']; ?>" class="fa fa-facebook my_social"></a>
                <a target="_blank" href="<?php echo $result['tw']; ?>" class="fa fa-twitter my_social"></a>
                <a target="_blank" href="<?php echo $result['ln']; ?>" class="fa fa-linkedin my_social"></a>
                <a target="_blank" href="<?php echo $result['yt']; ?>" class="fa fa-youtube my_social"></a>
                <a target="_blank" href="<?php echo $result['ig']; ?>" class="fa fa-instagram my_social"></a>
                <a target="_blank" href="<?php echo $result['pn']; ?>" class="fa fa-pinterest my_social"></a>
              </div>
              <?php } ?>
              <?php } ?>
              <div class="my_card category_list">
                <h3>Categories</h3>
                <?php
                $query = "SELECT * FROM tbl_category";
                $categories = $db->select($query);
                if ($categories) {
                  while ($result = $categories->fetch_assoc()) { ?>
                <ul>
                  <li><a href="posts.php?category=<?php echo $result["id"]; ?>"><?php echo $result["name"] ?></a></li>
                </ul>
                <?php } } ?>
              </div>
              <div class="my_card advertise">
                <div class="text-center">-advertisement-</div>
                <img src="images/img_woods_wide.jpg" alt="">
              </div>
              <div class="my_card">
                <h3>Popular Post</h3>
                <?php 
                $query = "SELECT * FROM tbl_post WHERE date > DATE_SUB(curdate(), INTERVAL 1 WEEK) ORDER BY count DESC LIMIT 4";
                $popular_post = $db->select($query);
                if ($popular_post) {
                  while ($result = $popular_post->fetch_array()) { ?>
                <div class="same_post clearfix">
                  <div class="left_post_img">
                    <a href="post.php?postid=<?php echo $result["id"]; ?>"><img src="admin/uploads/<?php echo $result["image"]; ?>" alt=""></a>
                  </div>
                  <div class="right_content">
                    <a href="post.php?postid=<?php echo $result["id"]; ?>"><h4><?php echo $result["title"]; ?></h4></a>
                    <p><?php echo $fm->date($result["date"]); ?></p>
                  </div>
                </div>
              <?php } } ?>

              </div>
            </div>