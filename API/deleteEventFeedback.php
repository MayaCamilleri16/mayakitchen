<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');
$eventFeedback = new EventFeedback($db);

// Get the input data from the request body
$data = json_decode(file_get_contents('php://input'));

// Check if feedback_id is provided
if (!empty($data->feedback_id)) {
    // Set the feedback_id property of the EventFeedback object
    $eventFeedback->feedback_id = htmlspecialchars(strip_tags($data->feedback_id));

    // Attempt to delete the feedback
    if ($eventFeedback->deleteFeedback()) {
        // Feedback deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Feedback deleted successfully.'));
    } else {
        // Failed to delete feedback
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Unable to delete feedback.'));
    }
} else {
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide feedback_id.'));
}

?>
