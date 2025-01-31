<?php

global $routes, $backend_routes, $image_routes;
require '../routes.php';


$error_message = "";
$loginController_file = $backend_routes['login_controller'];
$driver_signup = $routes['driver_signup'];
$logo = $image_routes['user_icon'];

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Management System -> Login</title>
    <link rel="stylesheet" href="css/login_css.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="css/error_css.css" media="all">


    <style>

        body {
            /*transform: scale(0.71); !* Scale the entire body *!*/
            transform-origin: top center; /* Set the scaling origin to the top center */
        }

        @media (max-width: 1600px) {
            body {
                transform: scale(0.85);
            }
        }

        @media (max-width: 1400px) {
            body {
                transform: scale(0.8);
            }
        }

        @media (max-width: 1200px) {
            body {
                transform: scale(0.75);
            }
        }

        @media (max-width: 1000px) {
            body {
                transform: scale(0.71);
            }
        }

        @media (max-width: 800px) {
            body {
                transform: scale(0.65);
            }
        }

        @media (max-width: 600px) {
            body {
                transform: scale(0.6);
            }
        }

        @media (max-width: 400px) {
            body {
                transform: scale(0.55);
            }
        }

    </style>

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
            var email = document.getElementById("login_email").value;
            var password = document.getElementById("login_password").value;
            // var emailErrorLabel = document.getElementById("loginEmailError");

            // Reset previous error messages
            // emailErrorLabel.innerHTML = "";

            // Validate email
            if (email === "" || email === null) {
                // emailErrorLabel.innerHTML = "Email is required.";
                showModal("Email is Required");
                return false;
            }
            // You can add more email validation logic here if needed

            // Validate password

            if (password === "" || password === null) {
                // Display error message
                showModal("Password is Required");
                return false;
            }

            return true; // Return true if all validations pass
        }

        // Attach the validation function to the form's onsubmit event
        document.getElementById("login_form").onsubmit = function () {
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




<div class="wrapper">
    <div class="logo">
        <img src="<?php echo $logo;?>" alt="">
    </div>
    <div class="text-center mt-4 name">
        Login
    </div>
    <form action="<?php echo $loginController_file; ?>" method="post" id="login_form" onsubmit="return validateForm();">
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="email" id="login_email" placeholder="Email">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="login_password" placeholder="Password">
        </div>
        <button class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6">
        Don't Have an account? <a href="<?php echo $driver_signup; ?>">Register</a>
    </div>
</div>




<script src="js/index.js"></script>
</body>
</html>