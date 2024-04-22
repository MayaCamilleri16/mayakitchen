<?php
//requests from any origin and set the content type to JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include necessary files
include_once('../core/initialize.php'); // Adjust the path as needed
include_once('../core/staff_shift.php');

// Create an instance of the StaffShift class
$staffShift = new StaffShift($db);

// Get the raw PUT data from the request
$data = json_decode(file_get_contents('php://input'));

// Check if all required properties are provided
if (isset($data->id) && isset($data->staff_id) && isset($data->start_time) && isset($data->end_time) && isset($data->date)) {
    // Set the properties of the StaffShift instance
    $staffShift->id = $data->id;
    $staffShift->staff_id = $data->staff_id;
    $staffShift->start_time = $data->start_time;
    $staffShift->end_time = $data->end_time;
    $staffShift->date = $data->date;

    // Attempt to update the staff shift entry
    if ($staffShift->update()) {
        // Return a success message if the update was successful
        echo json_encode(array('message' => 'Staff shift updated successfully.'));
    } else {
        // Return an error message if the update failed
        echo json_encode(array('message' => 'Staff shift update failed.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required fields.'));
}
?>
