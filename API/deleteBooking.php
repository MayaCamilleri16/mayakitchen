<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// inizilzation
include_once('../core/initialize.php');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'));


    if (isset($data->id)) {
        // Instantiate Booking object
        $booking = new Booking($db);

        // Set the booking ID
        $booking->id = $data->id;

        // Delete the booking
        if ($booking->delete()) {
            // Booking deleted successfully
            echo json_encode(array('message' => 'Booking deleted'));
        } else {
            // Failed to delete booking
            echo json_encode(array('message' => 'Failed to delete booking'));
        }
    } else {
        // Handle the case where the 'id' field is missing
        echo json_encode(array('message' => 'ID field is missing'));
    }
} else {
    // Handle other request methods
    echo json_encode(array('message' => 'Invalid request method'));
}

?>
