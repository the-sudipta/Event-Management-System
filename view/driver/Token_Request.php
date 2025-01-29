<?php

global $routes, $backend_routes, $image_routes;
require '../../routes.php';



$driver_dashboard = $routes["driver_dashboard"];
$token_request = $routes["token_request"];
$my_trips = $routes["my_trips"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Token Request</title>
    <link rel="stylesheet" href="../css/driver_token_request.css">
</head>
<body>

<nav class="sidebar">
    <h2>Driver Panel</h2>
    <ul>
        <li><a href="<?php echo $driver_dashboard;?>">Dashboard</a></li>
        <li><a href="<?php echo $token_request;?>" class="active">Token Request</a></li>
        <li><a href="<?php echo $my_trips;?>">My Trips</a></li>
    </ul>
</nav>

<main class="content">
    <header>
        <h1>Token Request</h1>
        <p>Request a token for your next trip.</p>
    </header>

    <section class="token-section">
        <div class="token-card">
            <h2>Active Token</h2>
            <p id="tokenStatus">No active token.</p>
        </div>
        <button onclick="requestToken()">Request New Token</button>
    </section>

    <section class="info-box">
        <h3>What is a Token?</h3>
        <p>A token allows you to get pre-approved funds for trips, fuel, or services. Request one when needed.</p>
    </section>

    <section class="token-history">
        <h3>Past Token Requests</h3>
        <ul id="historyList">
            <li>No previous requests.</li>
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

