<?php

class Booking {
    // Properties for database connection and table
    private $conn;
    private $table = 'bookings';

    // Properties of a booking
    public $id;
    public $user_id;
    public $date;
    public $time;
    public $party_size;
    public $preferences_id;
    public $discount_id;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    //to create a new booking
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (user_id, date, time, party_size, preferences_id, discount_id) VALUES (:user_id, :date, :time, :party_size, :preferences_id, :discount_id)';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':party_size', $this->party_size);
        $stmt->bindParam(':preferences_id', $this->preferences_id);
        $stmt->bindParam(':discount_id', $this->discount_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // to update an existing booking
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET user_id = :user_id, date = :date, time = :time, party_size = :party_size, preferences_id = :preferences_id, discount_id = :discount_id WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':party_size', $this->party_size);
        $stmt->bindParam(':preferences_id', $this->preferences_id);
        $stmt->bindParam(':discount_id', $this->discount_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //  to delete a booking
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // to retrieve booking details by ID
    public function getBookingDetails() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        // Fetch single record
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
}

?>
