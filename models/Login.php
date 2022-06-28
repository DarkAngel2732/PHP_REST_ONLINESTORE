<?php
class Login {
    // Database
    private $conn;
    private $table = 'logins';

    // login properties

    public $id;
    public $username;
    public $password;
    public $created_at;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Logins
    public function read() {
        // Create Query
        $query = 'SELECT 
            id,
            username,
            password,
            created_at
        FROM
             ' . $this->table . ' 
        ORDER BY
            id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create login
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table. ' 
        SET
            username = :username,
            password = :password';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // Bind data
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update login
    public function update() {
        // Create query
        $query = 'Update ' . 
            $this->table. ' 
        SET
            username = :username,
            password = :password
        WHERE
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
}