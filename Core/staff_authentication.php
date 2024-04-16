<?php

// Include necessary files
include_once('../core/initialize.php');
include_once('../core/authentication.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

   
    if (isset($data->username) && isset($data->password)) {
    
        $query = 'SELECT * FROM staff WHERE username = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$data->username]);
        $staff = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($staff && password_verify($data->password, $staff['password'])) {
            // Staff member is authenticated, create a session token
            $session_token = bin2hex(random_bytes(16)); // Generate a random session token
            $_SESSION['user_id'] = $staff['staff_id']; // Set the user ID in the session

            // Insert the session token into the database
            $query = 'INSERT INTO sessions (user_id, session_token) VALUES (?, ?)';
            $stmt = $db->prepare($query);
            $stmt->execute([$staff['staff_id'], $session_token]);

            // Return the session token to the client
            http_response_code(200); // OK
            echo json_encode(array('message' => 'Authentication successful', 'session_token' => $session_token));
        } else {
            // Staff member authentication failed
            http_response_code(401); // Unauthorized
            echo json_encode(array('message' => 'Invalid username or password'));
        }
    } else {
        // Username or password not provided
        http_response_code(400); // Bad Request
        echo json_encode(array('message' => 'Both username and password are required'));
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Only POST method is allowed'));
}

?>
