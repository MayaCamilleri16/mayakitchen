<?php

class User{
    // properties for database stuff
    private $conn;
    private $table = 'Users';

    // properties of User
    public $id;
    public $username;
    public $email;
    public $password;

    // User Constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // Getting Users from db
    public function read(){
        // Read Query
        $query = 'SELECT *
                    FROM '.$this->table.' u
                    ORDER BY u.username ASC;';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }




    public function read_single(){
        $query = 'SELECT *
                    FROM '.$this->table.' u
                    WHERE u.id = ? LIMIT 1;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->password = $row['password'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.' 
                    (username, email, password)
                    VALUES(:username, :email, :password);';

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // bind parameters to request
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()){
            return true;
        }

        printf('Error %s. \n', $stmt->error);
        return false;
    }

    public function update(){
        $query = 'UPDATE '.$this->table.'
                    SET username = :username,
                    email = :email,
                    password = :password
                    WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

   
    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function update_password(){
        $query = 'UPDATE '.$this->table.'
                    SET password = :password
                    WHERE id = :id;';
    
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->password = htmlspecialchars(strip_tags($this->password));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':password', $this->password);
    
        if($stmt->execute()){
            return true;
        }
    
        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function getSpecialOffers() {
        $query = 'SELECT * FROM special_offers';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function applySpecialOffer($offer_id) {
        $query = 'SELECT * FROM special_offers WHERE offer_id = :offer_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':offer_id', $offer_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            // Offer not found
            return false;
        }
    }
    public function getLoyaltyPoints() {

        $query = 'SELECT points FROM loyalty_program WHERE user_id = :user_id';
        
        $stmt = $this->conn->prepare(query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        
 
        if ($stmt->execute()) {
            // the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if result exists
            if ($result) {
                // Return the loyalty points
                return $result['points'];
            } else {
                // If no data is found, return 0 points
                return 0;
            }
        } else {
            // Log any error message
            error_log('Error executing query: ' . $stmt->errorInfo()[2]);
            return 0;
        }
    }
    public function getDailySpecials() {
        $query = 'SELECT * FROM DailySpecials ORDER BY date ASC';
    
        //statement
        $stmt = $this->conn->prepare($query);
    
        // Execute
        if ($stmt->execute()) {
            // Fetch all daily specials from the database
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;  // Return the array of daily specials
        } else {
            // Handle any errors that occur during query execution
            error_log('Error executing query: ' . $stmt->errorInfo()[2]);
            return [];  // Return an empty array in case of an error
        }
    }

    //users can view their order from the app
    public function getAppOrdersDetails() {
        // Define the query to retrieve all app orders
        $query = 'SELECT ao.order_id, ao.order_date, ao.food_id, ao.drink_id, ao.quantity_food, ao.quantity_drink, ao.discount_id 
                  FROM appOrders ao
                  ORDER BY ao.order_date DESC';
        
        // Log the query for debugging
        error_log('Query: ' . $query);
        
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        
        // Execute the query
        if ($stmt->execute()) {
            // Fetch the results as an associative array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Return the result
            return $result;
        } else {
            // Log any error message
            error_log('Error executing query: ' . $stmt->errorInfo()[2]);
            
            // Return an empty array in case of an error
            return [];
        }
    }

    // user get updates on their order they made from the app
    public function getOrderUpdate($order_id) {
        $query = 'SELECT order_id, order_date, user_id, total_price, status, delivery_type
                  FROM appOrders
                  WHERE order_id = :order_id';
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
        // Bind the order_id parameter
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    
        // Execute the query
        if ($stmt->execute()) {
            // Fetch the order details
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($order) {
                // Log the order details for debugging
                error_log('Order details: ' . json_encode($order));
                
                // Return the order details
                return $order;
            } else {
                // Order not found, log an error message
                error_log('Order not found for order_id: ' . $order_id);
                return null;
            }
        } else {
            // Log any error message
            error_log('Error executing query: ' . $stmt->errorInfo()[2]);
            return null;
        }
    }
    
    
    
}
?>