<?php

Class Feedback {
    // Database connection
    private $conn;
    // Table name
    private $table = 'serve_feedback';

    // Feedback properties
    public $serve_feedback_id;
    public $order_id;
    public $rating;
    public $comment;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to read all feedback entries
    public function read() {
        // Query to select all feedback entries from the database
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // Return all feedback entries as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to read a single feedback entry by ID
    public function readSingle() {
        // Query to select a single feedback entry by serve_feedback_id
        $query = 'SELECT * FROM ' . $this->table . ' WHERE serve_feedback_id = :serve_feedback_id';
        $stmt = $this->conn->prepare($query);
        // Bind the feedback ID parameter
        $stmt->bindParam(':serve_feedback_id', $this->serve_feedback_id, PDO::PARAM_INT);
        $stmt->execute();
        // Return the feedback entry as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to  user can create a new feedback entry
    public function create() {
        // Query to insert a new feedback entry into the database
        $query = 'INSERT INTO ' . $this->table . ' (order_id, rating, comment) 
                  VALUES (:order_id, :rating, :comment)';
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        // Execute query
        return $stmt->execute();
    }

    // Method to update an existing feedback entry
    public function update() {
        // Query to update feedback based on serve_feedback_id
        $query = 'UPDATE ' . $this->table . ' 
                  SET order_id = :order_id, rating = :rating, comment = :comment 
                  WHERE serve_feedback_id = :serve_feedback_id';
        $stmt = $this->conn->prepare($query);
        // Bind parameters
        $stmt->bindParam(':serve_feedback_id', $this->serve_feedback_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        // Execute query
        return $stmt->execute();
    }

    // Method to user  delete a feedback entry
    public function delete() {
        // Query to delete feedback based on serve_feedback_id
        $query = 'DELETE FROM ' . $this->table . ' WHERE serve_feedback_id = :serve_feedback_id';
        $stmt = $this->conn->prepare($query);
        // Bind parameter
        $stmt->bindParam(':serve_feedback_id', $this->serve_feedback_id, PDO::PARAM_INT);
        // Execute query
        return $stmt->execute();
    }

    //the staff could view the user feedback
   public function getUserFeedback() {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id ORDER BY serve_feedback_id ASC';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $feedbacks;
}

}

?>