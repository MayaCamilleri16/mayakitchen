<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');


$review = new Reviews($db);
$review->id = isset($_GET['id']) ? $_GET['id'] : die();

// Delete review
if ($review->delete()) {
    echo json_encode(array('message' => 'Review deleted.'));
} else {
    echo json_encode(array('message' => 'Review not deleted.'));
}
