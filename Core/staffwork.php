<?php

class Staff {
    private $conn;
    private $table = 'staff_work';

    public $staff_id;
    public $username;
    public $email;
    public $password;
    public $role;

    
    public function __construct($db){
        $this->conn = $db;
    }

    // Getting Staff from db
    public function read(){
        $query = 'SELECT *
                    FROM '.$this->table.' s
                    ORDER BY s.username ASC;';

      
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT *
                    FROM '.$this->table.' s
                    WHERE s.staff_id = ? LIMIT 1;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->staff_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->password = $row['password'];
        $this->role = $row['role'];

        return $stmt;
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.' 
                    (username, email, password, role)
                    VALUES(:username, :email, :password, :role)';
    
        $stmt = $this->conn->prepare($query);
    
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));
    
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
    
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
                    password = :password,
                    role = :role 
                    WHERE staff_id = :staff_id;';

        $stmt = $this->conn->prepare($query);

        $this->staff_id = htmlspecialchars(strip_tags($this->staff_id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role)); 

        $stmt->bindParam(':staff_id', $this->staff_id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role); 

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }

    public function delete(){
        $query = 'DELETE FROM '.$this->table.' WHERE staff_id = :staff_id;';

        $stmt = $this->conn->prepare($query);

        $this->staff_id = htmlspecialchars(strip_tags($this->staff_id));

        $stmt->bindParam(':staff_id', $this->staff_id);

        if($stmt->execute()){
            return true;
        }

        printf('Error: %s. \n',$stmt->error);
        return false;
    }
}


?>