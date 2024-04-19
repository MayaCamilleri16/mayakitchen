<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');
$food = new Food($db);

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Check if the necessary data is provided
if (isset($data['name']) && isset($data['price']) && isset($data['extra'])) {
    // Retrieve data from the request body
    $food->name = $data['name'];
    $food->price = floatval($data['price']);
    $food->extra = $data['extra'];

    // Attempt to create the food item
    if ($food->create()) {
        // Food item created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Food item created successfully.'));
    } else {
        // Failed to create the food item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to create food item.'));
    }
} else {
    // Missing required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields: name, price, extra.'));
}

?>
