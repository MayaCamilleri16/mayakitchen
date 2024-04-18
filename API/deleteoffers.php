<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

$specialOffers = new SpecialOffers($db);
$data = json_decode(file_get_contents('php://input'));

// Set the offer_id from the request data
$specialOffers->offer_id = $data->offer_id;

// Attempt to delete the special offer
if ($specialOffers->delete()) {
    http_response_code(200); // OK
    echo json_encode(array('message' => 'Special offer deleted.'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Unable to delete special offer.'));
}

?>
