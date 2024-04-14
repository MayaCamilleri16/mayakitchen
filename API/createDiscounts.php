<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

// Initialize Discounts object
$discount = new Discounts($db);

// Get JSON data from the request
$data = json_decode(file_get_contents('php://input'));

// Set discount properties
$discount->code = $data->code;
$discount->percentage = $data->percentage;
$discount->expiry_date = $data->expiry_date;

// Create discount
if ($discount->create()) {
    echo json_encode(array('message' => 'Discount created'));
} else {
    echo json_encode(array('message' => 'Discount not created'));
}

?>
