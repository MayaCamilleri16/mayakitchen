<?php

//header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Instantiate UserPreferences object
$userPreferences = new UserPreferences($db);

// Decode JSON data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if preferences_id field exists in the JSON data
if (isset($data->preferences_id)) {
    // Set preferences_id
    $userPreferences->preferences_id = $data->preferences_id;

    // Delete dietary preference
    if ($userPreferences->delete()) {
        echo json_encode(array('message' => 'Dietary preference deleted'));
    } else {
        echo json_encode(array('message' => 'Failed to delete dietary preference'));
    }
} else {
    // Return error message if required field is missing
    echo json_encode(array('message' => 'Preferences ID field is required'));
}

?>
