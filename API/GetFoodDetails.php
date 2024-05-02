<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database initialization and the Food class
include_once('../core/initialize.php');
$food = new Food($db);
$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['food_id'])) {
    // food_id property of the Food object
    $food->food_id = $data['food_id'];

    // Call the getFoodDetails method to retrieve the details of the food item
    $foodDetails = $food->getFoodDetails();

    // Check if the food item details were found
    if ($foodDetails !== false) {
        // Return the food item details as a JSON response
        echo json_encode($foodDetails);
    } else {
        // Return an error message if the food item was not found
        echo json_encode(array('message' => 'Food item not found'));
    }
} else {
    // Return an error message if 'food_id' is not provided in the request
    echo json_encode(array('message' => 'Please provide a food_id'));
}
?>
