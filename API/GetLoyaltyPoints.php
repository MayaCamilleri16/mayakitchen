<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database initialization 
include_once('../core/initialize.php');

// Instantiate LoyaltyProgram object
$loyaltyProgram = new LoyaltyProgram($db);

// Decode JSON data from the request body
$data = json_decode(file_get_contents('php://input'), true);

// Check if the 'user_id' parameter is provided in the request
if (isset($data['user_id'])) {
    // Set the user_id property of the LoyaltyProgram object
    $loyaltyProgram->user_id = $data['user_id'];

    // Call the getLoyaltyPoints method to retrieve the points for the given user_id
    $points = $loyaltyProgram->getLoyaltyPoints();

    // Check if points were retrieved successfully
    if ($points !== null) {
        // Return the loyalty points in a JSON response
        echo json_encode(array('user_id' => $data['user_id'], 'points' => $points));
    } else {
        // Return an error message if points were not found for the given user_id
        echo json_encode(array('message' => 'No loyalty points found for the given user_id'));
    }
} else {
    // Return an error message if 'user_id' is not provided in the request
    echo json_encode(array('message' => 'Please provide a user_id'));
}
?>
