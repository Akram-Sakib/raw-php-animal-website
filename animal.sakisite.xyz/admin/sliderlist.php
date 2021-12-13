<?php require "inc/header.php"; ?>
            <!-- begin app-container -->
            <div class="app-container">
                <!-- begin app-nabar -->
                <?php require "inc/sidebar.php"; ?>
                <!-- begin app-main -->
                <div class="app-main" id="main">
                    <!-- begin container-fluid -->
                    <div class="container-fluid">
                        <!-- begin row -->
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <!-- begin page title -->
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Image Slider</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="index.php"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="index.php">Slider Option</a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page"><a href="sliderlist.php">Slider List</a></li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <!-- end page title -->
                            </div>
                        </div>
                        <!-- end row -->


                        <!--start gallery -->
                        <div class="row magnific-wrapper">
                        <?php 
                        $sql = "SELECT * FROM tbl_slider ORDER BY id DESC";
                        $slider = $db->select($sql);
                        if ($slider) {
                            while ($result = $slider->fetch_assoc()) { ?>
                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <div class="card card-statistics text-center">
                                    <div class="card-body p-0">
                                        <div class="portfolio-item">
                                            <img src="uploads/<?php echo $result['slider']; ?>" width="245px" height="165px" alt="gallery-img">
                                            <div class="portfolio-overlay">
                                                <h4 class="text-white"><a href="editslider.php?sliderid=<?php echo $result["id"]; ?>"><?php echo $result["title"]; ?></a></h4>
                                            </div>
                                            <a class="popup portfolio-img view" href="uploads/<?php echo $result['slider']; ?>"><i class="fa fa-arrows-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>

                        </div>
                        <!--end gallery-->
                    </div>
                    <!-- end container-fluid -->
                </div>
                <!-- end app-main -->
            </div>
            <!-- end app-container -->
            <!-- begin footer -->
            <footer class="footer">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-left">
                        <p>&copy; Copyright 2019. All rights reserved.</p>
                    </div>
                    <div class="col  col-sm-6 ml-sm-auto text-center text-sm-right">
                        <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                    </div>
                </div>
            </footer>
            <!-- end footer -->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->

    <!-- plugins -->
    <script src="assets/js/vendors.js"></script>

    <!-- custom app -->
    <script src="assets/js/app.js"></script>
</body>


</html>