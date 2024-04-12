<?php

if (!isset($_SESSION["user_id"])) {
    header("Location: ?page=auth");
    exit;
}

if (isset($_POST['add_product'])) {
    require_once 'app/models/ProductModel.php';

    $database = new Database();
    $conn = $database->getConnection();

    $productModel = new ProductModel($conn);

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $imagePath = $_POST['image_path'];

    $productAdded = $productModel->addProduct($name, $price, $description, $category, $imagePath);

    if ($productAdded) {
        echo '<p>Product added successfully!</p>';
    } else {
        echo '<p>Error adding product. Please try again.</p>';
    }
}

?>
<section class="user-dashboard container">

    <div class="user-greeting">Hello,
        <?php echo $_SESSION["username"]; ?>!
        <span class="wave">👋</span>
    </div>

    <?php

    if ($_SESSION["role"] == "admin") {
        require_once 'app/views/components/add_product_form.php';

    } elseif ($_SESSION["role"] == "client") {
        require_once 'app/views/components/client_orders.php';
    }
    ?>

</section>