<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Allow certain HTTP methods
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database initialization 
include_once('../core/initialize.php');
include_once('../core/tables.php');

// Create an instance of the Tables class
$table = new Tables($db);

// Get the raw POST data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if the required properties are set in the request data
if (isset($data->number) && isset($data->available)) {
    // Set the 'number' and 'available' properties of the table instance
    $table->number = $data->number;
    $table->available = $data->available;

    // Attempt to create a new table
    if ($table->create()) {
        // Return a success message
        echo json_encode(array('message' => 'Table created successfully.'));
    } else {
        // Return an error message
        echo json_encode(array('message' => 'Failed to create table.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required data.'));
}
?>
