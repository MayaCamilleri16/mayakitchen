<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
$dailySpecials = new DailySpecials($db);


$data = json_decode(file_get_contents('php://input'));


if (!empty($data->id)) {
    //  the ID of the daily special to be retrieved
    $dailySpecials->id = $data->id;

    // Attempt to fetch the details of the daily special
    $specialDetails = $dailySpecials->readSingle();

    if ($specialDetails !== false) {
        // Daily special found, return the details
        http_response_code(200); // OK
        echo json_encode($specialDetails);
    } else {
        // No daily special found with the given ID
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Daily special not found.'));
    }
} else {
    // ID not provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide id.'));
}
?>
