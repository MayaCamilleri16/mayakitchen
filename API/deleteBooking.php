<?php
// Allow cross-origin requests from any origin, specify the content type as JSON, permit the use of the DELETE method, and define the allowed headers for CORS requests.
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

$booking = new Booking($db);

// Decode JSON data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if 'id' field exists in the JSON data
if (isset($data->id)) {
    // Set the booking ID
    $booking->id = $data->id;

    // Delete booking
    if ($booking->delete()) {
        echo json_encode(array('message' => 'Booking deleted'));
    } else {
        echo json_encode(array('message' => 'Booking not deleted'));
    }
} else {
    // Handle the case where the 'id' field is missing
    echo json_encode(array('message' => 'ID field is missing'));
}
?>
