<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Initialize Orders object
$orders = new Orders($db);

// Attempt to view pending orders
$pendingOrders = $orders->viewPendingOrders();

if ($pendingOrders !== null) {
    // Pending orders found
    http_response_code(200); // OK
    echo json_encode($pendingOrders);
} else {
    // No pending orders found or error occurred
    http_response_code(404); // Not Found
    echo json_encode(array('message' => 'No pending orders found.'));
}

?>
