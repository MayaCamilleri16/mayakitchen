<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

class Orders {
    private $conn;
    private $table = 'orders';

    public $order_id;
    public $current_order_id;
    public $booking_id;
    public $user_id;
    public $table_number;
    public $food_id;
    public $offer_id;
    public $menu_id;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                    (current_order_id, booking_id, user_id, table_number, food_id, offer_id, menu_id, status)
                    VALUES (:current_order_id, :booking_id, :user_id, :table_number, :food_id, :offer_id, :menu_id, :status)';

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->current_order_id = htmlspecialchars(strip_tags($this->current_order_id));
        $this->booking_id = htmlspecialchars(strip_tags($this->booking_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->table_number = htmlspecialchars(strip_tags($this->table_number));
        $this->food_id = htmlspecialchars(strip_tags($this->food_id));
        $this->offer_id = htmlspecialchars(strip_tags($this->offer_id));
        $this->menu_id = htmlspecialchars(strip_tags($this->menu_id));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind parameters
        $stmt->bindParam(':current_order_id', $this->current_order_id);
        $stmt->bindParam(':booking_id', $this->booking_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':table_number', $this->table_number);
        $stmt->bindParam(':food_id', $this->food_id);
        $stmt->bindParam(':offer_id', $this->offer_id);
        $stmt->bindParam(':menu_id', $this->menu_id);
        $stmt->bindParam(':status', $this->status);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function viewPendingOrders() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE status = "pending"';
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $orders;
    }
    
    public function placeFoodOrders($current_order_id, $booking_id, $user_id, $table_number, $food_id, $offer_id, $menu_id) {
        $this->current_order_id = $current_order_id;
        $this->booking_id = $booking_id;
        $this->user_id = $user_id;
        $this->table_number = $table_number;
        $this->food_id = $food_id;
        $this->offer_id = $offer_id;
        $this->menu_id = $menu_id;
        $this->status = "pending";
    
        // Call create method to insert the order
        return $this->create();
    }
    
    public function markOrderAsServed($order_id) {
        $query = 'UPDATE ' . $this->table . ' SET status = "served" WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
    
        if ($stmt->execute()) {
            return true;
        }
    
        printf('Error: %s. \n', $stmt->error);
        return false;
    }
    
    public function getOrderDetails($order_id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
    
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $order;
    }
    

}

?>
