<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');

$order = new Orders($db);
$data = json_decode(file_get_contents('php://input'));


if (
    !empty($data->order_id) &&
    !empty($data->booking_id) &&
    !empty($data->food_id) &&
    !empty($data->drink_id) &&
    !empty($data->discount_id) &&
    !empty($data->table_id) &&
    !empty($data->offer_id)
) {

    $order->order_id = htmlspecialchars(strip_tags($data->order_id));
    $order->booking_id = htmlspecialchars(strip_tags($data->booking_id));
    $order->food_id = htmlspecialchars(strip_tags($data->food_id));
    $order->drink_id = htmlspecialchars(strip_tags($data->drink_id));
    $order->discount_id = htmlspecialchars(strip_tags($data->discount_id));
    $order->table_id = htmlspecialchars(strip_tags($data->table_id));
    $order->offer_id = htmlspecialchars(strip_tags($data->offer_id));

    // Attempt to update the order
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
