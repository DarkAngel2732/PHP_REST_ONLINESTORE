<?php
class Cart {
    // Database
    private $conn;
    private $table = 'carts';

    // Cart properties

    public $id;
    public $product_id;
    public $product_name;
    public $added_at;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Items in cart
    public function read() {
        // Create Query
        $query = 'SELECT 
            c.id,
            c.product_id,
            p.product_name,
            c.added_at
        FROM
             ' . $this->table . ' c
        LEFT JOIN
            products p ON c.product_id = p.id
        ORDER BY
            id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}