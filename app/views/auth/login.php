<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

$login_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once __DIR__ . '/../../../config/database.php';
    include_once __DIR__ . '/../../models/UserModel.php';

    $database = new Database();
    $conn = $database->getConnection();

    $userModel = new UserModel($conn);

    if (isset($_POST["login_username"]) && isset($_POST["login_password"])) {
        $username = htmlspecialchars($_POST["login_username"]);
        $password = htmlspecialchars($_POST["login_password"]);

        $user = $userModel->authenticateUser($username, $password);

        if ($user) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];
            $login_successful = true;
        } else {
            $_SESSION["login_error"] = "Invalid username or password";
        }
    }
}

if ($login_successful) {
    header("Location: ?page=dashboard");
    exit;
} elseif (isset($_SESSION["login_error"])) {
    $error_message = $_SESSION["login_error"];
    unset($_SESSION["login_error"]);
}
?>

<h2>Login</h2>
<?php if (isset($error_message)): ?>
    <p style="color: red;">
        <?php echo $error_message; ?>
    </p>
<?php endif; ?>
<form action="" method="post">
    <div class="form-input">
        <input type="text" name="login_username" placeholder="Username">
    </div>
    <div class="form-input">
        <input type="password" name="login_password" placeholder="Password">
    </div>
    <div class="form-input">
        <button type="submit">Login</button>
    </div>
</form>