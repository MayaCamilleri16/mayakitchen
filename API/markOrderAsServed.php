<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

// Initialize Orders object
$orders = new Orders($db);

// Get data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if order_id is provided
if (!empty($data->order_id)) {
    // Set the order_id from the request data
    $order_id = $data->order_id;

    // Attempt to mark the order as served
    if ($orders->markOrderAsServed($order_id)) {
        // Order marked as served successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Order marked as served.'));
    } else {
        // Failed to mark order as served
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Order not found or could not be marked as served.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide order_id.'));
}

?>
