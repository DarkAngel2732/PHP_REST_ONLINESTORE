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

    // Add to Wishlist
    public function add() {
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table. ' 
        SET
            product_id = :product_id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Sanitise Data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));

        // Bind data
        $stmt->bindParam(':product_id', $this->product_id);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Remove item
    public function delete(){
        // Create Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Sanitise Data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
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