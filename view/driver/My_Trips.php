<?php

global $routes, $backend_routes, $image_routes;
require '../../routes.php';

$driver_dashboard = $routes["driver_dashboard"];
$token_request = $routes["token_request"];
$my_trips = $routes["my_trips"];

// Assume this function gets all trips for the logged-in driver
$data = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips</title>
    <link rel="stylesheet" href="../css/driver_all_pages.css">
    <link rel="stylesheet" href="../css/driver_my_trips.css">
</head>
<body>

<nav class="sidebar">
    <h2>Driver Panel</h2>
    <ul>
        <li><a href="<?php echo $driver_dashboard;?>">Dashboard</a></li>
        <li><a href="<?php echo $token_request;?>">Token Request</a></li>
        <li><a href="<?php echo $my_trips;?>" class="active">My Trips</a></li>
    </ul>
</nav>

<main class="content">
    <header>
        <h1>My Trips</h1>
        <p>View and manage your past & upcoming trips</p>
    </header>

    <!-- Search Bar -->
    <input type="text" id="tripSearch" placeholder="Search Trips..." onkeyup="searchTrips()">

    <!-- Trips Section -->
    <section class="trips" id="tripContainer">
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $trip) : ?>
                <div class="trip-card" data-search="
                    <?php echo strtolower($trip['pickup_location'] . ' ' . $trip['destination'] . ' ' . $trip['status'] . ' ' . $trip['assigned_at']); ?>">
                    <h3><?php echo $trip['pickup_location']; ?> → <?php echo $trip['destination']; ?></h3>
                    <p>Status: <span class="<?php echo strtolower($trip['status']); ?>">
                        <?php echo ucfirst($trip['status']); ?></span>
                    </p>
                    <p><strong>Start Time:</strong> <?php echo $trip['start_time']; ?></p>

                    <!-- Hover Effect (More Details) -->
                    <div class="trip-details">
                        <p><strong>Assigned At:</strong> <?php echo $trip['assigned_at']; ?></p>
                        <p><strong>End Time:</strong> <?php echo $trip['end_time']; ?></p>
                        <p><strong>Notes:</strong> <?php echo !empty($trip['notes']) ? $trip['notes'] : 'No additional details'; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No trips found.</p>
        <?php endif; ?>
    </section>
</main>

<script>
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
