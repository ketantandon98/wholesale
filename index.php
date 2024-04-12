<?php
include_once(__DIR__ . '/config/database.php');
$database = new Database();
$conn = $database->getConnection();


include_once(__DIR__ . '/routes.php');

// Parse the requested page from the URL
$requestedPage = isset($_GET['page']) ? $_GET['page'] : '';

// Check if the requested page exists in the routes array
if (array_key_exists($requestedPage, $routes)) {
    // Include the corresponding file for the requested page
    include_once __DIR__ . '/app/views/layout/header.php';
    include_once __DIR__ . '/app/views/pages/' . $routes[$requestedPage];
    include_once __DIR__ . '/app/views/layout/footer.php';
} else {
    include_once __DIR__ . '/app/views/layout/header.php';
    include_once __DIR__ . '/app/views/pages/404.php';
    include_once __DIR__ . '/app/views/layout/footer.php';
}