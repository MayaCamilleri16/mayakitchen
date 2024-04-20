<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');


$dailySpecials = new DailySpecials($db);
$data = json_decode(file_get_contents('php://input'));

// Check if the required ID is provided in the request data
if (!empty($data->id)) {
    // Set the ID of the daily special to be deleted
    $dailySpecials->id = $data->id;

    // Attempt to delete the daily special
    if ($dailySpecials->delete()) {
        // Daily special deleted successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Daily special deleted successfully.'));
    } else {
        // Failed to delete daily special
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete daily special.'));
    }
} else {
    // ID not provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide id.'));
}
?>
