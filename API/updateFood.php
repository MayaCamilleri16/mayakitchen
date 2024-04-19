<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$food = new Food($db);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['food_id']) && isset($data['name']) && isset($data['price']) && isset($data['extra'])) {

    $food->food_id = intval($data['food_id']);
    $food->name = $data['name'];
    $food->price = floatval($data['price']);
    $food->extra = $data['extra'];

    // Attempt to update the food item
    if ($food->update()) {
        // Food item updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Food item updated successfully.'));
    } else {
        // Failed to update the food item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update food item.'));
    }
} else {
    // Missing required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields: food_id, name, price, extra.'));
}

?>
