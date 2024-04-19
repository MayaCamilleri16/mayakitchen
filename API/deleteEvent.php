<?php

// Include necessary headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');

$event = new EventManagement($db);
$data = json_decode(file_get_contents('php://input'));

// Check if the event_id is provided
if (!empty($data->event_id)) {
    // Set the event_id for the event object
    $event->event_id = htmlspecialchars(strip_tags($data->event_id));
    $event->user_id = htmlspecialchars(strip_tags($data->user_id)); // Ensure user_id is set for deletion check

    // Attempt to delete the event
    if ($event->delete()) {
        // Event deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Event deleted successfully.'));
    } else {
        // Failed to delete event
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Unable to delete event.'));
    }
} else {
    // Missing event_id in the request
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide event_id and user_id.'));
}

?>
