<?php

global $routes, $backend_routes, $image_routes;
require '../../routes.php';


$error_message = "";
$show_backend_error_modal = false;
$driver_signupController_file = $backend_routes['driver_signup_controller'];
$driver_login = $routes['login'];

// Message from Backend
if (isset($_GET['message'])) {
    $error_message = htmlspecialchars($_GET['message']);
    $show_backend_error_modal = true;
}



?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Event Management System - Driver Signup</title>

    <link href="../js/driver/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../js/driver/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="../js/driver/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../js/driver/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="../css/driver_signup.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../css/error_css.css" media="all">

    <script>

        // Function to validate email format
        function validateEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Function to show modal with validation message
        function showModal(message) {
            document.getElementById("validationMessage").innerHTML = message;
            document.getElementById("validationModal").style.display = "block";
        }

        close_modal = () => {
            document.getElementById("validationModal").style.display = "none";
            // location.reload(true);
        }

        // Show the backend modal if there is an error message
        window.onload = function () {
            var errorMessage = "<?php echo addslashes($error_message); ?>";
            if (errorMessage.trim() !== "") {
                document.getElementById('backendValidationModal').style.display = 'block';
            }
        };

        close_backend_modal = () => {
            document.getElementById("backendValidationModal").style.display = "none";
            // location.reload(true);
        }



        function validateForm() {
            var name = document.getElementById("name").value;
            var car_name = document.getElementById("car_name").value;
            var car_details = document.getElementById("car_details").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (name === "" || name === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Name is Required");
                return false;
            }

            if (car_name === "" || car_name === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Car Name / Model is Required");
                return false;
            }

            if (car_details === "" || car_details === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Car Details is Required");
                return false;
            }

            if (email === "" || email === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Email is Required");
                return false;
            }

            if (password === "" || password === null) {
                // Display error message
                showModal("Password is Required");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("signup_form").onsubmit = function () {
            return validateForm();
        };

    </script>
</head>



<body>

<!-- Validation Modal -->
<div id="validationModal" style="display: none; position: fixed; top: 0; right: 0; width: 40%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <span id="close_button" aria-hidden="true" onclick="close_modal();">&times;</span>
    <div style="position: absolute; top: 0; right: 0;">
        <p style="cursor: pointer; font-size: 30px;" class="close" data-dismiss="alert" aria-label="Close" >
        </p>
    </div>
    <p id="validationMessage"></p>
</div>

<!-- Validation Modal for Backend -->
<div id="backendValidationModal" style="display: none; position: fixed; top: 20px; right: 20px; width: 40%; padding: 15px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0,0,0,0.2);">
    <span id="backend_close_button" style="cursor: pointer; font-size: 25px; position: absolute; top: 5px; right: 10px;" onclick="close_backend_modal();">&times;</span>
    <p id="backendValidationMessage">Backend Says => <?php echo $error_message; ?></p>
</div>



<div class="page-wrapper p-t-180 p-b-100 font-robo" style="background-color: #039be5">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Registration Info</h2>
                <form action="<?php echo $driver_signupController_file; ?>" method="post" id="signup_form" onsubmit="return validateForm();">
                    <div class="input-group">
                        <input class="input--style-2" type="text" placeholder="Name" name="name" id="name">
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="text" placeholder="Car Name or Model" name="car_name" id="car_name">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="input-group">
                                <textarea class="input--style-2" placeholder="Car Details (e.g. Registration Number)" name="car_details" id="car_details"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="input--style-2" type="email" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                            <div class="input-group">
                                <input class="input--style-2" type="password" placeholder="Password" name="password" id="password">
                            </div>
                        </div>
                    </div>
                    <div class="p-t-30">
                        <button class="btn btn--radius btn--green" >Signup</button>
                    </div>
                    <div class="text-center fs-6 mt-5">
                        <br>
                        <b>Already have an account?</b> <a href="<?php echo $driver_login; ?>" style="text-decoration: none;outline: none;color: #039be5"><b>Login</b></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="../js/driver/vendor/jquery/jquery.min.js"></script>

<script src="../js/driver/vendor/select2/select2.min.js"></script>
<script src="../js/driver/vendor/datepicker/moment.min.js"></script>
<script src="../js/driver/vendor/datepicker/daterangepicker.js"></script>


<script src="../js/driver/driver_signup.js"></script>

</body>

</html>
