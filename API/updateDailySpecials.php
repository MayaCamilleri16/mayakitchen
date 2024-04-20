<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');
$dailySpecials = new DailySpecials($db);


$data = json_decode(file_get_contents('php://input'));


if (!empty($data->id) && !empty($data->date) && !empty($data->food_special) && !empty($data->price) && !empty($data->description)) {
    // properties of the DailySpecials class based on the request data
    $dailySpecials->id = $data->id;
    $dailySpecials->date = $data->date;
    $dailySpecials->food_special = $data->food_special;
    $dailySpecials->price = $data->price;
    $dailySpecials->description = $data->description;

    // Attempt to update the daily special
    if ($dailySpecials->update()) {
        // Daily special updated successfully
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Daily special updated successfully.'));
    } else {
        // Failed to update daily special
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update daily special.'));
    }
} else {
    // Incomplete data provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Incomplete data. Please provide id, date, food_special, price, and description.'));
}
?>
