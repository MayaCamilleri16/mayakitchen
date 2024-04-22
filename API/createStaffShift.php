<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//database and StaffShift class
include_once('../core/initialize.php');
include_once('../core/staff_shift.php');

// Create an instance of the StaffShift class
$staffShift = new StaffShift($db);
$data = json_decode(file_get_contents('php://input'));

// Debugging: Check the contents of $data
var_dump($data);

if (!$data) {
    echo json_encode(array('message' => 'Invalid input data.'));
    exit();
}

// Set the properties of the Staff Shift instance from the incoming data
$staffShift->staff_id = $data->staff_id;
$staffShift->start_time = $data->start_time;
$staffShift->end_time = $data->end_time;
$staffShift->date = $data->date;

// Attempt to create a new staff shift entry
if ($staffShift->create()) {
    // Return a success message if the shift was created successfully
    echo json_encode(array('message' => 'Staff shift created successfully.'));
} else {
    // Return an error message if the creation failed
    echo json_encode(array('message' => 'Staff shift creation failed.'));
}
?>
