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
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="../css/driver_all_pages.css">
    <link rel="stylesheet" href="../css/driver_dashboard.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

<nav class="sidebar">
    <h2>Driver Panel</h2>
    <ul>
        <li><a href="<?php echo $driver_dashboard;?>" class="active">Dashboard</a></li>
        <li><a href="<?php echo $token_request;?>">Token Request</a></li>
        <li><a href="<?php echo $my_trips;?>">My Trips</a></li>
    </ul>
</nav>

<main class="content">
    <header>
        <h1>Welcome, Driver</h1>
        <p>Your daily stats and performance overview</p>
    </header>

    <section class="dashboard">
        <div class="card">
            <h3>Total Trips Today</h3>
            <p id="tripCount">Loading...</p>
        </div>

        <div class="card">
            <h3>Earnings</h3>
            <p>$120.50</p>
        </div>

        <div class="card">
            <h3>Upcoming Trip</h3>
            <p id="upcomingTripDate">Fetching...</p>
        </div>
    </section>

    <section class="map-container">
        <h2>Today's Trips Map</h2>
        <div id="map"></div>
    </section>

</main>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.getElementById("tripCount").innerText = Math.floor(Math.random() * 10 + 1);

    let upcomingTrips = ["2025-01-30", "2025-02-02", "2025-02-05"];
    document.getElementById("upcomingTripDate").innerText = upcomingTrips[Math.floor(Math.random() * upcomingTrips.length)];

    var map = L.map('map').setView([40.7128, -74.0060], 12); // Default view (New York City)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    function getStatusColor(status) {
        if (status === 'completed') return "green";
        if (status === 'ongoing') return "blue";
        if (status === 'canceled') return "red";
        return "gray";
    }

    fetch('get_trips.php')
        .then(response => response.json())
        .then(trips => {
            trips.forEach(trip => {
                let pickup = trip.pickup_location.split(",").map(Number);
                let destination = trip.destination.split(",").map(Number);
                let color = getStatusColor(trip.status);

                // Pickup Marker
                let pickupMarker = L.marker(pickup).addTo(map)
                    .bindPopup(`<b>Pickup</b><br>Assigned: ${trip.assigned_at}`);

                // Destination Marker
                let destinationMarker = L.marker(destination).addTo(map)
                    .bindPopup(`<b>Destination</b><br>End Time: ${trip.end_time}`);

                // Draw route line
                let route = L.polyline([pickup, destination], {color: color}).addTo(map);

                // Trip Animation (Simulated movement)
                let driverMarker = L.circleMarker(pickup, { radius: 6, color: "black" }).addTo(map);
                let step = 0;
                let totalSteps = 50; // Animation steps
                let interval = setInterval(() => {
                    if (step > totalSteps) {
                        clearInterval(interval);
                    } else {
                        let lat = pickup[0] + ((destination[0] - pickup[0]) * step / totalSteps);
                        let lng = pickup[1] + ((destination[1] - pickup[1]) * step / totalSteps);
                        driverMarker.setLatLng([lat, lng]);
                        step++;
                    }
                }, 100);
            });
        })
        .catch(error => console.error("Error loading trips:", error));
</script>

</body>
</html>
