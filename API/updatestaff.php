<?php

// Required headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/staffwork.php');
include_once('../core/Initialize.php');


$staff = new Staff($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->staff_id) && !empty($data->username) && !empty($data->email) && !empty($data->password) && !empty($data->role)) {

    
    $staff->staff_id = $data->staff_id;
    $staff->username = $data->username;
    $staff->email = $data->email;
    $staff->password = $data->password;
    $staff->role = $data->role;

    // Update staff member
    if ($staff->update()) {
        // Set response code - 200 OK
        http_response_code(200);

        // Tell the user
        echo json_encode(array('message' => 'Staff member updated.'));
    } else {
        // Set response code - 503 service unavailable
        http_response_code(503);

        // Tell the user
        echo json_encode(array('message' => 'Unable to update staff member.'));
    }
} else {
    // Set response code - 400 bad request
    http_response_code(400);

    // Tell the user about missing fields
    echo json_encode(array('message' => 'Unable to update staff member. Please provide staff_id, username, email, password, and role.'));
}

?>
