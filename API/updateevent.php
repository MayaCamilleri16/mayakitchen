<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include initialization and EventManagement class
include_once('../core/initialize.php');


// Initialize EventManagement object
$eventManagement = new EventManagement($db);
$data = json_decode(file_get_contents('php://input'));

// Check if the required data is provided
if (
    !empty($data->event_id) &&
    !empty($data->user_id) &&
    !empty($data->event_name) &&
    !empty($data->event_date) &&
    !empty($data->event_time) &&
    !empty($data->party_size)
) {
    // Set event properties
    $eventManagement->event_id = htmlspecialchars(strip_tags($data->event_id));
    $eventManagement->user_id = htmlspecialchars(strip_tags($data->user_id));
    $eventManagement->event_name = htmlspecialchars(strip_tags($data->event_name));
    $eventManagement->event_date = htmlspecialchars(strip_tags($data->event_date));
    $eventManagement->event_time = htmlspecialchars(strip_tags($data->event_time));
    $eventManagement->party_size = htmlspecialchars(strip_tags($data->party_size));

    // Attempt to update the event
    if ($eventManagement->updateEvent()) {
        // Event updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Event updated successfully.'));
    } else {
        // Failed to update event
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Unable to update event.'));
    }
} else {
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide all required fields.'));
}

?>
