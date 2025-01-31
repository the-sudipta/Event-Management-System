<?php

global $routes, $backend_routes, $image_routes;
require '../../routes.php';

require_once __DIR__ . '/../../view/Data_Provider.php';

$Login_page = $routes["login"];
$driver_dashboard = $routes["driver_dashboard"];
$token_request = $routes["token_request"];
$my_trips = $routes["my_trips"];

$driver_token_request_controller = $backend_routes['driver_token_request_controller'];
$logout_controller = $backend_routes['logout_controller'];

@session_start();
if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}


$user_id = $_SESSION["user_id"];
$isTokenActive = true;
$isTokenActive = isAnyTokenActive($user_id);


$token_value = "";
if(isset($_SESSION["active_token_value"])){
    $token_value = $_SESSION["active_token_value"];
}else{
    $token_row = getCurrentActiveToken($user_id);
    $token_value = $token_row['token'];
    if($token_value  == ""){
        $token_value = "No active token";
    }
}

$error_message = "";
// Message from Backend
if (isset($_GET['message'])) {
    $error_message = htmlspecialchars($_GET['message']);
    $show_backend_error_modal = true;
}

$previous_token = "";
$previous_token_row = null;
$previous_token_row = getPreviousToken($user_id);
$previous_token = $previous_token_row['token'];
if ($previous_token == ""){
    $previous_token = "No previous requests";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Request</title>
<!--    <link rel="stylesheet" href="../css/driver_all_pages.css">-->
    <link rel="stylesheet" href="../css/driver_dashboard.css">
    <link rel="stylesheet" href="../css/driver_token_request.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--Ajax Library-->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


</head>
<body style="font-family: 'Times New Roman'">







<nav class="" style="
    background: #1c1c1c;
    color: white;
    width: 250px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    box-shadow: 3px 0px 10px rgba(0,0,0,0.3);">

    <!--    <h2 style="-->
    <!--        font-size: 22px;-->
    <!--        font-weight: bold;-->
    <!--        text-transform: uppercase;-->
    <!--        margin-bottom: 20px;-->
    <!--        background: linear-gradient(135deg, #ff4b2b, #ff416c);-->
    <!--        padding: 10px 20px;-->
    <!--        border-radius: 20px;-->
    <!--        color: white;-->
    <!--        box-shadow: 0 4px 10px rgba(255, 77, 77, 0.3);-->
    <!--        transition: all 0.3s ease;">-->
    <!--        Driver Panel-->
    <!--    </h2>-->
    <h2 style="font-size: 22px; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">Driver Panel</h2>

    <ul style="list-style: none; padding: 0; width: 100%; margin-top: 30px;">
        <!-- Dashboard Link -->
        <li style="width: 100%; margin-bottom: 10px;">
            <a href="<?php echo $driver_dashboard;?>" class="active" style="
                display: flex;
                align-items: center;
                padding: 14px 25px;
                text-decoration: none;
                color: white;
                font-size: 16px;
                font-weight: bold;
                transition: all 0.3s ease;
                background: linear-gradient(135deg, #ff7e5f, #ff416c);
                border-radius: 30px;
                box-shadow: 0 4px 10px rgba(255, 77, 77, 0.3);
                position: relative;">
                <i class="fas fa-tachometer-alt" style="margin-right: 12px;"></i> Dashboard
            </a>
        </li>

        <!-- Token Request Link -->
        <li style="width: 100%; margin-bottom: 10px;">
            <a href="<?php echo $token_request;?>" style="
                display: flex;
                align-items: center;
                padding: 14px 25px;
                text-decoration: none;
                color: white;
                font-size: 16px;
                font-weight: bold;
                transition: all 0.3s ease;
                background: linear-gradient(135deg, #56ccf2, #2f80ed);
                border-radius: 30px;
                box-shadow: 0 4px 10px rgba(45, 156, 219, 0.3);
                position: relative;">
                <i class="fas fa-ticket-alt" style="margin-right: 12px;"></i> Token Request
            </a>
        </li>

        <!-- My Trips Link -->
        <li style="width: 100%; margin-bottom: 40px;">
            <a href="<?php echo $my_trips;?>" style="
                display: flex;
                align-items: center;
                padding: 14px 25px;
                text-decoration: none;
                color: white;
                font-size: 16px;
                font-weight: bold;
                transition: all 0.3s ease;
                background: linear-gradient(135deg, #16a085, #2ecc71);
                border-radius: 30px;
                box-shadow: 0 4px 10px rgba(46, 204, 113, 0.3);
                position: relative;">
                <i class="fas fa-route" style="margin-right: 12px;"></i> My Trips
            </a>
        </li>

        <!-- New Beautiful Logout Button -->
        <li>
            <a href="<?php echo $logout_controller; ?>">
                <button type="submit"
                        style="
                    background: linear-gradient(135deg, #ff4b2b, #ff416c);
                    color: white;
                    font-size: 18px;
                    font-weight: bold;
                    border: none;
                    border-radius: 30px;
                    padding: 12px 25px;
                    width: 80%;
                    position: absolute;
                    bottom: 50px;
                    left: 50%;
                    transform: translateX(-50%);
                    text-align: center;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    box-shadow: 0px 5px 15px rgba(255, 77, 77, 0.3);
                    transition: all 0.3s ease-in-out;"
                        onmouseover="this.style.background='linear-gradient(135deg, #ff2e00, #e6005c)'; this.style.boxShadow='0px 8px 20px rgba(255, 77, 77, 0.6)'; this.style.transform='translateX(-50%) scale(1.08)';"
                        onmouseout="this.style.background='linear-gradient(135deg, #ff4b2b, #ff416c)'; this.style.boxShadow='0px 5px 15px rgba(255, 77, 77, 0.3)'; this.style.transform='translateX(-50%) scale(1)';"
                        onmousedown="this.style.transform='translateX(-50%) scale(0.95)'; this.style.boxShadow='0px 2px 10px rgba(255, 77, 77, 0.5)';"
                        onmouseup="this.style.transform='translateX(-50%) scale(1.08)'; this.style.boxShadow='0px 8px 20px rgba(255, 77, 77, 0.6)';">

                    <i class="fas fa-sign-out-alt" style="margin-right: 10px; font-size: 20px;"></i> Logout
                </button>
            </a>
        </li>

    </ul>

</nav>

<main class="content" style="
    margin-left: 270px;
    padding: 30px;
    width: calc(100% - 270px);
    background: linear-gradient(135deg, #f8f8f8, #e6e6e6);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    max-width: 100%;
    overflow: hidden;
    box-sizing: border-box;">

    <header style="
        margin-bottom: 30px;
        width: 100%;
        max-width: 800px;">
        <h1 style="
            font-size: clamp(22px, 5vw, 28px);
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            padding: 12px 25px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(255, 77, 77, 0.4);
            transition: all 0.3s ease;">
            Token Request
        </h1>
        <p style="color: #555; font-size: clamp(14px, 2vw, 18px);">
            Request a token for your next trip.
        </p>
    </header>

    <!-- Active Token Card -->
    <section class="token-section" style="
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        max-width: 100%;
        width: 90%;
        box-sizing: border-box;">

        <div class="token-card" style="
            background: linear-gradient(135deg, #ffffff, #f7f7f7);
            padding: 30px;
            border-radius: 20px;
            width: min(400px, 100%);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            transform: scale(1);
            transition: all 0.3s ease;"
             onmouseover="this.style.transform='scale(1.05)';"
             onmouseout="this.style.transform='scale(1)';">

            <h2 style="font-size: clamp(18px, 2vw, 22px); font-weight: bold; margin-bottom: 10px;">
                Active Token
            </h2>
            <p id="tokenStatus" style="
                font-size: clamp(20px, 3vw, 24px);
                font-weight: bold;
                color: #15a762;
                transition: all 0.3s ease;">
                <?php echo $token_value; ?>
            </p>
        </div>

        <form action="<?php echo $driver_token_request_controller; ?>" method="post" id="login_form">
            <button type="submit"
                <?php echo ($isTokenActive) ? 'disabled style="background: #ccc; cursor: not-allowed;"' : ''; ?>
                    style="
                background: linear-gradient(135deg, #ff7e5f, #ff416c);
                color: white;
                font-size: 18px;
                font-weight: bold;
                border: none;
                border-radius: 50px;
                padding: 15px 40px;
                cursor: pointer;
                box-shadow: 0px 6px 15px rgba(255, 65, 108, 0.3);
                transition: all 0.3s ease;"
                    onmouseover="this.style.background='linear-gradient(135deg, #ff2e00, #e6005c)'; this.style.boxShadow='0px 8px 20px rgba(255, 65, 108, 0.5)'; this.style.transform='scale(1.05)';"
                    onmouseout="this.style.background='linear-gradient(135deg, #ff7e5f, #ff416c)'; this.style.boxShadow='0px 6px 15px rgba(255, 65, 108, 0.3)'; this.style.transform='scale(1)';"
                    onmousedown="this.style.transform='scale(0.95)'; this.style.boxShadow='0px 3px 10px rgba(255, 65, 108, 0.5)';"
                    onmouseup="this.style.transform='scale(1.05)'; this.style.boxShadow='0px 8px 20px rgba(255, 65, 108, 0.5)';">
                Request New Token
            </button>
        </form>
    </section>

    <!-- Information Section -->
    <section class="info-box" style="
        background: #fff6e5;
        border-radius: 20px;
        padding: 20px;
        margin-top: 30px;
        max-width: 600px;
        box-shadow: 0px 5px 15px rgba(255, 195, 0, 0.3);
        text-align: center;
        transition: all 0.3s ease;"
             onmouseover="this.style.transform='scale(1.03)';"
             onmouseout="this.style.transform='scale(1)';">

        <h3 style="color: #ff9800; font-size: clamp(16px, 2vw, 20px); font-weight: bold;">What is a Token?</h3>
        <p style="color: #555; font-size: clamp(14px, 2vw, 16px);">
            A token allows you to get pre-approved funds for trips, fuel, or services. Request one when needed.
        </p>
    </section>

    <!-- Past Token Requests -->
    <section class="token-history" style="
        margin-top: 40px;
        width: 100%;
        max-width: 600px;">

        <h3 style="color: #333; font-size: clamp(16px, 2vw, 20px); font-weight: bold; margin-bottom: 10px;">
            Past Token Requests
        </h3>

        <ul id="historyList" style="
            list-style: none;
            padding: 0;
            width: 100%;
            text-align: center;">

            <li style="
                background: linear-gradient(135deg, #e3e3e3, #d3d3d3);
                border-radius: 15px;
                padding: 15px;
                font-size: 16px;
                font-weight: bold;
                color: #333;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;"
                onmouseover="this.style.transform='scale(1.03)';"
                onmouseout="this.style.transform='scale(1)';">
                <?php echo $previous_token; ?>
            </li>
        </ul>
    </section>
</main>


<script>
    function requestToken() {
        let tokenCode = "TOKEN-" + Math.floor(1000 + Math.random() * 9000);
        document.getElementById("tokenStatus").innerText = "Your active token: " + tokenCode;

        let historyList = document.getElementById("historyList");
        let newItem = document.createElement("li");
        newItem.innerText = tokenCode + " - Requested Just Now";
        historyList.prepend(newItem);
    }
</script>

</body>
</html>

