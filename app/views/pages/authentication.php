<?php
include_once(__DIR__ . '/../../../config/database.php');
include_once(__DIR__ . '/../../models/UserModel.php');

$userModel = new UserModel($conn);

// Check if the user is already logged in
if ($userModel->isLoggedIn()) {
    header("Location: http://localhost/wholesale/?page=dashboard");
    exit;
}
?>

<section class="forms-container container">
    <div id="signin-form">
        <?php include_once __DIR__ . '/../auth/login.php'; ?>
    </div>

    <div id="signup-form">
        <?php include_once __DIR__ . '/../auth/signup.php'; ?>
    </div>
</section>

<?php include_once __DIR__ . '/../layout/footer.php'; ?>