<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


$GetLoyaltyPoints = new LoyaltyProgram ($db);
$data = json_decode(file_get_contents('php://input'));

if (isset($request_params['user_id'])) {
    $user_id = intval($request_params['user_id']);

    $loyalty_program = new LoyaltyProgram($db);
    $loyalty_program->user_id = $user_id;

    
    $result = $loyalty_program->getLoyaltyDetails();
    
    // if the result is not empty
    if ($result) {
        // If successful, return a 200 OK response with the loyalty program details
        http_response_code(200); // OK
        echo json_encode($result);
    } else {
        // If no data is found, return a 404 Not Found response
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'No loyalty program entry found for the provided user ID.'));
    }
} else {
    //  missing in the request parameters
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing user_id in the request parameters.'));
}

?>
