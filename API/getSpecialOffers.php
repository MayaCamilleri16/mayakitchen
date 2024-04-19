<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

// Get the request body
$request_body = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($request_body, true);

// Check if the queryString property exists
if (isset($data['queryString'])) {
    // Get the SQL query string
    $query = $data['queryString'];

    // Prepare and execute the query
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        // Return the results
        http_response_code(200); // OK
        echo json_encode($result);
    } else {
        // No results found
        http_response_code(404); // Not Found
        echo json_encode(array('message' => 'No results found.'));
    }
} else {
    // queryString property not provided
    http_response_code(400); // Bad Request
    echo json_encode(array('message' => 'Missing queryString property in the request body.'));
}

?>
