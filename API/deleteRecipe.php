<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

// Get the request body
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['recipe_id'])) {
    $recipe = new Recipes($db);
    $recipe->recipe_id = intval($data['recipe_id']);

    // Call the delete method to delete the recipe from the database
    if ($recipe->delete()) {
        // If the its successful, return a 200 OK response with a success message
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Recipe deleted successfully.'));
    } else {
        // If an error occurred during deletion, return a 500 Internal Server Error response
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to delete recipe.'));
    }
} else {
    // Missing the required field (recipe_id) in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required field (recipe_id) in the request body.'));
}
?>
