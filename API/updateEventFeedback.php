<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// initialization 
include_once('../core/initialize.php');

// Initialize EventFeedback object
$eventFeedback = new EventFeedback($db);
$data = json_decode(file_get_contents('php://input'));

// Check if required data is provided
if (
    !empty($data->feedback_id) &&
    !empty($data->event_id) &&
    !empty($data->user_id) &&
    !empty($data->comment) &&
    !empty($data->time) &&
    !empty($data->rating)
) {
    // Set feedback properties
    $eventFeedback->feedback_id = htmlspecialchars(strip_tags($data->feedback_id));
    $eventFeedback->event_id = htmlspecialchars(strip_tags($data->event_id));
    $eventFeedback->user_id = htmlspecialchars(strip_tags($data->user_id));
    $eventFeedback->comment = htmlspecialchars(strip_tags($data->comment));
    $eventFeedback->time = htmlspecialchars(strip_tags($data->time));
    $eventFeedback->rating = htmlspecialchars(strip_tags($data->rating));

    // Attempt to update the feedback
    try {
        if ($eventFeedback->updateFeedback()) {
            // Feedback updated successfully
            http_response_code(200); // OK
            echo json_encode(array('message' => 'Feedback updated successfully.'));
        } else {
            // Failed to update feedback
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Unable to update feedback.'));
        }
    } catch (PDOException $e) {
        // Handle database errors
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Error updating feedback: ' . $e->getMessage()));
    }
} else {
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide all required fields.'));
}
?>