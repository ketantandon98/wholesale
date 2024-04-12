<?php
class OrderModel
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function placeOrder($orderData, $cartItems)
    {
        try {
            $this->conn->beginTransaction();

            foreach ($cartItems as $item) {
                $query = "INSERT INTO orders (user_id, shipping_address, product_id, quantity, total_amount) 
                          VALUES (:user_id, :shipping_address, :product_id, :quantity, :total_amount)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":user_id", $orderData['user_id']);
                $stmt->bindParam(":shipping_address", $orderData['shipping_address']);
                $stmt->bindParam(":product_id", $item['id']); // Assuming 'id' is the correct key for product ID
                $stmt->bindParam(":quantity", $item['quantity']);
                $total_amount = $item['quantity'] * $item['price'];
                $stmt->bindParam(":total_amount", $total_amount);
                $stmt->execute();
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error placing order: " . $e->getMessage());
            return false;
        }
    }



}
