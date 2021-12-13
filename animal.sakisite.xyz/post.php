<?php require 'inc/header.php'; ?>

<?php
    $postid = mysqli_real_escape_string($db->link, $_GET['postid']);
    if (!isset($postid) || $postid == NULL) {
        header("Location: 404.php");
    }else {
        $postid = $postid;
    }
?>
<!-- Count Post -->
<?php 
$query =  " UPDATE tbl_post SET count = count + 1, date = NOW() WHERE id = '$postid' " ;
$count_user = $db->update($query);
?>
<!-- Count Post -->
<!--======================= Main Section Start========================  -->
    <section class="main_section">
        <div class="mainsection_bfr_container">
            <div class="container">
                <div class="main_section_aftr_row clearfix">
                    <div class="row">
                        <div class="col-md-8 left_main_Content col-sm-12">
                        <?php
                        $query = "SELECT * FROM tbl_post WHERE id = '$postid' ";
                        $post = $db->select($query);
                        if ($post) {
                            while ($result = $post->fetch_assoc()) { ?>
                            <div class="my_card my_card_post post_justify clearfix">
                                <h2 class="h2_custom" ><?php echo $result["title"]; ?></h2>
                                <h5><?php echo $fm->date($result['date']); ?></h5>
                                <div class="fakeimg">
                                    <img src="admin/uploads/<?php echo $result["image"]; ?>" alt="">
                                </div>
                                <?php echo $result["body"]; ?>
                                <h6 class="remove_cls">Author: <a href=""><?php echo $result["author"]; ?></a></h6>
                            </div>
                            <div class="my_card post_card clearfix">
                                <h2>Related Post</h2>
                                <div class="row">
                                <?php
                                $cat = $result['cat'];
                                $relquery = "SELECT * FROM tbl_post WHERE cat = '$cat' ";
                                $relpost = $db->select($relquery);
                                if ($relpost) {
                                    while ($r_Result = $relpost->fetch_assoc()) { ?>
                                    <div class="col-md-4">
                                        <a href="post.php?postid=<?php echo $r_Result["id"]; ?>"><img src="admin/uploads/<?php echo $r_Result["image"]; ?>" alt=""></a>
                                    </div>
                                    <?php } }else { ?>
                                    <h2>No Related Post Here.!</h2>
                                    <?php } ?>

                                    <?php } }else {
                                        header("Location: 404.php");
                                    } ?>
                                </div>

                            </div>

                        </div>
<?php require 'inc/sidebar.php'; ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--======================= Main Section End========================  -->
<?php require 'inc/footer.php' ?>
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