<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');



$food = new Food($db);


$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

if (isset($data['food_id'])) {
    // Retrieve the food ID from the request data
    $food->food_id = intval($data['food_id']);

    // Attempt to delete the food item
    if ($food->delete()) {
        // Food item deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Food item deleted successfully.'));
    } else {
        // Failed to delete the food item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete food item.'));
    }
} else {
    // Missing food ID in the request
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Food ID is required in the request body.'));
}

?>
