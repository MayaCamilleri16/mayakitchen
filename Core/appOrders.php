<?php
//li se jircievu staff
class AppOrders {
    private $conn;
    private $table = 'appOrders';

    // Properties 
    public $order_id;
    public $user_id;
    public $order_date;
    public $total_price;
    public $status;
    public $delivery_type;

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

    // Create a new order for the user so they can see the price, status and delivery
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (user_id, order_date, total_price, status, delivery_type)
                  VALUES (:user_id, :order_date, :total_price, :status, :delivery_type)';

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':order_date', $this->order_date);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':delivery_type', $this->delivery_type);

        // Execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error creating order: ' . $e->getMessage());
            return false;
        }
    }

    // Update the order
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET 
                  user_id = :user_id,
                  order_date = :order_date,
                  total_price = :total_price,
                  status = :status,
                  delivery_type = :delivery_type
                  WHERE order_id = :order_id';

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':order_date', $this->order_date);
        $stmt->bindParam(':total_price', $this->total_price);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':delivery_type', $this->delivery_type);

        // Execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error updating order: ' . $e->getMessage());
            return false;
        }
    }

    // Delete the order when its delivered or no longer needed
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE order_id = :order_id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id);

        // Execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error deleting order: ' . $e->getMessage());
            return false;
        }
    }
      // Function to allow a user to get details of a specific order 
      public function getOrderDetails() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE order_id = :order_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $this->order_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the order details as an associative array
        $orderDetails = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Return the order details
        return $orderDetails;
    }
}

?>
