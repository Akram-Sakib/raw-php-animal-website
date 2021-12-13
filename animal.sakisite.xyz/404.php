<?php require 'inc/header.php'; ?>
    <!--======================= Main Section Start========================  -->

                <section class="page_404">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="col-sm-10 col-sm-offset-1  text-center custom_width_404">
                                    <div class="four_zero_four_bg">
                                        <h1 class="text-center ">404</h1>
                
                
                                    </div>
                
                                    <div class="contant_box_404">
                                        <h3 class="h2">
                                            Look like you're lost
                                        </h3>
                
                                        <p>the page you are looking for not avaible!</p>
                
                                        <a href="index.php" class="link_404">Go to Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

    <!--======================= Main Section End========================  -->

<?php require 'inc/footer.php'; ?>

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