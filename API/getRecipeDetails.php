<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['recipe_id'])) {
    $recipe = new Recipes($db);
    $recipe->recipe_id = intval($data['recipe_id']);

    // Call the getRecipeDetails method to retrieve the recipe details from the database
    $recipeDetails = $recipe->getRecipeDetails();

    // If the recipe details are retrieved successfully
    if ($recipeDetails) {
        // Return a 200 OK response with the recipe details in JSON format
        http_response_code(200); // OK
        echo json_encode($recipeDetails);
    } else {
        // If the recipe is not found, return a 404 Not Found response
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Recipe not found.'));
    }
} else {
    // Missing the required field (recipe_id) in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required field (recipe_id) in the request body.'));
}
?>
