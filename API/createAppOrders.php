<?php
//  headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');


// Instantiate the AppOrders class
$order = new AppOrders($db);

// Get the input data from the request
$data = json_decode(file_get_contents('php://input'), true);
if (
    isset($data['user_id']) &&
    isset($data['order_date']) &&
    isset($data['total_price']) &&
    isset($data['status']) &&
    isset($data['delivery_type'])
) {
    // Sanitize the input data
    $order->user_id = htmlspecialchars(strip_tags($data['user_id']));
    $order->order_date = htmlspecialchars(strip_tags($data['order_date']));
    $order->total_price = htmlspecialchars(strip_tags($data['total_price']));
    $order->status = htmlspecialchars(strip_tags($data['status']));
    $order->delivery_type = htmlspecialchars(strip_tags($data['delivery_type']));

    // Call the create method to create a new order in the database
    if ($order->create()) {
        // Order was created successfully, return a 201 status code (Created)
        http_response_code(201);
        echo json_encode(array('message' => 'Order created successfully.'));
    } else {
        // Order creation failed, return a 500 status code (Internal Server Error)
        http_response_code(500);
        echo json_encode(array('message' => 'Unable to create order.'));
    }
} else {
    // Missing required fields, return a 400 status code (Bad Request)
    http_response_code(400);
    echo json_encode(array('message' => 'Incomplete data. Please provide all required fields.'));
}
?>
