<?php

class Orders {
    private $conn;
    private $table = 'order';

    public $order_id;
    public $booking_id;
    public $food_id;
    public $drink_id;
    public $discount_id;
    public $table_id;
    public $offer_id;

    public function __construct($db) {
        $this->conn = $db;
    }

      // Read all orders
      public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single order by order_id
    public function readSingle() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE order_id = :order_id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

//waiter can create a new order
public function create() {
    $query = 'INSERT INTO `' . $this->table . '` 
    (booking_id, food_id, drink_id, discount_id, table_id, offer_id)
    VALUES (:booking_id, :food_id, :drink_id, :discount_id, :table_id, :offer_id)';

    $stmt = $this->conn->prepare($query);
    
    $stmt->bindParam(':booking_id', $this->booking_id);
    $stmt->bindParam(':food_id', $this->food_id);
    $stmt->bindParam(':drink_id', $this->drink_id);
    $stmt->bindParam(':discount_id', $this->discount_id);
    $stmt->bindParam(':table_id', $this->table_id);
    $stmt->bindParam(':offer_id', $this->offer_id);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log('Error creating order: ' . $e->getMessage());
        return false;
    }
    
}

    //waiter can update order
    public function update() {
        $query = 'UPDATE `' . $this->table . '` SET 
                  booking_id = :booking_id,
                  food_id = :food_id,
                  drink_id = :drink_id,
                  discount_id = :discount_id,
                  table_id = :table_id,
                  offer_id = :offer_id
                  WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
    
       
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':booking_id', $this->booking_id);
        $stmt->bindParam(':food_id', $this->food_id);
        $stmt->bindParam(':drink_id', $this->drink_id);
        $stmt->bindParam(':discount_id', $this->discount_id);
        $stmt->bindParam(':table_id', $this->table_id);
        $stmt->bindParam(':offer_id', $this->offer_id);
    
        // Execute query
        return $stmt->execute();
    }
    
// waiter can delete order
    public function delete() {
        $query = 'DELETE FROM `' . $this->table . '` WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id);
    
        // Execute query
        return $stmt->execute();
    }
    

    public function getOrderDetails($order_id) {
        $query = 'SELECT * FROM `' . $this->table . '` WHERE order_id = :order_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    // waiter marks order as served
    public function markOrderAsServed() {
        $query = 'UPDATE `' . $this->table . '` SET status = "served" WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);
    
        // Execute query
        return $stmt->execute();
    }

}


?>

