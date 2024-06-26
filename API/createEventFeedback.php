<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');


$eventFeedback = new EventFeedback($db);
$data = json_decode(file_get_contents('php://input'));

// Check if required data is provided
if (
    !empty($data->event_id) &&
    !empty($data->user_id) &&
    !empty($data->comment) &&
    !empty($data->time) &&
    !empty($data->rating)
) {
    // Validate event_id
    $event_id = htmlspecialchars(strip_tags($data->event_id));

    // Query to check if event_id exists in event_management table
    $query = 'SELECT COUNT(*) FROM event_management WHERE event_id = :event_id';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();
    $eventExists = $stmt->fetchColumn() > 0;

    if (!$eventExists) {
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Invalid event ID.'));
        exit;
    }

    // Set feedback properties
    $eventFeedback->event_id = $event_id;
    $eventFeedback->user_id = htmlspecialchars(strip_tags($data->user_id));
    $eventFeedback->comment = htmlspecialchars(strip_tags($data->comment));
    $eventFeedback->time = htmlspecialchars(strip_tags($data->time));
    $eventFeedback->rating = htmlspecialchars(strip_tags($data->rating));

    // Attempt to create the feedback
    try {
        if ($eventFeedback->createFeedback()) {
            // Feedback created successfully
            http_response_code(201); // Created
            echo json_encode(array('message' => 'Feedback created successfully.'));
        } else {
            // Failed to create feedback
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Unable to create feedback.'));
        }
    } catch (PDOException $e) {
        // Handle foreign key constraint violation or other database errors
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Invalid event ID or data error: ' . $e->getMessage()));
    }
} else {
    // Missing required data
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide all required fields.'));
}

?>
