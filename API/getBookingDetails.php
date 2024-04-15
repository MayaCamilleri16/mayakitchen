<?php
// Allow cross-origin requests from any origin
header('Access-Control-Allow-Origin: *');
// Specify the content type as JSON
header('Content-Type: application/json');


include_once('../core/initialize.php');

// Instantiate Booking object
$booking = new Booking($db);

// Decode JSON data from the request
$data = json_decode(file_get_contents('php://input'));


if (isset($data->id)) {
    // Set the booking ID
    $booking->id = $data->id;

    // Get booking details
    $booking_details = $booking->getBookingDetails();

    if ($booking_details) {
        // Return booking details as JSON response
        echo json_encode($booking_details);
    } else {
        // Return error message if booking details are not found
        echo json_encode(array('message' => 'Booking not found'));
    }
} else {
    // Return error message if 'id' field is missing
    echo json_encode(array('message' => 'ID field is missing'));
}
?>
