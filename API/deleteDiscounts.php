<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

// Initialize Discounts object
$discount = new Discounts($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->id)) {
    $discount->id = $data->id;

    // Attempt to delete the discount
    if ($discount->delete()) {
        echo json_encode(array('message' => 'Discount deleted'));
    } else {
        echo json_encode(array('message' => 'Failed to delete discount'));
    }
} else {
    // ID is not provided in the request
    echo json_encode(array('message' => 'Discount ID is required'));
}

?>
