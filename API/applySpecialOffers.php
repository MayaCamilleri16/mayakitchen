<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');


$user = new User($db);
$data = json_decode(file_get_contents('php://input'));

// Check if offer_id is provided
if (!empty($data->offer_id)) {
    $offer_id = $data->offer_id;

    // Attempt to apply the special offer
    if ($user->applySpecialOffer($offer_id)) {
        // Offer applied successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Special offer applied successfully.'));
    } else {
        // Failed to apply special offer
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Special offer not found or could not be applied.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide offer_id.'));
}

?>
