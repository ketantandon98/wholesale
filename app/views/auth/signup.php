<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

$signup_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once __DIR__ . '/../../../config/database.php';
    include_once __DIR__ . '/../../models/UserModel.php';

    $database = new Database();
    $conn = $database->getConnection();

    $userModel = new UserModel($conn);

    if (isset($_POST["signup_username"]) && isset($_POST["signup_password"]) && isset($_POST["signup_email"]) && isset($_POST["signup_role"])) {
        $username = htmlspecialchars($_POST["signup_username"]);
        $password = htmlspecialchars($_POST["signup_password"]);
        $email = htmlspecialchars($_POST["signup_email"]);
        $role = htmlspecialchars($_POST["signup_role"]);

        $registrationResult = $userModel->registerUser($username, $password, $email, $role);

        if ($registrationResult) {
            $_SESSION["signup_success"] = "Account created successfully. You can now log in.";
            $signup_successful = true;
        } else {
            if ($userModel->isUsernameTaken($username)) {
                $_SESSION["signup_error"] = "Username is already taken.";
            } elseif ($userModel->isEmailTaken($email)) {
                $_SESSION["signup_error"] = "Email is already taken.";
            } else {
                $_SESSION["signup_error"] = "Registration failed. Please try again.";
            }
        }
    }
}

if ($signup_successful) {
    header("Location: ?page=dashboard");
    exit;
} elseif (isset($_SESSION["signup_error"])) {
    $error_message = $_SESSION["signup_error"];
    unset($_SESSION["signup_error"]);
}
?>

<h2>Sign Up</h2>
<?php if (isset($error_message)): ?>
    <p style="color: red;">
        <?php echo $error_message; ?>
    </p>
<?php endif; ?>
<form action="" method="post">
    <div class="form-input">
        <input type="text" name="signup_username" placeholder="Username">
    </div>

    <div class="form-input">
        <input type="password" name="signup_password" placeholder="Password">
    </div>
    <div class="form-input">
        <input type="email" name="signup_email" placeholder="Email">
    </div>
    <div class="form-input">
        <label for="signup_role">Select Role:</label>
        <select name="signup_role" id="signup_role">
            <option value="client">Client</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-input">
        <button type="submit">Sign Up</button>
    </div>
</form>