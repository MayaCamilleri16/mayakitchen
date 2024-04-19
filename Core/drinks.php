<?php

class Drinks {
    // Properties for database connection and table name
    private $conn;
    private $table = 'drinks';


    public $drink_id;
    public $name;
    public $price;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT drink_id, name, price FROM ' . $this->table . ' ORDER BY name ASC';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the results as an array of associative arrays
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the result
        return $result;
    }

    public function read_single() {
        $query = 'SELECT drink_id, name, price FROM ' . $this->table . ' WHERE drink_id = :drink_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Bind the drink_id parameter
        $stmt->bindParam(':drink_id', $this->drink_id, PDO::PARAM_INT);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the result as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if a row was retrieved
        if ($row) {
          
            $this->name = $row['name'];
            $this->price = $row['price'];
            return true;
        } else {
            return false; // No drink found
        }
    }
    

    // Create a new drink
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (name, price) VALUES (:name, :price)';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize the input data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = floatval($this->price);
        
        // Bind the parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Update an existing drink
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, price = :price WHERE drink_id = :drink_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize the input data
        $this->drink_id = intval($this->drink_id);
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = floatval($this->price);
        
        // Bind the parameters
        $stmt->bindParam(':drink_id', $this->drink_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Delete a drink
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE drink_id = :drink_id';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize the input data
        $this->drink_id = intval($this->drink_id);
        
        // Bind the drink_id parameter
        $stmt->bindParam(':drink_id', $this->drink_id);
        
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

public function getDrinkDetails() {
    // Define the query to select drink details based on the provided drink_id
    $query = 'SELECT drink_id, name, price FROM ' . $this->table . ' WHERE drink_id = :drink_id LIMIT 1';

    // Prepare the statement
    $stmt = $this->conn->prepare($query);

    // Bind the drink_id parameter to the statement
    $stmt->bindParam(':drink_id', $this->drink_id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Return the statement so that the calling function can fetch the results
    return $stmt;
}
}
?>
