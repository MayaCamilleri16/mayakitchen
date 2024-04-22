<?php
//  requests from any origin
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include database initialization and Tables class
include_once('../core/initialize.php');
include_once('../core/tables.php');

//instance of the Tables class
$table = new Tables($db);

// Get the raw DELETE data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if the 'table_id' property is set in the request data
if (isset($data->table_id)) {
    // Set the 'table_id' property of the table instance
    $table->table_id = $data->table_id;

    // Attempt to delete the table
    if ($table->delete()) {
        // Return a success message
        echo json_encode(array('message' => 'Table deleted successfully.'));
    } else {
        // Return an error message
        echo json_encode(array('message' => 'Failed to delete table.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required data.'));
}
?>
