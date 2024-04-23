<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

//an instance of the AppOrders class
$order = new AppOrders($db);

// Get the JSON input data
$data = json_decode(file_get_contents('php://input'));

// Check if all required fields are provided
if (
    !empty($data->order_id) &&
    !empty($data->user_id) &&
    !empty($data->order_date) &&
    !empty($data->total_price) &&
    !empty($data->status) &&
    !empty($data->delivery_type)
) {
    // Set order properties from the input data
    $order->order_id = htmlspecialchars(strip_tags($data->order_id));
    $order->user_id = htmlspecialchars(strip_tags($data->user_id));
    $order->order_date = htmlspecialchars(strip_tags($data->order_date));
    $order->total_price = htmlspecialchars(strip_tags($data->total_price));
    $order->status = htmlspecialchars(strip_tags($data->status));
    $order->delivery_type = htmlspecialchars(strip_tags($data->delivery_type));
    
    // Update the order
    if ($order->update()) {
        // Order updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Order updated successfully.'));
    } else {
        // Failed to update order
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Unable to update order.'));
    }
} else {
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide all required fields.'));
}

?>
