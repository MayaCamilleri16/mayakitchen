<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['user_id']) && isset($data['points']) && isset($data['discount_id'])) {
    // new instance of the LoyaltyProgram class
    $loyalty = new LoyaltyProgram($db);

    //the properties for the new loyalty program entry
    $loyalty->user_id = intval($data['user_id']);
    $loyalty->points = intval($data['points']);
    $loyalty->discount_id = intval($data['discount_id']);

    //the create method to insert the new entry into the database
    if ($loyalty->create()) {
        // If the creation is successful, return a 201 Created response with a success message
        http_response_code(201); // HTTP status code 201 - Created
        echo json_encode(array('message' => 'Loyalty program entry created successfully.'));
    } else {
        // If an error occurred during creation, return a 500 Internal Server Error response
        http_response_code(500); // HTTP status code 500 - Internal Server Error
        echo json_encode(array('message' => 'Failed to create loyalty program entry.'));
    }
} else {
    // If any required fields are missing in the request body, return a 400 Bad Request response
    http_response_code(400); // HTTP status code 400 - Bad Request
    echo json_encode(array('message' => 'Missing required fields in the request body.'));
}

?>
