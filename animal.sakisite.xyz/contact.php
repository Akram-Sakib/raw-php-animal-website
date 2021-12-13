<?php require 'inc/header.php'; ?>
    <!--================== Contact Main Section Start ===================  -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $fm->validation($_POST["firstname"]);
    $lname = $fm->validation($_POST["lastname"]);
    $email = $_POST["email"];
    $body  = $_POST["body"];

    $fname = mysqli_real_escape_string($db->link, $fname);
    $lname = mysqli_real_escape_string($db->link, $lname);
    $email = mysqli_real_escape_string($db->link, $email);
    $body  = mysqli_real_escape_string($db->link, $body);

    if ($fname == "" || $lname == "" || $email == "" || $body == "") {
        $error = "<div class='alert alert-danger'><Strong>Error ! </Strong>Field Must be not empty</div> ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "<div class='alert alert-danger'><Strong>Error ! </Strong>Invalid Email address.!</div> ";
    } else {
        $query = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$fname','$lname','$email','$body')";
        $inserted_row = $db->insert($query);
        if ($inserted_row) {
            $msg = "<div class='alert alert-success'><Strong>Success ! </Strong>Message Sent Successfully.</div> ";
        } else {
            $error = "<div class='alert alert-danger'><Strong>Error ! </Strong>Message not Sent.</div> ";
        }
    }
}
?>
        <div class="bg-contact100" style="background-image: url('images/bg-01.jpg');">
            <div class="container-contact100">
                <div class="wrap-contact100">
                    <div class="contact100-pic js-tilt" data-tilt>
                        <img src="images/mail.png" alt="IMG">
                    </div>
        
                    <form class="contact100-form validate-form" method="POST" action="">
                        <span class="contact100-form-title">
                            Get in touch
                        </span>
                        <?php
                        if (isset($error)) {
                            echo $error;
                        }
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input class="input100" type="text" name="firstname" placeholder="First Name">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input class="input100" type="text" name="lastname" placeholder="Last name">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
        
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
        
                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <textarea class="input100" name="body" placeholder="Message"></textarea>
                            <span class="focus-input100"></span>
                        </div>
        
                        <div class="container-contact100-form-btn">
                            <input class="contact100-form-btn" type="submit" name="submit" value="Send" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--=================== Contact Main Section End ====================  -->

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

    <!--===================== Header Script Start ======================  -->

    <!--=================== Scroll To Top ====================  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/scrolltop.js"></script>
    <!--=================== Scroll To Top====================  -->

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


    <!--=================== Contact Form ====================  -->

<!--===============================================================================================-->
<script src="js/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="js/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/tilt.jquery.min.js"></script>
<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

<!-- Reload Submit Confirmation -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    <!--=================== Contact Form ====================  -->

</body>

</html>