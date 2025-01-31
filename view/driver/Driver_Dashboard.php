<?php
global $routes, $backend_routes, $image_routes;
require '../../routes.php';

$Login_page = $routes['login'];
$driver_dashboard = $routes["driver_dashboard"];
$token_request = $routes["token_request"];
$my_trips = $routes["my_trips"];

$logout_controller = $backend_routes['logout_controller'];


require_once __DIR__ . '/../../model/CalculationRepo.php';
require_once __DIR__ . '/../../view/Data_Provider.php';

@session_start();
if($_SESSION["user_id"] <= 0){
    echo '<h1>'.$_SESSION["user_id"] .'</h1>';
    header("Location: {$Login_page}");
}

$user_id = $_SESSION["user_id"];

$driver_name = getDriverName($user_id);

$next_token_row = null;
$next_token_row = getNextToken($user_id);
$next_token_id = $next_token_row["id"];

$next_trip = "";
$next_trip = getNextTrip($next_token_id);
if($next_trip == ""){
    $next_trip = "No Next Trip For Now";
}

$trip_count = 0;
$trip_count = getMyTodaysTripCount($user_id);
if($trip_count <= 0){
    $trip_count = 0;
}

$todays_earning = 0;
$todays_earning = getMyTodaysEarning($user_id);
if($todays_earning <= 0){
    $todays_earning = 0;
}

$get_My_Todays_Trip_Map = null;
$get_My_Todays_Trip_Map = getMyTodaysTripMap($user_id);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="../css/driver_all_pages.css">
    <link rel="stylesheet" href="../css/driver_dashboard.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--Ajax Library-->

