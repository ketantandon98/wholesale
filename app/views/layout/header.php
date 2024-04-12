<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $_SESSION = array();
    session_destroy();
    header("Location: ?page=auth");
    exit;
}
session_regenerate_id(true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wholesaler-Retailer Website</title>
    <link rel="stylesheet" href="/wholesale/public/css/style.css">
    <link rel="stylesheet" href="/wholesale/public/css/pages.css">
    <link rel="stylesheet" href="/wholesale/public/css/components.css">

</head>

<body>
    <header class="header">
        <div class="container header-content content-container">
            <div class="logo">
                <img src="/wholesale/public/img/logo.svg" alt="">
            </div>
            <div class="menu-toggle" id="menuToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <div class="nav-menu-container" id="desktopMenu">
                <?php
                require_once __DIR__ . '/navigation.php';
                ?>

            </div>
        </div>
    </header>

    <main>