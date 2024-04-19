<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');
$request_body = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($request_body, true);
if (isset($data['food_id'])) {
  
    $food = new Food($db);
    $food->food_id = intval($data['food_id']);
    print_r($food);
    
    // Call the getFoodDetails method
    $stmt = $food->getFoodDetails();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Return the food details as a JSON response
        http_response_code(200); // OK
        echo json_encode($result);
    } else {
        // No food item found for the specified food ID
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Food item not found.'));
    }
} else {
    // Missing required 'food_id' field in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required field: food_id.'));
}

?>
