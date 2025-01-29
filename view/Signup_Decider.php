<?php

//include_once '../Navigation_Links.php';
global $routes, $image_routes;
require '../routes.php';

session_start();
$seller_signup = $routes['seller_signup'];
//$admin_signup = doctor_signup_page();

$login_page = $routes['login'];

//$admin_image =  $image_routes['admin_image'];
$seller_image = $image_routes['seller_image'];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car - Dealers -> User Type</title>
    <!--    Styles that we need for every page-->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/signup_decider.css">

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the elements by their IDs
            var adminDiv = document.getElementById('admin_div');
            var sellerDiv = document.getElementById('seller_div');

            // Add click event listeners
            //adminDiv.addEventListener('click', function () {                // Redirect to the doctor signup page
            //    window.location.href = "<?php //echo $admin_signup; ?>//";
            //});

        sellerDiv.addEventListener('click', function () {
                // Redirect to the patient signup page
                window.location.href = "<?php echo $seller_signup; ?>";
            });
        });
    </script>




</head>
<body>

<div class="container">

    <!-- Card deck -->
    <div class="card-deck row">

<!--        <div  id="admin_div" class="col-xs-12 col-sm-6 col-md-4" style="cursor: pointer">-->

<!--            <div class="card">-->
<!---->

<!--                <div class="view overlay">-->
<!--                    <img class="card-img-top" src="--><?php //echo $doc_image;?><!--" alt="DOCTOR">-->
<!--                    <a href="">-->
<!--                        <div class="mask rgba-white-slight"></div>-->
<!--                    </a>-->
<!--                </div>-->
<!---->

<!--                <div class="card-body">-->
<!---->

<!--                    <h4 class="card-title">Admin</h4>-->




<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->

        <div id="seller_div" class="col-xs-12 col-sm-6 col-md-4" style="cursor: pointer">
            <!-- Card -->
            <div class="card">

                <!--Card image-->
                <div class="view overlay">
                    <img class="card-img-top" src="<?php echo $seller_image; ?>" alt="PATIENT">
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!--Card content-->
                <div class="card-body">

                    <!--Title-->
                    <h4 class="card-title">Seller</h4>
                    <!--Text-->
<!--                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<!--                    <button type="button" class="btn btn-light-blue btn-md">Read more</button>-->

                </div>

            </div>
            <!-- Card -->
        </div>


    </div>
    <!-- Card deck -->

</div>

</body>
</html>
