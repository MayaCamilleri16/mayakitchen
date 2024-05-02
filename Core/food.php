<?php

class Food {
    // Properties for database connection and table name
    private $conn;
    private $table = 'food';

    public $food_id;
    public $name;
    public $price;
    public $extra;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read() {
        // Define the query to select all food items from the database
        $query = 'SELECT food_id, name, price, extra FROM ' . $this->table . ' ORDER BY name ASC';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch the results as an array of associative arrays
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the result
        return $result;
    }
    

    // Method to create a new food item
    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' (name, price, extra) 
                  VALUES (:name, :price, :extra)';
    
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->extra = htmlspecialchars(strip_tags($this->extra));
    
        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':extra', $this->extra);
    
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
    
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Method to update an existing food item
    public function update(){
        $query = 'UPDATE ' . $this->table . ' 
                  SET name = :name, price = :price, extra = :extra 
                  WHERE food_id = :food_id';
    
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->food_id = htmlspecialchars(strip_tags($this->food_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->extra = htmlspecialchars(strip_tags($this->extra));
    
        // Bind parameters
        $stmt->bindParam(':food_id', $this->food_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':extra', $this->extra);
    
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
    
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Method to delete a food item
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE food_id = :food_id';
    
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->food_id = htmlspecialchars(strip_tags($this->food_id));
    
        // Bind parameter
        $stmt->bindParam(':food_id', $this->food_id);
    
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
    
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

// Method to user view food details of a specific food item based on food_id
public function getFoodDetails() {
    // Define the query to select the food item from the database
    $query = 'SELECT food_id, name, price, extra FROM ' . $this->table . ' WHERE food_id = :food_id';
    
    // Prepare the statement
    $stmt = $this->conn->prepare($query);
    
    // Clean the data
    $this->food_id = htmlspecialchars(strip_tags($this->food_id));
    
    // Bind the parameter
    $stmt->bindParam(':food_id', $this->food_id);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the result as an associative array
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Return the result
    return $result;
}

//  user can view all food items
public function getFoodMenu() {
    return $this->read();
}

}
?>
