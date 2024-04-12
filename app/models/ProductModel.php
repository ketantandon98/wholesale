<?php

class ProductModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addProduct($name, $price, $description, $category, $imagePath)
    {
        try {
            $query = "INSERT INTO products (name, price, description, category, image_path) VALUES (:name, :price, :description, :category, :imagePath)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":imagePath", $imagePath);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true; // Return true if the product was added successfully
            } else {
                return false; // Return false if the product insertion failed
            }
        } catch (PDOException $e) {
            error_log("Error adding product: " . $e->getMessage());
            return false;
        }
    }
}

