<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$order_id = isset($data->order_id) ? intval($data->order_id) : 0;

if ($order_id > 0) {
    $feedback->order_id = $order_id;
    
    // Call the getUserOrderFeedback function
    $feedbacks = $feedback->getUserOrderFeedback();
    
    // Check if any feedback is found
    if (!empty($feedbacks)) {
        // Return the feedbacks as a JSON response
        echo json_encode($feedbacks);
    } else {
        // Return a 404 Not Found response if no feedback is found
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['message' => 'No feedback found for this order']);
    }
} else {
    // Return a 400 Bad Request response if order_id is not provided or invalid
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['message' => 'Invalid or missing order_id']);
}
?>