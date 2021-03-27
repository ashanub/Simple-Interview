<?php
session_start();
date_default_timezone_set('Asia/Colombo');

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

$status = $_POST['status'];

if ($status === 'startTest') {
    start_test();
    echo gmdate("i:s", $_SESSION['time_limit'] - time());
} elseif ($status === 'getRemainingTime') {
    echo get_remaining_time();
} else {
    http_response_code(400);
}

function start_test()
{
    if (!isset($_SESSION['time_limit'])) {
        $_SESSION['time_limit'] = time() + 1200;
    }
}

function get_remaining_time()
{
    $remaining_time = $_SESSION['time_limit'] - time();

    if ($remaining_time === '' || $remaining_time <= 0) {
        $_SESSION['time_limit'] = null;
        return 'Time Expired';
    }

    return (gmdate("i:s", $remaining_time));
}

