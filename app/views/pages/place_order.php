<?php
include_once(__DIR__ . '/../../../config/database.php');
include_once(__DIR__ . '/../../models/UserModel.php');
include_once(__DIR__ . '/../../models/CartModel.php');
include_once(__DIR__ . '/../../models/OrderModel.php');

$database = new Database();
$conn = $database->getConnection();
$userModel = new UserModel($conn);
$cartModel = new CartModel($conn);
$orderModel = new OrderModel($conn);

if (!$userModel->isLoggedIn()) {
    header("Location: ?page=auth");
    exit;
}

$userId = $_SESSION['user_id'];
$cartItems = $cartModel->getCartContents($userId);
if (!$cartItems || empty($cartItems)) {
    echo "Your cart is empty or couldn't be retrieved.";
    exit;
}


$shipping_address = ''; // Initialize with default value
if (isset($_POST['shipping'])) {
    $shipping_address = $_POST['shipping']['address']['line1'] . ', ' . $_POST['shipping']['address']['city'] . ', ' . $_POST['shipping']['address']['postal_code'] . ', ' . $_POST['shipping']['address']['country'];
}

$orderData = [
    'user_id' => $userId,
    'shipping_address' => $shipping_address,
];
$orderSuccess = $orderModel->placeOrder($orderData, $cartItems);

if ($orderSuccess) {
    foreach ($cartItems as $item) {
        $cartModel->removeFromCart($userId, $item['id']);
    } ?>
    <section class='container'>
        <div class="success-text">Order placed successfully!</div>
        <?php echo $shipping_address; ?>
        This page will redirect you to the homepage in <span id="countdown">10</span> seconds.
    </section>
    <?php
} else {
    echo "Failed to place the order. Please try again later.";
}
?>

<script>
    // Function to start the countdown
    function startCountdown() {
        var count = 10;
        var countdownElement = document.getElementById("countdown");

        var countdownInterval = setInterval(function () {
            countdownElement.innerHTML = count;
            count--;

            if (count < 0) {
                clearInterval(countdownInterval);
                setTimeout(function () {
                    window.location.href = "/wholesale";
                }, 1000);
            }
        }, 1000);
    }

    window.onload = startCountdown;
</script>