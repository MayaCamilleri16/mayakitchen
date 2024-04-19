<?php

class LoyaltyProgram {

    private $conn;
    private $table = 'loyalty_program';

    public $user_id;
    public $points;
    public $discount_id;


    public function __construct($db) {
        $this->conn = $db;
    }

//create a new loyalty user
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (user_id, points, discount_id) VALUES (:user_id, :points, :discount_id)';

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':points', $this->points, PDO::PARAM_INT);
        $stmt->bindParam(':discount_id', $this->discount_id, PDO::PARAM_INT);

        // Execute the query and return the result
        return $stmt->execute();
    }

    // Read a loyalty program entry for a specific user
    public function read() {
        // SQL query to retrieve the entry based on user_id
        $query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id';

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the parameter
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    // Update a loyalty program entry for user 
    public function update() {
        // SQL query to update the entry based on user_id
        $query = 'UPDATE ' . $this->table . ' SET points = :points, discount_id = :discount_id WHERE user_id = :user_id';

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':points', $this->points, PDO::PARAM_INT);
        $stmt->bindParam(':discount_id', $this->discount_id, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $stmt->execute();
    }

    // Delete a loyalty program entry
    public function delete() {
        // SQL query to delete the entry based on user_id
        $query = 'DELETE FROM ' . $this->table . ' WHERE user_id = :user_id';

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the parameter
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);

        // Execute the statement and return the result
        return $stmt->execute();
    }
}


?>
