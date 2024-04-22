<?php
// requests from any origin
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Allow certain HTTP methods
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database initialization and Tables class
include_once('../core/initialize.php');
include_once('../core/tables.php');

// Create an instance of the Tables class
$table = new Tables($db);

// Get the raw PUT data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if the required properties are set in the request data
if (isset($data->table_id) && isset($data->number)) {
    // Set the properties of the table instance
    $table->table_id = $data->table_id;
    $table->number = $data->number;

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
