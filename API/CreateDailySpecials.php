<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$dailySpecials = new DailySpecials($db);
$data = json_decode(file_get_contents('php://input'));


if (!empty($data->date) && !empty($data->food_special) && !empty($data->price) && !empty($data->description)) {
    //  properties of the DailySpecials class based on the request data
    $dailySpecials->date = $data->date;
    $dailySpecials->food_special = $data->food_special;
    $dailySpecials->price = $data->price;
    $dailySpecials->description = $data->description;

    // Attempt to create a new daily special
    if ($dailySpecials->create()) {
        // Daily special created successfully
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Daily special created successfully.'));
    } else {
        // Failed to create daily special
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to create daily special.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide date, food_special, price, and description.'));
}

?>
