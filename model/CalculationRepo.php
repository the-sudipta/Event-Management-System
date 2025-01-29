<?php


require_once __DIR__ . '/../model/db_connect.php';
require_once __DIR__ . '/../model/CarRepo.php';

// Function to get total revenue
function getRevenue($user_id) {
    // Fetch all car data
    $cars = []; // Array to store car data

    $cars = findAllCarsByUserID($user_id);

    // Replace this with your database query to fetch all car data
    // Example: $query = "SELECT * FROM car";
    // Execute query and fetch data into $cars array

    // Calculate total revenue
    $revenue = 0;
    foreach ($cars as $car) {
        // If car availability is 'Sold' or 'Rented', calculate revenue
        if ($car['availability'] == 'Sold' || $car['availability'] == 'Rented') {
            // Convert original price to float
            $price = floatval($car['original_price']);
            // If car is rented, add 0.6% of price to revenue
            if ($car['availability'] == 'Rented') {
                $revenue += $price * 0.006;
            } else {
                $revenue += $price;
            }
        }
    }

    return $revenue;
}

// Function to get total profit
function getProfit($user_id) {
    // Fetch all car data
    $cars = [];

    $cars = findAllCarsByUserID($user_id);

    // Calculate total profit
    $profit = 0;
    foreach ($cars as $car) {
        // If car availability is 'Sold' or 'Rented', calculate profit
        if ($car['availability'] == 'Sold' || $car['availability'] == 'Rented') {
            // Convert original price to float
            $price = floatval($car['original_price']);
            // If car is rented, add 0.6% of price to profit
            if ($car['availability'] == 'Rented') {
                $profit += $price * 0.006;
            } else {
                // Assuming cost price is 80% of original price
                $cost_price = $price * 0.8;
                $profit += ($price - $cost_price);
            }
        }
    }

    return $profit;
}


// Function to get quantity of sold cars
function getSoldCarQuantity($user_id) {
    // Fetch all car data
    $cars = [];
    $cars = findAllCarsByUserID($user_id);

    // Count sold cars
    $sold_count = 0;
    foreach ($cars as $car) {
        if ($car['availability'] == 'Sold') {
            $sold_count++;
        }
    }

    return $sold_count;
}

// Function to get quantity of available cars
function getAvailableCarQuantity($user_id) {
    // Fetch all car data
    $cars = [];
    $cars = findAllCarsByUserID($user_id);

    // Count available cars
    $available_count = 0;
    foreach ($cars as $car) {
        if ($car['availability'] == 'Available') {
            $available_count++;
        }
    }

    return $available_count;
}

// Function to get current month income
function getCurrentMonthIncome($user_id) {
    // Fetch all car data
    $cars = [];
    $cars = findAllCarsByUserID($user_id);

    // Calculate current month income
    $current_month_income = 0;
    foreach ($cars as $car) {
        // If car availability is 'Sold' or 'Rented', and date is in current month, calculate income
        if (($car['availability'] == 'Sold' || $car['availability'] == 'Rented') && date('m', strtotime($car['date'])) === date('m')) {
            // Convert original price to float
            $price = floatval($car['original_price']);
            // If car is rented, add 0.6% of price to income
            if ($car['availability'] == 'Rented') {
                $current_month_income += $price * 0.006;
            } else {
                $current_month_income += $price;
            }
        }
    }

    return $current_month_income;
}

// Function to get distinct years from date strings
function getYearsInArray($user_id) {
    // Fetch all car data
    $cars = [];
    $cars = findAllCarsByUserID($user_id);

    // Extract years from date strings
    $years = [];
    foreach ($cars as $car) {
        if ($car['date'] !== null) {
            $year = date('Y', strtotime($car['date']));
            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }
    }

    // Sort the years array in ascending order
    sort($years);

    return $years;
}

// Function to get revenues per year in array
function getRevenuesPerYearInArray($user_id) {
    // Fetch all car data
    $cars = findAllCarsByUserID($user_id);
    $revenues = [];

    // Calculate revenues for each car
    foreach ($cars as $car) {
        // Check if car availability is 'Sold' or 'Rented' and $car['date'] is not null
        if (($car['availability'] == 'Sold' || $car['availability'] == 'Rented') && isset($car['date']) && $car['date'] !== null) {
            // Convert original price to float
            $price = floatval($car['original_price']);
            // Extract the year from the date
            $year = date('Y', strtotime($car['date']));
            // Check if the year key exists in $revenues array
            if (!array_key_exists($year, $revenues)) {
                // If the key doesn't exist, initialize it with 0
                $revenues[$year] = 0;
            }
            // Calculate revenue based on availability
            if ($car['availability'] == 'Rented') {
                $revenues[$year] += $price * 0.006;
            } else {
                $revenues[$year] += $price;
            }
        }
    }

    // Sort the revenues array by year
    ksort($revenues);

    return $revenues;
}




// Testing time : #304 :
//echo "Total Revenue: $" . getRevenue(1) . "<br>";
//echo "Total Profit: $" . getProfit(1) . "<br>";
//echo "Quantity of Sold Cars: " . getSoldCarQuantity(1) . "<br>";
//echo "Quantity of Available Cars: " . getAvailableCarQuantity(1) . "<br>";
//echo "Current Month Income: $" . getCurrentMonthIncome(1) . "<br>";
//echo "Years in Database: " . implode(", ", getYearsInArray(1)) . "<br>";
//echo "Revenues Per Year: <pre>" . print_r(getRevenuesPerYearInArray(1), true) . "</pre>";
//
