<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once('../core/initialize.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Method Not Allowed'));
    exit();
}

// Check if data is provided in the request body
$data = json_decode(file_get_contents('php://input'));

// Check if preference_name is provided
if (!isset($data->preference_name)) {
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Preference name is required.'));
    exit();
}

// Create a new instance of UserPreferences
$userPreferences = new UserPreferences($db);

// Set the preference_name from the request data
$userPreferences->preference_name = $data->preference_name;

// Attempt to create the user preference
if ($userPreferences->create()) {
    http_response_code(201); // Created
    echo json_encode(array('message' => 'User preference created.'));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array('message' => 'Unable to create user preference.'));
}

?>
