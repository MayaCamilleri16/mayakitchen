<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database initialization and the EventFeedback class
include_once('../core/initialize.php');
$eventFeedback = new EventFeedback($db);


$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
// Check if event_id is provided and valid
if ($event_id > 0) {
    // Set the event_id property in the EventFeedback class
    $eventFeedback->event_id = $event_id;

    // Call the getEventFeedback function to retrieve feedback for the event
    $feedback = $eventFeedback->getEventFeedback();

    // Check if feedback exists
    if ($feedback) {
        // Return the feedback as a JSON response
        echo json_encode($feedback);
    } else {
        // Return a 404 Not Found response if no feedback exists for the event
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['message' => 'No feedback found for this event']);
    }
} else {
    // Return a 400 Bad Request response if event_id is not provided or invalid
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['message' => 'Invalid or missing event_id']);
}
?>
