<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

$review = new Reviews($db);
$data = json_decode(file_get_contents('php://input'));

$review->id = $data->id;
$review->user_id = $data->user_id;
$review->rating = $data->rating;
$review->comment = $data->comment;

// Update review
if ($review->update()) {
    echo json_encode(array('message' => 'Review updated.'));
} else {
    echo json_encode(array('message' => 'Review not updated.'));
}
