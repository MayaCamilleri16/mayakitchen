<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

// Initialize Orders object
$orders = new Orders($db);

// Get data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if required data is provided
if (!empty($data->user_id) && !empty($data->table_number) && !empty($data->food_id)) {
    // Set the data from the request
    $orders->user_id = $data->user_id;
    $orders->table_number = $data->table_number;
    $orders->food_id = $data->food_id;

    // Attempt to place food orders
    if ($orders->placeFoodOrders()) {
        // Food orders placed successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Food orders placed successfully.'));
    } else {
        // Failed to place food orders
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to place food orders.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide user_id, table_number, and food_id.'));
}

?>
