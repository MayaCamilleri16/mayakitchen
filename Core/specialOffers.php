<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

class SpecialOffers {
    private $conn;
    private $table = 'special_offers';
    public $offer_id;
    public $name;
    public $discount_percentage;
    public $valid_until;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (name, discount_percentage, valid_until) VALUES (:name, :discount_percentage, :valid_until)';
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->discount_percentage = htmlspecialchars(strip_tags($this->discount_percentage));
        $this->valid_until = htmlspecialchars(strip_tags($this->valid_until));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':discount_percentage', $this->discount_percentage);
        $stmt->bindParam(':valid_until', $this->valid_until);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, discount_percentage = :discount_percentage, valid_until = :valid_until WHERE offer_id = :offer_id';

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->offer_id = htmlspecialchars(strip_tags($this->offer_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->discount_percentage = htmlspecialchars(strip_tags($this->discount_percentage));
        $this->valid_until = htmlspecialchars(strip_tags($this->valid_until));

        // Bind parameters
        $stmt->bindParam(':offer_id', $this->offer_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':discount_percentage', $this->discount_percentage);
        $stmt->bindParam(':valid_until', $this->valid_until);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE offer_id = :offer_id';

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->offer_id = htmlspecialchars(strip_tags($this->offer_id));

        // Bind parameter
        $stmt->bindParam(':offer_id', $this->offer_id);

        try {
            // Execute query
            if ($stmt->execute()) {
                return true;
            } else {
                printf('Error: %s. \n', $stmt->error);
                return false;
            }
        } catch (PDOException $e) {
            // Handle integrity constraint violation
            return false;
        }
    }
}

?>
