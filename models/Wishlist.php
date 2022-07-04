<?php
class Wishlist {
    // Database
    private $conn;
    private $table = 'wishlist';

    // Wishlist properties

    public $id;
    public $product_id;
    public $product_name;
    public $added_at;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Items in Wishlist
    public function read() {
        // Create Query
        $query = 'SELECT 
            w.id,
            w.product_id,
            p.product_name,
            w.added_at
        FROM
             ' . $this->table . ' w
        LEFT JOIN
            products p ON w.product_id = p.id
        ORDER BY
            id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}