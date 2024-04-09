<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$booking = new Booking($db);
$booking->id = isset($_GET['id']) ? $_GET['id'] : die();

// Retrieve booking details
$booking->read_single();

// Create array to store booking information
$booking_info = array(
    'id' => $booking->id,
    'user_id' => $booking->user_id,
    'table_id' => $booking->table_id,
    'date' => $booking->date,
    'time' => $booking->time,
    'party_size' => $booking->party_size,
    'review_id' => $booking->review_id,
    'preferences_id' => $booking->preferences_id,
    'discount_id' => $booking->discount_id,
    'waitlist_id' => $booking->waitlist_id
);


echo json_encode($booking_info);
