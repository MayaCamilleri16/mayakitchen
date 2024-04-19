<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['user_id']) && isset($data['points']) && isset($data['discount_id'])) {
    // a new instance of the LoyaltyProgram class
    $loyaltyProgram = new LoyaltyProgram($db);
    
    // the LoyaltyProgram properties from the request body data
    $loyaltyProgram->user_id = intval($data['user_id']);
    $loyaltyProgram->points = intval($data['points']);
    $loyaltyProgram->discount_id = intval($data['discount_id']);
    
    // Call the update method to update the loyalty program data in the database
    if ($loyaltyProgram->update()) {
        // If the update is successful, return a 200 OK response with a success message
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Loyalty program updated successfully.'));
    } else {
        // If an error occurred during the update, return a 500 Internal Server Error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update loyalty program.'));
    }
} else {
    // Missing one or more required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields in the request body.'));
}

?>
