<?php
class DailySpecials {
    private $conn;
    private $table = 'DailySpecials';

    public $id;
    public $date;
    public $food_special;
    public $price;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all daily specials
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a single daily special by ID
    public function readSingle() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // staff create a new daily special
    public function create() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE date = :date';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $this->date);
        $stmt->execute();
        $existingSpecial = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($existingSpecial) {
            // Return an error message indicating the daily special already exists
            http_response_code(400); // Bad Request
            echo json_encode(array('message' => 'A daily special already exists for the given date.'));
            return false;
        }
    
        // inserting a new daily special if no existing special found
        $query = 'INSERT INTO ' . $this->table . ' 
            (date, food_special, price, description) 
            VALUES (:date, :food_special, :price, :description)';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':food_special', $this->food_special);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
    
        return $stmt->execute();
    }
    
    // staff update an existing daily special
    public function update() {
        $checkQuery = 'SELECT * FROM ' . $this->table . ' WHERE date = :date AND id != :id';
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':date', $this->date);
        $checkStmt->bindParam(':id', $this->id);
        $checkStmt->execute();
        
        // Check if there is another daily special with the same date
        if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
            // Return an error message indicating a date conflict
            http_response_code(400); // Bad Request
            echo json_encode(array('message' => 'Another daily special already exists with the same date.'));
            return false;
        }
    
        // Proceed with updating the daily special if no date conflict is found
        $query = 'UPDATE ' . $this->table . ' SET 
            date = :date,
            food_special = :food_special,
            price = :price,
            description = :description
            WHERE id = :id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':food_special', $this->food_special);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
    
        return $stmt->execute();
    }
    

    // staff delete a daily special by ID
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

?>