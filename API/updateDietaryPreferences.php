<?php

// Allow cross-origin requests from any origin
header('Access-Control-Allow-Origin: *');
// Specify the content type as JSON
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Instantiate UserPreferences object
$userPreferences = new UserPreferences($db);
$data = json_decode(file_get_contents('php://input'));

// Check if preferences_id and preference_name fields exist in the JSON data
if (isset($data->preferences_id) && isset($data->preference_name)) {
    // Set preferences_id and preference_name
    $userPreferences->preferences_id = $data->preferences_id;
    $userPreferences->preference_name = $data->preference_name;

    // Update dietary preference
    if ($userPreferences->update()) {
        echo json_encode(array('message' => 'Dietary preference updated'));
    } else {
        echo json_encode(array('message' => 'Failed to update dietary preference'));
    }
} else {
    // Return error message if required fields are missing
    echo json_encode(array('message' => 'Preferences ID and preference name are required'));
}

?>
