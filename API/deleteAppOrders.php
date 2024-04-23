<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

//  instance of the AppOrders class
$order = new AppOrders($db);

// Get the JSON input data
$data = json_decode(file_get_contents('php://input'));

// Check if the required field (order_id) is provided
if (!empty($data->order_id)) {
    // Set the order_id property from the input data
    $order->order_id = htmlspecialchars(strip_tags($data->order_id));
    
    // Delete the order
    if ($order->delete()) {
        // Order deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Order deleted successfully.'));
    } else {
        // Failed to delete order
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Unable to delete order.'));
    }
} else {
    // Missing required data (order_id)
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide order_id.'));
}

?>
