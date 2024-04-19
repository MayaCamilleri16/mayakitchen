<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Create a new Drinks object
$drink = new Drinks($db);

// Get the request body
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Check if the drink ID is provided
if (isset($data['drink_id'])) {
    // Retrieve the drink ID from the request body
    $drink->drink_id = intval($data['drink_id']);

    // Attempt to delete the drink item
    if ($drink->delete()) {
        // Drink item deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Drink item deleted successfully.'));
    } else {
        // Failed to delete the drink item
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete drink item.'));
    }
} else {
    // Missing drink ID in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Drink ID is required in the request body.'));
}

?>
