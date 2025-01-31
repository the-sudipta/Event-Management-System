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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Signup - Event Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Apply a gradient background for a modern look */
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Signup container with a glassmorphism effect */
        .signup-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 360px;
            text-align: center;
            color: white;
            position: relative;
        }

        /* Title with gradient text for better visual appeal */
        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Input field container */
        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        /* Input fields with adjusted width for better layout */
        .input-group input {
            width: 80%; /* Reduced width to prevent overlapping with icons */
            padding: 12px 40px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 30px;
            color: white;
            outline: none;
            transition: 0.3s ease-in-out;
        }

        /* Placeholder styling for better visibility */
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Icons positioned inside the input fields */
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
        }

        /* Input focus effect for better user interaction */
        .input-group input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Signup button with a hover effect for better engagement */
        .signup-btn {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
            width: 85%; /* Reduced width for better aesthetics */
            text-transform: uppercase;
        }

        .signup-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 77, 77, 0.6);
        }

        /* Login link styling */
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #ff416c;
            text-decoration: none;
            font-weight: bold;
        }

        <!DOCTYPE html>
        <html lang="en">

        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Driver Signup - Event Management System</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <style>
             /* Apply a gradient background for a modern look */
         body {
             background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
             display: flex;
             justify-content: center;
             align-items: center;
             height: 100vh;
             margin: 0;
             font-family: 'Poppins', sans-serif;
         }

        /* Signup container with a glassmorphism effect */
        .signup-container {
            background: rgba(255, 255, 255, 0.15);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 360px;
            text-align: center;
            color: white;
            position: relative;
        }

        /* Title with gradient text for better visual appeal */
        .signup-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Input field container */
        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        /* Input fields with adjusted width for better layout */
        .input-group input {
            width: 80%; /* Reduced width to prevent overlapping with icons */
            padding: 12px 40px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 30px;
            color: white;
            outline: none;
            transition: 0.3s ease-in-out;
        }

        /* Placeholder styling for better visibility */
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Icons positioned inside the input fields */
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
        }

        /* Input focus effect for better user interaction */
        .input-group input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Signup button with a hover effect for better engagement */
        .signup-btn {
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
            width: 85%; /* Reduced width for better aesthetics */
            text-transform: uppercase;
        }

        .signup-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255, 77, 77, 0.6);
        }

        /* Login link styling */
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #ff416c;
            text-decoration: none;
            font-weight: bold;
        }

        /* Validation Messages */
        /* General Alert Box */
        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 350px;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            display: none;
            font-family: 'Poppins', sans-serif;
            animation: fadeInSlide 0.5s ease-in-out;
        }

        /* Fade-In & Slide Animation */
        @keyframes fadeInSlide {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* User Input Error - Red & Bold */
        #validationModal {
            background: rgba(255, 208, 0, 0.2);
            color: white;
            border-left: 5px solid #ffcc00;
            backdrop-filter: blur(8px);
        }

        /* Backend Error - Yellow & Warn-Like */
        #backendValidationModal {
            background: rgba(255, 0, 0, 0.2);
            color: white;
            border-left: 5px solid #ff4b2b;
            backdrop-filter: blur(8px);
        }

        /* Close Button */
        .alert span {
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            position: absolute;
            top: 5px;
            right: 10px;
            transition: transform 0.3s ease;
        }

        .alert span:hover {
            transform: scale(1.2);
        }

        /* Alert Text */
        .alert p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
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
<div id="validationModal" class="alert">
    <span onclick="close_modal();">&times;</span>
    <p id="validationMessage"></p>
</div>

<!-- Backend Validation Modal -->
<div id="backendValidationModal" class="alert">
    <span onclick="close_backend_modal();">&times;</span>
    <p id="backendValidationMessage"><?php echo $error_message; ?></p>
</div>


<div class="signup-container">
    <h2>Driver Signup</h2>
    <form action="<?php echo $driver_signupController_file; ?>" method="post" id="signup_form" onsubmit="return validateForm();">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="name" id="name" placeholder="Full Name" >
        </div>
        <div class="input-group">
            <i class="fas fa-car"></i>
            <input type="text" name="car_name" id="car_name" placeholder="Car Name / Model" >
        </div>
        <div class="input-group">
            <i class="fas fa-info-circle"></i>
            <input type="text" name="car_details" id="car_details" placeholder="Car Details (e.g., Registration)">
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <button class="signup-btn">Signup</button>
    </form>
    <p class="login-link">Already have an account? <a href="<?php echo $driver_login; ?>">Login</a></p>
</div>
</body>

</html>

