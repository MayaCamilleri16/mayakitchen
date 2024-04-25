<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// database initialization
include_once('../core/initialize.php');

// instance of the UserOrdersApp class
$userOrdersApp = new UserOrdersApp($db);
$data = json_decode(file_get_contents('php://input'));

// Get query parameters from the request
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// Check if both order_id and user_id are provided
if ($order_id === null || $user_id === null) {
    // Return an error message if either order_id or user_id is missing
    echo json_encode(array('message' => 'Please provide both order_id and user_id.'));
    http_response_code(400);
    exit();
}

// Fetch user order details using the provided parameters
$orderDetails = $userOrdersApp->getUserOrderDetails($order_id, user_id);

// Check if any order details were found
if ($orderDetails) {
    // Return the order details as a JSON response
    echo json_encode($orderDetails);
} else {
    // Return an error message if no details were found
    echo json_encode(array('message' => 'No order details found for the given order_id or user_id.'));
    http_response_code(404);
}
?>
