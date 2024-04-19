<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$request_body = file_get_contents('php://input');


$data = json_decode($request_body, true);

// Check if the necessary fields are provided
if (isset($data['recipe_name']) && isset($data['prep_time_minutes']) &&
    isset($data['total_time_minutes']) && isset($data['servings']) &&
    isset($data['meal_type']) && isset($data['instructions'])) {

    // Create a new instance of the Recipe class
    $recipe = new Recipes($db);
    $recipe->recipe_name = htmlspecialchars(strip_tags($data['recipe_name']));
    $recipe->prep_time_minutes = intval($data['prep_time_minutes']);
    $recipe->total_time_minutes = intval($data['total_time_minutes']);
    $recipe->servings = intval($data['servings']);
    $recipe->meal_type = htmlspecialchars(strip_tags($data['meal_type']));
    $recipe->instructions = htmlspecialchars(strip_tags($data['instructions']));
    $recipe->cook_time_minutes = intval($data['cook_time_minutes']);

    // Call the create method to insert the new recipe into the database
    if ($recipe->create()) {
        // If the creation is successful, return a 201 Created response with a success message
        http_response_code(201); // Created
        echo json_encode(array('message' => 'Recipe created successfully.'));
    } else {
        // If an error occurred during creation, return a 500 Internal Server Error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to create recipe.'));
    }
} else {
    // Missing one or more required fields in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required fields in the request body.'));
}
?>
