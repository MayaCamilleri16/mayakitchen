<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

// Create a new Reviews instance
$reviews = new Reviews($db);
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Retrieve the user reviews
$reviewsList = $reviews->getUserReviews();

// Check if reviews were found
if (count($reviewsList) > 0) {
    // Set the response code to 200 OK
    http_response_code(200);
    
    // Output the reviews list as JSON
    echo json_encode($reviewsList);
} else {
    // Set the response code to 404 Not Found
    http_response_code(404);
    
    // Output a message indicating that no reviews were found
    echo json_encode(array("message" => "No reviews found."));
}

?>
