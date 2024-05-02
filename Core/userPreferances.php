<?php
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
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (preference_name) VALUES (:preference_name)';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        $this->preference_name = htmlspecialchars(strip_tags($this->preference_name));
        
        // Bind parameters
        $stmt->bindParam(':preference_name', $this->preference_name);
        
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error message if execution fails
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
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