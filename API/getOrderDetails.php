<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


$orders = new Orders($db);
$data = json_decode(file_get_contents('php://input'));

// Check if order_id is provided
if (!empty($data->order_id)) {
    // Set the order_id from the request data
    $order_id = $data->order_id;

    // Attempt to get order details
    $orderDetails = $orders->getOrderDetails($order_id);

    if ($orderDetails !== null) {
        // Order details found
        http_response_code(200); // OK
        echo json_encode($orderDetails);
    } else {
        // No order details found or error occurred
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'No order details found for the provided order_id.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide order_id.'));
}

?>
