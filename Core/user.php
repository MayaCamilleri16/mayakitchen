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
    
}
?>