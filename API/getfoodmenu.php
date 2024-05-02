<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database initialization
include_once('../core/initialize.php');

$food = new Food($db);
$menu = $food->getFoodMenu();

// Check if there are food items in the menu
if ($menu) {
    // Return the food items as a JSON response
    echo json_encode($menu);
} else {
    // If no food items found, return an error message
    echo json_encode(array('message' => 'No food items found'));
}
?>
