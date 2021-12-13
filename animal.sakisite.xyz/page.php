<?php require 'inc/header.php';?>

<?php
$pageid = mysqli_real_escape_string($db->link, $_GET['pageid']);
if (!isset($pageid) || $pageid == null) {
    echo "<script>window.location = '404.php'; </script>";
} else {
    $pageid = $pageid;
}
?>

<!--======================= Main Section Start========================  -->
    <section class="main_section">
        <div class="mainsection_bfr_container">
            <div class="container">
                <div class="main_section_aftr_row clearfix">
                    <div class="row">
                        <div class="col-md-8 left_main_Content col-sm-12">
                        <?php
                            $query = "SELECT * FROM tbl_page WHERE id = '$pageid' ";
                            $page = $db->select($query);
                            if ($page) {
                            while ($result = $page->fetch_assoc()) {?>
                            <div class="my_card my_card_post post_justify clearfix">
                                <h2 class="h2_custom"><?php echo $result["title"]; ?></h2>
                                <?php echo $result["body"]; ?>
                            </div>
                            <?php } } ?>
                        </div>
<?php require 'inc/sidebar.php';?>
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