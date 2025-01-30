<?php

require_once __DIR__ . '/../../model/UserRepo.php';
require_once __DIR__ . '/../../model/TokenRepo.php';
require_once __DIR__ . '/../../model/TripRepo.php';
require_once __DIR__ . '/../../model/DriverRepo.php';
require_once __DIR__ . '/../../model/NotificationRepo.php';
require_once __DIR__ . '/../../model/CalculationRepo.php';

function getDriverName($user_id){
    return findDriverByUserID($user_id);
}