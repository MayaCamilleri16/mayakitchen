<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//database initialization
include_once('../core/initialize.php');

//an instance of the OrderItems class
$UserOrdersApp = new UserOrdersApp($db);

// Get the raw POST data from the request
$data = json_decode(file_get_contents('php://input'));


if (
    isset($data->order_id) &&
    isset($data->user_id) && 
    (isset($data->food_id) || isset($data->drink_id)) &&
    isset($data->quantity_food) &&
    isset($data->quantity_drink) &&
    isset($data->discount_id)
) {
    // Set the properties of the OrderItems instance
    $UserOrdersApp->order_id = $data->order_id;
    $UserOrdersApp->user_id = $data->user_id; 
    $UserOrdersApp->food_id = $data->food_id;
    $UserOrdersApp->drink_id = $data->drink_id;
    $UserOrdersApp->quantity_food = $data->quantity_food;
    $UserOrdersApp->quantity_drink = $data->quantity_drink;
    $UserOrdersApp->discount_id = $data->discount_id;

    // Attempt to create the order
    if ($UserOrdersApp->create()) {
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
