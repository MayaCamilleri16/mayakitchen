<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Create a new User instance
$appOrders = new appOrders($db);
$data = json_decode(file_get_contents('php://input'));

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); 

    // Call the getOrderUpdate method to get order details
    $orderDetails = $user->getOrderUpdate($order_id);

    if ($orderDetails !== null) {
        // Order details found, output the order details as JSON
        header('Content-Type: application/json');
        echo json_encode($orderDetails);
    } else {
        // Order not found, output a JSON error message
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Order not found']);
    }
} else {
    // order_id not provided, output a JSON error message
    header('Content-Type: application/json');
    echo json_encode(['error' => 'order_id parameter is required']);
}
?>
