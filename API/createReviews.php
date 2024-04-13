<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/Initialize.php');


$review = new Reviews($db);
$data = json_decode(file_get_contents('php://input'));


$review->user_id = $data->user_id;
$review->rating = $data->rating;
$review->comment = $data->comment;
$review->time = $data->time;

// Create review
if ($review->create()) {
    echo json_encode(array('message' => 'Review created.'));
} else {
    echo json_encode(array('message' => 'Review not created.'));
}
