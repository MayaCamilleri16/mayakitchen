<?php
// Allow requests from any origin
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Allow certain HTTP methods
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database initialization and OrderItems class
include_once('../core/initialize.php');


// Create an instance of the OrderItems class
$orderItems = new OrderItems($db);

// Get the raw POST data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if the required properties are set in the request data
if (
    isset($data->order_id) &&
    (isset($data->food_id) || isset($data->drink_id)) &&
    isset($data->quantity_food) &&
    isset($data->quantity_drink) &&
    isset($data->discount_id)
) {
    // Set the properties of the OrderItems instance
    $orderItems->order_id = $data->order_id;
    $orderItems->food_id = $data->food_id;
    $orderItems->drink_id = $data->drink_id;
    $orderItems->quantity_food = $data->quantity_food;
    $orderItems->quantity_drink = $data->quantity_drink;
    $orderItems->discount_id = $data->discount_id;

    // Attempt to create the order
    if ($orderItems->create()) {
        // Return a success message
        echo json_encode(array('message' => 'Order created successfully.'));
    } else {
        // Return an error message
        echo json_encode(array('message' => 'Failed to create order.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required data.'));
}
?>
