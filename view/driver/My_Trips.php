<?php

global $routes, $backend_routes, $image_routes;
require '../../routes.php';

require_once __DIR__ . '/../../model/CalculationRepo.php';
require_once __DIR__ . '/../../view/Data_Provider.php';


$Login_page = $routes["login"];
$driver_dashboard = $routes["driver_dashboard"];
$token_request = $routes["token_request"];
$my_trips = $routes["my_trips"];

$logout_controller = $backend_routes['logout_controller'];

$tripContainerBg = "";

@session_start();
if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}
$user_id = $_SESSION['user_id'];

$all_my_trips = getMyTrips($user_id);
$tripContainerBg = getTripContainerBgColor($all_my_trips);



// Assume this function gets all trips for the logged-in driver
$data = null;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips</title>
    <link rel="stylesheet" href="../css/driver_dashboard.css">
    <link rel="stylesheet" href="../css/driver_my_trips.css">
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
            My Trips
        </h1>
        <p style="color: #555; font-size: clamp(14px, 2vw, 18px);">
            View and manage your past & upcoming trips
        </p>
    </header>

    <!-- Search Bar -->
    <input type="text" id="tripSearch" placeholder="Search Trips..."
           onkeyup="searchTrips()"
           style="
        padding: 12px;
        font-size: 16px;
        border: 2px solid #ff416c;
        border-radius: 30px;
        width: 60%;
        max-width: 500px;
        outline: none;
        box-shadow: 0px 4px 10px rgba(255, 65, 108, 0.3);
        transition: all 0.3s ease;"
           onfocus="this.style.borderColor='#e6005c'; this.style.boxShadow='0px 6px 15px rgba(255, 65, 108, 0.5)';"
           onblur="this.style.borderColor='#ff416c'; this.style.boxShadow='0px 4px 10px rgba(255, 65, 108, 0.3)';">

    <!-- Trips Section -->
    <section class="trips" id="tripContainer" style="
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
        width: 90%;
        max-width: 1000px;
        box-sizing: border-box;">

        <?php if (!empty($all_my_trips)) : ?>
            <?php foreach ($all_my_trips as $trip) : ?>
                <div
                        class="trip-card"
                        style="
                        background: <?php echo getTripContainerBgColor($trip); ?>;
                        padding: 20px;
                        border-radius: 20px;
                        width: min(320px, 100%);
                        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
                        transition: all 0.3s ease;
                        position: relative;
                        text-align: center;
                        transform: scale(1);"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0px 8px 20px rgba(0, 0, 0, 0.2)';"
                     onmouseout="this.style.transform='scale(1)';"
                     data-search="
                <?php echo htmlspecialchars(strtolower(($trip['pickup_location'] ?? '') . ' ' . ($trip['destination'] ?? '') . ' ' . ($trip['status'] ?? '') . ' ' . ($trip['assigned_at'] ?? ''))); ?>">

                    <h3 style="
                        font-size: 18px;
                        font-weight: bold;
                        color: #333;">
                        <?php echo htmlspecialchars($trip['pickup_location'] ?? 'Unknown'); ?> →
                        <?php echo htmlspecialchars($trip['destination'] ?? 'Unknown'); ?>
                    </h3>

                    <p style="margin: 5px 0;">
                        <strong>Status:</strong>
                        <span style="font-weight: bold; color:
                        <?php echo
                        ($trip['status'] === 'Ongoing') ? 'green' :
                            (($trip['status'] === 'Pending') ? 'orange' :
                                (($trip['status'] === 'Completed') ? 'blue' : 'black'));
                        ?>;
                                ">
                        <?php echo ucfirst(htmlspecialchars($trip['status'] ?? 'Unknown')); ?>
                        </span>
                    </p>

                    <p style="color: #777;"><strong>Start Time:</strong> <?php echo htmlspecialchars($trip['start_time'] ?? 'Not Available'); ?></p>

                    <!-- Hover Effect (More Details) -->
                    <div class="trip-details" style="padding: 0px;">
                        <p style="color: #555;"><strong>End Time:</strong> <?php echo htmlspecialchars($trip['end_time'] ?? 'Not Available'); ?></p>
                        <p style="color: #777;"><strong>Notes:</strong> <?php echo !empty($trip['notes']) ? htmlspecialchars($trip['notes']) : 'No additional details'; ?></p>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p style="color: #777;">No trips found.</p>
        <?php endif; ?>
    </section>
</main>


<script>
//    JS Function for Live Trip Searching
    function searchTrips() {
        let input = document.getElementById("tripSearch").value.toLowerCase();
        let cards = document.querySelectorAll(".trip-card");

        cards.forEach(card => {
            let searchableText = card.getAttribute("data-search");
            card.style.display = searchableText.includes(input) ? "block" : "none";
        });
    }
</script>

</body>
</html>
