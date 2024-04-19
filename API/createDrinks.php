<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



include_once('../core/initialize.php');
$drink = new Drinks($db);

// Get the request body
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Check if the necessary data is provided
if (isset($data['name']) && isset($data['price'])) {
    // Retrieve data from the request body
    $drink->name = $data['name'];
    $drink->price = floatval($data['price']);

    // Attempt to create the drink item
    if ($drink->create()) {
        // Drink item created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Drink item created successfully.'));
    } else {
        // Failed to create the drink item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to create drink item.'));
    }
} else {
    // Missing required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields: name, price.'));
}

?>
