<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); 
    echo json_encode(array('message' => 'Method Not Allowed'));
    exit();
}


$data = json_decode(file_get_contents('php://input'));

// Check if all required fields are provided
if (!isset($data->name) || !isset($data->discount_percentage) || !isset($data->valid_until)) {
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide name, discount_percentage, and valid_until.'));
    exit();
}

// Create a new instance of SpecialOffers
$specialOffers = new SpecialOffers($db);

// Set the offer details from the request data
$specialOffers->name = $data->name;
$specialOffers->discount_percentage = $data->discount_percentage;
$specialOffers->valid_until = $data->valid_until;

// Attempt to create the special offer
if ($specialOffers->create()) {
    http_response_code(201); // Created
    echo json_encode(array('message' => 'Special offer created.'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Unable to create special offer.'));
}

?>
