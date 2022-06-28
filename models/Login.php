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
}