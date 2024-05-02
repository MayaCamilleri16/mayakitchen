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

      // Method to read all feedback
      public function read() {
        $query = 'SELECT feedback_id, event_id, user_id, comment, time, rating FROM ' . $this->table . ' ORDER BY time DESC';
        
        // Prepare and execute the statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Fetch all rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    // Method to read a single feedback entry based on feedback_id
    public function read_single() {
        $query = 'SELECT feedback_id, event_id, user_id, comment, time, rating FROM ' . $this->table . ' WHERE feedback_id = :feedback_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind the feedback_id parameter
        $stmt->bindParam(':feedback_id', $this->feedback_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the row as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
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

      // Method to get feedback for a specific event based on event_id
      public function getEventFeedback() {
        $query = 'SELECT feedback_id, event_id, user_id, comment, time, rating FROM ' . $this->table . ' WHERE event_id = :event_id ORDER BY time DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $this->event_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

}


?>
