<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

// Initialize Discounts object
$discount = new Discounts($db);

// Get JSON data from the request
$data = json_decode(file_get_contents('php://input'));

// Set discount properties
$discount->id = $data->id;
$discount->code = $data->code;
$discount->percentage = $data->percentage;
$discount->expiry_date = $data->expiry_date;

// Update discount
if ($discount->update()) {
    echo json_encode(array('message' => 'Discount updated'));
} else {
    echo json_encode(array('message' => 'Discount not updated'));
}

?>
