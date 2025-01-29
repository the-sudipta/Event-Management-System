<?php

function Availability_Badge_Color($data){

    $availabilityColor = '';
    if ($data === "Available") {
        $availabilityColor = 'bg-success';
    } elseif ($data === "Rented") {
        $availabilityColor = 'bg-warning';
    } elseif ($data === "Sold") {
        $availabilityColor = 'bg-danger';
    }

    return $availabilityColor;

}

function Status_Badge_Color($data){

    $statusColor = '';
    if ($data === "Brand New") {
        $statusColor = 'bg-success';
    } elseif ($data === "Used") {
        $statusColor = 'bg-warning';
    }

    return $statusColor;

}

function car_request_Status_Badge_Color($data){

    $statusColor = '';
    if ($data === "Accepted") {
        $statusColor = 'bg-success';
    } elseif ($data === "Pending") {
        $statusColor = 'bg-warning';
    }elseif ($data === "Rejected") {
        $statusColor = 'bg-danger';
    }

    return $statusColor;

}


