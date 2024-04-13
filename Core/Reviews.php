<?php

class Reviews {
    private $conn;
    private $table = 'reviews';


    public $id;
    public $user_id;
    public $rating;
    public $comment;
    public $time; 


    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to retrieve all reviews
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY time DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->user_id = $row['user_id'];
        $this->rating = $row['rating'];
        $this->comment = $row['comment'];
        $this->time = $row['time'];
    }

  
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (user_id, rating, comment, time) VALUES (:user_id, :rating, :comment, :time)';

        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));
        $this->time = date('Y-m-d H:i:s'); 

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        $stmt->bindParam(':time', $this->time);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }

    //  update an existing review
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET user_id = :user_id, rating = :rating, comment = :comment, time = :time WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->comment = htmlspecialchars(strip_tags($this->comment));
        $this->time = date('Y-m-d H:i:s');

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':comment', $this->comment);
        $stmt->bindParam(':time', $this->time);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s. \n', $stmt->error);
        return false;
    }
    
    // Delete a review
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

   
   
