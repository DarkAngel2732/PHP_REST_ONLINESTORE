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

    // Create Category
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . 
            $this->table. ' 
        SET
            category_name = :category_name,
            category_description = :category_description,
            category_code = :category_code';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        $this->category_description = htmlspecialchars(strip_tags($this->category_description));
        $this->category_code = htmlspecialchars(strip_tags($this->category_code));

        // Bind data
        $stmt->bindParam(':category_name', $this->category_name);
        $stmt->bindParam(':category_description', $this->category_description);
        $stmt->bindParam(':category_code', $this->category_code);

        // Execute query
        if($stmt->execute()){
            return true;
        }else{
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }

    // Update Category
    public function update() {
        // Create query
        $query = 'UPDATE ' . 
            $this->table. ' 
        SET 
        category_name = :category_name,
        category_description = :category_description,
        category_code = :category_code 
        WHERE 
            id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean Data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        $this->category_description = htmlspecialchars(strip_tags($this->category_description));
        $this->category_code = htmlspecialchars(strip_tags($this->category_code));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':category_name', $this->category_name);
        $stmt->bindParam(':category_description', $this->category_description);
        $stmt->bindParam(':category_code', $this->category_code);
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

    // Remove Category
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