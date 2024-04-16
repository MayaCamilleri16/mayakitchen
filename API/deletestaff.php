<?php

// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include necessary files
include_once('../core/staffwork.php');
include_once('../core/Initialize.php');

// Instantiate Staff object
$staff = new Staff($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->staff_id)) {
    $staff->staff_id = $data->staff_id;

    // Attempt to delete staff member
    if ($staff->delete()) {
        // Set response code - 200 OK
        http_response_code(200);

        // Tell the user
        echo json_encode(array('message' => 'Staff member deleted.'));
    } else {
        // Set response code - 503 service unavailable
        http_response_code(503);

        // Tell the user
        echo json_encode(array('message' => 'Unable to delete staff member.'));
    }
} else {
    // Set response code - 400 bad request
    http_response_code(400);

    // Tell the user about missing staff_id
    echo json_encode(array('message' => 'Unable to delete staff member. Please provide staff_id.'));
}

?>
