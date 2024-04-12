<?php
include_once(__DIR__ . '/../../../config/database.php');
include_once(__DIR__ . '/../../models/UserModel.php');
require __DIR__ . "/../../../vendor/autoload.php";
include_once(__DIR__ . '/../../models/CartModel.php');

$stripe_secret_key = "sk_test_51OsOT5SAopa254feH31uKDMFkPZq0dTjFKGWrzMNpAjr5SDrKuzkdpUWUGRzY8U1v68bEZp8dvGwuow9xckzseeG00iC6OgT4d";

\Stripe\Stripe::setApiKey($stripe_secret_key);

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

if (empty($cartItems)) {
    header("Location: ?page=products");
    exit;
}

$line_items = [];

foreach ($cartItems as $item) {
    $line_items[] = [
        "price_data" => [
            "currency" => "usd",
            "unit_amount" => $item['price'] * 100,
            "product_data" => [
                "name" => $item['name'],
            ],
        ],
        "quantity" => $item['quantity'],
    ];
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/wholesale/?page=place-order",
    "cancel_url" => "http://localhost/wholesale/?page=failed-order",
    "locale" => "auto",
    "shipping_address_collection" => [
        "allowed_countries" => ["IN", "PK"],
    ],
    "line_items" => $line_items,
]);

http_response_code(303);
header("Location: " . $checkout_session->url);