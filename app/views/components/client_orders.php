<style>
    table,
    tr,
    td,
    th {
        border-collapse: collapse;
        padding: 10px;
    }
</style>


<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

$userId = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $userId);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($orders)) {
    echo "<h2>Your Orders</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Order ID</th><th>Product ID</th><th>Quantity</th><th>Total Amount</th><th>Order Date</th><th>Status</th></tr>";
    foreach ($orders as $order) {
        echo "<tr>";
        echo "<td>" . $order['id'] . "</td>";
        echo "<td>" . $order['product_id'] . "</td>";
        echo "<td>" . $order['quantity'] . "</td>";
        echo "<td>" . $order['total_amount'] . "</td>";
        echo "<td>" . $order['order_date'] . "</td>";
        echo "<td>" . $order['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    

} else {
    echo "<p>No orders found.</p>";
}

