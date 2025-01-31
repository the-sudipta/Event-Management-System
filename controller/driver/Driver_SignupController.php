<?php

//include_once '../Navigation_Links.php';
global $routes;
require '../../routes.php';


require_once __DIR__ . '/../../model/UserRepo.php';
require_once __DIR__ . '/../../model/DriverRepo.php';


@session_start();


$Login_page = $routes['login'];
$Driver_Signup_page = $routes['driver_signup'];
$errorMessage = "";



//echo $_SERVER['REQUEST_METHOD'];
$everythingOKCounter = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "Got Req";

    //* Name Validation
    $name = $_POST['name'];
    if (empty($name) || strlen($name) >= 50) {
        // check if Name size in 50 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Name error : Name has more than 50 Characters or It is empty<br>';
        $errorMessage = urlencode("Name has more than 50 Characters or It is empty.");
    } else {
        $everythingOK = TRUE;
    }

    //* Car Name Validation
    $car_name = $_POST['car_name'];
    if (empty($car_name) || strlen($car_name) >= 50) {
        // check if Name size in 50 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Car Name error : Car Name has more than 50 Characters or It is empty<br>';
        $errorMessage = urldecode("Car Name has more than 50 Characters or It is empty");
    } else {
        $everythingOK = TRUE;
    }

    //* Car Details Validation
    $car_details = $_POST['car_details'];
    if (empty($car_details) || strlen($car_details) >= 120) {
        // check if Name size in 50 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Car Details error : Car Details has more than 120 Characters or It is empty<br>';
        $errorMessage = urldecode("Car Details has more than 120 Characters or It is empty");
    } else {
        $everythingOK = TRUE;
    }

    //* Email Validation
    $email = $_POST['email'];
    if (empty($email)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;

        echo '<br>Email Error : Email is Empty<br>';
        $errorMessage = urldecode("Email has more than 120 Characters or It is empty");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Email Error : Email does not have `@`<br>';
        $errorMessage = urldecode("Email does not have `@`");
    } else {
        $everythingOK = TRUE;
    }

    //* Password Validation
    $password = $_POST['password'];
    if (empty($password) || strlen($password) < 8) {
        // check if password size in 8 or more and  check if it is empty

        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Password Error : Password has less than 8 Characters or It is empty<br>';
        $errorMessage = urldecode("Password has less than 8 Characters or It is empty");
    } else {
        $everythingOK = TRUE;
    }

    $saved_user = findUserByEmail($email);
    if($saved_user != NULL){
        $everythingOK = FALSE;
        $everythingOKCounter += 1;
        echo '<br>Email error : Email already exists<br>';
        $errorMessage = urldecode("Email already exists.");
    }

    if ($everythingOK && $everythingOKCounter === 0) {

//        echo '<br><br>';
        echo '<br>Everything is ok<br>';

        $user_id = createUser($email, $password, "Driver");

        if($user_id > 0) {
            $driver_id = createDriver($name, $car_name, $car_details, $user_id);
        }else{
            echo '<br>Returning to Signup page Can not Create User through the email : '.$email.'and password : '.$password.'<br>';
        }

        echo '<br>User ID found = '.$user_id.' <br>';
        echo '<br>Driver ID found = '.$driver_id.' <br>';
        if (isset($driver_id)) {
                header("Location: {$Login_page}");
                exit;
        } else {
            echo '<br>Returning to Signup page because the Driver information could not be stored in `driver` table <br>';
            header("Location: {$Driver_Signup_page}?message=$errorMessage");
            exit;
        }

    }else {
        echo '<br>Returning to Signup page because The data user provided is not properly validated like 
                in password: 1-upper_case, 1-lower_case, 1-number, 1-special_character and at least 8 character long it must be provided <br>';
    header("Location: {$Driver_Signup_page}?message=$errorMessage");
        exit;
    }






}


