<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


// Instantiate the ServeOrderFeedback class
$feedback = new ServeOrderFeedback($db);

//  JSON data from the request body
$data = json_decode(file_get_contents('php://input'));

// Check if the required fields , order_id, rating, and comment are provided in the request data
if (!empty($data->order_id) && !empty($data->rating) && !empty($data->comment)) {
    // Set the properties of the ServeOrderFeedback class based on the request data
    $feedback->order_id = $data->order_id;
    $feedback->rating = $data->rating;
    $feedback->comment = $data->comment;

    // Attempt to create a new feedback entry
    if ($feedback->create()) {
        // Feedback entry created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Feedback entry created successfully.'));
    } else {
        // Failed to create feedback entry
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to create feedback entry.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide order_id, rating, and comment.'));
}
?>
