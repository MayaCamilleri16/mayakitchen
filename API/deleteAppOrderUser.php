<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// HTTP methods
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//database initialization 
include_once('../core/initialize.php');
//instance of the OrderItems class
$UserOrdersApp = new UserOrdersApp($db);

// Get the raw DELETE data from the request
$data = json_decode(file_get_contents('php://input'));

// to check if the required property is set in the request data
if (isset($data->order_id)) {
    // Set the order_id of the OrderItems instance
    $UserOrdersApp->order_id = $data->order_id;

    // Attempt to delete the order
    if ($UserOrdersApp->delete()) {
        // Return a success message
        echo json_encode(array('message' => 'Order deleted successfully.'));
    } else {
        // Return an error message
        echo json_encode(array('message' => 'Failed to delete order.'));
    }
} else {
    // Return an error message if required data is missing
    echo json_encode(array('message' => 'Missing required data.'));
}
?>
