<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


// JSON request data
$data = json_decode(file_get_contents('php://input'));

// Check if user_id is provided and valid
if (!empty($data->user_id) && is_numeric($data->user_id)) {
    // Instantiate the ServeOrderFeedback class
    $serveOrderFeedback = new ServeOrderFeedback($db);
    $serveOrderFeedback->user_id = $data->user_id;

    // Fetch user feedback
    $feedback = $serveOrderFeedback->getUserFeedback();

    // Check if feedback is retrieved successfully
    if ($feedback) {
        // Return the feedback data as a JSON response
        echo json_encode($feedback);
    } else {
        // Return an error message if no feedback found for the provided user_id
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'No feedback found for the provided user_id.'));
    }
} else {
    // Return an error message if user_id is not provided or invalid
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide a valid user_id.'));
}
?>
