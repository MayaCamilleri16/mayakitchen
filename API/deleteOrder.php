<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');


$order = new Orders($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->order_id)) {
    // Set order properties
    $order->order_id = htmlspecialchars(strip_tags($data->order_id));

    // Attempt to delete the order
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
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide the order ID.'));
}
?>