</head>
<body>

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
    background: linear-gradient(135deg, #f7f7f7, #e3e3e3);
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
            color: #333;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            color: white;
            box-shadow: 0 4px 10px rgba(255, 77, 77, 0.3);
            transition: all 0.3s ease;">
            Welcome, <?php echo $driver_name;?>
        </h1>
        <p style="color: #555; font-size: clamp(14px, 2vw, 18px);">
            Your daily stats and performance overview
        </p>
    </header>

    <!-- Dashboard Section -->
    <section class="dashboard" style="
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        max-width: 100%;
        width: 90%;
        box-sizing: border-box;">

        <div class="card" style="
            background: linear-gradient(135deg, #ffffff, #f5f5f5);
            padding: 25px;
            border-radius: 15px;
            width: min(250px, 100%);
            height: auto;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-align: center;">

            <h3 style="font-size: clamp(16px, 2vw, 18px); font-weight: bold;">Total Trips Today</h3>
            <p id="tripCount" style="
                font-size: clamp(20px, 3vw, 24px);
                font-weight: bold;
                color: #ff5733;
                transition: all 0.3s ease;">
                <?php echo $trip_count; ?>
            </p>
        </div>

        <div class="card" style="
            background: linear-gradient(135deg, #ffffff, #f5f5f5);
            padding: 25px;
            border-radius: 15px;
            width: min(250px, 100%);
            height: auto;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;">

            <h3 style="font-size: clamp(16px, 2vw, 18px); font-weight: bold;">Today's Earnings</h3>
            <p style="
                font-size: clamp(20px, 3vw, 24px);
                font-weight: bold;
                color: #2ecc71;
                transition: all 0.3s ease;">
                BDT(৳) - <?php echo $todays_earning.'/-';?>
            </p>
        </div>

        <div class="card" style="
            background: linear-gradient(135deg, #ffffff, #f5f5f5);
            padding: 25px;
            border-radius: 15px;
            width: min(320px, 100%);
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;">

            <h3 style="margin-bottom: 10px; font-size: clamp(16px, 2vw, 18px); font-weight: bold;">Upcoming Trip</h3>
            <table style="
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;">
                <tr>
                    <td style="text-align: left; padding: 5px; font-weight: bold; max-width: 40%;">From</td>
                    <td style="text-align: center; padding: 5px; font-weight: bold; max-width: 10%;"> ➝ </td>
                    <td style="text-align: right; padding: 5px; font-weight: bold; max-width: 40%;">Destination</td>
                </tr>
                <tr>
                    <td style="text-align: left; padding: 10px; font-weight: bold; color: #15a762; max-width: 40%;">
                        <?php echo htmlspecialchars($next_trip['pickup_location']); ?>
                    </td>
                    <td style="text-align: center; padding: 10px; font-weight: bold; max-width: 10%;"> ➝ </td>
                    <td style="text-align: right; padding: 10px; font-weight: bold; color: #15a762; max-width: 40%;">
                        <?php echo htmlspecialchars($next_trip['destination']); ?>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-container" style="
        margin-top: 40px;
        text-align: center;
        position: relative;
        width: 100%;">

        <h2 style="
        margin-bottom: 15px;
        color: #333;
        font-size: clamp(18px, 2vw, 22px);
        font-weight: bold;
        background: linear-gradient(135deg, #2196F3, #00BCD4);
        padding: 10px 20px;
        border-radius: 20px;
        display: inline-block;
        color: white;
        box-shadow: 0 4px 10px rgba(33, 150, 243, 0.3);
        transition: all 0.3s ease;">
            Today's Trips Map
        </h2>

        <!-- Fullscreen Toggle Button -->
        <button onclick="toggleFullscreen()" style="
        position: absolute;
        top: 10px;
        right: 20px;
        background: linear-gradient(135deg, #ff7e5f, #ff416c);
        color: white;
        font-size: clamp(14px, 2vw, 16px);
        font-weight: bold;
        border: none;
        border-radius: 25px;
        padding: 8px 16px;
        cursor: pointer;
        box-shadow: 0px 4px 10px rgba(255, 65, 108, 0.4);
        transition: all 0.3s ease;">
            🔍 Full Screen
        </button>

        <div id="map-container" style="
        width: 95%;
        height: clamp(400px, 60vh, 600px);
        margin: auto;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;">
            <div id="map" style="width: 100%; height: 100%; border-radius: 10px;"></div>
        </div>
    </section>
</main>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>

    function toggleFullscreen() {
        var mapContainer = document.getElementById("map-container");
        if (!document.fullscreenElement) {
            if (mapContainer.requestFullscreen) {
                mapContainer.requestFullscreen();
            } else if (mapContainer.mozRequestFullScreen) { // Firefox
                mapContainer.mozRequestFullScreen();
            } else if (mapContainer.webkitRequestFullscreen) { // Chrome, Safari & Opera
                mapContainer.webkitRequestFullscreen();
            } else if (mapContainer.msRequestFullscreen) { // IE/Edge
                mapContainer.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }


    var map = L.map('map').setView([23.8103, 90.4125], 12); // Default view (Dhaka)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    function getStatusColor(status) {
        if (status === 'completed') return "green";
        if (status === 'ongoing') return "blue";
        if (status === 'pending') return "orange";
        return "gray";
    }

    function fetchAndUpdateMap() {
        $.ajax({
            url: 'get_trips.php',
            type: 'GET',
            dataType: 'json',
            success: function(trips) {
                if (!trips || trips.length === 0) {
                    console.log("No trips found for today.");
                    return;
                }

                let tripCoordinates = [];
                let bounds = new L.LatLngBounds();
                let previousDestination = null;

                trips.forEach((trip, index) => {
                    let pickup = trip.pickup_location.map(Number);
                    let destination = trip.destination.map(Number);
                    let color = getStatusColor(trip.status.toLowerCase());

                    tripCoordinates.push(pickup);
                    tripCoordinates.push(destination);

                    // Add Pickup Marker
                    L.marker(pickup).addTo(map)
                        .bindPopup(
                            `<b>Trip #${trip.serial} - Pickup</b><br>
                        Location: ${trip.pickup_name}<br>
                        Start Time: ${trip.start_time}<br>
                        Status: <span style="color:${color}; font-weight:bold;">${trip.status}</span>`
                        );
                    bounds.extend(pickup);

                    // Add Destination Marker
                    L.marker(destination).addTo(map)
                        .bindPopup(
                            `<b>Trip #${trip.serial} - Destination</b><br>
                        Location: ${trip.destination_name}<br>
                        End Time: ${trip.end_time}<br>
                        Status: <span style="color:${color}; font-weight:bold;">${trip.status}</span>`
                        );
                    bounds.extend(destination);

                    // Draw route line between pickup and destination
                    L.polyline([pickup, destination], { color: color }).addTo(map);

                    // Connect previous trip's destination to current trip's pickup with a gray line
                    if (previousDestination) {
                        L.polyline([previousDestination, pickup], { color: "red", dashArray: '5, 5' }).addTo(map);
                    }

                    // Store the current trip's destination for the next iteration
                    previousDestination = destination;
                });

                // Auto-fit map to all markers
                if (tripCoordinates.length > 0) {
                    map.fitBounds(bounds);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching trips:", error);
            }
        });
    }

    // Fetch trip data on page load
    fetchAndUpdateMap();

    // Refresh map every 30 seconds using AJAX
    setInterval(fetchAndUpdateMap, 30000);
</script>


</body>
</html>
