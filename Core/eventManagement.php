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

      // Function to read all events
      public function read() {
        $query = 'SELECT event_id, user_id, event_name, event_date, event_time, party_size FROM ' . $this->table . ' ORDER BY event_date ASC, event_time ASC';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        // Fetch all rows as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    // Function to read a single event based on event_id
    public function read_single() {
        $query = 'SELECT event_id, user_id, event_name, event_date, event_time, party_size FROM ' . $this->table . ' WHERE event_id = :event_id';
        
        $stmt = $this->conn->prepare($query);
        
        // Bind the event_id parameter
        $stmt->bindParam(':event_id', $this->event_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the row as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
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
// user view the events 
public function viewUserEvents() {
    $query = 'SELECT event_id, event_name, event_date, event_time, party_size FROM ' . $this->table . ' WHERE user_id = :user_id ORDER BY event_date ASC, event_time ASC';

    // Prepare the query statement
    $stmt = $this->conn->prepare($query);

    // Bind the user_id parameter
    $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the results as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results
    return $result;
}

}


?>
