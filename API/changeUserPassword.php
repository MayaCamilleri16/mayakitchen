<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');




$user = new User($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->id) && !empty($data->new_password)) {
    // Set user ID and password
    $user->id = $data->id;
    $user->password = password_hash($data->new_password, PASSWORD_DEFAULT);

    // Attempt to update password
    if ($user->update_password()) {
        echo json_encode(array('message' => 'Password updated successfully'));
    } else {
        echo json_encode(array('message' => 'Failed to update password'));
    }
} else {
    echo json_encode(array('message' => 'Missing required data'));
}
