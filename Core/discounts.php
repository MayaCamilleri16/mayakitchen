<?php

class Discounts {
    private $conn;
    private $table = 'discounts';

    public $id;
    public $code;
    public $amount;
    public $expiration_date;

    public function __construct($db) {
        $this->conn = $db;
    }

   
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY expiration_date DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //  retrieve a single discount by ID
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->code = $row['code'];
        $this->amount = $row['amount'];
        $this->expiration_date = $row['expiration_date'];
    }

    //create a new discount
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (code, percentage, expiry_date) VALUES (:code, :percentage, :expiry_date)';

        $stmt = $this->conn->prepare($query);

        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->expiration_date = htmlspecialchars(strip_tags($this->expiration_date));

        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':percentage', $this->percentage);
        $stmt->bindParam(':expiry_date', $this->expiry_date);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //  update an existing discount
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET code = :code, percentage = :percentage, expiry_date = :expiry_date WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->percentage = htmlspecialchars(strip_tags($this->percentage));
        $this->expiry_date = htmlspecialchars(strip_tags($this->expiry_date));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':code', $this->code);
        $stmt->bindParam(':percentage', $this->percentage);
        $stmt->bindParam(':expiry_date', $this->expiry_date);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }



    // delete a discount
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }
}

?>
