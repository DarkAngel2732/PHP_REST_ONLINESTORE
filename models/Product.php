<?php
class Product {
    // Database
    private $conn;
    private $table = 'products';

    // Product properties

    public $id;
    public $product_name;
    public $product_description;
    public $product_price;
    public $product_imageid;
    public $category_name;
    public $product_category_code;

    // Constructor with Database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get Products
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
            categories c ON p.product_category_code = c.category_code
        ORDER BY
            id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create Product
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table. ' 
        SET 
            product_name = :product_name,
            product_description = :product_description,
            product_price = :product_price,
            product_imageid = :product_imageid,
            product_category_code = :product_category_code';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->product_description = htmlspecialchars(strip_tags($this->product_description));
        $this->product_price = htmlspecialchars(strip_tags($this->product_price));
        $this->product_imageid = htmlspecialchars(strip_tags($this->product_imageid));
        $this->product_category_code = htmlspecialchars(strip_tags($this->product_category_code));

        // Bind data
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_description', $this->product_description);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':product_imageid', $this->product_imageid);
        $stmt->bindParam(':product_category_code', $this->product_category_code);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update Product
    public function update() {
        // Create query
        $query = 'UPDATE ' . 
            $this->table. ' 
        SET 
            product_name = :product_name,
            product_description = :product_description,
            product_price = :product_price,
            product_imageid = :product_imageid,
            product_category_code = :product_category_code 
        WHERE 
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->product_description = htmlspecialchars(strip_tags($this->product_description));
        $this->product_price = htmlspecialchars(strip_tags($this->product_price));
        $this->product_imageid = htmlspecialchars(strip_tags($this->product_imageid));
        $this->product_category_code = htmlspecialchars(strip_tags($this->product_category_code));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':product_description', $this->product_description);
        $stmt->bindParam(':product_price', $this->product_price);
        $stmt->bindParam(':product_imageid', $this->product_imageid);
        $stmt->bindParam(':product_category_code', $this->product_category_code);
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

    // Remove Product
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