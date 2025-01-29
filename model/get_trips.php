<?php
// Database Connection
$host = "localhost";
$user = "root"; // Change if needed
$password = "";
$dbname = "event_management_system";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch trips from database
$sql = "SELECT * FROM trip";
$result = $conn->query($sql);

$trips = [];

while ($row = $result->fetch_assoc()) {
    $trips[] = $row;
}

echo json_encode($trips); // Output JSON for frontend

$conn->close();
?>
