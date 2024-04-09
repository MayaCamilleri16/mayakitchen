<?php
//allow cross-origin requests from any origin, specify the content type as JSON, permit the use of the PUT method, and define the allowed headers for CORS requests.
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');

$booking = new Booking($db);
$data = json_decode(file_get_contents('php://input'));

$booking->id = $data->id;

// Cancel booking
if ($booking->cancel()) {
    echo json_encode(array('message' => 'Booking canceled'));
} else {
    echo json_encode(array('message' => 'Booking not canceled'));
}
?>
