
  <!--==================== Footer Top Section Start =====================  -->

<section class="footer_top">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="magazine">
          <div class="megaZine_wrap clearfix">
            <?php
              $sql = "SELECT * FROM tbl_footer_top_column_1 ";
              $tbl_footer_top_column_1 = $db->select($sql);
              if ($tbl_footer_top_column_1) {
              while ($result = $tbl_footer_top_column_1->fetch_assoc()) {
                  ?>
            <h2><?php echo $result['title']; ?></h2>
          </div>
          <?php echo $result['body']; ?>
          <?php } } ?>
        </div>
      </div>
      <div class="col-md-4">
        <?php
              $sql = "SELECT * FROM tbl_footer_top_column_2 ";
              $tbl_footer_top_column_2 = $db->select($sql);
              if ($tbl_footer_top_column_2) {
              while ($result = $tbl_footer_top_column_2->fetch_assoc()) {
                  ?>
        <div class="footer_page">
        <h2><?php echo $result['title']; ?></h2>
        <h6><a href="<?php echo $result['home_link']; ?>"><?php echo $result['Home']; ?></a></h6>
        <h6><a href="<?php echo $result['about_link']; ?>"><?php echo $result['About']; ?></a></h6>
        <h6><a href="<?php echo $result['privacy_link']; ?>"><?php echo $result['Privacy Policy']; ?></a></h6>
        <h6><a href="<?php echo $result['contact_link']; ?>"><?php echo $result['Contact']; ?></a></h6>
        </div>
        <?php } } ?>
      </div>
      <div class="col-md-4">
        <?php
              $sql = "SELECT * FROM tbl_footer_top_column_3 ";
              $tbl_footer_top_column_3 = $db->select($sql);
              if ($tbl_footer_top_column_3) {
              while ($result = $tbl_footer_top_column_3->fetch_assoc()) {
                  ?>
        <div class="social_networks">
          <h2><?php echo $result['title']; ?></h2>
          <div class="inside_social">
            <a href="<?php echo $result['fb_link']; ?>"><span>Facebook</span></a>
            <a href="<?php echo $result['tw_link']; ?>"><span>Twitter</span></a>
            <a href="<?php echo $result['gp_link']; ?>"><span>Google+</span></a>
            <a href="<?php echo $result['ln_link']; ?>"><span>Linked In</span></a>
          </div>
        </div>
        <?php } } ?>
      </div>
    </div>
  </div>
</section>

  <!--==================== Footer Top Section End =======================  -->

  <!--==================== Footer Section Start =======================  -->
  <footer class="main_footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright_text text-center">
          <?php 
          $sql = "SELECT * FROM tbl_footer WHERE id = '1' ";
          $footer_update = $db->select($sql);
          if ($footer_update) {
              while ($result = $footer_update->fetch_assoc()) {
                  ?>
            <p><?php echo $result["copyright"]; ?></p>
            <?php } } ?>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--==================== Footer Section End =======================  -->