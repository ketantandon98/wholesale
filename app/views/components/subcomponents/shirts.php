<?php
require_once 'config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted and 'added' parameter is set. ";
    $database = new Database();
    $conn = $database->getConnection();
    require_once 'app/models/CartModel.php';
    if (isset($_POST['productId']) && isset($_POST['quantity'])) {
        echo "Product ID and quantity are set. ";
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $userId = $_SESSION['user_id'];
        $cartModel = new CartModel($conn);
        $result = $cartModel->addToCart($userId, $productId, $quantity);
        if ($result) {
            echo "Product added to cart successfully. ";
            header("Location: ?page=cart");
            exit();
        } else {
            echo "Error adding product to cart. ";
        }
    } else {
        echo "Error: Product ID or quantity missing. ";
    }
}
$stmt = $conn->prepare("SELECT * FROM Products WHERE category = 'shirts'");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container products-row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-3">
            <div class="card">
                <img src="<?php echo $product['image_path']; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo $product['name']; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $product['description']; ?>
                    </p>
                    <p class="card-text">$
                        <?php echo $product['price']; ?>
                    </p>
                    <div class="cart-inputs">
                        <input type="number" id="quantity_<?php echo $product['id']; ?>" name="quantity" min="1" value="1">
                        <div class="cart-btns">
                            <button onclick="incrementQuantity(<?php echo $product['id']; ?>)">+</button>
                            <button onclick="decrementQuantity(<?php echo $product['id']; ?>)">-</button>
                        </div>
                    </div>
                    <div class="add-to-cart-btn">
                        <button onclick="addToCart(<?php echo $product['id']; ?>);" class="btn btn-primary">Add to
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
