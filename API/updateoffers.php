<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$specialOffers = new SpecialOffers($db);
$data = json_decode(file_get_contents('php://input'));

// Check if all required fields are provided
if (!isset($data->offer_id) || !isset($data->name) || !isset($data->discount_percentage) || !isset($data->valid_until)) {
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide offer_id, name, discount_percentage, and valid_until.'));
    exit();
}

// Set the offer details from the request data
$specialOffers->offer_id = $data->offer_id;
$specialOffers->name = $data->name;
$specialOffers->discount_percentage = $data->discount_percentage;
$specialOffers->valid_until = $data->valid_until;

// Attempt to update the special offer
if ($specialOffers->update()) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Special offer updated.'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Unable to update special offer.'));
}

?>
