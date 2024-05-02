<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


$eventManagement = new EventManagement($db);
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Check if a valid user_id is provided
if ($user_id > 0) {
    // Set the user_id property in the EventManagement class
    $eventManagement->user_id = $user_id;

    // Call the viewUserEvents function
    $userEvents = $eventManagement->viewUserEvents();

    // Check if any events were found
    if ($userEvents) {
        // Return the events as a JSON response
        echo json_encode($userEvents);
    } else {
        // Return a 404 Not Found response if no events are found for the user
        http_response_code(404);
        echo json_encode(['message' => 'No events found for this user']);
    }
} else {
    // Return a 400 Bad Request response if user_id is not provided or invalid
    http_response_code(400);
    echo json_encode(['message' => 'Invalid or missing user_id']);
}
?>
