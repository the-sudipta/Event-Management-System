<?php

require_once __DIR__ . '/../model/db_connect.php';


function findAllDrivers()
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `driver`';

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
            throw new Exception("No rows found in the 'user' table.");
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


function findDriverInfoByColumnNameAndData($colName, $data) {
    $conn = db_conn();

    // Use prepared statement to prevent SQL injection
    $selectQuery = 'SELECT * FROM `driver` WHERE `'.$colName.'` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        // Bind parameters
        $stmt->bind_param("s", $data);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }

    return $user ?: null;
}


function findDriverByUserID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `driver` WHERE `user_id` = ?';

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

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Check for an empty result set
        if (!$user) {
            throw new Exception("No user found with ID: " . $id);
        }

        // Close the statement
        $stmt->close();

        return $user;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function findDriverByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT * FROM `driver` WHERE `id` = ?';

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

        // Fetch the user as an associative array
        $user = $result->fetch_assoc();

        // Check for an empty result set
        if (!$user) {
            throw new Exception("No user found with ID: " . $id);
        }

        // Close the statement
        $stmt->close();

        return $user;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        // Close the database connection
        $conn->close();
    }
}

function updateDriver($name, $car_name, $car_details, $current_location, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `driver` SET 
                    name = ?,
                    car_name = ?,
                    car_details = ?,
                    current_location = ?,
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('ssssi', $name, $car_name, $car_details, $current_location,  $id);

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

function updateDriverCurrentLocation($current_location, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `driver` SET 
                    current_location = ?,
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('si', $current_location, $id);

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


function deleteDriver($id) {
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "DELETE FROM `driver` 
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $status = 0;
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


function createDriver($name, $car_name, $car_details, $user_id) {
    $conn = db_conn();

    // Hash the password using a secure hashing algorithm (e.g., password_hash)
//    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Construct the SQL query
    $insertQuery = "INSERT INTO `driver` (name, car_name, car_details, user_id) VALUES (?, ?, ?, ?)";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($insertQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $status = 1;

        // Bind parameters
        $stmt->bind_param('sssi', $name, $car_name, $car_details, $user_id);

        // Execute the query
        $stmt->execute();

        // Return the ID of the newly inserted user
        $newUserId = $conn->insert_id;

        // Close the statement
        $stmt->close();

        return $newUserId;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return -1;
    } finally {
        // Close the database connection
        $conn->close();
    }
}
