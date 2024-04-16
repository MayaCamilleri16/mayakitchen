<?php

// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/staffwork.php');
include_once('../core/Initialize.php');

$staff = new Staff($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->username) && !empty($data->email) && !empty($data->password) && !empty($data->role)) {
    // Set properties from the decoded data
    $staff->username = $data->username;
    $staff->email = $data->email;
    $staff->password = $data->password;
    $staff->role = $data->role;

    // Create staff
    if ($staff->create()) {
        // Set response code - 201 created
        http_response_code(201);

        // Tell the user
        echo json_encode(array('message' => 'Staff created.'));
    } else {
        // Set response code - 503 service unavailable
        http_response_code(503);

        // Tell the user
        echo json_encode(array('message' => 'Staff not created.'));
    }
} else {
    // Set response code - 400 bad request
    http_response_code(400);

    // Tell the user about missing fields
    echo json_encode(array('message' => 'Unable to create staff. Please provide username, email, password, and role.'));
}

?>
