<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');
$drink = new Drinks($db);


$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['drink_id']) && isset($data['name']) && isset($data['price'])) {
    // Retrieve data 
    $drink->drink_id = intval($data['drink_id']);
    $drink->name = $data['name'];
    $drink->price = floatval($data['price']);

    // Attempt to update the drink item
    if ($drink->update()) {
        // Drink item updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Drink item updated successfully.'));
    } else {
        // Failed to update the drink item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update drink item.'));
    }
} else {
    // Missing required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields: drink_id, name, price.'));
}

?>
