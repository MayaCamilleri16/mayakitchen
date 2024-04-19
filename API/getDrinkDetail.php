<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../core/initialize.php');

$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);


if (isset($data['drink_id'])) {

    $drink = new Drinks($db);
    $drink->drink_id = intval($data['drink_id']);
    
    // Retrieve drink details
    $stmt = $drink->getDrinkDetails();
    

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Return the drink details as a JSON response
        http_response_code(200); // OK
        echo json_encode($result);
    } else {
        // No drink found for the specified drink ID
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'Drink not found.'));
    }
} else {
    // Missing required 'drink_id' field in the request body
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing required field: drink_id.'));
}

?>
