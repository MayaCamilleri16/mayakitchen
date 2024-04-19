<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Get the request body
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Check if the event ID is provided
if (isset($data['event_id'])) {
    // Retrieve the event ID from the request data
    $event_id = intval($data['event_id']);

    // Check if feedback is retrieved
    if (!empty($feedbackList)) {
        // Return feedback as a JSON response
        http_response_code(200); // OK
        echo json_encode($feedbackList);
    } else {
        // No feedback found for the specified event ID
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'No feedback found for the specified event ID.'));
    }
} else {
    // Event ID is not provided in the request
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Event ID is required in the request body.'));
}

?>
