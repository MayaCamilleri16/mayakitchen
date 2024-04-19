<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

if (isset($data['user_id'])) {
    $user_id = intval($data['user_id']);
    

    $loyalty_program = new LoyaltyProgram($db);
    $loyalty_program->user_id = $user_id;


    if ($loyalty_program->delete()) {
        // If deletion is successful, return a 200 OK response with a success message
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Loyalty program entry deleted successfully.'));
    } else {
        // If an error occurred during deletion, return a 500 Internal Server Error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete loyalty program entry.'));
    }
} else {
    // 'user_id' is missing in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing user_id in the request body.'));
}

?>
