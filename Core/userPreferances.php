<?php

// Allow cross-origin requests from any origin
header('Access-Control-Allow-Origin: *');
// Specify the content type as JSON
header('Content-Type: application/json');

include_once('../core/initialize.php');
include_once('../core/authentication.php');

class UserPreferences {
    private $conn;
    private $table = 'food_preferences';

    public $id;
    public $user_id;
    public $preference_name;
    private $authenticated; 
    private $authorized; 

    public function __construct($db) {
        $this->conn = $db;
        $this->authenticated = check_authentication(); 
    }

    public function create() {
        // Check if the user is authenticated
        if (!$this->authenticated) {
            
            // Return an error response
            echo json_encode(array('message' => 'Unauthorized'));
            http_response_code(401);
            exit();
        }

        // Check if the user has the necessary permissions
        if (!$this->authorized) { 
            echo json_encode(array('message' => 'Forbidden'));
            http_response_code(403);
            exit();
        }

        $query = 'INSERT INTO ' . $this->table . ' (preference_name) VALUES (:preference_name)';
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->preference_name = htmlspecialchars(strip_tags($this->preference_name));

        // Bind parameters
        $stmt->bindParam(':preference_name', $this->preference_name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if execution fails
        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET preference_name = :preference_name WHERE preferences_id = :preferences_id';

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->preferences_id = htmlspecialchars(strip_tags($this->preferences_id));
        $this->preference_name = htmlspecialchars(strip_tags($this->preference_name));

        // Bind parameters
        $stmt->bindParam(':preferences_id', $this->preferences_id);
        $stmt->bindParam(':preference_name', $this->preference_name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if execution fails
        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE preferences_id = :preferences_id';

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->preferences_id = htmlspecialchars(strip_tags($this->preferences_id));

        // Bind parameter
        $stmt->bindParam(':preferences_id', $this->preferences_id);

        try {
            // Execute query
            if ($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s. \n', $stmt->error);
                return false;
            }
        } catch (PDOException $e) {
            // Handle integrity constraint violation
            return false;
        }
    }
}

?>
