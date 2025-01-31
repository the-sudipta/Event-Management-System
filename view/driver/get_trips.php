<?php
require_once __DIR__ . '/../../model/CalculationRepo.php';
require_once __DIR__ . '/../../view/Data_Provider.php';

@session_start();
if (!isset($_SESSION["user_id"])) {
    http_response_code(401); // Unauthorized
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];

header('Content-Type: application/json');
echo json_encode(getMyTodaysTripMap($user_id));
?>
