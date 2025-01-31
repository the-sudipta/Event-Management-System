<?php

global $routes;
require '../../routes.php';


require_once __DIR__ . '/../../model/TokenRepo.php';
require_once __DIR__ . '/../../model/CalculationRepo.php';

$Login_page = $routes['login'];
$Token_Request = $routes['token_request'];
$errorMessage = "";
$next_token = "";
$next_token_row = null;


@session_start();
$user_id = $_SESSION['user_id'];

$next_token_row = getNextToken($user_id); // It will calculate the next token and put that next token id into $_SESSION["active_token_id"] so that we can change the token status to "Active" now.
$next_token = $next_token_row['token'];
$token_id = -1;

if($_SESSION["active_token_id"] > 0){
    echo '<h1>Active Token ID = '.$_SESSION["active_token_id"] .'</h1>';
    $token_id = $_SESSION['active_token_id'];
}
if($token_id == -1){
    echo '<br>Token ID is not set in the $_SESSION["active_token_id"] variable in CalculationRepo.php file<br>';
}


if($next_token != ""){

    $decision = updateTokenStatus("Active", $token_id);
    if($decision == true){
        $_SESSION["active_token_value"] = $next_token;
        $_SESSION["active_token_row"] = $next_token_row;
        header("Location: {$Token_Request}");
    }else{
        $errorMessage = urldecode("Could not activate the token");
        header("Location: {$Token_Request}?message=$errorMessage");
    }

}else{
    $errorMessage = urldecode("No token left");
    header("Location: {$Token_Request}?message=$errorMessage");
}


