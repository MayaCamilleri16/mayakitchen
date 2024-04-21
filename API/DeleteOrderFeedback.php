<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$serveOrderFeedback = new ServeOrderFeedback($db);


$data = json_decode(file_get_contents('php://input'));

// Check if the serve_feedback_id is provided in the request data
if (!empty($data->serve_feedback_id)) {
    // Set the serve_feedback_id property of the ServeOrderFeedback class
    $serveOrderFeedback->serve_feedback_id = $data->serve_feedback_id;

    // Attempt to delete the feedback entry
    if ($serveOrderFeedback->delete()) {
        // Feedback entry deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Feedback entry deleted successfully.'));
    } else {
        // Failed to delete feedback entry
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete feedback entry.'));
    }
} else {
    // serve_feedback_id not provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide serve_feedback_id.'));
}
?>
