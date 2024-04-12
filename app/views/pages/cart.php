<?php
include_once(__DIR__ . '/../../../config/database.php');
include_once(__DIR__ . '/../../models/UserModel.php');
include_once(__DIR__ . '/../../models/CartModel.php');
$database = new Database();
$conn = $database->getConnection();
$userModel = new UserModel($conn);
if (!$userModel->isLoggedIn()) {
    header("Location: ?page=auth");
    exit;
}
$cartModel = new CartModel($conn);
$userId = $_SESSION['user_id'];
$cartItems = $cartModel->getCartContents($userId);
?>

<main>
    <section id="cart">
        <div class="container">
            <h2>Your Shopping Cart</h2>

            <?php if (!empty($cartItems)): ?>
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo $item['image_path']; ?>" alt="Product Image">
                            <div class="item-details">
                                <h3>
                                    <?php echo $item['name']; ?>
                                </h3>
                                <p>
                                    <?php echo $item['description']; ?>
                                </p>
                                <p>Price: $
                                    <?php echo $item['price']; ?>
                                </p>
                                <p>Quantity:
                                    <?php echo $item['quantity']; ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button onclick="redirectToCheckout()" class="btn btn-primary">Checkout Now</button>
            <?php else: ?>
                <p>Your cart is empty. Please <a href="?page=products">add items</a> to continue shopping.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<script>
    function redirectToCheckout() {
        window.location.href = "?page=checkout";
    }
</script>