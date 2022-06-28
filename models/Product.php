<?php
class Product {
    // Database
    private $conn;
    private $table = 'products';

    // login properties

    public $id;
    public $product_name;
    public $product_description;
    public $product_price;
    public $product_imageid;
    public $category_name;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Logins
    public function read() {
        // Create Query
        $query = 'SELECT 
            c.category_name,
            p.id,
            p.product_name,
            p.product_description,
            p.product_price,
            p.product_imageid
        FROM
             ' . $this->table . ' p
        LEFT JOIN
            categories c ON p.product_category = c.id
        ORDER BY
            id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}