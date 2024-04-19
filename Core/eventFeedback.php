<?php
class EventFeedback {
    private $conn;
    private $table = 'event_feedback';  

    // Properties of event feedback
    public $feedback_id;
    public $event_id;
    public $user_id;
    public $comment;
    public $time;
    public $rating;

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create new feedback
    public function createFeedback() {
        $query = 'INSERT INTO ' . $this->table . ' (event_id, user_id, comment, time, rating)
                  VALUES (:event_id, :user_id, :comment, :time, :rating)';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input variables
        $event_id = htmlspecialchars(strip_tags($this->event_id));
        $user_id = htmlspecialchars(strip_tags($this->user_id));
        $comment = htmlspecialchars(strip_tags($this->comment));
        $time = htmlspecialchars(strip_tags($this->time));
        $rating = htmlspecialchars(strip_tags($this->rating));
        
        // Bind parameters
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':rating', $rating);
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Feedback created successfully
        } else {
            // Print error message and return false
            printf('Error: %s.\n', $stmt->errorInfo()[2]);
            return false; // Feedback creation failed
        }
    }

    // Method to update existing feedback
    public function updateFeedback() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET event_id = :event_id, user_id = :user_id, comment = :comment, time = :time, rating = :rating 
                  WHERE feedback_id = :feedback_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Sanitize input variables
        $feedback_id = htmlspecialchars(strip_tags($this->feedback_id));
        $event_id = htmlspecialchars(strip_tags($this->event_id));
        $user_id = htmlspecialchars(strip_tags($this->user_id));
        $comment = htmlspecialchars(strip_tags($this->comment));
        $time = htmlspecialchars(strip_tags($this->time));
        $rating = htmlspecialchars(strip_tags($this->rating));

        // Bind parameters
        $stmt->bindParam(':feedback_id', $feedback_id);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':rating', $rating);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Feedback updated successfully
        } else {
            // Print error message and return false
            printf('Error: %s.\n', $stmt->errorInfo()[2]);
            return false; // Feedback update failed
        }
    }

    // Method to delete feedback
    public function deleteFeedback() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE feedback_id = :feedback_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize input variable
        $feedback_id = htmlspecialchars(strip_tags($this->feedback_id));
        
        // Bind parameter
        $stmt->bindParam(':feedback_id', $feedback_id);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Feedback deleted successfully
        } else {
            // Print error message and return false
            printf('Error: %s.\n', $stmt->errorInfo()[2]);
            return false; // Feedback deletion failed
        }
    }
}


?>
