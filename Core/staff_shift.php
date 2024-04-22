<?php

class StaffShift {
    private $conn;
    private $table = 'staff_shifts';

    // Properties of staff shift
    public $id;
    public $staff_id;
    public $start_time;
    public $end_time;
    public $date;

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all staff shifts
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY date, start_time';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single staff shift
    public function read_single() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     
    // staff can create a new staff shift
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (staff_id, start_time, end_time, date) VALUES (:staff_id, :start_time, :end_time, :date)';
        $stmt = $this->conn->prepare($query);

        // Clean and bind parameters
        $this->staff_id = htmlspecialchars(strip_tags($this->staff_id));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
        $this->date = htmlspecialchars(strip_tags($this->date));

        $stmt->bindParam(':staff_id', $this->staff_id, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $this->start_time);
        $stmt->bindParam(':end_time', $this->end_time);
        $stmt->bindParam(':date', $this->date);

        return $stmt->execute();
    }

//staff can delete shift
public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    // Clean and bind parameter
    $this->id = htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

    return $stmt->execute();
}
}


?>
