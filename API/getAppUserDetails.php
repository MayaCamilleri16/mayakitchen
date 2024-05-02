<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//connection file
include_once('../core/initialize.php');


if (!empty($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    $appOrders = new AppOrders($db);
    $appOrders->order_id = $order_id;
    $orderDetails = $appOrders->getOrderDetails();

    // Check if order details are retrieved
    if ($orderDetails) {
        // Return the order details as JSON
        echo json_encode($orderDetails);
    } else {
        // Return a 404 Not Found response if order not found
        http_response_code(404);
        echo json_encode(array('message' => 'Order not found.'));
    }
} else {
    // Return a 400 Bad Request response if order_id is missing
    http_response_code(400);
    echo json_encode(array('message' => 'Incomplete data. Please provide a valid order_id.'));
}
?>
