<?php require 'inc/header.php'; ?>
<!--======================= Main Section Start========================  -->
<section class="main_section about_section">
    <div class="mainsection_bfr_container">
        <div class="container">
            
            

            <div class="about-section-top">
                <h1>About Us Page</h1>
                <p>Some text about who we are and what we do.</p>
                <p>Resize the browser window to see that this page is responsive by the way.</p>
            </div>
            
            <div class="our_team">

            <h2 class="team_heading" style="text-align:center">Our Team</h2>
            <div class="row team_head_clr">
            <?php
                $sql = "SELECT * FROM tbl_team ORDER BY id DESC";
                $team = $db->select($sql);
                if ($team) {
                    while ($result = $team->fetch_assoc()) {
                        ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="admin/uploads/<?php echo $result['image']; ?>" alt="Jane" style="width:100%; height: 225px;">
                        <div class="container">
                            <h2><?php echo $result['name']; ?></h2>
                            <p class="title"><?php echo $result['subtitle']; ?></p>
                            <p><?php echo $result['body']; ?></p>
                            <p><?php echo $result['email']; ?></p>
                            <p><a target="_blank" href="<?php echo $result['contact']; ?>" class="button">Contact</a></p>
                        </div>
                    </div>
                </div>
            <?php } } ?>

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


    <!--=================== Scroll to top Script Start ====================  -->
    <!--=================== Scroll To Top ====================  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scrolltop.js"></script>
    <!--=================== Scroll To Top====================  -->
    <!--=================== Scroll to top Script End ====================  -->

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



</body>

</html>