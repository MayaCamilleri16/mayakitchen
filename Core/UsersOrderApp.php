<?php

class OrderItems {
    private $conn;
    private $table = 'Order_Items';

    public $order_id;
    public $food_id;
    public $drink_id;
    public $quantity_food;
    public $quantity_drink;
    public $discount_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all order items
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single order item
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE order_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->order_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Users can create a new order in the app
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (order_id, food_id, drink_id, quantity_food, quantity_drink, discount_id)
                  VALUES (:order_id, :food_id, :drink_id, :quantity_food, :quantity_drink, :discount_id)';
        
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);
        $stmt->bindParam(':food_id', $this->food_id, PDO::PARAM_INT);
        $stmt->bindParam(':drink_id', $this->drink_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity_food', $this->quantity_food, PDO::PARAM_INT);
        $stmt->bindParam(':quantity_drink', $this->quantity_drink, PDO::PARAM_INT);
        $stmt->bindParam(':discount_id', $this->discount_id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }

    // user can delete an order in the app
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE order_id = :order_id';
        
        $stmt = $this->conn->prepare($query);
        
        // Bind parameter
        $stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }
}

?>
