<?php
class Login {
    //Database
    private $conn;
    private $table = 'logins';

    //login properties

    public $id;
    public $username;
    public $password;
    public $created_at;

    //Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get Logins
    public function read() {
        //Create Query
        $query = 'SELECT
            l.id,
            l.username,
            l.password,
            l.created_at
        FROM
            ' . $this->table . ' l
        ORDER BY
            l.id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->exceute();

        return $stmt;
    }
}