<?php

class Tables {
    private $conn;
    private $table = 'tables'; // Name of the table in the database

    // Properties of the tables
    public $table_id;
    public $number;
    public $available; 

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all tables
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY table_id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single table
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE table_id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->table_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new table
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (number, available) VALUES (:number, :available)';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':number', $this->number, PDO::PARAM_INT);
        $stmt->bindParam(':available', $this->available, PDO::PARAM_BOOL);

        // Execute the query
        return $stmt->execute();
    }

    // Update a table
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET number = :number, available = :available WHERE table_id = :table_id';
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':number', $this->number, PDO::PARAM_INT);
        $stmt->bindParam(':available', $this->available, PDO::PARAM_BOOL);
        $stmt->bindParam(':table_id', $this->table_id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }

    // Delete a table
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE table_id = :table_id';
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':table_id', $this->table_id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }
}
?>
