<?php
session_start();
include_once('../includes/db.php');

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        if ($username === "admin" && $password === "admin123") {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: Admin/admin.php");
            exit();
        } else {
            $error_message = "Invalid Username or Password!";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - RestoAdmin</title>
     <link rel="stylesheet" href="../Asset/style.css">
</head>
<body>

    <div class="login-card">
        <h2>🍽️ Admin Login</h2>

        <?php if (!empty($error_message)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>

            <button type="submit" class="login-btn">Sign In</button>
        </form>
    </div>

</body>
</html>
