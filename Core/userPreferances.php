<?php

class ServeOrderFeedback {
    // Database connection
    private $conn;
    // Table name
    private $table = 'serve_feedback';

    // Feedback properties
    public $serve_feedback_id;
    public $order_id;
    public $rating;
    public $comment;

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create a new feedback entry
    public function create() {
        // Query to insert a new feedback entry into the database
        $query = 'INSERT INTO ' . $this->table . ' (order_id, rating, comment) 
                  VALUES (:order_id, :rating, :comment)';
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));

        // Bind parameters
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if execution fails
        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    // Method to update an existing feedback entry
    public function update() {
        // Query to update feedback entry based on serve_feedback_id
        $query = 'UPDATE ' . $this->table . ' 
                  SET order_id = :order_id, rating = :rating, comment = :comment 
                  WHERE serve_feedback_id = :serve_feedback_id';
        
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->serve_feedback_id = htmlspecialchars(strip_tags($this->serve_feedback_id));
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));

        // Bind parameters
        $stmt->bindParam(':serve_feedback_id', $this->serve_feedback_id);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error message if execution fails
        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    // Method to delete a feedback entry
    public function delete() {
        // Query to delete feedback entry based on serve_feedback_id
        $query = 'DELETE FROM ' . $this->table . ' WHERE serve_feedback_id = :serve_feedback_id';
        
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->serve_feedback_id = htmlspecialchars(strip_tags($this->serve_feedback_id));

        // Bind parameter
        $stmt->bindParam(':serve_feedback_id', $this->serve_feedback_id, PDO::PARAM_INT);

        // Execute query
        try {
            if ($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s. \n', $stmt->error);
                return false;
            }
        } catch (PDOException $e) {
            // Handle any potential exceptions
            printf('Error: %s. \n', $e->getMessage());
            return false;
        }
    }
}
?>
