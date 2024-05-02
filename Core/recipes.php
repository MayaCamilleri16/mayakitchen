<?php

class Recipes {

    private $conn;
    private $table = 'recipes';

    // Properties of Recipe
    public $recipe_id;
    public $recipe_name;
    public $prep_time_minutes;
    public $total_time_minutes;
    public $servings;
    public $meal_type;
    public $instructions;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {

        $query = 'SELECT recipe_id, recipe_name, prep_time_minutes, total_time_minutes, servings, meal_type, instructions FROM ' . $this->table . ' ORDER BY recipe_id ASC';
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the recipes
        return $recipes;
    }

    
    public function readSingle() {
        $query = 'SELECT recipe_id, recipe_name, prep_time_minutes, total_time_minutes, servings, meal_type, instructions FROM ' . $this->table . ' WHERE recipe_id = :recipe_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recipe_id', $this->recipe_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the row as an associative array
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the recipe
        return $recipe;
    }
    
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (recipe_name, prep_time_minutes, total_time_minutes, cook_time_minutes, servings, meal_type, instructions) VALUES (:recipe_name, :prep_time_minutes, :total_time_minutes, :cook_time_minutes, :servings, :meal_type, :instructions)';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize the input data
        $this->recipe_name = htmlspecialchars(strip_tags($this->recipe_name));
        $this->prep_time_minutes = intval($this->prep_time_minutes);
        $this->total_time_minutes = intval($this->total_time_minutes);
        $this->cook_time_minutes = intval($this->cook_time_minutes);
        $this->servings = intval($this->servings);
        $this->meal_type = htmlspecialchars(strip_tags($this->meal_type));
        $this->instructions = htmlspecialchars(strip_tags($this->instructions));
        
        // Bind the parameters
        $stmt->bindParam(':recipe_name', $this->recipe_name);
        $stmt->bindParam(':prep_time_minutes', $this->prep_time_minutes);
        $stmt->bindParam(':total_time_minutes', $this->total_time_minutes);
        $stmt->bindParam(':cook_time_minutes', $this->cook_time_minutes);
        $stmt->bindParam(':servings', $this->servings);
        $stmt->bindParam(':meal_type', $this->meal_type);
        $stmt->bindParam(':instructions', $this->instructions);
        
        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }
    

    // Update a recipe
    public function update() {
        // Define the query to update a recipe
        $query = 'UPDATE ' . $this->table . ' 
              SET recipe_name = :recipe_name,
                  prep_time_minutes = :prep_time_minutes,
                  total_time_minutes = :total_time_minutes,
                  servings = :servings,
                  meal_type = :meal_type,
                  instructions = :instructions
              WHERE recipe_id = :recipe_id';
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Sanitize the input data
        $this->recipe_id = intval($this->recipe_id);
        $this->recipe_name = htmlspecialchars(strip_tags($this->recipe_name));
        $this->prep_time_minutes = intval($this->prep_time_minutes);
        $this->total_time_minutes = intval($this->total_time_minutes);
        $this->servings = intval($this->servings);
        $this->meal_type = htmlspecialchars(strip_tags($this->meal_type));
        $this->instructions = htmlspecialchars(strip_tags($this->instructions));
    
        // Bind the parameters
        $stmt->bindParam(':recipe_id', $this->recipe_id, PDO::PARAM_INT);
        $stmt->bindParam(':recipe_name', $this->recipe_name);
        $stmt->bindParam(':prep_time_minutes', $this->prep_time_minutes);
        $stmt->bindParam(':total_time_minutes', $this->total_time_minutes);
        $stmt->bindParam(':servings', $this->servings);
        $stmt->bindParam(':meal_type', $this->meal_type);
        $stmt->bindParam(':instructions', $this->instructions);
    
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        }
    
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Delete a recipe
    public function delete() {
        // Define the query to delete a recipe
        $query = 'DELETE FROM ' . $this->table . ' WHERE recipe_id = :recipe_id';
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Sanitize the input data
        $this->recipe_id = intval($this->recipe_id);
    
        // Bind the recipe_id parameter
        $stmt->bindParam(':recipe_id', $this->recipe_id, PDO::PARAM_INT);
    
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        }
    
        // Print any error message
        printf('Error: %s. \n', $stmt->errorInfo()[2]);
        return false;
    }

    // Get recipe details
    public function getRecipeDetails() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE recipe_id = :recipe_id LIMIT 1';
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize the input data
        $this->recipe_id = intval($this->recipe_id);
        
        // Bind the parameterz
        $stmt->bindParam(':recipe_id', $this->recipe_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the recipe details
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }
}
?>