<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllTrips()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `trip`';

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'trip' table.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}


function findAllTripsByUserID($user_id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `trip` WHERE `user_id` = '.$user_id;

    try {
        $result = $conn->query($selectQuery);

        // Check if the query was successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }

        $rows = array();

        // Fetch rows one by one
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Check for an empty result set
        if (empty($rows)) {
            throw new Exception("No rows found in the 'trip' table for that user_id.");
        }

        return $rows;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findTripByTripID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `trip` WHERE `id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the Trip as an associative array
        $trip = $result->fetch_assoc();

        // Check for an empty result set
        if (!$trip) {
            throw new Exception("No trip found with ID: " . $id);
        }

        // Close the statement
        $stmt->close();

        return $trip;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findTripByTokenID($token_id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `trip` WHERE `token_id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $token_id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the Trip as an associative array
        $trip = $result->fetch_assoc();

        // Check for an empty result set
        if (!$trip) {
            throw new Exception("No trip found with token ID: " . $token_id);
        }

        // Close the statement
        $stmt->close();

        return $trip;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function updateTripStatus($status, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `trip` SET 
                    status = ?,
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('si', $status, $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}


function deleteTrip($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `trip`
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameter
        $stmt->bind_param('i', $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}


function createTrip($pickup_location, $destination, $start_time, $end_time, $status, $notes, $token_id, $user_id) {
    $conn = db_conn();

    // Construct the SQL query
    $insertQuery = "INSERT INTO `trip` (pickup_location, destination, start_time, end_time, status, notes, token_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Bind parameters
        $stmt->bind_param('ssssssssii', $pickup_location, $destination, $start_time, $end_time, $status, $notes, $token_id, $user_id);

        // Execute the query
        $stmt->execute();

        // Return the ID of the newly inserted Trip
        $newTripId = $stmt->insert_id;

        // Close the statement
        $stmt->close();

        return $newTripId;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return -1;
    } finally {
        // Close the database connection
        $conn->close();
    }
}
