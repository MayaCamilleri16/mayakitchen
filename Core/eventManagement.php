<?php

class EventManagement {
    private $conn;
    private $table = 'event_management';  

    // Properties of the event
    public $event_id;
    public $user_id;
    public $event_name;
    public $event_date;
    public $event_time;
    public $party_size;

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    public function createEvent() {
        $query = 'INSERT INTO ' . $this->table . ' (user_id, event_name, event_date, event_time, party_size)
                  VALUES (:user_id, :event_name, :event_date, :event_time, :party_size)';
        
        $stmt = $this->conn->prepare($query);
    
        // Create variables for sanitized input
        $user_id = htmlspecialchars(strip_tags($this->user_id));
        $event_name = htmlspecialchars(strip_tags($this->event_name));
        $event_date = htmlspecialchars(strip_tags($this->event_date));
        $event_time = htmlspecialchars(strip_tags($this->event_time));
        $party_size = htmlspecialchars(strip_tags($this->party_size));
    
        // Bind parameters
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':event_time', $event_time);
        $stmt->bindParam(':party_size', $party_size);
    
        // Execute the statement
        if ($stmt->execute()) {
            return true; // Event created successfully
        } else {
            printf('Error: %s. \n', $stmt->errorInfo()[2]);
            return false; // Event creation failed
        }
    }
    
    public function updateEvent() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET event_name = :event_name, event_date = :event_date, event_time = :event_time, party_size = :party_size 
                  WHERE event_id = :event_id';
        
        $stmt = $this->conn->prepare($query);
    
        // Create variables for sanitized input
        $event_id = htmlspecialchars(strip_tags($this->event_id));
        $event_name = htmlspecialchars(strip_tags($this->event_name));
        $event_date = htmlspecialchars(strip_tags($this->event_date));
        $event_time = htmlspecialchars(strip_tags($this->event_time));
        $party_size = htmlspecialchars(strip_tags($this->party_size));
    
        // Bind parameters
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':event_time', $event_time);
        $stmt->bindParam(':party_size', $party_size);
    
        // Execute the statement
        if ($stmt->execute()) {
            return true; // Event updated successfully
        } else {
            printf('Error: %s. \n', $stmt->errorInfo()[2]);
            return false; // Event update failed
        }
    }
    


public function delete() {
   
    $query = 'DELETE FROM event_feedback WHERE event_id = :event_id';
    $stmt = $this->conn->prepare($query);
    // Use variables to hold sanitized values before binding parameters
    $event_id = htmlspecialchars(strip_tags($this->event_id));
    $stmt->bindParam(':event_id', $event_id);
    if (!$stmt->execute()) {
        printf('Error deleting child records: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    //delete the event based on event_id and user_id
    $query = 'DELETE FROM ' . $this->table . ' WHERE event_id = :event_id AND user_id = :user_id';
    $stmt = $this->conn->prepare($query);

    $event_id = htmlspecialchars(strip_tags($this->event_id));
    $user_id = htmlspecialchars(strip_tags($this->user_id));
    $stmt->bindParam(':event_id', $event_id);
    $stmt->bindParam(':user_id', $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Event deleted successfully
        return true;
    } else {
        // Event deletion failed
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }
}
}

?>
