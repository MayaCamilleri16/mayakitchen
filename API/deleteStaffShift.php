<?php
//headers and classes
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../core/initialize.php');
include_once('../core/staff_shift.php');

//  instance of the StaffShift class
$staffShift = new StaffShift($db);

// Get the raw DELETE data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Validate the input data
if (isset($data['id']) && is_numeric($data['id'])) {
    // Set the id property of the StaffShift instance from the incoming data
    $staffShift->id = htmlspecialchars(strip_tags($data['id']));

    // Attempt to delete the staff shift entry
    if ($staffShift->delete()) {
        // Return a success message if the shift was deleted successfully
        echo json_encode(array('message' => 'Staff shift deleted successfully.'));
    } else {
        // Return an error message if the delete operation failed
        echo json_encode(array('message' => 'Staff shift delete failed.'));
    }
} else {
    // Return an error message if the required data is missing or invalid
    echo json_encode(array('message' => 'Invalid input data.'));
}
?>
