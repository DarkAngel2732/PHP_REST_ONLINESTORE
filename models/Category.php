<?php
class Category {
    // Database
    private $conn;
    private $table = 'categories';

    // Category properties

    public $id;
    public $category_name;
    public $category_description;
    public $category_code;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Categories
    public function read() {
        // Create Query
        $query = 'SELECT 
            id,
            category_name,
            category_description,
            category_code 
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