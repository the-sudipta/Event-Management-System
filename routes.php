<?php

// Define routes
$routes = [
    'INDEX' => '/Event-Management-System/index.php',
    '500_error' => '/Event-Management-System/500.php',
    'login' => '/Event-Management-System/view/Login.php',
    'driver_signup' => '/Event-Management-System/view/driver/Driver_Signup.php',
    'driver_dashboard' => '/Event-Management-System/view/driver/Driver_Dashboard.php',
    'token_request' => '/Event-Management-System/view/driver/Token_Request.php',
    'my_trips' => '/Event-Management-System/view/driver/My_Trips.php',
    'loader_1' => '/Event-Management-System/view/driver/Loader_1.php',


];

$backend_routes = [
    'login_controller' => '/Event-Management-System/controller/LoginController.php',
    'logout_controller' => '/Event-Management-System/controller/LogoutController.php',
    'driver_signup_controller' => '/Event-Management-System/controller/driver/Driver_SignupController.php',
    'driver_token_request_controller' => '/Event-Management-System/controller/driver/Token_RequestController.php',
];


$image_routes = [
    'user_icon' => '/Event-Management-System/view/static/image/user.png',
    'user_icon_background_less' => '/Event-Management-System/view/static/image/user_bg_less.png',
    'cab_driver' => '/Event-Management-System/view/static/image/cab_driver.png',
];

?>
