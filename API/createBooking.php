<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

$booking = new Booking($db);


$data = json_decode(file_get_contents('php://input'));

// Set booking properties
$booking->user_id = $data->user_id;
$booking->table_id = $data->table_id;
$booking->date = $data->date;
$booking->time = $data->time;
$booking->party_size = $data->party_size;
$booking->review_id = $data->review_id;
$booking->preferences_id = $data->preferences_id;
$booking->discount_id = $data->discount_id;
$booking->waitlist_id = $data->waitlist_id;

// Create booking
if ($booking->create()) {
    echo json_encode(array('message' => 'Booking created'));
} else {
    echo json_encode(array('message' => 'Booking not created'));
}
?>
