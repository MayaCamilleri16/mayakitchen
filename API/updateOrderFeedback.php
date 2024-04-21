<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


$feedback = new ServeOrderFeedback($db);

//  JSON data from the request body
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->serve_feedback_id) && !empty($data->order_id) && !empty($data->rating) && !empty($data->comment)) {
   
    $feedback->serve_feedback_id = $data->serve_feedback_id;
    $feedback->order_id = $data->order_id;
    $feedback->rating = $data->rating;
    $feedback->comment = $data->comment;

    // Attempt to update the feedback entry
    if ($feedback->update()) {
        // Feedback entry updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Feedback entry updated successfully.'));
    } else {
        // Failed to update feedback entry
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update feedback entry.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide serve_feedback_id, order_id, rating, and comment.'));
}
?>
