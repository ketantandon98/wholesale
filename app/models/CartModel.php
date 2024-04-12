<?php

class CartModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addToCart($userId, $productId, $quantity)
    {
        try {
            // Check if the item already exists in the cart for the user
            $query = "SELECT id, quantity FROM cart WHERE user_id = :userId AND product_id = :productId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":productId", $productId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Item already exists in cart, update quantity
                $cartItemId = $row['id'];
                $existingQuantity = $row['quantity'];
                $newQuantity = $existingQuantity + $quantity;

                // Update quantity for the existing cart item
                $updateQuery = "UPDATE cart SET quantity = :newQuantity WHERE id = :cartItemId";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(":newQuantity", $newQuantity);
                $updateStmt->bindParam(":cartItemId", $cartItemId);
                $updateStmt->execute();
            } else {
                // Item doesn't exist in cart, insert a new record
                $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:userId, :productId, :quantity)";
                $insertStmt = $this->conn->prepare($insertQuery);
                $insertStmt->bindParam(":userId", $userId);
                $insertStmt->bindParam(":productId", $productId);
                $insertStmt->bindParam(":quantity", $quantity);
                $insertStmt->execute();
            }

            return true; // Return true on success
        } catch (PDOException $e) {
            // Handle database errors
            error_log("Error adding to cart: " . $e->getMessage());
            return false; // Return false on failure
        }
    }

    public function processCartFromCookies($userId)
    {
        // Parse cookies to extract cart items
        $cartItems = [];
        foreach ($_COOKIE as $name => $value) {
            if (strpos($name, 'cart_item_') === 0) {
                $productId = substr($name, strlen('cart_item_'));
                $cartItems[$productId] = $value;
            }
        }

        // Add cart items to the database
        foreach ($cartItems as $productId => $quantity) {
            $this->addToCart($userId, $productId, $quantity);
        }
    }

    public function getCartContents($userId)
    {
        try {
            $query = "SELECT p.*, c.quantity FROM cart c INNER JOIN products p ON c.product_id = p.id WHERE c.user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":userId", $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching cart contents: " . $e->getMessage());
            return false;
        }
    }
    public function removeFromCart($userId, $productId)
    {
        try {
            $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":product_id", $productId);
            $stmt->execute();
            return true; // Return true on success
        } catch (PDOException $e) {
            error_log("Error removing product from cart: " . $e->getMessage());
            return false; // Return false on failure
        }
    }

}

