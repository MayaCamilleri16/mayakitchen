<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../core/initialize.php');
include_once('../core/tables.php');


$table = new Tables($db);
$data = json_decode(file_get_contents('php://input'));

// Check if the required properties are set in the request data
if (isset($data->table_id) && isset($data->number) && isset($data->available)) {
    // Set the properties of the table instance
    $table->table_id = $data->table_id;
    $table->number = $data->number;
    $table->available = $data->available;

    // Attempt to update the table
    if ($table->update()) {
        // Return a success message
        echo json_encode(array('message' => 'Table updated successfully.'));
    } else {
        // Return an error message
        echo json_encode(array('message' => 'Failed to update table.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required data.'));
}
?>
